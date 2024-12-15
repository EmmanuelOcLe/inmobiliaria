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

</head>
<body>
    <?php include('header2.php');?>
 
    <div class="container">
        <a href="dashboard-admin.php"> 
            <i class='bx bx-arrow-back'></i>
            Volver
        </a>
        <div class="welcome">
            <h1>Bienvenido <span>administrador</span></h1>
        </div>

        <div class="form-container">
            <h2 class="form-title">Crear una nueva propiedad</h2>
            
            <form method="post" action="registro.php" method="post" enctype="multipart/form-data">
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
                        <input type="text" id="area" placeholder="Área en m2" name="areas_metros" required>
                    </div>

                    <div class="form-group">
                        <label for="oferta">Tipo de Oferta</label>
                        <select name="oferta" id="oferta" required>
                            <option value="" disabled selected>Selecciona el tipo</option>
                            <option value="venta">Venta</option>
                            <option value="arriendo">Arriendo</option>
                            <option value="venta_arriendo">Venta y Arriendo</option>
                        </select>

                    </div>
                </div>
                <div class="form-group">
                    <label for="fotos">Imágenes de la propiedad</label>
                    <input type="file" name="fotos[]" id="fotos" multiple required accept="image/jpeg, image/png, image/gif, image/jfif, image/pjpeg, image/pjp, image/png">
                </div>

                <div class="description-area">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion" required></textarea>
                </div>

                <div class="buttons">
                    <button type="button" class="btn btn-cancel">Cancelar</button>
                    <button type="submit" class="btn btn-create" name="crear">Crear Propiedad</button>
                </div>
            </form>
        </div>
    </div>
    <?php include('footer.php');?>
    <script>
    // fileIn es el elemento HTML del input. Acá cambia 'fileIn' por el id de su input de imagen
    document.getElementById('fotos').addEventListener('change', (event) =>{
      const imgPermitidas = ['image/jpg', 'image/jpeg', 'image/jfif', 'image/pjpeg', 'image/pjp', 'image/png'];
      const permitidasUsuario = ['jpg', 'jpeg', 'jfif', 'pjpeg', 'pjp', 'png'];
      let file = event.target.files;

      for (let i = 0; i < file.length; i++){
        if (file && !(imgPermitidas.includes(file[i].type))){
          alert('No se permite el tipo de imagen seleccionado.');
          alert('Lista de tipos de imagenes permitidas \n '+permitidasUsuario);
          event.target.value = '';
          break;
        }
      }
  });
    </script>
</body>
</html>