<?php
require_once "models/UserModel.php";
//session_start();

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function login() {
        $message = '';
        require "views/user/login.php";
    }

    public function verifier() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['login'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->findByLoginPassword($login, $password);

            if ($user) {
                $_SESSION['login'] = $user['login']; 
                $_SESSION['role']  = $user['role'];

                header("Location: index.php?action=dashboard");
                exit();
            } else {
                $message = "Login ou mot de passe incorrect.";
                require "views/user/login.php";
            }
        } else {
            header("Location: index.php?action=login");
        }
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?action=login");
    }
}
