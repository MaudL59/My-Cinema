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
          const heure = s.screening_date.split(" ")[1];

          dayHtml += `
        <div class="p-3 bg-slate-50 rounded-lg border border-slate-100 shadow-sm">
            <p class="font-bold text-sm text-indigo-800 font-weight">${s.title}</p>
            <p class="text-xs text-slate-900">🕒 ${heure}</p>
            <p class="text-xs text-slate-900 italic">Salle : ${s.room_name}</p>
        </div>`;
        });

        dayHtml += `</div></div>`;
        container.innerHTML += dayHtml;
      });
    })
    .catch((error) => console.error("Erreur planning:", error));
}
