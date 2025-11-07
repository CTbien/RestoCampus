<?php include('views/layout/header.php'); ?>

<style>
  :root {
    --warm-orange: #e67e22;
    --dark-brown: #6e4f32;
    --soft-cream: #fff8f0;
  }

  body {
    min-height: 100vh;
    margin: 0;
  }

  .student-dashboard {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    min-height: 100vh;
    padding: 5%;
  }

  .dashboard-card {
    background-color: rgba(255, 248, 240, 0.92);
    border-radius: 20px;
    padding: 50px 60px;
    max-width: 550px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
    animation: fadeIn 0.8s ease;
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .dashboard-card h2 {
    color: var(--dark-brown);
    font-weight: 700;
  }

  .dashboard-card p {
    color: #5a4632;
  }

  .dashboard-actions {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
    justify-content: center;
  }

  .dashboard-card .btn {
    flex: 1;
    min-width: 220px;
    font-size: 1.1rem;
  }

  .btn-primary {
    background-color: var(--warm-orange);
    border: none;
  }

  .btn-primary:hover {
    background-color: #cf6d17;
  }

  .btn-outline-dark {
    border-color: var(--dark-brown);
    color: var(--dark-brown);
  }

  .btn-outline-dark:hover {
    background-color: var(--dark-brown);
    color: white;
  }
</style>

<div class="student-dashboard">
  <div class="dashboard-card">
    <h2 class="mb-3"><i class="bi bi-mug-hot text-warning"></i> Bonjour, <?= htmlspecialchars($_SESSION['login'] ?? ''); ?> 👋</h2>
    <p class="mb-4">Bienvenue sur <strong>RestoCampus</strong> — votre espace pour réserver et gérer vos repas du campus.</p>

    <div class="dashboard-actions mb-4">
      <a href="index.php?action=reserver" class="btn btn-primary btn-lg">
        <i class="bi bi-bag-check"></i> Voir les articles
      </a>
      <a href="index.php?action=mesCommandes" class="btn btn-outline-dark btn-lg">
        <i class="bi bi-receipt"></i> Mes réservations
      </a>
    </div>

    <hr>
    <p class="text-muted small mb-0">
      <i class="bi bi-heart-fill text-warning"></i> RestoCampus – Institution Saint-Aspais  
      <br>© <?= date('Y'); ?> Tous droits réservés.
    </p>
  </div>
</div>

<?php include('views/layout/footer.php'); ?>
