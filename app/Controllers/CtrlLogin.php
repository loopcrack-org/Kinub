<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserTokenModel;
use App\Validation\ChangePasswordValidation;
use App\Validation\LoginValidation;
use Exception;
use Throwable;

class CtrlLogin extends BaseController
{
    public function index(): string
    {
        return view('login/index');
    }

    public function viewPasswordEmail(): string
    {
        return view('login/PasswordEmail');
    }

    public function viewPasswordReset($token): string
    {
        try {
            $changePasswordValidation = new ChangePasswordValidation();

            $userTokenModel = new UserTokenModel();
            $userToken      = $userTokenModel->where('userToken', $token)->first();
            $changePasswordValidation->existUserWithToken($userToken);

            $userModel = new UserModel();

            $user = $userModel->find($userToken['userId']);

            $changePasswordValidation->existUserWithToken($user);

            $isAccountConfirmed = $user['confirmed'];
        } catch (Throwable $th) {
            $response = [
                'type'    => 'danger',
                'title'   => '¡Oops!',
                'message' => 'Parece que no cuenta con el permiso para restablecer su contraseña o el token es invalido',
            ];
        }

        return view('login/PasswordReset', [
            'token'              => $token,
            'isAccountConfirmed' => $isAccountConfirmed ?? false,
            'response'           => $response ?? null,
        ]);
    }

    public function passwordReset($token)
    {
        $changePasswordValidation = new ChangePasswordValidation();

        $data = $this->request->getPost();

        try {
            if (! $changePasswordValidation->validateInputs($data)) {
                throw new Exception();
            }

            $userTokenModel = new UserTokenModel();
            $userToken      = $userTokenModel->where('userToken', $token)->first();

            $userModel = new UserModel();
            $user      = $userModel->find($userToken['userId']);

            $changePasswordValidation->existUserWithToken($user);
            $isAccountConfirmed = $user['confirmed'];

            if ($isAccountConfirmed) {
                $result = $userModel->update($user['userId'], [
                    'userPassword' => $data['password'],
                ]) && $userTokenModel->delete($userToken['userTokenId']);
            } else {
                $result = $userModel->update($user['userId'], [
                    'userPassword' => $data['password'],
                    'confirmed'    => 1,
                ]) && $userTokenModel->delete($userToken['userTokenId']);
            }

            if ($result) {
                $response = [
                    'type'    => 'success',
                    'title'   => 'Contraseña actualizada correctamente',
                    'message' => 'Porfavor, inicia sesión para comenzar',
                ];
            }
        } catch (Exception $e) {
            $errors = $changePasswordValidation->getErrors();

            exit();

            if (isset($errors['connection'])) {
                exit($errors);
                $response = [
                    'type'    => 'danger',
                    'title'   => '¡Oops!',
                    'message' => $errors['connection'],
                ];
            } else {
                return redirect()->back()->with('errors', $errors);
            }
        }

        return redirect()->to('/password_reset')->with('response', $response);
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
