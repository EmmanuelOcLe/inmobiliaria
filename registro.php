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

if(!$con){
    echo "No se ha podido conectar a la base de datos" . mysql_error();
}else{
    echo "tabla seleccionada";
}

//Insertar datos de formulario
$insertar_sql = "INSERT INTO inmueble (nombre_inmueble, ubicacion_inmueble, precio_inmueble, cantidad_habitaciones, cantidad_baños, zona_parqueo, area, Descripcion_inmueble)
VALUES ('$nombre', '$ubicacion', $valor, $habitaciones, $baños, $zona_parqueo, $area_m, '$descripcion')";

$resultado = mysqli_query($con, $insertar_sql);

mysqli_close($con);
?>