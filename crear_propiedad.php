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
</head>
<body>
    <?php include('header2.php');?>

    <div class="container">
        <div class="welcome">
            <h1>Bienvenido <span>administrador</span></h1>
        </div>

        <div class="form-container">
            <h2 class="form-title">Crear una nueva propiedad</h2>
            
            <form>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="nombre">Nombre Propiedad</label>
                        <input type="text" id="nombre" placeholder="Nombre de la propiedad">
                    </div>

                    <div class="form-group">
                        <label for="ubicacion">Ubicación</label>
                        <input type="text" id="ubicacion" placeholder="Ubicación de la propiedad">
                    </div>

                    <div class="form-group">
                        <label for="valor">Valor de la propiedad</label>
                        <input type="text" id="valor" placeholder="Valor de la propiedad">
                    </div>
                </div>

                <div class="numbers-grid">
                    <div class="form-group">
                        <label for="habitaciones">Cantidad de Habitaciones</label>
                        <input type="number" id="habitaciones" min="0">
                    </div>

                    <div class="form-group">
                        <label for="banos">Cantidad de Baños</label>
                        <input type="number" id="banos" min="0">
                    </div>

                    <div class="form-group">
                        <label for="parqueo">Zonas de Parqueo</label>
                        <input type="number" id="parqueo" min="0">
                    </div>

                    <div class="form-group">
                        <label for="area">Área en metros Cuadrados</label>
                        <input type="text" id="area" placeholder="Área en m2">
                    </div>
                </div>

                <div class="form-group">
                    <label for="imagenes">Imágenes de la propiedad</label>
                    <input type="file" id="imagenes" accept="image/*" multiple>
                </div>

                <div class="description-area">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion"></textarea>
                </div>

                <div class="buttons">
                    <button type="button" class="btn btn-cancel">Cancelar</button>
                    <button type="submit" class="btn btn-create">Crear Propiedad</button>
                </div>
            </form>
        </div>
    </div>
    <?php include('footer.php');?>

</body>
</html>