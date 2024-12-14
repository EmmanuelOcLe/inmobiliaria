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
            <h1 class="welcome">Bienvenido <span class="welcome-name">Emmanuel</span></h1>

            <div class="property-card">
                <div class="card-header">
                    <h2 class="property-title">Parque Residente Dahmia III</h2>
                    <div class="card-actions">
                        <a href="/Inmobiliaria/inmobiliaria/modificar_propiedad.php"><span class="icon icon-edit"></span></a>
                        <span class="icon icon-delete"></span>
                    </div>
                </div>

                <div class="property-price">$ 150.000.000.00</div>

                <div class="gallery">
                    <img src="assets/2151302622.jpg" alt="Propiedad">
                    <button class="gallery-nav gallery-prev">←</button>
                    <button class="gallery-nav gallery-next">→</button>
                </div>

                <div class="property-details">
                    <div class="detail-item">
                        <span class="detail-icon icon-location"></span>
                        <span>Aquí va la localización</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-icon icon-bed"></span>
                        <span>4 Habitaciones</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-icon icon-bath"></span>
                        <span>2 Baños</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-icon icon-area"></span>
                        <span>15 metros cuadrados</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-icon icon-parking"></span>
                        <span>2 Zonas de Parking</span>
                    </div>
                </div>
            </div>
        </main>

        <?php include('footer.php'); ?>

    </div>


</body>
</html>