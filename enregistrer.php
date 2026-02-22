<?php

session_start();

$title = "Enregistrement";
$nav = "createUser";
require "header.php";
require "bd.php";
require "classes/Utilisateur.php";

// Récupérer toutes les villes
try {
    $stmt = $pdo->query('SELECT * FROM villes ORDER BY nom');
    $villes = $stmt->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

// Traitement du formulaire
if (!empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['pseudo']) && !empty($_POST['mot_de_passe']) && !empty($_POST['age']) && !empty($_POST['ville'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $pseudo = $_POST['pseudo'];
    $mot_de_passe = $_POST['mot_de_passe']; // en clair
    $age = $_POST['age'];
    $id_user_ville = $_POST['ville'];

    try {
        $req = $pdo->prepare('INSERT INTO utilisateurs (nom, prenom, pseudo, mot_de_passe, age, id_user_ville) 
        VALUES(:nom, :prenom, :pseudo, :mot_de_passe, :age, :id_user_ville)');
        $req->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'pseudo' => $pseudo,
            'mot_de_passe' => $mot_de_passe,
            'age' => $age,
            'id_user_ville' => $id_user_ville
        ]);
        echo "<p>L'utilisateur $prenom $nom a été ajouté !</p>";
    } catch (PDOException $e) {
        echo "<p>Erreur : " . $e->getMessage() . "</p>";
    }
}
?>
<section class="yellow">
    <center>
        <br>
        <h1>Enregistrement</h1>
    </center>
    <div align="center">
        <div class="col-6">
            <form action="" method="POST">
                <br>
                <input type="text" name="nom" placeholder="Nom" required><br><br>
                <input type="text" name="prenom" placeholder="Prénom" required><br><br>
                <input type="text" name="pseudo" placeholder="Pseudo" required><br><br>
                <input type="password" name="mot_de_passe" placeholder="Mot de passe" required><br><br>
                <input type="number" name="age" placeholder="Age" required><br><br>
                <select name="ville" required>
                    <option value="">-- Sélectionnez une ville --</option>
                    <?php foreach ($villes as $v): ?>
                        <?php
                        $villeObj = new Ville($v->id_ville, $v->nom, $v->pays, $v->capitale);
                        ?>
                        <option value="<?= $villeObj->getIdVille() ?>">
                            <?= $villeObj->getNom() ?> (<?= $villeObj->getNationalite() ?>)
                        </option>
                    <?php endforeach; ?>


                </select><br><br>

                <button class="btn-form-log" type="submit">S'enregistrer</button><br><br>
            </form><br>
        </div><br>
    </div>
</section>

<?php require "footer.php"; ?>