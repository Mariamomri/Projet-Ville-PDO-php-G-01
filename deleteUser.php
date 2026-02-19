<?php
$nav = "deleteuser";
$title = "delete User";
$erreur = null;
$resultat = NULL;
require "header.php";
require "bd.php";
if (!is_connected()) {
    header("Location: login.php");
}

if (!empty($_POST['id_user'])) {
    try {
        $req = $pdo->query('SELECT * FROM utilisateurs WHERE id_user = "' . $_POST['id_user'] . '";');
        //ici on utilise le fetch sans le ALL, il renvoi juste un seul objet.
        $resultat = $req->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}
if (isset($_POST['delete'])) {
    try {
        $req = $pdo->prepare('DELETE FROM utilisateurs WHERE id_user = "' . $_POST['id_u'] . '"');
        $req->execute();
        echo "Suppression réussie de l'utilisateur " . $_POST['id_u'] . " !<br>";
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}
?>

<body>
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
    <?php
    require_once "footer.php";
    ?>