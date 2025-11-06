<?php

namespace App\Core;

use App\Repositories\UserRepository;

class Auth
{
    public static function user()
    {
        if (isset($_SESSION['user_id'])) {
            $userRepository = new UserRepository();
            return $userRepository->findById($_SESSION['user_id']);
        }
        return null;
    }

    public static function check()
    {
        return isset($_SESSION['user_id']);
    }

    public static function attempt($email, $password)
    {
        $userRepository = new UserRepository();
        $user = $userRepository->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            return true;
        }

        return false;
    }

    public static function logout()
    {
        session_destroy();
    }
}
