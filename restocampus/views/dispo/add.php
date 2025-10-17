<h2><?= isset($dispo) ? "Modifier" : "Ajouter"; ?> une disponibilité</h2>

<?php if(isset($message)) echo "<p style='color:red;'>$message</p>"; ?>

<form method="post">
    <label>Article :</label>
    <select name="idArticle" required>
        <option value="">-- Sélectionner --</option>
        <?php foreach($articles as $a): ?>
            <option value="<?= $a['idArticle']; ?>" 
            <?= (isset($dispo) && $dispo['idArticle']==$a['idArticle']) ? 'selected' : ''; ?>>
            <?= htmlspecialchars($a['nom']); ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Date/Heure début :</label>
    <input type="datetime-local" name="dateHeureDebut" value="<?= isset($dispo) ? str_replace(' ', 'T', $dispo['dateHeureDebut']) : ''; ?>" required><br><br>

    <label>Date/Heure fin :</label>
    <input type="datetime-local" name="dateHeureFin" value="<?= isset($dispo) ? str_replace(' ', 'T', $dispo['dateHeureFin']) : ''; ?>" required><br><br>

    <label>Quantité max :</label>
    <input type="number" name="quantiteMax" value="<?= $dispo['quantiteMax'] ?? ''; ?>" required><br><br>

    <button type="submit"><?= isset($dispo) ? "Modifier" : "Ajouter"; ?></button>
</form>

<p><a href="index.php?action=listerDispo">Retour à la liste</a></p>
