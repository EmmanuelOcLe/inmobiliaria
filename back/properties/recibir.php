<?php

require_once("../conection.php");
//Me Recibo los valores de cada input
$nombre = $_POST['nombre'];
$ubicacion = $_POST['ubicacion'];
$habitaciones = $_POST['habitaciones'];
$banos= $_POST['banos'];
$parqueo=$_POST['parqueo'];
$area=$_POST['area'];
$descripcion=$_POST['descripcion'];
$tipo_oferta = $_POST['oferta'];
$valor = $_POST['valor'];
$id = $_POST['id'];





$sql = "UPDATE inmueble SET 
    nombre_inmueble = '$nombre', 
    ubicacion_inmueble = '$ubicacion',
    cantidad_habitaciones = $habitaciones, 
    cantidad_baños = $banos, 
    zona_parqueo = '$parqueo', 
    area = $area, 
    descripcion_inmueble = '$descripcion', 
    tipo_oferta = '$tipo_oferta', 
    precio_inmueble = $valor
WHERE id_inmueble = $id";

if (mysqli_query($con, $sql)) {
    echo "<script>
        alert('Cambios Realizados Correctamente'); 
        window.location.href='../../dashboard-admin.php';
    </script>";
} else {
    echo "Error al actualizar el registro: " . mysqli_error($con);
}




?>