<?php
include 'back/conection.php';
include_once 'back/session_check.php';
$sql = "SELECT id_inmueble, nombre_inmueble, precio_inmueble, fotos_inmueble FROM inmueble WHERE estado = 'deshabilitada'";
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
    <title>Propiedades Inhabilitadas</title>
</head>
<body>

    <div class="contenedor-todo">
        <?php include('header2.php');
         ?>
            <main>
                <a href=""><span></span></a>
                <div class="InmueblesInabi">
                    <h1 class="text-h1">Inmuebles Inhabilitados</h1>
                    <div class="grid-contenedores">
                        <?php if ($result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <div class="propiedad-card" onclick="showPopup(<?= $row['id_inmueble'] ?>)">
                                    <div class="propiedad-image">
                                        <img src="<?= $row['fotos_inmueble'] ?>" alt="Imagen de la propiedad">
                                    </div>
                                    <div class="property-detalles">
                                        <p class="propiedad-nombre"><?= $row['nombre_inmueble'] ?></p>
                                        <span class="propiedad-precio">R$ <?= $row['precio_inmueble'] ?></span>
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
