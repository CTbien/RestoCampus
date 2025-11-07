<?php include('views/layout/header.php'); ?>

<style>
  :root {
    --warm-orange: #e67e22;
    --dark-brown: #6e4f32;
    --soft-cream: #fff8f0;
  }

  body {
    background-color: var(--soft-cream);
  }

  .admin-dashboard {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 25px;
    margin-top: 2rem;
  }

  .card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
  }

  .card-header {
    border-radius: 15px 15px 0 0;
    font-weight: bold;
  }

  .card-header.bg-primary {
    background-color: var(--warm-orange) !important;
  }

  .card-header.bg-secondary {
    background-color: var(--dark-brown) !important;
  }

  .table th, .table td {
    vertical-align: middle;
  }

  .badge {
    font-size: 0.85rem;
  }

  @media (max-width: 992px) {
    .admin-dashboard {
      grid-template-columns: 1fr;
    }
  }
</style>

<div class="container">
  <h2 class="text-center mb-4 fw-bold text-dark">
    <i class="bi bi-speedometer2 text-warning"></i> Tableau de bord Administrateur
  </h2>

  <div class="admin-dashboard">

    <!-- Commandes du jour -->
    <div class="card">
      <div class="card-header bg-primary text-white">
        <i class="bi bi-receipt-cutoff"></i> Commandes du jour
      </div>
      <div class="card-body">
        <?php if (!empty($commandesToday)): ?>
          <div class="table-responsive">
            <table class="table table-striped align-middle text-center">
              <thead class="table-warning">
                <tr>
                  <th>#</th><th>Utilisateur</th><th>Article</th>
                  <th>Début</th><th>Fin</th><th>Statut</th><th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($commandesToday as $c): ?>
                <tr>
                  <td><?= htmlspecialchars($c['idCommande']); ?></td>
                  <td><?= htmlspecialchars($c['utilisateur']); ?></td>
                  <td><?= htmlspecialchars($c['article']); ?></td>
                  <td><?= htmlspecialchars($c['dateHeureDebut']); ?></td>
                  <td><?= htmlspecialchars($c['dateHeureFin']); ?></td>
                  <td>
                    <?php if ($c['statut'] === 'réservée'): ?>
                      <span class="badge bg-warning text-dark">Réservée</span>
                    <?php else: ?>
                      <span class="badge bg-success">Récupérée</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if ($c['statut'] === 'réservée'): ?>
                      <a href="index.php?action=marquerRecuperee&id=<?= $c['idCommande']; ?>" class="btn btn-sm btn-success">
                        <i class="bi bi-check-circle"></i>
                      </a>
                    <?php else: ?>
                      <button class="btn btn-sm btn-secondary" disabled>✔</button>
                    <?php endif; ?>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php else: ?>
          <p class="text-muted">Aucune commande enregistrée aujourd'hui.</p>
        <?php endif; ?>
      </div>
    </div>

    <!-- Statistiques -->
    <div class="card">
      <div class="card-header bg-secondary text-white">
        <i class="bi bi-bar-chart-line"></i> Statistiques
      </div>
      <div class="card-body">
        <?php if (!empty($totauxParArticle)): ?>
          <ul class="list-group mb-3">
            <?php foreach ($totauxParArticle as $t): ?>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <?= htmlspecialchars($t['article']); ?>
                <span class="badge bg-primary rounded-pill"><?= (int)$t['total']; ?></span>
              </li>
            <?php endforeach; ?>
          </ul>
          <div class="alert alert-success text-center fw-bold">
            Total général : <?= (int)$totalCommandes; ?> réservations
          </div>
        <?php else: ?>
          <p class="text-muted">Aucune donnée statistique disponible.</p>
        <?php endif; ?>
      </div>
    </div>

  </div>
</div>

<?php include('views/layout/footer.php'); ?>
