<?php
include('back/session_check.php');
?>

<?php
session_start();

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
    <title>Propiedades</title>
</head>
<body>
    <div class="contenedor-todo">
        <?php include('header2.php'); ?>

        <main class="main">
            <h1 class="welcome">Bienvenido <span class="welcome-name">Emmanuel</span></h1>

            <?php if ($row): ?>
                <div class="property-card">
                    <h2 class="property-title"><?php echo htmlspecialchars($row['nombre_inmueble']); ?></h2>
                    <div class="property-price">Precio: $<?php echo htmlspecialchars($row['precio_inmueble']); ?></div>

                    <div class="gallery">
                        <img src="/inmobiliaria/assets/2151302622.jpg" alt="Propiedad">
                    </div>

                    <div class="property-details">
                        <div class="detail-item">
                            <span>Ubicación:</span>
                            <span><?php echo htmlspecialchars($row['ubicacion_inmueble']); ?></span>
                        </div>
                        <div class="detail-item">
                            <span>Habitaciones:</span>
                            <span><?php echo htmlspecialchars($row['cantidad_habitaciones']); ?></span>
                        </div>
                        <div class="detail-item">
                            <span>Baños:</span>
                            <span><?php echo htmlspecialchars($row['cantidad_baños']); ?></span>
                        </div>
                        <div class="detail-item">
                            <span>Área:</span>
                            <span><?php echo htmlspecialchars($row['area']); ?> m²</span>
                        </div>
                        <div class="detail-item">
                            <span>Zonas de Parking:</span>
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
