<?php require_once('Connections/conexion.php'); ?>
<?php require_once('Connections/conexion.php');error_reporting(0); ?>
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

$maxRows_RecordProductos = 35;
$pageNum_RecordProductos = 0;
if (isset($_GET['pageNum_RecordProductos'])) {
  $pageNum_RecordProductos = $_GET['pageNum_RecordProductos'];
}
$startRow_RecordProductos = $pageNum_RecordProductos * $maxRows_RecordProductos;

mysql_select_db($database_conexion, $conexion);
$query_RecordProductos = "SELECT * FROM productos ORDER BY productos.strNombre DESC";
$query_limit_RecordProductos = sprintf("%s LIMIT %d, %d", $query_RecordProductos, $startRow_RecordProductos, $maxRows_RecordProductos);
$RecordProductos = mysql_query($query_limit_RecordProductos, $conexion) or die(mysql_error());
$row_RecordProductos = mysql_fetch_assoc($RecordProductos);

if (isset($_GET['totalRows_RecordProductos'])) {
  $totalRows_RecordProductos = $_GET['totalRows_RecordProductos'];
} else {
  $all_RecordProductos = mysql_query($query_RecordProductos);
  $totalRows_RecordProductos = mysql_num_rows($all_RecordProductos);
}
$totalPages_RecordProductos = ceil($totalRows_RecordProductos/$maxRows_RecordProductos)-1;

$queryString_RecordProductos = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecordProductos") == false && 
        stristr($param, "totalRows_RecordProductos") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordProductos = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordProductos = sprintf("&totalRows_RecordProductos=%d%s", $totalRows_RecordProductos, $queryString_RecordProductos);
?>
<?php include("includes/header.php"); ?>

<div id="menu">
 <div class="link"><p><a href="index.php">Inicio</a></p></div>
             <div class="link-activo"><p><a href="canjes.php">Canjes</a></p></div>
              <div class="link"><p><a href="mi_cuenta.php">Mi Cuenta</a></p></div>
                <div class="link"><p><a href="novedades.php">Novedades</a></p></div>
 </ul>
</div>
<div id="buscador"></div>

<section>
<aside>
<?php include("includes/catalogo.php"); ?>
</aside>
<article>
<div class="productos">
       <div class="box-content2">
         <ul>
             <li>
  <div class="tipro2"><p>Productos</p></div>
  <div class="box-imagen"><img src="imagenes/imagen-nufarm-producto.png" width="307" height="270"> 
  
  </div>

     </li>
         </ul>
                     </div><!---- Fin box-content ---->
                     
                     
                            
                            <div id="info-evento">
                            
                             <p>La realización de artículos promocionales permite crear una buena identificación de marca a la vez de unificar la imagen de Nufarm a nivel país. La compra centralizada permite lograr buenos costos y por sobre todo una calidad homogénea y asegurada.
<br><br>
Por lo tanto, ofrecemos la posibilidad de realizar materiales promocionales, con logo del Distribuidor, logo de la marca a promocionar (ej. Credit Full), y logo de Nufarm.</p>
                             
                             
                         
              </div>               
<div class="large"><h2>Productos</h2></div>
<div class="box-content">
      <?php do { ?> 
         <ul>
            <li>
            <div class="tipro"><div class="titlef"><span><?php echo $row_RecordProductos['strNombre']; ?></span></div> <p>$<?php echo $row_RecordProductos['dblPrecio']; ?><br /> <pre>+IVA</pre><p></div>
            
            <div class="box-imagen3">
          <a href="ver_producto.php?recordID=<?php echo $row_RecordProductos['idProducto']; ?>"><img src="images_productos/<?php echo $row_RecordProductos['strImagen']; ?>" width="156" height="158"></a></div>
         
          
                    <div class="info">
                            <h4><a href="ver_producto.php?recordID=<?php echo $row_RecordProductos['idProducto']; ?>">CANJEAR</a></h4>
                                           </div>
                                          
                                            </li>
                                            <div class="descripcion">
                                             <span>Stock <?php echo $row_RecordProductos['intStock']; ?> U</span> 
                                                  <p><?php echo $row_RecordProductos['strDetalle']; ?></p>                
                                                            </div>
              </ul>        
        <?php } while ($row_RecordProductos = mysql_fetch_assoc($RecordProductos)); ?>
        
                       </div><!---- Fin box-content ---->
                            </div><!--- Fin Productos --->
                            <table border="0">
                              <tr>
                                <td><?php if ($pageNum_RecordProductos > 0) { // Show if not first page ?>
                                    <a href="<?php printf("%s?pageNum_RecordProductos=%d%s", $currentPage, 0, $queryString_RecordProductos); ?>"><img src="First.gif"></a>
                                    <?php } // Show if not first page ?></td>
                                <td><?php if ($pageNum_RecordProductos > 0) { // Show if not first page ?>
                                    <a href="<?php printf("%s?pageNum_RecordProductos=%d%s", $currentPage, max(0, $pageNum_RecordProductos - 1), $queryString_RecordProductos); ?>"><img src="Previous.gif"></a>
                                    <?php } // Show if not first page ?></td>
                                <td><?php if ($pageNum_RecordProductos < $totalPages_RecordProductos) { // Show if not last page ?>
                                    <a href="<?php printf("%s?pageNum_RecordProductos=%d%s", $currentPage, min($totalPages_RecordProductos, $pageNum_RecordProductos + 1), $queryString_RecordProductos); ?>"><img src="Next.gif"></a>
                                    <?php } // Show if not last page ?></td>
                                <td><?php if ($pageNum_RecordProductos < $totalPages_RecordProductos) { // Show if not last page ?>
                                    <a href="<?php printf("%s?pageNum_RecordProductos=%d%s", $currentPage, $totalPages_RecordProductos, $queryString_RecordProductos); ?>"><img src="Last.gif"></a>
                                    <?php } // Show if not last page ?></td>
                              </tr>
                            </table>
</article>
</section>
</div>
</div></div></div></div>
<?php include("includes/footer.php"); ?>
<?php
mysql_free_result($RecordProductos);
?>
