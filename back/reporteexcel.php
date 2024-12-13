<?php 
include_once('conection.php'); // Incluye la conexión a la base de datos

// Verifica si la conexión tiene errores
if ($con->connect_error) {
    die("Error en la conexión: " . $con->connect_error);
}

// Encabezados para la descarga del archivo Excel
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=reporte.xls");

// Consulta a la base de datos
$sql = "SELECT id, nombre, apellido FROM inmueble"; // Ajusta los nombres de columnas según tu tabla
$result = $con->query($sql);

// Verifica si la consulta fue exitosa
if ($result === false) {
    die("Error en la consulta: " . $con->error);
}
?>

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
            <th style="padding: 8px; text-align: left;">OFERTA</th>
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
            <td style="padding: 8px; text-align: left;"><?php echo $row['id_']; ?></td>
            <td style="padding: 8px; text-align: left;"><?php echo $row['nombre']; ?></td>
            <td style="padding: 8px; text-align: left;"><?php echo $row['apellido']; ?></td>
        </tr>
        <?php 
        } 
        ?>
    </tbody>
</table>
