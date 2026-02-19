<?php
    $title = "Find User";
    $nav = "findUser";
    require "header.php";
    if (!is_connected()){
        header("location: ./login.php");
    }
    require "bd.php";
?>
<center><b><h1>Find User</h1></b></center>
<div align="center">
        <div class="col-6">
<?php

    if (!empty($_POST['id'])):
        try{
            $resultat = $pdo->query("SELECT * FROM users WHERE id_user = ".$_POST['id']);
            $user = $resultat->fetch(PDO::FETCH_OBJ);
            if(!$user){  
                echo "Utilisateur " . $_POST['id'].  " non trouvé";
            } 
        }catch (PDOException $e){
            echo "Erreur : " . $e->getMessage();
        }
    endif;
     
    ?>
    
            <form action="./findUser.php" method="POST">
                <input type="number" name="id" placeholder="id user" required>
                <br>
                
                <button class="btn btn-primary" type="submit">Rechercher</button> 
            </form>

            <?php if(isset($user) && $user != false):?>
        <form >
            <br>
            <label>Id : </label>
            <input readonly value="<?php echo $user->id_user;?>">
            <br>
            <label>Prénom : </label>
            <input readonly value="<?php echo $user->firstname;?>">
            <br>
            <label>Nom : </label>
            <input readonly value="<?php echo $user->lastname;?>">
            <br>
            <label>Genre : </label>
            <input readonly value="<?php echo $user->gender;?>">
            <br>
            <label>Date de Naissance : </label>
            <input readonly value="<?php 
            $datetime = new DateTime($user->date_of_birth);
            $date = $datetime->format('d-m-Y');
            echo $date;
            ?>">
            <br>
            <label>Ville : </label>
            <input readonly value="<?php echo $user->city;?>">
            <br>
            <label>Poids : </label>
            <input readonly value="<?php echo $user->weight_kg . " Kg";?>">
            <br>
        </form>
    
    <?php endif;?>
        </div>
    </div>

<?php

    require "footer.php";

?>