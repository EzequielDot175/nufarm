<?php require_once('Connections/conexion.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

$_SESSION["notification"] ="";


// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

$maxRows_DatosCarrito = 10;
$pageNum_DatosCarrito = 0;
if (isset($_GET['pageNum_DatosCarrito'])) {
  $pageNum_DatosCarrito = $_GET['pageNum_DatosCarrito'];
}
$startRow_DatosCarrito = $pageNum_DatosCarrito * $maxRows_DatosCarrito;

$varUsuario_DatosCarrito = "0";
if (isset($_SESSION["MM_IdUsuario"])) {
  $varUsuario_DatosCarrito = $_SESSION["MM_IdUsuario"];
}
mysql_select_db($database_conexion, $conexion);
$query_DatosCarrito = sprintf("SELECT * FROM carrito WHERE carrito.idUsuario = %s AND carrito.intTransaccion = 0", GetSQLValueString($varUsuario_DatosCarrito, "int"));
$query_limit_DatosCarrito = sprintf("%s LIMIT %d, %d", $query_DatosCarrito, $startRow_DatosCarrito, $maxRows_DatosCarrito);
$DatosCarrito = mysql_query($query_limit_DatosCarrito, $conexion) or die(mysql_error());
$row_DatosCarrito = mysql_fetch_assoc($DatosCarrito);

if (isset($_GET['totalRows_DatosCarrito'])) {
  $totalRows_DatosCarrito = $_GET['totalRows_DatosCarrito'];
} else {
  $all_DatosCarrito = mysql_query($query_DatosCarrito);
  $totalRows_DatosCarrito = mysql_num_rows($all_DatosCarrito);
}
$totalPages_DatosCarrito = ceil($totalRows_DatosCarrito/$maxRows_DatosCarrito)-1;

$queryString_DatosCarrito = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_DatosCarrito") == false && 
        stristr($param, "totalRows_DatosCarrito") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_DatosCarrito = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_DatosCarrito = sprintf("&totalRows_DatosCarrito=%d%s", $totalRows_DatosCarrito, $queryString_DatosCarrito);
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

<?php 



?>
<section>
<aside>
<?php include("includes/catalogo.php"); ?>
</aside>
<article>


<div id="avisos_productos">
 	<?php
 	if($_SESSION["notification"]){
		echo '<h3>'.$_SESSION["notification"].'</h3>';
		unset($_SESSION["notification"]);
	}
 	?>
 </div>

<div class="bar-green2"> <h4>Canjes agregados</h4> </div> <br><br><br>
 <table class="carritotabla" width="98%" border="0">
   <tr class="tablacolor">
     <td width="43%" height="25px" align="center" bgcolor="#BCD43E">Productos</td>
     <td width="15%" height="25px" align="center" bgcolor="#BCD43E">Unidades</td>
	<td width="15%" height="25px" align="center" bgcolor="#BCD43E">Talle</td>
     <td width="15%" height="25px" align="center" bgcolor="#BCD43E">Precio</td>
     <td width="15%" height="25px" align="center" bgcolor="#BCD43E">Acciones</td>
   </tr>
   <?php $preciototal = 0;?>
   <?php do { ?>
   <tr bgcolor="#FFFFFF" height="25px">
   	<?php  

	   	//Agregado por hubermann
	
		
	   	//verifico que haya disponibilidad de cada uno de los productos.
	   	if($row_DatosCarrito['idProducto']){
	   	include_once('includes/class.productos.php');
	   	$productos= new productos();
	   	$productos->select($row_DatosCarrito['idProducto']);
	   	$dblPrecio=$productos->getdblPrecio();
	   	$strNombre=$productos->getstrNombre();
		$categoria_producto=$productos->getintCategoria();
	   	$strintStock=$productos->getintStock();
	   	
	   	if($strintStock >=1){
		   	echo '<td>'.$strNombre.'</td><td align="center">'.$row_DatosCarrito['intCantidad'].'</td>
		
		<td align="center">Talles</td>
		
		
		<td align="center">'.$dblPrecio.'</td><td align="center"><a href="carrito_lista_delete.php?recordID='.$row_DatosCarrito['intContador'].'">Quitar</a></td>';
		   	$total = $dblPrecio * $row_DatosCarrito['intCantidad'];
		   	$totales[] = $total;
	   	
	}else{
		   	echo '<td>'.$strNombre.'</td><td align="center">'.$row_DatosCarrito['intCantidad'].'</td><td align="center">---</td><td align="center"> <a href="carrito_lista_delete.php?recordID='.$row_DatosCarrito['intContador'].'">NO DISPONIBLE</a> </td>';
		   	$total =0;
		   	$totales[] = $total;
	   	}
	   	
	   	// IVA
	   	$IVA = ObtenerIVA();
	   	//Total sin IVA
	   	$valor_general = array_sum($totales);
	   	//Total con IVA
		$final_con_iva = $valor_general + $valor_general * $IVA / 100;
	   	
	   	//if($valor_general >=1){
	    if($final_con_iva >=1){
	   	
	   		//verifico que tenga credito el usuario para mostrar boton de pago
	   		include_once("includes/class.usuarios.php");
	   		$usuarios= new usuarios();
	   		$usuarios->select($_SESSION["MM_IdUsuario"]);
	   		//if($valor_general > $creditoActual=$usuarios->getdblCredito()){
			if($final_con_iva > $creditoActual=$usuarios->getdblCredito()){
		   	$link_pagar = '<a class="canjear" href="mis_consultas.php"><span>Solicite cr&eacute;ditos</span></a> <a class="canjear" href="#"><span>Cr&eacute;dito insuficiente</span></a>';
	   		}else{
				$link_pagar = '<a class="canjear" href="finalizacion.php"><span>Finalizar canje</span></a>';
		   		//$link_pagar = '<a href="forma_pago.php">Finalizar pago</a>';
	   		}
	   		
	   		
		   	
	   	}else{
		   	$link_pagar = '';
	   	}
	   	
	   	
	   	}else{
	   	echo 'No hay artículos.';
	   	$link_pagar = '';
	   	}
   	?>
   
   
   
     
       <!--<td height="38"><?php echo ObtenerNombreProducto ($row_DatosCarrito['idProducto']); ?></td>
       <td align="center"><?php echo $row_DatosCarrito['intCantidad']; ?></td>
       <td>$<?php echo ObtenerPrecioProducto($row_DatosCarrito['idProducto']); ?></td>
       <td align="center"><a href="carrito_lista_delete.php?recordID=<?php echo $row_DatosCarrito['idProducto']; ?>">Cancelar</a></td>-->
     </tr>
     <?php   $preciototal = $preciototal + ObtenerPrecioProducto($row_DatosCarrito['idProducto']);?>
     <?php } while ($row_DatosCarrito = mysql_fetch_assoc($DatosCarrito)); ?>
     <tr>
       <td>&nbsp;</td>
		<td>&nbsp;</td>
       <td align="right">Total:</td>
       <td align="center">$<?php echo $valor_general; ?></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
		<td>&nbsp;</td>
       <td align="right">IVA:</td>
       <td align="center"><?php echo $IVA; ?>%</td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
		<td>&nbsp;</td>
       <td align="right">Total con IVA:</td>
       <td align="center">$<?php 
		  #$multiplicador =  (100 + ObtenerIVA())/100;
		  #$valorconIVA = $preciototal * $multiplicador;
		  #echo $valorconIVA;
		  
		  echo $final_con_iva
		  ?></td>
		 
		  
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td colspan="2">&nbsp;</td>
<td colspan="2">&nbsp;</td>
       <td colspan="2" align="right"><?php echo $link_pagar; ?></td>
       </tr>
 </table>
 
<p>&nbsp;</p>
  </article>
</section>
</div></div></div></div>
<?php include("includes/footer.php"); ?>
</body>
</html>
<?php
mysql_free_result($DatosCarrito);
?>
