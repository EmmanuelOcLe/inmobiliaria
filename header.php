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
      <a href="about.php" class="header-option">Sobre nosotros</a>
      <a href="arrendamiento.php" class="header-option">Servicios</a>
      <a href="login.php" class="header-option">Administración</a>
    </div>
  </nav>
</header>

<script>
    let menuToggle = document.querySelector('.menu-toggle');
let navbarResponsive = document.querySelector('.header-options-container');

// Alternar la clase "active" para mostrar u ocultar el navbar con animación
menuToggle.addEventListener('click', () => {
  navbarResponsive.classList.toggle('active');
});


</script>