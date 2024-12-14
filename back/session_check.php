<?php
// Iniciar sesión si aún no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Tiempo límite de inactividad (en segundos)
$tiempo_limite = 300; // 5 minutos

// Verificar si existe el tiempo de la última actividad
if (isset($_SESSION["ultimo_acceso"])) {
    $tiempo_inactivo = time() - $_SESSION["ultimo_acceso"];

    // Si ha pasado el tiempo límite, cerrar sesión
    if ($tiempo_inactivo > $tiempo_limite) {
        session_destroy(); // Destruir sesión
        header("Location: ../login.php"); // Redirigir al login
        exit();
    }
}

// Actualizar el tiempo de la última actividad
$_SESSION["ultimo_acceso"] = time();

// Verificar si hay una sesión activa
if (!isset($_SESSION["correo"])) {
    header("Location: ../login.php");
    exit();
}
?>
