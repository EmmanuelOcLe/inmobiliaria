<?php
$usuario = $_POST["correo"];
$contraseña = $_POST["contrasena"];

session_start();
$_SESSION["correo"]=$usuario;

include("conection.php");
$consulta = "SELECT*FROM accesoadmin where mail='$usuario' and password='$contraseña'";
$resultado=mysqli_query($con,$consulta);

$filas=mysqli_num_rows($resultado);

if($filas){
    header("location:../dashboard-admin.php");
}else{
    echo("Los datos no son correctos");    
}
mysqli_free_result($resultado);
mysqli_close($con);
?>
