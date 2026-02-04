// rooms.js
function fetchRooms() {
  fetch("../backend/index.php?action=getRooms")
    .then((response) => response.json())
    .then((rooms) => {
      const container = document.getElementById("room-list");
      container.innerHTML = "";

      rooms.forEach((room) => {
        container.innerHTML += `
        <div class="group relative bg-white rounded-xl shadow-md overflow-hidden flex flex-col h-full border border-slate-200 transition-all duration-300">
            
            <div class="p-4 flex flex-col flex-grow bg-white z-10">
                <h2 class="font-bold text-lg mb-1 truncate">${room.name}</h2>
                <p class="text-xs text-red-600 font-medium">${room.capacity} sièges</p>
                <p class="text-xs text-indigo-600 font-medium">${room.type}</p>
                
            </div>
        </div>
    `;
      });
      console.log(rooms);
    })
    .catch((error) => console.error("Erreur :", error));
}
