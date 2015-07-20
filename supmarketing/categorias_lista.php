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

mysql_select_db($database_conexion, $conexion);
$query_ListaCategorias = "SELECT * FROM categorias ORDER BY categorias.strDescripcion ASC";
$ListaCategorias = mysql_query($query_ListaCategorias, $conexion) or die(mysql_error());
$row_ListaCategorias = mysql_fetch_assoc($ListaCategorias);
$totalRows_ListaCategorias = mysql_num_rows($ListaCategorias);
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
 <h2>Lista de Categorias</h2>
 <a href="categorias_add.php"> Añadir Categoria</a>
<table width="100%" border="0">
  <tr align="center" bgcolor="#9E1F63">
     <td>Nombre de Categorias</td>
     <td>Acciones</td>
   </tr>
   <?php do { ?>
  <tr>
    <td><?php echo $row_ListaCategorias['strDescripcion']; ?></td>
    <td align="center"><a href="categorias_edit.php?recordID=<?php echo $row_ListaCategorias['idCategorias']; ?>">Editar</a></td>
  </tr>
  <?php } while ($row_ListaCategorias = mysql_fetch_assoc($ListaCategorias)); ?>
 </table>
 <p>&nbsp;</p>
  </article>
</section>
</div>
<footer></footer>
</body>
</html>
<?php
mysql_free_result($ListaCategorias);
?>
