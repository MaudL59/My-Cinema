// movies.js

const movieForm = document.getElementById("movie-form");
const movieModal = document.getElementById("movie-modal");
const btnClose = document.getElementById("close-modal");
let allMovies = [];
const container = document.getElementById("movie-list");

function fetchMovies() {
  fetch("../backend/index.php?action=getMovies")
    .then((response) => response.json())
    .then((movies) => {
      allMovies = movies;
      container.innerHTML = "";

      movies.forEach((movie) => {
        container.innerHTML += `
        <div class="group relative bg-white rounded-xl shadow-md overflow-hidden flex flex-col h-full border border-slate-200 transition-all duration-300">
            <div class="relative aspect-[2/3] overflow-hidden">
                <img src="../frontend/assets/img/${movie.poster}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Affiche">
                <div class="absolute inset-0 bg-indigo-900/90 p-6 flex flex-col justify-center items-center text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <span class="text-white font-bold mb-2">⏱ ${movie.duration}</span>
                    <p class="text-white text-xs line-clamp-6">${movie.description}</p>
                </div>
            </div>
            <div class="p-4 flex flex-col flex-grow bg-white z-10">
                <h2 class="font-bold text-lg mb-1 truncate">${movie.title}</h2>
                <p class="text-xs text-indigo-600 font-medium">${movie.genre}</p>
                <p class="text-xs text-black font-medium">${movie.releaseYear}</p>
            </div>
            <div class="p-4 border-t border-slate-100 flex justify-between gap-2">
                <button 
                    class="edit-movie-btn flex-1 bg-indigo-50 text-indigo-600 py-2 rounded-lg text-sm font-semibold hover:bg-indigo-100 transition-colors"
                    data-id="${movie.id}">
                    Modifier
                </button>
                <button 
                    class="delete-movie-btn flex-1 bg-red-50 text-red-600 py-2 rounded-lg text-sm font-semibold hover:bg-red-100 transition-colors"
                    data-id="${movie.id}">
                    Supprimer
                </button>
            </div>
        </div>
    `;
      });
      console.log(movies);
    })
    .catch((error) => console.error("Erreur :", error));
}

container.addEventListener("click", (e) => {
  const deleteBtn = e.target.closest(".delete-movie-btn");
  const editBtn = e.target.closest(".edit-movie-btn");
  // Bouton Suprimer
  if (deleteBtn) {
    const id = deleteBtn.dataset.id;
    //   Confirmation pour suprimer
    if (confirm("Supprimer ce film ?")) {
      deleteMovie(id);
    }
  }
  // Bouton Modifier
  if (editBtn) {
    const id = editBtn.dataset.id;
    // On cherche le film correspondant dans le tableau 'movies'
    const movieToEdit = allMovies.find((m) => m.id == id);
    showModal(movieToEdit);
  }
});

document.getElementById("open-add-modal").addEventListener("click", () => {
  showModal(); // On n'envoie rien, donc le formulaire sera vide
});

function showModal(movie = null) {
  const modal = document.getElementById("movie-modal");
  const title = document.getElementById("modal-title");

  // On récupère tous tes champs
  const idInput = document.getElementById("movie-id");
  const titleInput = document.getElementById("movie-title-input");
  const yearInput = document.getElementById("movie-releaseYear-input");
  const durationInput = document.getElementById("movie-duration-input");
  const descInput = document.getElementById("movie-description-input");
  const genreInput = document.getElementById("movie-genre-input");
  const imgInput = document.getElementById("movie-img-input");
  console.log("Objet movie complet :", movie);
  if (movie) {
    // --- MODIFICATION ---
    title.textContent = "Modifier le film";
    idInput.value = movie.id;
    titleInput.value = movie.title;
    yearInput.value = movie.releaseYear;
    durationInput.value = movie.duration;
    descInput.value = movie.description;
    genreInput.value = movie.genre;
    imgInput.value = movie.poster;
    const duree = movie.duration || movie.Duration || "";
    durationInput.value = duree;
  } else {
    // --- AJOUT ---
    title.textContent = "Ajouter un film";
    idInput.value = "";
    titleInput.value = "";
    yearInput.value = "";
    durationInput.value = "";
    descInput.value = "";
    genreInput.value = "";
    imgInput.value = "";
  }

  modal.classList.remove("hidden");
}

function deleteMovie(id) {
  fetch("../backend/index.php?action=deleteMovie&id=" + id)
    .then((response) => response.json())
    .then((data) => {
      if (data.success == true) {
        fetchMovies();
      }
    });
  console.log("Données du film :", movie);
}

movieForm.addEventListener("submit", (e) => {
  e.preventDefault();

  const idInput = document.getElementById("movie-id");
  const titleInput = document.getElementById("movie-title-input");
  const yearInput = document.getElementById("movie-releaseYear-input");
  const durationInput = document.getElementById("movie-duration-input");
  const descInput = document.getElementById("movie-description-input");
  const genreInput = document.getElementById("movie-genre-input");
  const imgInput = document.getElementById("movie-img-input");

  console.log("Données prêtes !");

  const formData = new FormData();
  formData.append("id", idInput.value);
  formData.append("title", titleInput.value);
  formData.append("releaseYear", yearInput.value);
  formData.append("duration", durationInput.value);
  formData.append("description", descInput.value);
  formData.append("genre", genreInput.value);
  formData.append("poster", imgInput.value);

  // L'envoi au serveur
  fetch("../backend/index.php?action=saveMovie", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        movieModal.classList.add("hidden"); // Ferme la modale
        fetchMovies(); // Rafraîchit la liste des films
      } else {
        alert("Erreur lors de l'enregistrement");
      }
    })
    .catch((error) => console.error("Erreur :", error));
});

btnClose.addEventListener("click", () => {
  movieModal.classList.add("hidden");
});
