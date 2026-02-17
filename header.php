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
<style>
.blog-header {
  background-color: black; 
  color: white;         
  text-align: center;
  border: 1px solid white;
}

.blog-header a {
  color: grey;      
  text-decoration: none;
  font-weight: bold;
}

.blog-header a:hover {
  color: blueviolet;          
}

.navbar-nav .nav-link {
  color: lightgrey;         
  font-weight: bold;
}

.navbar-nav .nav-link:hover {
  color: #22566dff;         
}
.navbar-nav {
  display: flex;  
  flex-direction: row;      
  gap: 45px;            
  justify-content: center; 
  padding-left: 0;        
  list-style: none;      
}



</style>
  <div class="container">
    <header class="blog-header py-3 border-bottom text-center">
      <a class="blog-header-logo text-white" href="#" style="font-size: 2rem; font-weight: bold;">
        LES PAYS A TRAVERS LE MONDE
      </a>

      <ul class="navbar-nav mr-auto">
        <?php if (!is_connected()): ?>
          <li class="nav-item <?php if ($nav === "login"): ?> active <?php endif ?>">
            <a class="nav-link" href="./login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./createUser.php">S'enregistrer</a>
          </li>

        <?php else : ?>
          <li class="nav-item">
            <a class="nav-link" href="./logout.php">Logout</a>
          </li>
        <?php endif; ?>
      </ul>
    </header>

    <nav class="nav d-flex justify-content-center py-2 mb-3">
      <a class="nav-link text-muted <?php if ($nav === 'accueil') echo 'active font-weight-bold text-dark'; ?>"
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