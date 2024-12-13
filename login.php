<!DOCTYPE html>
<html lang="en">
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
    if (isset($_GET['timeout']) && $_GET['timeout'] == 1) {
        echo "<p style='color: red;'>Tu sesión ha expirado por inactividad. Por favor, inicia sesión de nuevo.</p>";
    }

    include('header.php');
    ?>

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
                    <button type="button" class="btn-cancel">Cancelar</button>
                    <button type="submit" class="btn-submit">Ingresar</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
