<?php
include('conection.php'); // Ajusta la ruta si es necesario

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['filename']) && isset($_POST['id_inmueble'])) {
    $filename = $_POST['filename'];
    $id_inmueble = intval($_POST['id_inmueble']);

    // Ruta de la imagen en el servidor
    $image_path = "images/$id_inmueble/$filename";

    // Verificar si el archivo existe
    if (file_exists($image_path)) {
        // Intentar eliminar el archivo
        if (unlink($image_path)) {
            // Actualizar la base de datos
            $sql = "SELECT fotos_inmueble FROM inmueble WHERE id_inmueble = ?";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, 'i', $id_inmueble);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);

            if ($row) {
                // Eliminar la referencia del archivo en la base de datos
                $fotos = explode(',', $row['fotos_inmueble']);
                $fotos = array_filter($fotos, function($foto) use ($filename) {
                    return $foto !== $filename;
                });
                $nuevas_fotos = implode(',', $fotos);

                $update_sql = "UPDATE inmueble SET fotos_inmueble = ? WHERE id_inmueble = ?";
                $update_stmt = mysqli_prepare($con, $update_sql);
                mysqli_stmt_bind_param($update_stmt, 'si', $nuevas_fotos, $id_inmueble);

                if (mysqli_stmt_execute($update_stmt)) {
                    echo 'success';
                    exit;
                } else {
                    echo 'error: Failed to update database';
                    exit;
                }
            } else {
                echo 'error: Property not found';
                exit;
            }
        } else {
            echo 'error: Failed to delete file';
            exit;
        }
    } else {
        echo 'error: File not found';
        exit;
    }
} else {
    echo 'error: Invalid request';
    exit;
}
?>
