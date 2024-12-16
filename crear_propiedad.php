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
            
            <form method="post" action="registro.php" enctype="multipart/form-data" id="propertyForm">
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
                        <input type="number" id="valor" placeholder="Valor de la propiedad" name="valor_propiedad" required min="0" step="0.01">
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
                        <input type="number" id="area" placeholder="" name="areas_metros" step="0.01" min="0" required>
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
                    <input type="file" name="fotos[]" id="imageUpload" multiple accept=".jpg,.jpeg,.png" style="display:none;">
                    <div id="dropzone" class="dropzone needsclick dz-clickable"></div>
                </div>

                <div class="description-area">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" id="descripcion" placeholder="Descripción de la propiedad" required></textarea>
                </div>

                <div class="buttons">
                    <input type="reset" class="btn btn-cancel" value="Cancelar">
                    <button type="submit" class="btn btn-create">Crear Propiedad</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        Dropzone.autoDiscover = false;

        $(document).ready(function() {
            let myDropzone = new Dropzone("#dropzone", {
                url: "back/productos.ajaxSubida.php",
                paramName: "file",
                maxFilesize: 2,
                maxFiles: 5,
                acceptedFiles: ".jpg,.jpeg,.png",
                addRemoveLinks: true,
                dictDefaultMessage: "Arrastra o haz clic para subir imágenes",
                
                // Configuración para manejar archivos
                init: function() {
                    // Asegurar que el formulario incluya los archivos de Dropzone
                    let form = document.getElementById('propertyForm');
                    
                    this.on("addedfile", function(file) {
                        file.previewElement.addEventListener("click", function() {
                            myDropzone.hiddenFileInput.click();
                        });
                    });

                    this.on("success", function(file, response) {
                        // Añade un input oculto con la ruta del archivo
                        if (response.success) {
                            let hiddenInput = document.createElement('input');
                            hiddenInput.setAttribute('type', 'hidden');
                            hiddenInput.setAttribute('name', 'uploadedFiles[]');
                            hiddenInput.setAttribute('value', response.filename);
                            form.appendChild(hiddenInput);
                        }
                    });

                    this.on("removedfile", function(file) {
                        // Opcional: Eliminar el input oculto correspondiente
                        let inputs = form.querySelectorAll('input[name="uploadedFiles[]"]');
                        inputs.forEach(input => {
                            if (input.value === file.name) {
                                input.remove();
                            }
                        });
                    });
                }
            });

            // Validación básica del formulario antes de enviar
            $('#propertyForm').on('submit', function(e) {
                // Verificar que todos los campos requeridos estén llenos
                let valid = true;
                $(this).find('[required]').each(function() {
                    if (!$(this).val()) {
                        valid = false;
                        $(this).addClass('error');
                    } else {
                        $(this).removeClass('error');
                    }
                });

                // Verificar que se hayan subido imágenes
                if (myDropzone.files.length === 0) {
                    alert('Por favor, sube al menos una imagen de la propiedad');
                    valid = false;
                }

                if (!valid) {
                    e.preventDefault();
                    alert('Por favor, completa todos los campos requeridos');
                }
            });
        });
    </script>
</body>
</html>