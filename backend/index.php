<?php
// On ajuste les chemins car on est déjà DANS le dossier backend
require_once 'config/database.php';
require_once 'controllers/MovieController.php';

// Initialisation
$controller = new MovieController($pdo);
$movies = $controller->index();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>My Cinema - Backend</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Liste des Films (Admin)</h1>
            <span class="badge bg-primary"><?= count($movies) ?> films trouvés</span>
        </div>
        
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Titre</th>
                            <th>Année</th>
                            <th>Durée</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($movies as $movie): ?>
                        <tr>
                            <td><?= $movie->id ?></td>
                            <td><strong><?= $movie->titre ?></strong></td>
                            <td><?= $movie->annee_sortie ?></td>
                            <td><?= $movie->duree ?> min</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>