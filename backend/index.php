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
if ($action === 'getRooms'){
    $repo = new RoomRepository($pdo);
    $data = $repo->findAll();
    echo json_encode($data);
    exit;
}

if ($action === 'getScreenings') {
    $controller = new ScreeningController();
    $weeklyPlanning = $controller->index($pdo); // Organise les données par date
    echo json_encode($weeklyPlanning);
    exit;
}

// bouton suprimer
if ($action === 'deleteMovie'){
    $id = $_GET['id'];
    $repo = new MovieRepository($pdo);
    $repo->delete($id);
    echo json_encode(['success' => true]);
    exit;
}

// Enregistrer les modifications

if ($action === 'saveMovie') {
    // 1. Récupération des données envoyées par le formulaire
    $id = $_POST['id'] ?? null;
    $title = $_POST['title'];
    $releaseYear = $_POST['releaseYear'];
    $duration = $_POST['duration'];
    $description = $_POST['description'];
    $genre = $_POST['genre'];
    $poster = $_POST['poster'];

    $repo = new MovieRepository($pdo);
    
    $repo->save($id, $title, $releaseYear, $duration, $description, $genre, $poster);

    echo json_encode(['success' => true]);
    exit;
}
