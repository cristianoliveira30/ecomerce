<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class AuthService
{
    private $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository();
    }

    public function register(array $user)
    {
        $errors = [];

        // Validações simples
        if (empty($user['name'])) {
            $errors['name'] = 'O nome é obrigatório.';
        }

        if (empty($user['email'])) {
            $errors['email'] = 'O e-mail é obrigatório.';
        } elseif (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'O e-mail informado não é válido.';
        } elseif ($this->userRepo->existsByEmail($user['email'])) {
            $errors['email'] = 'Já existe uma conta com este e-mail.';
        }

        if (empty($user['password'])) {
            $errors['password'] = 'A senha é obrigatória.';
        } elseif (strlen($user['password']) < 6) {
            $errors['password'] = 'A senha deve ter pelo menos 6 caracteres.';
        }

        if ($user['password'] !== $user['password_confirm']) {
            $errors['password_confirm'] = 'As senhas não conferem.';
        }

        // Se houver erros, lançamos todos de uma vez
        if (!empty($errors)) {
            throw new \Exception(json_encode($errors));
        }

        // Tudo certo: salvar
        $hash = password_hash($user['password'], PASSWORD_DEFAULT);

        $userDone = new User([
            'name'     => $user['name'],
            'email'    => $user['email'],
            'password' => $hash,
            'phone'    => $user['phone'] ?? null,
            'address'  => $user['address'] ?? null,
            'city'     => $user['city'] ?? null,
            'state'    => $user['state'] ?? null,
            'zip_code' => $user['zip_code'] ?? null,
        ]);

        return $this->userRepo->create($userDone);
    }


    public function login($email, $senha)
    {
        $user = $this->userRepo->findByEmail($email);

        if (!$user || !password_verify($senha, $user->password)) {
            throw new \Exception('E-mail ou senha inválidos.');
        }

        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->name;

        return $user;
    }

    public function logout()
    {
        session_destroy();
    }
}
