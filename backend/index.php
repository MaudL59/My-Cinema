<?php
require_once 'config/database.php';
require_once 'controllers/MovieController.php';

$controller = new MovieController($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'create') {
            $controller->store($_POST);
        } 
        // Boutons suprimer
        elseif ($_POST['action'] === 'delete') {
            $controller->destroy($_POST['id']);
        }
    }
    header("Location: index.php");
    exit;
}

$films = $controller->index();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="MY-CINEMA" content="box-office d'un cinéma">
    <title>Gestion Cinéma - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 font-sans text-slate-900">

    <nav class="bg-indigo-900 text-white shadow-lg p-4 mb-8">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold flex items-center gap-2">
                <span>🎬</span> My Cinema <span class="text-white font-light text-sm uppercase tracking-widest ml-2">Espace Administration</span>
            </h1>
        </div>
    </nav>

    <div class="container mx-auto px-4 max-w-6xl">
        
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
            <div class="bg-slate-50 border-b border-slate-200 px-6 py-4">
                <h2 class="text-lg font-semibold text-slate-700">Ajouter un nouveau film</h2>
            </div>
            <div class="p-6">
                <form method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    <input type="hidden" name="action" value="create">
                    
                    <div class="md:col-span-1">
                        <label for="titleFilm" class="block text-sm font-medium text-slate-600 mb-1">Titre du film</label>
                        <input type="text" id="titleFilm" name="title" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                    </div>
                    
                    <div>
                        <label for="anneeSortie" class="block text-sm font-medium text-slate-600 mb-1">Année</label>
                        <input type="number" id="anneeSortie" name="annee_sortie" value="2026" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
                    </div>
                    
                    <div>
                        <label for="durationFilm" class="block text-sm font-medium text-slate-600 mb-1">Durée (min)</label>
                        <input type="number" id="durationFilm" name="duration" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
                    </div>
                     <div>
                        <label for="descriptionFilm" class="block text-sm font-medium text-slate-600 mb-1">Description</label>
                        <input type="text" id="descriptionFilm" name="description" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
                    </div>
                     <div>
                        <label for="genreFilm" class="block text-sm font-medium text-slate-600 mb-1">Genre</label>
                        <input type="text" id="genreFilm" name="genre" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
                    </div>
                    
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-900 text-white font-bold py-2 px-6 rounded-lg transition-colors shadow-md">
                        Enregistrer
                    </button>
                </form>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-sm font-semibold text-slate-600 uppercase tracking-wider">title du Film</th>
                            <th class="px-6 py-4 text-sm font-semibold text-slate-600 uppercase tracking-wider text-center">Année</th>
                            <th class="px-6 py-4 text-sm font-semibold text-slate-600 uppercase tracking-wider text-cenetr">Durée</th>
                            <th class="px-6 py-4 text-sm font-semibold text-slate-600 uppercase tracking-wider text-center">Description</th>
                            <th class="px-6 py-4 text-sm font-semibold text-slate-600 uppercase tracking-wider text-center">Genre</th>
                            <th class="px-6 py-4 text-sm font-semibold text-slate-600 uppercase tracking-wider text-right">Gestion</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php foreach ($films as $film): ?>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="font-bold text-slate-800 text-lg"><?= $film->title ?></span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="bg-slate-100 text-slate-900 px-3 py-1 rounded-full text-xs font-medium">
                                    <?= $film->annee_sortie ?> 
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="bg-slate-100 text-slate-900 px-3 py-1 rounded-full text-xs font-medium">
                                     <?= $film->duration ?> min
                                </span>
                            </td>

                            <td class="px-6 py-4 text-center">
                                <span class="bg-slate-100 text-slate-900 px-3 py-1 rounded-full text-xs font-medium">
                                     <?= $film->description ?> 
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="bg-slate-100 text-slate-900 px-3 py-1 rounded-full text-xs font-medium">
                                     <?= $film->genre ?> 
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right flex justify-end gap-3">
                                <button class="p-2 text-emerald-900 hover:bg-emerald-50 rounded-lg transition-colors" title="Assigner à une salle">
                                Salle 📽️
                                </button>

                                <form method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce film ?');">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?= $film->id ?>">
                                    <button type="submit" class="p-2 text-rose-900 hover:bg-rose-50 rounded-lg transition-colors" title="Supprimer">
                                    Supprimer 🗑️
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
       
    </div>
    <footer class="">

    </footer>

</body>
</html>