<?php 
require_once('conection.php');

$sql = 'select nombre_inmueble, ubicacion_inmueble from inmueble where estado_inmueble = "deshabilitado"';

$res = mysqli_query($con, $sql);

if ($res && mysqli_num_rows($res) > 0){ // Verifica si la variable $res contiene un valor válido. Luego verifica si tiene almenos una fila
  while($fila = mysqli_fetch_assoc($res)){
    echo "<h1>Nombre del inmueble: " . $fila['nombre_inmueble'] . "</h1>";
    echo "<p>Ubicación: " . $fila['ubicacion_inmueble'] . "</p>";
  }
}
?>