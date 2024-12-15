<?php 
require_once('conection.php');

$filter = isset($_GET['filter']) ? $_GET['filter'] : '1'; 

// Ajusta la consulta SQL según el filtro
$sql = 'SELECT id_inmueble, 
      nombre_inmueble, ubicacion_inmueble, precio_inmueble, tipo_oferta, 
      CONCAT(cantidad_baños, " baños ", ", ", cantidad_habitaciones, " habitaciones ", ", ", zona_parqueo, " garages") AS "x"
      FROM inmueble WHERE estado = "habilitada"';

if ($filter == '2') {
    $sql .= ' AND tipo_oferta = "Venta"';
} elseif ($filter == '3') {
    $sql .= ' AND tipo_oferta = "Arriendo"';
}

$res = mysqli_query($con, $sql);

if ($res && mysqli_num_rows($res) > 0) {
    while($fila = mysqli_fetch_assoc($res)) {
        echo '<div class="card" onclick="redirectToCardInfo('.$fila['id_inmueble'].')">';
            echo '<img src="assets/card-image.jpg" alt="Imagen" class="card-image">';
            echo '<div class="card-info-container">';
                echo '<h3 class="card-title"> '.$fila['nombre_inmueble'].' </h3>';
                echo '<span class="card-info"> '.$fila['ubicacion_inmueble'].' </span>';
                echo '<h2 class="card-price">R$ '.$fila['precio_inmueble'].' </h2>';
                echo '<span class="card-info"> '.$fila['x'].' </span><span class="card-offer" id="oferta">'.$fila['tipo_oferta'].'</span>';
            echo '</div>';
        echo '</div>';
    }
} else {
    echo 'No se encontraron resultados para este filtro.';
}
?>
<?php 
require_once('conection.php');

// Verifica si se ha enviado un valor de filtro
$filter = isset($_GET['filter']) ? $_GET['filter'] : '1'; 

// Ajusta la consulta SQL según el filtro
$sql = 'SELECT id_inmueble, 
      nombre_inmueble, ubicacion_inmueble, precio_inmueble, tipo_oferta, 
      CONCAT(cantidad_baños, " baños ", ", ", cantidad_habitaciones, " habitaciones ", ", ", zona_parqueo, " garages") AS "x"
      FROM inmueble WHERE estado = "habilitada"';

if ($filter == '2') {
    $sql .= ' AND tipo_oferta = "Venta"';
} elseif ($filter == '3') {
    $sql .= ' AND tipo_oferta = "Arriendo"';
}

$res = mysqli_query($con, $sql);

if ($res && mysqli_num_rows($res) > 0) {
    while($fila = mysqli_fetch_assoc($res)) {
        echo '<div class="card" onclick="redirectToCardInfo('.$fila['id_inmueble'].')">';
            echo '<img src="assets/card-image.jpg" alt="Imagen" class="card-image">';
            echo '<div class="card-info-container">';
                echo '<h3 class="card-title"> '.$fila['nombre_inmueble'].' </h3>';
                echo '<span class="card-info"> '.$fila['ubicacion_inmueble'].' </span>';
                echo '<h2 class="card-price">R$ '.$fila['precio_inmueble'].' </h2>';
                echo '<span class="card-info"> '.$fila['x'].' </span><span class="card-offer" id="oferta">'.$fila['tipo_oferta'].'</span>';
            echo '</div>';
        echo '</div>';
    }
} else {
    echo 'No se encontraron resultados para este filtro.';
}
?>
