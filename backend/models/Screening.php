<?php
// Screening.php

class Screening implements JsonSerializable{
   
    
    
    private $id;
    private $movie_id;
    private $room_id;
    private $screening_date; 
    public $title;
    public $duration; 
    private $room_name;
    public $poster;

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
    public function getPoster() {
    return $this->poster;
}

    // Permet à PDO d'injecter le titre même s'il y a un souci de visibilité
public function __set($name, $value) {
    $this->$name = $value;
}


public function jsonSerialize(): mixed {
        return [
            'id'        => $this->id,
            'movie_id'   => $this->movie_id,
            'room_id'    => $this->room_id,
            'screening_date' => $this->screening_date,
            'title'     => $this->title,
            'duration'  => $this->duration,
            'room_name'  => $this->room_name,
            'poster'  => $this->poster

        ];
    }

}