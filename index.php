<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/global.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="icon" href="assets/favicon.ico">
  <title>Inmobiliaria Emmanuel</title>
</head>
<body>

  <div class="contenedor-todo">

    <header class="header-tag">
      <div class="header-background">
        <nav class="navbar">
          <a href="index.php" class="header-logo-link">
            <h1 class="header-logo">IE</h1>
          </a>
          <div class="header-options-container">
            <a href="index.php" class="header-option">Inicio</a>
            <a href="about.php" class="header-option">Sobre nosotros</a>
            <a href="arrendamiento.php" class="header-option">Servicios</a>
            <a href="login.php" class="header-option">Administración</a>
          </div>
        </nav>
        
        <div class="header-text">
          <h2 class="header-text-title">Mais de 7 anos atuando <br/> no mercado imobiliário</h2>
          <p class="header-text-p">
            Especialistas em aluguel e venda de imóveis de alto <br/> padrão na região de Presidente Prudent e cidades vizinhas.
          </p>
        </div>
      </div>
    </header>

    <form method="POST" action="index.php">
      <select name="filter" id="filter" onchange="applyFilter()">
        <option value="1">Todos</option>
        <option value="2">Venta</option>
        <option value="3">Arriendo</option>
      </select>
    </form>

    <main class="main-tag">
      <?php
        
        require_once('back/conection.php');

        // Por defecto, mostramos todas las propiedades
        $filter = '1';  // Todos
        $sql = 'SELECT id_inmueble, 
                nombre_inmueble, ubicacion_inmueble, precio_inmueble, tipo_oferta, 
                CONCAT(cantidad_baños, " baños ", ", ", cantidad_habitaciones, " habitaciones ", ", ", zona_parqueo, " garages") AS "x"
                FROM inmueble WHERE estado = "habilitada"';

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
    </main>

    <?php include('footer.php'); ?>

  </div>

  <script>
    function redirectToCardInfo(id){
      window.location.href = 'view-property.php?xyz=' + id;
    }

    function applyFilter() {
      const filterValue = document.getElementById('filter').value;

      const xhr = new XMLHttpRequest();
      xhr.open('GET', 'back/filter-properties.php?filter=' + filterValue, true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          document.querySelector('main').innerHTML = xhr.responseText;
        }
      };
      xhr.send();
    }
  </script>

  <script src="scripts/index.js"></script>
</body>
</html>
