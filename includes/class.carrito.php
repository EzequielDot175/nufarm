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
var $color;
var $jsonData;
var $database; // Instance of class database


/* CONSTRUCTOR METHOD */

function carrito(){

$this->database = new Database();

}

public function talle($id){
	$sql = "SELECT nombre_talle FROM talles WHERE id_talle = ".$id;

	$result =  $this->database->query($sql);
	$result = $this->database->result;
	return mysql_fetch_object($result);
}


function getintContador(){return $this->intContador;}
function getidUsuario(){return $this->idUsuario;}
function getidProducto(){return $this->idProducto;}
function getintCantidad(){return $this->intCantidad;}
function getintTransaccion(){return $this->intTransaccion;}
function gettalle(){return $this->talle;}
function getcolor(){return $this->color;}

/* SETTER METHODS */
function setintContador($val){ $this->intContador =  $val;}
function setidUsuario($val){ $this->idUsuario =  $val;}
function setidProducto($val){ $this->idProducto =  $val;}
function setintCantidad($val){ $this->intCantidad =  $val;}
function setintTransaccion($val){ $this->intTransaccion =  $val;}
function settalle($val){ $this->talle =  $val;}
function setcolor($val){ $this->color =  $val;}

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
$this->color = $row->color;
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
$this->color = $row->color;
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

