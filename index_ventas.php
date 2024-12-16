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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
          <h2 class="header-text-title">Más de 7 años trabajando <br/> en el mercado inmobiliario.</h2>
          <br>
          <p class="header-text-p">
          Especialistas en alquiler y venta de propiedades de alta gama. <br/> Siendo asi una de las mejores inmobiliarias en todo Colombia.
          </p>
        </div>
      </div>
    </header>

    <main class="main-tag">
        
      <?php 
      require_once('back/conection.php');

      $sql = 'SELECT DISTINCT id_inmueble, 
      nombre_inmueble, ubicacion_inmueble, precio_inmueble, tipo_oferta, 
        CONCAT(
          "<i class=\'fas fa-bath\'></i> ", cantidad_baños, " baños, ",
          "<i class=\'fas fa-bed\'></i> ", cantidad_habitaciones, " habitaciones, ",
          "<i class=\'fas fa-car\'></i> ", zona_parqueo, " garages"
        ) AS "x"
FROM inmueble 
WHERE estado = "habilitada" AND tipo_oferta IN ("Venta", "venta-arriendo") order by tipo_oferta';


      $res = mysqli_query($con, $sql);
      $cantFilas = mysqli_num_rows($res);

      if ($res && mysqli_num_rows($res) > 0){ // Verifica si la variable $res contiene un valor válido. Luego verifica si tiene almenos una fila


       

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
                        echo '<h2 class="card-price">COP$ '.$fila['precio_inmueble'].' </h2>';
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