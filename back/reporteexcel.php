<?php 
include_once('conection.php'); 

if ($con->connect_error) {
    die("Error en la conexión: " . $con->connect_error);
}

// Forzar codificación UTF-8 para que Excel lo interprete correctamente
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=reporte.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "\xEF\xBB\xBF"; 

$sql = "SELECT * FROM inmueble"; 
$result = $con->query($sql);

if ($result === false) {
    die("Error en la consulta: " . $con->error);
}
?>

<h1>Inmobiliaria Emmanuel</h1>
<p>Ubicación: Dosquebradas</p>
<p>Teléfono: +123 456 789</p>
<p>Correo: emmanuel@inmobiliaria.com</p>
<table border="1">
    <thead>
        <tr style="background-color: #f2f2f2; color: #333;">
            <th style="padding: 8px; text-align: left;">ID</th>
            <th style="padding: 8px; text-align: left;">NOMBRE</th>
            <th style="padding: 8px; text-align: left;">UBICACIÓN</th>
            <th style="padding: 8px; text-align: left;">HABITACIONES</th>
            <th style="padding: 8px; text-align: left;">BAÑOS</th>
            <th style="padding: 8px; text-align: left;">PARKING</th>
            <th style="padding: 8px; text-align: left;">ÁREA</th>
            <th style="padding: 8px; text-align: left;">TIPO OFERTA</th>
            <th style="padding: 8px; text-align: left;">PRECIO</th>
            <th style="padding: 8px; text-align: left;">ESTADO</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        // Itera sobre los resultados de la consulta
        while ($row = $result->fetch_assoc()) { 
        ?>
        <tr>
            <td style="padding: 8px; text-align: left;"><?php echo $row['id_inmueble']; ?></td>
            <td style="padding: 8px; text-align: left;"><?php echo $row['nombre_inmueble']; ?></td>
            <td style="padding: 8px; text-align: left;"><?php echo $row['ubicacion_inmueble']; ?></td>
            <td style="padding: 8px; text-align: left;"><?php echo $row['cantidad_habitaciones']; ?></td>
            <td style="padding: 8px; text-align: left;"><?php echo $row['cantidad_baños']; ?></td>
            <td style="padding: 8px; text-align: left;"><?php echo $row['zona_parqueo']; ?></td>
            <td style="padding: 8px; text-align: left;"><?php echo $row['area']; ?></td>
            <td style="padding: 8px; text-align: left;"><?php echo $row['tipo_oferta']; ?></td>
            <td style="padding: 8px; text-align: left;"><?php echo $row['precio_inmueble']; ?></td>
            <td style="padding: 8px; text-align: left;"><?php echo $row['estado']; ?></td>
        </tr>
        <?php 
        } 
        ?>
    </tbody>
</table>
