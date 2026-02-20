<?php
$nav = "deleteuser";
$title = "Delete User";
require "header.php";
require "bd.php";

if (!is_connected()) {
    header("Location: login.php");
    exit;
}

$resultat = null;
$erreur = null;

// Recherche de l'utilisateur
if (!empty($_POST['id_user'])) {
    try {
        $stmt = $pdo->prepare('SELECT * FROM utilisateurs WHERE id_user = :id_user');
        $stmt->execute(['id_user' => $_POST['id_user']]);
        $resultat = $stmt->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}

// Suppression
if (isset($_POST['delete'])) {
    try {
        $stmt = $pdo->prepare('DELETE FROM utilisateurs WHERE id_user = :id_user');
        $stmt->execute(['id_user' => $_POST['id_u']]);
        echo "<p>Suppression réussie de l'utilisateur " . $_POST['id_u'] . " !</p>";
        $resultat = null; // pour ne plus afficher le formulaire après suppression
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}
?>

<div align="center">
    <h1 style="color:white">Delete User</h1><br>

    <form action="deleteUser.php" method="POST">
        <input type="number" name="id_user" placeholder="Entrez l'id de l'utilisateur" required>
        <button type="submit" class="btn-form-log">Rechercher</button>
    </form>

    <?php if ($resultat): ?>
        <form action="deleteUser.php" method="POST">
            <input type="hidden" name="id_u" value="<?= $resultat->id_user ?>">
            <label>Id :</label>
            <input readonly value="<?= $resultat->id_user ?>"><br><br>
            <label>Nom :</label>
            <input readonly value="<?= $resultat->nom ?>"><br><br>
            <label>Prénom :</label>
            <input readonly value="<?= $resultat->prenom ?>"><br><br>
            <label>Pseudo :</label>
            <input readonly value="<?= $resultat->pseudo ?>"><br><br>
            <label>Mot de passe :</label>
            <input readonly value="<?= $resultat->mot_de_passe ?>"><br><br>
            <label>Age :</label>
            <input readonly value="<?= $resultat->age ?>"><br><br>

            <button class="btn-form-log" type="submit" name="delete">Supprimer</button>
        </form>
    <?php elseif (isset($_POST['id_user'])): ?>
        <p>Utilisateur <?= $_POST['id_user'] ?> introuvable</p>
    <?php endif; ?>
</div>

<?php require_once "footer.php"; ?>
