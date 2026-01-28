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
        $films = [];
        $stmt = $this->pdo->query("SELECT * FROM Films");
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $films[] = new Movie(
                $row['id'], 
                $row['title'], 
                $row['annee_sortie'], 
                $row['duration'],
                $row['description'],
                $row['genre']
            );
        }
        return $films;
    }

    public function create($title, $annee, $duration) {
        $sql = "INSERT INTO Films (title, annee_sortie, duration, description, genre) VALUES (:title, :annee, :duration, :description, :genre)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':title' => $title,
            ':annee' => $annee,
            ':duration' => $duration,
            ':description' => $description,
            ':genre' => $genre,
        ]);
    } 

    public function delete($id) {
        $sql = "DELETE FROM Films WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
} 