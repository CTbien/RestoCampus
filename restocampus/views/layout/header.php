<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RestoCampus</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <style>
    :root {
      --warm-orange: #e67e22;
      --deep-orange: #d35400;
      --dark-brown: #4a2c18;
      --cream: #fff8f0;
    }

    body {
      background-color: var(--cream);
      background-image: url('https://www.transparenttextures.com/patterns/white-wall-3.png');
      background-repeat: repeat;
      font-family: "Poppins", sans-serif;
      margin: 0;
    }

    /* ===== NAVBAR ===== */
    .navbar {
      background: linear-gradient(90deg, var(--warm-orange), var(--deep-orange));
      box-shadow: 0 3px 10px rgba(0,0,0,0.15);
      padding: 0.8rem 1.5rem;
    }

    .navbar-brand {
      font-weight: 700;
      color: #fff !important;
      font-size: 1.4rem;
      display: flex;
      align-items: center;
    }

    .navbar-brand i {
      font-size: 1.5rem;
      margin-right: 0.5rem;
    }

    .nav-link {
      color: #fff !important;
      font-weight: 500;
      padding: 0.7rem 1rem !important;
      border-radius: 0.4rem;
      transition: background 0.2s ease;
    }

    .nav-link:hover, .nav-link.active {
      background: rgba(255, 255, 255, 0.25);
    }

    .user-info {
      color: #fff;
      font-weight: 500;
    }

    .user-info i {
      color: #fff8f0;
    }

    .btn-logout {
      border: 1px solid #fff;
      color: #fff;
      transition: 0.3s;
    }

    .btn-logout:hover {
      background: #fff;
      color: var(--deep-orange);
    }

    /* ===== PAGE STRUCTURE ===== */
    main {
      padding: 2rem;
      min-height: 80vh;
    }

    footer {
      background: var(--dark-brown);
      color: var(--cream);
      padding: 1.5rem 0;
      box-shadow: inset 0 5px 10px rgba(0,0,0,0.15);
    }

    footer a {
      color: #fff8f0;
      text-decoration: none;
      transition: 0.3s;
    }

    footer a:hover {
      color: var(--warm-orange);
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <i class="bi bi-egg-fried"></i> RestoCampus
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
          <li class="nav-item"><a class="nav-link" href="index.php?action=dashboard"><i class="bi bi-speedometer2"></i> Tableau de bord</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php?action=listerUsers"><i class="bi bi-people"></i> Utilisateurs</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php?action=listerArticles"><i class="bi bi-journal-text"></i> Articles</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php?action=listerDispo"><i class="bi bi-calendar-event"></i> Disponibilités</a></li>
        <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'etudiant'): ?>
          <li class="nav-item"><a class="nav-link" href="index.php?action=reserver"><i class="bi bi-bag-check"></i> Réserver</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php?action=mesCommandes"><i class="bi bi-receipt"></i> Mes réservations</a></li>
        <?php endif; ?>
      </ul>

      <div class="d-flex align-items-center">
        <?php if (isset($_SESSION['login'])): ?>
          <span class="user-info me-3">
            <i class="bi bi-person-circle me-1"></i>
            <?= htmlspecialchars($_SESSION['login']); ?>
          </span>
          <a href="index.php?action=logout" class="btn btn-logout btn-sm">
            <i class="bi bi-box-arrow-right"></i> Déconnexion
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>

<main class="container-fluid">
