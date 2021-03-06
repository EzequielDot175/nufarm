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

<aside>

<?php include("includes/catalogo2.php"); ?>

</aside>
      <article>
        <div class="inicio">
          <div class="slide_btn"></div>
		   <div class="welcometitle"><h2>Bienvenido a la edición 2014 del Catálogo Marketing Net</h2></div>
          <div class="inicio2">
            <video width="691" height="385" controls>
			<source src="video/Entering_The_Stronghold_Audio_Visual_Animation_HD.mp4" type="video/mp4">
			<source src="video/Entering_The_Stronghold_Audio_Visual_Animation_HD.ogv" type="video/ogg">
			<source src="video/Entering_The_Stronghold_Audio_Visual_Animation_HD.webm" type="video/webm">
			Your browser does not support the video tag.
			</video>
		
            <div class="cont original">
              <div class="tx-left">           
                <img class="item6" src="imagenes/item7.png" width="67" height="42" />
                <p>Se trata de una iniciativa de cooperación integral, que Nufarm le brinda a un grupo de distribuidores
                seleccionados, con el fin de realizar acciones de marketing en conjunto.</p>
              </div>
            </div>

            <div class="cont original">
              <div class="tx-left">
                <img class="item7" src="imagenes/item8.png" width="72" height="33" />
                <p>El objetivo de este programa es generar un vínculo directo entre Nufarm y su red de distribuidores, unificando
                la comunicación y la aplicación la imagen corporativa.</p>
              </div>
            </div>

             <div class="cont original">
              <div class="tx-left">
                <img class="item7" src="imagenes/item9.png" width="73" height="34" />
                <p>Vigencia del programa:<br> 
19 de Septiembre al 31 de Julio 2015. La asignación no es acumulable por lo que todos los canjes que no ingresen dentro de ese período no serán contemplados. </p>
              </div>
            </div>

            <div class="subtitulo original">LAS PÁGINAS SUCESIVAS CONTIENEN INFORMACIÓN ÚTIL PARA LLEVAR ADELANTE LAS SIGUIENTES
            ACCIONES:</div>
            <!--<div class="pie-inicio">EL PAGO DE LAS ACCIONES SERÁ ABONADO POR NUFARM DE ACUERDO A UN PRESUPUESTO ASIGNADO. EL MONTO QUE LE CORRESPONDE A CADA DISTRIBUIDOR, SERÁ INFORMADO POR EL REPRESENTANTE TÉCNICO-COMERCIAL DE NUFARM.
    <br><br>EN CASO DE QUE EL GASTO SUPERE EL PRESUPUESTO, NUFARM OFRECE DOS ALTERNATIVAS, QUE DEPENDEN DEL DESTINO DEL DINERO:
     <br><br>
     A) NUFARM ABANDONARÁ EL EXCEDENTE Y LUEGO HARÁ UNA NOTA DE DÉBITO QUE EL CLIENTE DEBERÁ CANCELAR.
     <br>
    B) NUFARM ABONARÁ SOLO EL PRESUPUESTO ASIGNADO Y EL CLIENTE SE ENCARGARÁ DE ABONAR EL EXCEDENTE.
    </div>-->
          </div>
        </div>
      </article><?php include("includes/menu2.php"); ?>
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
            <div class="side_info">
            <h2>ARTÍCULOS PROMOCIONALES <br>
            CON IDENTIFICACIÓN DE MARCA.</h2>
            <div style="height:60px;float:left"></div>
            <p>La realización de artículos promocionales permite crear una buena identificación de marca a la vez de unificar
            la imagen de Nufarm a nivel país. La compra centralizada permite lograr buenos costos y por sobre todo una calidad
            homogénea y asegurada. Por lo tanto, ofrecemos la posibilidad de realizar materiales promocionales:</p>

            <p>Este programa te permitirá tener material promocional con:</p>
            <h2><img src="imagenes/item4.png" alt=""> EL LOGO DE TU EMPRESA</h2>
            <h2><img src="imagenes/item4.png" alt=""> EL LOGO DE NUFARM</h2>
            
            <div class="item4"></div>
            
            <div class="line3"></div>

            <div class="seccion-1">
         
                <img class="item5" src="imagenes/item6.png" width="30" height="30" />
                <p>La disponibilidad de los productos está sujeta al volumen de pedidos que todos los participantes del programa realicen. Apurate! </p>
   
            </div>

             <div class="seccion-1">
         
                <img class="item5" src="imagenes/item6.png" width="30" height="30" />
                <p>Cuando tu compra pase el límite de presupuesto asignado, la página no te permitirá seguir canjeando.</p>
   
            </div>

            </div>
			
			
         <div class="box-content2">

         <ul>

             <li>

             

            <div class="tipro3">
						<div class="titlef"></div>
						<div class="precio-prod">$<?php echo $row_DatosProductos['dblPrecio']; ?></div>
					  </div>



