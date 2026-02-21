<?php
session_start();

$title = "Accueil";
$nav = "index";
require "header.php";
require "bd.php";
?>


<div class="wrapper">
    <main class="content">
        <center>

            <h3>
                Les bonnes nouvelles dans le monde 2025/2026 !!
            </h3>
            <br> <br>
            <!-- carouSSEL -->
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
                </div>

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="video-container">
                            <iframe src="https://www.youtube.com/embed/J1SeiM4LIV8" title="Video 1" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                            </iframe>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="video-container">
                            <iframe src="https://www.youtube.com/embed/oQdqEa6iqV0" title="Video 2" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                            </iframe>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="video-container">
                            <iframe src="https://www.youtube.com/embed/xBIXOKFU2R4" title="Video 3" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <!-- carouSSEL FIN -->
            <br><br>

            <!-- TABLEAU DES PAYS -->
             <h2 style="color:white">Les 10 pays de notre site</h2>
            <?php
            $resultat = $pdo->query('SELECT * FROM villes LIMIT 10');
            $tabVilles = $resultat->fetchAll(PDO::FETCH_OBJ);
            ?>
            <div align="center">
                <div class="col-6">
                    <table class="table table-responsive table-hover table-striped table-dark table-bordered">
                        <thead class="bg-dark text-white">
                            <tr align="center">
                                <th></th>
                                <th>Ville</th>
                                <th>Pays</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tabVilles as $index => $ville) { ?>
                                <tr align="center">
                                    <td><?= $index + 1 ?></td>
                                    <td><?= $ville->nom ?></td>
                                    <td><?= $ville->pays ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- TABLEAU FIN -->

        </center>
    </main>
    <br>

    <?php
    require "footer.php";
    ?>
</div>
</body>