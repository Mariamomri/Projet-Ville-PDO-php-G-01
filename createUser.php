<?php
session_start();
$title = "Create User";
$nav = "createUser";
require "header.php";
if (!is_connected()) {
    header("location: ./login.php");
}
require "header.php";
require "bd.php";
?>
<section class="yellow">
    <center><b>
            <br>
            <h1>Add User</h1>
        </b></center>
    <div align="center">
        <div class="col-6">
            <?php

            if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['pseudo']) && !empty($_POST['mot_de_passe']) && !empty($_POST['age']) && !empty($_POST['ville'])):


                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $pseudo = $_POST['pseudo'];
                $mot_de_passe = $_POST['mot_de_passe'];
                $age = $_POST['age'];
                $id_ville = $_POST['ville'];

                try {
                    $req = $pdo->prepare('INSERT INTO utilisateurs VALUES(:id_user, :nom, :prenom, :pseudo, :mot_de_passe, :age, :id_user_ville)');
                    $req->execute(array(
                        'id_user' => NULL,
                        'nom' => $nom,
                        'prenom' => $prenom,
                        'pseudo' => $pseudo,
                        'mot_de_passe' => $mot_de_passe,
                        'age' => $age,
                        'id_user_ville' => $id_ville
                    ));
                    echo "L'utilisateur " . $nom . " " . $prenom . " a été ajouté<br>";
                } catch (PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }

            else:
                if (!empty($_POST)):
                    echo "Veuillez remplir les champs correctement";
                endif;
            endif;

            // Récupérer les villes
            $villes = $pdo->query("SELECT * FROM villes ORDER BY nom")->fetchAll(PDO::FETCH_OBJ);

            ?>

            <form action="./createUser.php" method="POST">
                <br>
                <input type="text" name="nom" placeholder="Nom" required>
                <br> <br>
                <input type="text" name="prenom" placeholder="Prénom" required>
                <br> <br>
                <input type="text" name="pseudo" placeholder="Pseudo" required>
                <br> <br>
                <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
                <br> <br>
                <input type="number" name="age" placeholder="Age" required>
                <br> <br>
                <select name="ville" required>
                    <option value="">-- Sélectionnez une ville --</option>
                    <?php foreach ($villes as $ville): ?>
                        <option value="<?= $ville->id_ville ?>"><?= $ville->nom ?> (<?= $ville->pays ?>)</option>
                    <?php endforeach; ?>
                </select>
                <br><br>
                <br>

                <button class="btn-form-log" type="submit">Ajouter</button>
            </form>
            <br>
        </div>
    </div>
</section>
<?php
require "footer.php";
?>