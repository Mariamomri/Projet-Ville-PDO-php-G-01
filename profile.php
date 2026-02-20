<?php
session_start(); 
$title = "Profil";
$nav = "profil";
require "header.php";
require "bd.php";

if (!is_connected()) {
  header("Location: ./login.php");
  exit;
}

// Récupérer pseudo de l'utilisateur connecté
$pseudo = $_SESSION['pseudo'];

$stmt = $pdo->prepare("
    SELECT u.nom, u.prenom, u.pseudo, v.nom AS ville, v.pays
    FROM utilisateurs u
    LEFT JOIN villes v ON u.id_ville = v.id_ville
    WHERE u.pseudo = :pseudo
");
$stmt->execute(['pseudo' => $pseudo]);
$user = $stmt->fetch(PDO::FETCH_OBJ);


function nationalite($pays)
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

<main class="container my-5">
  <div class="text-center mb-4">
    <h1>Bienvenue <?php echo htmlspecialchars($user->prenom); ?> !</h1>
    <img src="assets/img/cat-facebook-profile-image-208004.jpg" alt="Photo profil" class="rounded-circle" width="150">
  </div>

  <div class="card mx-auto" style="max-width: 600px;">
    <div class="card-body">
      <h3 class="card-title mb-3">Informations personnelles</h3>
      <?php if ($user): ?>
        <p><strong>Nom :</strong> <?php echo htmlspecialchars($user->nom); ?></p>
        <p><strong>Prénom :</strong> <?php echo htmlspecialchars($user->prenom); ?></p>
        <p><strong>Pseudo :</strong> <?php echo htmlspecialchars($user->pseudo); ?></p>

        <h4 class="mt-4">Ville & Nationalité</h4>
        <table class="table table-bordered table-striped">
          <thead class="table-dark">
            <tr>
              <th>Ville</th>
              <th>Nationalité</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo htmlspecialchars($user->ville); ?></td>
              <td><?php echo nationalite($user->pays); ?></td>
            </tr>
          </tbody>
        </table>
      <?php else: ?>
        <p class="text-danger">Utilisateur non trouvé</p>
      <?php endif; ?>
    </div>
  </div>
</main>

<?php require "footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>