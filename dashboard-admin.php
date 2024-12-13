<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inmobiliaria Emmanuel</title>
    <link rel="stylesheet" href="css/dashboard-admin.css" />
    <link rel="stylesheet" href="css/global.css" />
    <link rel="stylesheet" href="css/footer.css" />
    <link rel="stylesheet" href="css/header.css" />
    <link rel="icon" href="assets/favicon.ico" />
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <div class="contenedor-todo">
      <?php include('header2.php'); ?>

        <main class="container">
          <div class="container-2">
            <div class="welcome-section">
              <div class="welcome-text">
                <h1>Bienvenido <span class="name">Emmanuel</span></h1>
              </div>
              <div class="report-buttons">
                <button onclick="report()"  class="report-btn primary">Generar Reporte</button>
                <button onclick="window.location.href='crear_propiedad.php';"  class="report-btn secondary">Crear Inmueble +</button>
              </div>
            </div>
    
            <div class="properties-grid" id="propertiesGrid">
              
            </div>
          </div>
        </main>

      <?php include('footer.php'); ?>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const cards = document.querySelectorAll('.property-card');
        cards.forEach(card => {
          card.addEventListener('click', () => {
            window.location.href = 'http://localhost/inmobiliaria/click-prop.php';
          });
        });
      });

      function report() {
        
        let res = prompt("Si desea descargar el reporte en pdf: 1 \n Si desea descargar el reporte en excel: 2 \n Si desea ambos: 3");

        if (res == 1) {
          window.open('back/fpdf/reporte.php')
        } else if (res == 2) {
          window.location.href = 'back/reporteexcel.php';
        } else if (res == 3) {
          window.open('back/fpdf/reporte.php')
          window.location.href = 'back/reporteexcel.php';

        }

      }
    </script>
  </body>
</html>
