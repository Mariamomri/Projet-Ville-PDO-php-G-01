<?php

$title = "Profil";
$nav = "profil";
require "header.php";
require "classes/Utilisateur.php";
require "bd.php";

if (!is_connected()) {
  header("Location: ./login.php");
}
?>

<main class="main yellow">
  <section class="Profil profile-section ">
    <section class="smain">
      <br>

      <h1>Bienvenue <?php echo $_SESSION['pseudo']; ?> !</h1>
      <img src="assets/img/profilf.png" alt="img profil" width="150px" class="img-profil">
    </section>
    <img src="assets/img/sco.gif" alt="coriandoli" class="coriandoli" width="400px">
    <br>
    <section>

      <h1>Profil</h1>

      <p><strong>Nom:</strong> <?php echo $_SESSION['pseudo']; ?></p>
      <p><strong>Prénom:</strong> <?php echo $_SESSION['pseudo']; ?></p>
      <p><strong>Pseudo:</strong> <?php echo $_SESSION['pseudo']; ?></p>
      <!-- afficher lo to_string ici -->

      <h2>ville et la nationalité</h2>

      <table border="1">
        <tr>
          <th>Ville</th>
          <th>nationalité</th>
        </tr>

        <?php
        // Mostriamo tutte le conversioni salvate
        // if (!empty($_SESSION["transactions"])) {
        //   foreach ($_SESSION["transactions"] as $t) {
        //     echo "<tr>
        //                         <td>" . $t["type"] . "</td>
        //                         <td>" . $t["amount"] . "</td>
        //                       </tr>";
        //   }
        // } 
        ?>
      </table>
    </section>
</main>

<?php require "footer.php"; ?>