<?php
session_start();
include("back/conection.php");

$nombre = $_POST["propiedad_nombre"];
$ubicacion = $_POST["ubicacion_propiedad"];
$valor = $_POST["valor_propiedad"];
$habitaciones = $_POST["habitaciones_cantidad"];
$baños = $_POST["baños_cantidad"];
$zona_parqueo = $_POST["zonas_parqueo"];
$area_m = $_POST["areas_metros"];
$descripcion = $_POST["descripcion"];
$oferta = $_POST["oferta"];
$habilitado = "habilitada";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Propiedad</title>
    <link rel="stylesheet" href="css/modal-create.css">
    <link rel="stylesheet" href="css/global.css">
</head>
<body>
    <div class="modal" id="successModal">
        <div class="modal-content">
            <h2>¡Datos enviados correctamente!</h2>
            <p>La propiedad se ha registrado con éxito. ¿Qué deseas hacer ahora?</p>
            <div class="modal-buttons">
                <button class="btn btn-primary" id="seguirCreando">Seguir creando</button>
                <button class="btn btn-secondary" id="volverDashboard">Volver al dashboard</button>
            </div>
        </div>
    </div>

    <?php
    if (!$con) {
        echo "No se ha podido conectar a la base de datos: " . mysqli_connect_error();
    } else {
        $sql = "INSERT INTO inmueble (nombre_inmueble, ubicacion_inmueble, cantidad_baños, cantidad_habitaciones, zona_parqueo, area, descripcion_inmueble, tipo_oferta, precio_inmueble, estado)
        VALUES ('$nombre', '$ubicacion', $baños, $habitaciones, $zona_parqueo, $area_m, '$descripcion', '$oferta', '$valor', '$habilitado')";

        $resultado = mysqli_query($con, $sql);

        if ($resultado) {
            echo '<script>document.getElementById("successModal").style.display = "block";</script>';
        } else {
            echo "Error al insertar los datos: " . mysqli_error($con);
        }

        mysqli_close($con);
    }
    ?>

    <script>
        const modal = document.getElementById("successModal");
        const btnSeguirCreando = document.getElementById("seguirCreando");
        const btnVolverDashboard = document.getElementById("volverDashboard");

        btnSeguirCreando.onclick = function() {
            window.location.href = "http://localhost/inmobiliaria/crear_propiedad.php"; 
        };

        btnVolverDashboard.onclick = function() {
            window.location.href = "http://localhost/inmobiliaria/dashboard-admin.php"; 
        };
    </script>
</body>
</html>
