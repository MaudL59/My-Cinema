<?php
// On inclut le fichier de connexion et le modèle Movie
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Movie.php';

class MovieRepository {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function findAll() {
        $movies = [];
        
$stmt = $this->pdo->query("SELECT * FROM Films");
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // On crée un objet Movie pour chaque ligne de la base
            $movies[] = new Movie(
                $row['id'], 
                $row['titre'], 
                $row['annee_sortie'], 
                $row['duree']
            );
        }
        return $movies;
    }
}