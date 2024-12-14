<?php
include('back/session_check.php');
?>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Verificar si existe el ID en la sesión
if (isset($_SESSION['id'])) {
    // Recuperar el ID desde la sesión
    $id = $_SESSION['id'];

    // Incluir la conexión a la base de datos
    include("back/conection.php");

    // Consultar la base de datos para obtener información del ID
    $sql = "SELECT * FROM inmueble WHERE id_inmueble = $id";
    $result = mysqli_query($con, $sql);

    // Verificar si se encontró el registro
    if ($result && mysqli_num_rows($result) > 0) {
        // Obtener los datos
        $row = mysqli_fetch_assoc($result);

        // Mostrar la información de la propiedad
        //echo "<p>fotos: $" . htmlspecialchars($row['fotos_inmueble']) . "</p>";
        
    } else {
        echo "<p>No se encontró ninguna propiedad con el ID proporcionado.</p>";
    }
} else {
    echo "<p>No se encontró el ID en la sesión. Por favor, regrese a la página anterior.</p>";
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

            <div class="property-card">
                <div class="card-header">
                    <h2 class="property-title">Parque Residente Dahmia III</h2>
                    <div class="card-actions">
                        <!--Botones-->
                        <a href="/Inmobiliaria/inmobiliaria/modificar_propiedad.php"><span class="icon icon-edit"></span></a>
                        <span class="icon icon-delete"></span>
                    </div>
                <div class="property-details">
                    <div class="detail-item">
                        <span class="detail-icon icon-location"></span>
                        <span><?php echo "" . htmlspecialchars($row['ubicacion_inmueble']) . ""?> </span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-icon icon-bed"></span>
                        <span><?php echo "" . htmlspecialchars($row['cantidad_habitaciones']) . "";?> Habitaciones</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-icon icon-bath"></span>
                        <span><?php echo "" . htmlspecialchars($row['cantidad_baños']) . ""?> Baños</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-icon icon-area"></span>
                        <span><?php echo "" . htmlspecialchars($row['area']) . " "?> metros cuadrados</span>
                    </div>
                    <div class="detail-item">
                            <span class="detail-icon icon-parking"></span>
                            <span><?php  echo "" . htmlspecialchars($row['zona_parqueo']) . "  "?> Zonas de Parking</span>
                        </div>
                </div>
            </div>
        </main>

        <?php include('footer.php'); ?>
    </div>
</body>
</html>
