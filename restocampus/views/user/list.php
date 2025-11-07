<?php include('views/layout/header.php'); ?>

<div class="container my-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold text-dark">
        <i class="bi bi-people-fill text-warning"></i> Gestion des utilisateurs
      </h2>
      <p class="text-muted mb-0">Ajoutez, modifiez ou supprimez les comptes.</p>
    </div>
    <div>
      <a class="btn btn-warning text-white me-2" href="index.php?action=ajouterUser">
        <i class="bi bi-person-plus-fill"></i> Ajouter
      </a>
      <a class="btn btn-outline-dark" href="index.php?action=dashboard">
        <i class="bi bi-arrow-left"></i> Retour
      </a>
    </div>
  </div>

  <?php if (empty($users)): ?>
    <div class="alert alert-light border text-center py-5">
      <h5>Aucun utilisateur trouvé.</h5>
      <a class="btn btn-warning text-white mt-3" href="index.php?action=ajouterUser">
        <i class="bi bi-person-plus-fill"></i> Créer un utilisateur
      </a>
    </div>
  <?php else: ?>
    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-warning text-dark">
              <tr>
                <th>ID</th>
                <th>Login</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Rôle</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $u): ?>
              <tr>
                <td><?= (int)$u['idUtilisateur'] ?></td>
                <td><?= htmlspecialchars($u['login']) ?></td>
                <td><?= htmlspecialchars($u['nom']) ?></td>
                <td><?= htmlspecialchars($u['prenom']) ?></td>
                <td>
                  <?php if ($u['role'] === 'admin'): ?>
                    <span class="badge bg-dark">Admin</span>
                  <?php else: ?>
                    <span class="badge bg-secondary">Étudiant</span>
                  <?php endif; ?>
                </td>
                <td>
                  <a class="btn btn-sm btn-outline-warning me-1" href="index.php?action=modifierUser&id=<?= (int)$u['idUtilisateur'] ?>">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  <a class="btn btn-sm btn-outline-danger" 
                     href="index.php?action=supprimerUser&id=<?= (int)$u['idUtilisateur'] ?>" 
                     onclick="return confirm('Supprimer cet utilisateur ?');">
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
