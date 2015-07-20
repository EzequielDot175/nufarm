<?php 
if (!isset($_SESSION)) {
  session_start();
} ob_start();
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

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



 	require_once('Connections/conexion.php');


  	$id_producto = $_POST['idProducto'];
	$cantidad_elegida = $_POST['cantidad'];
	
  	include_once("includes/class.productos.php");
  	$productos= new productos();
	$productos->select($id_producto);
	$categoria=$productos->getintCategoria();
	$StockActual=$productos->getintStock();
	
	include_once("includes/class.categorias.php");
	$cat = new categorias();
	$cat->select($categoria);
	$requiere_talles = $cat->gettalles();
	$talles_seleccionados = $_POST['talle'];
	$colores_seleccionados = $_POST['color'];
	if($requiere_talles==1){
		//requiere talles
		
		
		
		#echo '<h1>SESSION USUSARIO'.$_SESSION['MM_IdUsuario'].'</h1>';
	
		foreach($talles_seleccionados as $id_talle => $cantidad_elegida){
			
			
			//prevengo insert with 0
			if($cantidad_elegida > 0 ){
					#echo 'HERE?';
					$id_usuario = $_SESSION['MM_IdUsuario'];
					//primero chequeo si el producto ya existe en el carrito del usuario.
					include_once("includes/class.carrito.php");
					$carr =  new carrito();
					echo $cantidad_en_carrito = $carr->chequear_producto_con_talle($id_usuario,$id_producto, $id_talle);
					
					
				

														
														if($cantidad_en_carrito > 0){
															
															//El producto ya existe en el carrito del usuario, solo actualizo la cantidad
															$traigo_id = new carrito();
															$traigo_id->select_by_usuario_producto_talle($_SESSION['MM_IdUsuario'],$id_producto,$id_talle );
															echo $id_row = $traigo_id->getintContador();
															
															//Actualizo cantidad
															$update_carrito = new carrito();
															$update_carrito->select($id_row);
															$update_carrito->intCantidad = $cantidad_en_carrito + $cantidad_elegida;
															$update_carrito->update($id_row);
															
															header("Location: mi_cuenta.php?activo=2");
															
														
														}else{
														
															//necesito guardarlo desde cero
															include_once("includes/class.carrito.php");
															$carr =  new carrito();
															$carr->idUsuario = $_SESSION['MM_IdUsuario'];
															$carr->idProducto = $id_producto;
															$carr->intCantidad = $cantidad_elegida;
															$carr->talle = $id_talle;
															$carr->insert();

														}
														
														//hay en stock y guarda la compra.	
									
			}
			
		}
		
		header("Location: mi_cuenta.php?activo=2");
		
	}else if($requiere_talles==2){
		//requiere talles
		
		

		#echo '<h1>SESSION USUSARIO'.$_SESSION['MM_IdUsuario'].'</h1>';
	
		foreach($colores_seleccionados as $id_color => $cantidad_elegida){
			
			
			//prevengo insert with 0
			if($cantidad_elegida > 0 ){
					#echo 'HERE?';
					$id_usuario = $_SESSION['MM_IdUsuario'];
					//primero chequeo si el producto ya existe en el carrito del usuario.
					include_once("includes/class.carrito.php");
					$carr =  new carrito();
					echo $cantidad_en_carrito = $carr->chequear_producto_con_color($id_usuario,$id_producto, $id_color);
					
					
				

														
														if($cantidad_en_carrito > 0){
															
															//El producto ya existe en el carrito del usuario, solo actualizo la cantidad
															$traigo_id = new carrito();
															$traigo_id->select_by_usuario_producto_color($_SESSION['MM_IdUsuario'],$id_producto,$id_color );
															echo $id_row = $traigo_id->getintContador();
															
															//Actualizo cantidad
															$update_carrito = new carrito();
															$update_carrito->select($id_row);
															$update_carrito->intCantidad = $cantidad_en_carrito + $cantidad_elegida;
															$update_carrito->update($id_row);
															
															header("Location: mi_cuenta.php?activo=2");
															
														
														}else{
														
														
															//necesito guardarlo desde cero
															include_once("includes/class.carrito.php");
															$carr =  new carrito();
															$carr->idUsuario = $_SESSION['MM_IdUsuario'];
															$carr->idProducto = $id_producto;
															$carr->intCantidad = $cantidad_elegida;
															$carr->color = $id_color;
															$carr->insert();

														}
														
														//hay en stock y guarda la compra.	
									
			}
			
		}
		
		header("Location: mi_cuenta.php?activo=2");
		
	}else{
		
		//Hay stock 
		//No requiere talles		
	  	if($cantidad_elegida <= $StockActual){
			
			//hay en stock y guarda la compra.
			
			//primero chequeo si el producto ya existe en el carrito del usuario.
			include_once("includes/class.carrito.php");
			$carr =  new carrito();
			$cantidad_en_carrito = $carr->chequear_producto($_SESSION['MM_IdUsuario'],$id_producto);
			
			
									if($cantidad_en_carrito > 0){
									
									
										//El producto ya existe en el carrito del usuario, solo actualizo la cantidad
										$traigo_id = new carrito();
										$traigo_id->select_by_usuario_producto($_SESSION['MM_IdUsuario'],$id_producto);
										$id_row = $traigo_id->getintContador();
										
										//Actualizo cantidad
										$update_carrito = new carrito();
										$update_carrito->select($id_row);
										$update_carrito->intCantidad = $cantidad_en_carrito + $cantidad_elegida;
										$update_carrito->update($id_row);
										
										header("Location: mi_cuenta.php?activo=2");
										
									}else{
										//No hay de este producto en el carrito, lo ingreso como nuevo
											
										include_once("includes/class.carrito.php");
									
										$carr =  new carrito();
										$carr->idUsuario = $_SESSION['MM_IdUsuario'];
										$carr->idProducto = $id_producto;
										$carr->intCantidad = $cantidad_elegida;
										$carr->insert();
									
										header("Location: mi_cuenta.php?activo=2");
									}
			
			
			
	  		
	  	}else{
			
			//No hay stock disponible
			$_SESSION["notification"] = "Disculpe, no se encuentra disponible la cantidad seleccionada.";
	  		header("Location: ver_producto.php?recordID=".$id_producto);

			
	  	}//end else stock
		
	}//end else (requiere talles)


?>