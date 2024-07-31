<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        $this->view('auth/login');
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new User();
            $user = $userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['rol'];
                header('Location: /');
                exit;
            } else {
                $this->view('auth/login', ['error' => 'Email o contraseña incorrectos']);
            }
        }
    }

    public function showRegisterForm()
    {
        $this->view('auth/register');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $rol = $_POST['rol']; // arrendador o arrendatario

            $userModel = new User();
            if ($userModel->createUser($nombre, $email, $password, $rol)) {
                header('Location: /login');
                exit;
            } else {
                $this->view('auth/register', ['error' => 'Error al crear el usuario']);
            }
        }
    }

    public function showRecoverPasswordForm()
    {
        $this->view('auth/recover_password');
    }

    public function recoverPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];

            // Implementar la lógica para enviar un correo con el enlace de recuperación de contraseña
            // Esto podría incluir la generación de un token, almacenamiento en la base de datos y envío del correo

            $this->view('auth/recover_password', ['message' => 'Se ha enviado un enlace de recuperación a su correo electrónico.']);
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /');
        exit;
    }
}
