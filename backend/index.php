<?php 
// index.php

header('Content-Type: application/json'); // On dit au navigateur qu'on envoie du JSON
header('Access-Control-Allow-Origin: *'); // Pour autoriser l'index.html à parler à ce fichier

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


$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action === 'getMovies') {
    $repo = new MovieRepository($pdo);
    $data = $repo->findAll();
    echo json_encode($data);
    exit;
}

if ($action === 'getScreenings') {
    $repo = new ScreeningRepository($pdo);
    $data = $repo->findAll();
    echo json_encode($data);
    exit;
}

