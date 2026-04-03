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
}