<?php
$title = "Create User";
$nav = "createUser";
require "header.php";
if (!is_connected()) {
    header("location: ./login.php");
}
require "bd.php";
?>
<center><b>
        <h1>Add User</h1>
    </b></center>
<div align="center">
    <div class="col-6">
        <?php

        if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['pseudo']) && !empty($_POST['mot_de_passe']) && !empty($_POST['age'])):


            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $pseudo = $_POST['pseudo'];
            $mot_de_passe = $_POST['mot_de_passe'];
            $age = $_POST['age'];

            try {
                $req = $pdo->prepare('INSERT INTO utilisateurs VALUES(:id_user, :nom, :prenom, :pseudo, :mot_de_passe, :age)');
                $req->execute(array(
                    'id_user' => NULL,
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'pseudo' => $pseudo,
                    'mot_de_passe' => $mot_de_passe,
                    'age' => $age,
                ));
                echo "L'utilisateur " . $nom . " " . $prenom . " a été ajouté<br>";
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }

        else:
            echo "Veuillez remplir les champs correctement";
        endif;

        ?>

        <form action="./createUser.php" method="POST">
            <input type="text" name="nom" placeholder="Nom" required>
            <br>
            <input type="text" name="prenom" placeholder="Prénom" required>
            <br>
            <input type="text" name="pseudo" placeholder="Pseudo" required>
            <br>
            <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
            <br>
            <input type="number" name="age" placeholder="Age" required>
            <br><br>
            <!-- <select name="ville" required>
                <option value="Bruxelles">Bruxelles</option>
                <option value="Bologna">Bologna</option>
                <option value="Charlroi">Charlroi</option>
            </select> -->
            <br>

            <button class="btn-form-log" type="submit">Ajouter</button>
        </form>
        <br>
    </div>
</div>

<?php

require "footer.php";

?>