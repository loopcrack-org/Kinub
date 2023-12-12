<?php

namespace App\Controllers;

use App\Exceptions\InvalidInputException;
use App\Models\UserModel;
use App\Models\UserTokenModel;
use App\Validation\ChangePasswordValidation;
use App\Validation\LoginValidation;
use Exception;
use Throwable;

class CtrlLogin extends BaseController
{
    public const USER_IS_NOT_CONFIRMED = '0';
    public const USER_IS_CONFIRMED     = '1';

    public function index(): string
    {
        return view('login/index');
    }

    public function viewPasswordEmail(): string
    {
        return view('login/PasswordEmail');
    }

    public function viewPasswordResponse(): string
    {
        return view('login/PasswordResponse');
    }

    public function viewPasswordReset($token)
    {
        try {
            $userTokenModelo          = new UserTokenModel();
            $userWithToken            = $userTokenModelo->getUserWithToken($token);
            $changePasswordValidation = new ChangePasswordValidation($userWithToken);

            $changePasswordValidation->existUserWithToken();
            $changePasswordValidation->validateTokenExpiration($token);
            $changePasswordValidation->hasAccessToResetPassword();
        } catch (Throwable $th) {
            $response = [
                'type'    => 'danger',
                'title'   => '¡Oops!',
                'message' => $th->getMessage(),
            ];

            return redirect()->to('/password_response')->with('response', $response);
        }

        return view('login/PasswordReset', [
            'token' => $token,
        ]);
    }

    public function viewPasswordSet($token)
    {
        try {
            $userTokenModelo          = new UserTokenModel();
            $userWithToken            = $userTokenModelo->getUserWithToken($token);
            $changePasswordValidation = new ChangePasswordValidation($userWithToken);

            $changePasswordValidation->existUserWithToken();
            $changePasswordValidation->validateTokenExpiration($token);
            $changePasswordValidation->hasAccessToSetPassword();
        } catch (Throwable $th) {
            $response = [
                'type'    => 'danger',
                'title'   => '¡Oops!',
                'message' => $th->getMessage(),
            ];

            return redirect()->to('/password_response')->with('response', $response);
        }

        return view('login/PasswordSet', [
            'token' => $token,
        ]);
    }

    public function passwordReset($token)
    {
        try {
            $userTokenModelo          = new UserTokenModel();
            $userWithToken            = $userTokenModelo->getUserWithToken($token);
            $changePasswordValidation = new ChangePasswordValidation($userWithToken);

            $data = $this->request->getPost();

            if (! $changePasswordValidation->validateInputs($data)) {
                throw new InvalidInputException($changePasswordValidation->getErrors());
            }

            $changePasswordValidation->existUserWithToken();

            $userModel = new UserModel();
            $userModel->updatePassword($userWithToken['userId'], $data['password'], self::USER_IS_CONFIRMED);

            $response = [
                'type'    => 'success',
                'title'   => 'Contraseña actualizada correctamente',
                'message' => 'Porfavor, inicia sesión para comenzar',
            ];
        } catch (InvalidInputException $th) {
            return redirect()->back()->with('errors', $changePasswordValidation->getErrors());
        } catch (Exception $e) {
            $response = [
                'title'   => 'Oops',
                'message' => $e->getMessage(),
                'type'    => 'danger',
            ];
        }

        return redirect()->to('/password_response')->with('response', $response);
    }

    public function passwordSet($token)
    {
        try {
            $userTokenModelo          = new UserTokenModel();
            $userWithToken            = $userTokenModelo->getUserWithToken($token);
            $changePasswordValidation = new ChangePasswordValidation($userWithToken);

            $data = $this->request->getPost();

            if (! $changePasswordValidation->validateInputs($data)) {
                throw new InvalidInputException($changePasswordValidation->getErrors());
            }

            $changePasswordValidation->existUserWithToken();

            $userModel = new UserModel();
            $userModel->updatePassword($userWithToken['userId'], $data['password'], self::USER_IS_NOT_CONFIRMED);

            $response = [
                'type'    => 'success',
                'title'   => 'Contraseña establecida correctamente',
                'message' => 'Porfavor, inicia sesión para comenzar',
            ];
        } catch (InvalidInputException $th) {
            return redirect()->back()->with('errors', $changePasswordValidation->getErrors());
        } catch (Exception $e) {
            $response = [
                'title'   => 'Oops',
                'message' => $e->getMessage(),
                'type'    => 'danger',
            ];
        }

        return redirect()->to('/password_response')->with('response', $response);
    }

    public function login()
    {
        $loginValidation = new LoginValidation();

        $data = $this->request->getPost();

        $email    = trim($data['email']);
        $password = trim($data['password']);

        try {
            if (! $loginValidation->validateInputs($data)) {
                throw new Exception();
            }
            $user = (new UserModel())->where('userEmail', $email)->first();
            $loginValidation->validateConfirmedAccount($user);
            $loginValidation->validateCredentials($user, $password);
            session()->set('user', [
                'name'  => $user['userFirstName'] . ' ' . $user['userLastName'],
                'email' => $user['userEmail'],
                'admin' => $user['isAdmin'],
            ]);
            session()->set('is_logged', true);
        } catch (Throwable $th) {
            return redirect()->back()->with('errors', $loginValidation->getErrors());
        }

        $redirectUrl = session()->get('redirectUrl') ?? 'admin';
        session()->remove('redirectUrl');

        return redirect()->to($redirectUrl);
    }

    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->to('login');
    }
}
