<?php
// controllers/UserController.php

require_once __DIR__ . "/../models/UserModel.php";

class UserController {
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    public function login() {
        if (isset($_SESSION['login'])) {
            header("Location: index.php?action=dashboard");
            exit;
        }
        require "views/user/login.php";
    }


    public function verifier() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?action=login");
            exit;
        }

        $login = $_POST['login'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->model->findByLoginPassword($login, $password);
        if ($user) {

            $_SESSION['login'] = $user['login'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['idUtilisateur'] = $user['idUtilisateur'];

            if ($user['role'] === 'admin') {
                header("Location: index.php?action=dashboardAdmin");
            } else {
                header("Location: index.php?action=dashboard");
            }
            exit;
        } else {
            $message = "Login ou mot de passe incorrect.";
            require "views/user/login.php";
        }
    }

    public function logout() {
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            setcookie(session_name(), '', time() - 42000);
        }
        session_destroy();
        header("Location: index.php?action=login");
        exit;
    }


    public function listerUsers() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: index.php?action=login");
            exit;
        }

        $users = $this->model->getAll();
        require "views/user/list.php";
    }

    public function ajouterUser() {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header("Location: index.php?action=login");
        exit;
    }

    $message = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login = trim($_POST['login'] ?? '');
        $nom = trim($_POST['nom'] ?? '');
        $prenom = trim($_POST['prenom'] ?? '');
        $motDePasse = trim($_POST['motDePasse'] ?? '');
        $role = $_POST['role'] ?? 'etudiant';

        if ($login === '' || $motDePasse === '') {
            $message = "❌ Le login et le mot de passe sont obligatoires.";
        } else {
            try {

                $motDePasse = password_hash($motDePasse, PASSWORD_DEFAULT);

                $data = [
                    'login' => $login,
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'motDePasse' => $motDePasse,
                    'role' => $role
                ];

                $this->model->add($data);

                $_SESSION['message'] = "✅ Utilisateur ajouté avec succès !";
                header("Location: index.php?action=listerUsers");
                exit;

            } catch (Exception $e) {
                $message = $e->getMessage();
            }
        }
    }

    require "views/user/form.php";
}


    public function modifierUser() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: index.php?action=login");
            exit;
        }

        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($id <= 0) {
            header("Location: index.php?action=listerUsers");
            exit;
        }

        $user = $this->model->getById($id);
        if (!$user) {
            header("Location: index.php?action=listerUsers");
            exit;
        }

        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = trim($_POST['login'] ?? '');
            $nom = trim($_POST['nom'] ?? '');
            $prenom = trim($_POST['prenom'] ?? '');
            $motDePasse = trim($_POST['motDePasse'] ?? ''); 
            $role = $_POST['role'] ?? 'etudiant';

            if ($login === '') {
                $message = "Login obligatoire.";
            } else {
                $data = [
                    'login' => $login,
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'motDePasse' => $motDePasse,
                    'role' => $role
                ];
                $this->model->update($id, $data);
                header("Location: index.php?action=listerUsers");
                exit;
            }
        }

        require "views/user/form.php";
    }

    public function supprimerUser() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: index.php?action=login");
            exit;
        }

        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($id > 0) {
            $this->model->delete($id);
        }
        header("Location: index.php?action=listerUsers");
        exit;
    }
}
