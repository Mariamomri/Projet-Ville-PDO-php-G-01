<?php
$title = "Find User";
$nav = "findUser";
require "header.php";
if (!is_connected()) {
    header("location: ./login.php");
}
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
                    $resultat = $pdo->query("SELECT * FROM utilisateurs WHERE id_user = " . $_POST['id']);
                    $user = $resultat->fetch(PDO::FETCH_OBJ);
                    if (!$user) {
                        echo "Utilisateur " . $_POST['id'] .  " non trouvé";
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
                    <input readonly value="<?php echo $user->id_user; ?>">
                    <br><br>
                    <label>Nom : </label>
                    <input readonly value="<?php echo $user->nom; ?>">
                    <br><br>
                    <label>Prénom : </label>
                    <input readonly value="<?php echo $user->prenom; ?>">
                    <br><br>
                    <label>Pseudo : </label>
                    <input readonly value="<?php echo $user->pseudo; ?>">
                    <br><br>
                    <label>Mot de Passe : </label>
                    <input readonly value="<?php echo "xxxxxx" ?>">
                    <br><br>
                    <label>Age: </label>
                    <input readonly value="<?php echo $user->age; ?>">
                    <br>
                </form>
                <br>

            <?php endif; ?>
        </div>
        <br>
</section>
</div>

<?php

require "footer.php";

?>