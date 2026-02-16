<?php
$nav = "login";
$title = "Login";
$erreur = null;

require "db.php";
require "classes/Utilisateur.php";

if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
    if (($_POST['pseudo'] === "pseudo" && $_POST['password'] === "mot_de_passe'")) {
        session_start();
        $_SESSION['pseudo'] = $_POST['pseudo'];
        $_SESSION['connected'] = true;
        header("Location: ./profil.php");
    } else {
        $erreur = "<p class='textError'>Identifiants incorrects ! </p>";
    }
}
require "header.php";

if (is_connected()) {
    header("Location: ./monProfil.php");
}
?>


<main class="main login-main">

    <!--mostra il messaggio errore-->
    <?php if ($erreur) : ?>
        <div class="alert alert-danger"> <?php echo $erreur ?> </div>
    <?php endif; ?> <!--alert alert-danger"  est bootsrap-->

    <section>
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

                <form action="./s'enregistrer.php" method="POST">
                    <button type="submit" class="btn-form-log">S'enregistrer</button>
                </form>
            </section>
        </div>

    </section>
</main>

<?php
require "footer.php";
?>