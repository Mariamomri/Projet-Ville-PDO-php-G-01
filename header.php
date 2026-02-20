<!doctype html>
<html lang="en">
<?php

require_once "./functions/autentifications.php";
?>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="author" content="Mariam & Nisrin">
  <meta name="description" content="Projet php Ville 2026">
  <meta name="keywords" content="HTML, CSS, PHP Responsive">
  <title>
    <?php
    if (isset($title)):
      echo $title;
    else:
      echo "Ville";
    endif
    ?>
  </title>

  <link rel="stylesheet" href="assets/css/style.css">


  <!-- link bootstrap -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
    crossorigin="anonymous" />
</head>

<body>
  <div class="container">
    <header class="blog-header py-3 border-bottom text-center">
      <section class="flex">
        <div>
          <img src="assets/img/earth.gif" alt="monde" width="150px">
        </div>
        <div>
          <a class="blog-header-logo text-white" href="#" style="font-size: 2rem; font-weight: bold;">
            LES PAYS A TRAVERS LE MONDE
          </a>

          <section class="navbar-nav mr-auto">
            <nav>
              <a href="./index.php" class="nav-item<?php if (isset($nav) && $nav === "index"): ?> active<?php endif ?>">Accueil</a>
              <a href="./enregistrer.php" class="nav-item<?php if (isset($nav) && $nav === "S'enregistrer"): ?> active<?php endif ?>">S'enregistrer</a>

              <?php if (is_connected()): ?>
                <div class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle <?php if (isset($nav) && ($nav === "base de données" || $nav === "createUser")): ?>active<?php endif ?>"
                    href="#" id="titleMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    CRUD
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="titleMenu">
                    <li><a class="dropdown-item" href="./listUsers">All Users</a></li>
                    <li><a class="dropdown-item" href="./createUser.php">Create User</a></li>
                    <li><a class="dropdown-item" href="./findUser.php">Read User</a></li>
                    <li><a class="dropdown-item" href="./updateUser.php">Update User</a></li>
                    <li><a class="dropdown-item" href="./deleteUser.php">Delete User</a></li>
                  </ul>
                </div>

                <a href="./profile.php" class="nav-item <?php if (isset($nav) && $nav === "profil"): ?> active<?php endif ?>">Profil</a>
              <?php endif; ?>
            </nav>
          </section>
        </div>
        <div>
          <nav class="right">
            <?php if (!is_connected()): ?>
              <a href="login.php" class="nav-item<?php if (isset($nav) && $nav === "login"): ?> active<?php endif ?>">Login <img src="assets/img/Connexion.png" alt="login" width="15px" /></a>
            <?php else : ?>
              <a class="nav-item" href="./logout.php">Logout <img src="assets/img/Connexion.png" alt="login" width="15px" /></a>
            <?php endif; ?>
          </nav>
        </div>
      </section>


    </header>

    <nav class="nav d-flex justify-content-center py-2 mb-3">
      <a class="nav-link <?php if ($nav === 'accueil') echo 'active'; ?>"
        style="color: white; font-weight: bold;"
        href="/PHP/Projet-Ville-PDO-php-G-01/index.php">Accueil</a>

      <!-- Profil -->
      <?php if (is_connected()): ?>
        <a class="nav-link text-muted <?php if ($nav === 'profile') echo 'active font-weight-bold text-dark'; ?>"
          href="/PHP/Projet-Ville-PDO-php-G-01/profile.php">Mon Profil</a>

      <?php endif; ?>

      <!-- fin -->


    </nav>
  </div>

</body>