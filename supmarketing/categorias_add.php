<?php require_once('../Connections/conexion.php'); ?>
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
  $insertSQL = sprintf("INSERT INTO categorias (strDescripcion) VALUES (%s)",
                       GetSQLValueString($_POST['strDescripcion'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

  $insertGoTo = "categorias_lista.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Administracion</title>
<link href="../css/estilos.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="top"></div>
<div id="contenedor">
<header>
<div id="logo">
  <img src="../imagenes/logo.png" width="107" height="96" alt="Nufarm"> 
</div>
</header>
<nav></nav>
<section>
<aside>
<?php include('includes/lista_detalle.php'); ?>
</aside>
<article>
 <h2>Añadir Categoria</h2>
 <p>&nbsp;</p>
 <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
   <table width="437" align="center">
     <tr valign="baseline">
       <td width="136" align="right" nowrap>Nombre de Categoria:</td>
       <td width="213"><input type="text" name="strDescripcion" value="" size="32"></td>
     </tr>
     <tr valign="baseline">
       <td nowrap align="right">&nbsp;</td>
       <td><input type="submit" value="Agregar Categoria"></td>
     </tr>
   </table>
   <input type="hidden" name="MM_insert" value="form1">
 </form>
 <p>&nbsp;</p>
</article>
</section>
</div>
<footer></footer>
</body>
</html>