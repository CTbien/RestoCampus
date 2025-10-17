<h2>Modifier l'article</h2>

<form method="post">
    <label>Nom :</label>
    <input type="text" name="nom" value="<?= htmlspecialchars($article['nom']); ?>" required><br><br>

    <label>Description :</label>
    <textarea name="description" rows="3" cols="40"><?= htmlspecialchars($article['description']); ?></textarea><br><br>

    <label>Ingrédients (séparés par des virgules) :</label>
    <input type="text" name="ingredients" value="<?= htmlspecialchars(implode(',', array_column($article['ingredients'], 'nom'))); ?>"><br><br>

    <button type="submit">Modifier</button>
</form>

<p><a href="index.php?action=listerArticles">Retour à la liste</a></p>
