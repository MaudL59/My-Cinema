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



$action = $_GET['action'] ?? '';

// les contrôleurs
$movieCtrl = new MovieController($pdo);
$roomCtrl = new RoomController($pdo);
$screeningCtrl = new ScreeningController();

switch ($action) {
    case 'getMovies':
        $movieCtrl->index();
        break;
        
    case 'saveMovie':
        $movieCtrl->save();
        break;
        
    case 'deleteMovie':
        $movieCtrl->delete($_GET['id']);
        break;

    case 'getRooms':
        $roomCtrl->index();
        break;
        
    case 'saveRoom':
        $roomCtrl->save();
        break;
        
    case 'deleteRoom':
        $roomCtrl->delete($_GET['id']);
        break;

    case 'getScreenings':
        $screeningCtrl->index($pdo);
        break;

    default:
        // Optionnel : message si l'action n'existe pas
        break;
}

exit;