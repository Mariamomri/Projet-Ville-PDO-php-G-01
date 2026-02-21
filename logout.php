<?php
    session_start();
    //detruit toutes les sessions 
    // session_unset();

    unset($_SESSION['connected']);
    unset($_SESSION['pseudo']);
    
    header('Location: ./index.php');
    ?>
