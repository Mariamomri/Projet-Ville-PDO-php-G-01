<?php
$title = "Find User";
$nav = "findUser";
require "header.php";
if (!is_connected()) {
    header("location: ./login.php");
}
require_once "classes/Villes.php";
require "bd.php";

?>
<section class="yellow">
    <center><b>
            <br>
            <h1>Find User</h1>
        </b></center>
    <div align="center">
        <div class="col-6">
            <?php
            if (!empty($_POST['id'])):
                try {
                    $stmt = $pdo->prepare("
                    SELECT utilisateurs.*, villes.nom AS ville, villes.pays, villes.capitale
                    FROM utilisateurs
                    LEFT JOIN villes ON utilisateurs.id_user_ville = villes.id_ville
                    WHERE utilisateurs.id_user = :id
                ");
                    $stmt->execute(['id' => $_POST['id']]);
                    $user = $stmt->fetch(PDO::FETCH_OBJ);

                    if (!$user) {
                        echo "Utilisateur " . $_POST['id'] . " non trouvé";
                    }
                } catch (PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }
            endif;
            ?>

            <form action="./findUser.php" method="POST">
                <input type="number" name="id" placeholder="id user" required>
                <br>
                <button class="btn-form-log" type="submit">Rechercher</button>
            </form>

            <?php if (isset($user) && $user != false): ?>
                <form>
                    <br>
                    <label>Id : </label>
                    <input style="color:black" readonly value="<?= $user->id_user ?>"><br>
                    <label>Nom : </label>
                    <input style="color:black"readonly value="<?= $user->nom ?>"><br>
                    <label>Prénom : </label>
                    <input style="color:black" readonly value ="<?= $user->prenom ?>"><br>
                    <label>Pseudo : </label>
                    <input style="color:black"readonly value="<?= $user->pseudo ?>"><br>
                    <label>Mot de Passe : </label>
                    <input style="color:black" readonly value="xxxxxx"><br>
                    <label>Age : </label>
                    <input style="color:black" readonly value="<?= $user->age ?>"><br>
                    <label>Ville : </label>
                    <input style="color:black" readonly value="<?= $user->ville ?>"><br>
                    <label>Nationalité : </label>
                    <?php
                    $villeObj = new Villes($user->id_user_ville, $user->ville, $user->pays, $user->capitale);
                    ?>
                    <input style="color:black" readonly value="<?= $villeObj->getNationalite() ?>">
                </form>
                <br>
            <?php endif; ?>
        </div>
</section>
</div>

<?php

require "footer.php";

?>