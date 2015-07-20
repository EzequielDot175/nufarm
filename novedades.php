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
$query_consulta = "SELECT * FROM novedades ORDER BY novedades.fecha DESC";
$consulta = mysql_query($query_consulta, $conexion) or die(mysql_error());
$row_consulta = mysql_fetch_assoc($consulta);
$totalRows_consulta = mysql_num_rows($consulta);
?>
<?php include("includes/header.php"); ?>

<section>
<?php $activo = $_GET['activo']; include("includes/menu.php"); ?>
<div id="buscador">
   <form name="form1" method="post" action="buscar.php">
    <input type="text" name="buscar" id="buscar" placeholder="Buscar...">
 </form>
</div>
<aside>
<?php include("includes/catalogo2.php"); ?>
</aside>
<article>

<script type="text/javascript">
	$(function(){
		$("#mostrar").click(function(event) {
		event.preventDefault();
		$("#caja").slideToggle();
	});
	$("#caja a").click(function(event) {
		event.preventDefault();
		$("#caja").slideUp();
	});
	});
</script>

<?php do { ?>
  <div class="box-nov"> 
    <div class="inner">
      <div class="bar-greenlight"><span><?php echo $row_consulta['fecha']; ?></span></div>
      <h2><?php echo $row_consulta['titulo']; ?></h2>
       <div class="novedadimg">
       
       <?php if($row_consulta['imagen']){
       echo '<img src="images-novedades/'.$row_consulta['imagen'].'" />';
       } ?>
       
       </div>
<p><?php echo $row_consulta['cuerpo']; ?></p>
<div class="line-trans"></div>
      <!--<a class="ver" href="#"><span>Ver Novedad</span></a>-->
      </div>
  </div><!--  fin box-nov  -->
  <?php } while ($row_consulta = mysql_fetch_assoc($consulta)); ?>
</article>
</section>
</div>
</div></div></div></div>
<?php include("includes/footer.php"); ?>
<?php
mysql_free_result($consulta);
?>
