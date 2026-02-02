<?php 
// index.php

ini_set('display_errors', 1);
error_reporting(E_ALL);
// Movies
require_once './models/Movie.php';
require_once './repositories/MovieRepository.php';
require_once './controllers/MovieController.php';
// Rooms
require_once './models/Room.php';
require_once './repositories/RoomRepository.php';
require_once './controllers/RoomController.php';
// Screening
require_once './models/Screening.php';
require_once './repositories/ScreeningRepository.php';
require_once './controllers/ScreeningController.php';
require_once './services/ScreeningService.php';
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

$screeningController = new ScreeningController();
$weeklyPlanning = $screeningController->index($pdo);

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
<body class="bg-slate-50 font-sans text-slate-900 flex min-h-screen">

    <nav class="w-64 bg-indigo-900 text-white shadow-xl flex flex-col fixed h-full z-20">
        <div class="p-6 border-b border-indigo-800">
            <h1 class="text-xl font-bold flex flex-col gap-1">
                <span class="text-2xl">🎬 My Cinema</span>
                <span class="text-indigo-300 font-light text-xs uppercase tracking-widest">Administration</span>
            </h1>
        </div>

        <div class="flex flex-col mt-6 px-4 gap-3">
            <button id="btn-films" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold rounded-lg hover:bg-indigo-800 transition-all cursor-pointer text-left w-full">
                <span>🎞️</span> FILMS
            </button>
            <button id="btn-rooms" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold rounded-lg hover:bg-indigo-800 transition-all cursor-pointer text-left w-full">
                <span>🏛️</span> SALLES
            </button>
            <button id="btn-screening" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold  rounded-lg shadow-inner cursor-pointer text-left w-full">
                <span>📅</span> PLANNING
            </button>
        </div>
        
        <div class="mt-auto p-6 text-xs text-indigo-400 border-t border-indigo-800">
            &copy; 2026 My Cinema Admin
        </div>
    </nav>

    <main class="flex-1 ml-64 p-10">
    <div class="max-w-7xl mx-auto">
        
        <div id="movie-list" class="hidden">
            <h2 class="text-2xl font-bold mb-6 text-slate-800 border-l-4 border-indigo-600 pl-4">Catalogue des Films</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                <?php foreach($movies as $movie): ?>
                    <div class='group relative bg-white rounded-xl shadow-sm overflow-hidden flex flex-col h-full border border-slate-200 transition-all hover:shadow-md'>
                        <div class='relative aspect-[2/3] overflow-hidden'>
                            <img src='../frontend/assets/img/<?= $movie->getPoster() ?>' class='w-full h-full object-cover transition-transform duration-500 group-hover:scale-105' alt='Affiche'>
                            <div class='absolute inset-0 bg-indigo-900/80 p-6 flex flex-col justify-center items-center text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300'>
                                <span class='text-white font-bold mb-2'>⏱ <?= $movie->getFormattedDuration() ?></span>
                                <p class='text-white text-xs line-clamp-6'><?= $movie->getDescription() ?></p>
                            </div>
                        </div>
                        <div class='p-4 flex flex-col flex-grow'>
                            <h2 class='font-bold text-md mb-1 truncate text-slate-800'><?= $movie->getTitle() ?></h2>
                            <div class="flex justify-between items-center mt-auto">
                                <p class='text-xs text-indigo-600 font-semibold uppercase'><?= $movie->getGenre() ?></p>
                                <span class="text-xs text-slate-400"><?= $movie->getReleaseYear() ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div id="room-list" class="hidden">
            <h2 class="text-2xl font-bold mb-6 text-slate-800 border-l-4 border-indigo-600 pl-4">Gestion des Salles</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach($rooms as $room): ?>
                    <div class='bg-white p-6 rounded-xl shadow-sm border border-slate-200 flex items-center justify-between hover:border-indigo-300 transition-all'>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-indigo-50 rounded-lg flex items-center justify-center text-2xl">🏛️</div>
                            <div>
                                <h3 class='font-bold text-lg text-slate-800'><?= $room->getName() ?></h3>
                                <p class='text-sm text-slate-500 font-medium'><?= $room->getType() ?></p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class='text-sm font-bold text-slate-700'><?= $room->getCapacity() ?> sièges</div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $room->getActive() ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                <?= $room->getActive() ? '● Actif' : '○ Inactif' ?>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div id="screening-list" class="flex bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
            
            <div class="w-16 flex-none bg-slate-50 border-r border-slate-200 pt-16">
                <?php for($h = 10; $h <= 22; $h++): ?>
                    <div class="h-[60px] border-b border-slate-100 text-[10px] font-bold text-slate-400 flex items-center justify-center">
                        <?= $h ?>h00
                    </div>
                <?php endfor; ?>
            </div>

            <div class="flex-1 flex overflow-x-auto">
                <?php foreach($rooms as $room): ?>
                    <div class="flex-none w-64 border-r border-slate-900 relative">
                        <div class="h-16 bg-indigo-50/50 border-b border-indigo-100 flex items-center justify-center sticky top-0 z-20 backdrop-blur-sm">
                            <h3 class="font-bold text-indigo-900 uppercase text-xs tracking-wider"><?= $room->getName() ?></h3>
                        </div>

                       <div class="relative h-[780px] bg-[linear-gradient(to_bottom,#cbd5e1_1px,transparent_1px)] bg-[length:100%_60px]">
                            <?php foreach($screenings as $s): ?>
                                <?php if($s->getRoomId() == $room->getId()): 
                                    $time = new DateTime($s->getScreeningDate());
                                    $hour = (int)$time->format('H');
                                    $min = (int)$time->format('i');
                                    
                                    // 1 heure = 60px (donc 1 minute = 1px)
                                    $top = (($hour - 10) * 60) + $min;
                                    $height = $s->getDuration(); 
                                ?>
                                    <div class="absolute left-2 right-2 p-3 bg-white border-l-4 border-indigo-600 rounded shadow-md hover:z-30 hover:scale-[1.02] transition-all overflow-hidden group"
                                         style="top: <?= $top ?>px; height: <?= $height ?>px;">
                                        <div class="flex flex-col h-full">
                                            <strong class="text-[11px] text-slate-800 leading-tight truncate mb-1" title="<?= $s->getTitle() ?>">
                                                <?= $s->getTitle() ?>
                                            </strong>
                                            <div class="mt-auto flex justify-between items-center text-[10px] font-bold text-indigo-600">
                                                <span>🕒 <?= $time->format('H:i') ?></span>
                                                <span class="text-slate-400 font-normal"><?= $s->getDuration() ?>m</span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div> </main>
    <script src="../frontend/index.js"></script>
</body>
</html>