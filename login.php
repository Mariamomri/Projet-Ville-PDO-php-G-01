<?php
session_start();
$nav = "login";
$title = "Login";
// $erreur = null;

require "bd.php";
require "classes/Utilisateur.php";



require "header.php";

if (is_connected()) {
    header("Location: ./monProfil.php");
    exit;
}
?>


<main class="main login-main">



    <section>
        <?php



        // funtcion password_verify() compaire le duex psw se sont les meme

        if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {

            //recuper les donnee dans imput 
            $pseudo = $_POST['pseudo'];
            $password = $_POST['password'];

            // chercher dans bd sql et eviter sql injection
            $sql = "SELECT * FROM utilisateurs WHERE pseudo= :pseudo";
            $trova = $pdo->prepare($sql);
            $trova->execute(['pseudo' => $pseudo]);

            // fetch recupera il resultato e l'oggetto
            $user = $trova->fetch(PDO::FETCH_OBJ);


            // on verifie se le psw est la meme
            if ($user) {

                if ($password === $user->mot_de_passe) { // oppure password_verify() plus sicure

                    $_SESSION['pseudo'] = $user->pseudo;
                    $_SESSION['connected'] = true;

                    header("Location: ./profile.php");
                    exit;
                } else {
                    echo  "<p class='textError'>Pseudo ou Mot de passe incorrect1 !</p>";
                } // in questo non mostra l'errore perche da user null quindi add un'altro else
            } else {
                echo "<p class='textError'>Pseudo ou Mot de passe incorrect !</p>";
            }
        }




        // version password_verify() non funziona verificare con julien il codice giù
        //     if ($user && password_verify($password, $user->mot_de_passe)) {

        //         $_SESSION['pseudo'] = $user->pseudo;
        //         $_SESSION['connected'] = true;

        //         header("Location: ./profile.php");
        //         exit;
        //     } else {
        //         $erreur = "<p class='textError'>Pseudo ou Mot de passe incorrect!</p>";
        //     }
        // }

        ?>
        <div class="login">
            <h1>Login</h1>
            <br>
            <section class="card">
                <form action="./login.php" method="POST">
                    <input type="text" name="pseudo" placeholder="Entrez votre pseudo" required>
                    <br>
                    <input type="password" name="password" placeholder="Entrez votre password" required>
                    <br>
                    <button type="submit" class="btn-form-log">Se connecter</button>

                </form>

                <form action="./enregistrer.php" method="POST">
                    <button type="submit" class="btn-form-log">S'enregistrer</button>
                </form>
            </section>
        </div>

    </section>
</main>

<?php
require "footer.php";
?>