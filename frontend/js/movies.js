// movies.js
function fetchMovies() {
  fetch("../backend/index.php?action=getMovies")
    .then((response) => response.json())
    .then((movies) => {
      const container = document.getElementById("movie-list");
      container.innerHTML = "";

      movies.forEach((movie) => {
        container.innerHTML += `
            <div class="bg-white rounded-xl shadow-md my-2 p-4">
                <h2 class="font-bold">${movie.title} </h2>
                <p>${movie.description}</p>
            </div>
        `;
      });
      console.log(movies);
    })

    .catch((error) => console.error("Erreur :", error));
}
