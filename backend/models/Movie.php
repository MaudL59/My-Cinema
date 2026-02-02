<?php
// Movie.php
class Movie implements JsonSerializable{
    private $id;
    private $title;
    private $releaseYear;
    private $duration;
    private $description;
    private $genre;
    private $poster;

    // C'est un constructeur, il permet d'injecter les données dès la naissance de l'objet.
    public function __construct($id = null, $title = null, $releaseYear = null, $duration = null, $description = null, $genre = null, $poster = null) {
    $this->id = $id;
    $this->title = $title;
    $this->releaseYear = $releaseYear;
    $this->duration = $duration;
    $this->description = $description;
    $this->genre = $genre;
    $this->poster = $poster;
}
    // Comme tous est en private on ne peut rien sortir, il faut faire des getters pour chaque propriétés

    public function getId(){
        return $this -> id;
    }
    public function getTitle(){
        return $this -> title;
    }
    public function getReleaseYear(){
        return $this -> releaseYear;
    }
    public function getDuration(){
        return $this -> duration;
    }
    public function getDescription(){
        return $this -> description;
    }
    public function getGenre(){
        return $this -> genre;
    }
    public function getPoster(){
        return $this -> poster;
    }
// convertir les minutes en heures et minutes
    public function getFormattedDuration(){
        $hours = floor($this->getDuration() / 60);
        $minutes = $this->getDuration() % 60;
        $durationString = $hours . "h " . ($minutes > 0 ? $minutes . "min" : "");
        return $durationString;
    }

    public function jsonSerialize(): mixed {
        return [
            'id'    => $this->id,
            'title' => $this->title,
            'releaseYear' => $this->releaseYear,
            'duration' => $this->getFormattedDuration(),
            'description' => $this->description,
            'genre' => $this->genre,
            'poster' => $this->poster
        ];

}}