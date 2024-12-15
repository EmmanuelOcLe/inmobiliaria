<?php
include('back/session_check.php');
?>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Verificar si existe el ID en la sesión
$id = intval($_GET["id"]);

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
$sql = "SELECT * FROM inmueble WHERE id_inmueble = ". $id ."";
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
    <link rel="icon" href="assets/favicon.ico">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Propiedades</title>
</head>
<body> 
    <div class="contenedor-todo">
        <?php include('header2.php'); ?>

        <main class="main">
        <a href="dashboard-admin.php"> 
            <i class='bx bx-arrow-back'></i>
               Volver
              </a>
            <h1 class="welcome">Bienvenido <span class="welcome-name">Emmanuel</span></h1>

            <?php if ($row): ?>
                <div class="property-card">
                    <div class="card-header">
                        <div class="prop-info-container">
                            <h2 class="property-title"><?= htmlspecialchars($row['nombre_inmueble'] ?? 'Nombre no disponible') ?></h2>
                            <div class="property-price">Precio: $<?php echo htmlspecialchars($row['precio_inmueble']); ?></div>
                        </div>
                        <div class="card-actions">
                            <!--Botones-->
                            <a href="modificar_propiedad.php"><span class="icon icon-edit"></span></a>
                            <span class="icon icon-delete"></span>
                        </div>
                    </div>
                    
                    <div class="gallery">
                        <img src="/inmobiliaria/assets/2151302622.jpg" alt="Propiedad">
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
</body>
</html>