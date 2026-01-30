const btnFilmAffiche = document.getElementById("btn-films");
const listeFilms = document.getElementById("movie-list");

btnFilmAffiche.addEventListener("click", () => {
  listeFilms.classList.toggle("hidden");
});

const btnSalle = document.getElementById("btn-rooms");
const listeSalles = document.getElementById("room-list");

btnSalle.addEventListener("click", () => {
  listeSalles.classList.toggle("hidden");
});
