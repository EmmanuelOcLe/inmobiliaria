<?php
include('back/session_check.php');
include("back/conection.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id_inmueble = intval($_GET['id']);

    // Consulta a la base de datos para obtener la propiedad
    $sql = "SELECT * FROM inmueble WHERE id_inmueble = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_inmueble);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
    } else {
        echo "<p>No se encontró la propiedad con el ID proporcionado.</p>";
        exit;
    }
} else {
    echo "<p>No se recibió un ID válido.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inmobiliaria Emmanuel</title>
    <link rel="stylesheet" href="css/modificar_propiedad.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/global.css"> 
    <link rel="icon" href="assets/favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropzone@5.7.0/dist/min/dropzone.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dropzone@5.7.0/dist/min/dropzone.min.js"></script>
    <style>
        .image-item {
            position: relative;
            display: inline-block;
            margin: 10px;
        }
        .image-item img {
            max-width: 150px;
            max-height: 150px;
            border-radius: 5px;
        }
        .delete-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: rgba(255, 0, 0, 0.8);
            color: white;
            border: none;
            padding: 5px;
            cursor: pointer;
            border-radius: 50%;
            font-size: 16px;
            display: none;
        }
        .image-item:hover .delete-btn {
            display: block;
        }
    </style>
</head>
<body>

<div class="contenedor-todo">
    <?php include('header2.php'); ?>

    <main>
        <div class="container">
            <div class="welcome">
                <a href="dashboard-admin.php" class="back-button"> 
                    <i class='bx bx-arrow-back'></i>
                    Volver
                </a>
                <h1>Bienvenido <span>Emmanuel</span></h1>
            </div>

            <div class="form-container"> 
                <h2 class="form-title">Modificar una propiedad</h2>

                <form action="registro.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $row['id_inmueble']; ?>">

                    <!-- Campos de texto -->
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="nombre">Nombre Propiedad</label>
                            <input name="nombre" type="text" id="nombre" value="<?php echo htmlspecialchars($row['nombre_inmueble']); ?>">
                        </div>

                        <div class="form-group">
                            <label for="ubicacion">Ubicación</label>
                            <input name="ubicacion" type="text" id="ubicacion" value="<?php echo htmlspecialchars($row['ubicacion_inmueble']); ?>">
                        </div>

                        <div class="form-group">
                            <label for="valor">Valor de la propiedad</label>
                            <input name="valor" type="text" id="valor" value="<?php echo htmlspecialchars($row['precio_inmueble']); ?>">
                        </div>
                    </div>

                    <div class="numbers-grid">
                        <div class="form-group">
                            <label for="habitaciones">Cantidad de Habitaciones</label>
                            <input name="habitaciones" type="number" id="habitaciones" value="<?php echo intval($row['cantidad_habitaciones']); ?>">
                        </div>

                        <div class="form-group">
                            <label for="banos">Cantidad de Baños</label>
                            <input name="banos" type="number" id="banos" value="<?php echo intval($row['cantidad_baños']); ?>">
                        </div>

                        <div class="form-group">
                            <label for="parqueo">Zonas de Parqueo</label>
                            <input name="parqueo" type="number" id="parqueo" value="<?php echo intval($row['zona_parqueo']); ?>">
                        </div>

                        <div class="form-group">
                            <label for="area">Área en metros Cuadrados</label>
                            <input name="area" type="text" id="area" value="<?php echo htmlspecialchars($row['area']); ?>">
                        </div>

                        <div class="form-group">
                            <label for="tipo_oferta">Tipo Oferta</label>
                            <select name="oferta" id="tipo_oferta">
                                <option value="venta" <?php echo ($row['tipo_oferta'] == 'venta') ? 'selected' : ''; ?>>Venta</option>
                                <option value="arriendo" <?php echo ($row['tipo_oferta'] == 'arriendo') ? 'selected' : ''; ?>>Arriendo</option>
                            </select>
                        </div>
                    </div>

                    <!-- Mostrar imágenes existentes -->
                    <?php
                    $fotos = explode(',', $row['fotos_inmueble']);
                    if (!empty($fotos[0])) {
                        echo "<h3>Imágenes actuales</h3>";
                        echo "<div class='image-gallery' id='image-gallery'>";
                        foreach ($fotos as $foto) {
                            if (!empty($foto)) {
                                echo "<div class='image-item' data-filename='$foto'>
                                        <img src='back/images/{$row['id_inmueble']}/$foto' alt='Imagen'>
                                        <button type='button' class='delete-btn' data-filename='$foto'>🗑️</button>
                                    </div>";
                            }
                        }
                        echo "</div>";
                    } else {
                        echo "<p>No hay imágenes disponibles.</p>";
                    }
                    ?>

                    <!-- Subir nuevas imágenes -->
                    <div class="form-group">
                        <label for="imagenes">Arrastra o haz clic para subir imágenes</label>
                        <div id="dropzone" class="dropzone needsclick dz-clickable"></div>
                    </div>

                    <div class="description-area">
                        <label for="descripcion">Descripción</label>
                        <textarea name="descripcion" id="descripcion"><?php echo isset($row['descripcion_inmueble']) ? htmlspecialchars($row['descripcion_inmueble']) : ''; ?></textarea>
                    </div>

                    <div class="buttons">
                        <input type="reset" class="btn btn-cancel">
                        <button type="submit" class="btn btn-update">Actualizar Propiedad</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php include('footer.php'); ?>
</div>

<script>
Dropzone.autoDiscover = false;

$(document).ready(function() {
    new Dropzone("#dropzone", {
        url: "back/productos.ajaxSubida.php",
        paramName: "file",
        maxFilesize: 2,
        maxFiles: 5,
        acceptedFiles: ".jpg,.jpeg,.png",
        addRemoveLinks: true,
        dictDefaultMessage: "Arrastra o haz clic para subir imágenes",
        params: {
            id: <?php echo $row['id_inmueble']; ?>
        },
        success: function(file, response) {
            if (response.success) {
                $('#image-gallery').append(
                    `<div class='image-item' data-filename="${response.filename}">
                        <img src="back/images/<?php echo $row['id_inmueble']; ?>/${response.filename}" alt="Imagen">
                        <button class="delete-btn" data-filename="${response.filename}">🗑️</button>
                    </div>`
                );
            } else {
                console.error("Error:", response.message);
            }
        },
        error: function(file, errorMessage) {
            console.error("Error al subir:", errorMessage);
        }
    });

    // Manejo de eliminación de imágenes
    $(document).on('click', '.delete-btn', function() {
        var filename = $(this).data('filename');
        var $imageItem = $(this).closest('.image-item');

        $.ajax({
            url: 'back/eliminar_imagen.php',
            method: 'POST',
            data: {
                filename: filename,
                id_inmueble: <?php echo $row['id_inmueble']; ?>
            },
            success: function(response) {
                if (response.trim() === 'success') {
                    $imageItem.remove();
                } else {
                    alert("No se pudo eliminar la imagen. Inténtalo nuevamente.");
                }
            },
            error: function(xhr, status, error) {
                alert("Error al procesar la solicitud.");
            }
        });
    });
});
</script>

</body>
</html>

