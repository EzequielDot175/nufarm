<?php require_once('Connections/conexion.php'); #error_reporting(0); ?>

<?php

if (!function_exists("GetSQLValueString")) {

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 

{

  if (PHP_VERSION < 6) {

    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  }



  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);



  switch ($theType) {

    case "text":

      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";

      break;    

    case "long":

    case "int":

      $theValue = ($theValue != "") ? intval($theValue) : "NULL";

      break;

    case "double":

      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";

      break;

    case "date":

      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";

      break;

    case "defined":

      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;

      break;

  }

  return $theValue;

}

}



$varIdProducto_DatosProductos = "0";

if (isset($_GET["recordID"])) {

  $varIdProducto_DatosProductos = $_GET["recordID"];

}

mysql_select_db($database_conexion, $conexion);

$query_DatosProductos = sprintf("SELECT * FROM productos WHERE productos.idProducto = %s", GetSQLValueString($varIdProducto_DatosProductos, "int"));

$DatosProductos = mysql_query($query_DatosProductos, $conexion) or die(mysql_error());

$row_DatosProductos = mysql_fetch_assoc($DatosProductos);

$totalRows_DatosProductos = mysql_num_rows($DatosProductos);

?>

<?php include("includes/header.php"); ?>



<!-- JQuery -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>







<nav>

<div id="menu">

 <div class="link"><p><a href="index.php">Inicio</a></p></div>

             <div class="link-activo"><p><a href="canjes.php">Canjes</a></p></div>

              <div class="link"><p><a href="mi_cuenta">Mi Cuenta</a></p></div>

                <div class="link"><p><a href="novedades.php">Novedades</a></p></div>

 </ul>

</div>

<div id="buscador"></div>

</nav>

<p>&nbsp;</p>

<section class="box-principal">

<aside class="sidebar">

<?php include("includes/catalogo.php"); ?>

</aside>

<article>



 <div id="avisos_productos">

 	<?php

 	if($_SESSION["notification"]){

		echo '<h3>'.$_SESSION["notification"].'</h3>';

		unset($_SESSION["notification"]);

	}

 	?>

 </div>





 <div class="productos">

         <div class="box-content2">

         <ul>

             <li>

             

  <div class="tipro2"><p><?php echo $row_DatosProductos['strNombre'];  $row_DatosProductos['strImagen']?><p></div>

<a href="carrito_add.php?recordID=<?php echo $row_DatosProductos['idProducto']; ?>">

<div class="box-imagen">
<?php
if($row_DatosProductos['strImagen']){
echo '<img src="images_productos/'.$row_DatosProductos['strImagen'].'" alt="" width="156" height="158"/>';
}
?>



 </a><br />

        </div>

     </li>

         </ul>

            </div><!---- Fin box-content ---->

                       

                       <div class="box-content4">

         <ul>

             <li>

             <a href="carrito_add.php?recordID=<?php echo $row_DatosProductos['idProducto']; ?>">

      <div class="box-imagen2">


