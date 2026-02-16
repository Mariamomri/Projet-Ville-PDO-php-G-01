<?php
// //La connexion à la base de données coursmysql
// $pdo = new PDO('mysql:dbname=coursmysql5;host=localhost', "root",""); 
// //On utilise une méthode de la classe PDO qui permet de faire une 
// //requête et qui reçoit donc une requête en paramètre. Cette méthode 
// //retourne un objet de type PDOStatement qu'on mettra dans 
// //une variable $resultat
// $resultat = $pdo->query('SELECT * from users');
// //On va ensuite utiliser une méthode de classe de PDOStatement 
// //qui permet de récupérer le résultat sous forme de tableau. 
// //On fait un vardump pour voir ce qu'il contient.
// // var_dump($resultat->fetchAll());

// var_dump($resultat->fetchAll(PDO::FETCH_OBJ));

try {
    $pdo = new PDO('mysql:dbname=ville_php;host=localhost', "root", "");
    //On définit le mode d'erreur de PDO sur Exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Connexion réussie';
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
