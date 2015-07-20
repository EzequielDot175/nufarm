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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE categorias SET strDescripcion=%s WHERE idCategorias=%s",
                       GetSQLValueString($_POST['strDescripcion'], "text"),
                       GetSQLValueString($_POST['idCategorias'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());

  $updateGoTo = "categorias_lista.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$varCategoria_Recordset1 = "0";
if (isset($_GET["recordID"])) {
  $varCategoria_Recordset1 = $_GET["recordID"];
}
mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = sprintf("SELECT * FROM categorias WHERE categorias.idCategorias = %s", GetSQLValueString($varCategoria_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
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
 <h2>Editar Categoria</h2>
   <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
     <table width="404" align="center">
       <tr valign="baseline">
         <td nowrap align="right">Nombre de Categoria:</td>
         <td><input type="text" name="strDescripcion" value="<?php echo htmlentities($row_Recordset1['strDescripcion'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
       </tr>
       <tr valign="baseline">
         <td nowrap align="right">&nbsp;</td>
         <td><input type="submit" value="Actualizar"></td>
       </tr>
     </table>
     <input type="hidden" name="MM_update" value="form1">
     <input type="hidden" name="idCategorias" value="<?php echo $row_Recordset1['idCategorias']; ?>">
   </form>
   <p>&nbsp;</p>
 
  </article>
</section>
</div>
<footer></footer>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
