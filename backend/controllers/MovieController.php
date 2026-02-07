<?php
class MovieController {
    private $repo;

    public function __construct($pdo) {
        $this->repo = new MovieRepository($pdo);
    }

    public function index() {   
        // pour afficher tous les films dans le formulaire des seances   
        if (!isset($_GET['page'])) {
        $allMovies = $this->repo->findAll();
        echo json_encode(['movies' => $allMovies]);
        return; // On s'arrête là
    }
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 8; 
        $offset = ($page - 1) * $limit;
    
        $movies = $this->repo->findPaginated($limit, $offset);
        $totalMovies = $this->repo->countAll();
        $totalPages = ceil($totalMovies / $limit);
   
        echo json_encode([
            'movies' => $movies,
            'totalPages' => $totalPages,
            'currentPage' => $page
    ]);
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

    
