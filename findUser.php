<?php
$title = "Find User";
$nav = "findUser";
require "header.php";
if (!is_connected()) {
    header("location: ./login.php");
    exit;
}
require "bd.php";

// Fonction nationalité
function getNationalite($pays)
{
    $map = [
        "France" => "Française",
        "Belgique" => "Belge",
        "Allemagne" => "Allemande",
        "Espagne" => "Espagnole",
        "Italie" => "Italienne",
        "Portugal" => "Portugaise",
        "Pays-Bas" => "Néerlandaise",
        "Autriche" => "Autrichienne",
        "Pologne" => "Polonaise",
        "Grèce" => "Grecque"
    ];

    if (isset($map[$pays])) {
        return $map[$pays];
    } else {
        return $pays;
    }
}
?>

<section class="yellow">
    <center>
        <h1>Find User</h1>
    </center>
    <div align="center">
        <div class="col-6">
            <?php
            $user = null;
            if (!empty($_POST['id'])):
                try {
                    $stmt = $pdo->prepare("
                        SELECT u.*, v.nom AS ville, v.pays
                        FROM utilisateurs u
                        LEFT JOIN villes v ON u.id_ville = v.id_ville
                        WHERE u.id_user = :id
                    ");
                    $stmt->execute(['id' => $_POST['id']]);
                    $user = $stmt->fetch(PDO::FETCH_OBJ);

                    if (!$user) {
                        echo "<p>Utilisateur " . $_POST['id'] . " non trouvé</p>";
                    }
                } catch (PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }
            endif;
            ?>

            <form action="./findUser.php" method="POST">
                <input type="number" name="id" placeholder="id user" required>
                <br>
                <button class="btn-form-log" type="submit">Rechercher</button>
            </form>

            <?php if ($user): ?>
                <form>
                    <br>
                    <label>Id : </label>
                    <input readonly value="<?= $user->id_user; ?>">
                    <br>
                    <label>Nom : </label>
                    <input readonly value="<?= $user->nom; ?>">
                    <br>
                    <label>Prénom : </label>
                    <input readonly value="<?= $user->prenom; ?>">
                    <br>
                    <label>Pseudo : </label>
                    <input readonly value="<?= $user->pseudo; ?>">
                    <br>
                    <label>Mot de Passe : </label>
                    <input readonly value="xxxxxx">
                    <br>
                    <label>Age: </label>
                    <input readonly value="<?= $user->age; ?>">
                    <br>
                    <label>Ville: </label>
                    <input readonly value="<?= $user->ville; ?>">
                    <br>
                    <label>Nationalité: </label>
                    <input readonly value="<?= getNationalite($user->pays); ?>">
                    <br>
                </form>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
require "footer.php";
?>