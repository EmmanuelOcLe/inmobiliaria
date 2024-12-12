<?php
session_start();
require_once("conection.php");
 
$sql="insert into propiedades ( fecha_inicio, fecha_finalizacion, nombre, descripcion, tipo_contrato, pago, valor) 
values
('".$_POST["fecha_inicio"]."','".$_POST["fecha_finalizacion"]."','".$_POST["nombre"]."','".$_POST["descripcion"]."','".$_POST["tipo_contrato"]."','".$_POST["pago"]."','".$_POST["valor"]."')";

$res=mysqli_query($con,$sql);

if ($res == 1)
{
		echo "<script type='text/javascript'>
		alert('Fue Ingresado Correctamente');
	</script>";
}else
{

	
	echo "<script type='text/javascript'>
		alert('No Fue Ingresado, Intente Nuevamente');
	</script>";
}
?>