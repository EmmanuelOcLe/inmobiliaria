<?php
// Start session for managing messages
session_start();

// Establish database connection
require_once 'back/conection.php'; // Corrected filename

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $ubicacion = filter_input(INPUT_POST, 'ubicacion', FILTER_SANITIZE_STRING);
    $habitaciones = filter_input(INPUT_POST, 'habitaciones', FILTER_VALIDATE_INT);
    $baños = filter_input(INPUT_POST, 'baños', FILTER_VALIDATE_INT);
    $zona_parqueo = filter_input(INPUT_POST, 'zona_parqueo', FILTER_VALIDATE_INT);
    $area_m = filter_input(INPUT_POST, 'area_m', FILTER_VALIDATE_FLOAT);
    $descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING);
    $oferta = filter_input(INPUT_POST, 'oferta', FILTER_SANITIZE_STRING);
    $valor = filter_input(INPUT_POST, 'valor', FILTER_VALIDATE_FLOAT);
    $habilitado = 1; // Default to enabled

    // Validate required fields
    $errores = [];
    if (empty($nombre)) $errores[] = "El nombre es obligatorio";
    if (empty($ubicacion)) $errores[] = "La ubicación es obligatoria";
    if ($habitaciones === false) $errores[] = "Número de habitaciones inválido";
    if ($baños === false) $errores[] = "Número de baños inválido";
    if ($area_m === false) $errores[] = "Área inválida";
    if ($valor === false) $errores[] = "Valor inválido";

    // Check if there are any validation errors
    if (!empty($errores)) {
        // Store errors in session
        $_SESSION['errores'] = $errores;
        header("Location: registro.php");
        exit();
    }

    // Prepare SQL statement for inserting property
    $sql = "INSERT INTO inmueble (nombre, ubicacion, habitaciones, baños, zona_parqueo, area_m, descripcion, oferta, fotos_inmueble, valor, habilitado) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    // Prepare statement
    $stmt = $con->prepare($sql);
    
    if (!$stmt) {
        $_SESSION['error'] = "Error al preparar la consulta: " . $con->error;
        header("Location: registro.php");
        exit();
    }

    // Initialize photos string
    $fotos_inmueble = "";

    // Bind parameters
    $stmt->bind_param("ssiiiisssis", $nombre, $ubicacion, $habitaciones, $baños, $zona_parqueo, $area_m, $descripcion, $oferta, $fotos_inmueble, $valor, $habilitado);

    // Execute the statement
    if ($stmt->execute()) {
        // Get the ID of the newly inserted property
        $idPropiedad = $con->insert_id;

        // Create directory for property images
        $carpetaDestino = 'images/properties/' . $idPropiedad . '/';
        
        // Create directory if it doesn't exist
        if (!is_dir($carpetaDestino)) {
            mkdir($carpetaDestino, 0777, true);
        }

        // Handle file uploads
        $rutasImagenes = [];
        
        // Check if files were uploaded
        if (!empty($_FILES['fotos']['tmp_name'][0])) {
            foreach ($_FILES['fotos']['tmp_name'] as $key => $tmpName) {
                // Validate file
                if ($_FILES['fotos']['error'][$key] == UPLOAD_ERR_OK) {
                    $nombreArchivo = basename($_FILES['fotos']['name'][$key]);
                    
                    // Generate unique filename
                    $rutaCompleta = $carpetaDestino . time() . '-' . $nombreArchivo;
                    
                    // Move uploaded file
                    if (move_uploaded_file($tmpName, $rutaCompleta)) {
                        $rutasImagenes[] = $rutaCompleta;
                    } else {
                        error_log("Error al mover el archivo: $nombreArchivo");
                    }
                }
            }
        }

        // Convert image paths to JSON
        $fotosInmueble = json_encode($rutasImagenes);

        // Update property with image paths
        $updateSql = "UPDATE inmueble SET fotos_inmueble = ? WHERE id_inmueble = ?";
        $updateStmt = $con->prepare($updateSql);

        if (!$updateStmt) {
            $_SESSION['error'] = "Error al preparar la consulta de actualización: " . $con->error;
            header("Location: registro.php");
            exit();
        }

        // Bind and execute update
        $updateStmt->bind_param("si", $fotosInmueble, $idPropiedad);
        
        if ($updateStmt->execute()) {
            // Set success message
            $_SESSION['mensaje'] = "¡Propiedad registrada correctamente!";
            header("Location: dashboard-admin.php");
            exit();
        } else {
            // Handle update error
            $_SESSION['error'] = "Error al actualizar las fotos: " . $updateStmt->error;
            header("Location: registro.php");
            exit();
        }
    } else {
        // Handle insertion error
        $_SESSION['error'] = "Error al registrar la propiedad: " . $stmt->error;
        header("Location: registro.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Propiedad</title>
    <link rel="stylesheet" href="css/modal-create.css">
    <link rel="stylesheet" href="css/global.css">
</head>
<body>
    <div class="modal" id="successModal" style="display: <?php echo isset($_SESSION['mensaje']) ? 'block' : 'none'; ?>;">
        <div class="modal-content">
            <h2>¡Datos enviados correctamente!</h2>
            <p>La propiedad se ha registrado con éxito.</p>
            <div class="modal-buttons">
                <a href="dashboard-admin.php"><button class="btn btn-secondary" id="volverDashboard">Volver al dashboard</button></a>
            </div>
        </div>
    </div>

    <script>
        // Prevent form resubmission on page refresh
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        // Clear session message after showing
        <?php 
        if(isset($_SESSION['mensaje'])): 
        ?>
        // Remove the success message from session
        <?php 
            unset($_SESSION['mensaje']); 
        endif; 
        ?>
    </script>
</body>
</html>

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
            <p>La propiedad se ha registrado con éxito.</p>
            <div class="modal-buttons">
                <a href="dashboard-admin.php"><button class="btn btn-secondary" id="volverDashboard">Volver al dashboard</button></a>
            </div>
        </div>
    </div>

    <script>
        // Funcionalidad de botones
        const btnVolverDashboard = document.getElementById("volverDashboard");

        btnVolverDashboard.onclick = function() {
            window.location.href = "/localhost/inmobiliaria/crear_propiedad.php"; 
        };
    </script>
</body>
</html>
