<?php
session_start();
include("back/conection.php");

//Datos dle formulario
$nombre = $_POST["propiedad_nombre"];
$ubicacion = $_POST["ubicacion_propiedad"];
$valor = $_POST["valor_propiedad"];
$habitaciones = $_POST["habitaciones_cantidad"];
$baños = $_POST["baños_cantidad"];
$zona_parqueo = $_POST["zonas_parqueo"];
$area_m = $_POST["areas_metros"];
$descripcion = $_POST["descripcion"];
$oferta = $_POST["oferta"];
$habilitado = "habilitada";

if(!$con){
    echo "No se ha podido conectar a la base de datos" . mysqli_connect_error();
}else{
    echo '<script>"alert("Datos enviados")"</script>';
}


//Insertar datos de formulario
$sql = "INSERT INTO inmueble (nombre_inmueble, ubicacion_inmueble, cantidad_baños, cantidad_habitaciones, zona_parqueo, area, descripcion_inmueble, tipo_oferta, precio_inmueble, estado)
VALUES ('$nombre', '$ubicacion', $baños, $habitaciones, $zona_parqueo, $area_m, '$descripcion', '$oferta', '$valor', '$habilitado')";

$resultado = mysqli_query($con, $sql);

mysqli_close($con);
?>