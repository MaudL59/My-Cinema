<?php
// Screening.php

class Screening {
    private $releaseYear;
    private $description;
    private $genre;
    public $poster;
    private $id;
    private $movie_id;
    private $room_id;
    private $screening_date; 
    public $title;
    public $duration; 
    private $room_name;

    // C'est un constructeur, il permet d'injecter les données dès la naissance de l'objet.
   
    public function __construct(){
}
    // Comme tous est en private on ne peut rien sortir, il faut faire des getters pour chaque propriétés

     public function getId(){
        return $this -> id;
    }
    public function getMovieId(){
        return $this -> movie_id;
    }
    public function getRoomId(){
        return $this -> room_id;
    }
    public function getScreeningDate(){
        return $this -> screening_date;
    } 
    public function getTitle() { 
        return $this->title;
         }

    public function getDuration() { return $this->duration; 
    }

    public function getRoomName() {
    return $this->room_name;
}

    // Permet à PDO d'injecter le titre même s'il y a un souci de visibilité
public function __set($name, $value) {
    $this->$name = $value;
}

}