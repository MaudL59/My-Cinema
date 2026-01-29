<?php 
// index.php

ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once './models/Movie.php';
require_once './repositories/MovieRepository.php';
require_once './config/database.php';


$movieRepo = new MovieRepository($pdo);
$movies = $movieRepo->findAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="MY-CINEMA" content="site box-office pour un cinema">
    <title>Document</title>
</head>
<body>
    <ul>
        <?php
            foreach($movies as $movie){
               echo "<li>" . 
         "<img src='../frontend/assets/img/" . $movie->getPoster() . "' alt='Affiche' width='50'> " . 
         $movie->getTitle() . " (" . $movie->getGenre() . ")" . 
         "</li>";
        }
        ?>
    </ul>
</body>
</html>