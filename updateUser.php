<?php
$nav = "updateuser";
$title = "Update User";
$erreur = null;
$resultat = NULL;

require "header.php";
require "bd.php";
require "classes/Ville.php";

if (!is_connected()) {
    header("Location: login.php");
}

// Récupérer toutes les villes
try {
    $stmt = $pdo->query('SELECT * FROM villes ORDER BY nom');
    $villes = $stmt->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

// Recherche utilisateur
if (!empty($_POST['id_user'])) {
    try {
        $req = $pdo->query('SELECT * FROM utilisateurs WHERE id_user = "' . $_POST['id_user'] . '";');
        $resultat = $req->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}

// Update utilisateur
if (
    !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['pseudo'])
    && !empty($_POST['mot_de_passe']) && !empty($_POST['age']) && !empty($_POST['id_user_ville'])
) {

    try {
        $req = $pdo->prepare('UPDATE utilisateurs 
            SET nom = :nom, prenom = :prenom, pseudo = :pseudo, mot_de_passe = :mot_de_passe, 
                age = :age, id_user_ville = :id_user_ville 
            WHERE id_user = :id');

        $req->execute([
            'id' => $_POST['id'],
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'pseudo' => $_POST['pseudo'],
            'mot_de_passe' => $_POST['mot_de_passe'],
            'age' => $_POST['age'],
            'id_user_ville' => $_POST['id_user_ville']
        ]);

        echo "Modification de l'utilisateur " . $_POST['id'] . " réussi !<br>";
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}
?>

<body>

    <section class="yellow">
        <div align="center">
            <br>
            <h1>Update User</h1>
            <br>

            <!-- Form recherche -->
            <form action="updateUser.php" method="POST">
                <input type="number" name="id_user" placeholder="Entrez l'id de l'user">
                <br>
                <button type="submit" class="btn-form-log">Rechercher</button>
            </form>

            <!-- Form update -->
            <?php if (isset($resultat) && $resultat != false): ?>

                <form action="updateUser.php" method="POST">
                    <br>
                    <label>Id : </label>
                    <input readonly name='id' value="<?= $resultat->id_user; ?>">
                    <br><br>

                    <label>Nom : </label>
                    <input type="text" name="nom" value="<?= $resultat->nom; ?>">
                    <br><br>

                    <label>Prénom : </label>
                    <input type="text" name="prenom" value="<?= $resultat->prenom; ?>">
                    <br><br>

                    <label>Pseudo: </label>
                    <input type="text" name="pseudo" value="<?= $resultat->pseudo; ?>">
                    <br><br>

                    <label>Mot de Passe: </label>
                    <input type="password" name="mot_de_passe" value="<?= $resultat->mot_de_passe; ?>">
                    <br><br>

                    <label>Age : </label>
                    <input type="text" name="age" value="<?= $resultat->age; ?>">
                    <br><br>

                    <!-- Select Ville -->
                    <label>Ville :</label>
                    <select name="id_user_ville" required>
                        <option value="">-- Sélectionnez une ville --</option>

                        <?php foreach ($villes as $v): ?>
                            <?php
                            $villeObj = new Ville($v->id_ville, $v->nom, $v->pays, $v->capitale);
                            $selected = ($v->id_ville == $resultat->id_user_ville) ? "selected" : "";
                            ?>
                            <option value="<?= $villeObj->getIdVille() ?>" <?= $selected ?>>
                                <?= $villeObj->getNom() ?> (<?= $villeObj->getNationalite() ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <br><br>

                    <button class="btn-form-log" type="submit">Update</button>
                </form>

            <?php elseif (isset($_POST['id_user'])): ?>
                <?= "Utilisateur " . $_POST['id_user'] . " introuvable <br>"; ?>
            <?php endif; ?>

        </div>
        <br>
    </section>

    <?php require_once "footer.php"; ?>