// rooms.js
let allRooms = [];
const roomContainer = document.getElementById("room-list");
function fetchRooms() {
  fetch("../backend/index.php?action=getRooms")
    .then((response) => response.json())
    .then((rooms) => {
      allRooms = rooms;

      roomContainer.innerHTML = "";

      rooms.forEach((room) => {
        roomContainer.innerHTML += `
        <div class="group relative bg-white rounded-xl shadow-md overflow-hidden flex flex-col h-full border border-slate-200 transition-all duration-300">
            
            <div class="p-4 flex flex-col flex-grow bg-white z-10">
                <h2 class="font-bold text-lg mb-1 truncate">${room.name}</h2>
                <p class="text-xs text-red-600 font-medium">${room.capacity} places</p>
                <p class="text-xs text-indigo-600 font-medium">${room.type}</p>
                
            </div>

            <div class="p-4 border-t border-slate-100 flex justify-between gap-2">
                <button 
                    class="edit-room-btn flex-1 bg-indigo-50 text-indigo-600 py-2 rounded-lg text-sm font-semibold hover:bg-indigo-100 transition-colors"
                    data-id="${room.id}">
                    Modifier
                </button>
                <button 
                    class="delete-room-btn flex-1 bg-red-50 text-red-600 py-2 rounded-lg text-sm font-semibold hover:bg-red-100 transition-colors"
                    data-id="${room.id}">
                    Supprimer
                </button>
            </div>
        </div>
    `;
      });
      console.log(rooms);
    })
    .catch((error) => console.error("Erreur :", error));
}

const addSalle = document.getElementById("add-salle");
const roomModal = document.getElementById("room-modal");
const btnCloseRoom = document.getElementById("close-room");

addSalle.addEventListener("click", () => {
  showRoomModal();
});

btnCloseRoom.addEventListener("click", () => {
  roomModal.classList.add("hidden");
});

const roomForm = document.getElementById("room-form");

roomForm.addEventListener("submit", (e) => {
  e.preventDefault();
  // Rappel e.preventDefault(); pour eviter de recharger la page

  fetch("../backend/index.php?action=saveRoom", {
    method: "POST",
    // Ici, on envoie souvent les données via FormData pour que PHP les reçoive dans $_POST
    body: new FormData(roomForm),
  })
    .then((response) => response.json())
    .then((data) => {
      //  Si l'ajout a réussi :
      // - Ferme le modal
      roomModal.classList.add("hidden");
      // - Vide le formulaire (roomForm.reset())
      roomForm.reset();
      // - Rappelle fetchRooms() pour mettre la liste à jour sans rafraîchir la page
      fetchRooms();
    });
});

roomContainer.addEventListener("click", (e) => {
  const deleteBtn = e.target.closest(".delete-room-btn");
  const editBtn = e.target.closest(".edit-room-btn");

  if (deleteBtn) {
    const id = deleteBtn.dataset.id;
    //   Confirmation pour suprimer
    if (confirm("Supprimer cette salle?")) {
      deleteRoom(id);
    }
  }
  // Bouton Modifier
  if (editBtn) {
    const id = editBtn.dataset.id;
    // On cherche le film correspondant dans le tableau 'room'
    const roomToEdit = allRooms.find((r) => r.id == id);
    showRoomModal(roomToEdit);
  }
});

function showRoomModal(room = null) {
  const modal = document.getElementById("room-modal");
  const name = document.getElementById("room-name");

  // On récupère tous tes champs
  const idInput = document.getElementById("room-id");
  const nameInput = document.getElementById("room-name-input");
  const capacityInput = document.getElementById("room-capacity-input");
  const typeInput = document.getElementById("room-type-input");

  console.log("Objet room complet :", room);
  if (room) {
    // --- MODIFICATION ---
    name.textContent = "Modifier la salle";
    idInput.value = room.id;
    nameInput.value = room.name;
    capacityInput.value = room.capacity;
    typeInput.value = room.type;
  } else {
    // --- AJOUT ---
    name.textContent = "Ajouter une salle";
    idInput.value = "";
    nameInput.value = "";
    capacityInput.value = "";
    typeInput.value = "";
  }

  modal.classList.remove("hidden");
}

function deleteRoom(id) {
  fetch("../backend/index.php?action=deleteRoom&id=" + id)
    .then((response) => response.json())
    .then((data) => {
      if (data.success == true) {
        fetchRooms();
      }
    });
  console.log("Données de la salle :", id);
}
