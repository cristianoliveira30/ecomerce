<?php

namespace App\Controllers;

use App\Services\AuthService;

class AuthController
{
    private $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function showLogin()
    {
        return [
            'view' => 'auth/login',
            'data' => ['title' => 'Entrar']
        ];
    }

    public function showRegister()
    {
        return [
            'view' => 'auth/cadastro',
            'data' => ['title' => 'Cadastro']
        ];
    }

    public function login()
    {
        try {
            $this->authService->login($_POST['email'], $_POST['password']);
            $_SESSION['success'] = 'Login realizado com sucesso!';
            header('Location: /');
        } catch (\Exception $e) {
            $_SESSION['login_error'] = true;
            $_SESSION['error'] = $e->getMessage();
            header('Location: /');
        }
        exit;
    }

    public function register()
    {
        try {
            $data = [
                'name'              => $_POST['name'],
                'email'             => $_POST['email'],
                'password'          => $_POST['password'],
                'password_confirm'  => $_POST['password_confirm'],
                'phone'             => $_POST['phone'],
                'address'           => $_POST['address'],
                'city'              => $_POST['city'],
                'state'             => $_POST['state'],
                'zip_code'          => $_POST['zip_code']
            ];

            $this->authService->register($data);

            $_SESSION['success'] = 'Cadastro realizado com sucesso! Faça login.';
            header('Location: /');
            exit;
        } catch (\Exception $e) {
            // Guarda os valores preenchidos
            $_SESSION['old'] = $data;

            $decoded = json_decode($e->getMessage(), true);
            if (is_array($decoded)) {
                $_SESSION['errors'] = $decoded;
            } else {
                $_SESSION['error'] = $e->getMessage();
            }

            header('Location: /');
            exit;
        }
    }

    public function logout()
    {
        $this->authService->logout();
        header('Location: /');
        exit;
    }
}
