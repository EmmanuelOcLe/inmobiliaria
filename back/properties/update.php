<?php
session_start();
require_once("conexion.php");

$sql="Update gastos 
       Set   id_gasto         	= '".$_POST["id_gasto"]."',
	         fecha    = '".$_POST["fecha"]."',
	         valor       = '".$_POST["valor"]."',
	         concepto    = '".$_POST["concepto"]."',
             comprobante     = '".$_POST["comprobante"]."'
             

			
       where id_gasto ='".$_POST["id_gasto"]."'";
	   
	   $res = mysqli_query($con, $sql);

	   if (($res) == 1)
{
		echo "<script type='text/javascript'>
		alert('El gasto ".$_POST["id_gasto"]." fue actualizado');
		window.location='Ver_gastos.php';
	</script>";

}else
{	
	echo "<script type='text/javascript'>
		alert('El gasto ".$_POST["id_gasto"]." no fue actualizado. Intente Nuevamente');
		window.location='Ver_gastos.php';
	</script>";
}
?>