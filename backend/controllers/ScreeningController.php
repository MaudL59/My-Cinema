<?php
// ScreeningController.php

class ScreeningController{
    public function index($pdo){
        $repo = new ScreeningRepository($pdo);
        $allData = $repo->findAll();
        $service = new ScreeningService();
        $planning = $service-> organizeScreenings($allData);

        echo json_encode($planning);
    }


    public function saveScreening($pdo) {
    // On récupère les données du formulaire
    $id = $_POST['id'] ?? null;
    $movie_id = $_POST['movie_id'] ?? null;
    $room_id = $_POST['room_id'] ?? null;
    $screening_date = $_POST['screening_date'] ?? null;

    // On récupère la durée du film qu'on veut ajouter
    $movieRepo = new MovieRepository($pdo);
    $movie = $movieRepo->findById($movie_id);
    $newMovieDuration = $movie ? (int)$movie->getDuration() : 0;

    
    if (!$movie) {
        echo json_encode(['success' => false, 'message' => "Le film ID $movie_id n'existe pas en BDD !"]);
        exit;
    }

    if ($newMovieDuration <= 0) {
        echo json_encode(['success' => false, 'message' => "Le film " . $movie->getTitle() . " a une durée de 0 !"]);
        exit;
    }
    // On récupère les séances déjà prévues dans cette salle
    $screeningRepo = new ScreeningRepository($pdo);
    $existingScreenings = $screeningRepo->findByRoom($room_id);

    // On demande au Service s'il y a un conflit
    $service = new ScreeningService();
    
    $conflict = $service->hasConflict($existingScreenings, $screening_date, $newMovieDuration, $id);

    
    if (!$conflict) {
        $screeningRepo->save($id, $movie_id, $room_id, $screening_date);
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'La salle est déjà occupée sur ce créneau !']);
    }
} 

public function deleteScreening($pdo) {
    $id = $_GET['id'] ?? null;

    if ($id) {
        $repo = new ScreeningRepository($pdo);
        $repo->delete($id);
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'ID manquant']);
    }
}
}