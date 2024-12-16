<header>
    <nav class="navbar">
        <a href="index.php" class="header-logo-link">
            <h1 class="header-logo">IE</h1>
        </a>
        <div class="menu-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="header-options-container">
            <a href="index.php" class="header-option">Inicio</a>
            <a href="dashboard-admin.php" class="header-option">Dashboard</a>
            <a href="inhabilitadas.php" class="header-option">Inmuebles Inhabilitados</a>
            <a href="back/logout.php" class="header-option-logout">Cerrar Sesion</a>
        </div>
    </nav>  
</header>
<script>
    let menuToggle = document.querySelector('.menu-toggle');
let navbarResponsive = document.querySelector('.header-options-container');

menuToggle.addEventListener('click', () => {
  navbarResponsive.classList.toggle('active');
});


</script>
