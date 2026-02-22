<?php
session_start();
$nav = "login";
$title = "Login";
require_once "./functions/autentifications.php";

if (is_connected()) {
    header("Location: ./profile.php");
    exit;
}

$error = "";

if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
    require "bd.php";
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE pseudo = :pseudo");
        $stmt->execute(['pseudo' => $pseudo]);
        $user = $stmt->fetch(PDO::FETCH_OBJ);

        if ($user && $password === $user->mot_de_passe) {
            $_SESSION['user_id'] = $user->id_user;
            $_SESSION['pseudo'] = $user->pseudo;
            $_SESSION['connected'] = true;
            header("Location: ./profile.php");
            exit;
        } else {
            $error = "Pseudo ou mot de passe incorrect !";
        }
    } catch (PDOException $e) {
        die("Erreur SQL : " . $e->getMessage());
    }
}

require "bd.php";
require "header.php"; // ← HTML seulement ici
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