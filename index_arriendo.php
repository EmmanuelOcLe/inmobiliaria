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
          <a href="index.php" class="header-logo-link">
            <h1 class="header-logo">IE</h1>
          </a>
          <div class="header-options-container">
            <a href="index.php" class="header-option">Inicio</a>
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

      $sql = 'SELECT DISTINCT id_inmueble, 
      nombre_inmueble, ubicacion_inmueble, precio_inmueble, tipo_oferta, 
      CONCAT(cantidad_baños, " baños ", ", ", cantidad_habitaciones, " habitaciones ", ", ", zona_parqueo, " garages") AS "x"
      FROM inmueble 
      WHERE estado = "habilitada"';


      $res = mysqli_query($con, $sql);
      $cantFilas = mysqli_num_rows($res);

      if ($res && mysqli_num_rows($res) > 0){


        while($fila = mysqli_fetch_assoc($res)){
          $carpetaImagenes = 'images/properties/' . $fila['id_inmueble'];
          $imagenSrc = 'assets/image.png';
          if (is_dir($carpetaImagenes)) {
            $archivos = scandir($carpetaImagenes);
            foreach ($archivos as $archivo) {
              if ($archivo !== '.' && $archivo !== '..') {
                $imagenSrc = $carpetaImagenes . '/' . $archivo;
                break;
              }
            }
          }
          echo '<div class="card" onclick="redirectToCardInfo('.$fila['id_inmueble'].')">';
                    echo '<img src="' . $imagenSrc . '" alt="Imagen" class="card-image">';
                    echo '<div class="card-info-container">';
                    echo '<div class="card-title-container">';
                      echo '<h3 class="card-title"> '.$fila['nombre_inmueble'].' </h3>';
                      echo '<span class="card-offer" id="oferta">'.$fila['tipo_oferta'].'</span>';
                    echo '</div>';
                    echo '<span class="card-info"><i class="fa-solid fa-location-dot"></i> '.$fila['ubicacion_inmueble'].' </span>';
                    echo "<br>";
                    echo '<span class="card-info"> '.$fila['x'].' </span>';
                        echo '<h2 class="card-price">R$ '.$fila['precio_inmueble'].' </h2>';
                    echo '</div>';
                echo '</div>';

          
        }
      }
      ?>
    </main>

    <?php include('footer.php'); ?>

  </div>
  <script src="scripts/index.js"></script>
  <script>
    function redirectToCardInfo(id){
      window.location.href = 'view-property.php?xyz=' + id;
    }
    function toggleContactSection() {
      const contactSection = document.getElementById('contactSection');
      if (contactSection.style.display === 'block') {
        contactSection.style.display = 'none';
      } else {
        contactSection.style.display = 'block';
      }
    }



  </script>
</body>
</html>