<?php
if($row_DatosProductos['strImagen2']){
echo '<img src="images_productos/'.$row_DatosProductos['strImagen2'].'" alt="" width="156" height="158"/>';
}
?>
</a><br />

                  </div>

     </li>

         </ul>

          

                  <ul>

             <li>

              <a href="carrito_add.php?recordID=<?php echo $row_DatosProductos['idProducto']; ?>">

              <div class="box-imagen2">

 <?php
 if($row_DatosProductos['strImagen3']){
 echo '<img src="images_productos/'.$row_DatosProductos['strImagen3'].'" alt="" width="156" height="158"/>';
 }
 ?></a><br />

           </div> 

     </li>

         </ul>

                     </div><!---- Fin box-content ---->

                            

                            <div id="info-right"> 

                            <div class="purple-bar">

                              <h4>$<?php echo $row_DatosProductos['dblPrecio']; ?> +IVA</h4>

                              </div>

                                     <strong><?php echo $row_DatosProductos['strNombre']; ?></strong>

                                    <p><?php echo $row_DatosProductos['strDetalle']; ?></p>

              </div>

              <div class="depro">  

                 <!--<div class="acciones-btns">

              <a class="acciones" href="carrito_add.php?recordID=<?php echo $row_DatosProductos['idProducto']; ?>"><span>Agregar</span></a> <a class="acciones" href="#"><span>Eliminar</span></a>

                        </div> 

              </div>  -->

                                   

              <div id="barra-descripcion">

                            

 <?php if ((isset($_SESSION['MM_IdUsuario']))  && ($_SESSION['MM_IdUsuario']!="")) {?>

	

	

	

	<script type="text/javascript" charset="utf-8">

	$(document).ready(function() {

	     

	     $('input[type="text"]').keyup(function() {

	        if($(this).val() != '') {

	           $('input[type="submit"]').removeAttr('disabled');

	        }

	     });

	 });



	

	

		function checkdisp(cantidad,id_talle){

			var cantidad_disp = cantidad;

			var cantidad_elegida = $("#caja"+id_talle).val();

			

			if(isNaN(cantidad_elegida)){

			    $('#info').html("Ingrese solo numeros.");

				$('input[type="submit"]').attr('disabled','disabled');

			}else{

				

				if(cantidad_disp < cantidad_elegida){

					$('#info').html("Cantidad no disponible!");

					$('input[type="submit"]').attr('disabled','disabled');

				}else{

					$('#info').html("");

				}

			}

			

			return false;

			

			

		}

	</script>



<form action="carrito_add.php" method="post">

	 <div class="cant-titulo">Ingrese la cantidad deseada</div>
	<?php

	include_once('includes/class.categorias.php');

	

	$verifcat = new categorias();

	$verifcat->select($row_DatosProductos['intCategoria']);

	$talles=$verifcat->gettalles();

	

	if($talles ==1){

	

	

		//necesita talles

		include_once('includes/class.talles.php');

		include_once('includes/class.talles_productos.php');

		$tll= new talles();

		$talles_disp = $tll->select_all_clean();





		foreach($talles_disp as $talle){

			$talle_n= new talles();

			$talle_n->select($talle);

			$id_talle = $talle_n->getid_talle();

			$nombre_talle = $talle_n->getnombre_talle();

			#echo "<p>$idProducto - $talle</p>";

			// genera cuadros con los imputs

			$tallprod = new talles_productos();

			$tallprod->select_by_producto($row_DatosProductos['idProducto'], $talle);

			$id_talle_producto = $tallprod->getid();

			#echo $id_talle = $tallprod->getid_talle();

			$id_producto = $tallprod->getid_producto();

			$cantidad = $tallprod->getcantidad();

			if($cantidad==""){$cantidad=0;}

			$salida .=    '

			     

				<div id="talles"><a href="#" alt="Stock: '.$cantidad.'" class="tooltip">'.$nombre_talle.'</a>

				<input style="width:30px;height:18px;margin:0;padding:0" type="text" name="talle['.$talle.']" value="" id="caja'.$id_talle.'" 

				onchange="checkdisp('.$cantidad.','.$id_talle.');"> <!--['.$cantidad.']--></div>

				

			';



		}

		

		

	echo '<p>'.$salida.'</p> <div id="info" style="color:red;"></div>';

		

		

		

	}else{

		//viene de stock en la misma tabla

		echo '<div class="cant"><a href="#" alt="Stock: '.$row_DatosProductos['intStock'].'" class="tooltip2"><span>Cantidad</span></a> <input name="cantidad" type="text" id="cantidad" value="1"></div> ';

	}

	

	?>

	

	<input type="hidden" name="idProducto" value="<?php echo $row_DatosProductos['idProducto']; ?>">

	<a class="add-canje-can" href="canjes.php"><span>Cancelar</span></a><input id="add-canje" type="submit" value="Agregar" /> 

</form>



                    <?php } 

					else

					{?><br /><br />

                    Necesitas <a href="registrar.php">registrarte</a> para canjear en la tienda o <a href="login.php">inicia sesión</a>.

                       

<?php }?> 

              </div>

                   

 </div><!--- Fin Productos --->

  </article>

</section>

</div></div></div></div>

<?php include("includes/footer.php"); ?>

</body>

</html>

<?php

mysql_free_result($DatosProductos);

?>

