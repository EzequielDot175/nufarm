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

mysql_select_db($database_conexion, $conexion);
$query_RecordProductos = "SELECT * FROM productos ORDER BY productos.strNombre ASC";
$RecordProductos = mysql_query($query_RecordProductos, $conexion) or die(mysql_error());
$row_RecordProductos = mysql_fetch_assoc($RecordProductos);
$totalRows_RecordProductos = mysql_num_rows($RecordProductos);
?>
<?php include("includes/header.php"); ?>

<div id="menu">
 <div class="link"><p><a href="index.php">Inicio</a></p></div>
             <div class="link"><p><a href="canjes.php">Canjes</a></p></div>
              <div class="link-activo"><p><a href="mi_cuenta.php">Mi Cuenta</a></p></div>
                <div class="link"><p><a href="novedades.php">Novedades</a></p></div>
 </ul>
</div>
<div id="buscador"></div>

<section>
<aside>
<?php include("includes/catalogo.php"); ?>
</aside>
<article>
 <h3>Gracias por registrarte</h3>
 <p>Ya puedes <a href="login.php">iniciar sesion</a></p>
  </article>
</section>
</div>
<footer></footer>
</body>
</html>
<?php
mysql_free_result($RecordProductos);
?>