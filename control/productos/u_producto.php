<?php 

error_reporting(E_ALL);
ini_set('display_error', 'on');

include_once('../resources/control.php'); 
include_once("classes/class.productos.php");
include_once("classes/class.tallesColores.php");

// error_reporting(E_ALL);

$idProducto = $_POST['idProducto'];
$strNombre=$_POST['strNombre'];
$intMinCompra = (int)$_POST["intMinCompra"];
$intMaxCompra = ( (int)$_POST["intMaxCompra"] == 0 ? NULL : (int)$_POST["intMaxCompra"] );
$strDetalle=$_POST['strDetalle'];
$intCategoria=$_POST['intCategoria'];
$dblPrecio=$_POST['dblPrecio'];
$intStock=	$_POST['intStock'];
$strImagen=	$_POST['strImagen'];
$strImagen2=$_POST['strImagen2'];
$strImagen3=$_POST['strImagen3'];
$destacado=$_POST['destacado'];

$talles = $_POST['talle'];
$color = $_POST['color'];




// if($_FILES['strImagen']['name']!=""){

//       $nombre_final="";

//       	$productos= new productos();
// 		$productos->select($idProducto);
//       	$imagen=$productos->getstrImagen();

//       if($imagen!=""){
//       unlink('../../images_productos/'.$imagen);
//       unlink('../../images_productos/tn_'.$imagen);
//       }
//       include_once('../resources/class.upload.php');
//       $yukle = new upload;
//       $yukle->set_max_size(99999999);
//       $yukle->set_directory('../../images_productos');
//       $yukle->set_tmp_name($_FILES['strImagen']['tmp_name']);
//       $yukle->set_file_size($_FILES['strImagen']['size']);
//       $yukle->set_file_type($_FILES['strImagen']['type']);
//       //random
//       $random = substr(md5(rand()),0,6);
//       $avatarname= $random.'_'.$_FILES['strImagen']['name'];
//       $nombre_final = str_replace(' ','-',$avatarname);
//       $yukle->set_file_name($nombre_final);
//       $yukle->start_copy();
//       $yukle->resize(620,0);
//       $yukle->set_thumbnail_name('tn_'.$nombre_final);
//       $yukle->create_thumbnail();
//       $yukle->set_thumbnail_size(300, 0);
//       if($yukle->is_ok()){
//       /* INSERT */

//       /* UPDATE */

// 			include_once("classes/class.productos.php");
// 			$productos= new productos();

// 			$productos->select($idProducto);
// 			$productos->strImagen=$nombre_final;
// 			$productos->update($idProducto);


//       }else{
//       $msg_final .= '<div class="notify"><p>Ocurrio un error al actualizar la imagen1. Imagen1 no actualizada!</p></div>';
//       }



// }

// /**/
// if($_FILES['strImagen2']['name']!=""){

//       $nombre_final="";

//       	$productos= new productos();
// 		$productos->select($idProducto);
//       	$imagen=$productos->getstrImagen2();

//       if($imagen!=""){
//       unlink('../../images_productos/'.$imagen);
//       unlink('../../images_productos/tn_'.$imagen);
//       }
//       include_once('../resources/class.upload.php');
//       $yukle = new upload;
//       $yukle->set_max_size(99999999);
//       $yukle->set_directory('../../images_productos');
//       $yukle->set_tmp_name($_FILES['strImagen2']['tmp_name']);
//       $yukle->set_file_size($_FILES['strImagen2']['size']);
//       $yukle->set_file_type($_FILES['strImagen2']['type']);
//       //random
//       $random = substr(md5(rand()),0,6);
//       $avatarname= $random.'_'.$_FILES['strImagen2']['name'];
//       $nombre_final = str_replace(' ','-',$avatarname);
//       $yukle->set_file_name($nombre_final);
//       $yukle->start_copy();
//       $yukle->resize(620,0);
//       $yukle->set_thumbnail_name('tn_'.$nombre_final);
//       $yukle->create_thumbnail();
//       $yukle->set_thumbnail_size(300, 0);
//       if($yukle->is_ok()){
//       /* INSERT */

//       /* UPDATE */

// 			include_once("classes/class.productos.php");
// 			$productos= new productos();

// 			$productos->select($idProducto);
// 			$productos->strImagen2=$nombre_final;
// 			$productos->update($idProducto);


//       }else{
//       $msg_final .= '<div class="notify"><p>Ocurrio un error al actualizar la imagen2. Imagen2 no actualizada!</p></div>';
//       }



// }

// /**/
// if($_FILES['strImagen3']['name']!=""){
// 	$nombre_final="";
      
//       	$productos= new productos();
// 		$productos->select($idProducto);
//       	$imagen=$productos->getstrImagen3();

//       if($imagen!=""){
//       unlink('../../images_productos/'.$imagen);
//       unlink('../../images_productos/tn_'.$imagen);
//       }
//       include_once('../resources/class.upload.php');
//       $yukle = new upload;
//       $yukle->set_max_size(99999999);
//       $yukle->set_directory('../../images_productos');
//       $yukle->set_tmp_name($_FILES['strImagen3']['tmp_name']);
//       $yukle->set_file_size($_FILES['strImagen3']['size']);
//       $yukle->set_file_type($_FILES['strImagen3']['type']);
//       //random
//       $random = substr(md5(rand()),0,6);
//       $avatarname= $random.'_'.$_FILES['strImagen3']['name'];
//       $nombre_final = str_replace(' ','-',$avatarname);
//       $yukle->set_file_name($nombre_final);
//       $yukle->start_copy();
//       $yukle->resize(620,0);
//       $yukle->set_thumbnail_name('tn_'.$nombre_final);
//       $yukle->create_thumbnail();
//       $yukle->set_thumbnail_size(300, 0);
//       if($yukle->is_ok()){
//       /* INSERT */

//       /* UPDATE */

// 			include_once("classes/class.productos.php");
// 			$productos= new productos();

// 			$productos->select($idProducto);
// 			$productos->strImagen3=$nombre_final;
// 			$productos->update($idProducto);


//       }else{
//       $msg_final .= '<div class="notify"><p>Ocurrio un error al actualizar la imagen3. Imagen3 no actualizada!</p></div>';
//       }



// }
// var_dump($talles);


if($talles!=""){
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

	
	//limpio si habia algo en stock
	$productos= new productos();
	$productos->select($idProducto);
	
	$sumatoria_colores_total = array_sum($color);

	
	
	$productos->intStock = $sumatoria_colores_total;
		
	$productos->update($idProducto);
	//Limpio talles anteriores
	include_once('classes/class.colores_productos.php');
	// $ins_color= new colores_productos();
	// $ins_color->clean_by_producto($idProducto);
	/* UPDATE */
	include_once("classes/class.productos.php");
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
	$productos->intMaxCompra=$intMaxCompra;
	$productos->update($idProducto);

	$msg_final .= '<div class="notify"><p>producto actualizado!</p></div>';


}


$_SESSION['msg_ok'] = $msg_final;
header('Location: ./v_productos.php?activo=2&sub=d');

?>