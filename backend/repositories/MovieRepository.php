<?php
// MovieRepository.php
require_once 'models/Movie.php';
// Le Repository, c'est le "bibliothécaire". Son rôle est d'aller chercher les données dans la base (SQL) et de les transformer en objets Movie (PHP) pour pouvoir utiliser les getters.

class MovieRepository{
    private $pdo;

    // le constructeur qui va recevoir la connexion à la base de données pour la stocker dans cette propriété
    public function __construct($connection){
        $this -> pdo = $connection;

    }

    // la fonction qui va demander à la base de données tous les films
    public function findAll(){
        
        $sql = "SELECT * FROM Movie";
        // appel de la table movie
        $statement = $this ->pdo->query($sql); 
        // renvoie la demande et stocke le résultat dans une variable $statement
        
        return $statement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Movie');
        // Le mode de transport : PDO::FETCH_CLASS veut dire : "Prépare-toi à créer des objets"
        // Le plan de construction : On lui donne le nom de la classe sous forme de texte : 'Movie'
        //   renvoie un tableau d'objets Movie
        
    }

    public function delete($id){
        // 1. On définit la requête
        $sql = "DELETE FROM Movie WHERE id = :id";
        // 2. On la prépare
        $statement = $this->pdo->prepare($sql);
        // 3. On l'exécute en liant l'ID
        $statement->execute(['id' => $id]);
    }

    public function save($id, $title, $releaseYear, $duration, $description, $genre, $poster) {
    if (empty($id)) {
        $sql ="INSERT INTO Movie (title, releaseYear, duration, description, genre, poster) VALUES (:title, :releaseYear, :duration, :description, :genre, :poster)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'title' => $title,
            'releaseYear' => $releaseYear,
            'duration' => $duration,
            'description' => $description,
            'genre' => $genre,
            'poster' => $poster
            ]);
        
    } else   {
        $sql = "UPDATE Movie SET title = :title, releaseYear = :releaseYear, duration = :duration, description = :description, genre = :genre, poster = :poster WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
        'id'          => $id, 
        'title'       => $title,
        'releaseYear' => $releaseYear,
        'duration'    => $duration,
        'description' => $description,
        'genre'       => $genre,
        'poster'      => $poster
    ]);
    }return true;
}

public function findById($id) {
    $sql = "SELECT * FROM Movie WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$data) return null;

    return new Movie(
        $data['id'],
        $data['title'],
        $data['releaseYear'],
        $data['duration'], 
        $data['description'],
        $data['genre'],
        $data['poster']
    );
}

}