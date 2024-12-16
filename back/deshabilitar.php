<?php
include('conection.php');
include_once('session_check.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el ID del inmueble
    $id_inmueble = isset($_POST['id_inmueble']) ? intval($_POST['id_inmueble']) : 0;
    
    // Obtener el motivo
    $motivo = isset($_POST['motivo']) ? $_POST['motivo'] : '';
    
    // Si el motivo es "Otra", usar el textarea
    if ($motivo == 'Otra') {
        $motivo = isset($_POST['motivo_otro']) ? $_POST['motivo_otro'] : '';
    }

    // Actualizar el estado del inmueble
    $sql = "UPDATE inmueble 
            SET estado = 'deshabilitada', 
                motivo = ?, 
                fecha_actualizacion = NOW() 
            WHERE id_inmueble = ?";
    
    $stmt = $con->prepare($sql);
    $stmt->bind_param("si", $motivo, $id_inmueble);
    
    if ($stmt->execute()) {
        // Redirigir a la página de inhabilitadas
        header("Location: ../dashboard-admin.php?status=success");
        exit();
    } else {
        // Manejar error
        echo "Error al deshabilitar la propiedad: " . $stmt->error;
        exit();
    }
} else {
    // Acceso no autorizado
    header("Location: ../dashboard-admin.php");
    exit();
}
?>