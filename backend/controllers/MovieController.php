<?php
require_once __DIR__ . '/../repositories/MovieRepository.php';

class MovieController {
    private $repository;

    public function __construct($pdo) {
        $this->repository = new MovieRepository($pdo);
    }

    public function index() {
        return $this->repository->findAll();
    }

    public function store($data) {
        if (!empty($data['title']) && !empty($data['annee_sortie']) && !empty($data['duration'])  && !empty($data['description'])  && !empty($data['genre']) ) {
            return $this->repository->create($data['title'], $data['annee_sortie'], $data['duration'], $data['description'], $date['genre']);
        }
        return false;
    } 

    public function destroy($id) {
        if (!empty($id)) {
            return $this->repository->delete($id);
        }
        return false;
    }
} 