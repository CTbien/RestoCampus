<?php
session_start();

$controleur = isset($_GET['controleur']) ? $_GET['controleur'] : 'contact';
$action     = isset($_GET['action']) ? $_GET['action'] : 'lister';

// Vérif login (sauf si on est déjà sur login)
if (!isset($_SESSION['login']) && !($controleur === 'user' && $action === 'login')) {
    header('Location: index.php?controleur=user&action=login');
    exit;
}

// Cas spécial : page de login → sans layout
if ($controleur === 'user' && $action === 'login') {
    $ctlFile = 'controllers/UserController.php';
    include $ctlFile;
    exit;
}

// Pour toutes les autres pages → avec layout
include 'views/layout/header.php';
include 'views/layout/menu.php';

$ctlFile = 'controllers/' . ucfirst(strtolower($controleur)) . 'Controller.php';
if (file_exists($ctlFile)) {
    include $ctlFile;
} else {
    echo '<div class="alert alert-danger">Contrôleur introuvable : ' . htmlspecialchars($controleur) . '</div>';
}

include 'views/layout/footer.php';
?>

