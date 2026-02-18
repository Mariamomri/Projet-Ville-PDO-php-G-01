<!doctype html>
<html lang="en">
<?php

require_once "/functions/
  autentifications.php";
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

  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="responsive.css">


  <!-- link bootstrap -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
    crossorigin="anonymous" />
</head>

<body>
  <div class="wrapper">
    <header class="header">
      <div class="logo">
        <img src="échange-de-signes-change-euro-et-dollar-conversion-monétaire-illustration-vectorielle-isolée-sur-fond-blanc-258991261.webp" alt="logo-img" width="100px">
        <h1 class="titheader">Conversion</h1>
      </div>

      <nav>
        <a href="./index.php" class="nav-item<?php if (isset($nav) && $nav === "index"): ?> active<?php endif ?>">Accueil</a>
        <a href="./bourse.php" class="nav-item<?php if (isset($nav) && $nav === "......"): ?> active<?php endif ?>">......</a>

        <?php if (is_connected()): ?>
          <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="titleMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Title menu dropdown
            </a>
            <ul class="dropdown-menu" aria-labelledby="titleMenu">
              <li><a class="dropdown-item" href="......php">......</a></li>
              <li><a class="dropdown-item" href="......php">......</a></li>
              <li><a class="dropdown-item" href="......php">.......</a></li>
            </ul>
          </div>

          <a href="./profile.php" class="nav-item <?php if (isset($nav) && $nav === "profil"): ?> active<?php endif ?>">Profil</a>
        <?php endif; ?>
      </nav>


      <nav>
        <?php if (!is_connected()): ?>
          <a href="login.php" class="nav-item<?php if (isset($nav) && $nav === "login"): ?> active<?php endif ?>">Login</a>
        <?php else : ?>
          <a class="nav-item log" href="./logout.php">Logout</a>
        <?php endif; ?>
      </nav>

    </header>