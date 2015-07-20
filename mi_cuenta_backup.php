<?php require('Connections/conexion.php');?><?php
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

$MM_restrictGoTo = "../login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location:". $MM_restrictGoTo); 
  exit;
}
?><?php
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
//CARRO DE COMPRAS - FUNCIONALIDADES
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

// MI CUENTA FUNCIONALIDADES
$DatoUsuario_consulta = "0";
if (isset($_SESSION['MM_IdUsuario'])) {
  $DatoUsuario_consulta = $_SESSION['MM_IdUsuario'];
}
mysql_select_db($database_conexion, $conexion);
$query_consulta = sprintf("SELECT * FROM usuarios WHERE usuarios.idUsuario = %s", GetSQLValueString($DatoUsuario_consulta, "int"));
$consulta = mysql_query($query_consulta, $conexion) or die(mysql_error());
$row_consulta = mysql_fetch_assoc($consulta);
$totalRows_consulta = mysql_num_rows($consulta);

$varResultado_consulta2 = "0";
if (isset($_SESSION['MM_IdUsuario'])) {
  $varResultado_consulta2 = $_SESSION['MM_IdUsuario'];
}
mysql_select_db($database_conexion, $conexion);
$query_consulta2 = sprintf("SELECT * FROM compra WHERE compra.idUsuario = %s", GetSQLValueString($varResultado_consulta2, "int"));
$consulta2 = mysql_query($query_consulta2, $conexion) or die(mysql_error());
$row_consulta2 = mysql_fetch_assoc($consulta2);
$totalRows_consulta2 = mysql_num_rows($consulta2);

