<?php
session_start();
?>

<!doctype html>
<html lang="pt">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Loja de Jogos — Layout</title>
<style>
* { box-sizing: border-box; }
html, body { margin:0; height:100%; font-family:Inter, Roboto, Arial, sans-serif; color:#222; background:#f6f7f9; line-height:1.3; }
a { color:inherit; text-decoration:none; }
body { display:flex; flex-direction:column; }
.header { display:flex; align-items:center; justify-content:space-between; padding:10px 20px; background:white; border-bottom:1px solid #e3e6ea; position:sticky; top:0; z-index:20; }
.logo { display:flex; align-items:center; text-decoration:none; color:black; font-size:20px; font-weight:bold; }
.logo img { height:40px; margin-right:10px; border-radius:8px; }
.nav { display:flex; gap:12px; align-items:center; }
.nav-item { position:relative; color:black; cursor:pointer; padding:8px 12px; border-radius:6px; }
.nav-item:hover .dropdown-menu { display:flex; }
.dropdown-menu { display:none; position:absolute; top:110%; left:0; background:#f2f2f2; padding:10px; border-radius:6px; flex-direction:column; min-width:160px; z-index:30; }
.dropdown-menu div { padding:8px 12px; cursor:pointer; font-size:14px; }
.dropdown-menu div:hover { background:#f0f4ff; }
.header-right { display:flex; gap:10px; align-items:center; }
.btn { padding:8px 12px; border-radius:6px; background:#0070f3; color:#fff; border:none; cursor:pointer; font-weight:600; }
.btn.ghost { background:transparent; color:#333; border:1px solid #e0e3e8; }
.container { max-width:1120px; margin:18px auto; padding:0 16px; display:grid; grid-template-columns:1fr 320px; gap:18px; align-items:start; flex:1; }
.games { background:#fff; border-radius:8px; padding:10px; min-height:420px; border:1px solid #eceff3; }
.games-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; }
.search { display:flex; gap:8px; align-items:center; }
.search input { padding:8px 10px; border:1px solid #e1e4e8; border-radius:6px; min-width:220px; }
.cards { display:grid; grid-template-columns:repeat(auto-fill, minmax(220px, 1fr)); gap:10px; margin-left:0; }
.card { border:1px solid #eef1f5; border-radius:8px; overflow:hidden; background:#fff; display:flex; flex-direction:column; height:100%; }
.card .mark { width:100%; height:150px; overflow:hidden; border-radius:8px; margin-bottom:10px; }
.card .mark img { width:100%; height:100%; object-fit:cover; display:block; }
.card .body { padding:10px; display:flex; flex-direction:column; gap:8px; flex:1; }
.card .title { font-size:14px; font-weight:700; }
.card .meta { font-size:12px; color:#666; margin-top:auto; display:flex; justify-content:space-between; align-items:center; }
.price-btn { background-color:#fff; color:#000; border:2px solid #000; border-radius:5px; padding:5px 10px; cursor:pointer; font-weight:bold; transition:all 0.3s ease; }
.price-btn:hover { background-color:#000; color:#fff; }
.sidebar { background:#fff; border-radius:8px; padding:12px; border:1px solid #eceff3; }
.news-slider { display:grid; grid-template-rows:repeat(4, auto); gap:8px; }
.news-item { height:auto; padding:8px; border-bottom:1px solid #f0f2f5; box-sizing:border-box; }
.news-item:last-child { border-bottom:none; }
.news-title { font-weight:700; font-size:14px; margin-bottom:6px; }
.news-meta { font-size:12px; color:#666; }
footer { background:#fff; border-top:1px solid #e6e9ee; }
.footer-inner { max-width:1120px; margin:0 auto; padding:12px 16px; display:flex; gap:12px; align-items:center; justify-content:space-between; font-size:13px; }
.footer-links { display:flex; gap:12px; align-items:center; }
.user-badge { display:flex; align-items:center; gap:6px; padding:6px 10px; border:1px solid #ddd; border-radius:6px; background:#f0f4ff; font-weight:600; cursor:default; }
@media(max-width:880px) { .container { grid-template-columns:1fr; } .header { padding:12px; } .nav { display:none; } }
</style>
</head>
<body>

<header class="header">
  <a href="index.php" class="logo">
    <img src="image/steam.jpg" alt="Steam logo">
    <span>Steam</span>
  </a>

  <nav class="nav" aria-label="Navegação principal">
    <div class="nav-item dropdown">
      Categorias
      <div class="dropdown-menu">
        <div onclick="filterByCategory('all')">Todas</div>
        <div onclick="filterByCategory('Ação')">Ação</div>
        <div onclick="filterByCategory('RPG')">RPG</div>
        <div onclick="filterByCategory('Casual')">Casual</div>
        <div onclick="filterByCategory('Corrida')">Corrida</div>
        <div onclick="filterByCategory('Tiro')">Tiro</div>
        <div onclick="filterByCategory('Esporte')">Esporte</div>
      </div>
    </div>
  </nav>

  <div class="header-right">
    <?php if(isset($_SESSION['user'])): ?>
      <div class="user-badge">
        👤 <?php echo htmlspecialchars($_SESSION['user']); ?>
      </div>
      <form method="POST" action="logout.php" style="display:inline;">
        <button type="submit" class="btn" style="margin-left:6px;">Sair</button>
      </form>
    <?php else: ?>
      <a href="conta.html" class="btn">Conta</a>
    <?php endif; ?>
  </div>
</header>

<main class="container">
  <!-- Блок игр -->
  <section class="games" aria-labelledby="games-heading">
    <div class="games-header">
      <h2 id="games-heading" style="margin:0">Lista de Jogos</h2>
      <div class="search">
        <input id="search" type="search" placeholder="Pesquisar jogos..." />
        <button class="btn" onclick="filterGames()">Buscar</button>
      </div>
    </div>
    <div id="cards" class="cards"></div>

    <div id="pagination" style="display:flex; justify-content:center; gap:10px; margin-top:12px;">
      <button id="prevBtn" class="btn ghost" onclick="prevPage()">←</button>
      <span id="pageInfo" style="align-self:center;"></span>
      <button id="nextBtn" class="btn ghost" onclick="nextPage()">→</button>
    </div>
  </section>

  <!-- Блок новостей -->
  <aside class="sidebar" aria-labelledby="news-heading">
    <h3 id="news-heading" style="margin-top:0">Novidades</h3>
    <div id="news-slider" class="news-slider">
      <div class="news-item">
        <div class="news-title">Grande atualização v1.4</div>
        <div class="news-meta">Descontos e novas missões — 12.10.2025</div>
      </div>
      <div class="news-item">
        <div class="news-title">Evento de Halloween</div>
        <div class="news-meta">Novas skins e desafios — 31.10.2025</div>
      </div>
      <div class="news-item">
        <div class="news-title">Promoção de Black Friday</div>
        <div class="news-meta">Descontos até 70% — 28.11.2025</div>
      </div>
      <div class="news-item">
        <div class="news-title">Novo DLC lançado</div>
        <div class="news-meta">Explore novas regiões — 05.12.2025</div>
      </div>
    </div>
  </aside>
</main>

<footer>
  <div class="footer-inner">
    <div class="footer-links">
      <a href="suporte.html">Suporte</a>
      <a href="privacidade.html">Privacidade</a>
      <a href="informacoes.html">Informações do Site</a>
    </div>
    <div style="opacity:0.8;font-size:13px;">© 2025 Steam</div>
  </div>
</footer>

<script>
const isLoggedIn = <?php echo isset($_SESSION['user']) ? 'true' : 'false'; ?>;
</script>

<script src="scripts.js"></script>
</body>
</html>
