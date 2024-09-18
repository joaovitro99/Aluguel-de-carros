
<div class="sidebar">
    <div class="logo">
        <h1>Alucarros</h1>
    </div>
    <ul class="menu">
        <li><a href="usuarios.php" class="<?= basename($_SERVER['PHP_SELF']) == 'usuarios.php' ? 'active' : '' ?>">Usuários</a></li>
        <li><a href="veiculos.php" class="<?= basename($_SERVER['PHP_SELF']) == 'veiculos.php' ? 'active' : '' ?>">Veículos</a></li>
        <li><a href="rendimento.php" class="<?= basename($_SERVER['PHP_SELF']) == 'rendimento.php' ? 'active' : '' ?>">Rendimento</a></li>
    </ul>
</div>

<div class="main-content">
    <div class="search-bar-container">
        <input type="text" class="search-bar" placeholder="Buscar...">
    </div>