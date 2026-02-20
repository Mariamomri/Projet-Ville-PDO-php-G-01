<?php
$title = "Create User";
$nav = "createUser";
require "header.php";
if (!is_connected()) {
    header("location: ./login.php");
}
require "bd.php";
?>

<center>
    <h1 style="color:white">Add User</h1>
</center>
<div align="center">
    <div class="col-6">
        <?php
        if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['pseudo']) && !empty($_POST['mot_de_passe']) && !empty($_POST['ville'])):

            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $pseudo = $_POST['pseudo'];
            $mot_de_passe = $_POST['mot_de_passe']; // en clair
            $id_ville = $_POST['ville'];

            try {
                $req = $pdo->prepare('INSERT INTO utilisateurs (id_user, nom, prenom, pseudo, mot_de_passe, id_ville) VALUES (:id_user, :nom, :prenom, :pseudo, :mot_de_passe, :id_ville)');
                $req->execute([
                    'id_user' => NULL,
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'pseudo' => $pseudo,
                    'mot_de_passe' => $mot_de_passe,
                    'id_ville' => $id_ville
                ]);
                echo "<p>L'utilisateur <b>$nom $prenom</b> a été ajouté avec succès.</p>";
            } catch (PDOException $e) {
                echo "<p>Erreur : " . $e->getMessage() . "</p>";
            }

        endif;

        // villes pour la liste déroulante
        try {
            $villes = $pdo->query("SELECT * FROM villes")->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die("Erreur récupération villes : " . $e->getMessage());
        }
        ?>

        <form action="./createUser.php" method="POST">
            <input type="text" name="nom" placeholder="Nom" required><br>
            <input type="text" name="prenom" placeholder="Prénom" required><br>
            <input type="text" name="pseudo" placeholder="Pseudo" required><br>
            <input type="password" name="mot_de_passe" placeholder="Mot de passe" required><br>
            <label>Ville :</label>
            <select name="ville" required>
                <option value="">-- Sélectionnez une ville --</option>
                <?php foreach ($villes as $ville): ?>
                    <option value="<?= $ville->id_ville ?>"><?= $ville->nom ?></option>
                <?php endforeach; ?>
            </select>
            <br><br>
            <button class="btn-form-log" type="submit">Ajouter</button>
        </form>
    </div>
</div>

<?php
require "footer.php";
?>