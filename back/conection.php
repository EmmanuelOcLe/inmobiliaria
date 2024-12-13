<?php
$con = mysqli_connect("localhost:3307", "root", "123456", "bienesraices");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>