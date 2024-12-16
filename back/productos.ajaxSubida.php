<?php
include('session_check.php');
include("conection.php");

// Respuesta por defecto
$response = [
    'success' => false,
    'message' => 'Error desconocido'
];

if (isset($_FILES['file']) && isset($_POST['id'])) {
    $id_inmueble = intval($_POST['id']);

    // Establecer el directorio donde se guardarán las imágenes
    $directorio = 'images/' . $id_inmueble;
    
    // Si el directorio no existe, lo creamos
    if (!file_exists($directorio)) {
        mkdir($directorio, 0755, true);
    }

    // Recibir la imagen
    $file = $_FILES['file'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileType = $file['type'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    // Verificamos si hubo algún error en la subida del archivo
    if ($fileError === 0) {
        // Verificamos si el tipo de archivo es válido (JPG, PNG)
        $allowed = array('jpg', 'jpeg', 'png');
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (in_array($fileExt, $allowed)) {
            // Validar tamaño del archivo (2MB máximo)
            if ($fileSize <= 2 * 1024 * 1024) {
                // Crear un nombre único para la imagen
                $newFileName = uniqid('', true) . '.' . $fileExt;
                $fileDestination = $directorio . '/' . $newFileName;

                // Subir la imagen al servidor
                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    // Obtener las imágenes actuales de la base de datos
                    $sql = "SELECT fotos_inmueble FROM inmueble WHERE id_inmueble = ?";
                    $stmt = mysqli_prepare($con, $sql);
                    mysqli_stmt_bind_param($stmt, "i", $id_inmueble);
                    mysqli_stmt_execute($stmt);
                    $res = mysqli_stmt_get_result($stmt);
                    $row = mysqli_fetch_assoc($res);
                    $existingFotos = $row['fotos_inmueble'];

                    // Si ya existen fotos, añadimos la nueva
                    if (!empty($existingFotos)) {
                        $newFotos = $existingFotos . ',' . $newFileName;
                    } else {
                        $newFotos = $newFileName;
                    }

                    // Actualizar la base de datos con la nueva imagen
                    $updateSql = "UPDATE inmueble SET fotos_inmueble = ? WHERE id_inmueble = ?";
                    $stmt = mysqli_prepare($con, $updateSql);
                    mysqli_stmt_bind_param($stmt, "si", $newFotos, $id_inmueble);
                    
                    if (mysqli_stmt_execute($stmt)) {
                        $response = [
                            'success' => true,
                            'message' => 'Imagen subida correctamente',
                            'filename' => $newFileName
                        ];
                    } else {
                        $response = [
                            'success' => false,
                            'message' => 'Error al actualizar la base de datos'
                        ];
                    }
                } else {
                    $response = [
                        'success' => false,
                        'message' => 'Error al subir la imagen'
                    ];
                }
            } else {
                $response = [
                    'success' => false,
                    'message' => 'El archivo es demasiado grande. Máximo 2MB.'
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'Tipo de archivo no permitido. Solo se permiten imágenes JPG, JPEG y PNG.'
            ];
        }
    } else {
        $response = [
            'success' => false,
            'message' => 'Error en la subida del archivo'
        ];
    }
} else {
    $response = [
        'success' => false,
        'message' => 'Datos de subida incompletos'
    ];
}

// Devolver respuesta JSON
header('Content-Type: application/json');
echo json_encode($response);
exit();
?>