<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inmobiliaria Emmanuel</title>
    <link rel="stylesheet" href="css/arrendamiento.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="icon" href="assets/favicon.ico">
</head>
<body>
    
    <div class="contenedor-todo">
        <?php include('header.php'); ?>

            <main>
                <section class="service-section">
                    <div class="content-wrapper">
                        <div class="text-content">
                            <h2>Servicios de arrendamiento</h2>
                            <p>En Emmanuel inmuebles ofrecemos una amplia gama de propiedades en alquiler, ideales para satisfacer tus necesidades, ya sea para uso residencial, comercial o vacacional. Nuestro equipo está listo para ayudarte a encontrar el inmueble perfecto con las mejores condiciones.</p>
                            <a href="index_arriendo.php" class="cta-button">Arrienda ya</a>
                        </div>
                        <div class="image-content">
                            <img src="assets/imagen1-arrendamiento.png" alt="Interior moderno de apartamento">
                        </div>
                    </div>
                </section>

                <section class="divider"></section>


                <section class="service-section reverse">
                    <div class="content-wrapper">
                        <div class="image-content">
                            <img src="assets/imagen2-arrendamiento.png" alt="Exterior de complejo residencial Granada">
                        </div>
                        <div class="text-content">
                            <h2>Servicios de venta</h2>
                            <p>En Emmanuel inmuebles nos especializamos en convertir la venta de tu propiedad en una experiencia sencilla y sin complicaciones. Entendemos que cada inmueble es único, por eso nuestro equipo de expertos te brinda asesoría personalizada para destacar su valor en el mercado. Nos encargamos de todo el proceso, desde la valuación inicial hasta la firma final, asegurando rapidez, transparencia y el mejor precio posible para ti.</p>
                            <a href="index_ventas.php" class="cta-button">Compra Ya</a>
                        </div>
                    </div>
                </section>
            </main>

        <?php include('footer.php'); ?>
    </div>

</body>
</html>