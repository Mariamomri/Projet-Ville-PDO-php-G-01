<?php
$nav = "updateuser";
$title = "Update User";
$erreur = null;
$resultat = NULL;
require "header.php";
require "bd.php";
 
    if (!is_connected()){
        header("Location: login.php");
    }

    if (!empty($_POST['id_user'])){ 
        try{
            $req = $pdo->query('SELECT * FROM users WHERE id_user = "'.$_POST['id_user'].'";');
            //ici on utilise le fetch sans le ALL, il renvoi juste un seul objet.
            $resultat = $req->fetch(PDO::FETCH_OBJ);
        }catch (PDOException $e){
            die("Erreur : " . $e->getMessage());
        }
    }

    if(!empty($_POST['prenom']) && !empty($_POST['nom'])&& !empty($_POST['genre'])&& !empty($_POST['date_de_naiss'])&& !empty($_POST['ville'])&& !empty($_POST['poids'])){
        try{
            $req = $pdo->prepare('UPDATE users SET firstname = :prenom, lastname = :nom,gender = :genre ,date_of_birth = :date_naiss,city = :ville,weight_kg = :poids WHERE id_user = :id');
            $req->execute(array(
                'id' => $_POST['id'],
                'prenom' => $_POST['prenom'],
                'nom' => $_POST['nom'],
                'genre' => $_POST['genre'],
                'date_naiss' => $_POST['date_de_naiss'],
                'ville' => $_POST['ville'],
                'poids' => $_POST['poids']
            ));
            echo "Modification de l'utilisateur ".$_POST['id']. " réussi !<br>";
        }catch (PDOException $e){
            die("Erreur : " . $e->getMessage());
        }
    }
    
?>
<body>
    <div align="center">
        </br>
        <h1>Update User</h1>
        <br>
        <form action = "updateUser.php" method = "POST">
    <input type = "number" name = "id_user" placeholder= "Entrez l'id de l'user">
    <button type = "submit">Rechercher</button>
</form>
<?php if(isset($resultat) && $resultat != false):?>
        <form action = "updateUser.php" method = "POST">
            <label>Id : </label>
            <input readonly  name = 'id' value="<?php echo $resultat->id_user;?>">
            <br>
            <label>Prénom : </label>
            <input type="text" name="prenom" value="<?php echo $resultat->firstname;?>">
            <br>
            <label>Nom : </label>
            <input type="text" name="nom" value="<?php echo $resultat->lastname;?>">
            <br>
            <label>Genre : </label>
            <select name="genre" >
                <optgroup label="Genre"> 
                    <option value = "<?php echo $resultat->gender;?>">
                        <?php echo $resultat->gender;?></option>
                </optgroup>
                <optgroup label="Choix dispo">
                    <option value = "M">Homme</option>
                    <option value = "F">Femme</option> 
                    <option value = "X">Autre</option> 
                </optgroup>
            </select>
            
            <br>
            <label>Date de Naissance : </label>
            <input type="date" id="date_of_birth" name="date_de_naiss" value="<?php 
            $datetime = new DateTime($resultat->date_of_birth);
            $date = $datetime->format('Y-m-d');
            echo $date;
            ?>">
            <br>
            <label>Ville : </label>
            <input type="text" name="ville" value="<?php echo $resultat->city;?>">
            <br>
            <label>Poids : </label>
            <input type="number" name="poids" value="<?php echo $resultat->weight_kg ;?>">
            <br>
           
            <button class="btn btn-primary" type="submit">Enregistrer</button>
        </form>
    <?php elseif(isset($_POST['id_user'])): 
            echo "Utilisateur ". $_POST['id_user'] . " introuvable <br>";?>
    <?php endif;?>
    </div>
    <?php
    require_once "footer.php";
?>