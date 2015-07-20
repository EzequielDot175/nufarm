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
                       GetSQLValueString($_POST['strnombrecompleto'], "int"),
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
 
 <div class="productos">
         <div class="box-content2">
         <ul>
             <li>
             
  <div class="tipro2"><p>Medios Zonales<p></div>
       <div class="box-imagen">
       <img src="publicidades/cartel-interior.png" width="307" height="270">
       </div>

     </li>
         </ul>
            </div><!---- Fin box-content ---->
                       
                       <div class="box-content4">
         <ul>
             <li>
              <div class="box-imagen2">
              <img src="publicidades/cartel-interior.png" width="307" height="270">
              
              </div>

     </li>
         </ul>
          
                  <ul>
             <li>
             
             <div class="box-imagen2">
             <img src="publicidades/cartel-interior.png" width="307" height="270">
             </div>
     </li>
         </ul>
                     </div><!---- Fin box-content ---->
                            
                            <div id="info-right"> 
                            <div class="purple-bar">
                              <h4>Desde $0 + IVA</h4>
                              </div>
                                     <h3>Presentaciòn del evento</h3>
                                    <p>Expo texto de ejemplo, Expo texto de ejemplo, Expo texto de ejemplo, Expo texto de ejemplo, Expo texto de ejemplo, Expo texto de ejemplo, Expo texto de ejemplo, Expo texto de ejemplo, Expo texto de ejemplo, Expo texto de ejemplo, Expo texto de ejemplo,</p>
              </div>
      
          </div>
          <div id="eventex">
 <form id="forevent" method="post" name="form1" action="<?php echo $editFormAction; ?>">
         <div class="forcol">
         
         <div class="formtit">Nombre del evento</div>
       <input id="dato" type="text" name="strnombrecompleto" value="" size="32">
              
        <div class="formtit">Lugar</div>
       <input id="dato" type="text" name="strlugar" value="" size="32">
                                </div>
            <div class="forcol"> 
       <div class="formtit">Cantidad estimada de invitados</div>                   
      <input id="dato" type="text" name="strcantidadinvitados" value="" size="32">
     
     <div class="formtit">Fecha estimada</div>
     <input id="dato" type="text" name="fthfechaestimada" value="" size="32">
                  </div> 
     <div id="areadetexto">
     <div class="formtit">Caracterìsticas Generales</div>
     <textarea id="textocampo" name="strcaracteristicas" cols="" rows=""></textarea>
                         </div>
     <a class="cancelar" href="eventos.php"><span>Cancelar</span></a>
    <input id="enviarpro" type="submit" value="Enviar"> 
    
   <input type="hidden" name="MM_insert" value="form1">
 </form>
 </div>
 
</div><!--- Fin Productos --->
  </article>
</section>
</div></div></div></div>
<?php include("includes/footer.php"); ?>
</body>
</html>