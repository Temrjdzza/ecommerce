<?php

require_once __DIR__ . '/../Models/User.php';

class AuthController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            // Находим пользователя по username
            $user = User::findByUsername($username);

            // Проверяем существование пользователя, пароль и роль
            if ($user && $user->verifyPassword($password) && $user->role === 'admin') {

                Response::json($user);
                
                // session_start();
                // $_SESSION['user_id'] = $user->id;
                // $_SESSION['username'] = $user->username;
                // $_SESSION['role'] = $user->role;

                // header('Location: /dashboard');
                exit;
            } else {

                Response::error('Неверный логин или пароль');
            }
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /login');
        exit;
    }
}