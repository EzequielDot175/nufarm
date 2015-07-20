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
$query_Recordset1 = "SELECT * FROM productos ORDER BY productos.strNombre ASC";
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
 <h2>Lista de Productos</h2>
 <a href="producto_add.php">Añadir Producto</a>
<table width="100%" border="0">
  <tr align="center" bgcolor="#9E1F63">
     <td>Nombre de Producto</td>
     <td>Stock</td>
     <td bgcolor="#9E1F63">Acciones</td>
   </tr>
   <?php do { ?>
     <tr>
       <td><?php echo $row_Recordset1['strNombre']; ?></td>
       <td align="center"><?php echo $row_Recordset1['intStock']; ?></td>
       <td align="center"><a href="producto_edit.php?recordID=<?php echo $row_Recordset1['idProducto']; ?>">Editar</a> - <a href="producto_delete.php?recordID=<?php echo $row_Recordset1['idProducto']; ?>">Eliminar</a></td>
     </tr>
     <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
 </table>
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
