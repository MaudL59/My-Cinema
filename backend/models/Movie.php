<?php
class Movie {
    public $id;
    public $title;
    public $annee_sortie;
    public $duration;
    public $description;
    public $genre;

    public function __construct($id, $title, $annee_sortie, $duration, $description, $genre) {
    $this->id = $id;
    $this->title = $title;
    $this->annee_sortie = $annee_sortie;
    $this->duration = $duration;
    $this->description = $description;
    $this->genre = $genre;
}
}