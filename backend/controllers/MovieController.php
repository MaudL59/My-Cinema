<?php
class MovieController {
    private $repo;

    public function __construct($pdo) {
        $this->repo = new MovieRepository($pdo);
    }

    public function index() {
        $data = $this->repo->findAll();
        echo json_encode($data);
    }

    public function save() {
        $id = $_POST['id'] ?? null;
        $title = $_POST['title'];
        $releaseYear = $_POST['releaseYear'];
        $duration = $_POST['duration'];
        $description = $_POST['description'];
        $genre = $_POST['genre'];
        $poster = $_POST['poster'];

        $this->repo->save($id, $title, $releaseYear, $duration, $description, $genre, $poster);
        echo json_encode(['success' => true]);
    }

    public function delete($id) {
        $this->repo->delete($id);
        echo json_encode(['success' => true]);
    }
}