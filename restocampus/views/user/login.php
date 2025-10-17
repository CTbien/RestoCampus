<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
</head>
<body>
    <h2>Connexion</h2>

    <?php if(!empty($message)) echo "<p style='color:red;'>$message</p>"; ?>

    <form method="post" action="index.php?action=verifier">
        Login : <input type="text" name="login" required><br>
        Mot de passe : <input type="password" name="password" required><br>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>
