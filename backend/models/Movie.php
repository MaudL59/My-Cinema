<?php
class Movie {
    public $id;
    public $titre;
    public $annee_sortie;
    public $duree;

    public function __construct($id, $titre, $annee_sortie, $duree) {
    $this->id = $id;
    $this->titre = $titre;
    $this->annee_sortie = $annee_sortie;
    $this->duree = $duree;
}
}