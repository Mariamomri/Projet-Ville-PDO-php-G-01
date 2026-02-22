<!--il faudrait un footer avec 3 onglets : Home, Debug et Reset. -->

</div> <!--fermeture de wrapper dans le header.php-->
<footer>
  <div class="am">
    <p> &copy; 2026 Cfitech, Mariam & Nisrin</p>

  </div>

  <section>
    <div class="footerlink ">
      <!-- home -->
      <a href="./index.php" class="nav-item <?php if ($nav === "index"): ?> active<?php endif ?>">Home</a>
      <!-- debug -->
      <a href="#" class="nav-item <?php if ($nav === "sessionActuelle"): ?> active<?php endif ?>">Debug</a>
      <!-- reset -->
      <a href="#" class="nav-item <?php if ($nav === "resetSessions"): ?> active<?php endif ?>">Reset</a>
    </div>

    <div class="social-bar">
      <div class="social">
        <i class="fab fa-twitter"></i>
        <i class="fab fa-facebook-f"></i>
        <i class="fab fa-youtube"></i>
        <i class="fab fa-linkedin-in"></i>
      </div>
    </div>
  </section>

  <div class="am">
    <?php
    date_default_timezone_set("Europe/Brussels"); // fuso orario
    ?>
    <p class="date"><?= date("d/m/Y  H:i") ?></p>
  </div>
</footer>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>