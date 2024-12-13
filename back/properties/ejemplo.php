<?php
require_once('conection.php');

if(!$con){
  echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
  exit;
}
else{
  echo "Hola";
}   

?>