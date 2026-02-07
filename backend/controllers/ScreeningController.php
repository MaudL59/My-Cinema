<?php
// ScreeningController.php

class ScreeningController {
    private $repo;
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->repo = new ScreeningRepository($pdo);
    }

    public function index() {
        $allData = $this->repo->findAll();
        $service = new ScreeningService();
        $planning = $service->organizeScreenings($allData);
        echo json_encode($planning);
    }
    public function saveScreening() {
        $id = $_POST['id'] ?? null;
        $movie_id = $_POST['movie_id'] ?? null;
        $room_id = $_POST['room_id'] ?? null;
        $screening_date = $_POST['screening_date'] ?? null;

        if ($this->repo->isRoomOccupied($room_id, $screening_date)) {
            echo json_encode(['success' => false, 'message' => 'Cette salle est déjà occupée à cette heure-là !']);
            return;
        }
    
       
        $movieRepo = new MovieRepository($this->pdo);
        $movie = $movieRepo->findById($movie_id);
        
        if (!$movie) {
            echo json_encode(['success' => false, 'message' => "Le film n'existe pas !"]);
            return;
        }

        $newMovieDuration = (int)$movie->getDuration();

        if ($newMovieDuration <= 0) {
            echo json_encode(['success' => false, 'message' => "Le film a une durée de 0 !"]);
            return;
        }

        
        $existingScreenings = $this->repo->findByRoom($room_id);
        $service = new ScreeningService();
        $conflict = $service->hasConflict($existingScreenings, $screening_date, $newMovieDuration, $id);

        if (!$conflict) {
            $this->repo->save($id, $movie_id, $room_id, $screening_date);
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'La salle est déjà occupée sur ce créneau !']);
        }
    } 

    public function deleteScreening() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->repo->delete($id);
            echo json_encode(['success' => true]);
        }
    }
}