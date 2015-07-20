<?php require_once('Connections/conexion.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO propuestas (strnombrecompleto, strlugar, strcantidadinvitados, fthfechaestimada, strcaracteristicas) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['strnombrecompleto'], "text"),
                       GetSQLValueString($_POST['strlugar'], "text"),
                       GetSQLValueString($_POST['strcantidadinvitados'], "text"),
                       GetSQLValueString($_POST['fthfechaestimada'], "date"),
                       GetSQLValueString($_POST['strcaracteristicas'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

  $insertGoTo = "envio_propuesta.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<?php include("includes/header.php"); ?>
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

  <div class="productos">
               <div class="side_info">
              <h2>CARTELES AGRONOMIAS Y LOCALES</h2>
              <p>Esto implica carteles para frente de locales, ploteos para vidrieras o carteles para interior. Nufarm se hará
              cargo del diseño de esta acción y, dependiendo del presupuesto que el cliente tenga asignado, la impresión y
              colocación de la cartelería.</p>
              <h2>PUBLICACIONES EN MEDIOS ZONALES</h2>
              <p>Las comunicaciones en medios zonales permiten crear una sólida imagen de marca entre el distribuidor y
              Nufarm.</p><br><br>
			  <p>
			  la propuesta consiste en que cada distribuidor opte por un producto a promocionar, y a partir de allí incorporar sus datos de contacto y logo.
              </p>
			  <div class="line"></div><br>
			  <p>
			  El pago de impuestos municipales por exhibición de cartelería queda a cargo del distribuidor.
			  </p>
			</div>
         <div class="box-content2">
         <ul>
             <li>
             

    <div class="box-imagen belen">
                      <img src="imagenes/altavoz-10.png" width="50%" height="auto" />
    </div>
    <h3>Aviso Radial</h3>
    <p>Los avisos poseen una duración de 19 segundos, a los cuáles hay que incorporar la locución con información de contacto del comercio (Nombre del distribuidor, dirección y teléfono de contacto).
</p>

     </li>
         </ul>
            </div><!---- Fin box-content ---->
                       

                            
                            <div id="info-right"> 

                                     
<div id="eventex">
<?php  
if($_SESSION['MM_IdUsuario']){
 ?>
 
 
 <form id="forevent" method="post" name="form1" action="envio_correo.php">

				         <input type="hidden" name="envio_desde" value="aviso_radial">
				         <div class="formtit">Tipo de aviso (Institucional o Producto)</div>
				       <input id="dato" type="text" name="strnombrecompleto" 
				value="<?php if($_SESSION['mensaje']){echo $_SESSION['mensaje'];} ?>" size="32">

				        <div class="formtit">Producto que desea promocionar</div>
				       <input id="dato" type="text" name="strlugar" 
				value="<?php if($_SESSION['lugar']){echo $_SESSION['lugar'];} ?>" size="32">

				       <div class="formtit">Medio</div>                   
				      <input id="dato" type="text" name="strcantidadinvitados" 
				value="<?php if($_SESSION['cantidad']){echo $_SESSION['cantidad'];} ?>" size="32">

				     <div class="formtit">Fecha estimada de emisión</div>
				     <input id="dato" type="text" name="fthfechaestimada" 
				value="<?php if($_SESSION['fecha']){echo $_SESSION['fecha'];} ?>" size="32">

				     <div id="areadetexto">
				     <div class="formtit">Características Generales</div>
				     <textarea id="textocampo" name="strcaracteristicas" cols="" rows="">
				     	<?php if($_SESSION['caracteristicas']){echo $_SESSION['caracteristicas'];} ?>
				     </textarea>
				                         </div>
				      <a class="btn-micuenta6" href="index.php?activo=1&pub=1"><span>Cancelar</span></a>
				    <input id="btn-canje8" type="submit" value="Enviar" >

				   <input type="hidden" name="MM_insert" value="form1">
				 </form>
				 
 <?php
 }
 ?>
 
 
 </div>             
 	<?php
	if($_SESSION['mensaje']){
		echo '<h2>'.$_SESSION['mensaje'].'</h2>';
		unset($_SESSION['mensaje']);
	}
	?>
      
          </div>
          
 
</div><!--- Fin Productos --->
  </article>
 <?php include("includes/footer.php"); ?> 
</section>
</body>
</html>