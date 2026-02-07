// screening.js
// fetchScreenings() pour lire le planning
const screeningForm = document.getElementById("screening-form");
function formatDateFr(dateString) {
  const date = new Date(dateString);
  return new Intl.DateTimeFormat("fr-FR", {
    weekday: "long", //
    day: "2-digit",
    month: "long",
  }).format(date);
}

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

      Object.entries(planning).forEach(([date, screenings]) => {
        const dateAffichee = formatDateFr(date);
        let dayHtml = `
          <div class="flex-1 min-w-[300px] bg-white border border-slate-200 rounded-xl shadow-sm m-2">
        <div class="bg-indigo-900 text-white p-3 rounded-t-xl text-center font-bold capitalize">
            ${dateAffichee}
        </div>
        <div class="p-4 flex flex-col gap-3">`;

        screenings.forEach((s) => {
          dayHtml += `
            <div class="border-b border-slate-100 pb-2 last:border-0">
                <p class="font-bold text-slate-800">${s.title}</p>
                <p class="text-xs text-slate-500">
                    🕒 ${s.screening_date.split(" ")[1].substring(0, 5)} — ${s.room_name}
                </p>
                <button onclick="deleteScreening(${s.id})" class="text-[10px] text-red-500 hover:underline">Supprimer</button>
            </div>`;
        });

        dayHtml += `</div></div>`;
        container.innerHTML += dayHtml;
      });
    });
}

const movieSelect = document.getElementById("screening-movie-id");
const roomSelect = document.getElementById("screening-room-id");

function loadMoviesForSelect() {
  fetch("../backend/index.php?action=getMovies")
    .then((response) => response.json())
    .then((data) => {
      movieSelect.innerHTML = '<option value=""> Choisir un film </option>';

      data.movies.forEach((movie) => {
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
