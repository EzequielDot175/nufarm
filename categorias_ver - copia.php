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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_DatosProductos = 10;
$pageNum_DatosProductos = 0;
if (isset($_GET['pageNum_DatosProductos'])) {
  $pageNum_DatosProductos = $_GET['pageNum_DatosProductos'];
}
$startRow_DatosProductos = $pageNum_DatosProductos * $maxRows_DatosProductos;

$varIdCategoria_DatosProductos = "0";
if (isset($_GET["cat"])) {
  $varIdCategoria_DatosProductos = $_GET["cat"];
}
mysql_select_db($database_conexion, $conexion);
$query_DatosProductos = sprintf("SELECT * FROM productos WHERE productos.intCategoria = %s", GetSQLValueString($varIdCategoria_DatosProductos, "int"));
$query_limit_DatosProductos = sprintf("%s LIMIT %d, %d", $query_DatosProductos, $startRow_DatosProductos, $maxRows_DatosProductos);
$DatosProductos = mysql_query($query_limit_DatosProductos, $conexion) or die(mysql_error());
$row_DatosProductos = mysql_fetch_assoc($DatosProductos);

if (isset($_GET['totalRows_DatosProductos'])) {
  $totalRows_DatosProductos = $_GET['totalRows_DatosProductos'];
} else {
  $all_DatosProductos = mysql_query($query_DatosProductos);
  $totalRows_DatosProductos = mysql_num_rows($all_DatosProductos);
}
$totalPages_DatosProductos = ceil($totalRows_DatosProductos/$maxRows_DatosProductos)-1;

$queryString_DatosProductos = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_DatosProductos") == false && 
        stristr($param, "totalRows_DatosProductos") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_DatosProductos = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_DatosProductos = sprintf("&totalRows_DatosProductos=%d%s", $totalRows_DatosProductos, $queryString_DatosProductos);
?>
<?php include("includes/header.php"); ?>

<div id="menu">
 <div class="link"><p><a href="#">Inicio</a></p></div>
             <div class="link-activo"><p><a href="#">Canjes</a></p></div>
              <div class="link"><p><a href="#">Mi Cuenta</a></p></div>
                <div class="link"><p><a href="#">Novedades</a></p></div>
 </ul>
</div>
<div id="buscador"></div>
<section>
<aside>
<?php include("includes/catalogo.php"); ?>
</aside>
<article>
 <h3>Productos...</h3>
    <div class="productos">
    
     <?php if ($totalRows_DatosProductos > 0) { // Show if recordset not empty ?>
  <?php do { ?>
    <a href="ver_producto.php?recordID=<?php echo $row_DatosProductos['idProducto']; ?>"><img src="documentos/img/<?php echo $row_DatosProductos['strImagen']; ?>" width="120" height="120"></a><br />
    <a href="ver_producto.php?recordID=<?php echo $row_DatosProductos['idProducto']; ?>"><?php echo $row_DatosProductos['strNombre']; ?></a> <br />
    <a href="ver_producto.php?recordID=<?php echo $row_DatosProductos['idProducto']; ?>">Canjear</a><br />
    
    Precio: $<?php echo $row_DatosProductos['dblPrecio']; ?> -
    
    Stock: <?php echo $row_DatosProductos['intStock']; ?><br />
    <?php } while ($row_DatosProductos = mysql_fetch_assoc($DatosProductos)); ?>
       <?php } // Show if recordset not empty ?>
       <?php if ($totalRows_DatosProductos == 0) { // Show if recordset empty ?>
  <p>No existe Producto en está Categoria...</p>
  <?php } // Show if recordset empty ?>
  <table border="0">
    <tr>
      <td><?php if ($pageNum_DatosProductos > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_DatosProductos=%d%s", $currentPage, 0, $queryString_DatosProductos); ?>">Primero</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_DatosProductos > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_DatosProductos=%d%s", $currentPage, max(0, $pageNum_DatosProductos - 1), $queryString_DatosProductos); ?>">Anterior</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_DatosProductos < $totalPages_DatosProductos) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_DatosProductos=%d%s", $currentPage, min($totalPages_DatosProductos, $pageNum_DatosProductos + 1), $queryString_DatosProductos); ?>">Siguiente</a>
          <?php } // Show if not last page ?></td>
      <td><?php if ($pageNum_DatosProductos < $totalPages_DatosProductos) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_DatosProductos=%d%s", $currentPage, $totalPages_DatosProductos, $queryString_DatosProductos); ?>">&Uacute;ltimo</a>
          <?php } // Show if not last page ?></td>
    </tr>
  </table>
   </div>

</div>
</article>
</section>

</div></div></div></div>
<?php include("includes/footer.php"); ?>
</body>
</html>
<?php
mysql_free_result($DatosProductos);
?>
