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

$varConUsu_MisConsultas = "0";
if (isset($_SESSION['MM_IdUsuario'])) {
  $varConUsu_MisConsultas = $_SESSION['MM_IdUsuario'];
}
mysql_select_db($database_conexion, $conexion);
$query_MisConsultas = sprintf("SELECT * FROM consultas WHERE consultas.idUsuario = %s", GetSQLValueString($varConUsu_MisConsultas, "int"));
$MisConsultas = mysql_query($query_MisConsultas, $conexion) or die(mysql_error());
$row_MisConsultas = mysql_fetch_assoc($MisConsultas);
$totalRows_MisConsultas = mysql_num_rows($MisConsultas);
?>
<!doctype html>
<?php include("includes/header.php"); ?>
<div id="menu">
 <div class="link"><p><a href="index.php">Inicio</a></p></div>
             <div class="link"><p><a href="canjes.php">Canjes</a></p></div>
              <div class="link-activo"><p><a href="mi_cuenta.php">Mi Cuenta</a></p></div>
                <div class="link"><p><a href="novedades.php">Novedades</a></p></div>
 </ul>
</div>
<div id="buscador"></div>
</nav>
<section>
<aside>
<?php include("includes/catalogo.php"); ?>
</aside>
<article>
<div class="inicio">

   <div class="misconsultas">
     <h2><?php echo $row_MisConsultas['strAsunto']; ?></h2>
     <p><?php echo $row_MisConsultas['strCampo']; ?></p>
   </div>
  
 </div>
</article>
</section>
</div>
<?php include("includes/footer.php"); ?>
<?php
mysql_free_result($MisConsultas);
?>
</body>
</html>

