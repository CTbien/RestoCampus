<h2>Ajouter un article</h2>

<form method="post">
    <label>Nom :</label>
    <input type="text" name="nom" required><br><br>

    <label>Description :</label>
    <textarea name="description" rows="3" cols="40"></textarea><br><br>

    <label>Ingrédients (séparés par des virgules) :</label>
    <input type="text" name="ingredients"><br><br>

    <button type="submit">Ajouter</button>
</form>

<p><a href="index.php?action=listerArticles">Retour à la liste</a></p>
