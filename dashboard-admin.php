
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

      <?php 
      include('header2.php'); 
      include('back/session_check.php');
      ?>

      <main class="container">
        <div class="container-2">
          <div class="welcome-section">
            <div class="welcome-text">
              <h1>Bienvenido <span class="name">Emmanuel</span></h1>
            </div>
            <div class="report-buttons">
              <button onclick="report()"; class="report-btn primary">Generar Reporte</button>
              <button onclick="window.location.href='crear_propiedad.php';" class="report-btn secondary">Crear Inmueble +</button>
            </div>
          </div>

          <div class="properties-grid" id="propertiesGrid">
            <?php
              require_once('back/conection.php');
              $sql = 'SELECT * FROM inmueble where estado = "habilitado";';
              $res = mysqli_query($con, $sql);
              $cantFilas = mysqli_num_rows($res);

              if ($res && $cantFilas > 0) {
                  while ($fila = mysqli_fetch_assoc($res)) {
                      echo '<div class="property-card" onclick = "redirectToDetails('.$fila['id_inmueble'].')">';
                      echo '<img src="assets/card-image.jpg" alt="Imagen" class="property-image">';
                      echo '<div class="property-info">';
                      echo '<h3>' . $fila['nombre_inmueble'] . '</h3>';
                      echo '<div class="property-price">R$ ' . $fila['precio_inmueble'] . '</div>';
                      echo '</div>';
                      echo '</div>';
                  }
              } else {
                  echo '<p>No hay propiedades disponibles.</p>';
              }
            ?>
          </div>
        </div>
      </main>

      <?php include('footer.php'); ?>
    </div>

    <script>
      /*document.addEventListener('DOMContentLoaded', () => {
        const cards = document.querySelectorAll('.property-card');
        cards.forEach(card => {
          card.addEventListener('click', () => {
            window.location.href = 'click-prop.php';
          });
        });
      });*/

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
      function redirectToDetails(id) {
      window.location.href = 'click-prop.php?id=' + id;
      }
    </script>
  </body>
</html>