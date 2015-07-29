<?php require_once('Connections/conexion.php'); ?>
<?php
$usuario= $_SESSION['MM_IdUsuario'];
if(!$usuario)
{header("location:login.php");}
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

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM categorias ORDER BY categorias.strDescripcion ";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$varUsuarioCredito_DatoUsuarioCredito = "0";
if (isset($_SESSION['MM_IdUsuario'])) {
  $varUsuarioCredito_DatoUsuarioCredito = $_SESSION['MM_IdUsuario'];
}
mysql_select_db($database_conexion, $conexion);
$query_DatoUsuarioCredito = sprintf("SELECT * FROM usuarios WHERE usuarios.idUsuario =%s", GetSQLValueString($varUsuarioCredito_DatoUsuarioCredito, "int"));
$DatoUsuarioCredito = mysql_query($query_DatoUsuarioCredito, $conexion) or die(mysql_error());
$row_DatoUsuarioCredito = mysql_fetch_assoc($DatoUsuarioCredito);
$totalRows_DatoUsuarioCredito = mysql_num_rows($DatoUsuarioCredito);
?>

<div id="bienvenido">
<h3><?php 
if ((isset($_SESSION['MM_Username'])) &&($_SESSION['MM_Username'] != ""))
{
  echo  "Bienvenido<br />";
  echo ObtenerNombreUsuario ($_SESSION['MM_IdUsuario']);
  ?></h3>
  <div id="credito">
              <h2><?php echo $row_DatoUsuarioCredito['dblCredito']; ?></h2>

<p>PUNTOS DISPONIBLES HASTA <?php  ; 
              
  list($anio, $mes, $dia) = explode('-', $row_DatoUsuarioCredito['vigencia_credito']);
  $fecha = $dia.'/'.$mes.'/'.$anio;            
  echo $fecha; ?>
  

 
  </p>  
              </div>
      </div>
      <div id="resumen">
      <ul>
  <li class="cerrar_sesion"><a href="salir.php">Salir</a></li>
      
        
        
</ul>
<?php
  }
  else
  {?><a href="registrar.php">Registrate</a><br /> 
<a href="login.php">Iniciar Sesión</a> <br /><br />
<?php }?></div>
 
 
  <!--<div id="faq">
  <div class="barra"><span>Info & Faq</div>
    <ul>
        <li><a href="#">Ayuda</a></li>
        <li><a href="#">Preguntas frecuentes</a></li>
        <li><a href="#">Contacte a nuestro SAT</a></li>
        </ul>
            </div>-->
<?php
mysql_free_result($Recordset1);

mysql_free_result($DatoUsuarioCredito);
?> 












