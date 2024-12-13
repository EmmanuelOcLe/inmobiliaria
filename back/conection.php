<?php
$con = mysqli_connect("localhost", "root", "123456", "bienesraices");
$host = "localhost";
$user = "root";
$password = "123456";
$dbname = "inmobiliaria"; 

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>