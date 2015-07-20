<?php require_once('Connections/conexion.php');error_reporting(1); ?>
<?php
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

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo,"?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location:". $MM_restrictGoTo); 
  exit;
}
?>
<?php include("includes/header.php"); ?>
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



$currentPage = $_SERVER["PHP_SELF"];



$maxRows_RecordProductos = 35;

$pageNum_RecordProductos = 0;

if (isset($_GET['pageNum_RecordProductos'])) {

  $pageNum_RecordProductos = $_GET['pageNum_RecordProductos'];

}

$startRow_RecordProductos = $pageNum_RecordProductos * $maxRows_RecordProductos;



mysql_select_db($database_conexion, $conexion);
//PRODUCTOS TOTALES
$query_RecordProductos = "SELECT * FROM productos AS prod WHERE prod.intStock >=1  AND destacado=0 ORDER BY prod.strNombre DESC";
$query_limit_RecordProductos = sprintf("%s LIMIT %d, %d", $query_RecordProductos, $startRow_RecordProductos, $maxRows_RecordProductos);
$RecordProductos = mysql_query($query_limit_RecordProductos, $conexion) or die(mysql_error());
$row_RecordProductos = mysql_fetch_assoc($RecordProductos);

//PRODUCTO DESTACADO 1
$query_RecordProductos_destacado = "SELECT * FROM productos WHERE intStock >=1 AND destacado=1 ORDER BY productos.strNombre DESC";
$query_limit_RecordProductos_destacado = sprintf("%s LIMIT %d, %d", $query_RecordProductos_destacado, $startRow_RecordProductos, $maxRows_RecordProductos);
$RecordProductos_destacado = mysql_query($query_limit_RecordProductos_destacado, $conexion) or die(mysql_error());
$row_RecordProductos_destacado = mysql_fetch_assoc($RecordProductos_destacado);

//PRODUCTO DESTACADO 2
$query_RecordProductos_destacado2 = "SELECT * FROM productos WHERE intStock >=1 AND destacado=2 ORDER BY productos.strNombre DESC";
$query_limit_RecordProductos_destacado2 = sprintf("%s LIMIT %d, %d", $query_RecordProductos_destacado2, $startRow_RecordProductos, $maxRows_RecordProductos);
$RecordProductos_destacado2 = mysql_query($query_limit_RecordProductos_destacado2, $conexion) or die(mysql_error());
$row_RecordProductos_destacado2 = mysql_fetch_assoc($RecordProductos_destacado2);

//PRODUCTO DESTACADO 3
$query_RecordProductos_destacado3 = "SELECT * FROM productos WHERE intStock >=1 AND destacado=3 ORDER BY productos.strNombre DESC";
$query_limit_RecordProductos_destacado3 = sprintf("%s LIMIT %d, %d", $query_RecordProductos_destacado3, $startRow_RecordProductos, $maxRows_RecordProductos);
$RecordProductos_destacado3 = mysql_query($query_limit_RecordProductos_destacado3, $conexion) or die(mysql_error());
$row_RecordProductos_destacado3 = mysql_fetch_assoc($RecordProductos_destacado3);

//PRODUCTOS TOTALES

if (isset($_GET['totalRows_RecordProductos'])) {

  $totalRows_RecordProductos = $_GET['totalRows_RecordProductos'];

} else {

  $all_RecordProductos = mysql_query($query_RecordProductos);

  $totalRows_RecordProductos = mysql_num_rows($all_RecordProductos);

}

$totalPages_RecordProductos = ceil($totalRows_RecordProductos/$maxRows_RecordProductos)-1;



$queryString_RecordProductos = "";

if (!empty($_SERVER['QUERY_STRING'])) {

  $params = explode("&", $_SERVER['QUERY_STRING']);

  $newParams = array();

  foreach ($params as $param) {

    if (stristr($param, "pageNum_RecordProductos") == false && 

        stristr($param, "totalRows_RecordProductos") == false) {

      array_push($newParams, $param);

    }

  }

  if (count($newParams) != 0) {

    $queryString_RecordProductos = "&" . htmlentities(implode("&", $newParams));

  }

}

$queryString_RecordProductos = sprintf("&totalRows_RecordProductos=%d%s", $totalRows_RecordProductos, $queryString_RecordProductos);