////FUNCIONALIDAD VER Y EDITAR MIS DATOS

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE usuarios SET strNombre=%s, strApellido=%s, strEmail=%s, strEmpresa=%s, strCargo=%s, strPassword=%s, direccion=%s, telefono=%s, cumpleanos=%s, ciudad=%s, cp=%s, provincia=%s WHERE idUsuario=%s",
                       GetSQLValueString($_POST['strNombre'], "text"),
                       GetSQLValueString($_POST['strApellido'], "text"),
                       GetSQLValueString($_POST['strEmail'], "text"),
                       GetSQLValueString($_POST['strEmpresa'], "text"),
                       GetSQLValueString($_POST['strCargo'], "text"),
                       GetSQLValueString($_POST['strPassword'], "text"),
                       GetSQLValueString($_POST['direccion'], "text"),							   
                       GetSQLValueString($_POST['telefono'], "text"),	
					   GetSQLValueString($_POST['fechanac'], "date"),
					   GetSQLValueString($_POST['ciudad'], "text"),
					   GetSQLValueString($_POST['cp'], "text"),
					   GetSQLValueString($_POST['provincia'], "text"),
                       GetSQLValueString($_POST['idUsuario'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());

  $updateGoTo = "usuario_modificacion_ok.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$varDatoUsuario_DatoUsuario = "0";
if (isset($_SESSION["MM_IdUsuario"])) {
  $varDatoUsuario_DatoUsuario = $_SESSION["MM_IdUsuario"];
}
mysql_select_db($database_conexion, $conexion);
$query_DatoUsuario = sprintf("SELECT * FROM usuarios WHERE usuarios.idUsuario = %s", GetSQLValueString($varDatoUsuario_DatoUsuario, "int"));
$DatoUsuario = mysql_query($query_DatoUsuario, $conexion) or die(mysql_error());
$row_DatoUsuario = mysql_fetch_assoc($DatoUsuario);
$totalRows_DatoUsuario = mysql_num_rows($DatoUsuario);



?>
<?php $activo = $_GET['activo']; include("includes/header.php"); ?>
<!DOCTYPE html>

<html>
<head>
  <meta name="generator" content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39">

  <title></title>
</head>

<body>
  <section>
    <?php include("includes/menu.php"); ?>
    
<aside>
<?php include("includes/catalogo2.php"); ?>
</aside>
	
	
	
	
	
 <div id="resumen_micuenta">
      <ul>

</ul>
</div>

    <article>
      <div class="mcuenta_bg">
	  
	  <div class="micuenta_submenu"><ul> <li id="MC_1">CANJES A CONFIRMAR</li><span class="sombra234_small"></span> <li id="MC_2">CANJES REALIZADOS</li><span class="sombra234_small"></span> <li id="MC_3">MIS CONSULTAS</li><span class="sombra234_small"></span> <li id="MC_4">MIS DATOS</li><span class="sombra234_small"></span> </ul></div>
	  <div class="leftcol">
	  
	 
 <!--/MC_2-->	
<div class="separador MC_2">
        <div class="micuenta">
   <table width="98%" border="0" align="center"  cellspacing="0">
   <tr class="tablacolor3">
     <td  class="rotate2" width="12%" height="20px" align="left">Valor Canjeado</td>  
     <td  class="rotate2" width="35%" height="20px" align="left">Producto</td>
     <td  class="rotate2" width="10%" height="20px" align="left">Unidades</td>
	 <td  class="rotate2" width="10%" height="20px" align="left">Talle</td>
	 <td  class="rotate2" width="10%" height="20px" align="left">Precio</td>
     <td  width="14%" height="20px" align="left">Estado</td>
   </tr>
    <?php  include_once('includes/class.compras.php'); ?><?php  include_once('includes/class.productos.php'); ?><?php do { ?>
	    
    <tr bgcolor="#FFFFFF" style="font-size: 12px;">
			
              <!--<td><?php echo $row_consulta2['idCompra']; ?></td>-->

			  
			  
              <td class="header_table_canjeados" colspan="6">CANJE
              <?php echo $row_consulta2['fthCompra']; ?>
				<span style="float:right; width:13%;text-transform: uppercase; "> <?php  
                    
                    if($row_consulta2['estado'] == 1){$estado = "Pendiente";}
                    if($row_consulta2['estado'] == 2){$estado = "En proceso";}
                    if($row_consulta2['estado'] == 3){$estado = "Entregado";}
                    echo $estado?></span>
				</td>
			  
			  
    </tr>
	 <!--<tr class="linetable_green" colspan="6"  height="1px" align="center"></tr>-->

        <td class="td_shadow shadowright" align="center"><span class="valor_total">
			  <?php if($row_consulta2['dblTotal']){  echo "$".$row_consulta2['dblTotal'];} ?>
			  </span><p class="vt_text">
			  <?php if($row_consulta2['dblTotal']){echo"";}else{echo"No hay artículos";} ?>
			  </p></td>
              <td colspan="5" style="padding-left:10px;width: 100%;padding-bottom: 28px;"><?php 
                   
                              # echo $row_MisCompras['detalle']; 
                      if($row_consulta2['idCompra']){
                      $det = new compras();
                              echo $det->bring_detalle_compra($row_consulta2['idCompra']);
                   }
                   #echo '$id_compra'.$row_MisCompras['idCompra'];
                   #echo '<p>Total con IVA $'.$row_consulta2['dblTotal'].'</p>';
                   
                   ?></td>


					
					<!---<td><?php echo $row_consulta2['idCredito']; ?></td>=-->
            </tr><?php } while ($row_consulta2 = mysql_fetch_assoc($consulta2)); ?>

		</table>
	
	<div class="front_micuenta" >
	
  <table>   
   <tr class="tablacolor3">
     <td  class="rotate3" width="12%" height="20px" align="left">Valor Canjeado</td>  
     <td  class="rotate3" width="70%" height="20px" align="left">PROPUESTAS ENVIADAS: PUBLICIDAD Y EVENTOS</td>
     <td  width="14%" height="20px" align="left">Estado</td>
   </tr>

   <?php    
   include_once('includes/class.propuestas.php');
   $pro = new propuestas();
   $pro->select_by_usuario($_SESSION['MM_IdUsuario']);
   ?>   
   </table>  

   
   </div>
  
		</div>

        <div class="mod-datos">
        <div class="tope"></div>
          <a class="btn-micuenta8" href="index.php?activo=1"><span>Realizar canje</span></a>
        </div>

</div>		

 <!--/MC_3-->	
<div class="separador MC_3">
<div class="row-1">		
<span class="asunto">Realizar una Consulta</span>
<br><br>
	<?php
	$mensaje=(isset($_SESSION['mensaje'])? $_SESSION['mensaje']:'');
	if($mensaje){
		echo '<h2 class="msj_env_con">'.$mensaje.'</h2>';
		unset($_SESSION['mensaje']);
	}

	if ((isset($_SESSION['MM_IdUsuario']))  && ($_SESSION['MM_IdUsuario']!="")) {
	?>	
		

		<form method="post" name="form1" action="process_consulta.php">
		
			<div class="label-consulta">Asunto:</div>
			<input id="asunto" type="text" name="strAsunto" value="" size="32">
			<div class="label-consulta">Consulta:</div>
			<textarea id="campo" name="strCampo"></textarea><br>
			<input id="btn-canje8-1" type="submit" value="Enviar">
		   <input type="hidden" name="MM_insert" value="form1"> <br><br> <br><br> <br><br>		   
		 
		</form>
		</div><!--/row1-->
	
<div class="row-1">
<span class="asunto">Listado de consultas</span>
<br><br>	
<?php
	//consultas del usuario y respuestas recibidas.
	include_once('includes/class.consultas.php');
	$cons = new consultas();
	$cons->select_by_usuario($_SESSION['MM_IdUsuario']);
	
	}else{
		#echo 'No hay login';
	

 echo '<p>Necesita acceder para enviar y ver sus consultas. <a href="/login.php">Acceder</a></p>';
 	
 
  }
  
 ?>
 </div><!--/row-1-->
</div>	



 <!--/MC_4-->	
<div class="separador MC_4">	
        <div class="micuenta inicio">
		<h2>Mis datos</h2>
		<div class="colform coledit">
  	<form id="registroform" method="post" name="form1" action="<?php echo $editFormAction; ?>">
		
		<label id="label3">Empresa</label>
		<input type="text" id="empresa" name="strEmpresa" value="<?php echo htmlentities($row_DatoUsuario['strEmpresa'], ENT_COMPAT, 'utf-8'); ?>" size="32">
		<label id="label3">Nombre</label>
		<input type="text" id="empresa" name="strNombre" value="<?php echo htmlentities($row_DatoUsuario['strNombre'], ENT_COMPAT, 'utf-8'); ?>" size="32">
		
		<label id="label3">Apellido</label>
		<input type="text" id="empresa" name="strApellido" value="<?php echo htmlentities($row_DatoUsuario['strApellido'], ENT_COMPAT, 'utf-8'); ?>" size="32">
     	
		<label id="label3">Teléfono</label>
    	<input id="empresa"  name="telefono" type="text" value="<?php echo htmlentities($row_DatoUsuario['telefono'], ENT_COMPAT, 'utf-8'); ?>" required/>
			
	</div>
	
     <div class="colform coledit">
			<label id="label3">Dirección</label>
			<input type="text" id="empresa" name="direccion" value="<?php echo htmlentities($row_DatoUsuario['direccion'], ENT_COMPAT, 'utf-8'); ?>" size="32">
			 
			<label id="label3">Ciudad</label>
			<input type="text" id="empresa" name="ciudad" value="<?php echo htmlentities($row_DatoUsuario['ciudad'], ENT_COMPAT, 'utf-8'); ?>" size="32">
			
			<label id="label3">Codigo Postal</label>
			<input type="text" id="empresa" name="cp" value="<?php echo htmlentities($row_DatoUsuario['cp'], ENT_COMPAT, 'utf-8'); ?>" size="32">
<?php $provincia_selected = htmlentities($row_DatoUsuario['provincia'], ENT_COMPAT, 'utf-8'); ?>		   
		    <label id="label3">Provincia</label>
			<select name="provincia" id="empresa" class="ajuste_select">
			<option value="Buenos Aires" <?if($provincia_selected =="Buenos Aires"){echo" selected";}?>>Buenos Aires</option>
			<option value="Buenos Aires Capital"<?if($provincia_selected =="Buenos Aires Capital"){echo" selected";}?>>Buenos Aires Capital</option>
			<option value="Catamarca"<?if($provincia_selected =="Catamarca"){echo" selected";}?>>Catamarca</option>
			<option value="Chaco"<?if($provincia_selected =="Chaco"){echo" selected";}?>>Chaco</option>
			<option value="Chubut"<?if($provincia_selected =="Chubut"){echo" selected";}?>>Chubut</option>
			<option value="Cordoba"<?if($provincia_selected =="Cordoba"){echo" selected";}?>>Cordoba</option>
			<option value="Corrientes"<?if($provincia_selected =="Corrientes"){echo" selected";}?>>Corrientes</option>
			<option value="Entre Rios"<?if($provincia_selected =="Entre Rios"){echo" selected";}?>>Entre Rios</option>
			<option value="Formosa"<?if($provincia_selected =="Formosa"){echo" selected";}?>>Formosa</option>
			<option value="Jujuy"<?if($provincia_selected =="Jujuy"){echo" selected";}?>>Jujuy</option>
			<option value="La Pampa"<?if($provincia_selected =="La Pampa"){echo" selected";}?>>La Pampa</option>
			<option value="La Rioja"<?if($provincia_selected =="La Rioja"){echo" selected";}?>>La Rioja</option>
			<option value="Mendoza"<?if($provincia_selected =="Mendoza"){echo" selected";}?>>Mendoza</option>
			<option value="Misiones"<?if($provincia_selected =="Misiones"){echo" selected";}?>>Misiones</option>
			<option value="Neuquen"<?if($provincia_selected =="Neuquen"){echo" selected";}?>>Neuquen</option>
			<option value="Rio Negro"<?if($provincia_selected =="Rio Negro"){echo" selected";}?>>Rio Negro</option>
			<option value="Salta"<?if($provincia_selected =="Salta"){echo" selected";}?>>Salta</option>
			<option value="San Juan"<?if($provincia_selected =="San Juan"){echo" selected";}?>>San Juan</option>
			<option value="San Luis"<?if($provincia_selected =="San Luis"){echo" selected";}?>>San Luis</option>
			<option value="Santa Cruz"<?if($provincia_selected =="Santa Cruz"){echo" selected";}?>>Santa Cruz</option>
			<option value="Santa Fe"<?if($provincia_selected =="Santa Fe"){echo" selected";}?>>Santa Fe</option>
			<option value="Santiago del Estero"<?if($provincia_selected =="Santiago del Estero"){echo" selected";}?>>Santiago del Estero</option>
			<option value="Tierra del Fuego"<?if($provincia_selected =="Tierra del Fuego"){echo" selected";}?>>Tierra del Fuego</option>
			<option value="Tucuman"<?if($provincia_selected =="Tucuman"){echo" selected";}?>>Tucuman</option>
			</select>

   </div>
        <div class="colform coledit">
			<label id="label3">E-mail / Usuario</label>
			<input type="text" id="empresa" name="strEmail" value="<?php echo htmlentities($row_DatoUsuario['strEmail'], ENT_COMPAT, 'utf-8'); ?>" size="32">
			 
			 <label id="label3">Contraseña</label>
			<input type="text" id="empresa" name="strPassword" value="<?php echo htmlentities($row_DatoUsuario['strPassword'], ENT_COMPAT, 'utf-8'); ?>" size="32">
			 
			<label id="label3">Fecha de Nac</label>
			<input type="date" value="<?php echo htmlentities($row_DatoUsuario['cumpleanos'], ENT_COMPAT, 'utf-8'); ?>" name="fechanac" id="apellido" required/>
   
			<label id="label3">Cargo</label>
			<input type="text" id="empresa" name="strCargo" value="<?php echo htmlentities($row_DatoUsuario['strCargo'], ENT_COMPAT, 'utf-8'); ?>" size="32">
   </div>
   
   

  <div class="btn-content"><a class="btn-micuenta-edit" ><input type="submit" id="button3" value="Actualizar Datos"></a></div>
 <input type="hidden" name="MM_update" value="form1">
   <input type="hidden" name="idUsuario" value="<?php echo $row_DatoUsuario['idUsuario']; ?>">
 </form>         


        </div>
</div>


 <!--/MC_1-->	
<div class="separador MC_1">	  
	  
<!--//////////////MARKUP CARRITO DE COMPRAS-->		
		<div id="avisos_productos">
 	<?php
 	if($_SESSION["notification"]){
		echo '<h3>'.$_SESSION["notification"].'</h3>';
		unset($_SESSION["notification"]);
	}
 	?>

 </div>
 			

<div class="carritotabla">
 <table width="98%" border="0" align="center"  cellspacing="0">
   <tr class="tablacolor">
     <td class="rotate" width="10%" height="20px" align="left">Imágen</td>  
     <td class="rotate" width="33%" height="20px" align="left">Productos</td>
     <td class="rotate" width="10%" height="20px" align="left">Unidades</td>
	 <td class="rotate" width="7%" height="20px" align="left">Talle</td> 
     <td class="rotate" width="15%" height="20px" align="left">Precio</td>
     <td  width="15%" height="20px" align="left">Acciones</td>
   </tr>
   <?php $preciototal = 0;?>
   <?php do { ?>

   <tr class="line234343"  height="74px" align="center">

   	<?php  

	   	//Agregado por hubermann
	
		
	   	//verifico que haya disponibilidad de cada uno de los productos.
	   	if($row_DatosCarrito['idProducto'])
		{	
			include_once('includes/class.productos.php');
			$productos= new productos();
			$productos->select($row_DatosCarrito['idProducto']);
			$dblPrecio=$productos->getdblPrecio();
			$strNombre=$productos->getstrNombre();
			$strImagen=$productos->getstrImagen();
			$categoria_producto=$productos->getintCategoria();
		
			include_once('includes/class.categorias.php');
			$cat = new categorias();
			$cat->select($categoria_producto);
			$requiere_talles = $cat->gettalles();
			
				if($requiere_talles==1)
				{
						####################
						#REQUIERE TALLES
					
					echo"     ";	
					$linea .= '

						<!-- imagen -->
						<td align="center" width="50"><img class="imgtable" src="images_productos/'.$strImagen.'" width="50" height="50"/></td>
						<!-- nombre -->
						<td class="td_shadow">'.$strNombre.'</td>
						<!-- cantidad -->
						<td class="td_shadow" align="center">'.$row_DatosCarrito['intCantidad'].'</td>';
						$precio_x_cantidades = $row_DatosCarrito['intCantidad'] * $dblPrecio;
						$totales[] = $precio_x_cantidades;
						
						//traigo el nombre del talle
						include_once('includes/class.talles.php');
						$tall = new talles();
						$tall->select($row_DatosCarrito['talle']);	
						$nombre_talle = $tall->getnombre_talle();	
					
					$linea .=	'
						<!-- talle -->
						<td class="td_shadow" align="center">'.$nombre_talle.'</td>
						
						<!-- color -->
						<td class="td_shadow" align="center"></td>
						
						<!-- precio -->
						<td class="td_shadow" align="center">$'.$precio_x_cantidades.' </td>
						
						<!-- opciones -->
						<td align="center"><a class="quitar" href="carrito_lista_delete.php?recordID='.$row_DatosCarrito['intContador'].'">Quitar <img src="imagenes/cross-08.png"/></a></td>';
					echo $linea;
					$linea="";	
						
				}

				else
				{
					####################
					//NO REQUIERE TALLES
					$strintStock=$productos->getintStock();
					
						if($strintStock >=1)
					{
							echo '

						<!-- imagen -->
						<td  align="center" width="50"><img class="imgtable" src="images_productos/'.$strImagen.'" width="50" height="50"/></td>
						
						<!-- nombre -->
						<td class="td_shadow2" align="center">'.$strNombre.'</td>
						
						<!-- cantidad -->
						<td  class="td_shadow" align="center">'.$row_DatosCarrito['intCantidad'].'</td>
						
						<!-- talles -->
						<td  class="td_shadow" width="100px" align="center"></td>

						<!-- precio -->
						<td class="td_shadow"  align="center">$'.$dblPrecio * $row_DatosCarrito['intCantidad'].'</td><td align="center"><a class="quitar" href="carrito_lista_delete.php?recordID='.$row_DatosCarrito['intContador'].'">Quitar  <img src="imagenes/cross-08.png"/></a></td>';
							$total = $dblPrecio * $row_DatosCarrito['intCantidad'];
							$totales[] = $total;

					}
					else
					{
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
				if($final_con_iva >=1)
				{
				
					//verifico que tenga credito el usuario para mostrar boton de pago
					include_once("includes/class.usuarios.php");
					$usuarios= new usuarios();
					$usuarios->select($_SESSION["MM_IdUsuario"]);
					//if($valor_general > $creditoActual=$usuarios->getdblCredito()){
						if($final_con_iva > $creditoActual=$usuarios->getdblCredito()){
						$link_pagar = '<a class="btn-micuenta" href="mi_cuenta.php?activo=2&del=1"><span>Solicite cr&eacute;ditos</span></a> <a class="btn-micuenta" href="#"><span>Cr&eacute;dito insuficiente</span></a>';
						}
						else
						{
							$link_pagar = ' <a class="btn-micuenta9" href="finalizacion.php?activo=2"><span>Finalizar canje </span></a>';
							//$link_pagar = '<a href="forma_pago.php">Finalizar pago</a>';
						}
					
					
					
				}
				else
				{
					$link_pagar = '';
				}
	   	
	   	
	   	}else{

	   	echo '<span class="nohay">No hay artículos.</span>

         <a class="btn-micuenta2" href="index.php?activo=1&prod=1"><span>Realizar canje</span></a>
          
		
		';
	   	}
   	?>

       <!--<td height="38"><?php echo ObtenerNombreProducto ($row_DatosCarrito['idProducto']); ?></td>
       <td align="center"><?php echo $row_DatosCarrito['intCantidad']; ?></td>
       <td>$<?php echo ObtenerPrecioProducto($row_DatosCarrito['idProducto']); ?></td>
       <td align="center"><a href="carrito_lista_delete.php?recordID=<?php echo $row_DatosCarrito['idProducto']; ?>">Cancelar</a></td>-->
  
	 </tr>
	    <tr class="linetable" colspan="6"  height="1px" align="center">
     <?php   $preciototal = $preciototal + ObtenerPrecioProducto($row_DatosCarrito['idProducto']);?>
     <?php } while ($row_DatosCarrito = mysql_fetch_assoc($DatosCarrito)); ?>
     <tr  align="center">
     <td></td>
     <td></td>
     <td></td>
	   <td></td>
	   <td></td>
      <td class="precio_final " height="32px" align="right" width="20%" >
        Total final: <strong>$ <?php echo $final_con_iva ?></strong>
        </td>
     </tr>

 </table>
 </div>
 <table width="99%" align="left">
 <tr>
<a class="btn-micuenta8" href="index.php?activo=1&prod=1"><span> Agregar Nuevo canje</span></a>
       <?php echo $link_pagar; ?>
       </tr>
 </table>

<!--FIN CARRO COMPRAS--> 

		</div><!--FIN LEFT COL-->
     </div>
	</div> 
    </article>
<?php include("includes/footer.php"); ?>
  </section>
</div>

</body>
</html>
<?php
  mysql_free_result($consulta);
  mysql_free_result($consulta2);
?>
