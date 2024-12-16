<?php
include('back/session_check.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si existe el ID en la sesión
$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

if ($id <= 0) {
    echo "<p>No se encontró un ID válido en la sesión. Regrese a la página anterior.</p>";
    exit;
}

// Incluir la conexión a la base de datos
include("back/conection.php");

// Verificar la conexión
if (!$con) {
    die("<p>Error de conexión: " . mysqli_connect_error() . "</p>");
}

// Consultar la base de datos para obtener información del ID
$sql = "SELECT * FROM inmueble WHERE id_inmueble = " . $id;
$res = mysqli_query($con, $sql);

// Verificar si se encontró el registro
if ($res && mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_assoc($res);
} else {
    $row = null;
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/click-prop.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/popup.css">
    <link rel="icon" href="assets/favicon.ico">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Detalles de Propiedad</title>
</head>
<body> 
    <div class="contenedor-todo">
        <?php include('header2.php'); ?>

        <main class="main">
            
            <?php if ($row): ?>
                
                <div class="property-card">
                    <a href="dashboard-admin.php" class="back-button"> 
                        <i class='bx bx-arrow-back'></i>
                        Volver
                    </a>
                    <div class="card-header">
                        <div class="prop-info-container">
                            <h2 class="property-title"><?= htmlspecialchars($row['nombre_inmueble'] ?? 'Nombre no disponible') ?></h2>
                            <div class="property-price">Precio: $<?php echo htmlspecialchars($row['precio_inmueble']); ?></div>
                        </div>
                        <div class="card-actions">
                            <a href="modificar_propiedad.php?id=<?= $row['id_inmueble']; ?>">
                                <span class="icon icon-edit"></span>
                            </a>
                            <span class="icon icon-delete" onclick="showPopup(<?= $row['id_inmueble']; ?>)"></span>
                        </div>
                    </div>
                    
                    <div class="gallery">
                        <img
                            alt="Propiedad"
                            class="slider-image"
                            id="propertyImage"
                        />
                        <button class="slider-button prev" type="reset" onclick="changeImage(-1)">
                            ←
                        </button>
                        <button class="slider-button next" onclick="changeImage(1)">→</button>
                    </div>

                    <div class="property-details">
                        <div class="detail-item">
                            <span class="icon-location">Ubicación:</span>
                            <span><?php echo htmlspecialchars($row['ubicacion_inmueble']); ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="icon-bed">Habitaciones:</span>
                            <span><?php echo htmlspecialchars($row['cantidad_habitaciones']); ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="icon-bath">Baños:</span>
                            <span><?php echo htmlspecialchars($row['cantidad_baños']); ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="icon-area">Área:</span>
                            <span><?php echo htmlspecialchars($row['area']); ?> m²</span>
                        </div>
                        <div class="detail-item">
                            <span class="icon-parking">Zonas de Parking:</span>
                            <span><?php echo htmlspecialchars($row['zona_parqueo']); ?></span>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <p>No se encontró la propiedad con el ID proporcionado.</p>
            <?php endif; ?>
        </main>

        <?php include('footer.php'); ?>
    </div>

    <!-- Popup para deshabilitar el  inmueble -->
    <div class="popup-overlay" id="popup-overlay" onclick="closePopup()"></div>
    <div id="popup" class="popup">
        <form class="popup-form" id="popup-form" action="back/deshabilitar.php" method="POST">
            <h3>Deshabilitar el Inmueble</h3>
            <input type="hidden" id="id_inmueble" name="id_inmueble">
    
            <label for="motivo-select">Selecciona el motivo por el que desea Deshabilitar el inmueble:</label>
            <select id="motivo-select" name="motivo" onchange="toggleTextarea()">
            <option value="Propiedad-vendida-alquilada">Propiedad vendida/alquilada</option>
            <option value="En proceso-de-reparación">En proceso de reparación</option>
            <option value="Por-solicitud-del-propietario">Por solicitud del propietario</option>
            <option value="Otra">Otra</option>
            </select>
            <textarea id="motivo-textarea" name="motivo_otro" placeholder="Escribe el motivo..." style="display: none;"></textarea>
            <div class="popup-buttons">
                <button type="button" onclick="closePopup()">Cancelar</button>
                <button type="submit">Aceptar</button>
            </div>
        </form>
    </div>
    <?php 
    $sqlImgRoute = 'SELECT fotos_inmueble FROM inmueble WHERE id_inmueble = '. $id;
    $resImgRoute = mysqli_query($con, $sqlImgRoute);
    if ($resImgRoute && mysqli_num_rows($resImgRoute) > 0) {
      $row2 = mysqli_fetch_assoc($resImgRoute);
    } 
    else {
        $row2 = null;
    }
    ?>

    <?php if ($row2): ?>
  
    <script>

      // Arreglo con las rutas de las imágenes
      const images = <?php echo $row2['fotos_inmueble'] ?>;

    </script>
    <?php else: ?>
        <script>
          console.log("No se encontraron imágenes");
        </script>
    <?php endif; ?>

    <script>

      // Índice para llevar el control de la imagen actual
      let currentImageIndex = 0;

      // Elemento de la imagen en el HTML
      const imageElement = document.getElementById('propertyImage');
      imageElement.setAttribute('src', images[0]);

      // Función para cambiar la imagen
      function changeImage(direction) {
        // Cambiar el índice según la dirección
        currentImageIndex = (currentImageIndex + direction + images.length) % images.length;
        
        // Cambiar la fuente y el texto alternativo de la imagen
        imageElement.src = images[currentImageIndex];
        imageElement.alt = `Imagen ${currentImageIndex + 1} de la propiedad`;
      }

      if (images.length == 1){
        let arrowButtons = document.querySelectorAll('.slider-button');
        arrowButtons.forEach((item) =>{
          item.style.display = 'none';
        });
      }
      </script>

    <script>
        //Funcion del Poppup
    function showPopup(id) {
        document.getElementById('id_inmueble').value = id;
        document.getElementById('popup').style.display = 'block';
        document.getElementById('popup-overlay').style.display = 'block';
    }

    function closePopup() {
        document.getElementById('popup').style.display = 'none';
        document.getElementById('popup-overlay').style.display = 'none';
        
        // Reset form
        document.getElementById('motivo-select').selectedIndex = 0;
        document.getElementById('motivo-textarea').style.display = 'none';
        document.getElementById('motivo-textarea').value = '';
    }

    function toggleTextarea() {
        const motivoSelect = document.getElementById('motivo-select');
        const motivoTextarea = document.getElementById('motivo-textarea');
        if (motivoSelect.value === 'Otra') {
            motivoTextarea.style.display = 'block';
            motivoTextarea.setAttribute('required', 'required');
        } else {
            motivoTextarea.style.display = 'none';
            motivoTextarea.removeAttribute('required');
            motivoTextarea.value = '';
        }
    }
    </script>
</body>
</html>

<?php
// Cerrar la conexión
mysqli_close($con);
?>