<?php
include 'conection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_inmueble = $_POST['id_inmueble'];
    $motivo = $_POST['motivo'];
    $motivo_otro = isset($_POST['motivo_otro']) ? $_POST['motivo_otro'] : '';

    // Si el motivo es 'Otra', usa el texto del textarea
    if ($motivo === 'Otra' && !empty($motivo_otro)) {
        $motivo = $motivo_otro;
    }

    // Actualizar el estado y el motivo en la base de datos
    $sql = "UPDATE inmueble SET estado = 'habilitada', motivo = ? WHERE id_inmueble = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('si', $motivo, $id_inmueble);

    if ($stmt->execute()) {
        echo "Propiedad habilitada correctamente.";
    } else {
        echo "Error al habilitar la propiedad: " . $conn->error;
    }
    $stmt->close();
    $con->close();

    // Redirigir a la página de inhabilitadas
    header("Location: ../inhabilitadas.php");
    exit;
}
?>
