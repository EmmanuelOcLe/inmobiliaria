<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="icon" href="assets/favicon.ico">
    <title>Inmobiliaria Emmanuel</title>
</head>
<body>
    <?php
    session_start(); // Inicia la sesión
    if (isset($_SESSION['usuario'])) {
        // Redirigir al dashboard si ya está logueado
        header("Location: dashboard-admin.php");
        exit;
    }

    // Variables de mensajes
    $mensaje = '';
    $titulo = '';

    if (isset($_GET['timeout']) && $_GET['timeout'] == 1) {
        $mensaje = "Tu sesión ha expirado por inactividad. Por favor, inicia sesión de nuevo.";
        $titulo = "Sesión Expirada";
    }

    if (isset($_GET['error']) && $_GET['error'] == 1) {
        $mensaje = "Credenciales incorrectas. Inténtalo de nuevo.";
        $titulo = "Error de Autenticación";
    }

    include('header.php'); // Incluir el encabezado
    ?>

    <!-- Sección principal -->
    <main class="main-tag">
        <div class="container">
            <form class="login-form" action="back/validar.php" method="post">
                <h2>LOGIN</h2>
                <div class="input-group">
                    <label for="correo">Correo</label>
                    <input type="email" id="correo" name="correo" required>
                </div>
                <div class="input-group">
                    <label for="contrasena">Contraseña</label>
                    <input type="password" id="contrasena" name="contrasena" required>
                </div>
                <div class="button-group">
                    <button type="button" class="btn-cancel" onclick="window.location.href='index.php'">Cancelar</button>
                    <button type="submit" class="btn-submit">Ingresar</button>
                </div>
            </form>
        </div>
    </main>

    <!-- Popup Modal -->
    <?php if ($mensaje): ?>
        <div class="popup-overlay" id="popup">
            <div class="popup">
                <h3><?php echo $titulo; ?></h3>
                <p><?php echo $mensaje; ?></p>
                <button onclick="cerrarPopup()">Aceptar</button>
            </div>
        </div>
    <?php endif; ?>

    <!-- Script para cerrar el popup -->
    <script>
        function cerrarPopup() {
            document.getElementById('popup').style.display = 'none';
        }
    </script>
</body>
</html>
