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
  </head>
  <body>

    <div class="contenedor-todo">
      <?php include('header.php'); ?>

      <main>
        <div class="container">
          <div class="container-property">
            <div class="badge">Arrendo</div>
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
            <form id="contactForm">
              <div class="form-group">
                <label for="name">Nombre *</label>
                <input type="text" id="name" required />
              </div>
              <div class="form-group">
                <label for="email">Correo Electrónico *</label>
                <input type="email" id="email" required />
              </div>
              <div class="form-group">
                <label for="phone">Teléfono *</label>
                <input type="tel" id="phone" required />
              </div>
              <div class="form-group">
                <label for="message">Mensaje *</label>
                <textarea id="message" rows="4" required></textarea>
              </div>
              <div class="form-buttons">
                <button type="button" class="btn btn-cancel">Cancelar</button>
                <button type="submit" class="btn btn-submit">Enviar</button>
              </div>
            </form>
          </div>
        </div>

      </main>

      <?php include('footer.php'); ?>
    </div>

    <script>
      const images = [
          './assets/image-house-2.jpg',
          './assets/image-house-2.jpg',
          './assets/image-house.jpg'
      ];
      let currentImageIndex = 0;
      const imageElement = document.getElementById('propertyImage');

      function changeImage(direction) {
          currentImageIndex = (currentImageIndex + direction + images.length) % images.length;
          imageElement.src = images[currentImageIndex];
      }

      document.getElementById('contactForm').addEventListener('submit', function(e) {
          e.preventDefault();
          // Aquí iría la lógica para enviar el formulario
          alert('Formulario enviado con éxito!');
      });
    </script>

  </body>
</html>