//PRODUCTOS DESTACADOS
if (isset($_GET['totalRows_RecordProductos'])) {

  $totalRows_RecordProductos = $_GET['totalRows_RecordProductos'];

} else {

  $all_RecordProductos = mysql_query($query_RecordProductos_destacado);

  $totalRows_RecordProductos = mysql_num_rows($all_RecordProductos);

}

$totalPages_RecordProductos = ceil($totalRows_RecordProductos/$maxRows_RecordProductos)-1;



$queryString_RecordProductos = "";

if (!empty($_SERVER['QUERY_STRING'])) {

  $params = explode("&", $_SERVER['QUERY_STRING']);

  $newParams = array();

  foreach ($params as $param) {

    if (stristr($param, "pageNum_RecordProductos") == false && 

        stristr($param, "totalRows_RecordProductos") == false) {

      array_push($newParams, $param);

    }

  }

  if (count($newParams) != 0) {

    $queryString_RecordProductos = "&" . htmlentities(implode("&", $newParams));

  }

}

$queryString_RecordProductos = sprintf("&totalRows_RecordProductos=%d%s", $totalRows_RecordProductos, $queryString_RecordProductos);
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
<html>
  <head>
    <meta name="generator"
    content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39" />
    <title></title>
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

    <!--[if lte IE 6]><script src="js/ie6/warning.js"></script><script>window.onload=function(){e("js/ie6/")}</script><![endif]-->

  </head>
  <body>
    <section>
	<?php 
$activo = $_GET['activo'];
$animation = $_GET['animation'];
	 include("includes/menu.php"); ?>
<div class="gp"></div>	
    <aside class="animated <? if ($animation){echo" bounce";} ?>">
        <?php include("includes/catalogo_micuenta.php"); ?>
      </aside>
	        <div id="resumen2">
      <ul>

  <li class="cerrar_sesion"><a href="salir.php">  Salir X</a></li>
    
</ul>
</div>
      <article>
        <div class="inicio">
          <div class="slide_btn"></div>
		   <div class="welcometitle"><h2>Bienvenido a la edición 2014 del Catálogo Marketing Net</h2></div>
          <div class="inicio2" style="display:block;">
            <video controls poster="imagenes/imagen-video-nufarm.jpg">
      			<source src="video/nufarm-video-home.mp4" type="video/mp4">
      			<source src="video/nufarm-video-home.ogv" type="video/ogg">
      			<source src="video/nufarm-video-home.webm" type="video/webm">
            <object width="691" height="389"><param name="movie" value="//www.youtube.com/v/6DGp0n7H36Q?hl=es_MX&amp;version=3&amp;rel=0&amp;controls=0&amp;showinfo=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="//www.youtube.com/v/6DGp0n7H36Q?hl=es_MX&amp;version=3&amp;rel=0&amp;controls=0&amp;showinfo=0" type="application/x-shockwave-flash" width="691" height="389" allowscriptaccess="always" allowfullscreen="true"></embed></object>
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
      </article><?php include("includes/menu3.php"); ?>
	  
	  
	  
	  
	  
      <!--///////////////////////////////////////////////////////CANJES///////////////-->
      <article>
	  
	  
	  		<?php
		$host = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
