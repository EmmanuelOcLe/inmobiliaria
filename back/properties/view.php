<?php
require_once("conexion.php");

$sql="select * from inventario ORDER BY id_inventario desc";

$resul = mysqli_query($con, $sql);

?> 

<!doctype html>
<html>
<head>
	<link rel="stylesheet" href="css/ximena.css">
 	<script language="JavaScript">
		function pregunta() 
			{
 				if (!(confirm('¿Estas seguro que desea eliminar el elemento?'))){ 
       			return false;  } 
			} 
	</script>
</head>

<body>
      <!--Header menu-->
	  <header class="header">
     <nav>


        <ul class="menu-horizontal">

            
        <li><a href="plantilla.html">Inicio</a></li>
            <li>
                <a class="insert" href="#">Insertar</a>
                <ul class="menu-vertical">
                    <li><a href="Formulario_Insert_ingresos.html">Ingresos</a></li>
                    <li><a href="Formulario_Insert_gastos.html">Gastos</a></li>
                    <li><a href="Formulario_Insert_Clientes.html">Clientes</a></li>
                    <li><a href="Formulario_insert_contratos.html">Contratos</a></li>
                    <li><a href="Formulario_Insert_empleados.html">Empleados</a></li>
                    <li><a href="Formulario_Insert_inventario.html">Inventario</a></li>
                    <li><a href="Formulario_Insert_proveedores.html">Proveedores</a></li>
                    <li><a href="Formulario_Insert_usuarios.html">Usuarios</a></li>
                </ul>
            </li>
            <li>
                <a class="report" href="#">Reportes</a>
                <ul class="menu-vertical">
                    <li><a href="Ver_ingresos.php">Ingresos</a></li>
                    <li><a href="Ver_gastos.php">Gastos</a></li>
                    <li><a href="Ver_clientes.php">Clientes</a></li>
                    <li><a href="Ver_contratos.php">Contratos</a></li>
                    <li><a href="ver_caja_empleados.php">Empleados</a></li>
                    <li><a href="ver_caja_inventario.php">Inventario</a></li>
                    <li><a href="Ver_proveedores.php">Proveedores</a></li>
                    <li><a href="ver_caja_usuarios.php">Usuarios</a></li>
                </ul>
            </li>
            <li class="exit" ><a href="Principal.html">Salir</a></li>
        </ul>
     </nav>
    </header>
<p align="center">INVENTARIO</p>

<form action="./Buscar_inventario_elemento.php" method="post" enctype="multipart/form-data">
	
		<div class="form first">
			<div class="details personal">
				<span class="title"> </span>

	<div class="fields">

		<div class="input-field">
		<label for="elemento"></label>
		<input  class="input" type="text" id="elemento" placeholder="Ingrese el elemento" name="elemento" required >
	   </div>

	  <input  class="btn" type="submit" value="BUSCAR">
     
 </div>
</div>
</div>
</div>
  
</form>

<?php
	
	
while ($row = mysqli_fetch_array($resul)){

 /*almacenamos el nombre de la ruta en la variable $ruta_img*/
 
    $foto = $row["foto"];
    $Id_inventario = $row["id_inventario"]; 
	$Ficha_tecnica = $row["ficha_tecnica"];
	$Tipo = $row["tipo"];
    $Cantidad = $row["cantidad"];
	$Elemento = $row["elemento"];
    $Costo = $row["costo"];;
	$Precio_total = $row["precio_total"]; 

 ?>

<div class="card" >  <br>
    <img class="img" src="./images/<?php echo $foto; ?>" alt="Error Al Cargar La Foto" height="130px" width="130px" /> <br> <br> 

     ID: <?php echo $Id_inventario; ?>  <br>
	FICHA TEC: <?php echo $Ficha_tecnica; ?>  <br>
	TIPO: <?php echo $Tipo; ?> <br>
   CANTIDAD: <?php echo $Cantidad; ?> <br>
    ELEMENTO: <?php echo $Elemento; ?> <br>
   COSTO: <?php echo $Costo; ?> <br>
	 PRECIO TOTAL: <?php echo $Precio_total; ?>


	<br>  <br>  <br> 
	<table>        
    	<tr>
          <td> 
            <form  action="Eliminar_inventario.php" method="post" onsubmit="return pregunta();"><input type = "hidden" value="<?php echo $row["id_inventario"]; ?> " name="id_inventario">
               <input type = "submit"  value= ' ' title="Eliminar Inventario" class = 'delete'>  
             </form>          
          </td>  
    
          <td>         
            <form  action="Formulario_Actualizar_Inventario.php" method="post">                
   		  	    <input type = "hidden" value="<?php echo $row["id_inventario"]; ?> " name="id_inventario">
   		        <input type = "submit"  value= ' ' title="Actualizar Inventario" class = 'update'>
            </form>
		   </td>	
			   
          </tr>   
       </table> 	
</div> 
	
<?php
} 
  
?>


</body>
</html>
