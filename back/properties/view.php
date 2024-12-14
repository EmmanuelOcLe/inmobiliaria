<?php
session_start();
$_SESSION["id"]= $id;

include("conection.php");
$consulta = "SELECT*FROM inmuebles where id='$id'";
$resultado=mysqli_query($con,$consulta);
$filas=mysqli_num_rows($resultado);

if($filas){
    header("location:../create.php");
}else{
    echo("Los datos no son correctos");
}
mysqli_free_result($resultado);
mysqli_close($con);
?>

