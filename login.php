<!-- Une page Login avec comme titre Login, qui permettra de vous loguez avec comme login :
votre prénom et votre mot de passe caché : cfitech. Si vous êtes déjà connecté et que vous
cliqué sur login il vous redirigera vers votre page de profile. -->

<?php
    $nav = "login"; 
    $title = "Login"; 
    $erreur = null; 
// per verificare se siamo connessi e ci riporta in un altro lingue  suluzione 1  e 2 sotto
    // solution 1
    // session_start();
    // if(isset($_SESSION['connected']) && $_SESSION['connected']){
    //    header("Location: ./monProfile.php");
    //}

    //solution 2
    // require "./functions/authentification.php";
    // if (is_connected()){
    //     header("Location: ./monProfile.php");
    // }

    if (!empty($_POST['pseudo']) && !empty($_POST['password'])){ 
        if ($_POST['pseudo'] === "Mariam" && $_POST['password'] === "cfitech"){ 
            session_start();
            $_SESSION['pseudo'] = $_POST['pseudo']; 
            $_SESSION['connected'] = true;
            header("Location: ./monProfil.php");
        }else { 
            $erreur = "<p class='textError'>Identifiants incorrects ! </p>"; 
        } 
    }

    require "header.php"; 

    if (is_connected()){
        header("Location: ./monProfil.php");
    }
?>


    <main class="main login-main">

        <!--mostra il messaggio errore-->
        <?php if ($erreur) :?> 
        <div class="alert alert-danger"> <?php echo $erreur ?> </div> 
        <?php endif; ?> <!--alert alert-danger"  est bootsrap-->
        
        <section >
        <div class="login">
            <h1>Login</h1>
                <br>
            <section class="card">
                <form action="./login.php" method="POST">
                    <input type="text" name="pseudo" placeholder="Entrez votre pseudo">
                    <br>
                    <input type="password" name="password" placeholder="Entrez votre password">
                    <br>
                    <button type="submit" class="btn-form-log">Se connecter</button>    
                </form>   
            </section>
        </div>

        </section>
    </main>

    <!-- navigation: home, calculatrice, mon profile sont dans page aside1 -->
    <?php
    require "aside1.php" ?>


    <!-- navigation: login et logout sont dans page aside2 -->
    <?php
    require "aside2.php" ?>
    

<?php 
    require "footer.php";
?>