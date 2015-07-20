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

$varUsuario_ConsultaFuncion = "0";
if (isset(xxxx)) {
  $varUsuario_ConsultaFuncion = xxxx;
}
mysql_select_db($database_conexion, $conexion);
$query_ConsultaFuncion = sprintf("SELECT usuarios.strNombre FROM usuarios WHERE usuarios.idUsuario = %s", GetSQLValueString($varUsuario_ConsultaFuncion, "int"));
$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexion) or die(mysql_error());
$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
<?php echo $row_ConsultaFuncion['strNombre']; ?>
</body>
</html>
<?php
mysql_free_result($ConsultaFuncion);
?>
