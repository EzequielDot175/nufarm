<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  //$theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

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


//********************************************************
//********************************************************
//********************************************************

function ObtenerNombreUsuario ($identificador)
{
global $database_conexion, $conexion;
mysql_select_db($database_conexion, $conexion);
$query_ConsultaFuncion = sprintf("SELECT usuarios.strNombre FROM usuarios WHERE usuarios.idUsuario = %s",$identificador);
$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexion) or die(mysql_error());
$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
 echo $row_ConsultaFuncion['strNombre']; 
mysql_free_result($ConsultaFuncion);
}



//********************************************************
//********************************************************
//********************************************************

function ObtenerApellidoUsuario ($identificador)
{
global $database_conexion, $conexion;
mysql_select_db($database_conexion, $conexion);
$query_ConsultaFuncion = sprintf("SELECT usuarios.strNombre FROM usuarios WHERE usuarios.idUsuario = %s",$identificador);
$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexion) or die(mysql_error());
$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
 echo $row_ConsultaFuncion['strNombre']; 
mysql_free_result($ConsultaFuncion);
}

//********************************************************
//********************************************************
//********************************************************

function ObtenerNombreProducto ($identificador)
{
global $database_conexion, $conexion;
mysql_select_db($database_conexion, $conexion);
$query_ConsultaFuncion = sprintf("SELECT strNombre FROM productos WHERE idProducto = %s",$identificador);
$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexion) or die(mysql_error());
$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
 echo $row_ConsultaFuncion['strNombre']; 
mysql_free_result($ConsultaFuncion);
}

//********************************************************
//********************************************************
//********************************************************

function ObtenerPrecioProducto ($identificador)
{
global $database_conexion, $conexion;
	mysql_select_db($database_conexion, $conexion);
	$query_ConsultaFuncion = sprintf("SELECT dblPrecio FROM productos WHERE idProducto = %s", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexion) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['dblPrecio']; 
	mysql_free_result($ConsultaFuncion);
}

//********************************************************
//********************************************************
//********************************************************

function ObtenerIVA()
{

	global $database_conexion, $conexion;
	mysql_select_db($database_conexion, $conexion);
	$query_ConsultaFuncion = "SELECT intIVA FROM variables WHERE idContador = 1";
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexion) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['intIVA']; 
	mysql_free_result($ConsultaFuncion);
}



//********************************************************
//********************************************************
//********************************************************

function ConfirmacionPago($tipopago)
{

	global $database_conexion, $conexion;
	mysql_select_db($database_conexion, $conexion);
	$query_ConsultaFuncion = "SELECT intIVA FROM variables WHERE idContador = 1";
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexion) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['intIVA']; 
	mysql_free_result($ConsultaFuncion);
}
?>