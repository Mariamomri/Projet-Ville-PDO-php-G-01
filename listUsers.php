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
require_once "classes/Villes.php";
?>

<center>
    <h1 style="color:white">List of Users from db(ville_php)</h1>
</center>

<?php
try {
    $resultat = $pdo->query("
        SELECT utilisateurs.*, villes.nom AS ville, villes.pays, villes.capitale
        FROM utilisateurs
        LEFT JOIN villes ON utilisateurs.id_user_ville = villes.id_ville
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
                    <th>Prenom</th>
                    <th>Pseudo</th>
                    <th>Mot de passe</th>
                    <th>Age</th>
                    <th>Ville</th>
                    <th>Nationalité</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tabUsers as $user) { ?>
                    <?php $villeObj = new Villes($user->id_user_ville, $user->ville, $user->pays, $user->capitale); ?>
                    <tr align="center">
                        <td><?= $user->id_user ?></td>
                        <td><?= $user->nom ?></td>
                        <td><?= $user->prenom ?></td>
                        <td><?= $user->pseudo ?></td>
                        <td><?= $user->mot_de_passe ?></td>
                        <td><?= $user->age ?></td>
                        <td><?= $user->ville ?></td>
                        <td><?= $villeObj->getNationalite() ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php require "footer.php"; ?>