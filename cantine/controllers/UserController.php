<?php
require_once './models/UserModel.php';

switch (strtolower($action)) {
    case 'login':
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login    = isset($_POST['login']) ? $_POST['login'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';

            $user = (new UserModel())->findByLoginPassword($login, $password);

            if ($user) {
                $_SESSION['login'] = $user['login'];
                $_SESSION['role'] = $user['role'];
                header('Location: index.php?controleur=contact&action=lister');
                exit;
            } else {
                $message = "Login ou mot de passe incorrect.";
            }
        }
        include './views/user/login.php';
        break;

    case 'logout':
        session_destroy();
        header('Location: index.php?controleur=user&action=login');
        exit;
}
