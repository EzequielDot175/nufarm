<?php 
ob_start();

// error_reporting(E_ALL);
// ini_set('display_errors', 'On');

include_once('../resources/control.php'); 
include_once("classes/class.productos.php");
include_once("classes/class.tallesColores.php");
require_once('../../libs.php');

error_reporting(E_ALL);
ini_set('display_errors', 'On');


$idProducto = $_POST['idProducto'];
$strNombre=$_POST['strNombre'];
$intMinCompra = (int)$_POST["intMinCompra"];
$intMaxCompra = ( (int)$_POST["intMaxCompra"] == 0 ? NULL : (int)$_POST["intMaxCompra"] );
$strDetalle=$_POST['strDetalle'];
$intCategoria=$_POST['intCategoria'];
$dblPrecio=$_POST['dblPrecio'];
$intStock=	$_POST['intStock'];
$destacado=$_POST['destacado'];

$message = (empty($_POST['message']) ? '' : $_POST['message']); 

$talles = $_POST['talle'];
$color = $_POST['color'];





/**
 * PHP magico....
 */

core\Upload::ifExist('strImagen',function($class){
	
	$file = $class::file('strImagen');
	/**
	 * Seteo donde se va a guardar
	 */
	$producto = new Producto();
	$id = $_POST['idProducto'];

	
	
	$class::$dir = $class::$DIR_IMG_PROD;
	$class::$randomName = true;
	if($class->uploadFile($file)):
		$producto->updImage($class::$uploadedFileName,$id);
	endif;


});



$prod = new Producto();
$prod->updCategoria($intCategoria, $idProducto);







if($talles!=""){
	die("1");

	//limpio si habia algo en stock
	$productos= new productos();
	$productos->select($idProducto);
	
	$sumatoria_talles_total = array_sum($talles);
	if($sumatoria_talles_total==0){$stockTalles=0;}else{$stockTalles=1;}
	$productos->intStock = $sumatoria_talles_total;
	
// 	echo "<pre>";
// print_r($sumatoria_talles_total);
// die();
	$productos->update($idProducto);
	//Limpio talles anteriores
	include_once('classes/class.talles_productos.php');
	$ins_talles = new talles_productos();
	$ins_talles->clean_by_producto($idProducto);
	/* UPDATE */
	include_once("classes/class.productos.php");
	$productos= new productos();
	$productos->select($idProducto);
	$productos->idProducto=$idProducto;
	$productos->strNombre=$strNombre;
	$productos->strDetalle=$strDetalle;
	$productos->intCategoria=$intCategoria;
	$productos->intStock=$sumatoria_talles_total;
	$productos->dblPrecio=$dblPrecio;
	$productos->destacado=$destacado;
	$productos->intMinCompra=$intMinCompra;	
	$productos->intMaxCompra=$intMaxCompra;	
	$productos->update($idProducto);
	$productos->message = $message;
	
	
	#var_dump($talles);
	foreach($talles as $key => $cantidad){
		$talles[$cantidad].' - cant:'.$cantidad;
		$ins_talles = new talles_productos();
		$ins_talles->id_talle=$key;
		$ins_talles->id_producto=$idProducto;
		$ins_talles->cantidad=$cantidad;
		$ins_talles->insert_update();
	
	}


	$msg_final .= '<div class="notify"><p>producto actualizado! <a href="../productos/e_producto.php?id='.$idProducto.'&activo=2&sub=d">Ver</a></p></div>';
}

// var_dump($color);
else if($color)
{	

	include_once('classes/class.colores_productos.php');


	include_once("classes/class.productos.php");
	


	


	//limpio si habia algo en stock
	$productos= new productos();
	$productos->select($idProducto);
	

	
	$sumatoria_colores_total = array_sum($color);

	
	
	$productos->intStock = $sumatoria_colores_total;
	$productos->message = $message;
	$productos->update($idProducto);


	//Limpio talles anteriores
	// $ins_color= new colores_productos();
	// $ins_color->clean_by_producto($idProducto);



	/* UPDATE */
	$productos= new productos();
	$productos->select($idProducto);
	$productos->idProducto=$idProducto;
	$productos->strNombre=$strNombre;
	$productos->strDetalle=$strDetalle;
	$productos->intCategoria=$intCategoria;
	$productos->intStock=$sumatoria_colores_total;
	$productos->dblPrecio=$dblPrecio;
	$productos->destacado=$destacado;
	$productos->intMinCompra=$intMinCompra;		
	$productos->intMaxCompra=$intMaxCompra;		
	$productos->message = $message;
	$productos->update($idProducto);

	


	$colours = new colores_productos();
	$colours->updateAllColours($color,$idProducto);


	$msg_final .= '<div class="notify"><p>producto actualizado! <a href="../productos/e_producto.php?id='.$idProducto.'&activo=2&sub=d">Ver</a></p></div>';
}
elseif (isset($_POST["color_talle"])) {





	$x = new tallesColores();

	$x->idProducto=$idProducto;
	$x->strNombre=$strNombre;
	$x->strDetalle=$strDetalle;
	$x->intCategoria=$intCategoria;
	$x->intStock=$sumatoria_colores_total;
	$x->dblPrecio=$dblPrecio;
	$x->destacado=$destacado;
	$x->intMinCompra=$intMinCompra;		
	$x->intMaxCompra=$intMaxCompra;
	$x->message = $message;	
	$x->save();

	foreach($_POST["color_talle"] as $k => $v):
		try {
			$x->add($v,$idProducto,$v['color']);
		} catch (Exception $e) {
			echo($e->getMessage());
		}
	endforeach;
	$x->execProdStock($idProducto);



}
else
{

	//guardo talles en tabla talles_productos
	
	//Limpio talles anteriores
	include_once('classes/class.talles_productos.php');
	$ins_talles = new talles_productos();
	$ins_talles->clean_by_producto($idProducto);
	
	
	/* UPDATE */
	include_once("classes/class.productos.php");
	$productos= new productos();

	$productos->select($idProducto);
	$productos->idProducto=$idProducto;
	$productos->strNombre=$strNombre;
	$productos->strDetalle=$strDetalle;
	$productos->intCategoria=$intCategoria;
	$productos->dblPrecio=$dblPrecio;
	$productos->intStock=$intStock;
	$productos->destacado=$destacado;
	$productos->intMinCompra=$intMinCompra;
	$productos->intMaxCompra= (is_null($intMaxCompra) ? 'NULL' : $intMaxCompra);
	$productos->message = $message;
	$productos->update($idProducto);

	$msg_final .= '<div class="notify"><p>producto actualizado!</p></div>';

	
	// echo "<pre>";
	// print_r($_POST);
	// echo "</pre>";
	// die();

}





// $_SESSION['msg_ok'] = $msg_final;
@header('Location: ./v_productos.php?activo=2&sub=d');
exit();

?>