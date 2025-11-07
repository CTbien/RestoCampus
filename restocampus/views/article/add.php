<?php include('views/layout/header.php'); ?>

<div class="container my-5">
  <div class="card shadow-sm border-0 mx-auto p-4" style="max-width: 650px; background-color: #fff8f0;">
    <h3 class="text-center mb-4 fw-bold text-dark">
      <i class="bi bi-plus-circle text-warning"></i> Ajouter un nouvel article
    </h3>

    <form method="post">
      <div class="mb-3">
        <label for="nom" class="form-label fw-semibold">Nom du plat</label>
        <input type="text" id="nom" name="nom" class="form-control border-warning-subtle" placeholder="Ex : Croque-monsieur" required>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label fw-semibold">Description</label>
        <textarea id="description" name="description" rows="3" class="form-control border-warning-subtle" placeholder="Brève description du plat..."></textarea>
      </div>

      <div class="mb-3">
        <label for="ingredients" class="form-label fw-semibold">Ingrédients (séparés par des virgules)</label>
        <input type="text" id="ingredients" name="ingredients" class="form-control border-warning-subtle" placeholder="Ex : jambon, fromage, pain de mie">
      </div>

      <div class="d-grid mt-4">
        <button type="submit" class="btn btn-warning text-white fw-semibold">
          <i class="bi bi-check-circle"></i> Ajouter l'article
        </button>
      </div>
    </form>

    <div class="text-center mt-4">
      <a href="index.php?action=listerArticles" class="text-decoration-none text-dark">
        <i class="bi bi-arrow-left"></i> Retour à la liste des articles
      </a>
    </div>
  </div>
</div>

<?php include('views/layout/footer.php'); ?>