function select_by_usuario_producto_color($id_usuario, $id_producto, $id_color){
$sql ="SELECT * FROM carrito WHERE idUsuario = $id_usuario AND idProducto = $id_producto AND color = $id_color;";
$result =  $this->database->query($sql);
$result = $this->database->result;
$row = mysql_fetch_object($result);
$this->intContador = $row->intContador;
$this->idUsuario = $row->idUsuario;
$this->idProducto = $row->idProducto;
$this->intCantidad = $row->intCantidad;
$this->intTransaccion = $row->intTransaccion;
$this->color = $row->color;
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

function chequear_producto_con_color($id_usuario,$id_producto, $id_color){
$sql ="SELECT intCantidad FROM carrito WHERE idUsuario = $id_usuario AND idProducto = $id_producto AND color= $id_color;";
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
include_once("class.colores_productos.php");
include_once("class.talles.php");
include_once("class.colores.php");
include_once("class.historiales.php");
include_once("class.historiales.php");
require_once('control/resources/pdo.php');

require_once("control/productos/classes/class.tallesColores.php");


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
$id_color = $row['color'];

//Traigo precio de los productos
$productos= new productos();
$productos->select($idProducto);
$dblPrecio=$productos->getdblPrecio();
$strNombre=$productos->getstrNombre();
$strDetalle=$productos->getstrDetalle();
$intCategoria=$productos->getintCategoria();
$strintStock=$productos->getintStock();
$estado_producto=1;
$cat = new categorias();
$cat->select($intCategoria);
$requiere_talles = $cat->gettalles();



if($requiere_talles==1){

	try {
		$stock = new TempStock();
		echo $stock->removeTempStock($row['idUsuario'],$row['idProducto'],$row['talle'],null,$requiere_talles);
	} catch (Exception $e) {
		echo($e->getMessage());
	}

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
				
				
				$detalle_productos .= '
				<div class="purchase">
				<img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" width="8" height="11">
				<span class="tit22"> '.$strNombre.'</span>
				<span class="cant"> Cant: '.$intCantidad.' </span>
				<span class="cant"> Talle: '.$nombre_de_talle.' </span>
				<span class="tot_1"> $'.$dblPrecio.'</span>
				<span class="tot_2"> Total: $ '.$intCantidad * $dblPrecio.'</span></div>';
				
				//quito del stock
				$detalle_para_guardar_por_id[] = array(
				'id_producto' => $idProducto, 
				'nombre' => $strNombre,
				'talle' => $nombre_de_talle,
				'estado_producto' => $estado_producto,
				'detalle' => $strDetalle,
				'cantidad' => $intCantidad,
				'precio_pagado' => $intCantidad * $dblPrecio
				);
				
			
				// $taproductos= new talles_productos();
				// $taproductos->select_by_producto($idProducto,$id_talle);
				// $id_talle_producto = $taproductos->getid();
				
				// $upcantidad = new talles_productos();
				// $upcantidad->select($id_talle_producto);
				// $upcantidad->cantidad = $cantidad_stock_con_talles - $intCantidad;
				// $upcantidad->update($id_talle_producto);
				
				
				$total = $dblPrecio * $intCantidad;
				
			}else{
				$detalle_productos .='<p>&#8226; <span style="font-size:10px"> ID:'.$idProducto.'</span> '.$strNombre.'<br> Cantidad solicitada:'.$intCantidad.',  NO DISPONIBLE - $ 0.00 </p>';
				$total = 0;
				$detalle_para_guardar_por_id[] = array(
				'id_producto' => $idProducto, 
				'nombre' => $strNombre,
				'detalle' => $strDetalle,
				'cantidad' => $intCantidad,
				'precio_pagado' => 0
				);
			}
			
	
	
}else if($requiere_talles==2){


	try {
		$stock = new TempStock();
		echo $stock->removeTempStock($row['idUsuario'],$row['idProducto'],null,$row['color'],$requiere_talles);
	} catch (Exception $e) {
		echo($e->getMessage());
	}
	#############################################
	// REQUIERE COLORES
	#############################################
	//compruebo que haya producto en stock
	//traigo el stock del producto desde talles_productos
	$col_prod = new colores_productos();
	$col_prod->select_by_producto($idProducto, $id_color);
	$cantidad_stock_con_colores = $col_prod->getcantidad();
	
	
	
			if($cantidad_stock_con_colores >=$intCantidad){
			
				$nom_color = new colores();
				$nom_color->select($id_color);
				$nombre_de_color = $nom_color->getnombre_color();
				
				
				$detalle_productos .= '
				<div class="purchase">
				<img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" width="8" height="11">
				<span class="tit22"> '.$strNombre.'</span>
				<span class="cant"> Cant: '.$intCantidad.' </span>
				<span class="cant"> Color: '.$nombre_de_color.' </span>
				<span class="tot_1"> $'.$dblPrecio.'</span>
				<span class="tot_2"> Total: $ '.$intCantidad * $dblPrecio.'</span></div>';
				
				//quito del stock
				$detalle_para_guardar_por_id[] = array(
				'id_producto' => $idProducto, 
				'nombre' => $strNombre,
				'color' => $nombre_de_color,
				'estado_producto' => $estado_producto,
				'detalle' => $strDetalle,
				'cantidad' => $intCantidad,
				'precio_pagado' => $intCantidad * $dblPrecio
				);
				
			
				// $taproductos= new colores_productos();
				// $taproductos->select_by_producto($idProducto,$id_color);
				// $id_color_producto = $taproductos->getid();
				
				// $upcantidad = new colores_productos();
				// $upcantidad->select($id_color_producto);
				// $upcantidad->cantidad = $cantidad_stock_con_colores - $intCantidad;
				// $upcantidad->update($id_color_producto);
				
				
				$total = $dblPrecio * $intCantidad;
				
			}else{
				$detalle_productos .='<p>&#8226; <span style="font-size:10px"> ID:'.$idProducto.'</span> '.$strNombre.'<br> Cantidad solicitada:'.$intCantidad.',  NO DISPONIBLE - $ 0.00 </p>';
				$total = 0;
				$detalle_para_guardar_por_id[] = array(
				'id_producto' => $idProducto, 
				'nombre' => $strNombre,
				'detalle' => $strDetalle,
				'cantidad' => $intCantidad,
				'precio_pagado' => 0
				);
			}
			
	
	
}elseif ($requiere_talles==3) {
	
	$x = new tallesColores();

	/**
	 * example of basic @ TempStock
	 * @param userid 
	 * @param product_id 
	 * @param talle 
	 * @param color 
	 * @return nothing on success, throw on error 
	 */

	try {
		$stock = new TempStock();
		echo $stock->removeTempStock($row['idUsuario'],$row['idProducto'],$row['talle'],$row['color'],$requiere_talles);
	} catch (Exception $e) {
		echo($e->getMessage());
	}



	$talles = $x->talles();				
	$colores = $x->colores();				
	
	$nom_talle = $talles[$row['talle']];
	$nom_color = $colores[$row['color']];
	
		$detalle_productos .= '
		<div class="purchase">
		<img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" width="8" height="11">
		<span class="tit22"> '.$strNombre.'</span>
		<span class="cant"> Cant: '.$intCantidad.' </span>
		<span class="cant"> Color: '.$nom_color.' </span>
		<span class="cant"> Talle: '.$nom_talle.' </span>
		<span class="tot_1"> $'.$dblPrecio.'</span>
		<span class="tot_2"> Total: $ '.$intCantidad * $dblPrecio.'</span></div>';
				
				//quito del stock
		$detalle_para_guardar_por_id[] = array(
		'id_producto' => $idProducto, 
		'nombre' => $strNombre,
		'color' => $nom_color,
		'talle' => $nom_talle,
		'estado_producto' => $estado_producto,
		'detalle' => $strDetalle,
		'cantidad' => $intCantidad,
		'precio_pagado' => $intCantidad * $dblPrecio
		);
				
		$total = $dblPrecio * $intCantidad;
				


}else{


	try {
		$stock = new TempStock();
		echo $stock->removeTempStock($row['idUsuario'],$row['idProducto'],null,null,0);
	} catch (Exception $e) {
		echo($e->getMessage());
	}
	#############################################
	//NO REQUIERE TALLES
	#############################################
	//compruebo que haya producto en stock
	if($strintStock >=1){
	   	$detalle_productos .= '<div class="purchase">
		<img src="http://www.productosnufarm.com.ar/imagenes/marketingnet-mail_FLECHITA-04.jpg" width="8" height="11">
		<span class="tit22"> '.$strNombre.'</span>
		<span class="cant"> Cant: '.$intCantidad.' </span>
		<span class="cant"> </span>
		<span class="tot_1"> $'.$dblPrecio.'</span>
		<span class="tot_2"> Total: $ '.$intCantidad * $dblPrecio.'</span></div>';
	   	$detalle_para_guardar_por_id[] = array(
	   	'id_producto' => $idProducto, 
	   	'nombre' => $strNombre,
	   	'detalle' => $strDetalle,
	   	'cantidad' => $intCantidad,
		'estado_producto' => $estado_producto,
	   	'precio_pagado' => $intCantidad * $dblPrecio
	   	);
	
	
		
		//quito del stock
	   	// $productos= new productos();
	   	// $productos->select($idProducto);
	   	// $productos->intStock=$strintStock - $intCantidad;
	   	// $productos->update($idProducto);
	   	
	   	
	   	$total = $dblPrecio * $intCantidad;
	   	
   	}else{
	   	$detalle_productos .='<p>&#8226; <span style="font-size:10px">  ID:'.$idProducto.'</span> '.$strNombre.', <br> Cant: NO DISPONIBLE - $ 0.00 </p>';
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
	$detalle_titulo ="<div class='purchase_container'><h2 class='finalizado'>Su canje se realizo de forma exitosa!</h2>";
	$detalle_productos .='</div>
	<div class="purchase_end">Total final: $'.$valor_general.'</div> 
	
	<!--<span style="font-size:10px; text-transform:uppercase;">Con IVA:</span> 
	$'.$final_con_iva.'</p>-->
	
	<a class="btn-micuenta77" href="mi_cuenta.php?activo=2">
		<span>VOLVER A MI CUENTA</span>
	</a>
	</div>
	
	';
	
}else{
	$detalle_titulo ="<p>Error al procesar pago. importe: $valor_general</p> ";
}


if($valor_general >= 1){
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
	$compra->insert_detalle_productos($last_compra, $item_to_save['id_producto'],$item_to_save['nombre'],$item_to_save['detalle'],$item_to_save['cantidad'],$item_to_save['precio_pagado'],$item_to_save['estado_producto'], $item_to_save['talle'], $item_to_save['color']);
	$k++;

	

}




















/* borro del carrito del usuario los items*/
$this->delete($idUsuario);

return $detalle_titulo.''.$detalle_productos;



}else{}
}



/* DELETE */
function delete($id){
$sql = "DELETE FROM carrito WHERE idUsuario = $id;";
$result = $this->database->query($sql);

}


/* INSERT */

function insert(){
$this->idCompra = ""; // clear key for autoincrement

$sql = "INSERT INTO carrito ( intContador,idUsuario,idProducto,intCantidad,intTransaccion,talle,color) VALUES ( '$this->intContador','$this->idUsuario','$this->idProducto','$this->intCantidad','$this->intTransaccion','$this->talle','$this->color')";
$result = $this->database->query($sql);
$this->idCompra = mysql_insert_id($this->database->link);

}

function update($id){

$sql = " UPDATE carrito SET   idUsuario = '$this->idUsuario', idProducto = '$this->idProducto', intCantidad = '$this->intCantidad', intTransaccion = '$this->intTransaccion', talle = '$this->talle', color = '$this->color' WHERE intContador = $id "; 
 $result = $this->database->query($sql);
}



} // class : end

?>