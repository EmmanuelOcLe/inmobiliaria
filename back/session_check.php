<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Tiempo máximo de inactividad en segundos (5 minutos = 300 segundos)
$tiempo_maximo_inactividad = 5; // Cambiamos a segundos para consistencia
$tiempo_advertencia = 6; // Tiempo de advertencia antes de cerrar la sesión (1 minuto)

// Si hay un usuario autenticado
if (isset($_SESSION['usuario'])) {
    if (isset($_SESSION['ultimo_acceso'])) {
        $tiempo_inactivo = time() - $_SESSION['ultimo_acceso'];

        if ($tiempo_inactivo >= $tiempo_maximo_inactividad) {
            // Mostrar alerta y cerrar sesión
            session_unset();
            session_destroy();
            header("Location: http://localhost/INMOBILIARIA/inmobiliaria/login.php?timeout=1");
            exit;
        } elseif ($tiempo_inactivo >= ($tiempo_maximo_inactividad - $tiempo_advertencia)) {
            // Mostrar mensaje de advertencia si faltan menos de 1 minuto
                echo "<script>
                if (!document.getElementById('session-warning')) {
                    let warning = document.createElement('div');
                    warning.id = 'session-warning';
                    warning.style.position = 'fixed';
                    warning.style.bottom = '10px';
                    warning.style.right = '10px';
                    warning.style.backgroundColor = '#ffcc00';
                    warning.style.color = '#000';
                    warning.style.padding = '10px';
                    warning.style.borderRadius = '5px';
                    warning.style.zIndex = '1000';
                    warning.style.boxShadow = '0px 4px 6px rgba(0, 0, 0, 0.2)';
                    warning.style.fontSize = '14px';
                    warning.innerHTML = 'Tu sesión está a punto de expirar. Por favor, realiza alguna acción para mantenerla activa.';
                    document.body.appendChild(warning);
                }
        </script>";
        }
    }

    // Actualizar tiempo de actividad
    $_SESSION['ultimo_acceso'] = time();
} else {
    // Si no hay usuario autenticado, redirigir al login
    header("Location: http://localhost/INMOBILIARIA/inmobiliaria/login.php");
    exit;
}
?>
