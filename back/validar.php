<?php
session_start();
include 'conection.php'; 

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

        $_SESSION['usuario'] = $correo;
        $_SESSION['ultimo_acceso'] = time(); 
        header("Location: ../dashboard-admin.php");
        exit;
    } else {

        header("Location: ../login.php?error=1");
        exit;
    }
} else {
    header("Location: ../login.php");
    exit;
}
?>
