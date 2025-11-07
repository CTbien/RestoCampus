<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion - RestoCampus</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <style>
    :root {
      --warm-orange: #e67e22;
      --deep-orange: #d35400;
      --dark-brown: #4a2c18;
      --soft-cream: #fff8f0;
    }

    body {
      background: linear-gradient(135deg, var(--warm-orange), var(--deep-orange));
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Poppins', sans-serif;
    }

    .login-card {
      background-color: var(--soft-cream);
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.3);
      width: 100%;
      max-width: 420px;
      padding: 40px;
      animation: fadeIn 0.8s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(15px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .login-card h3 {
      color: var(--dark-brown);
      font-weight: 700;
    }

    .form-label {
      font-weight: 600;
      color: var(--dark-brown);
    }

    .form-control {
      border-radius: 10px;
      border: 1px solid rgba(0,0,0,0.15);
    }

    .btn-login {
      background-color: var(--warm-orange);
      border: none;
      border-radius: 10px;
      font-weight: 600;
    }

    .btn-login:hover {
      background-color: var(--deep-orange);
    }

    .footer-text {
      color: var(--dark-brown);
      font-size: 0.85rem;
    }
  </style>
</head>
<body>

<div class="login-card">
  <div class="text-center mb-4">
    <i class="bi bi-egg-fried fs-1 text-warning"></i>
    <h3 class="mt-2">RestoCampus</h3>
    <p class="text-muted mb-0">Espace de connexion</p>
  </div>

  <?php if(!empty($message)): ?>
    <div class="alert alert-danger text-center"><?= htmlspecialchars($message) ?></div>
  <?php endif; ?>

  <form method="post" action="index.php?action=verifier">
    <div class="mb-3">
      <label for="login" class="form-label">Nom d'utilisateur</label>
      <input type="text" id="login" name="login" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Mot de passe</label>
      <input type="password" id="password" name="password" class="form-control" required>
    </div>

    <div class="d-grid mt-4">
      <button type="submit" class="btn btn-login text-white py-2">
        <i class="bi bi-box-arrow-in-right"></i> Se connecter
      </button>
    </div>
  </form>

  <p class="text-center footer-text mt-4 mb-0">
    © <?= date('Y') ?> RestoCampus – Institut Saint-Aspais
  </p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
