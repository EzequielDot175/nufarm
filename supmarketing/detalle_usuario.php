<?php require_once('../Connections/conexion.php'); ?><?php
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

$colname_DetailRS1 = "-1";
if (isset($_GET['recordID'])) {
  $colname_DetailRS1 = $_GET['recordID'];
}
mysql_select_db($database_conexion, $conexion);
$query_DetailRS1 = sprintf("SELECT * FROM usuarios WHERE idUsuario = %s ORDER BY usuarios.idUsuario ASC", GetSQLValueString($colname_DetailRS1, "int"));
$DetailRS1 = mysql_query($query_DetailRS1, $conexion) or die(mysql_error());
$row_DetailRS1 = mysql_fetch_assoc($DetailRS1);
$totalRows_DetailRS1 = mysql_num_rows($DetailRS1);
?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>

		
<table border="0" align="center">
  
  <tr>
    <td>Id</td>
    <td><?php echo $row_DetailRS1['idUsuario']; ?> </td>
  </tr>
  <tr>
    <td>Nombre</td>
    <td><?php echo $row_DetailRS1['strNombre']; ?> </td>
  </tr>
  <tr>
    <td>Apellido</td>
    <td><?php echo $row_DetailRS1['strApellido']; ?> </td>
  </tr>
  <tr>
    <td>Email</td>
    <td><?php echo $row_DetailRS1['strEmail']; ?> </td>
  </tr>
  <tr>
    <td>Empresa</td>
    <td><?php echo $row_DetailRS1['strEmpresa']; ?> </td>
  </tr>
  <tr>
    <td>Credito</td>
    <td><?php echo $row_DetailRS1['dblCredito']; ?> </td>
  </tr>
  
  
</table>
</body>
</html><?php
mysql_free_result($DetailRS1);
?>