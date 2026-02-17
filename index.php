<?php
session_start();

$title = "accueil";
$nav = "accueil";
require "./functions/autentifications.php";
?>

<body>

    <div class="wrapper">
        <?php
        require "header.php";
        ?>

        <main class="content">
            <center>

                <h3>
                    Les bonnes nouvelles dans le monde 2025/2026 !
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

                <style>
                    body {
                        position: relative;
                        margin: 0;
                        padding: 0;
                        font-family: Arial, sans-serif;
                        color: white;
                    }

                    body::before {
                        content: "";
                        position: fixed;
                        top: 0;
                        left: 0;
                        right: 0;
                        bottom: 0;
                        background: url('./assets/img/headerPays.jpg') no-repeat center center fixed;
                        background-size: cover;
                        z-index: -1;
                    }

                    .carousel {
                        width: 60%;
                        margin: 0 auto;
                    }

                    .video-container {
                        position: relative;
                        width: 100%;
                        padding-bottom: 56.25%;
                        height: 0;
                        overflow: hidden;
                    }

                    .video-container iframe {
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        border-radius: 8px;
                    }

                    .wrapper {
                        display: flex;
                        flex-direction: column;
                        min-height: 100vh;
                    }

                    .content {
                        flex: 1;
                    }

                    footer {
                        border-top: 1px solid white;
                        background-color: black;
                        padding: 15px 0;
                        text-align: center;
                        color: white;
                    }

                    footer a {
                        color: #1e3a8a;
                        margin: 0 10px;
                        text-decoration: none;
                        font-weight: bold;
                    }

                    footer a:hover {
                        color: #0f2027;
                    }
                </style>



            </center>
        </main>

        <?php
        require "footer.php";
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>