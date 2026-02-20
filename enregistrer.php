<?php
$title = "Create User";
$nav = "createUser";
require "header.php";


require "bd.php";
?>
<center><b>
        <h1>Add User</h1>
    </b></center>
<div align="center">
    <div class="col-6">
        <?php

        if (!empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['genre']) && !empty($_POST['dateNaiss']) && !empty($_POST['ville']) && !empty($_POST['poids'])):

            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $pseudo = $_POST['pseudo'];
            $mot_de_passe = $_POST['mot_de_passe'];
            $age = $_POST['age'];

            try {
                $req = $pdo->prepare('INSERT INTO users VALUES(:id_user, :nom, :prenom, :pseudo, :mot_de_passe, :age)');
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
            <input type="text" name="prenom" placeholder="Prenom" required>
            <br>
            <select name="ville" required>
                <option value="M">Homme</option>
                <option value="F">Femme</option>
                <option value="X">Autre</option>
            </select>
            <br>
            <input type="date" name="dateNaiss" placeholder="date de naissance" required>
            <br>
            <input type="text" name="ville" placeholder="ville" required>
            <br>
            <input type="number" name="poids" placeholder="poids" required>
            <br>

            <button class="btn btn-primary" type="submit">Ajouter</button>
        </form>
    </div>
</div>

<?php

require "footer.php";

?>