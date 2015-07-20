<?php session_start(); error_reporting(0);
if(!$_SESSION['logged_id']){
//header('Location: http://www.productosnufarm.com.ar/control');
 header('Location: http://localhost/');
}
ini_set("memory_limit","60M");

function base_url() {
	 //$pageURL = 'http://localhost/marketingNet/control'; 
	$pageURL = 'http://nufarm-maxx.com/marketingNet/control'; 
	#$pageURL = 'http://localhost/nufarm-gabriel/control'; 
	/*if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].'/control';
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].'/control';
	}*/
	return $pageURL;
 }
// define('BASEURLRAIZ', 'localhost/');
define('BASEURLRAIZ', 'http://nufarm-maxx.com/marketingNet');
define('BASEURL', base_url());



$sa = explode('/', $_SERVER['PHP_SELF']);

$sa = array_pop($sa);

check_permission($sa, $_SESSION['logged_role']);


function check_permission($url, $role_personal){
	
	$url = preg_replace("/\\.[^.\\s]{3,4}$/", "", $url);
	
	
	if($_SESSION['logged_role'] == 1){
		$accesos = array(
			
			'v_productos' => TRUE,
			'e_producto' => TRUE,
			'u_producto' => TRUE,
			'd_producto' => TRUE,
			'n_producto' => TRUE,
			'c_producto' => TRUE,
			'talles_by_cat' => TRUE,
			
			'v_categorias' => TRUE,
			'n_categoria' => TRUE,
			'c_categoria' => TRUE,
			'e_categoria' => TRUE,
			'u_categoria' => TRUE,
			'd_categoria' => TRUE,
	
			'v_talles' => TRUE,
			'n_talle' => TRUE,
			'c_talle' => TRUE,
			'e_talle' => TRUE,
			'u_talle' => TRUE,
			'd_talle' => TRUE,
			
			'v_consultas' => TRUE,
			'n_consulta' => TRUE,
			'c_consulta' => TRUE,
			'e_consulta' => TRUE,
			'u_consulta' => TRUE,
			'd_consulta' => TRUE,
			'responder_consulta' => TRUE,
			'process_consulta' => TRUE,
			
			'v_propuestas' => TRUE,
			'n_propuesta' => TRUE,
			'c_propuesta' => TRUE,
			'e_propuesta' => TRUE,
			'u_propuesta' => TRUE,
			'd_propuesta' => TRUE,
			
			'v_usuarios' => TRUE,
			'n_usuario' => TRUE,
			'c_usuario' => TRUE,
			'e_usuario' => TRUE,
			'u_usuario' => TRUE,
			'd_usuario' => TRUE,
			
			'v_novedades' => TRUE,
			'n_novedad' => TRUE,
			'c_novedad' => TRUE,
			'e_novedad' => TRUE,
			'u_novedad' => TRUE,
			'd_novedad' => TRUE,
			
			'v_compras' => TRUE,
			'n_compra' => TRUE,
			'c_compra' => TRUE,
			'e_compra' => TRUE,
			'u_compra' => TRUE,
			'd_compra' => TRUE,
			
			
			'v_personal' => TRUE,
			'n_personal' => TRUE,
			'c_personal' => TRUE,
			'e_personal' => TRUE,
			'u_personal' => TRUE,
			'd_personal' => TRUE,
			
			'v_color' => TRUE,
			'n_color' => TRUE,
			'c_color' => TRUE,
			'e_color' => TRUE,
			'u_color' => TRUE,
			'd_color' => TRUE,
			
			'fail_credentials' => TRUE,
			'v_propuestas_sin_leer' => TRUE,
			'busquedas' => TRUE,
		);
		
		$permiso = $accesos[$url];	
		
		if($permiso==FALSE){ 
			$_SESSION['msg_error'] = "NO CUENTA CON PRIVILEGIOS PARA ESA ACCION.";
			header('Location: /marketingNet/control/personal/fail_credentials.php');
			exit;
		}
	}
	elseif ($_SESSION['logged_role'] ==2){
		$accesos = array(
				
				'v_productos' => TRUE,
				'e_producto' => FALSE,
				'u_producto' => FALSE,
				'd_producto' => FALSE,
				'n_producto' => FALSE,
				'c_producto' => FALSE,
				'talles_by_cat' => FALSE,
				
				'v_categorias' => FALSE,
				'n_categoria' => FALSE,
				'c_categoria' => FALSE,
				'e_categoria' => FALSE,
				'u_categoria' => FALSE,
				'd_categoria' => FALSE,
		
				'v_talles' => FALSE,
				'n_talle' => FALSE,
				'c_talle' => FALSE,
				'e_talle' => FALSE,
				'u_talle' => FALSE,
				'd_talle' => FALSE,
				
				'v_consultas' => FALSE,
				'n_consulta' => FALSE,
				'c_consulta' => FALSE,
				'e_consulta' => FALSE,
				'u_consulta' => FALSE,
				'd_consulta' => FALSE,
				'responder_consulta' => TRUE,
				'process_consulta' => TRUE,
				
				'v_propuestas' => TRUE,
				'n_propuesta' => FALSE,
				'c_propuesta' => FALSE,
				'e_propuesta' => FALSE,
				'u_propuesta' => FALSE,
				'd_propuesta' => FALSE,
				
				'v_usuarios' => TRUE,
				'n_usuario' => FALSE,
				'c_usuario' => FALSE,
				'e_usuario' => TRUE,
				'u_usuario' => FALSE,
				'd_usuario' => FALSE,
				
				'v_novedades' => TRUE,
				'n_novedad' => FALSE,
				'c_novedad' => FALSE,
				'e_novedad' => FALSE,
				'u_novedad' => FALSE,
				'd_novedad' => FALSE,
				
				'v_compras' => TRUE,
				'n_compra' => FALSE,
				'c_compra' => FALSE,
				'e_compra' => FALSE,
				'u_compra' => FALSE,
				'd_compra' => FALSE,
				
				
				'v_personal' => FALSE,
				'n_personal' => FALSE,
				'c_personal' => FALSE,
				'e_personal' => FALSE,
				'u_personal' => FALSE,
				'd_personal' => FALSE,
				
				'fail_credentials' => TRUE,
				'v_propuestas_sin_leer' => FALSE,
				'busquedas' => TRUE,
			);
			
			$permiso = $accesos[$url];	
			
			if($permiso==FALSE){ 
				$_SESSION['msg_error'] = "NO CUENTA CON PRIVILEGIOS PARA ESA ACCION.";
				header('Location: /marketingNet/control/personal/fail_credentials.php');
				exit;
			}
	}else{
		$accesos = array(
				
				'v_productos' => TRUE,
				'e_producto' => FALSE,
				'u_producto' => FALSE,
				'd_producto' => FALSE,
				'n_producto' => FALSE,
				'c_producto' => FALSE,
				'talles_by_cat' => FALSE,
				
				'v_categorias' => FALSE,
				'n_categoria' => FALSE,
				'c_categoria' => FALSE,
				'e_categoria' => FALSE,
				'u_categoria' => FALSE,
				'd_categoria' => FALSE,
		
				'v_talles' => FALSE,
				'n_talle' => FALSE,
				'c_talle' => FALSE,
				'e_talle' => FALSE,
				'u_talle' => FALSE,
				'd_talle' => FALSE,
				
				'v_consultas' => FALSE,
				'n_consulta' => FALSE,
				'c_consulta' => FALSE,
				'e_consulta' => FALSE,
				'u_consulta' => FALSE,
				'd_consulta' => FALSE,
				'responder_consulta' => TRUE,
				'process_consulta' => TRUE,
				
				'v_propuestas' => TRUE,
				'n_propuesta' => FALSE,
				'c_propuesta' => FALSE,
				'e_propuesta' => FALSE,
				'u_propuesta' => FALSE,
				'd_propuesta' => FALSE,
				
				'v_usuarios' => TRUE,
				'n_usuario' => FALSE,
				'c_usuario' => FALSE,
				'e_usuario' => TRUE,
				'u_usuario' => FALSE,
				'd_usuario' => FALSE,
				
				'v_novedades' => TRUE,
				'n_novedad' => FALSE,
				'c_novedad' => FALSE,
				'e_novedad' => FALSE,
				'u_novedad' => FALSE,
				'd_novedad' => FALSE,
				
				'v_compras' => TRUE,
				'n_compra' => FALSE,
				'c_compra' => FALSE,
				'e_compra' => FALSE,
				'u_compra' => FALSE,
				'd_compra' => FALSE,
				
				
				'v_personal' => FALSE,
				'n_personal' => FALSE,
				'c_personal' => FALSE,
				'e_personal' => FALSE,
				'u_personal' => FALSE,
				'd_personal' => FALSE,
				
				'fail_credentials' => TRUE,
				'v_propuestas_sin_leer' => TRUE,
				'busquedas' => TRUE,
			);
			
			$permiso = $accesos[$url];	
			
			if($permiso==FALSE){ 
				$_SESSION['msg_error'] = "NO CUENTA CON PRIVILEGIOS PARA ESA ACCION.";
				header('Location: /marketingNet/control/personal/fail_credentials.php');
				exit;
			}
	}
	
}


?>