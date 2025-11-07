<?php include('views/layout/header.php'); ?>

<div class="container mt-5">
  <div class="card border-0 shadow-sm mx-auto p-4" style="max-width: 650px; background-color: #fff8f0;">
    <h3 class="text-center mb-4 fw-bold text-dark">
      <i class="bi bi-calendar-check text-warning"></i>
      <?= isset($dispo) ? "Modifier" : "Ajouter"; ?> une disponibilité
    </h3>

    <?php if (!empty($message)): ?>
      <div class="alert alert-danger text-center"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="post">
      <div class="mb-3">
        <label for="idArticle" class="form-label fw-semibold">Article concerné</label>
        <select id="idArticle" name="idArticle" class="form-select border-warning-subtle" required>
          <option value="">-- Sélectionner un article --</option>
          <?php foreach ($articles as $a): ?>
            <option value="<?= $a['idArticle']; ?>"
              <?= (isset($dispo) && $dispo['idArticle'] == $a['idArticle']) ? 'selected' : ''; ?>>
              <?= htmlspecialchars($a['nom']); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="dateHeureDebut" class="form-label fw-semibold">Début du créneau</label>
          <input type="datetime-local" id="dateHeureDebut" name="dateHeureDebut"
                 value="<?= isset($dispo) ? str_replace(' ', 'T', $dispo['dateHeureDebut']) : ''; ?>"
                 class="form-control border-warning-subtle" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="dateHeureFin" class="form-label fw-semibold">Fin du créneau</label>
          <input type="datetime-local" id="dateHeureFin" name="dateHeureFin"
                 value="<?= isset($dispo) ? str_replace(' ', 'T', $dispo['dateHeureFin']) : ''; ?>"
                 class="form-control border-warning-subtle" required>
        </div>
      </div>

      <div class="mb-3">
        <label for="quantiteMax" class="form-label fw-semibold">Quantité maximale disponible</label>
        <input type="number" id="quantiteMax" name="quantiteMax"
               value="<?= $dispo['quantiteMax'] ?? ''; ?>"
               class="form-control border-warning-subtle" min="1" required>
      </div>

      <div class="d-grid mt-4">
        <button type="submit" class="btn btn-warning text-white fw-semibold py-2">
          <i class="bi bi-check-circle"></i>
          <?= isset($dispo) ? "Modifier la disponibilité" : "Ajouter la disponibilité"; ?>
        </button>
      </div>
    </form>

    <div class="text-center mt-4">
      <a href="index.php?action=listerDispo" class="text-decoration-none text-dark">
        <i class="bi bi-arrow-left"></i> Retour à la liste des disponibilités
      </a>
    </div>
  </div>
</div>

<?php include('views/layout/footer.php'); ?>
