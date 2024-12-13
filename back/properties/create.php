<?php
session_start();
require_once("conection.php");
 
$sql="insert into inmueble( nombre_inmueble, ubicacion_inmueble, precio_inmueble, cantidad_habitaciones, cantidad_baños, zona_parqueo, area, fotos_inmueble, Descripcion_inmueble)
values
('".$_POST["propiedad_nombre"]."','".$_POST["ubicacion_propiedad"]."','".$_POST["valor_propiedad"]."','".$_POST["habitaciones_cantidad"]."','".$_POST["baños_cantidad"]."','".$_POST["zona_parqueo"]."','".$_POST["areas_metros"]."', '".$_POST["imagen"]"','".$_POST["descripcion"]"')";

$res=mysqli_query($con,$sql);

if ($res == 1)
{
		echo "<script type='text/javascript'>
		alert('Fue creado Correctamente');
	</script>";
}else
{

	
	echo "<script type='text/javascript'>
		alert('No Fue creado, Intente Nuevamente');
	</script>";
}


?>