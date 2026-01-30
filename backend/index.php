<?php 
// index.php

ini_set('display_errors', 1);
error_reporting(E_ALL);
// Movies
require_once './models/Movie.php';
require_once './repositories/MovieRepository.php';
// Rooms
require_once './models/Room.php';
require_once './repositories/RoomRepository.php';
// Screening
require_once './models/Screening.php';
require_once './repositories/ScreeningRepository.php';
// database
require_once './config/database.php';

// MOVIE
$movieRepo = new MovieRepository($pdo);
$movies = $movieRepo->findAll();

// Room
$roomRepo = new RoomRepository($pdo);
$rooms = $roomRepo->findAll();

// SCREENING
$screeningRepo = new ScreeningRepository($pdo);
$screenings = $screeningRepo->findAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="MY-CINEMA" content="site box-office pour un cinema">
    <title>MY-CINEMA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 font-sans text-slate-900">
    <nav class="bg-indigo-900 text-white shadow-lg p-4 mb-8">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold flex items-center gap-2">
                <span>🎬</span> My Cinema <span class="text-white font-light text-sm uppercase tracking-widest ml-2">Espace Administration</span>
            </h1>
        </div>
    </nav>

    <!-- LISTES DES FILMS -->
    <div class="container mx-auto px-4 mb-4">
        <button
      id="btn-films"
      class="bg-blue-500 text-white px-4 py-2 cursor-pointer font-extrabold"
    >FILMS À L'AFFICHE 
        </button>
    </div>    
    <div id="movie-list" class=" hidden">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8 container mx-auto px-4 py-8 transition-all duration-300">
        <?php
           foreach($movies as $movie){
        
        echo "<div class='group relative bg-white rounded-xl shadow-md overflow-hidden flex flex-col h-full border border-slate-200 transition-all duration-300'>";
        
        // Conteneur de l'image + Overlay (le calque qui apparaît)
        echo "<div class='relative aspect-[2/3] overflow-hidden'>";
            echo "<img src='../frontend/assets/img/" . $movie->getPoster() . "' class='w-full h-full object-cover transition-transform duration-500 group-hover:scale-110' alt='Affiche'>";
            
            
            echo "<div class='absolute inset-0 bg-indigo-900/90 p-6 flex flex-col justify-center items-center text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300'>";
                echo "<span class='text-white font-bold mb-2'>⏱ " . $movie->getFormattedDuration() . "</span>";
                echo "<p class='text-white text-xs line-clamp-6'>" . $movie->getDescription() . "</p>";
            echo "</div>";
        echo "</div>";

        // Le bas de la carte (Titre + Année + Genre) 
        echo "<div class='p-4 flex flex-col flex-grow bg-white z-10'>";
            echo "<h2 class='font-bold text-lg mb-1 truncate'>" . $movie->getTitle() ." ". $movie->getReleaseYear() ."</h2>";
            echo "<p class='text-xs text-indigo-600 font-medium'>" . $movie->getGenre() . "</p>";
        echo "</div>";

        echo "</div>";
}
        ?>
        </div>
    </div>


<!-- LISTES DES SALLES -->


     <div class="container mx-auto px-4 mb-4">
        <button
      id="btn-rooms"
      class="bg-blue-500 text-white px-4 py-2 cursor-pointer font-extrabold"
    >LES SALLES 
        </button>
    </div>    
    <div id="room-list" class=" hidden">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8 container mx-auto px-4 py-8 transition-all duration-300">
        <?php
           foreach($rooms as $room){
        
        echo "<div class='group relative bg-white rounded-xl shadow-md overflow-hidden flex flex-col h-full border border-slate-200 transition-all duration-300 text-center'>";

        // Le bas de la carte (Nom + Capacité +  Type +Active) 
        
            echo "<h2 class='font-bold text-lg mb-1 truncate'>" . $room->getName()  ."</h2>";
            echo "<p class='text-xs text-red-600 font-medium'>" . $room->getCapacity() . " sièges" . "</p>" ;
            echo "<p class='text-xs text-indigo-600 font-medium'>" . " ".$room->getType() ."</p>";
            echo "<p class='text-xs text-green-600 font-medium'> " .$room->getActive() . "</p>";
        

        echo "</div>";
}
        ?>
        </div>
    </div>
    <script src="../frontend/index.js"></script>
</body>
</html>