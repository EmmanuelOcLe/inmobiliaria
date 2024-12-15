<?php
include('back/session_check.php');
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inmobiliaria Emmanuel</title>
    <link rel="stylesheet" href="css/modificar_propiedad.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/global.css"> 
    <link rel="icon" href="assets/favicon.ico">
</head>
<body>

    <div class="contenedor-todo">
        <?php include('header2.php'); ?>

        <main>
        
            <div class="container">
                <div class="welcome">
                <a href="index.php" class="back-button"> 
                    <i class='bx bx-arrow-back'></i>
                    Volver
                </a>
                    <h1>Bienvenido <span>Emmanuel</span></h1>
                </div>
        
                <div class="form-container"> 
                    <h2 class="form-title">Modificar una propiedad</h2>
                    
                    <form action="back/properties/recibir.php" method="POST"> <!--POST envia la informacion Incriptada-->
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="nombre">Nombre Propiedad</label>
                                <input name= "nombre" type="text" id="nombre" placeholder="modificar nombre de la propiedad">
                            </div>
        
                            <div class="form-group">
                                <label for="ubicacion">Ubicación</label>
                                <input name="ubicacion" type="text" id="ubicacion" placeholder="modificar Ubicación de la propiedad">
                            </div>
        
                            <div class="form-group">
                                <label for="valor">Valor de la propiedad</label>
                                <input  name="valor" type="text" id="valor" placeholder="modificar valor de la propiedad">
                            </div>
                        </div>
        
                        <div class="numbers-grid">
                            <div class="form-group">
                                <label for="habitaciones">Cantidad de Habitaciones</label>
                                <input name="habitaciones"  type="number" id="habitaciones" value="2">
                            </div>
        
                            <div class="form-group">
                                <label for="banos">Cantidad de Baños</label>
                                <input name="banos" type="number" id="banos" value="2">
                            </div>
        
                            <div class="form-group">
                                <label   for="parqueo">Zonas de Parqueo</label>
                                <input name="parqueo"  type="number" id="parqueo" value="5">
                            </div>
        
                            <div class="form-group">
                                <label for="area">Área en metros Cuadrados</label>
                                <input name="area" type="text" id="area" placeholder="modificar Área en m2">
                            </div>
                            <div class="form-group">
                                <label for="tipo_oferta">tipo oferta</label>
                                <select name="oferta" id="tipo_oferta">
                                    <option value="venta">Venta</option>
                                    <option value="arriendo">Arriendo</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group-estado">
                            <label for="tipo_oferta">estado  inmueble</label>
                            <!-- <select  name="estado" id="estado_inmueble">
                                <option value="Habilitadas">Habilitada</option>
                                <option value="Deshabilitadas">Desahabilitad</options>
                            </select> -->
                        </div>
                        <div class="form-group">
                            <label for="id">ID</label>
                            <input name="id"  type="number" id="parqueo" value="5">
                        </div>
        
                        <div class="form-group">
                            <label for="imagenes">Imágenes de la propiedad</label>
                            <input name="imagenes" type="file" id="imagenes" accept="image/*" multiple>
                        </div>
        
                        <div class="description-area">
                            <label for="descripcion">Descripción</label>
                            <textarea name="descripcion" id="descripcion"></textarea>
                        </div>
        
                        <div class="buttons">
                            <button type="button" class="btn btn-cancel">Cancelar</button>
                            <button type="submit" class="btn btn-update">Actualizar Propiedad</button>
                        </div>
                    </form>
                </div>
            </div>

        </main>



        <?php include('footer.php'); ?>
    </div>
</body>
</html>