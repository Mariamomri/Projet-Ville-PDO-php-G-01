<?php

$title = "Profil";
$nav = "profil";
require "header.php";
require "classes/Utilisateur.php";
require "bd.php";

if (!is_connected()) {
  header("Location: ./login.php");
}

//recuper le pseudo de login
$pseudo = $_SESSION['pseudo'];


// chercher dans bd sql 
$user = $pdo->prepare("SELECT nom, prenom, pseudo FROM utilisateurs WHERE pseudo = :pseudo");
$user->execute(['pseudo' => $pseudo]);

//data in form objet
$persona = $user->fetch(PDO::FETCH_OBJ);
?>

<main class="main yellow">
  <section class="Profil profile-section ">

    <section class="smain">
      <br>

      <h1>Bienvenue <?php echo $persona->prenom; ?> !</h1>
      <?php
      if ($persona->prenom == "Julien") {
        echo "<img src='assets/img/julien.png' alt='img profil' width='150px' class='img-profil'>";
      } else if ($persona->prenom == "Mariam") {
        echo "<img src='assets/img/profilf.png' alt='img profil' width='150px' class='img-profil'>";
      } else if ($persona->prenom == "Nisrine") {
        echo "<img src='assets/img/cat-facebook-profile-image-208004.jpg' alt='img profil' width='150px' class='img-profil'>";
      } else {
        echo "<img src='assets/img/profilx.avif' alt='img profil' width='150px' class='img-profil'>";
      }

      ?>
      <!-- <img src="assets/img/cat-facebook-profile-image-208004.jpg" alt="img profil" width="150px" class="img-profil"> -->
    </section>
    <img src="assets/img/sco.gif" alt="coriandoli" class="coriandoli" width="400px">
    <br>


    <img src="assets/img/neon-frame-vibrant-colored-glowing-neon-frame-with-transparent-background-png.png" alt="">
    <section>

      <h1>Profil</h1>

      <?php

      if ($persona) {
        echo "Nom : " . $persona->nom . "<br>";
        echo "Prenom : " . $persona->prenom . "<br>";
        echo "Pseudo : " . $persona->pseudo;
      } else {
        echo "Utilisateur non trouvé";
      }
      ?>


      <h2>ville et la nationalité</h2>

      <table border="1">
        <tr>
          <th>Ville</th>
          <th>nationalité</th>
        </tr>
        <?php // chercher dans bd sql 
        // $city = $pdo->prepare("SELECT nom, pays FROM villes WHERE pseudo = :pseudo");   // guardare le jointure
        // $city->execute(['pseudo' => $pseudo]);

        // //data in form objet
        // $from = $city->fetch(PDO::FETCH_OBJ);
        ?>

        <tr>
          <td><?php //echo $from->ville; 
              ?></td>
          <td><?php //echo $from->pays; 
              ?></td>
        </tr>

      </table>
    </section>
</main>

<?php
require "footer.php";
?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>