<?php
include_once 'back/session_check.php';;
?>


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
    <link rel="stylesheet" href="css/modal-report.css">
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
              <h1>Propiedades <span class="name">Habilitadas</span></h1>
            </div>
            <div class="report-buttons">
              <button onclick="showReportModal()" class="report-btn primary">Generar Reporte</button>
              <button onclick="window.location.href='crear_propiedad.php';" class="report-btn secondary">Crear Inmueble +</button>
            </div>
          </div>

          <div class="properties-grid" id="propertiesGrid">
            <?php
              require_once('back/conection.php');
              $sql = 'SELECT * FROM inmueble where estado = "habilitada";';
              $res = mysqli_query($con, $sql);
              $cantFilas = mysqli_num_rows($res);
 
              if ($res && $cantFilas > 0) {
                  while ($fila = mysqli_fetch_assoc($res)) {
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
                      echo '<div class="property-card" onclick = "redirectToDetails('.$fila['id_inmueble'].')">';
                      echo '<img src="' . $imagenSrc . '" alt="Imagen" class="property-image">';
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

    <div class="modal" id="reportModal">
      <div class="modal-content">
        <button class="close-modal" onclick="hideReportModal()">&times;</button>
        <h2>Selecciona el formato del reporte</h2>
        <div class="modal-buttons">
          <button class="btn-primary" onclick="generatePDF()">PDF</button>
          <button class="btn-primary" onclick="generateExcel()">Excel</button>
          <button class="btn-secondary" onclick="generateBoth()">Ambos</button>
        </div>
      </div>
    </div>

    <script>
      const modal = document.getElementById("reportModal");

      function showReportModal() {
        modal.style.display = "flex"; 
      }

      function hideReportModal() {
        modal.style.display = "none"; 
      }

      function generatePDF() {
        window.open('back/fpdf/reporte.php');
        hideReportModal();
      }

      function generateExcel() {
        window.location.href = 'back/reporteexcel.php';
        hideReportModal();
      }

      function generateBoth() {
        window.open('back/fpdf/reporte.php');
        window.location.href = 'back/reporteexcel.php';
        hideReportModal();
      }
      function redirectToDetails(id) {
      window.location.href = 'click-prop.php?id=' + id;
      }
    </script>
  </body>
</html>
