<?php
// ScreeningRepository.php

// Le Repository, c'est le "bibliothécaire". Son rôle est d'aller chercher les données dans la base (SQL) et de les transformer en objets Movie (PHP) pour pouvoir utiliser les getters.

class ScreeningRepository{
    private $pdo;

    // le constructeur qui va recevoir la connexion à la base de données pour la stocker dans cette propriété
    public function __construct($connection){
        $this -> pdo = $connection;

    }

    // la fonction qui va demander à la base de données tous les films
    public function findAll(){
        
        $sql = "SELECT 
            Screening.id, 
            Screening.movie_id, 
            Screening.room_id, 
            Screening.screening_date, 
            Movie.title AS title, 
            Movie.duration AS duration,
            Room.name AS room_name
        FROM Screening 
        JOIN Movie ON Screening.movie_id = Movie.id
        JOIN Room ON Screening.room_id = Room.id
        ORDER BY screening_date ASC";
        // appel de la table Screening
        $statement = $this ->pdo->query($sql); 
        // renvoie la demande et stocke le résultat dans une variable $statement
        
        return $statement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Screening');
        // Le mode de transport : PDO::FETCH_CLASS veut dire : "Prépare-toi à créer des objets"
        // Le plan de construction : On lui donne le nom de la classe sous forme de texte : 'Screening'
        //   renvoie un tableau d'objets Screening
        
    }

    public function findByRoom($room_id) {
    // On sélectionne tout de screening et la durée de movie
    // s est un racourci de screening
    $sql = "SELECT s.*, m.duration 
            FROM Screening s
            JOIN Movie m ON s.movie_id = m.id
            WHERE s.room_id = :room_id";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['room_id' => $room_id]);

    return $stmt->fetchAll(PDO::FETCH_CLASS, 'Screening');
}

public function save($id, $movie_id, $room_id, $screening_date) {
    if (empty($id)) {
        // NOUVELLE SÉANCE
        $sql = "INSERT INTO Screening (movie_id, room_id, screening_date) 
                VALUES (:movie_id, :room_id, :screening_date)";
        
        $params = [
            'movie_id'       => $movie_id, 
            'room_id'        => $room_id, 
            'screening_date' => $screening_date
        ];
    } else {
        // MODIFICATION SÉANCE
        $sql = "UPDATE Screening 
                SET movie_id = :movie_id, room_id = :room_id, screening_date = :screening_date 
                WHERE id = :id";
        
        $params = [
            'id'             => $id,
            'movie_id'       => $movie_id, 
            'room_id'        => $room_id, 
            'screening_date' => $screening_date
        ];
    }

    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute($params);
}

public function delete($id) {
    $sql = "DELETE FROM Screening WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute(['id' => $id]);
}

public function isRoomOccupied($roomId, $date) {
    $sql = "SELECT COUNT(*) FROM Screening WHERE room_id = :room_id AND screening_date = :date";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['room_id' => $roomId, 'date' => $date]);
    return $stmt->fetchColumn() > 0;
}

public function findAllGroupedByDate() {
    $sql = "SELECT s.*, m.title, m.duration, r.name as room_name 
            FROM Screening s
            JOIN Movie m ON s.movie_id = m.id
            JOIN Room r ON s.room_id = r.id
            ORDER BY s.screening_date ASC"; // <--- Tri chronologique total
    
    $stmt = $this->pdo->query($sql);
    $screenings = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $grouped = [];
    foreach ($screenings as $s) {
        $date = explode(' ', $s['screening_date'])[0]; // On récupère "2026-02-07"
        $grouped[$date][] = $s;
    }
    return $grouped;
}

}