<h2>Liste des articles</h2>
<p><a href="index.php?action=ajouterArticle">Ajouter un article</a></p>

<table style="border:1px solid black; border-collapse: collapse;">
<tr>
    <th style="border:1px solid black; padding:5px;">Nom</th>
    <th style="border:1px solid black; padding:5px;">Description</th>
    <th style="border:1px solid black; padding:5px;">Ingrédients</th>
    <th style="border:1px solid black; padding:5px;">Actions</th>
</tr>
<?php foreach($articles as $a): ?>
<tr>
    <td style="border:1px solid black; padding:5px;"><?= htmlspecialchars($a['nom']); ?></td>
    <td style="border:1px solid black; padding:5px;"><?= htmlspecialchars($a['description']); ?></td>
    <td style="border:1px solid black; padding:5px;"><?= htmlspecialchars($a['ingredients']); ?></td>
    <td style="border:1px solid black; padding:5px;">
        <a href="index.php?action=modifierArticle&id=<?= $a['idArticle']; ?>">Modifier</a> |
        <a href="index.php?action=supprimerArticle&id=<?= $a['idArticle']; ?>" onclick="return confirm('Supprimer cet article ?');">Supprimer</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
