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

$varCompras_MisCompras = "0";
if (isset($_SESSION['MM_IdUsuario'])) {
  $varCompras_MisCompras = $_SESSION['MM_IdUsuario'];
}
mysql_select_db($database_conexion, $conexion);
$query_MisCompras = sprintf("SELECT * FROM compra WHERE compra.idUsuario = %s", GetSQLValueString($varCompras_MisCompras, "int"));
$MisCompras = mysql_query($query_MisCompras, $conexion) or die(mysql_error());
$row_MisCompras = mysql_fetch_assoc($MisCompras);
$totalRows_MisCompras = mysql_num_rows($MisCompras);
?>
<?php include("includes/header.php"); ?>


<section>
<div id="buscador">

   <form name="form1" method="post" action="buscar.php">

    <input type="text" name="buscar" id="buscar" placeholder="Buscar...">

  </form>

</div>
<?php $activo = $_GET['activo']; include("includes/menu.php"); ?>
<aside>
<?php include("includes/catalogo.php"); ?>
</aside>
<article>
<div class="bar-green2"><h4>Mis canjes realizados</h4></div>
<div class="micuenta">
<table width="97%" align="center" style="margin-top:15px">
    <!-- <tr height="21" bgcolor="#DDE99E" style="color:#008752;text-align:center; text-transform:uppercase">
     
 <td width="10%">Canjeados</td>
    <td width="32%">Detalle</td>
    <td width="10%">Fecha y hora</td>-->
    
    <!--<td width="20%">Creditos</td>
  </tr>-->
  <?php  include_once('includes/class.compras.php'); ?>

<?php  include_once('includes/class.productos.php'); ?>
  <?php do { ?>
    <tr bgcolor="#FFFFFF" style="font-size:12px;">
      <!--<td><?php echo $row_MisCompras['idCompra']; ?></td>-->
     
      <td colspan="4" height="21" bgcolor="#DDE99E" style="color:#008752;text-align:left; text-transform:uppercase; padding-left:10px;">CANJE <?php echo $row_MisCompras['fthCompra']; ?></td>
      
    </tr><tr>
      <td width="110" align="center" style="font-size:22px; color:#008752">$<?php echo $row_MisCompras['dblTotal']; ?></td>
      <td align="center" style="font-size:12px;">X</td>
     
     <td>
     <?php 
     
   		# echo $row_MisCompras['detalle']; 
     	if($row_MisCompras['idCompra']){
     	$det = new compras();
   		echo $det->bring_detalle_compra($row_MisCompras['idCompra']);
     }
     #echo '$id_compra'.$row_MisCompras['idCompra'];
     #echo '<p style="text-align:center">Total con IVA $'.$row_MisCompras['dblTotal'].'</p>';
     
     ?></td>
      <td width="120" align="center" style="font-size:12px;">Entrega: <?php  
      
      if($row_MisCompras['estado'] == 1){$estado = "Pendiente";}
      if($row_MisCompras['estado'] == 2){$estado = "En proceso";}
      if($row_MisCompras['estado'] == 3){$estado = "Entregado";}
      echo $estado?></td>
      
      <!---<td><?php echo $row_MisCompras['idCredito']; ?></td>--->
    </tr>
    <?php } while ($row_MisCompras = mysql_fetch_assoc($MisCompras)); ?>
</table>
      </div>

<!--  PROPUESTAS  -->
<div class="bar-green2"><h4>Propuestas</h4></div>
<div class="micuenta">
<table width="97%" align="center" style="margin-top:10px">
   
   
   
   <?php  
   
   include_once('includes/class.propuestas.php');
   $pro = new propuestas();
   $pro->select_by_usuario($_SESSION['MM_IdUsuario']);
   ?>
   
   
   
</table>
      </div>


</article>
</section>
</div>
</div></div></div></div>
<?php include("includes/footer.php"); ?>
<?php
mysql_free_result($MisCompras);
?>
