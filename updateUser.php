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
        $req = $pdo->query('SELECT * FROM utilisateurs WHERE id_user = "' . $_POST['id_user'] . '";');
        //ici on utilise le fetch sans le ALL, il renvoi juste un seul objet.
        $resultat = $req->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}

if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['pseudo']) && !empty($_POST['mot_de_passe']) && !empty($_POST['age'])) {
    try {
        $req = $pdo->prepare('UPDATE utilisateurs SET nom = :nom, prenom= :prenom,pseudo = :pseudo ,mot_de_passe = :mot_de_passe,age = :age WHERE id_user = :id');
        $req->execute(array(
            'id' => $_POST['id'],
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'pseudo' => $_POST['pseudo'],
            'mot_de_passe' => $_POST['mot_de_passe'],
            'age' => $_POST['age']
        ));
        echo "Modification de l'utilisateur " . $_POST['id'] . " réussi !<br>";
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}

?>

<body>
    <div align="center">
        </br>
        <h1>Update User</h1>
        <br>
        <form action="updateUser.php" method="POST">
            <input type="number" name="id_user" placeholder="Entrez l'id de l'user">
            <button type="submit">Rechercher</button>
        </form>
        <?php if (isset($resultat) && $resultat != false): ?>
            <form action="updateUser.php" method="POST">
                <label>Id : </label>
                <input readonly name='id' value="<?php echo $resultat->id_user; ?>">
                <br>
                <label>Nom : </label>
                <input type="text" name="nom" value="<?php echo $resultat->nom; ?>">
                <br>
                <label>Prénom : </label>
                <input type="text" name="prenom" value="<?php echo $resultat->prenom; ?>">
                <br>
                <label>Pseudo: </label>
                <input type="text" name="pseudo" value="<?php echo $resultat->pseudo; ?>">
                <br>
                <label>Mot de Passe: </label>
                <input type="password" name="mot_de_passe" value="<?php echo "$resultat->mot_de_passe"; ?>">
                <br>
                <label>Age : </label>
                <input type="text" name="age" value="<?php echo $resultat->age; ?>">
                <br>
                <!-- in caso vogliamo inserire le citta -->
                <!-- <label>Ville : </label>
                <select name="ville">
                    <optgroup label="Ville">
                        <option value="<?php //echo $resultat->ville; 
                                        ?>">
                            <?php //echo $resultat->ville; 
                            ?></option>
                    </optgroup>
                    <optgroup label="Choix dispo">
                        <option value="Bruxelles">Bruxelles</option>
                        <option value="Bologna">Bologna</option>
                        <option value="Charlroi">Charlroi</option>
                    </optgroup>
                </select> -->

                <button class="btn-form-log" type="submit">Update</button>
            </form>
        <?php elseif (isset($_POST['id_user'])):
            echo "Utilisateur " . $_POST['id_user'] . " introuvable <br>"; ?>
        <?php endif; ?>
    </div>
    <?php
    require_once "footer.php";
    ?>