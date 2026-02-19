<?php
    $title = "Create User";
    $nav = "createUser";
    require "header.php";
    if (!is_connected()){
        header("location: ./login.php");
    }
    require "bd.php";
?>
<center><b><h1>Add User</h1></b></center>
<div align="center">
        <div class="col-6">
<?php

    if (!empty($_POST['prenom']) && !empty($_POST['nom'])&& !empty($_POST['genre'])&& !empty($_POST['dateNaiss'])&& !empty($_POST['ville'])&& !empty($_POST['poids'])):

   
     $firstname = $_POST['prenom'];
     $lastname =$_POST['nom'];
     $gender = $_POST['genre'];
    $date_of_birth = $_POST['dateNaiss'];
    $city = $_POST['ville']; 
    $weight_kg = $_POST['poids'];

    try{
        $req = $pdo->prepare('INSERT INTO users VALUES(:id_user, :firstname, :lastname, :gender, :date_of_birth, :city, :weight_kg)');
        $req->execute(array(
            'id_user' => NULL, 
            'firstname' => $firstname,
            'lastname' => $lastname,
            'gender' => $gender,
            'date_of_birth' => $date_of_birth,
            'city' => $city,
            'weight_kg' => $weight_kg,
        ));
        echo "L'utilisateur " . $firstname . " " . $lastname . " a été ajouté<br>";
    }catch (PDOException $e){
        echo "Erreur : " . $e->getMessage();
    }

    else:
        echo "Veuillez remplir les champs correctement";
    endif;

    ?>
    
            <form action="./createUser.php" method="POST">
                <input type="text" name="prenom" placeholder="prénom" required>
                <br>
                <input type="text" name="nom" placeholder="nom" required>
                <br>
                <select name="genre" required>
                    <option value = "M">Homme</option>
                    <option value = "F">Femme</option> 
                    <option value = "X">Autre</option> 
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