if($host == 'www.productosnufarm.com.ar/index.php?activo=1' || $host == 'www.productosnufarm.com.ar/index.php'  ) 
{
    echo '<div class="productos" style="display:none";>';
}
else
{
    echo '<div class="productos">';
}
		?>  
        
				  
		
		
		
          <div class="eventos">
            <div class="side_info">
              <p>Los eventos brindan la posibilidad de crear un contacto directo con los clientes finales. La presencia en
              encuentros zonales así como la realización de reuniones con productores, constituye un fuerte apoyo unitario e
              institucional desde Nufarm a su red de distribución. Dentro de esta categoría se puede optar por:</p>
              <h2>EVENTOS INTERNOS</h2>
              <h2>EVENTOS EXTERNOS</h2>
              <div class="line4"></div>
              <img class="item8" src="imagenes/item10.png" alt=""> 
              <h6>
              La factura debe ser a nombre del distribuidor, enviarse a Nufarm con el fin de que pueda ser compensada en la
              cuenta del cliente.</h6>
            </div>
            <div class="box-content7">
		<div class="itemcontainer">	
			<div class="sombra2345"></div>
              <ul>
			   <a href="evento_externo.php?activo=1&eve=1">
                <li style="list-style: none; display: inline">
                
				  <div class="sombra"></div>
                </li>
                <li>
                  <div class="tipro ie9tipro">
                    <div class="titlef"></div>
                    <p class="text">CANJEAR</p>
                  </div>
                  <div class="box-imagen7">
                   
                      <img src="eventos/evento-externo.png" width="307" height="270" />
                    </a>
                  </div>
                </li>
				
				
                <li style="list-style: none; display: inline">
				        <span class="title_product">EVENTO EXTERNO</span>				
                  <div class="descripcion">
                    <P>Eventos zonales, Exposiciones y Jornadas</P>
                    <p>Sponsoreos, patrocinios, presencia de marca.</p>
                  </div>
                </li>
              </ul>
		</div>
		<div class="itemcontainer">	
			  <div class="sombra2345"></div>
              <ul>
                <li style="list-style: none; display: inline">
		<div class="handleBox">		
                  <div class="sombra"></div>
                </li>
                <li>
				  <a href="evento_interno.php?activo=1&eve=1">
                  <div class="tipro ie9tipro">
                    <div class="titlef"></div>
                    <p class="text">CANJEAR</p>
                  </div>
                  <div class="box-imagen7">
                      <img src="eventos/evento-interno.png" width="307" height="270" />
                    </a>
                  </div>
          
                </li>
                <li style="list-style: none; display: inline">
				<span class="title_product">EVENTO INTERNO</span>
                  <div class="descripcion">
                    <P>Charlas y Reuniones</P>
                    <p>Comunicación de novedades, beneficios, etc</p>
                  </div>
                </li>
              </ul>
            </div>
            <!--== Fin box-content ==-->
            <div class="line-transparent"></div>
            <div class="line"></div>
            <!--=== fin eventos =-->
          </div>
		</div>
          <!--== Fin id eventos==-->
		  
		  
		  
		  
          <div class="publicidad">
            <div class="side_info">
              <h2>CARTELES AGRONOMIAS Y LOCALES</h2>
              <p>Esto implica carteles para frente de locales, ploteos para vidrieras o carteles para interior. Nufarm se hará
              cargo del diseño de esta acción y, dependiendo del presupuesto que el cliente tenga asignado, la impresión y
              colocación de la cartelería.</p>
              <h2>PUBLICACIONES EN MEDIOS ZONALES</h2>
              <p>Las comunicaciones en medios zonales permiten crear una sólida imagen de marca entre el distribuidor y
              Nufarm.</p>
			  <p>
			  la propuesta consiste en que cada distribuidor opte por un producto a promocionar, y a partir de allí incorporar sus datos de contacto y logo.
              </p>
			  <div class="line4"></div>
        <img class="item9" src="imagenes/item10.png" alt=""> 
			  <h6>
			  El pago de impuestos municipales por exhibición de cartelería queda a cargo del distribuidor.
			  </h6>
			</div>
            <div class="box-content">
			
			
		<div class="itemcontainer ie9container">		
			<div class="sombra2345"></div>
              <ul>
			  <a href="cartel_frente.php?activo=1&pub=1">
                <li style="list-style: none; display: inline">
                  <div class="sombra"></div>
                </li>
                <li class="ie9_top">
                  <div class="tipro">
                    <div class="titlef"></div>
                    <p class="text">CANJEAR</p>
                  </div>
                  <div class="box-imagen3">
                      <img src="publicidades/cartel-frente-02.png" width="190" height="170" />
                    </a>
                  </div>
               
                </li>
                <li class="ie9" style="list-style: none; display: inline">
				<span class="title_product ie9title">CARTEL FRENTE</span>
                  <div class="descripcion">
                    <p>Carteles agronomías y locales</p>
                    <p>Promoción producto</p>
                  </div>
                </li>
              </ul>
		</div>
		<div class="itemcontainer ie9container">		  
			  <div class="sombra2345"></div>
              <ul>
			  <a href="ploteo_vidriera.php?activo=1&pub=1">
                <li style="list-style: none; display: inline">
                  <div class="sombra"></div>
                </li>
                <li class="ie9_top">
                  <div class="tipro">
				 <div class="titlef"></div>
                    <p class="text">CANJEAR</p>
                  </div>
                  <div class="box-imagen3b">
                      <img src="publicidades/ploteo.png" width="326" height="236" />
                    </a>
                  </div>

                </li>
                <li class="ie9" style="list-style: none; display: inline">
				<span class="title_product ie9title">PLOTEO VIDRIERA</span>
                  <div class="descripcion">
                    <p>Carteles agronomías y locales</p>
                    <p>Promoción producto</p>
                  </div>
                </li>
              </ul>
		</div>
		<div class="itemcontainer ie9container">		  
			 <div class="sombra2345"></div>
              <ul>
			   <a href="cartel_interior.php?activo=1&pub=1">
                <li style="list-style: none; display: inline">
                  <div class="sombra"></div>
                </li>
                <li class="ie9_top">
                  <div class="tipro">
								 <div class="titlef"></div>
                    <p class="text">CANJEAR</p>
                  </div>
                  <div class="box-imagen3b">
                   
                      <img src="publicidades/cartel-interior.png" width="307" height="270" />
                    </a>
                  </div>
                </li>
                <li  class="ie9" style="list-style: none; display: inline">
				<span class="title_product ie9title">CARTEL INTERIOR</span>
                  <div class="descripcion">
                    <p>Carteles agronomías y locales</p>
                    <p>Promoción producto</p>
                  </div>
                </li>
              </ul>
		</div>
		<div class="itemcontainer ie9container">		  
			  <div class="sombra2345"></div>
              <ul>
			  <a href="aviso_grafico.php?activo=1&pub=1">
                <li style="list-style: none; display: inline">
                  <div class="sombra"></div>
                </li>
                <li class="ie9_top">
                  <div class="tipro">
				  				 <div class="titlef"></div>
                    <p class="text">CANJEAR</p>
                  </div>
                  <div class="box-imagen3">
                    
                      <img src="publicidades/aviso-grafico.png" width="191" height="269" />
                    </a>
                  </div>
                </li>
                <li class="ie9" style="list-style: none; display: inline">
				<span class="title_product ie9title">AVISO GRAFICO</span>
                  <div class="descripcion">
                    <p>Institucional o Producto</p>
                    <p>Página completa, Pie de página, Lateral</p>
                  </div>
                </li>
              </ul>
		</div>
		<div class="itemcontainer ie9container">		  
			  <div class="sombra2345"></div>
              <ul>
			   <a href="aviso_radial.php?activo=1&pub=1">
                <li style="list-style: none; display: inline">
                  <div class="sombra"></div>
                </li>
                <li class="ie9_top">
                  <div class="tipro">
				 <div class="titlef"></div>
                    <p class="text">CANJEAR</p>
                  </div>
                  <div class="box-imagen3">
                   
                      <img src="imagenes/altavoz-10.png" width="50%" height="auto" />
                    </a>
                  </div>
                </li>
                <li class="ie9" style="list-style: none; display: inline">
				<span class="title_product ie9title">AVISO RADIAL</span>
                  <div class="descripcion">
                    <p>Institucional o Producto</p>
                    <p>Duración, 19"</p>
                  </div>
                </li>
              </ul>
            </div>
		</div>
			
            <!--== Fin box-content ==-->
            <div class="line"></div>
            <!--===== fin publicidades ======-->
          </div>
          <!--== Fin id publicidad ==-->

		  
		  
	
		  
		<div class="productosb">
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
            <div class="box-content">
	<!--//////////////////PRODUCTO DESTACADO 1-->		
            <div class="cont_destacado">
	<?php 
	$proddesc=$row_RecordProductos_destacado['destacado'];
	if($proddesc==1){ ?>
		
		<div class="sombra2345"></div>
				  <ul class="destacado1">
					<li>
					
					  <div class="tipro">
						<div class="titlef"></div>
						<p>$<?php echo $row_RecordProductos_destacado['dblPrecio']; ?></p>
						<p class="smallsub">canjear</p>
					  </div>
					  <div class="box-imagen_destacado1">
						<a href="ver_producto.php?recordID=<?php echo $row_RecordProductos_destacado['idProducto']; ?>&activo=1">
						  <?php if($row_RecordProductos_destacado['strImagen'])
								  {
								  echo '<img src="images_productos/'.$row_RecordProductos_destacado['strImagen'].'" alt="" />';
								  }
								  ?>
						</a>
					  </div>

					</li>
					<li style="list-style: none; display: inline">
					  <div class="descripcion">
						<span class="title_product">
						  <?php echo $row_RecordProductos_destacado['strNombre']; ?>
						</span>
						<br />
						<span>Stock <?php //STOCK
										include("includes/class.categorias.php");

										$cat = new categorias();
										$cat->select($row_RecordProductos_destacado['intCategoria']);
										$requiere_talles = $cat->gettalles();

										if($requiere_talles){

										//traigo total de todos los talles para ese id de producto
										include_once("includes/class.talles_productos.php");
										$tall = new talles_productos();
										$row_RecordProductos_destacado['idProducto'];
										$cantidad_gral = $tall->cantidad_by_producto($row_RecordProductos_destacado['idProducto']);
										echo $cantidad_gral;
										}else{
												echo $row_RecordProductos_destacado['intStock']; 
										}

										?> U</span>
						<p>
						  <?php echo $row_RecordProductos_destacado['strDetalle']; ?>
						</p>
					  </div>
					</li>
				  </ul>
				

					<?php } ?>  

	<!--//////////////////PRODUCTO DESTACADO 2-->		

	<?php 
	$proddesc=$row_RecordProductos_destacado2['destacado'];
	if($proddesc==2){ ?>
<div class="unitcont">		
		<div class="sombra2345"></div>
				  <ul class="destacado2">
					<li>
					 <a href="ver_producto.php?recordID=<?php echo $row_RecordProductos_destacado2['idProducto']; ?>&activo=1">
					  <div class="tipro">
						<div class="titlef"></div>
						<p>$<?php echo $row_RecordProductos_destacado2['dblPrecio']; ?></p>
						<p class="smallsub">canjear</p>
					  </div>
					  <div class="box-imagen3">
						  <?php if($row_RecordProductos_destacado2['strImagen'])
								  {
								  echo '<img src="images_productos/'.$row_RecordProductos_destacado2['strImagen'].'" alt="" />';
								  }
								  ?>
						</a>
					  </div>

					</li>
					<li style="list-style: none; display: inline">
					  <div class="descripcion">
						<span class="title_product">
						  <?php echo $row_RecordProductos_destacado2['strNombre']; ?>
						</span>
						<br />
						<span>Stock <?php //STOCK
										include_once("includes/class.categorias.php");

										$cat = new categorias();
										$cat->select($row_RecordProductos_destacado2['intCategoria']);
										$requiere_talles = $cat->gettalles();

										if($requiere_talles){

										//traigo total de todos los talles para ese id de producto
										include_once("includes/class.talles_productos.php");
										$tall = new talles_productos();
										$row_RecordProductos_destacado2['idProducto'];
										$cantidad_gral = $tall->cantidad_by_producto($row_RecordProductos_destacado2['idProducto']);
										echo $cantidad_gral;
										}else{
												echo $row_RecordProductos_destacado2['intStock']; 
										}

										?> U</span>
						<p>
						  <?php echo $row_RecordProductos_destacado2['strDetalle']; ?>
						</p>
					  </div>
					</li>
				  </ul>
	</div>			  
					<?php } ?>  
					
						<!--//////////////////PRODUCTO DESTACADO 3-->		

	<?php 
	$proddesc3=$row_RecordProductos_destacado3['destacado'];
	if($proddesc3==3){ ?>
<div class="unitcont">	
		<div class="sombra2345"></div>
				  <ul class="destacado3">
				  	<li>
					<a href="ver_producto.php?recordID=<?php echo $row_RecordProductos_destacado3['idProducto']; ?>&activo=1">
					  <div class="tipro">
						<div class="titlef"></div>
						<p>$<?php echo $row_RecordProductos_destacado3['dblPrecio']; ?></p>
						<p class="smallsub">canjear</p>
					  </div>
					  <div class="box-imagen3">
						  <?php if($row_RecordProductos_destacado3['strImagen'])
								  {
								  echo '<img src="images_productos/'.$row_RecordProductos_destacado3['strImagen'].'" alt="" />';
								  }
								  ?>
						</a>
					  </div>

					</li>
					<li style="list-style: none; display: inline">
					  <div class="descripcion">
						<span class="title_product">
						  <?php echo $row_RecordProductos_destacado3['strNombre']; ?>
						</span>
						<br />
						<span>Stock <?php //STOCK
										include_once("includes/class.categorias.php");

										$cat = new categorias();
										$cat->select($row_RecordProductos_destacado3['intCategoria']);
										$requiere_talles = $cat->gettalles();

										if($requiere_talles){

										//traigo total de todos los talles para ese id de producto
										include_once("includes/class.talles_productos.php");
										$tall = new talles_productos();
										$row_RecordProductos_destacado3['idProducto'];
										$cantidad_gral = $tall->cantidad_by_producto($row_RecordProductos_destacado3['idProducto']);
										echo $cantidad_gral;
										}else{
												echo $row_RecordProductos_destacado3['intStock']; 
										}

										?> U</span>
						<p>
						  <?php echo $row_RecordProductos_destacado3['strDetalle']; ?>
						</p>
					  </div>
					</li>
				  </ul>
				  </div>	
					<?php } ?>  
		</div>			
