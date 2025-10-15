<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Connexion</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="height:100vh;">
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <h2 class="text-center mb-4">Connexion</h2>

      <?php if (!empty($message)): ?>
        <div class="alert alert-danger"><?php echo $message; ?></div>
      <?php endif; ?>

      <form method="post" class="card p-4 shadow-sm">
        <div class="mb-3">
          <label class="form-label">Login</label>
          <input type="text" name="login" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Mot de passe</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Se connecter</button>
      </form>
    </div>
  </div>
</div>
</body>
</html>
