<?php
  include ('back/conection.php');

  $id = intval($_GET['xyz']);
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inmobiliaria Emmanuel</title>
    <link rel="stylesheet" href="css/view-property.css" />
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="assets/favicon.ico">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Se agrega acá la etiqueta php para que se carguen estilos al texto de error -->
    <?php
    if ($id <= 0){
      echo '<h1>No se encontró una propiedad. Por favor vuelva atrás</h1>';
      echo '<a class="error-link" href="index.php">Volver</a>';
      exit;
    }
    if (!$con) {
      die("<p>Error de conexión: " . mysqli_connect_error() . "</p>");
    }
    ?>
  </head>
  <body>

    <div class="contenedor-todo">
      <?php include('header.php'); ?>

      <?php
      $sql = 'SELECT * FROM inmueble where id_inmueble = '.$id. ' and estado = "Habilitada"';
      $res = mysqli_query($con, $sql);

      // Para verificar que si haya un resultado
      if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
      } 
      else {
          $row = null;
      }
      ?>

      <?php
      if ($row):
      ?>      

      <main>
        <div class="container">
          <div class="container-property">
          <div class="back-button-container">
            <a href="index.php" class="back-button"> 
            <i class='bx bx-arrow-back'></i>
               Volver
              </a>
          </div>
            <div class="header-info">
              <div class="header-title">
                <h1 class="property-title">
                  <?php
                    echo htmlspecialchars($row['nombre_inmueble']);
                  ?>
                  -
                   <span class="span-oferta">
                    <?= htmlspecialchars($row['tipo_oferta'] ?? 'oferta no valida') ?>
                  </span>
                </h1>
                <div class="property-details">
                  <div class="detail-item">
                    <span class="icon-location">Ubicación: </span>
                    <span>
                    <?php
                    echo htmlspecialchars($row['ubicacion_inmueble']);
                    ?>
                    </span>
                  </div>
                  <div class="detail-item">
                    <span class="icon-bed">Habitaciones: </span>
                    <span>
                    <?php
                    echo htmlspecialchars($row['cantidad_habitaciones']);
                    ?>
                    </span>
                  </div>
                  <div class="detail-item">
                    <span class="icon-bath">Baños: </span>
                    <span>
                    <?php
                    echo htmlspecialchars($row['cantidad_baños']);
                    ?>
                    </span>
                  </div>
                  <div class="detail-item">
                    <span class="icon-area">Area: </span>
                    <span>
                    <?php
                    echo htmlspecialchars($row['area']);
                    ?>
                    m<sup>2</sup>
                    </span>
                  </div>
                  <div class="detail-item">
                    <span class="icon-parking">Zonas parqueo: </span>
                    <span>
                    <?php
                    echo htmlspecialchars($row['zona_parqueo']);
                    ?>
                    </span>
                  </div>
                </div>
              </div>
              <div class="price-container">
                <p class="property-price">$</p>
                <p class="property-price" id="precio-text">
                  <?php
                  echo htmlspecialchars($row['precio_inmueble']);
                  ?>
                </p>
              </div>
            </div>
            <div class="slider-container">
              <img
                src="assets/image-house.jpg"
                alt="Propiedad"
                class="slider-image"
                id="propertyImage"
              />
              <button class="slider-button prev" type="reset" onclick="changeImage(-1)">
                ←
              </button>
              <button class="slider-button next" onclick="changeImage(1)">→</button>
            </div>

            <p class="property-description">
              <?php
              echo htmlspecialchars($row['descripcion_inmueble']);
              ?>
            </p>
          </div>
          <div class="contact-form">
            <h2 class="form-title">Estoy Interezado!</h2>
            <form id="contactForm" action="https://formsubmit.co/emanuellemus119@gmail.com" method="POST">
              <div class="form-group">
                <label for="name">Nombre *</label>
                <input type="text"  name ="text" id="name" required />
              </div>
              <div class="form-group">
                <label for="email">Correo Electrónico *</label>
                <input type="email" name="email" id="email" required />
              </div>
              <div class="form-group">
                <label for="phone">Teléfono *</label>
                <input type="tel"  name="phone" id="phone" required />
              </div>
              <div class="form-group">
                <label for="message">Mensaje *</label>
                <textarea id="message" name="message" rows="4" required></textarea>
              </div>
              <div class="form-buttons">
                <button type="submit" class="btn btn-submit">Enviar</button>
              </div>
            </form>
          </div>
        </div>

      </main>

      <?php else: ?>
        <h1>No se encontró una propiedad válidad para el ID especificado.</h1>
      <?php endif; ?>

      <?php include('footer.php'); ?>
    </div>

    <script>

      // Arreglo con las rutas de las imágenes
      const images = [
        './assets/image-house.jpg',
        './assets/image-house-2.jpg',
        './assets/image-house-3.jpg'
      ];

      // Índice para llevar el control de la imagen actual
      let currentImageIndex = 0;

      // Elemento de la imagen en el HTML
      const imageElement = document.getElementById('propertyImage');

      // Función para cambiar la imagen
      function changeImage(direction) {
        // Cambiar el índice según la dirección
        currentImageIndex = (currentImageIndex + direction + images.length) % images.length;
        
        // Cambiar la fuente y el texto alternativo de la imagen
        imageElement.src = images[currentImageIndex];
        imageElement.alt = `Imagen ${currentImageIndex + 1} de la propiedad`;
      }

      let price = document.getElementById('precio-text').innerText;
      
      let precioFormateado = '';

      let precioFinal;

      let cont = 0;

      function formatoTexto(){
        for (let i = price.length; i > 0; i--){
          cont ++;
          precioFormateado += price[i - 1];
          console.log(precioFormateado);
          if (cont % 3 === 0 && cont !== price.length){
            precioFormateado += '.';
          }
        }

        precioFinal = precioFormateado.split('').reverse().join('');

      }
      formatoTexto();

      document.getElementById('precio-text').textContent = precioFinal;
      
    </script>

  </body>
</html>
