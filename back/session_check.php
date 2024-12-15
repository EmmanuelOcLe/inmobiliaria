<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$tiempo_maximo_inactividad = 300; // 10 segundos de inactividad

if (isset($_SESSION['usuario'])) {
    if (isset($_SESSION['ultimo_acceso'])) {
        $tiempo_inactivo = time() - $_SESSION['ultimo_acceso'];

        // Verificar si el tiempo de inactividad ha excedido el límite
        if ($tiempo_inactivo >= $tiempo_maximo_inactividad) {
            // Si se ha superado el tiempo de inactividad, cerramos la sesión
            session_unset();
            session_destroy();

            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        if (document.getElementById('session-warning')) return;

                        let overlay = document.createElement('div');
                        overlay.id = 'session-overlay';
                        overlay.style.position = 'fixed';
                        overlay.style.top = '0';
                        overlay.style.left = '0';
                        overlay.style.width = '100%';
                        overlay.style.height = '100%';
                        overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.7)';
                        overlay.style.zIndex = '999';
                        overlay.style.filter = 'blur(5px)';
                        overlay.style.pointerEvents = 'none';

                        let popup = document.createElement('div');
                        popup.id = 'session-warning';
                        popup.style.position = 'fixed';
                        popup.style.top = '50%';
                        popup.style.left = '50%';
                        popup.style.transform = 'translate(-50%, -50%)';
                        popup.style.backgroundColor = '#fff';
                        popup.style.color = '#000';
                        popup.style.padding = '20px';
                        popup.style.borderRadius = '10px';
                        popup.style.zIndex = '1100';
                        popup.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.3)';
                        popup.style.fontSize = '16px';
                        popup.style.fontFamily = 'Arial, sans-serif';
                        popup.style.width = '300px';
                        popup.style.textAlign = 'center';

                        let mensaje = document.createElement('p');
                        mensaje.innerHTML = '¡Llevas mucho tiempo sin moverte! Por tu seguridad, cerramos tu sesión.';

                        let button = document.createElement('button');
                        button.innerHTML = 'Entra de nuevo';
                        button.style.backgroundColor = '#007bff';
                        button.style.color = 'white';
                        button.style.border = 'none';
                        button.style.padding = '10px 20px';
                        button.style.borderRadius = '5px';
                        button.style.fontSize = '16px';
                        button.style.cursor = 'pointer';
                        button.style.marginTop = '10px';

                        button.onclick = function() {
                            window.location.href = 'login.php';
                        };

                        popup.appendChild(mensaje);
                        popup.appendChild(button);
                        document.body.appendChild(popup);
                        document.body.appendChild(overlay);
                    });
                </script>";
            exit;
        }
    }

    // Actualizar el tiempo de actividad
    $_SESSION['ultimo_acceso'] = time();
} else {
    // Si no hay usuario autenticado, redirigir al login
    header("Location: login.php");
    exit;
}
?>

<script>
// Variable para manejar el tiempo de inactividad
let timeout;
let mouseMoved = false;  // Variable para detectar si el mouse se ha movido

// Esta función reinicia el temporizador de inactividad
function resetActivityTimer() {
    clearTimeout(timeout);

    // Si el mouse se ha movido, no reiniciamos el temporizador
    if (mouseMoved) {
        timeout = setTimeout(function() {
            // Después de 10 segundos de inactividad, recargamos la página
            location.reload(); // Recargar la página después de 10 segundos de inactividad
        }, 10000); // 10 segundos de inactividad
    } else {
        timeout = setTimeout(function() {
            // Si no se mueve el mouse por 10 segundos, recargamos la página
            location.reload(); // Recargar la página después de 10 segundos de inactividad
        }, 300000); // 10 segundos de inactividad
    }
}

// Detectar eventos de actividad (movimiento del ratón, clics y teclas presionadas)
document.addEventListener('mousemove', function() {
    mouseMoved = true;  // Detectamos que el mouse se movió
    resetActivityTimer();  // Reiniciamos el temporizador al mover el mouse
});

document.addEventListener('click', function() {
    mouseMoved = false;  // Al hacer clic, desactivamos el movimiento del mouse
    resetActivityTimer();  // Reiniciamos el temporizador al hacer clic
});

document.addEventListener('keydown', function() {
    mouseMoved = false;  // Al presionar teclas, desactivamos el movimiento del mouse
    resetActivityTimer();  // Reiniciamos el temporizador al presionar teclas
});

// Inicializar el temporizador de inactividad
resetActivityTimer();
</script>
