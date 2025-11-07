<?php include('views/layout/header.php'); ?>

<div class="container my-5">
  <div class="card shadow-sm border-0 mx-auto p-4" style="max-width: 650px; background-color: #fff8f0;">
    <h3 class="text-center mb-4 fw-bold text-dark">
      <i class="bi bi-pencil-square text-warning"></i> Modifier l’article
    </h3>

    <form method="post">
      <div class="mb-3">
        <label class="form-label fw-semibold">Nom de l’article</label>
        <input type="text" name="nom" class="form-control border-warning-subtle" value="<?= htmlspecialchars($article['nom']); ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" rows="3" class="form-control border-warning-subtle"><?= htmlspecialchars($article['description']); ?></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Ingrédients (séparés par des virgules)</label>
        <input type="text" name="ingredients" class="form-control border-warning-subtle" 
               value="<?= htmlspecialchars(implode(',', array_column($article['ingredients'], 'nom'))); ?>">
      </div>

      <div class="d-flex justify-content-between align-items-center mt-4">
        <a href="index.php?action=listerArticles" class="btn btn-outline-dark">
          <i class="bi bi-arrow-left"></i> Retour
        </a>
        <button type="submit" class="btn btn-warning text-white fw-semibold">
          <i class="bi bi-save"></i> Enregistrer les modifications
        </button>
      </div>
    </form>
  </div>
</div>

<?php include('views/layout/footer.php'); ?>
