// ---------- ИНФОРМАЦИЯ О ПОЛЬЗОВАТЕЛЕ ----------
// Эта переменная создается в index.php через PHP
// <script>const isLoggedIn = <?php echo isset($_SESSION['user']) ? 'true' : 'false'; ?>;</script>

// ---------- БАЗА ДАННЫХ ИГР ----------
const games = [
  { title: "The Witcher 3: Wild Hunt", genre: "RPG / Aventura", price: "€29.99", image: "image/the-witcher-3.jpg"},
  { title: "Cyberpunk 2077", genre: "RPG / Ação", price: "€59.99", image: "image/Cyberpunk2077.jpg"},
  { title: "Minecraft", genre: "Aventura / Simulação", price: "€26.95", image: "image/Minecraft.jpg"},
  { title: "Among Us", genre: "Casual / Multiplayer", price: "Grátis", image: "image/AmongUs.jpg"},
  { title: "Fortnite", genre: "Ação / Battle Royale", price: "Grátis", image: "image/Fortnite.jpg"},
  { title: "Call of Duty: Modern Warfare", genre: "Tiro / Ação", price: "€49.99", image: "image/Call_of_Duty_Modern_Warfare.jpg"},
  { title: "FIFA 23", genre: "Esporte / Multiplayer", price: "€39.99", image: "image/FIFA_23.jpg"},
  { title: "Assassin's Creed Valhalla", genre: "Aventura / RPG", price: "€59.99", image: "image/Assassin's_Creed_Valhalla.jpg"},
  { title: "League of Legends", genre: "Multiplayer / MOBA", price: "Grátis", image: "image/League_of_Legends.jpg"},
  { title: "Genshin Impact", genre: "RPG / Ação", price: "Grátis", image: "image/Genshin_Impact.jpg"},
  { title: "Hades", genre: "Ação / Roguelike", price: "€24.99", image: "image/Hades.jpg"},
  { title: "Stardew Valley", genre: "Simulação / Casual", price: "€14.99", image: "image/Stardew_Valley.jpg"},
  { title: "Rocket League", genre: "Esporte / Corrida", price: "Grátis", image: "image/Rocket_League.jpg"},
  { title: "Grand Theft Auto V", genre: "Ação / Mundo aberto", price: "€29.99", image: "image/Grand_Theft_Auto_V.jpg"},
  { title: "Dead by Daylight", genre: "Terror / Multiplayer", price: "€19.99", image: "image/Dead_by_Daylight.jpg"},
  { title: "Valorant", genre: "Tiro / Multiplayer", price: "Grátis", image: "image/Valorant.jpg"},
  { title: "Overwatch 2", genre: "Tiro / Multiplayer", price: "Grátis", image: "image/Overwatch_2.jpg"},
  { title: "Elden Ring", genre: "RPG / Ação", price: "€59.99", image: "image/Elden_Ring.jpg"},
  { title: "Dota 2", genre: "Multiplayer / MOBA", price: "Grátis", image: "image/Dota_2.jpg"},
  { title: "The Sims 4", genre: "Simulação / Casual", price: "€39.99", image: "image/The_Sims_4.jpg"},
  { title: "Among Trees", genre: "Aventura / Simulação", price: "€19.99", image: "image/Among_Trees.jpg"},
  { title: "Horizon Forbidden West", genre: "Aventura / RPG", price: "€69.99", image: "image/Horizon_Forbidden_West.jpg"},
  { title: "Resident Evil Village", genre: "Terror / Ação", price: "€49.99", image: "image/Resident_Evil_Village.jpg"},
  { title: "Terraria", genre: "Aventura / Sandbox", price: "€9.99", image: "image/Terraria.jpg"},
  { title: "F1 23", genre: "Corrida / Esporte", price: "€49.99", image: "image/F1_23.jpg"},
  { title: "Baldur's Gate 3", genre: "RPG / Estratégia", price: "€69.99", image: "image/Baldur's_Gate 3.jpg"},
  { title: "Forza Horizon 5", genre: "Corrida / Esporte", price: "€59.99", image: "image/Forza_Horizon_5.jpg"},
  { title: "Red Dead Redemption 2", genre: "Aventura / Mundo aberto", price: "€49.99", image: "image/Red_Dead_Redemption_2.jpg"},
  { title: "No Man’s Sky", genre: "Aventura / Exploração", price: "€29.99", image: "image/No_Man’s_Sky.jpg"},
  { title: "Apex Legends", genre: "Tiro / Battle Royale", price: "Grátis", image: "image/Apex_Legends.jpg"},
  { title: "PUBG: Battlegrounds", genre: "Tiro / Sobrevivência", price: "Grátis", image: "image/PUBG_Battlegrounds.jpg"},
  { title: "Destiny 2", genre: "Tiro / Sci-fi", price: "Grátis", image: "image/Destiny_2.jpg"},
  { title: "Sea of Thieves", genre: "Aventura / Multiplayer", price: "€39.99", image: "image/Sea_of_Thieves.jpg"},
  { title: "Dark Souls III", genre: "RPG / Ação", price: "€49.99", image: "image/Dark_Souls_III.jpg"},
  { title: "Hollow Knight", genre: "Aventura / Plataforma", price: "€14.99", image: "image/Hollow_Knight.jpg"},
  { title: "Subnautica", genre: "Aventura / Sobrevivência", price: "€29.99", image: "image/Subnautica.jpg"},
  { title: "Sons of the Forest", genre: "Terror / Sobrevivência", price: "€29.99", image: "image/Sons_of_the_Forest.jpg"},
  { title: "The Last of Us Part I", genre: "Ação / Drama", price: "€69.99", image: "image/The_Last_of_Us_Part_I.jpg"},
  { title: "Alan Wake 2", genre: "Terror / Aventura", price: "€59.99", image: "image/Alan_Wake_2.jpg"},
  { title: "Helldivers 2", genre: "Tiro / Cooperação", price: "€39.99", image: "image/Helldivers_2.jpg"},
];

