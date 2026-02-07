// screening.js
// fetchScreenings() pour lire le planning
const screeningForm = document.getElementById("screening-form");

function formatDuration(totalMinutes) {
  const hours = Math.floor(totalMinutes / 60);
  const minutes = totalMinutes % 60;
  return `${hours}h${minutes > 0 ? minutes : ""}`;
}

function fetchScreenings() {
  fetch("../backend/index.php?action=getScreenings")
    .then((response) => response.json())
    .then((planning) => {
      const container = document.getElementById("screening-list");
      container.innerHTML = "";

      const timeGutter = `
        <div class="w-20 bg-slate-100 border-r border-slate-200 flex flex-col pt-12 text-slate-400 text-[10px] font-bold shrink-0">
            <div class="h-32 flex flex-col justify-start items-center"><span>11:00</span></div>
            <div class="h-32 flex flex-col justify-start items-center"><span>14:00</span></div>
            <div class="h-32 flex flex-col justify-start items-center"><span>17:00</span></div>
            <div class="h-32 flex flex-col justify-start items-center"><span>20:00</span></div>
            <div class="h-32 flex flex-col justify-start items-center"><span>23:00</span></div>
        </div>`;

      container.innerHTML = timeGutter;

      // On boucle sur chaque jour
      Object.entries(planning).forEach(([date, screenings]) => {
        let dayHtml = `
          <div class="flex-1 min-w-[250px] bg-white border-r border-slate-200 p-4">
            <h3 class="font-bold text-indigo-900 border-b pb-2 mb-4">${date}</h3>
            <div class="flex flex-col gap-4">`;

        // On boucle sur les séances du jour

        screenings.forEach((s) => {
          // On récupère l'heure ici, maintenant que "s" existe
          const dureeFormatee = formatDuration(s.duration);
          const heureBrute = s.screening_date.split(" ")[1];
          const heure = heureBrute.substring(0, 5);

          dayHtml += `
        <div class="p-3 bg-slate-50 rounded-lg border border-slate-100 shadow-sm">
            <p class="font-bold text-sm text-indigo-800 font-weight">${s.title} (${dureeFormatee})</p>
            <p class="text-xs text-slate-900">🕒 ${heure}</p>
            <p class="text-xs text-slate-900 italic">${s.room_name}</p>
            <button onclick="deleteScreening(${s.id})" class="delete-room-btn flex-1 bg-red-50 text-red-600 py-2 rounded-lg text-sm font-semibold hover:bg-red-100 transition-colors">
    Supprimer
        </button>
        </div>`;
        });

        dayHtml += `</div></div>`;
        container.innerHTML += dayHtml;
      });
    })
    .catch((error) => console.error("Erreur planning:", error));
}

const movieSelect = document.getElementById("screening-movie-id");
const roomSelect = document.getElementById("screening-room-id");

function loadMoviesForSelect() {
  fetch("../backend/index.php?action=getMovies")
    .then((response) => response.json())
    .then((movies) => {
      // l'option par défaut
      movieSelect.innerHTML = '<option value=""> Choisir un film </option>';

      movies.forEach((movie) => {
        movieSelect.innerHTML += `<option value="${movie.id}">${movie.title}</option>`;
      });
    });
}

function loadRoomsForSelect() {
  fetch("../backend/index.php?action=getRooms")
    .then((response) => response.json())
    .then((rooms) => {
      roomSelect.innerHTML = '<option value=""> Choisir une salle </option>';

      rooms.forEach((room) => {
        roomSelect.innerHTML += `<option value="${room.id}">${room.name}</option>`;
      });
    });
}

function showScreeningModal() {
  loadMoviesForSelect();
  loadRoomsForSelect();

  // le modal et le formulaire
  const modal = document.getElementById("screening-modal");
  const form = document.getElementById("screening-form");

  // On vide le formulaire (pour les nouveaux ajouts)
  form.reset();
  document.getElementById("screening-id").value = "";

  // On affiche le modal
  modal.classList.remove("hidden");
}

function closeScreeningModal() {
  document.getElementById("screening-modal").classList.add("hidden");
}

// Intercepter l'envoi du formulaire
screeningForm.addEventListener("submit", function (e) {
  e.preventDefault();
  // ne pas recharger

  const formData = new FormData(this);
  // prend toutes tes données (film, salle, date).
  fetch("../backend/index.php?action=saveScreening", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        alert("Séance enregistrée !");
        closeScreeningModal();
        fetchScreenings();
      } else {
        alert("Erreur : " + data.message);
      }
    })
    .catch((error) => console.error("Erreur enregistrement", error));
});

function deleteScreening(id) {
  if (confirm("Voulez-vous vraiment supprimer cette séance ?")) {
    fetch(`../backend/index.php?action=deleteScreening&id=${id}`)
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          fetchScreenings();
        }
      });
  }
}
