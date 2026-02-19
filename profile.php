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
      <img src="assets/img/cat-facebook-profile-image-208004.jpg" alt="img profil" width="150px" class="img-profil">
    </section>
    <img src="assets/img/sco.gif" alt="coriandoli" class="coriandoli" width="400px">
    <br>
    <section>

      <?php

      try {
        $resultat = $pdo->query('SELECT * from utilisateurs');
        $tabUsers = $resultat->fetch(PDO::FETCH_OBJ);
      } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
      }

      ?>

      <h1>Profil</h1>

      <?php
      $pseudo = $_POST['pseudo']; // esempio

      $user = $pdo->prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo");
      $user->execute(['pseudo' => $pseudo]);

      $persona = $user->fetch(PDO::FETCH_OBJ);

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