<?php
// require_once("conection.php")

// $sql = "select id_inmueble from inmueble";

// $respuesta = mysqli_query($conexion, $sql);

// //Imprimir los datos
// if ($respuesta  && mysqli_num_rows($respuesta) > 0){

//   while($fila = mysqli_fetch_assoc($resespuesta)){
//   }

  
  
//   }

?>






<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inmobiliaria Emmanuel</title>
    <link rel="stylesheet" href="css/dashboard-admin.css" />
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="icon" href="assets/favicon.ico">
    <link rel="stylesheet" href="css/style.css">
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
      // Datos de muestra de las propiedades
      const properties = Array(8).fill({
          image: './assets/image-house.jpg',
          title: 'Casa em Condominio',
          price: 'R$ 1.050.000'
      });

      // Función para crear tarjetas de propiedad
      function createPropertyCard(property) {
          const card = document.createElement('div');
          card.className = 'property-card';

          card.innerHTML = `
              <img src="${property.image}" alt="${property.title}">
              <div class="property-info">
                  <h3>${property.title}</h3>
                  <div class="property-price">${property.price}</div>
              </div>
          `;

          return card;
      }

      // Función para renderizar todas las propiedades
      function renderProperties() {
          const grid = document.getElementById('propertiesGrid');
          properties.forEach(property => {
              grid.appendChild(createPropertyCard(property));
          });
      }

      // Inicializar la página
      document.addEventListener('DOMContentLoaded', () => {
          renderProperties();
/*
          // Agregar event listeners para los botones
          document.querySelectorAll('.report-btn').forEach(btn => {
              btn.addEventListener('click', () => {
                  alert('Generando reporte...');
              });
          });

          document.querySelector('.logout-btn').addEventListener('click', () => {
              alert('Cerrando sesión...');
          });*/

          // evento de click para redirecciona a las actualizaciones
          const cards =document.querySelectorAll('.property-card');

          cards.forEach(card => {
            card.addEventListener('click', () => {
                window.location.href = 'http://localhost/inmobiliaria/click-prop.php'
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
