<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php require('Connections/conexion.php');?><?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";


$_SESSION["notification"] ="";


// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location:". $MM_restrictGoTo); 
  exit;
}
?>
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



<section>

<?php $activo = $_GET['activo']; include("includes/menu.php"); ?>
<div id="buscador">
   <form name="form1" method="post" action="buscar.php">
    <input type="text" name="buscar" id="buscar" placeholder="Buscar...">
 </form>
</div>
<aside>

<?php include("includes/catalogo2.php"); ?>

</aside>

<article>



 <div id="avisos_productos">
<h2>PRODUCTOS</h2>
 	<?php

 	if($_SESSION["notification"]){

		echo '<h3>'.$_SESSION["notification"].'</h3>';

		unset($_SESSION["notification"]);

	}

 	?>

 </div>





 <div class="productos">
            <div class="side_info">
              <p>La realización de artículos promocionales permite crear una buena identificación de marca a la vez de unificar
              la imagen de Nufarm a nivel país. La compra centralizada permite lograr buenos costos y por sobre todo una calidad
              homogénea y asegurada. Por lo tanto, ofrecemos la posibilidad de realizar materiales promocionales:</p>
              <h2>CON LOGO DEL DISTRIBUIDOR</h2>
              <h2>LOGO DE LA MARCA A PROMOCIONAR</h2>
            </div>
			
			
         <div class="box-content2">

         <ul>

             <li>

             

<div class="tipro">
						<div class="titlef"></div>
						<p>$<?php echo $row_DatosProductos['dblPrecio']; ?></p>
					  </div>



<div class="box-imagen">
<div class="sombra2345"></div>
<?php
if($row_DatosProductos['strImagen']){
echo '<img src="images_productos/'.$row_DatosProductos['strImagen'].'" alt="" width="156" height="158"/>';
}
?>



 <br />

        </div>

     </li>

         </ul>

            </div><!---- Fin box-content ---->

                            <div id="info-right"> 


                                     <strong><?php echo utf8_encode($row_DatosProductos['strNombre']); ?></strong>

                                    <p><?php echo utf8_encode($row_DatosProductos['strDetalle']); ?></p>
									<br>
									<span class="line"></span>
									
									
									              <div id="barra-descripcion"><br><br>

                            

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

				<input style="width:16px;height:18px;margin:0;padding:0" type="text" name="talle['.$talle.']" value="" id="caja'.$id_talle.'" 

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

	<a class="btn-micuenta6" href="index.php?activo=1"><span>Cancelar</span></a><input id="btn-micuenta6" class="btn-micuenta7" type="submit" value="Agregar" /> 

</form>



                    <?php } 

					else

					{?><br /><br />

                    Necesitas <a href="registrar.php">registrarte</a> para canjear en la tienda o <a href="login.php">inicia sesión</a>.

                       

<?php }?> 

              </div>

              </div>

              <div class="depro">  

                 <!--<div class="acciones-btns">

              <a class="acciones" href="carrito_add.php?recordID=<?php echo $row_DatosProductos['idProducto']; ?>"><span>Agregar</span></a> <a class="acciones" href="#"><span>Eliminar</span></a>

                        </div> 

              </div>  -->

                                   



                   

 </div><!--- Fin Productos --->

  </article>
<?php include("includes/footer.php"); ?>
</section>
</body>

</html>

<?php

mysql_free_result($DatosProductos);

?>

