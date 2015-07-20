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
  $updateSQL = sprintf("UPDATE usuarios SET strNombre=%s, strApellido=%s, strEmail=%s, strEmpresa=%s, dblCredito=%s WHERE idUsuario=%s",
                       GetSQLValueString($_POST['strNombre'], "text"),
                       GetSQLValueString($_POST['strApellido'], "text"),
                       GetSQLValueString($_POST['strEmail'], "text"),
                       GetSQLValueString($_POST['strEmpresa'], "text"),
                       GetSQLValueString($_POST['dblCredito'], "double"),
                       GetSQLValueString($_POST['idUsuario'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());

  $updateGoTo = "usuarios_lista.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$varUsuarioDato_DatosUsuario2 = "0";
if (isset($_GET["recordID"])) {
  $varUsuarioDato_DatosUsuario2 = $_GET["recordID"];
}
mysql_select_db($database_conexion, $conexion);
$query_DatosUsuario2 = sprintf("SELECT * FROM usuarios WHERE usuarios.idUsuario = %s", GetSQLValueString($varUsuarioDato_DatosUsuario2, "int"));
$DatosUsuario2 = mysql_query($query_DatosUsuario2, $conexion) or die(mysql_error());
$row_DatosUsuario2 = mysql_fetch_assoc($DatosUsuario2);
$totalRows_DatosUsuario2 = mysql_num_rows($DatosUsuario2);
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
 <h2>Editar Usuario</h2>
 <p>&nbsp;</p>
 <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
   <table width="385" align="center">
     <tr valign="baseline">
       <td nowrap align="right">Nombre:</td>
       <td><input type="text" name="strNombre" value="<?php echo htmlentities($row_DatosUsuario2['strNombre'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
     </tr>
     <tr valign="baseline">
       <td nowrap align="right">Apellido:</td>
       <td><input type="text" name="strApellido" value="<?php echo htmlentities($row_DatosUsuario2['strApellido'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
     </tr>
     <tr valign="baseline">
       <td nowrap align="right">Email:</td>
       <td><input type="text" name="strEmail" value="<?php echo htmlentities($row_DatosUsuario2['strEmail'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
     </tr>
     <tr valign="baseline">
       <td nowrap align="right">Empresa:</td>
       <td><input type="text" name="strEmpresa" value="<?php echo htmlentities($row_DatosUsuario2['strEmpresa'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
     </tr>
     <tr valign="baseline">
       <td nowrap align="right">Credito:</td>
       <td><input type="text" name="dblCredito" value="<?php echo htmlentities($row_DatosUsuario2['dblCredito'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
     </tr>
     <tr valign="baseline">
       <td nowrap align="right">&nbsp;</td>
       <td><input type="submit" value="Actualizar"></td>
     </tr>
   </table>
   <input type="hidden" name="MM_update" value="form1">
   <input type="hidden" name="idUsuario" value="<?php echo $row_DatosUsuario2['idUsuario']; ?>">
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
mysql_free_result($DatosUsuario2);
?>
