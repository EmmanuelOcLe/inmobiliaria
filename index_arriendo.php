<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/global.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="icon" href="assets/favicon.ico">
  <title>Inmobiliaria Emmanuel</title>
</head>
<body>

  <div class="contenedor-todo">

    <header class="header-tag">
      <div class="header-bg-img-container">
        <img src="assets/header-image-1.jpg" alt="" class="header-bg-img">
        <img src="assets/header-image-2.jpg" alt="" class="header-bg-img">
        <img src="assets/header-image-3.jpg" alt="" class="header-bg-img">
        <img src="assets/header-image-4.jpg" alt="" class="header-bg-img">
      </div>
      <div class="header-background">
        <nav class="navbar">
          <a href="index.html" class="header-logo-link">
            <h1 class="header-logo">IE</h1>
          </a>
          <div class="header-options-container">
            <a href="index.php" class="header-option">Inicio</a>
            <a href="about.php#contactSection" class="header-option">Contacto</a>
            <a href="about.php" class="header-option">Sobre nosotros</a>
            <a href="arrendamiento.php" class="header-option">Servicios</a>
            <a href="login.php" class="header-option">Administración</a>
          </div>
        </nav>
        <div class="header-text">
          <h2 class="header-text-title">Mais de 7 anos atuando <br/> no mercado imobiliário</h2>
          <p class="header-text-p">
            Especialistas em aluguel e venda de imóveis de alto <br/> padrão na região de Presidente Prudent e cidades vizinhas.
          </p>
        </div>
      </div>
    </header>

    <main class="main-tag">
        
      <?php 
      require_once('back/conection.php');

      $sql = 'SELECT id_inmueble, 
      nombre_inmueble, ubicacion_inmueble, precio_inmueble, tipo_oferta,
      CONCAT(cantidad_baños, " baños ", ", ", cantidad_habitaciones, " suites ", ", ", zona_parqueo, " garages") AS "x"
      FROM inmueble WHERE tipo_oferta = "arriendo" AND estado = "habilitada"';

      $res = mysqli_query($con, $sql);
      $cantFilas = mysqli_num_rows($res);

      if ($res && mysqli_num_rows($res) > 0){


        while($fila = mysqli_fetch_assoc($res)){
          
          

         

          echo '<div class="card">';
              echo '<img src="assets/card-image.jpg" alt="Imagen" class="card-image">';
              echo '<div class="card-info-container">';
                echo '<h3 class="card-title"> '.$fila['nombre_inmueble'].' </h3>';
                echo '<span class="card-info"> '.$fila['ubicacion_inmueble'].' </span>';
                echo '<h2 class="card-price">R$ '.$fila['precio_inmueble'].' </h2>';
                echo '<span class="card-info"> '.$fila['x'].' </span><span class="card-offer" id="oferta">'.$fila['tipo_oferta'].'</span>';
              echo '</div>';
            echo '</div>';

          
        }
      }
      ?>
    </main>

    <?php include('footer.php'); ?>

  </div>
  <script src="scripts/index.js"></script>
</body>
</html>