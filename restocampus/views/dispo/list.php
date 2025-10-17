<h2>Disponibilités des articles</h2>
<p><a href="index.php?action=ajouterDispo">Ajouter une disponibilité</a></p>

<table style="border:1px solid black; border-collapse: collapse;">
<tr>
    <th style="border:1px solid black; padding:5px;">Article</th>
    <th style="border:1px solid black; padding:5px;">Date/Heure début</th>
    <th style="border:1px solid black; padding:5px;">Date/Heure fin</th>
    <th style="border:1px solid black; padding:5px;">Quantité max</th>
    <th style="border:1px solid black; padding:5px;">Actions</th>
</tr>
<?php foreach($disponibilites as $d): ?>
<tr>
    <td style="border:1px solid black; padding:5px;"><?= htmlspecialchars($d['article']); ?></td>
    <td style="border:1px solid black; padding:5px;"><?= htmlspecialchars($d['dateHeureDebut']); ?></td>
    <td style="border:1px solid black; padding:5px;"><?= htmlspecialchars($d['dateHeureFin']); ?></td>
    <td style="border:1px solid black; padding:5px;"><?= htmlspecialchars($d['quantiteMax']); ?></td>
    <td style="border:1px solid black; padding:5px;">
        <a href="index.php?action=modifierDispo&id=<?= $d['idDispo']; ?>">Modifier</a> |
        <a href="index.php?action=supprimerDispo&id=<?= $d['idDispo']; ?>" onclick="return confirm('Supprimer cette disponibilité ?');">Supprimer</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
