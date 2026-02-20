<?php
session_start();
$title = "List Of Users";
$nav = "listUsers";
require_once "./functions/autentifications.php"; 

if (!is_connected()) {
    header("location: ./login.php");
    exit;
}
require "header.php";
require "bd.php";

// changer le pays en nationalité
function getNationalite($pays) {
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
        return $map[$pays]; // si pays dans liste
    } else {
        return $pays; // sinon retourne nom du pays
    }
}

?>

<center><h1 style="color:white">List of Users from db(ville_php)</h1></center>

<?php
try {
    $resultat = $pdo->query("
        SELECT u.id_user, u.nom, u.prenom, u.pseudo, u.mot_de_passe, u.age,
               v.nom AS ville, v.pays
        FROM utilisateurs u
        LEFT JOIN villes v ON u.id_ville = v.id_ville
    ");
    $tabUsers = $resultat->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
?>

<div align="center">
    <div class="col-8">
        <table class="table table-responsive table-hover table-striped table-dark table-bordered">
            <thead class="bg-dark text-white">
                <tr align="center">
                    <th>Id User</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Pseudo</th>
                    <th style="width: 180px;">Mot de passe</th>
                    <th>Âge</th>
                    <th>Ville</th>
                    <th>Nationalité</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tabUsers as $user) { ?>
                    <tr align="center">
                        <td><?= $user->id_user ?></td>
                        <td><?= $user->nom ?></td>
                        <td><?= $user->prenom ?></td>
                        <td><?= $user->pseudo ?></td>
                        <td><?= $user->mot_de_passe ?></td>
                        <td><?= $user->age ?></td>
                        <td><?= $user->ville ?></td>
                        <td><?= getNationalite($user->pays) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php
require "footer.php";
?>
