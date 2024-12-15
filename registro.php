<?php
session_start();
include("back/conection.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Obtener y sanitizar los valores enviados desde el formulario
    $nombre = mysqli_real_escape_string($con, $_POST["propiedad_nombre"]);
    $ubicacion = mysqli_real_escape_string($con, $_POST["ubicacion_propiedad"]);
    $valor = $_POST["valor_propiedad"];
    $habitaciones = (int)$_POST["habitaciones_cantidad"];
    $baños = (int)$_POST["baños_cantidad"];
    $zona_parqueo = (int)$_POST["zonas_parqueo"];
    $area_m = (int)$_POST["areas_metros"];
    $descripcion = mysqli_real_escape_string($con, $_POST["descripcion"]);
    $oferta = mysqli_real_escape_string($con, $_POST["oferta"]);
    $habilitado = "habilitada"; // Valor fijo para 'habilitado'

    // Asegurarse de que el valor de 'fotos_inmueble' esté vacío o con un valor por defecto
    $fotos_inmueble = '';  // Inicializa este campo con un valor vacío

    // Consulta SQL para insertar la propiedad
    $sql = "INSERT INTO inmueble (nombre_inmueble, ubicacion_inmueble, cantidad_habitaciones, cantidad_baños, zona_parqueo, area, descripcion_inmueble, tipo_oferta, fotos_inmueble, precio_inmueble, estado)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);

    if (!$stmt) {
        echo "Error: No se pudo preparar la sentencia SQL";
        exit();
    }

    // Vincular los parámetros
    $stmt->bind_param("ssiiiisssis", $nombre, $ubicacion, $habitaciones, $baños, $zona_parqueo, $area_m, $descripcion, $oferta, $fotos_inmueble, $valor, $habilitado);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Obtener el ID del inmueble recién insertado
        $id_propiedad = $con->insert_id;
        $carpeta_destino = 'images/properties/' . $id_propiedad . '/';

        // Crear la carpeta si no existe
        if (!is_dir($carpeta_destino)) {
            mkdir($carpeta_destino, 0777, true);
        }

        $rutasImagenes = [];

        // Verificar si hay imágenes y procesarlas
        if (isset($_FILES['fotos']) && !empty($_FILES['fotos']['tmp_name'])) {
            foreach ($_FILES['fotos']['tmp_name'] as $key => $tmpName) {
                $nombreArchivo = basename($_FILES['fotos']['name'][$key]);
                $rutaCompleta = $carpeta_destino . time() . '-' . $nombreArchivo;
        
                // Validar si el archivo es una imagen
                $tipo_imagen = mime_content_type($tmpName);
                if (strpos($tipo_imagen, "image") === false) {
                    echo "El archivo $nombreArchivo no es una imagen válida.";
                    continue;
                }
        
                // Mover el archivo a la carpeta de destino
                if (move_uploaded_file($tmpName, $rutaCompleta)) {
                    $rutasImagenes[] = $rutaCompleta;
                } else {
                    echo "Error al mover el archivo: $nombreArchivo";
                }
            }
        
            // Si se han subido imágenes, actualizar en la base de datos
            if (!empty($rutasImagenes)) {
                $fotos_inmueble = json_encode($rutasImagenes);
                $updateSql = "UPDATE inmueble SET fotos_inmueble = ? WHERE id_inmueble = ?";
                $updateStmt = $con->prepare($updateSql);
        
                if (!$updateStmt) {
                    die("Error al preparar la consulta de actualización: " . $con->error);
                }
                $updateStmt->bind_param("si", $fotos_inmueble, $id_propiedad);
        
                if ($updateStmt->execute()) {
                    echo "Propiedad creada con éxito y las imágenes fueron almacenadas.";
                } else {
                    echo "Error al actualizar las fotos: " . $updateStmt->error;
                }
        
                $updateStmt->close();
            } else {
                echo "No se han subido imágenes.";
            }
        } else {
            echo "No se han subido imágenes.";
        }
    } else {
        echo "Error al insertar la propiedad: " . $stmt->error;
    }

    // Cerrar las sentencias y la conexión
    $stmt->close();
    $con->close();
}
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