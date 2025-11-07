<?php
include __DIR__ . '/../layout/header.php'; 
?>

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h4 mb-0">Articles disponibles à la réservation</h2>
        <dive>
            <a href="index.php?action=mesCommandes" class="btn btn-outline-primary me-2">
              <i class="bi bi-cart-plus"></i> Voir mes commandes
            </a>
            <a href="index.php?action=dashboard" class="btn btn-outline-secondary me-2">
              <i class="bi bi-house-door"></i> Retour 
            </a>
        </div>
    </div>

    <?php if (!empty($message)): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <?php if (empty($disponibilites)): ?>
        <div class="alert alert-warning">Aucune disponibilité ouverte pour le moment.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Article</th>
                        <th>Début</th>
                        <th>Fin</th>
                        <th>Quantité disponible</th>
                        <th>Réserver</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($disponibilites as $d): ?>
                    <tr>
                        <td><?= htmlspecialchars($d['article']) ?></td>
                        <td><?= htmlspecialchars($d['dateHeureDebut']) ?></td>
                        <td><?= htmlspecialchars($d['dateHeureFin']) ?></td>
                        <td><?= (int)($d['dispoRestante'] ?? 0) ?></td>
                        <td>
                            <?php if ((int)($d['dispoRestante'] ?? 0) > 0): ?>
                                <form method="post" action="index.php?action=reserver" class="d-inline">
                                    <input type="hidden" name="idDispo" value="<?= (int)$d['idDispo'] ?>">
                                    <input type="number" name="quantite" value="1" min="1" max="<?= (int)$d['dispoRestante'] ?>" style="width:80px;" class="form-control d-inline-block me-1">
                                    <button class="btn btn-primary btn-sm" type="submit">Réserver</button>
                                </form>
                            <?php else: ?>
                                <span class="text-muted">Indisponible</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>