<div class="box-imagen-none">
<div class="sombra2345"></div>
<?php
if($row_DatosProductos['strImagen']){
echo '<img src="images_productos/'.$row_DatosProductos['strImagen'].'" alt="" width="156" height="158"/>';
}else
{
echo '<img src="images_productos/default.png" alt="" width="106" height="108"/>';
}
?>



 <br />

        </div>

     </li>

         </ul>

            </div><!---- Fin box-content ---->

                            <div id="info-right2"> 


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
		
		function checkdisp_color(cantidad,id_color){

			var cantidad_disp = cantidad;

			var cantidad_elegida = $("#caja_color"+id_color).val();

			

			if(isNaN(cantidad_elegida)){

			    $('#info').html("Ingrese solo numeros.");

				$('input[type="submit"]').attr('disabled','disabled');

			}else

				

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


	<?php

	include_once('includes/class.categorias.php');

	

	$verifcat = new categorias();

	$verifcat->select($row_DatosProductos['intCategoria']);

	$talles=$verifcat->gettalles();

				$salida = '';

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

			if($cantidad=="" or $cantidad==0)
			{
			$cantidad=0;
			}else{

			$salida .=    '

			     
				<div id="talles"><a class="tooltip">'.$nombre_talle.'</a>
        <div class="stock-talle"><p>'.$cantidad.'u</p></div>
        <input style="width:43px;height:30px;position:relative;top:-5px" type="text" name="talle['.$talle.']" value="" id="caja'.$id_talle.'" 

				onchange="checkdisp('.$cantidad.','.$id_talle.');"> <!--['.$cantidad.']--></div>

				

			';

			}

		}

		

		

	echo '<p>'.$salida.'</p> <div id="info" style="color:red;"></div>';

		

		

		

	}
	else if($talles ==2)
	{

	

	

		//necesita COLORES

		include_once('includes/class.colores.php');

		include_once('includes/class.colores_productos.php');

		$tll= new colores();

		$color_disp = $tll->select_all_clean();


			$salida = '';


		foreach($color_disp as $color){

			$color_n= new colores();

			$color_n->select($color);

			$id_color = $color_n->getid_color();

			$nombre_color = $color_n->getnombre_color();

			#echo "<p>$idProducto - $talle</p>";

			// genera cuadros con los imputs

			$colprod = new colores_productos();

			$colprod->select_by_producto($row_DatosProductos['idProducto'], $color);

			$id_color_producto = $colprod->getid();

			#echo $id_talle = $tallprod->getid_talle();

			$id_producto = $colprod->getid_producto();

			$cantidad = $colprod->getcantidad();

			if($cantidad=="" or $cantidad==0)
			{
			$cantidad=0;
			}else{

			$salida .=    '

			     
				<div id="talles">
        <div class="stock-talle"><p>'.$cantidad.'u</p></div>
        <input class="box-colores" id="caja_color"  type="text" name="color['.$color.']" value="" onchange="checkdisp_color('.$cantidad.','.$id_color.');"> <!--['.$cantidad.']-->
		<a class="tooltip">'.$nombre_color.'</a>
        </div>

				

			';

			}

		}

		

		

	echo '<p>'.$salida.'</p> <div id="info" style="color:red;"></div>';

		

		

		

	}else{

		//viene de stock en la misma tabla

		//echo '<div class="cant"><a href="#" alt="Stock: '.$row_DatosProductos['intStock'].'" class="tooltip2"><span>Cantidad</span></a> <input name="cantidad" type="text" id="cantidad" value="1"></div> ';
    echo '<input name="cantidad" type="text" id="cantidad" value="1">';

	}

	

	?>


	<span class="line"></span>
	<input type="hidden" name="idProducto" value="<?php echo $row_DatosProductos['idProducto']; ?>">

	<a class="btn-micuenta6" href="index.php?activo=1&prod=1"><span>Cancelar</span></a>
	
	<input id="btn-canje8" type="submit" value="Agregar" /> 

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

