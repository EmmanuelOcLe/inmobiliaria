<?php
// Conexión a la base de datos
include("conection.php");

// Recibir datos del formulario
$usuario = $_POST["correo"];
$contraseña = $_POST["contrasena"];

// Iniciar la sesión
session_start();

// Consulta para verificar las credenciales
$consulta = "SELECT * FROM accesoadmin WHERE mail='$usuario' AND password='$contraseña'";
$resultado = mysqli_query($con, $consulta);

// Verificar si las credenciales son válidas
if (mysqli_num_rows($resultado) > 0) {
    $_SESSION["correo"] = $usuario; // Crear la sesión con el correo del administrador
    header("Location: ../dashboard-admin.php"); // Redirigir al panel de control
    exit();
} else {
    echo "Datos incorrectos. Por favor, intenta de nuevo.";
    echo "<a href='../login.php'>Volver al login</a>";
}

mysqli_free_result($resultado);
mysqli_close($con);
?>
