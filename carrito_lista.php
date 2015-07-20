<?php require_once('Connections/conexion.php'); ?><?php
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

 <div class="bar-green2"> <h4>Canjes agregados</h4> </div> <br /><br />
<div class="carritotabla">
 <table width="98%" border="0" align="center" cellspacing="5">
   <tr class="tablacolor">
     <td width="43%" height="21px" align="center">Productos</td>
     <td width="15%" height="21px" align="center">Unidades</td>
	<td width="15%" height="21px" align="center">Talle</td>
     <td width="15%" height="21px" align="center">Precio</td>
     <td width="15%" height="21px" align="center">Acciones</td>
   </tr>
   <?php $preciototal = 0;?>
   <?php do { ?>
   <tr background="imagenes/sombra-05.png" height="34px" align="center">
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
	   	
		include_once('includes/class.categorias.php');
		$cat = new categorias();
		$cat->select($categoria_producto);
		$requiere_talles = $cat->gettalles();
		
		if($requiere_talles==1){
			####################
			#REQUIERE TALLES
		
			
		$linea .= '
			<!-- nombre -->
			<td>'.$strNombre.'</td>
			
			<!-- cantidad -->
			<td align="center">'.$row_DatosCarrito['intCantidad'].'</td>';
			$precio_x_cantidades = $row_DatosCarrito['intCantidad'] * $dblPrecio;
			$totales[] = $precio_x_cantidades;
			
			//traigo el nombre del talle
			include_once('includes/class.talles.php');
			$tall = new talles();
			$tall->select($row_DatosCarrito['talle']);	
			$nombre_talle = $tall->getnombre_talle();	
		
		$linea .=	'
			<!-- talle -->
			<td align="center">'.$nombre_talle.'</td>
			
			<!-- precio -->
			<td align="center">'.$precio_x_cantidades.' </td>
			
			<!-- opciones -->
			<td align="center"><a href="carrito_lista_delete.php?recordID='.$row_DatosCarrito['intContador'].'">Quitar</a></td>';
		echo $linea;
		$linea="";	
			
		}else{
			####################
			//NO REQUIERE TALLES
			$strintStock=$productos->getintStock();
			
			if($strintStock >=1){
			   	echo '
			<!-- nombre -->
			<td align="center">'.$strNombre.'</td>
			
			<!-- cantidad -->
			<td align="center">'.$row_DatosCarrito['intCantidad'].'</td>
			
			<!-- talles -->
			<td align="center"></td>

			<!-- precio -->
			<td align="center">'.$dblPrecio * $row_DatosCarrito['intCantidad'].'</td><td align="center"><a href="carrito_lista_delete.php?recordID='.$row_DatosCarrito['intContador'].'">Quitar</a></td>';
			   	$total = $dblPrecio * $row_DatosCarrito['intCantidad'];
			   	$totales[] = $total;

		}else{
			   	echo '<td>'.$strNombre.'</td><td align="center">'.$row_DatosCarrito['intCantidad'].'</td><td align="center">---</td><td align="center"> <a href="carrito_lista_delete.php?recordID='.$row_DatosCarrito['intContador'].'">NO DISPONIBLE</a> </td>';
			   	$total =0;
			   	$totales[] = $total;
		   	}
		
		}//fin else requiere talles
		
		
	   	
	   	
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
				$link_pagar = ' <a class="canjear" href="finalizacion.php"><span>Finalizar canje ></span></a>';
		   		//$link_pagar = '<a href="forma_pago.php">Finalizar pago</a>';
	   		}
	   		
	   		
		   	
	   	}else{
		   	$link_pagar = '';
	   	}
	   	
	   	
	   	}else{
	   	echo '<span class="nohay">No hay artículos.</span>';
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
     <tr  align="center">
     <td></td>
     <td></td>
     <td></td>
      <td background="imagenes/sombra-05.png" height="32px" align="center" width="69%" >
        Total final: <strong>$ <?php echo $final_con_iva ?></strong>
        </td>
     </tr>
      
 </table></div>
 <table width="99%" align="left">
 <tr>
<td align="left"><a class="add-canje-can" href="canjes.php"><span>< Agregar Nuevo canje</span></a></td>
       <td align="right"><?php echo $link_pagar; ?></td>
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
