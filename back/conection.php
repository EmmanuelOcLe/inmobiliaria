<?php
$con = mysqli_connect("localhost", "root", "123456", "bienesraices");

if (!$con) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    exit;
}
?>