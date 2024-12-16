<?php
include('back/session_check.php');
?>

<?php
include('back/session_check.php');
include("back/conection.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id_inmueble = $_GET['id'];

    // Consulta a la base de datos para obtener la propiedad
    $sql = "SELECT * FROM inmueble WHERE id_inmueble = " . intval($id_inmueble);
    $res = mysqli_query($con, $sql);

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
                    
                <form action="back/properties/recibir.php" method="POST" enctype="multipart/form-data">
                    <!-- Campo oculto para el ID de la propiedad -->
                    <input type="hidden" name="id" value="<?php echo $row['id_inmueble']; ?>">

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="nombre">Nombre Propiedad</label>
                            <input name="nombre" type="text" id="nombre" 
                                placeholder="modificar nombre de la propiedad" 
                                value="<?php echo htmlspecialchars($row['nombre_inmueble']); ?>">
                        </div>

                        <div class="form-group">
                            <label for="ubicacion">Ubicación</label>
                            <input name="ubicacion" type="text" id="ubicacion" 
                                placeholder="modificar Ubicación de la propiedad" 
                                value="<?php echo htmlspecialchars($row['ubicacion_inmueble']); ?>">
                        </div>

                        <div class="form-group">
                            <label for="valor">Valor de la propiedad</label>
                            <input name="valor" type="text" id="valor" 
                                placeholder="modificar valor de la propiedad" 
                                value="<?php echo htmlspecialchars($row['precio_inmueble']); ?>">
                        </div>
                    </div>

                    <div class="numbers-grid">
                        <div class="form-group">
                            <label for="habitaciones">Cantidad de Habitaciones</label>
                            <input name="habitaciones" type="number" id="habitaciones" 
                                value="<?php echo intval($row['cantidad_habitaciones']); ?>">
                        </div>

                        <div class="form-group">
                            <label for="banos">Cantidad de Baños</label>
                            <input name="banos" type="number" id="banos" 
                                value="<?php echo intval($row['cantidad_baños']); ?>">
                        </div>

                        <div class="form-group">
                            <label for="parqueo">Zonas de Parqueo</label>
                            <input name="parqueo" type="number" id="parqueo" 
                                value="<?php echo intval($row['zona_parqueo']); ?>">
                        </div>

                        <div class="form-group">
                            <label for="area">Área en metros Cuadrados</label>
                            <input name="area" type="text" id="area" 
                                placeholder="modificar Área en m2" 
                                value="<?php echo htmlspecialchars($row['area']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="tipo_oferta">Tipo Oferta</label>
                            <select name="oferta" id="tipo_oferta">
                                <option value="venta" <?php echo ($row['tipo_oferta'] == 'venta') ? 'selected' : ''; ?>>Venta</option>
                                <option value="arriendo" <?php echo ($row['tipo_oferta'] == 'arriendo') ? 'selected' : ''; ?>>Arriendo</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="imagenes">Imágenes de la propiedad</label>
                        <input name="imagenes" type="file" id="imagenes" accept="image/*" multiple>
                        <?php if (!empty($row['fotos_inmueble'])): ?>
                            <small>Imagen actual: <?php echo htmlspecialchars($row['fotos_inmueble']); ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="description-area">
                        <label for="descripcion">Descripción</label>
                        <textarea name="descripcion" id="descripcion"><?php echo isset($row['descripcion_inmueble']) ? htmlspecialchars($row['descripcion_inmueble']) : ''; ?></textarea>

                    </div>

                    <div class="buttons">
                    <input type="reset" class="btn btn-cancel"></input>
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