<?php
include_once 'back/session_check.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Propiedad</title>
    <link rel="stylesheet" href="css/crear_propiedad.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="icon" href="assets/favicon.ico">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropzone@5.7.0/dist/min/dropzone.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dropzone@5.7.0/dist/min/dropzone.min.js"></script>
</head>
<body>
    <?php include('header2.php');?>

    <div class="container">
        <a href="dashboard-admin.php" class="back-button"> 
            <i class='bx bx-arrow-back'></i>
            Volver
        </a>
        <div class="welcome">
            <h1>Bienvenido <span>administrador</span></h1>
        </div>

        <div class="form-container">
            <h2 class="form-title">Crear una nueva propiedad</h2>
            
            <form method="post" action="registro.php" enctype="multipart/form-data">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="nombre">Nombre Propiedad</label>
                        <input type="text" id="nombre" placeholder="Nombre de la propiedad" name="propiedad_nombre" required>
                    </div>

                    <div class="form-group">
                        <label for="ubicacion">Ubicación</label>
                        <input type="text" id="ubicacion" placeholder="Ubicación de la propiedad" name="ubicacion_propiedad" required>
                    </div>

                    <div class="form-group">
                        <label for="valor">Valor de la propiedad</label>
                        <input type="text" id="valor" placeholder="Valor de la propiedad" name="valor_propiedad" required>
                    </div>
                </div>

                <div class="numbers-grid">
                    <div class="form-group">
                        <label for="habitaciones">Cantidad de Habitaciones</label>
                        <input type="number" id="habitaciones" min="0" name="habitaciones_cantidad" required>
                    </div>

                    <div class="form-group">
                        <label for="banos">Cantidad de Baños</label>
                        <input type="number" id="banos" min="0" name="baños_cantidad" required>
                    </div>

                    <div class="form-group">
                        <label for="parqueo">Zonas de Parqueo</label>
                        <input type="number" id="parqueo" min="0" name="zonas_parqueo" required>
                    </div>

                    <div class="form-group">
                        <label for="area">Área en metros Cuadrados</label>
                        <input type="text" id="area" placeholder="" name="areas_metros">
                    </div>

                    <div class="form-group">
                        <label for="oferta">Tipo de Oferta</label>
                        <select name="oferta" id="oferta" required>
                            <option value="" disabled selected>Selecciona el tipo</option>
                            <option value="venta">Venta</option>
                            <option value="arriendo">Arriendo</option>
                        </select>
                    </div>
                </div>

                <!-- Subir imágenes -->
                <div class="form-group">
                    <label for="imagenes">Arrastra o haz clic para subir imágenes</label>
                    <div id="dropzone" class="dropzone needsclick dz-clickable"></div>
                </div>

                <div class="description-area">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" id="descripcion" placeholder="Descripción de la propiedad"></textarea>
                </div>

                <div class="buttons">
                    <input type="reset" class="btn btn-cancel">
                    <button type="submit" class="btn btn-create">Crear Propiedad</button>
                </div>
            </form>
        </div>
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
                success: function(file, response) {
                    if (!response.success) {
                        console.error("Error al subir:", response.message);
                    }
                },
                error: function(file, errorMessage) {
                    console.error("Error al subir:", errorMessage);
                }
            });
        });
    </script>
</body>
</html>
