<?php
// Verificar si se enviaron imágenes
if (isset($_FILES['fotos_inmueble']) && isset($_POST['nombre'])) {
    $fotos_inmueble = $_FILES['fotos_inmueble'];

    $rutas = []; // Array para almacenar las rutas de las imágenes
    $directorio = "uploads/";

    // Crear el directorio si no existe
    if (!is_dir($directorio)) {
        mkdir($directorio, 0777, true);
    }

    // Procesar cada imagen
    for ($i = 0; $i < count($fotos_inmueble['name']); $i++) {
        $nombreArchivo = basename($fotos_inmueble['name'][$i]);
        $rutaArchivo = $directorio . uniqid() . "_" . $nombreArchivo;

        // Mover la imagen al directorio de destino
        if (move_uploaded_file($imagenes['tmp_name'][$i], $rutaArchivo)) {
            $rutas[] = $rutaArchivo; // Guardar la ruta en el array
        }
    }

    // Convertir las rutas a formato JSON
    $rutasJSON = json_encode($rutas);

    // Insertar en la base de datos
    $sql = "INSERT INTO inmuebles (fotos_inmueble) VALUES ('$rutasJSON')";

    if ($con->query($sql) === TRUE) {
        echo "Producto agregado con éxito.";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
} else {
    echo "No se enviaron imágenes.";
}

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fotos_inmueble = json_decode($row['fotos_inmueble'], true);

    foreach ($fotos_inmueble as $fotos_inmueble) {
        echo "<img src='$fotos_inmueble' alt='Imagen' style='width: 200px; margin: 10px;'>";
    }
} else {
    echo "No se encontró la imagen del inmueble.";
}

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
</head>
<body>
    <?php include('header2.php');?>

    <div class="container">
        <div class="welcome">
            <h1>Bienvenido <span>administrador</span></h1>
        </div>

        <div class="form-container">
            <h2 class="form-title">Crear una nueva propiedad</h2>
            
            <form method="post" action="registro.php" method="post">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="nombre">Nombre Propiedad</label>
                        <input type="text" id="nombre" placeholder="Nombre de la propiedad" name="propiedad_nombre">
                    </div>

                    <div class="form-group">
                        <label for="ubicacion">Ubicación</label>
                        <input type="text" id="ubicacion" placeholder="Ubicación de la propiedad" name="ubicacion_propiedad">
                    </div>

                    <div class="form-group">
                        <label for="valor">Valor de la propiedad</label>
                        <input type="text" id="valor" placeholder="Valor de la propiedad" name="valor_propiedad">
                    </div>
                </div>

                <div class="numbers-grid">
                    <div class="form-group">
                        <label for="habitaciones">Cantidad de Habitaciones</label>
                        <input type="number" id="habitaciones" min="0" name="habitaciones_cantidad">
                    </div>

                    <div class="form-group">
                        <label for="banos">Cantidad de Baños</label>
                        <input type="number" id="banos" min="0" name="baños_cantidad">
                    </div>

                    <div class="form-group">
                        <label for="parqueo">Zonas de Parqueo</label>
                        <input type="number" id="parqueo" min="0" name="zonas_parqueo">
                    </div>

                    <div class="form-group">
                        <label for="area">Área en metros Cuadrados</label>
                        <input type="text" id="area" placeholder="Área en m2" name="areas_metros">
                    </div>

                    <div class="form-group">
                        <label for="oferta">Tipo de Oferta</label>
                        <select name="oferta" id="oferta">
                            <option value="selecciona">selecciona el tipo</option>
                            <option value="venta">venta</option>
                            <option value="arriendo">arriendo</option>
                            <option value="venta_arriendo">venta y arriendo</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="imagenes">Imágenes de la propiedad</label>
                    <input type="file" id="imagenes" accept="image/*" multiple name="imagen">
                </div>

                <div class="description-area">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion"></textarea>
                </div>

                <div class="buttons">
                    <button type="button" class="btn btn-cancel">Cancelar</button>
                    <button type="submit" class="btn btn-create" name="crear">Crear Propiedad</button>
                </div>
            </form>
        </div>
    </div>
    <?php include('footer.php');?>

</body>
</html>