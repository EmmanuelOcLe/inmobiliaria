<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inmobiliaria Emmanuel</title>
    <link rel="stylesheet" href="css/modificar_propiedad.css">
    <link rel="stylesheet" href="css/global.css">
</head>
<body>

    <div class="contenedor-todo">
        <?php include('header2.php'); ?>

        <main>
        
            <div class="container">
                <div class="welcome">
                    <h1>Bienvenido <span>Emmanuel</span></h1>
                </div>
        
                <div class="form-container">
                    <h2 class="form-title">Modificar una propiedad</h2>
                    
                    <form>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="nombre">Nombre Propiedad</label>
                                <input type="text" id="nombre" placeholder="modificar nombre de la propiedad">
                            </div>
        
                            <div class="form-group">
                                <label for="ubicacion">Ubicación</label>
                                <input type="text" id="ubicacion" placeholder="modificar Ubicación de la propiedad">
                            </div>
        
                            <div class="form-group">
                                <label for="valor">Valor de la propiedad</label>
                                <input type="text" id="valor" placeholder="modificar valor de la propiedad">
                            </div>
                        </div>
        
                        <div class="numbers-grid">
                            <div class="form-group">
                                <label for="habitaciones">Cantidad de Habitaciones</label>
                                <input type="number" id="habitaciones" value="2">
                            </div>
        
                            <div class="form-group">
                                <label for="banos">Cantidad de Baños</label>
                                <input type="number" id="banos" value="2">
                            </div>
        
                            <div class="form-group">
                                <label for="parqueo">Zonas de Parqueo</label>
                                <input type="number" id="parqueo" value="5">
                            </div>
        
                            <div class="form-group">
                                <label for="area">Área en metros Cuadrados</label>
                                <input type="text" id="area" placeholder="modificar Área en m2">
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
                            <button type="submit" class="btn btn-update">Actualizar Propiedad</button>
                        </div>
                    </form>
                </div>
            </div>

        </main>

        <?php include('footer.php'); ?>
    </div>


    


</body>
</html>