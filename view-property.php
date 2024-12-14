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
  </head>
  <body>

    <div class="contenedor-todo">
      <?php include('header.php'); ?>

      <main>
        <div class="container">
          <div class="container-property">
          <div class="back-button-container">
            <a href="index.php"> 
            <i class='bx bx-arrow-back'></i>
               Volver
              </a>
          </div>
            <div class="header-info">
              <div class="header-title">
                <h1 class="property-title">Casa en Condominió</h1>
                <p class="property-location">Parque Residente Dahma III</p>
              </div>
              <p class="property-price">$ 150.000.000.00</p>
            </div>
            <div class="slider-container">
              <img
                src="assets/image-house.jpg"
                alt="Propiedad"
                class="slider-image"
                id="propertyImage"
              />
              <button class="slider-button prev" onclick="changeImage(-1)">
                ←
              </button>
              <button class="slider-button next" onclick="changeImage(1)">→</button>
            </div>

            <div class="property-details">
              <div class="detail-item">
                <span>📍</span>
                <span>cra 10 nro 20 50</span>
              </div>
              <div class="detail-item">
                <span>🛏️</span>
                <span>4 Habitaciones</span>
              </div>
              <div class="detail-item">
                <span>🚿</span>
                <span>5 Baños</span>
              </div>
              <div class="detail-item">
                <span>📏</span>
                <span>15 m2</span>
              </div>
              <div class="detail-item">
                <span>🅿️</span>
                <span>2 Zonas de Parking</span>
              </div>
            </div>
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
                <button type="button" class="btn btn-cancel" id="cancelar">Cancelar</button>
                <button type="submit" class="btn btn-submit">Enviar</button>
              </div>
            </form>
          </div>
        </div>

      </main>

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

      
    </script>

  </body>
</html>
