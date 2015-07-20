<?php

include_once("Connections/class.database.php");

/* CLASS DECLARATION */


class carrito{ 
// class : begin
/* ATTRIBUTE DECLARATION */
var $idCompra;   // KEY ATTR. WITH AUTOINCREMENT
var $intContador;
var $idUsuario;
var $idProducto;
var $intCantidad;
var $intTransaccion;
var $talle;
var $database; // Instance of class database


/* CONSTRUCTOR METHOD */

function carrito(){

$this->database = new Database();

}


function getintContador(){return $this->intContador;}
function getidUsuario(){return $this->idUsuario;}
function getidProducto(){return $this->idProducto;}
function getintCantidad(){return $this->intCantidad;}
function getintTransaccion(){return $this->intTransaccion;}
function gettalle(){return $this->talle;}

/* SETTER METHODS */
function setintContador($val){ $this->intContador =  $val;}
function setidUsuario($val){ $this->idUsuario =  $val;}
function setidProducto($val){ $this->idProducto =  $val;}
function setintCantidad($val){ $this->intCantidad =  $val;}
function setintTransaccion($val){ $this->intTransaccion =  $val;}
function settalle($val){ $this->talle =  $val;}

/* SELECT METHOD / LOAD */
function select($id){
$sql =  "SELECT * FROM carrito WHERE intContador = $id;";
$result =  $this->database->query($sql);
$result = $this->database->result;
$row = mysql_fetch_object($result);
$this->intContador = $row->intContador;
$this->idUsuario = $row->idUsuario;
$this->idProducto = $row->idProducto;
$this->intCantidad = $row->intCantidad;
$this->intTransaccion = $row->intTransaccion;
$this->talle = $row->talle;
}

function select_by_usuario_producto($id_usuario, $id_producto){
$sql ="SELECT * FROM carrito WHERE idUsuario = $id_usuario AND idProducto = $id_producto;";
$result =  $this->database->query($sql);
$result = $this->database->result;
$row = mysql_fetch_object($result);
$this->intContador = $row->intContador;
$this->idUsuario = $row->idUsuario;
$this->idProducto = $row->idProducto;
$this->intCantidad = $row->intCantidad;
$this->intTransaccion = $row->intTransaccion;
$this->talle = $row->talle;
}

function select_by_usuario_producto_talle($id_usuario, $id_producto, $id_talle){
$sql ="SELECT * FROM carrito WHERE idUsuario = $id_usuario AND idProducto = $id_producto AND talle = $id_talle;";
$result =  $this->database->query($sql);
$result = $this->database->result;
$row = mysql_fetch_object($result);
$this->intContador = $row->intContador;
$this->idUsuario = $row->idUsuario;
$this->idProducto = $row->idProducto;
$this->intCantidad = $row->intCantidad;
$this->intTransaccion = $row->intTransaccion;
$this->talle = $row->talle;
}




function chequear_producto($id_usuario,$id_producto){
$sql ="SELECT * FROM carrito WHERE idUsuario = $id_usuario AND idProducto = $id_producto;";
$result =  $this->database->query($sql);
$result = $this->database->result;
while($row = mysql_fetch_array($result)){
$id_row = $row['intContador'];
$intCantidad[] = $row['intCantidad'];
}

return $intCantidad[0];

}


function chequear_producto_con_talle($id_usuario,$id_producto, $id_talle){
$sql ="SELECT intCantidad FROM carrito WHERE idUsuario = $id_usuario AND idProducto = $id_producto AND talle = $id_talle;";
$result =  $this->database->query($sql);
$result = $this->database->result;
while($row = mysql_fetch_array($result)){
$id_row = $row['intContador'];
$intCantidad[] = $row['intCantidad'];
}

return $intCantidad[0];

}

/* SELECT ALL */
function select_by_user($idUsuario,$tipoDePago, $IVA ){

//incluye classes necesarias
include_once("class.categorias.php");
include_once("class.productos.php");
include_once("class.compras.php");
include_once("class.usuarios.php");
include_once("class.talles_productos.php");
include_once("class.talles.php");
include_once("class.historiales.php");

//variables de la sumas de valores, tanto de precios como total
$total = 0;
$total_general = 0;
$totales[] =0;

$sql ="SELECT * FROM carrito WHERE idUsuario = $idUsuario;";
$result = $this->database->query($sql);
$result = $this->database->result;


$detalle_productos ="";
while($row = mysql_fetch_array($result)){
$intContador = $row['intContador'];
$idUsuario = $row['idUsuario'];
$idProducto = $row['idProducto'];
$intCantidad = $row['intCantidad'];
$intTransaccion = $row['intTransaccion'];
$id_talle = $row['talle'];

//Traigo precio de los productos
$productos= new productos();
$productos->select($idProducto);
$dblPrecio=$productos->getdblPrecio();
$strNombre=$productos->getstrNombre();
$strDetalle=$productos->getstrDetalle();
$intCategoria=$productos->getintCategoria();
$strintStock=$productos->getintStock();

$cat = new categorias();
$cat->select($intCategoria);
$requiere_talles = $cat->gettalles();



if($requiere_talles==1){
	#############################################
	// REQUIERE TALLES
	#############################################
	//compruebo que haya producto en stock
	//traigo el stock del producto desde talles_productos
	$tall_prod = new talles_productos();
	$tall_prod->select_by_producto($idProducto, $id_talle);
	$cantidad_stock_con_talles = $tall_prod->getcantidad();
	
	
	
	if($cantidad_stock_con_talles >=$intCantidad){
	
		$nom_talle = new talles();
		$nom_talle->select($id_talle);
		$nombre_de_talle = $nom_talle->getnombre_talle();
		
		
	   	$detalle_productos .= '<p> ID:'.$idProducto.', '.$strNombre.', ('.$nombre_de_talle.') Cant:'.$intCantidad.' x $'.$dblPrecio.' = '.$intCantidad * $dblPrecio.'</p> ';
	   	//quito del stock
		$detalle_para_guardar_por_id[] = array(
		'id_producto' => $idProducto, 
		'nombre' => $strNombre .'('.$nombre_de_talle.')',
		'detalle' => $strDetalle,
		'cantidad' => $intCantidad,
		'precio_pagado' => $intCantidad * $dblPrecio
		);
		
	
	   	$taproductos= new talles_productos();
	   	$taproductos->select_by_producto($idProducto,$id_talle);
		$id_talle_producto = $taproductos->getid();
		
		$upcantidad = new talles_productos();
		$upcantidad->select($id_talle_producto);
		$upcantidad->cantidad = $cantidad_stock_con_talles - $intCantidad;
		$upcantidad->update($id_talle_producto);
	   	
	   	
	   	$total = $dblPrecio * $intCantidad;
	   	
   	}else{
	   	$detalle_productos .='<p> ID:'.$idProducto.', '.$strNombre.', Cantidad solicitada:'.$intCantidad.',  NO DISPONIBLE - $ 0.00 </p>';
	   	$total = 0;
	   	$detalle_para_guardar_por_id[] = array(
	   	'id_producto' => $idProducto, 
	   	'nombre' => $strNombre,
	   	'detalle' => $strDetalle,
	   	'cantidad' => $intCantidad,
	   	'precio_pagado' => 0
	   	);
   	}
	
	
	
}else{
	#############################################
	//NO REQUIERE TALLES
	#############################################
	//compruebo que haya producto en stock
	if($strintStock >=1){
	   	$detalle_productos .= '<p> ID:'.$idProducto.', '.$strNombre.', Cant:'.$intCantidad.' x $'.$dblPrecio.' = '.$intCantidad * $dblPrecio.'</p> ';
	   	$detalle_para_guardar_por_id[] = array(
	   	'id_producto' => $idProducto, 
	   	'nombre' => $strNombre,
	   	'detalle' => $strDetalle,
	   	'cantidad' => $intCantidad,
	   	'precio_pagado' => $intCantidad * $dblPrecio
	   	);
	
	
		
		//quito del stock
	   	$productos= new productos();
	   	$productos->select($idProducto);
	   	$productos->intStock=$strintStock - $intCantidad;
	   	$productos->update($idProducto);
	   	
	   	
	   	$total = $dblPrecio * $intCantidad;
	   	
   	}else{
	   	$detalle_productos .='<p> ID:'.$idProducto.', '.$strNombre.', Cant: NO DISPONIBLE - $ 0.00 </p>';
	   	$total = 0;
	   	$detalle_para_guardar_por_id[] = array(
	   	'id_producto' => $idProducto, 
	   	'nombre' => $strNombre,
	   	'detalle' => $strDetalle,
	   	'cantidad' => $intCantidad,
	   	'precio_pagado' => $intCantidad * $dblPrecio
	   	);
	   	
   	}
}
		
	   	
	   	

//Voy sumando los precios de los productos
$totales[] = $total;

}


//Total sin IVA
$valor_general = array_sum($totales);
//Total con IVA
$final_con_iva = $valor_general + $valor_general * $IVA / 100;

if($valor_general >= 1){
	$detalle_titulo ="<h3>Pago procesado.</h3>";
	$detalle_productos .='<p> Sin IVA: $'.$valor_general.', Con IVA: $'.$final_con_iva.'</p';
}else{
	$detalle_titulo ="Error al procesar pago. importe: $valor_general ";
}



//Guardo compra en tabla "compras"
$compra= new compras();
$compra->idUsuario=$idUsuario;
$compra->intTipoPago=$tipoDePago;
$compra->fthCompra=date("Y-m-d H:i:s");
$compra->dblTotal=$final_con_iva;
#$compra->idCredito=$idCredito;
$compra->detalle=$detalle_productos;
$compra->estado=1;
$last_compra = $compra->insert();  
	
//Actualizo el credito del usuario

#Primero traigo el monto actual de credito del usuario
$usuarios= new usuarios();
$usuarios->select($idUsuario);
$creditoActual=$usuarios->getdblCredito(); 

/* Realizo el UPDATE */
$usuarios= new usuarios();
$usuarios->select($idUsuario);
$usuarios->dblCredito=$creditoActual - $final_con_iva;
$usuarios->update($idUsuario);


//Guardo la modificacion en historial de credito
$monto_quedo_en = $creditoActual - $final_con_iva;
$hist = new historiales();
$hist->id_usuario = $idUsuario;
$hist->fecha = date("Y-m-d");
$hist->realizado_por = "Compra realizada";
$hist->tipo_modificacion = $modificacion ="Compra de $$final_con_iva";
$hist->monto_modificado = $monto_quedo_en;
$hist->insert();




//guardo el detalle de cada producto en detalles_compra para poder mostrar la img del producto comprado
foreach($detalle_para_guardar_por_id as $item_to_save){

	$compra= new compras();
	$compra->insert_detalle_productos($last_compra, $item_to_save['id_producto'],$item_to_save['nombre'],$item_to_save['detalle'],$item_to_save['cantidad'],$item_to_save['precio_pagado']);

}


/* borro del carrito del usuario los items*/
$this->delete($idUsuario);

return $detalle_titulo.''.$detalle_productos;




}


/* DELETE */
function delete($id){
$sql = "DELETE FROM carrito WHERE idUsuario = $id;";
$result = $this->database->query($sql);

}


/* INSERT */

function insert(){
$this->idCompra = ""; // clear key for autoincrement

$sql = "INSERT INTO carrito ( intContador,idUsuario,idProducto,intCantidad,intTransaccion, talle ) VALUES ( '$this->intContador','$this->idUsuario','$this->idProducto','$this->intCantidad','$this->intTransaccion','$this->talle' )";
$result = $this->database->query($sql);
$this->idCompra = mysql_insert_id($this->database->link);

}

function update($id){

$sql = " UPDATE carrito SET   idUsuario = '$this->idUsuario', idProducto = '$this->idProducto', intCantidad = '$this->intCantidad', intTransaccion = '$this->intTransaccion', talle = '$this->talle'WHERE intContador = $id "; 
 $result = $this->database->query($sql);
}



} // class : end

?>