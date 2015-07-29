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
              <p>CRÉDITO DISPONIBLE HASTA 2014/07/10</p>
              </div>
      </div>
      <div id="resumen">
      <ul>
  <li><a href="carrito_lista.php">Ver Mis Movimientos</a></li>
  <li><a href="mis_consultas.php">Mis Consultas</a></li>
  <li><a href="modificar_perfil.php">Modificar Mis Datos</a></li>
  <li><a href="salir.php">Cerrar sesiòn</a></li>
      </ul>
<?php
  }
  else
  {?><a href="registrar.php">Registrate</a><br /> 
<a href="login.php">Iniciar Sesion</a> <br /><br />
<?php }?></div>
 
 <div id="categorias">
 <div class="barra">
   <span>Canjes</span>
        </div>
<ul>
     <li><a class="icon-bolsos" href="categorias_ver.php?cat=6"><span>Bolsos y Mochilas</span></a>
     <li><a class="icon-herr" href="categorias_ver.php?cat=2"><span>Herramientas</span></a>
     <li><a class="icon-indu" href="categorias_ver.php?cat=4"><span>Indumentaria</span></a>
     <li><a class="icon-setasado6" href="categorias_ver.php?cat=3"><span>Set de Asado 6 Tabla</span></a>
     <li><a class="icon-setasadoestribo" href="categorias_ver.php?cat=1"><span>Set de Asado Estribo</span></a>
     <li><a class="icon-setmate" href="categorias_ver.php?cat=5"><span>Set de Mate</span></a>
     <li><a class="icon-setvino" href="categorias_ver.php?cat=7"><span>Set de Vino</span></a>
      <li><a class="icon-markevent" href="canjes.php"><span>Marketing y Eventos</span></a></li>
  </ul>
</div>
 
  <div id="faq">
  <div class="barra"><span>Info & Faq</div>
    <ul>
     <li><a class="icon-bolsos" href="categorias_ver.php?cat=6"><span>Bolsos y Mochilas</span></a>
     <li><a class="icon-herr" href="categorias_ver.php?cat=2"><span>Herramientas</span></a>
     <li><a class="icon-indu" href="categorias_ver.php?cat=4"><span>Indumentaria</span></a>
     <li><a class="icon-setasado6" href="categorias_ver.php?cat=3"><span>Set de Asado 6 Tabla</span></a>
     <li><a class="icon-setasadoestribo" href="categorias_ver.php?cat=1"><span>Set de Asado Estribo</span></a>
     <li><a class="icon-setmate" href="categorias_ver.php?cat=5"><span>Set de Mate</span></a>
     <li><a class="icon-setvino" href="categorias_ver.php?cat=7"><span>Set de Vino</span></a>
      <li><a class="icon-markevent" href="#"><span>Marketing y Eventos</span></a></li>
  </ul>
            </div>
<?php
mysql_free_result($Recordset1);

mysql_free_result($DatoUsuarioCredito);
?> 












