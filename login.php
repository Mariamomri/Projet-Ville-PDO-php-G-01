<?php
session_start();
$nav = "login";
$title = "Login";

// connexion à la base
require "bd.php";  

require "header.php";

if (isset($_SESSION['user_id'])) {
    header("Location: ./profile.php");
    exit;
}

$error = "";

if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];

    try {
        // récupérer l'utilisateur
        $sql = "SELECT * FROM utilisateurs WHERE pseudo = '$pseudo'";
        $result = $pdo->query($sql);
        $user = $result->fetch(PDO::FETCH_OBJ);

        if ($user) {
            // Comparaison du mdp
            if ($password === $user->mot_de_passe) {
                $_SESSION['user_id'] = $user->id;
                $_SESSION['pseudo'] = $user->pseudo;
                $_SESSION['connected'] = true;

                header("Location: ./profile.php");
                exit;
            } else {
                $error = "Pseudo ou mot de passe incorrect !";
            }
        } else {
            $error = "Pseudo ou mot de passe incorrect !";
        }
    } catch (PDOException $e) {
        die("Erreur SQL : " . $e->getMessage());
    }
}
?>

<main class="main login-main">
    <section>
        <div class="login">
            <h1>Login</h1>
            <br>
            <section class="card">
                <?php if ($error) echo "<p class='textError'>$error</p>"; ?>
                
                <form action="" method="POST">
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
