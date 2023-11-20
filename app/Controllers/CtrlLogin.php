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

    public function viewPasswordResponse(): string
    {
        return view('login/PasswordResponse');
    }

    public function viewPasswordReset($token): string
    {
        try {
            $changePasswordValidation = new ChangePasswordValidation();
            $userModel                = new UserModel();
            $user                     = $userModel->join('user_tokens', 'user_tokens.userId = users.userId')->where('userToken', $token)->first();

            $changePasswordValidation->existUserWithToken($user);
            $changePasswordValidation->accessValidation($user['confirmed'], '1');
        } catch (Throwable $th) {
            $response = [
                'type'    => 'danger',
                'title'   => '¡Oops!',
                'message' => 'Parece que no cuenta con el permiso para restablecer su contraseña o el token es invalido',
            ];
        }

        return view('login/PasswordReset', [
            'token'    => $token,
            'response' => $response ?? null,
        ]);
    }

    public function viewPasswordSet($token): string
    {
        try {
            $changePasswordValidation = new ChangePasswordValidation();

            $userModel = new UserModel();

            $user = $userModel->join('user_tokens', 'user_tokens.userId = users.userId')->where('userToken', $token)->first();

            $changePasswordValidation->existUserWithToken($user);
            $changePasswordValidation->accessValidation($user['confirmed'], '0');
        } catch (Throwable $th) {
            $response = [
                'type'    => 'danger',
                'title'   => '¡Oops!',
                'message' => 'Parece que no cuenta con el permiso para establecer su contraseña o el token es invalido',
            ];
        }

        return view('login/PasswordSet', [
            'token'    => $token,
            'response' => $response ?? null,
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
            $user           = $userTokenModel->join('users', 'users.userId = user_tokens.userId')->where('userToken', $token)->first();

            $changePasswordValidation->existUserWithToken($user);

            $userModel = new UserModel();
            $userModel->update($user['userId'], [
                'userPassword' => $data['password'],
            ]);
            $userTokenModel->where('userId', $user['userId'])->delete();

            $response = [
                'type'    => 'success',
                'title'   => 'Contraseña actualizada correctamente',
                'message' => 'Porfavor, inicia sesión para comenzar',
            ];
        } catch (Exception $e) {
            $errors = $changePasswordValidation->getErrors();
            if (isset($errors['connection'])) {
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

    public function passwordSet($token)
    {
        $changePasswordValidation = new ChangePasswordValidation();

        $data = $this->request->getPost();

        try {
            if (! $changePasswordValidation->validateInputs($data)) {
                throw new Exception();
            }

            $userTokenModel = new UserTokenModel();
            $user           = $userTokenModel->join('users', 'users.userId = user_tokens.userId')->where('userToken', $token)->first();

            $changePasswordValidation->existUserWithToken($user);

            $userModel = new UserModel();
            $result    = $userModel->update($user['userId'], [
                'userToken'    => null,
                'userPassword' => $data['password'],
                'confirmed'    => 1,
            ]);
            $userTokenModel->where('userId', $user['userId'])->delete();

            if ($result) {
                $response = [
                    'type'    => 'success',
                    'title'   => 'Contraseña establecida correctamente',
                    'message' => 'Porfavor, inicia sesión para comenzar',
                ];
            }
        } catch (Exception $e) {
            $errors = $changePasswordValidation->getErrors();
            if (isset($errors['connection'])) {
                $response = [
                    'type'    => 'danger',
                    'title'   => '¡Oops!',
                    'message' => $errors['connection'],
                ];
            } else {
                return redirect()->back()->with('errors', $errors);
            }
        }

        return redirect()->to('/password_set')->with('response', $response);
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
