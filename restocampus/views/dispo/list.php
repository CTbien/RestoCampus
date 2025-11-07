<?php include('views/layout/header.php'); ?>

<div class="container my-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold text-dark mb-1">
        <i class="bi bi-calendar-week text-warning"></i> Disponibilités des articles
      </h2>
      <p class="text-muted mb-0">Gérez les créneaux horaires et la quantité disponible pour chaque article.</p>
    </div>
    <div>
      <a href="index.php?action=ajouterDispo" class="btn btn-warning text-white me-2">
        <i class="bi bi-plus-circle"></i> Nouvelle disponibilité
      </a>
      <a href="index.php?action=dashboard" class="btn btn-outline-dark">
        <i class="bi bi-arrow-left"></i> Retour
      </a>
    </div>
  </div>

  <?php if (empty($disponibilites)): ?>
    <div class="alert alert-light border text-center py-5">
      <h5 class="mb-2">Aucune disponibilité enregistrée pour le moment.</h5>
      <a href="index.php?action=ajouterDispo" class="btn btn-warning text-white">
        <i class="bi bi-plus-circle"></i> Ajouter une disponibilité
      </a>
    </div>
  <?php else: ?>
    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-warning text-dark">
              <tr>
                <th>Article</th>
                <th>Début</th>
                <th>Fin</th>
                <th>Quantité max</th>
                <th class="text-center" style="width:180px;">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($disponibilites as $d): ?>
                <tr>
                  <td class="fw-semibold text-dark"><?= htmlspecialchars($d['article']); ?></td>
                  <td><?= htmlspecialchars($d['dateHeureDebut']); ?></td>
                  <td><?= htmlspecialchars($d['dateHeureFin']); ?></td>
                  <td>
                    <span class="badge bg-secondary px-3 py-2">
                      <?= htmlspecialchars($d['quantiteMax']); ?>
                    </span>
                  </td>
                  <td class="text-center">
                    <a href="index.php?action=modifierDispo&id=<?= $d['idDispo']; ?>" class="btn btn-sm btn-outline-warning me-1">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                    <a href="index.php?action=supprimerDispo&id=<?= $d['idDispo']; ?>"
                       onclick="return confirm('Supprimer cette disponibilité ?');"
                       class="btn btn-sm btn-outline-danger">
                      <i class="bi bi-trash"></i>
                    </a>
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

<?php include('views/layout/footer.php'); ?>
