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

// AFFICHER LES SALLES
btnSalle.addEventListener("click", () => {
  // On cache les autres sections
  listeFilms.classList.add("hidden");
  listeSeances.classList.add("hidden");

  // On bascule l'affichage de la salle (Si ouvert -> ferme, Si fermé -> ouvre)
  listeSalles.classList.toggle("hidden");

  // On ne charge les données que si on vient d'ouvrir la section
  if (!listeSalles.classList.contains("hidden")) {
    fetchRooms();
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
