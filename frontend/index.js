// AFFICHER LES FILMS
const btnFilmAffiche = document.getElementById("btn-films");
const listeFilms = document.getElementById("movie-list");

btnFilmAffiche.addEventListener("click", () => {
  listeFilms.classList.toggle("hidden");
});

// AFFICHER LES SALLES
const btnSalle = document.getElementById("btn-rooms");
const listeSalles = document.getElementById("room-list");

btnSalle.addEventListener("click", () => {
  listeSalles.classList.toggle("hidden");
});

// AFFICHER LES SÉANCES
const btnSeance = document.getElementById("btn-screening");
const listeSeances = document.getElementById("screening-list");

btnSeance.addEventListener("click", () => {
  listeSeances.classList.toggle("hidden");
});
