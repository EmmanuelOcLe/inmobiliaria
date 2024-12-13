<?php
session_start();
include("back/conection.php");

// Verificar conexión a la base de datos
if (!$con) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Verificar que el ID está definido y es válido
if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    die("El ID de la sesión no está definido o es inválido.");
}

// Construir y ejecutar la consulta
$id_inmueble = intval($_SESSION['id']); // Sanitizar el ID
$sql = "SELECT * FROM inmueble WHERE id_inmueble = $id_inmueble";
$result = mysqli_query($con, $sql);

// Verificar si la consulta fue exitosa
if (!$result) {
    die("Error en la consulta: " . mysqli_error($con));
}

// Procesar resultados
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "id_inmueble:". htmlspecialchars($row["id_inmueble"]) . "<br>";
        echo "nombre_inmueble:". htmlspecialchars($row["nombre_inmueble"]) . "<br>";
        echo "ubicacion_inmueble". htmlspecialchars($row["ubicacion_inmueble"]);
        $cantidad_habitaciones = $row["cantidad_habitaciones"];
        $cantidad_baños = $row["cantidad_baños"];
        $zona_parqueo = $row["zona_parqueo"];
        $area = $row["area"];
        $descripcion_inmueble = $row["Descripcion_inmueble"];
        $tipo_oferta = $row["tipo_oferta"];
        $fotos_inmueble = $row["fotos_inmueble"];
        $precio_inmueble = $row["precio_inmueble"];
        $estado_inmueble = $row["estado_inmueble"];
}
    }else {
    echo "No se encontraron resultados.";
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
                        <span class="icon icon-edit"></span>
                        <span class="icon icon-delete"></span>
                    </div>
                </div>

                <div class="property-price">$ 150.000.000.00</div>

                <div class="gallery">
                    <img src="/inmobiliaria/assets/2151302622.jpg" alt="Propiedad">
                    <button class="gallery-nav gallery-prev">←</button>
                    <button class="gallery-nav gallery-next">→</button>
                </div>

                <div class="property-details">
                    <div class="detail-item">
                        <span class="detail-icon icon-location"></span>
                        <span>Aquí va la localización</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-icon icon-bed"></span>
                        <span>4 Habitaciones</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-icon icon-bath"></span>
                        <span>2 Baños</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-icon icon-area"></span>
                        <span>15 metros cuadrados</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-icon icon-parking"></span>
                        <span>2 Zonas de Parking</span>
                    </div>
                </div>
            </div>
        </main>

        <?php include('footer.php'); ?>

    </div>


</body>
</html>