<!--//////////////////LISTADO DE PRODUCTOS-->		
			 <?php do { ?>
		<div class="unitcont">		 
			  <div class="sombra2345"></div>
              <ul>
			  <a href="ver_producto.php?prod=1&recordID=<?php echo $row_RecordProductos['idProducto']; ?>&activo=1">
                <li>
                  <div class="tipro">
                    <div class="titlef"></div>
                    <p>$<?php echo $row_RecordProductos['dblPrecio']; ?></p>
					<p class="smallsub">canjear</p>
                  </div>
                  <div class="box-imagen3">
                      <?php if($row_RecordProductos['strImagen'])
                              {
                              echo '<img src="images_productos/'.$row_RecordProductos['strImagen'].'" alt="" width="156" height="158"/>';
                              }else
							  {
							   echo '<img src="images_productos/default.png" alt="" width="156" height="158"/>';
							  }
                              ?>
                    </a>
                  </div>

                </li>
                <li style="list-style: none; display: inline">
                  <div class="descripcion">
                    <span class="title_product">
                      <?php echo $row_RecordProductos['strNombre']; ?>
                    </span>
                    <br />
                    <span>Stock <?php //STOCK
                                    include_once("includes/class.categorias.php");

                                    $cat = new categorias();
                                    $cat->select($row_RecordProductos['intCategoria']);
                                    $requiere_talles = $cat->gettalles();

                                    if($requiere_talles){

                                    //traigo total de todos los talles para ese id de producto
                                    include_once("includes/class.talles_productos.php");
                                    $tall = new talles_productos();
                                    $row_RecordProductos['idProducto'];
                                    $cantidad_gral = $tall->cantidad_by_producto($row_RecordProductos['idProducto']);
                                    echo $cantidad_gral;
                                    }else{
                                            echo $row_RecordProductos['intStock']; 
                                    }

                                    ?> U</span>
                    <p>
                      <?php echo substr($row_RecordProductos['strDetalle'], 0, 80); echo '...';?>
                    </p>
                  </div>
                </li>
              </ul>
			 </div> 
			  
			  <?php } while ($row_RecordProductos = mysql_fetch_assoc($RecordProductos)); ?>
            </div>
            <!--== Fin box-content ==-->
          </div>
          <!--== Fin id publicidad ==-->
		  <table border="0">

                              <tr>

                                <td><?php if ($pageNum_RecordProductos > 0) { // Show if not first page ?>

                                    <a href="<?php printf("%s?pageNum_RecordProductos=%d%s", $currentPage, 0, $queryString_RecordProductos); ?>"><img src="First.gif"></a>

                                    <?php } // Show if not first page ?></td>

                                <td><?php if ($pageNum_RecordProductos > 0) { // Show if not first page ?>

                                    <a href="<?php printf("%s?pageNum_RecordProductos=%d%s", $currentPage, max(0, $pageNum_RecordProductos - 1), $queryString_RecordProductos); ?>"><img src="Previous.gif"></a>

                                    <?php } // Show if not first page ?></td>

                                <td><?php if ($pageNum_RecordProductos < $totalPages_RecordProductos) { // Show if not last page ?>

                                    <a href="<?php printf("%s?pageNum_RecordProductos=%d%s", $currentPage, min($totalPages_RecordProductos, $pageNum_RecordProductos + 1), $queryString_RecordProductos); ?>"><img src="Next.gif"></a>

                                    <?php } // Show if not last page ?></td>

                                <td><?php if ($pageNum_RecordProductos < $totalPages_RecordProductos) { // Show if not last page ?>

                                    <a href="<?php printf("%s?pageNum_RecordProductos=%d%s", $currentPage, $totalPages_RecordProductos, $queryString_RecordProductos); ?>"><img src="Last.gif"></a>

                                    <?php } // Show if not last page ?></td>

                              </tr>

                            </table>		
				
			
        </div>
<?php include("includes/footer.php"); ?>
        <!--- Fin Productos =-->
		
      </article>
	  
    </section>
  </body>
</html>
