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
?><?php
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
//CARRO DE COMPRAS - FUNCIONALIDADES
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_DatosCarrito = 10;
$pageNum_DatosCarrito = 0;
if (isset($_GET['pageNum_DatosCarrito'])) {
  $pageNum_DatosCarrito = $_GET['pageNum_DatosCarrito'];
}
$startRow_DatosCarrito = $pageNum_DatosCarrito * $maxRows_DatosCarrito;

$varUsuario_DatosCarrito = "0";
if (isset($_SESSION["MM_IdUsuario"])) {
  $varUsuario_DatosCarrito = $_SESSION["MM_IdUsuario"];
}
mysql_select_db($database_conexion, $conexion);
$query_DatosCarrito = sprintf("SELECT * FROM carrito WHERE carrito.idUsuario = %s AND carrito.intTransaccion = 0", GetSQLValueString($varUsuario_DatosCarrito, "int"));
$query_limit_DatosCarrito = sprintf("%s LIMIT %d, %d", $query_DatosCarrito, $startRow_DatosCarrito, $maxRows_DatosCarrito);
$DatosCarrito = mysql_query($query_limit_DatosCarrito, $conexion) or die(mysql_error());
$row_DatosCarrito = mysql_fetch_assoc($DatosCarrito);

if (isset($_GET['totalRows_DatosCarrito'])) {
  $totalRows_DatosCarrito = $_GET['totalRows_DatosCarrito'];
} else {
  $all_DatosCarrito = mysql_query($query_DatosCarrito);
  $totalRows_DatosCarrito = mysql_num_rows($all_DatosCarrito);
}
$totalPages_DatosCarrito = ceil($totalRows_DatosCarrito/$maxRows_DatosCarrito)-1;

$queryString_DatosCarrito = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_DatosCarrito") == false && 
        stristr($param, "totalRows_DatosCarrito") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_DatosCarrito = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_DatosCarrito = sprintf("&totalRows_DatosCarrito=%d%s", $totalRows_DatosCarrito, $queryString_DatosCarrito);

// MI CUENTA FUNCIONALIDADES
$DatoUsuario_consulta = "0";
if (isset($_SESSION['MM_IdUsuario'])) {
  $DatoUsuario_consulta = $_SESSION['MM_IdUsuario'];
}
mysql_select_db($database_conexion, $conexion);
$query_consulta = sprintf("SELECT * FROM usuarios WHERE usuarios.idUsuario = %s", GetSQLValueString($DatoUsuario_consulta, "int"));
$consulta = mysql_query($query_consulta, $conexion) or die(mysql_error());
$row_consulta = mysql_fetch_assoc($consulta);
$totalRows_consulta = mysql_num_rows($consulta);

$varResultado_consulta2 = "0";
if (isset($_SESSION['MM_IdUsuario'])) {
  $varResultado_consulta2 = $_SESSION['MM_IdUsuario'];
}
mysql_select_db($database_conexion, $conexion);
$query_consulta2 = sprintf("SELECT * FROM compra WHERE compra.idUsuario = %s", GetSQLValueString($varResultado_consulta2, "int"));
$consulta2 = mysql_query($query_consulta2, $conexion) or die(mysql_error());
$row_consulta2 = mysql_fetch_assoc($consulta2);
$totalRows_consulta2 = mysql_num_rows($consulta2);

////FUNCIONALIDAD VER Y EDITAR MIS DATOS

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE usuarios SET strNombre=%s, strApellido=%s, strEmail=%s, strEmpresa=%s, strCargo=%s, strPassword=%s, direccion=%s, telefono=%s, cumpleanos=%s, ciudad=%s, cp=%s, provincia=%s WHERE idUsuario=%s",
                       GetSQLValueString($_POST['strNombre'], "text"),
                       GetSQLValueString($_POST['strApellido'], "text"),
                       GetSQLValueString($_POST['strEmail'], "text"),
                       GetSQLValueString($_POST['strEmpresa'], "text"),
                       GetSQLValueString($_POST['strCargo'], "text"),
                       GetSQLValueString($_POST['strPassword'], "text"),
                       GetSQLValueString($_POST['direccion'], "text"),							   
                       GetSQLValueString($_POST['telefono'], "text"),	
					   GetSQLValueString($_POST['fechanac'], "date"),
					   GetSQLValueString($_POST['ciudad'], "text"),
					   GetSQLValueString($_POST['cp'], "text"),
					   GetSQLValueString($_POST['provincia'], "text"),
                       GetSQLValueString($_POST['idUsuario'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());

  $updateGoTo = "usuario_modificacion_ok.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$varDatoUsuario_DatoUsuario = "0";
if (isset($_SESSION["MM_IdUsuario"])) {
  $varDatoUsuario_DatoUsuario = $_SESSION["MM_IdUsuario"];
}
mysql_select_db($database_conexion, $conexion);
$query_DatoUsuario = sprintf("SELECT * FROM usuarios WHERE usuarios.idUsuario = %s", GetSQLValueString($varDatoUsuario_DatoUsuario, "int"));
$DatoUsuario = mysql_query($query_DatoUsuario, $conexion) or die(mysql_error());
$row_DatoUsuario = mysql_fetch_assoc($DatoUsuario);
$totalRows_DatoUsuario = mysql_num_rows($DatoUsuario);



?>
<?php $activo = $_GET['activo']; include("includes/header.php"); ?>
<!DOCTYPE html>

<html>
<head>
  <meta name="generator" content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39">

  <title></title>
</head>

<body>
  <section>
    <?php include("includes/menu.php"); ?>
    
<aside>
<?php include("includes/catalogo2.php"); ?>
</aside>
	
	
	
	
	
 <div id="resumen_micuenta">
      <ul>

</ul>
</div>

    <article>
      <div class="mcuenta_bg">
	  <div class="leftcol contacto_info_cont">

		  <ul>

       <li class="contacto_title">CONTACTO DEL PROGRAMA</li>
      <div class="c_line"></div>          
      <li><span class="c_b">Soledad Gonzalez</span></li>
      <li><span class="c_m"></span><p><a href="mailto:mktnet@nufarm-maxx.com">mktnet@nufarm-maxx.com</a></p></li>
      <li><span class="c_p"></span>+54 11 47834929</li>

		  </ul>

		  <ul>

		  <li class="contacto_title">COORDINADOR DEL PROGRAMA</li>
      <div class="c_line"></div>  			  
		  <li><span class="c_b">Juan Ignacio Pardo</span></li>
		  <li><span class="c_m"></span><p><a href="mailto:mktnet@nufarm-maxx.com">mktnet@nufarm-maxx.com</a></p></li>
		  <!--<li><span class="c_p"></span>+000</li>-->
		  </ul>

		  <ul>

		  <li class="contacto_title">RESPONSABLE DEL PROGRAMA</li>
      <div class="c_line"></div>    
      <li><span class="c_b">Verónica Carabajal</span></li>
      <li><span class="c_m"></span><p><a href="mailto:mktnet@nufarm-maxx.com">veronica.carabajal@ar.nufarm.com</a></p></li>
      <li><span class="c_p"></span>+54 911 6569-4051</li> 
      <!--<li><span class="c_c"></span>+54 11 3220- 0023</li>-->

		  </ul>

     </div>
	</div> 
    </article>
<?php include("includes/footer.php"); ?>
  </section>

</body>
</html>
<?php
  mysql_free_result($consulta);
  mysql_free_result($consulta2);
?>
