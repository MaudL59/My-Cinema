<?php
class RoomController {
    private $repo;

    public function __construct($pdo) {
        $this->repo = new RoomRepository($pdo);
    }

    public function index() {
        $data = $this->repo->findAll();
        echo json_encode($data);
    }

    public function save() {
        $id = $_POST['id'] ?? null;
        $name = $_POST['name'] ?? null;
        $capacity = $_POST['capacity'] ?? null;
        $type = $_POST['type'] ?? null;

        $this->repo->saveRoom($id, $name, $capacity, $type);
        echo json_encode(['success' => true]);
    }

    public function delete($id) {
        $this->repo->deleteRoom($id);
        echo json_encode(['success' => true]);
    }
}