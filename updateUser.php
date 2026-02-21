<?php
$nav = "updateuser";
$title = "Update User";
$erreur = null;
$resultat = NULL;
require "header.php";
require "bd.php";

if (!is_connected()) {
    header("Location: login.php");
}

if (!empty($_POST['id_user'])) {
    try {
        $req = $pdo->prepare('SELECT * FROM utilisateurs WHERE id_user = :id');
        $req->execute(['id' => $_POST['id_user']]);
        $resultat = $req->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}

if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['pseudo']) && !empty($_POST['mot_de_passe']) && !empty($_POST['age'])) {
    try {
        $req = $pdo->prepare('UPDATE utilisateurs SET nom = :nom, prenom = :prenom, pseudo = :pseudo, mot_de_passe = :mot_de_passe, age = :age, id_user_ville = :id_user_ville WHERE id_user = :id');
        $req->execute([
            'id' => $_POST['id'],
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'pseudo' => $_POST['pseudo'],
            'mot_de_passe' => $_POST['mot_de_passe'],
            'age' => $_POST['age'],
            'id_user_ville' => $_POST['ville']
        ]);
        echo "Modification de l'utilisateur " . $_POST['id'] . " réussie !<br>";
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}

// Récupérer les villes
$villes = $pdo->query("SELECT * FROM villes ORDER BY nom")->fetchAll(PDO::FETCH_OBJ);
?>

<div align="center">
    <h1>Update User</h1>
    <br>
    <form action="updateUser.php" method="POST">
        <input type="number" name="id_user" placeholder="Entrez l'id de l'user">
        <button type="submit" class="btn-form-log">Rechercher</button>
    </form>
<br><br>

    <?php if (isset($resultat) && $resultat != false): ?>
        <form action="updateUser.php" method="POST">
            <label>Id : </label>
            <input readonly name='id' value="<?= $resultat->id_user ?>"><br>
            <label>Nom : </label>
            <input type="text" name="nom" value="<?= $resultat->nom ?>"><br>
            <label>Prénom : </label>
            <input type="text" name="prenom" value="<?= $resultat->prenom ?>"><br>
            <label>Pseudo : </label>
            <input type="text" name="pseudo" value="<?= $resultat->pseudo ?>"><br>
            <label>Mot de Passe : </label>
            <input type="password" name="mot_de_passe" value="<?= $resultat->mot_de_passe ?>"><br>
            <label>Age : </label>
            <input type="text" name="age" value="<?= $resultat->age ?>"><br>
            <label>Ville : </label>
            <select name="ville">
                <?php foreach ($villes as $ville): ?>
                    <option value="<?= $ville->id_ville ?>" <?= ($ville->id_ville == $resultat->id_user_ville) ? 'selected' : '' ?>>
                        <?= $ville->nom ?> (<?= $ville->pays ?>)
                    </option>
                <?php endforeach; ?>
              
            </select><br><br>
            <button class="btn-form-log" type="submit">Update</button>
        </form>
    <?php elseif (isset($_POST['id_user'])): ?>
        <p>Utilisateur <?= $_POST['id_user'] ?> introuvable</p>
    <?php endif; ?>
</div>

<?php require_once "footer.php"; ?>