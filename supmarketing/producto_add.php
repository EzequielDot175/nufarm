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
  $insertSQL = sprintf("INSERT INTO productos (strNombre, intCategoria, dblPrecio, strImagen, intStock) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['strNombre'], "text"),
                       GetSQLValueString($_POST['intCategoria'], "int"),
                       GetSQLValueString($_POST['dblPrecio'], "double"),
					   GetSQLValueString($_POST['strImagen'], "text"),
                       GetSQLValueString($_POST['intStock'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

  $insertGoTo = "productos_lista.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conexion, $conexion);
$query_ConsultaCategorias = "SELECT * FROM categorias ORDER BY categorias.strDescripcion ASC";
$ConsultaCategorias = mysql_query($query_ConsultaCategorias, $conexion) or die(mysql_error());
$row_ConsultaCategorias = mysql_fetch_assoc($ConsultaCategorias);
$totalRows_ConsultaCategorias = mysql_num_rows($ConsultaCategorias);
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
 <h2>Añadir Producto</h2>
 <p>&nbsp;</p>
 <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
   <table width="566" align="center">
     <tr valign="baseline">
       <td width="170" align="right" nowrap>Nombre de Producto:</td>
       <td width="278"><input type="text" name="strNombre" value="" size="32"></td>
     </tr>
     <tr valign="baseline">
       <td nowrap align="right">Categoria:</td>
       <td><label for="intCategoria"></label>
         <select name="intCategoria" id="intCategoria">
           <?php
do {  
?>
           <option value="<?php echo $row_ConsultaCategorias['idCategorias']?>"><?php echo $row_ConsultaCategorias['strDescripcion']?></option>
           <?php
} while ($row_ConsultaCategorias = mysql_fetch_assoc($ConsultaCategorias));
  $rows = mysql_num_rows($ConsultaCategorias);
  if($rows > 0) {
      mysql_data_seek($ConsultaCategorias, 0);
	  $row_ConsultaCategorias = mysql_fetch_assoc($ConsultaCategorias);
  }
?>
         </select></td>
     </tr>
     <tr valign="baseline">
       <td nowrap align="right">Precio:</td>
       <td><input type="text" name="dblPrecio" value="" size="32"></td>
     </tr>
     <tr valign="baseline">
       <td nowrap align="right">Imagen:</td>
       <td><label for="strImagen"></label>
         <input name="strImagen" type="text" id="strImagen" size="32" readonly="readonly">
         <input type="button" name="button" id="button" value="Subir Imagen" onclick="javascript:subirimagen();"/></td>
     </tr>
     <tr valign="baseline">
       <td nowrap align="right">Stock:</td>
       <td><select name="intStock">
         <option value="0" <?php if (!(strcmp(0, ""))) {echo "SELECTED";} ?>>Selecionar</option>
         <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>1 u</option>
         <option value="2" <?php if (!(strcmp(2, ""))) {echo "SELECTED";} ?>>2 u</option>
         <option value="3" <?php if (!(strcmp(3, ""))) {echo "SELECTED";} ?>>3 u</option>
         <option value="4" <?php if (!(strcmp(4, ""))) {echo "SELECTED";} ?>>4 u</option>
         <option value="5" <?php if (!(strcmp(5, ""))) {echo "SELECTED";} ?>>5 u</option>
         <option value="6" <?php if (!(strcmp(6, ""))) {echo "SELECTED";} ?>>6 u</option>
         <option value="7" <?php if (!(strcmp(7, ""))) {echo "SELECTED";} ?>>7 u</option>
         <option value="8" <?php if (!(strcmp(8, ""))) {echo "SELECTED";} ?>>8 u</option>
         <option value="9" <?php if (!(strcmp(9, ""))) {echo "SELECTED";} ?>>9 u</option>
         <option value="10" <?php if (!(strcmp(10, ""))) {echo "SELECTED";} ?>>10 u</option>
       </select></td>
     </tr>
     <tr valign="baseline">
       <td nowrap align="right">&nbsp;</td>
       <td><input type="submit" value="Agregar Producto"></td>
     </tr>
   </table>
   <input type="hidden" name="MM_insert" value="form1">
 </form>
 <p>&nbsp;</p>
<p>&nbsp;</p>
</article>
</section>
</div>
<footer></footer>
</body>
</html>
<?php
mysql_free_result($ConsultaCategorias);
?>
