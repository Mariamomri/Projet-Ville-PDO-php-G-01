<?php
session_start();
$nav = "deleteuser";
$title = "delete User";
$erreur = null;
$resultat = NULL;
require "header.php";
require "bd.php";
if (!is_connected()) {
    header("Location: login.php");
    exit;
}
require "header.php";
require "bd.php";

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

<body>
    <section class="yellow">
        <div align="center">
            </br>
            <h1>Delete User</h1>
            <br>
            <form action="deleteUser.php" method="POST">
                <input type="number" name="id_user" placeholder="Entrez l'id de l'user">
                <button type="submit" class="btn-form-log">Rechercher</button>
            </form>
            <?php if (isset($resultat) && $resultat != false): ?>
                <form action="deleteUser.php" method="POST">
                    <label>Id : </label>
                    <input readonly name="id_u" value="<?php echo $resultat->id_user; ?>">
                    <br><br>
                    <label>Nom : </label>
                    <input readonly value="<?php echo $resultat->nom; ?>">
                    <br><br>
                    <label>Prénom : </label>
                    <input readonly value="<?php echo $resultat->prenom; ?>">
                    <br><br>
                    <label>Pseudo : </label>
                    <input readonly value="<?php echo $resultat->pseudo; ?>">
                    <br><br>
                    <label>Mot de passe: </label>
                    <input readonly value="<?php echo $resultat->mot_de_passe; ?>">
                    <br><br>
                    <label>Age : </label>
                    <input readonly value="<?php echo $resultat->age; ?>">
                    <br><br>

                    <button class="btn-form-log" type="submit" name="delete">Supprimer</button>

                </form>
            <?php elseif (isset($_POST['id_user'])):
                echo "Utilisateur " . $_POST['id_user'] . " introuvable <br>"; ?>
            <?php endif; ?>
        </div>
        <br>
    </section>
    <?php
    require_once "footer.php";
    ?>