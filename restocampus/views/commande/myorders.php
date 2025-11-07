<?php include('views/layout/header.php'); ?>

<div class="container my-4">

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4 mb-0">Mes commandes</h2>
    <div>
      <a href="index.php?action=reserver" class="btn btn-outline-primary me-2">
        <i class="bi bi-cart-plus"></i> Réserver un article
      </a>
      <a href="index.php?action=dashboard" class="btn btn-outline-secondary me-2">
        <i class="bi bi-house-door"></i> Tableau de bord
      </a>
    </div>
  </div>

  <?php if (!empty($message)): ?>
    <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
  <?php endif; ?>

  <?php if (empty($commandes)): ?>
    <div class="alert alert-light text-center border">
      <p class="mb-0">Vous n'avez pas encore effectué de commande.</p>
    </div>

  <?php else: ?>
    <div class="card shadow-sm border-0">
      <div class="card-body p-3">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th>Article</th>
                <th>Début</th>
                <th>Fin</th>
                <th>Quantité</th>
                <th>Statut</th>
                <th>Date commande</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($commandes as $c): 
                $statut = $c['statut'];
              ?>
                <tr class="<?= $statut === 'annulée' ? 'text-muted' : '' ?>">
                  <td><?= htmlspecialchars($c['article']) ?></td>
                  <td><?= htmlspecialchars($c['dateHeureDebut']) ?></td>
                  <td><?= htmlspecialchars($c['dateHeureFin']) ?></td>
                  <td><span class="badge bg-light text-dark"><?= (int)$c['quantite'] ?></span></td>
                  <td>
                    <?php if ($statut === 'réservée'): ?>
                      <span class="badge bg-success"><?= htmlspecialchars($statut) ?></span>
                    <?php elseif ($statut === 'récupérée'): ?>
                      <span class="badge bg-primary"><?= htmlspecialchars($statut) ?></span>
                    <?php else: ?>
                      <span class="badge bg-danger"><?= htmlspecialchars($statut) ?></span>
                    <?php endif; ?>
                  </td>
                  <td><?= htmlspecialchars($c['dateCommande']) ?></td>
                  <td>
                    <?php if ($statut === 'réservée'): ?>
                      <form method="post" action="index.php?action=annuler"
                            onsubmit="return confirm('Annuler la commande #<?= (int)$c['idCommande'] ?> ?');">
                        <input type="hidden" name="idCommande" value="<?= (int)$c['idCommande'] ?>">
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                          <i class="bi bi-x-circle"></i> Annuler
                        </button>
                      </form>
                    <?php else: ?>
                      <span class="text-muted fst-italic"><?= htmlspecialchars($statut) ?></span>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  <?php endif; ?>

</div>
