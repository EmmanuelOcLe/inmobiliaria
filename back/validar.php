<?php
session_start();
include 'conection.php'; // Archivo de conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Consulta para verificar credenciales
    $sql = "SELECT * FROM administrador WHERE email = ? AND password = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $correo, $contrasena);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Credenciales válidas
        $_SESSION['usuario'] = $correo;
        $_SESSION['ultimo_acceso'] = time(); // Registrar el tiempo de inicio de sesión
        header("Location: ../dashboard-admin.php");
        exit;
    } else {
        // Credenciales incorrectas
        header("Location: ../login.php?error=1");
        exit;
    }
} else {
    header("Location: ../login.php");
    exit;
}
?>
