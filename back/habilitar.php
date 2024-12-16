<?php
include 'conection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_inmueble = $_POST['id_inmueble'];
    $motivo = $_POST['motivo'];
    $motivo_otro = isset($_POST['motivo_otro']) ? $_POST['motivo_otro'] : '';

    if ($motivo === 'Otra' && !empty($motivo_otro)) {
        $motivo = $motivo_otro;
    }

    $sql = "UPDATE inmueble 
            SET estado = 'habilitada', 
                motivo = ?, 
                fecha_actualizacion = NOW() 
            WHERE id_inmueble = ?";
    
    $stmt = $con->prepare($sql);
    $stmt->bind_param('si', $motivo, $id_inmueble);

    if ($stmt->execute()) {
        echo "Propiedad habilitada correctamente.";
    } else {
        echo "Error al habilitar la propiedad: " . $con->error;
    }
    $stmt->close();
    $con->close();

    header("Location: ../inhabilitadas.php");
    exit;
}
?>
