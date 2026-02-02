// index.js

// AFFICHER LES FILMS
const btnFilmAffiche = document.getElementById("btn-films");
const listeFilms = document.getElementById("movie-list");

btnFilmAffiche.addEventListener("click", () => {
  listeFilms.classList.toggle("hidden");

  if (!listeFilms.classList.contains("hidden")) {
    fetchMovies(); // Cette fonction sera écrite dans le fichier movies.js
  }
});

// AFFICHER LES SALLES
const btnSalle = document.getElementById("btn-rooms");
const listeSalles = document.getElementById("room-list");

btnSalle.addEventListener("click", () => {
  listeSalles.classList.toggle("hidden");

  if (!listeSalles.classList.contains("hidden")) {
    fetchRooms(); // Cette fonction sera écrite dans ton fichier rooms.js
  }
});

// AFFICHER LES SÉANCES
const btnSeance = document.getElementById("btn-screening");
const listeSeances = document.getElementById("screening-list");

btnSeance.addEventListener("click", () => {
  listeSeances.classList.toggle("hidden");

  if (!listeSeances.classList.contains("hidden")) {
    fetchScreenings(); // Cette fonction sera écrite dans ton fichier screenings.js
  }
});
