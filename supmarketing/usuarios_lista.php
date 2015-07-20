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
$query_DatosUsuarios = "SELECT * FROM usuarios ORDER BY usuarios.idUsuario ASC";
$DatosUsuarios = mysql_query($query_DatosUsuarios, $conexion) or die(mysql_error());
$row_DatosUsuarios = mysql_fetch_assoc($DatosUsuarios);
$totalRows_DatosUsuarios = mysql_num_rows($DatosUsuarios);
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
 <h2>Lista de Usuarios</h2>
 <p>&nbsp;
 <table width="580" border="0" align="left">
   <tr align="center" bgcolor="#9E1F63">
     <td>Id</td>
     <td>Nombre</td>
     <td>Apellido</td>
     <td>Email</td>
     <td>Empresa</td>
     <td>Credito</td>
     <td>Acciones</td>
   </tr>
   <?php do { ?>
     <tr align="center">
       <td><a href="detalle_usuario.php?recordID=<?php echo $row_DatosUsuarios['idUsuario']; ?>"> <?php echo $row_DatosUsuarios['idUsuario']; ?>&nbsp; </a></td>
       <td><?php echo $row_DatosUsuarios['strNombre']; ?>&nbsp; </td>
       <td><?php echo $row_DatosUsuarios['strApellido']; ?>&nbsp; </td>
       <td><?php echo $row_DatosUsuarios['strEmail']; ?>&nbsp; </td>
       <td><?php echo $row_DatosUsuarios['strEmpresa']; ?>&nbsp; </td>
       <td><?php echo $row_DatosUsuarios['dblCredito']; ?>&nbsp; </td>
       <td><a href="usuario_edit.php?recordID=<?php echo $row_DatosUsuarios['idUsuario']; ?>">Editar</a> - <a href="usuario_delete.php?recordID=<?php echo $row_DatosUsuarios['idUsuario']; ?>">Eliminar</a></td>
     </tr>
     <?php } while ($row_DatosUsuarios = mysql_fetch_assoc($DatosUsuarios)); ?>
 </table>
 <p><br>
   </p>
 <p>&nbsp;</p>
 <p>&nbsp;</p>
 <p>Registros Total <?php echo $totalRows_DatosUsuarios ?>
 </p>
 <p>&nbsp;</p>
 <p>&nbsp;</p>
 <p>&nbsp;</p>
</article>
</section>
</div>
<footer></footer>
</body>
</html>
<?php
mysql_free_result($DatosUsuarios);
?>
