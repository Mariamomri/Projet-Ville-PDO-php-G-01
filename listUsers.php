<?php
$title = "List Of Users";
$nav = "listUsers";
require "header.php";
if (!is_connected()) {
    header("location: ./login.php");
}
require "bd.php";
?>
<center><b>
        <h1>List of Users from db(coursmysql)</h1>
    </b></center>
<?php

try {
    $resultat = $pdo->query('SELECT * from users');
    $tabUsers = $resultat->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}

?>
<div align="center">
    <div class="col-6">
        <table class="table table-responsive table-hover table-striped table-dark table-bordered ">
            <thead class="bg-dark text-white">
                <tr align="center">
                    <th>Id User</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Pseudo</th>
                    <th style="width: 180px;">Mot de passe</th>
                    <th>Age</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tabUsers as $user) { ?>
                    <tr align="center">
                        <td><?php echo $user->id_user; ?></td>
                        <td><?php echo $user->nom; ?></td>
                        <td><?php echo $user->prenom; ?></td>
                        <td><?php echo $user->pseudo; ?></td>
                        <td><?php echo $user->motDePasse; ?></td>
                        <td><?php echo $user->age; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php

require "footer.php";

?>