let currentPage = 1;
const gamesPerPage = 10;
let filteredGames = [...games];

// ---------- ФУНКЦИЯ ПОКУПКИ ----------
function buyGame(gameName) {
  if (isLoggedIn) {
    window.location.href = `comprar.html?game=${encodeURIComponent(gameName)}`;
  } else {
    alert("Faça login para comprar!");
  }
}

// ---------- ГЕНЕРАЦИЯ КАРТОЧЕК ----------
function loadGames(list) {
  const container = document.getElementById("cards");
  container.innerHTML = "";

  const start = (currentPage - 1) * gamesPerPage;
  const end = start + gamesPerPage;
  const pageGames = list.slice(start, end);

  pageGames.forEach(g => {
    const buyButton = isLoggedIn
      ? `<button class="price-btn" onclick="buyGame('${g.title}')">${g.price}</button>`
      : `<button class="price-btn" onclick="alert('Faça login para comprar!')">${g.price}</button>`;

    container.innerHTML += `
      <article class="card" data-title="${g.title}">
        <div class="mark">
          <img src="${g.image}" alt="${g.title}">
        </div>
        <div class="body">
          <div class="title">${g.title}</div>
          <div class="meta">
            <span class="genre">${g.genre}</span>
            ${buyButton}
          </div>
        </div>
      </article>
    `;
  });

  updatePagination(list.length);
}

// ---------- ПАГИНАЦИЯ ----------
function updatePagination(totalItems) {
  const totalPages = Math.ceil(totalItems / gamesPerPage);
  document.getElementById("pageInfo").textContent = `Página ${currentPage} de ${totalPages}`;
  document.getElementById("prevBtn").disabled = currentPage === 1;
  document.getElementById("nextBtn").disabled = currentPage === totalPages;
}

function nextPage() {
  const totalPages = Math.ceil(filteredGames.length / gamesPerPage);
  if (currentPage < totalPages) {
    currentPage++;
    loadGames(filteredGames);
    scrollToTop();
  }
}

function prevPage() {
  if (currentPage > 1) {
    currentPage--;
    loadGames(filteredGames);
    scrollToTop();
  }
}

function scrollToTop() {
  document.querySelector(".games").scrollIntoView({ behavior: "smooth" });
}

// ---------- ФИЛЬТРЫ И ПОИСК ----------
function filterByCategory(category) {
  currentPage = 1;
  filteredGames = category === "all"
    ? [...games]
    : games.filter(g => g.genre.toLowerCase().includes(category.toLowerCase()));
  loadGames(filteredGames);
}

function filterGames() {
  const q = document.getElementById("search").value.trim().toLowerCase();
  currentPage = 1;
  filteredGames = games.filter(g => g.title.toLowerCase().includes(q));
  loadGames(filteredGames);
}

document.addEventListener("DOMContentLoaded", () => {
  loadGames(games);

  document.getElementById("search").addEventListener("keydown", function(e) {
    if (e.key === "Enter") filterGames();
  });

  // ---------- Новости (без слайдера) ----------
  const newsSlider = document.getElementById("news-slider");
  const newsItems = newsSlider.querySelectorAll(".news-item");
  newsItems.forEach(item => item.style.display = "block");

  // ---------- Если есть GET параметр game ----------
  const urlParams = new URLSearchParams(window.location.search);
  const selectedGame = urlParams.get('game');
  if (selectedGame) {
    const payHeading = document.getElementById('pay-heading');
    if (payHeading) payHeading.textContent = `Pagamento — ${selectedGame}`;
  }
});