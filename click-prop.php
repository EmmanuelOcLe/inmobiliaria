<?php
require_once('back/conection.php');

if (!$con) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    exit;
} else {
    echo "<script>alert('conexion realizada')</script>";
}

$sql = "SELECT * FROM inmueble LIMIT 1";
$result = mysqli_query($con, $sql);

if($result) {
    $row = mysqli_fetch_assoc($result);

    $id = $row['id_inmueble'];
}

?>

<!DOCTYPE html>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/click-prop.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="icon" href="assets/favicon.ico">
    <title>Propiedades</title>
</head>
<body>
    
    <div class="contenedor-todo">
        <?php include('header2.php'); ?>

        <main class="main">
            <h1 class="welcome">Bienvenido <span class="welcome-name"><?php echo htmlspecialchars($nombre); ?></span></h1>

            <div class="property-card">
                <div class="card-header">
                    <h2 class="property-title"><?php echo htmlspecialchars($nameProperty) ?></h2>
                    <div class="card-actions">
                        <span id="edit-button" class="icon icon-edit"></span>
                        <span id="delete-button" class="icon icon-delete"></span>
                    </div>
                </div>

                <div class="property-price"><?php echo htmlspecialchars($price) ?></div>

                <div class="gallery">
                    <img src="<?php echo htmlspecialchars(string: $image) ?>" alt="Propiedad">
                    <button class="gallery-nav gallery-prev">←</button>
                    <button class="gallery-nav gallery-next">→</button>
                </div>

                <div class="property-details">
                    <div class="detail-item">
                        <span class="detail-icon icon-location"></span>
                        <span><?php echo htmlspecialchars($location) ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-icon icon-bed"></span>
                        <span><?php echo htmlspecialchars($rooms) ?> Habitaciones</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-icon icon-bath"></span>
                        <span><?php echo htmlspecialchars($bathrooms) ?> Baños</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-icon icon-area"></span>
                        <span><?php echo htmlspecialchars($area) ?> metros cuadrados</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-icon icon-parking"></span>
                        <span><?php echo htmlspecialchars($parking) ?> Zonas de Parking</span>
                    </div>
                </div>
            </div>
        </main>

        <?php include('footer.php'); ?>

    </div>

<script>
    const edit = document.getElementById('edit-button');
    const suspend = document.getElementById('delete-button');

    edit.addEventListener('click', () => {
        window.location.href = 'http://localhost/inmobiliaria/modificar_propiedad.php';
    });

    suspend.addEventListener('click', () => {
        <?php
             include('popups/popup-delete.php');
        ?>
    });
</script>
</body>
</html>