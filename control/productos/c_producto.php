<?php include_once('../resources/control.php'); error_reporting(0); header('Content-Type: text/html; charset=utf-8');

include_once('helper_titulos.php');

#include_once('../resources/includes.php'); 

$strNombre=$_POST['strNombre'];
$strDetalle=$_POST['strDetalle'];
$intCategoria=$_POST['intCategoria'];
$dblPrecio=$_POST['dblPrecio'];
$intStock=$_POST['intStock'];
$strImagen=$_POST['strImagen'];
$strImagen2=$_POST['strImagen2'];
$strImagen3=$_POST['strImagen3'];
$destacado=$_POST['destacado'];

$talles=$_POST['talle'];
$color=$_POST['color'];





if($_FILES['strImagen']['name']!=""){
include_once('../resources/class.upload.php');
      $yukle = new upload;
      $yukle->set_max_size(99999999);
      $yukle->set_directory('../../images_productos');
      $yukle->set_tmp_name($_FILES['strImagen']['tmp_name']);
      $yukle->set_file_size($_FILES['strImagen']['size']);
      $yukle->set_file_type($_FILES['strImagen']['type']);
      //random
      $random = substr(md5(rand()),0,6);
      $avatarname= $random.'_'.$_FILES['strImagen']['name'];
      $nombre_final = str_replace(' ','-',$avatarname);
      $yukle->set_file_name($nombre_final);
      $yukle->start_copy();
      $yukle->resize(620,0);
      $yukle->set_thumbnail_name('tn_'.$nombre_final);
      $yukle->create_thumbnail();
      $yukle->set_thumbnail_size(300, 0);
      if($yukle->is_ok()){

      $strImagen =$nombre_final;
      }else{
      //si hay error cargo sin imagen
      $strImagen ="";

      }



}

/**/

if($_FILES['strImagen2']['name']!=""){
include_once('../resources/class.upload.php');
      $yukle = new upload;
      $yukle->set_max_size(99999999);
      $yukle->set_directory('../../images_productos');
      $yukle->set_tmp_name($_FILES['strImagen2']['tmp_name']);
      $yukle->set_file_size($_FILES['strImagen2']['size']);
      $yukle->set_file_type($_FILES['strImagen2']['type']);
      //random
      $random = substr(md5(rand()),0,6);
      $avatarname= $random.'_'.$_FILES['strImagen']['name'];
      $nombre_final = str_replace(' ','-',$avatarname);
      $yukle->set_file_name($nombre_final);
      $yukle->start_copy();
      $yukle->resize(620,0);
      $yukle->set_thumbnail_name('tn_'.$nombre_final);
      $yukle->create_thumbnail();
      $yukle->set_thumbnail_size(300, 0);
      if($yukle->is_ok()){

      $strImagen2 =$nombre_final;
      }else{
      //si hay error cargo sin imagen
      $strImagen2 ="";

      }



}

/**/
if($_FILES['strImagen3']['name']!=""){
include_once('../resources/class.upload.php');
      $yukle = new upload;
      $yukle->set_max_size(99999999);
      $yukle->set_directory('../../images_productos');
      $yukle->set_tmp_name($_FILES['strImagen3']['tmp_name']);
      $yukle->set_file_size($_FILES['strImagen3']['size']);
      $yukle->set_file_type($_FILES['strImagen3']['type']);
      //random
      $random = substr(md5(rand()),0,6);
      $avatarname= $random.'_'.$_FILES['strImagen3']['name'];
      $nombre_final = str_replace(' ','-',$avatarname);
      $yukle->set_file_name($nombre_final);
      $yukle->start_copy();
      $yukle->resize(620,0);
      $yukle->set_thumbnail_name('tn_'.$nombre_final);
      $yukle->create_thumbnail();
      $yukle->set_thumbnail_size(300, 0);
      if($yukle->is_ok()){

      $strImagen3 =$nombre_final;
      }else{
      //si hay error cargo sin imagen
      $strImagen3 ="";

      }



}
/* INSERT */


if($talles!=""){
	$stockTallesColor=1;
	//guardo talles en tabla talles_productos
	include_once("classes/class.productos.php");
	$productos= new productos();
	$productos->idProducto=$idProducto;
	$productos->strNombre=$strNombre;
	$productos->strDetalle=$strDetalle;
	$productos->intCategoria=$intCategoria;
	$productos->intStock=$stockTallesColor;
	$productos->dblPrecio=$dblPrecio;
	$productos->strImagen=$strImagen;
	$productos->strImagen2=$strImagen2;
	$productos->strImagen3=$strImagen3;
	$productos->destacado=$destacado;		
	$last_inserted = $productos->insert();
	
	include_once('classes/class.talles_productos.php');
	
	foreach($talles as $talle => $cantidad){

		$ins_talles = new talles_productos();
		$ins_talles->id_talle=$talle;
		$ins_talles->id_producto=$last_inserted;
		$ins_talles->cantidad=$cantidad;
		$ins_talles->insert();
	
	}
	include_once('classes/class.colores_productos.php');
	
	foreach($talles as $talles => $cantidad){

		$ins_color = new colores_productos();
		$ins_color->id_color=$talles;
		$ins_color->id_producto=$last_inserted;
		$ins_color->cantidad=$cantidad;
		$ins_color->insert();
	}
}
else
{
	//guardo talle de forma normal, en la misma tabla (no require talles)
	include_once("classes/class.productos.php");
	$productos= new productos();
	$productos->idProducto=$idProducto;
	$productos->strNombre=$strNombre;
	$productos->strDetalle=$strDetalle;
	$productos->intCategoria=$intCategoria;
	$productos->dblPrecio=$dblPrecio;
	$productos->intStock=$intStock;
	$productos->strImagen=$strImagen;
	$productos->strImagen2=$strImagen2;
	$productos->strImagen3=$strImagen3;
	$productos->destacado=$destacado;
	var_dump($productos->insert());
}


#echo '<div class="notify"><p>producto Creada!</p><p><a href="v_productos.php">Regresar</a></p></div>';
$_SESSION['msg_ok'] = 'Producto Creado!';
header('Location: '.BASEURL.'productos/v_productos.php');
?>