<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; }
        nav ul { list-style: none; padding: 0; }
        nav ul li { display: inline-block; margin-right: 15px; }
        nav ul li a { text-decoration: none; color: blue; }
    </style>
</head>
<body>
    <header>
        <p>Bonjour <?= $_SESSION['login']; ?> | <a href="index.php?action=logout">Déconnexion</a></p>
    </header>

    <nav>
        <?php if($_SESSION['role'] === 'admin'): ?>
            <h3>Menu Administrateur</h3>
            <ul>
                <li><a href="index.php?action=listerUsers">Gérer les utilisateurs</a></li>
                <li><a href="index.php?action=listerArticles">Gérer les articles</a></li>
                <li><a href="index.php?action=listerDispo">Gérer les disponibilités</a></li>
            </ul>
        <?php else: ?>
            <h3>Menu Étudiant</h3>
            <ul>
                <li><a href="index.php?action=listerArticlesDisponibles">Voir les articles disponibles</a></li>
                <li><a href="index.php?action=passerCommande">Passer une commande</a></li>
            </ul>
        <?php endif; ?>
    </nav>

    <main>
        <h2>Bienvenue sur le dashboard</h2>
        <p>Choisissez une action dans le menu.</p>
    </main>
</body>
</html>
