<?php
session_start();
$title = "List Of Users";
$nav = "listUsers";
require "header.php";

if (!is_connected()) {
    header("location: ./login.php");
    exit;
}

require "bd.php";
require "classes/Ville.php";
?>

<section class="yellow">
    <center>
        <br>
        <h1><b>List of Users</b></h1>
    </center>

    <?php
    try {
        $resultat = $pdo->query('
            SELECT utilisateurs.*, villes.nom AS ville, villes.pays, villes.capitale
            FROM utilisateurs
            LEFT JOIN villes ON utilisateurs.id_user_ville = villes.id_ville
        ');
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
                        <th style="width: 120px;">Mot de passe</th>
                        <th>Age</th>
                        <th>Nom ville</th>
                        <th>Pays</th>
                        <th>Capitale</th>
                        <th>Nationalité</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($tabUsers as $user): ?>

                        <?php
                        // object ville pour chaque utilisateur
                        $villeObj = new Ville(
                            $user->id_user_ville,
                            $user->ville,
                            $user->pays,
                            $user->capitale
                        );
                        ?>

                        <tr align="center">
                            <td><?= $user->id_user ?></td>
                            <td><?= $user->nom ?></td>
                            <td><?= $user->prenom ?></td>
                            <td><?= $user->pseudo ?></td>
                            <td><?= $user->mot_de_passe ?></td>
                            <td><?= $user->age ?></td>
                            <td><?= $villeObj->getNom() ?></td>
                            <td><?= $villeObj->getPays() ?></td>
                            <td><?= $villeObj->getCapitale() ?></td>
                            <td><?= $villeObj->getNationalite() ?></td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <br><br>
</section>

<?php require "footer.php"; ?>