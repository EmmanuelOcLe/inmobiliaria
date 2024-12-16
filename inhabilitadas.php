<?php
include 'back/conection.php';
include_once 'back/session_check.php';
$sql = "SELECT id_inmueble, nombre_inmueble, precio_inmueble, fotos_inmueble, motivo, fecha_actualizacion FROM inmueble WHERE estado = 'deshabilitada'";    
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/inhabilitadas.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/popup.css">
    <link rel="icon" href="assets/favicon.ico">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Inmuebles Emmanuel</title>
</head>

<body>

    <div class="contenedor-todo">
        <?php include('header2.php');?>
            <main>
                <div class="InmueblesInabi">
                    <h1 class="text-h1">Inmuebles <span class="name">Inhabilitadas</span></h1>
                    <div class="grid-contenedores">
                        <?php if ($result->num_rows > 0): ?>

                            <?php while ($row = $result->fetch_assoc()): ?>
                                <div class="propiedad-card" onclick="showPopup(<?= $row['id_inmueble'] ?>)">
                                    <div class="propiedad-image">
                                        <?php 
                                        $carpetaImagenes = 'images/properties/' . $row['id_inmueble'];
                                        $imagenSrc = 'assets/image.png';
                                        if (is_dir($carpetaImagenes)) {
                                            $archivos = scandir($carpetaImagenes);
                                            foreach ($archivos as $archivo) {
                                                if ($archivo !== '.' && $archivo !== '..') {
                                                    $imagenSrc = $carpetaImagenes . '/' . $archivo;
                                                    break;
                                                }
                                            }
                                        }
                                        echo '<img src="' . $imagenSrc . '" alt="Imagen">';
                                        ?>
                                    </div>
                                    <div class="property-detalles">
                                        <p class="propiedad-nombre"><?= htmlspecialchars($row['nombre_inmueble']) ?></p>
                                        <span class="propiedad-precio">R$ <?= htmlspecialchars($row['precio_inmueble']) ?></span>
                                        <!-- Agregar motivo -->
                                        <p class="propiedad-motivo"><strong>Motivo:</strong> <?= htmlspecialchars($row['motivo']) ?></p>
                                        <!-- Agregar fecha y hora de actualización -->
                                        <p class="propiedad-fecha"><strong>Fecha:</strong> <?= htmlspecialchars($row['fecha_actualizacion']) ?></p>
                                    </div>
                                </div>
                            <?php endwhile; ?>

                        <?php else: ?>
                            <p>No hay propiedades inhabilitadas.</p>
                        <?php endif; ?>
                    </div>
                </div>

            </main>
        <?php include('footer.php'); ?>

        
        <div class="popup-overlay" id="popup-overlay" onclick="closePopup()"></div>
        
        <div id="popup" class="popup">
            <form class="popup-form" id="popup-form" action="back/habilitar.php" method="POST">
                <h3>Habilitacion de Inmueble</h3>
                <input type="hidden" id="id_inmueble" name="id_inmueble">

                <label for="motivo-select">Selecciona el motivo por el que desea habilitar el inmueble:</label>
                <select id="motivo-select" name="motivo" onchange="toggleTextarea()">
                    <option value="Disponible nuevamente">Disponible nuevamente</option>
                    <option value="Reparaciones completadas">Reparaciones completadas</option>
                    <option value="Solicitud directa del propietario">Solicitud directa del propietario</option>
                    <option value="Otra">Otra</option>
                </select>
                <textarea id="motivo-textarea" name="motivo_otro" placeholder="Escribe el motivo..." style="display: none;" ></textarea>
                <div class="popup-buttons">
                    <button type="button" onclick="closePopup()">Cancelar</button>
                    <button type="submit">Aceptar</button>
                </div>
            </form>
        </div>
    </div>



    <script>
        function showPopup(id) {
            document.getElementById('id_inmueble').value = id;
            document.getElementById('popup').style.display = 'block';
            document.getElementById('popup-overlay').style.display = 'block';
        }

        function closePopup() {
            document.getElementById('popup').style.display = 'none';
            document.getElementById('popup-overlay').style.display = 'none';
        }

        function toggleTextarea() {
        const motivoSelect = document.getElementById('motivo-select');
        const motivoTextarea = document.getElementById('motivo-textarea');
        if (motivoSelect.value === 'Otra') {
            motivoTextarea.style.display = 'block';
            motivoTextarea.setAttribute('required', 'required');
        } else {
            motivoTextarea.style.display = 'none';
            motivoTextarea.removeAttribute('required');
            motivoTextarea.value = '';
        }
    }
    </script>

</body>
</html>
