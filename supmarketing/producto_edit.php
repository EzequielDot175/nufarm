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
  $updateSQL = sprintf("UPDATE productos SET strNombre=%s, intCategoria=%s, dblPrecio=%s, intStock=%s, strImagen=%s WHERE idProducto=%s",
                       GetSQLValueString($_POST['strNombre'], "text"),
                       GetSQLValueString($_POST['intCategoria'], "int"),
                       GetSQLValueString($_POST['dblPrecio'], "double"),
                       GetSQLValueString($_POST['intStock'], "int"),
                       GetSQLValueString($_POST['strImagen'], "text"),
                       GetSQLValueString($_POST['idProducto'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());

  $updateGoTo = "productos_lista.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$varProducto_DatosProductos2 = "0";
if (isset($_GET["recordID"])) {
  $varProducto_DatosProductos2 = $_GET["recordID"];
}
mysql_select_db($database_conexion, $conexion);
$query_DatosProductos2 = sprintf("SELECT * FROM productos WHERE productos.idProducto = %s", GetSQLValueString($varProducto_DatosProductos2, "int"));
$DatosProductos2 = mysql_query($query_DatosProductos2, $conexion) or die(mysql_error());
$row_DatosProductos2 = mysql_fetch_assoc($DatosProductos2);
$totalRows_DatosProductos2 = mysql_num_rows($DatosProductos2);

mysql_select_db($database_conexion, $conexion);
$query_ConsultaCategoria2 = "SELECT * FROM categorias ORDER BY categorias.strDescripcion ASC";
$ConsultaCategoria2 = mysql_query($query_ConsultaCategoria2, $conexion) or die(mysql_error());
$row_ConsultaCategoria2 = mysql_fetch_assoc($ConsultaCategoria2);
$totalRows_ConsultaCategoria2 = mysql_num_rows($ConsultaCategoria2);
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
<script>
  function subirimagen () {
  self.name = 'opener';
  remote = open ('gestionimagen.php', 'remote',
  'width=400,heght=150,location=no,scrollbars=yes,menubars=no,resizable=yes,fullscreen=no, status=yes');
  remote.focus();
  }
   </script>
 <h2>Editar  Producto</h2>
 <p>&nbsp;</p>
 <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
   <table width="406" align="center">
     <tr valign="baseline">
       <td nowrap align="right">Nombre:</td>
       <td><input type="text" name="strNombre" value="<?php echo htmlentities($row_DatosProductos2['strNombre'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
     </tr>
     <tr valign="baseline">
       <td nowrap align="right">Categoria:</td>
       <td><select name="intCategoria">
         <?php 
do {  
?>
         <option value="<?php echo $row_ConsultaCategoria2['idCategorias']?>" <?php if (!(strcmp($row_ConsultaCategoria2['idCategorias'], htmlentities($row_DatosProductos2['intCategoria'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $row_ConsultaCategoria2['strDescripcion']?></option>
         <?php
} while ($row_ConsultaCategoria2 = mysql_fetch_assoc($ConsultaCategoria2));
?>
       </select></td>
     <tr>
     <tr valign="baseline">
       <td nowrap align="right">Precio:</td>
       <td><input type="text" name="dblPrecio" value="<?php echo htmlentities($row_DatosProductos2['dblPrecio'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
     </tr>
     <tr valign="baseline">
       <td nowrap align="right">Stock:</td>
       <td><select name="intStock">
         <option value="0" <?php if (!(strcmp(0, htmlentities($row_DatosProductos2['intStock'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Selecionar</option>
         <option value="1" <?php if (!(strcmp(1, htmlentities($row_DatosProductos2['intStock'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>1 u</option>
         <option value="2" <?php if (!(strcmp(2, htmlentities($row_DatosProductos2['intStock'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>2 u</option>
         <option value="3" <?php if (!(strcmp(3, htmlentities($row_DatosProductos2['intStock'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>3 u</option>
         <option value="4" <?php if (!(strcmp(4, htmlentities($row_DatosProductos2['intStock'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>4 u</option>
         <option value="5" <?php if (!(strcmp(5, htmlentities($row_DatosProductos2['intStock'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>5 u</option>
         <option value="6" <?php if (!(strcmp(6, htmlentities($row_DatosProductos2['intStock'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>6 u</option>
         <option value="7" <?php if (!(strcmp(7, htmlentities($row_DatosProductos2['intStock'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>7 u</option>
         <option value="8" <?php if (!(strcmp(8, htmlentities($row_DatosProductos2['intStock'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>8 u</option>
         <option value="9" <?php if (!(strcmp(9, htmlentities($row_DatosProductos2['intStock'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>9 u</option>
         <option value="10" <?php if (!(strcmp(10, htmlentities($row_DatosProductos2['intStock'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>10 u</option>
       </select></td>
     </tr>
     <tr valign="baseline">
       <td nowrap align="right">Imagen:</td>
       <td><input name="strImagen" type="text" value="<?php echo htmlentities($row_DatosProductos2['strImagen'], ENT_COMPAT, 'utf-8'); ?>" size="32" readonly>
         <input type="button" name="button" id="button" value="Subir Imagen" onclick="javascript:subirimagen();"/></td>
     </tr>
     <tr valign="baseline">
       <td nowrap align="right">&nbsp;</td>
       <td><input type="submit" value="Editar Productos"></td>
     </tr>
   </table>
   <input type="hidden" name="MM_update" value="form1">
   <input type="hidden" name="idProducto" value="<?php echo $row_DatosProductos2['idProducto']; ?>">
 </form>
 <p>&nbsp;</p>
</article>
</section>
</div>
<footer></footer>
</body>
</html>
<?php
mysql_free_result($DatosProductos2);

mysql_free_result($ConsultaCategoria2);
?>
