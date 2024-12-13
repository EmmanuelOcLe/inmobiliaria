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

// Evitar problemas de codificación
echo "\xEF\xBB\xBF"; // Añadir el BOM (Byte Order Mark) para que Excel reconozca UTF-8

// Consulta a la base de datos
$sql = "SELECT * FROM inmueble"; // Ajusta los nombres de columnas según tu tabla
$result = $con->query($sql);

// Verifica si la consulta fue exitosa
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
            <th style="padding: 8px; text-align: left;">DESCRIPCIÓN</th>
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
            <td style="padding: 8px; text-align: left;"><?php echo $row['Descripcion_inmueble']; ?></td>
            <td style="padding: 8px; text-align: left;"><?php echo $row['precio_inmueble']; ?></td>
            <td style="padding: 8px; text-align: left;"><?php echo $row['estado_inmueble']; ?></td>
        </tr>
        <?php 
        } 
        ?>
    </tbody>
</table>
