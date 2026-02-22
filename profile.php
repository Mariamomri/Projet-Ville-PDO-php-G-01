<?php

$title = "Profil";
$nav = "profil";
require "header.php";
require_once "classes/Utilisateur.php";
require_once "classes/Villes.php";
require "bd.php";

if (!is_connected()) {
  header("Location: ./login.php");
}

//recuper le pseudo de login
$pseudo = $_SESSION['pseudo'];


// chercher dans bd sql 

$user = $pdo->prepare("SELECT utilisateurs.nom, utilisateurs.prenom, utilisateurs.pseudo, utilisateurs.id_user_ville, 
           villes.nom AS ville, villes.pays, villes.capitale
    FROM utilisateurs
    LEFT JOIN villes ON utilisateurs.id_user_ville = villes.id_ville
    WHERE utilisateurs.pseudo = :pseudo
");

$user->execute(['pseudo' => $pseudo]);

//data in formt objet
$persona = $user->fetch(PDO::FETCH_OBJ);
?>

<main class="main yellow">
  <section class="Profil profile-section ">

    <section>
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
    </section>

    <section>

      <h1>Profil</h1>

      <?php

      if ($persona) {
        echo "Nom : " . $persona->nom . "<br>";
        echo "Prenom : " . $persona->prenom . "<br>";
        echo "Pseudo : " . $persona->pseudo . "<br>";
        $ville = new Villes($persona->id_user_ville, $persona->ville, $persona->pays, $persona->capitale);
        echo "Nationalité : " . $ville->getNationalite() . "<br>";
      } else {
        echo "Utilisateur non trouvé";
      }
      ?>
      <br>
      <br>
      <br>
      <br>

      <h2>ville et la nationalité</h2>

      <div align="center">
        <div class="col-6">
          <table class="table table-responsive table-hover table-striped table-dark table-bordered">
            <thead class="bg-dark text-white">
              <tr align="center">
                <th>Ville</th>
                <th>Nationalité</th>
              </tr>
            </thead>
            <tbody>
              <tr align="center">
                <td><?= $persona->ville ?></td>
                <td><?= $ville->getNationalite() ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </section>

    <img src="assets/img/sco.gif" alt="in cours">
</main>

<?php
require "footer.php";
?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>