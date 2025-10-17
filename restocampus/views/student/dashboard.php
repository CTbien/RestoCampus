<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Étudiant</title>
</head>
<body>
    <p>Bonjour <?= $_SESSION['login']; ?> | <a href="index.php?action=logout">Déconnexion</a></p>

    <h3>Menu Étudiant</h3>
    <ul>
        <li><a href="#">Voir les articles disponibles</a></li>
        <li><a href="#">Passer une commande</a></li>
    </ul>
</body>
</html>