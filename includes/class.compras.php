<?php

include_once("Connections/class.database.php");

/* CLASS DECLARATION */


class compras{ 
// class : begin
/* ATTRIBUTE DECLARATION */
var $idCompra;   // KEY ATTR. WITH AUTOINCREMENT
var $idUsuario;
var $fthCompra;
var $intTipoPago;
var $dblTotal;
var $idCredito;
var $detalle;
var $estado;
var $database; // Instance of class database


/* CONSTRUCTOR METHOD */

function compras(){

$this->database = new Database();

}




/* GETTER METHODS */
function getidCompra(){return $this->idCompra;}
function getidUsuario(){return $this->idUsuario;}
function getfthCompra(){return $this->fthCompra;}
function getintTipoPago(){return $this->intTipoPago;}
function getdblTotal(){return $this->dblTotal;}
function getidCredito(){return $this->idCredito;}
function getdetalle(){return $this->detalle;}
function getestado(){return $this->estado;}
function gettalle(){return $this->talle;}
function getcolor(){return $this->color;}

/* SETTER METHODS */
function setidCompra($val){ $this->idCompra =  $val;}
function setidUsuario($val){ $this->idUsuario =  $val;}
function setfthCompra($val){ $this->fthCompra =  $val;}
function setintTipoPago($val){ $this->intTipoPago =  $val;}
function setdblTotal($val){ $this->dblTotal =  $val;}
function setidCredito($val){ $this->idCredito =  $val;}
function setdetalle($val){ $this->detalle =  $val;}
function setestado($val){ $this->estado =  $val;}
function setcolor($val){ $this->color =  $val;}

/* SELECT METHOD / LOAD */
function select($id){

$sql =  "SELECT * FROM compra WHERE idCompra = $id;";
$result =  $this->database->query($sql);
$result = $this->database->result;
$row = mysql_fetch_object($result);

$this->idCompra = $row->idCompra;
$this->idUsuario = $row->idUsuario;
$this->fthCompra = $row->fthCompra;
$this->intTipoPago = $row->intTipoPago;
$this->dblTotal = $row->dblTotal;
$this->idCredito = $row->idCredito;
$this->detalle = $row->detalle;
$this->estado = $row->estado;


$sql =  "SELECT * FROM detalles_compras WHERE idCompra = $id;";
$result =  $this->database->query($sql);
$result = $this->database->result;
$row = mysql_fetch_object($result);

$this->talle = $row->talle;
}



/* DELETE */
function delete($id){
$sql = "DELETE FROM compra WHERE idCompra = $id;";
$result = $this->database->query($sql);

}


/* INSERT */

function insert(){
$this->idCompra = ""; // clear key for autoincrement

$sql = "INSERT INTO compra ( idUsuario,fthCompra,intTipoPago,dblTotal,idCredito,detalle,estado ) VALUES ( '$this->idUsuario','$this->fthCompra','$this->intTipoPago','$this->dblTotal','$this->idCredito','$this->detalle','$this->estado' )";
$result = $this->database->query($sql);
return $this->idCompra = mysql_insert_id($this->database->link);

}



function bring_detalle_compra($id_compra){
				$recuadro = '';
#include_once('productos/classes/class.productos.php');
$sql ="SELECT * FROM detalles_compras WHERE id_compra = $id_compra;";
$result = $this->database->query($sql);
$result = $this->database->result;
while($row = mysql_fetch_array($result)){
	
	$id_producto = $row['id_producto'];
	$nombre = $row['nombre'];
	$detalle = $row['detalle'];
	$talle = $row['talle'];
	$color = $row['color'];
							if($talle == 2){$talle = "S";}
							if($talle == 3){$talle = "M";}
							if($talle == 4){$talle = "L";}
							if($talle == 5){$talle = "XL";}
							if($talle == 6){$talle = "XS";}
							if($talle == 7){$talle = "XXL";}
	
	$cantidad = $row['cantidad'];
	$precio_pagado = $row['precio_pagado'];
	$estado = $row['estado_producto'];
							if($estado == 1){$estado = "Pendiente";}
							if($estado == 2){$estado = "En proceso";}
							if($estado == 3){$estado = "Entregado";}
	

	//verifico si tiene imagen
	$prod = new productos();
	$prod->select($id_producto);
	$imagen_producto = $prod->getstrImagen();
	
	if( strlen($imagen_producto) > 0 ){
		//con imagen

		$recuadro .= '
		<div id="BloqueGeneral">
		<div class="row1"></div>
		<div id="BloqueImagen" class="row2"><img src="images_productos/'.$imagen_producto.'" /></div>
		
		<!--<div class="row3">ID:'.$id_producto.'</div> -->
		<div class="row4 td_shadow"> '.$nombre.'</div> 
		<div class="row5 td_shadow">'.$cantidad.'</div> 
		<div class="row6 td_shadow">'.$talle.'</div>	
		<div class="row6 td_shadow">'.$color.'</div>			
		<div class="row7 td_shadow">$'.$precio_pagado.'</div>
		<div class="row8">'. $estado.'</div>

		</div>
		';
	
	}else{
		//sin imagen
		$recuadro .= '
		<div class="row1"></div>
		<div id="BloqueImagen" class="row2"></div>
		
		<!--<div class="row3">ID:'.$id_producto.'</div> -->
		<div class="row4 td_shadow"> '.$nombre.'</div> 
		<div class="row5 td_shadow">'.$cantidad.'</div> 
		<div class="row6 td_shadow">'.$talle.'</div>
		<div class="row6 td_shadow">'.$color.'</div>		
		<div class="row7 td_shadow">$'.$precio_pagado.'</div>
		<div class="row8">'.$estado.'</div>
		';
		
	}
	
	

}
return $recuadro;
}






function insert_detalle_productos($id_compra,$id_producto,$nombre,$detalle,$cantidad,$precio_pagado, $estado_producto ,$talle, $color){

#$this->idCompra = ""; // clear key for autoincrement
$remito = $randnum = rand(1111111111,9999999999);

$sql = "INSERT INTO detalles_compras( id_compra, id_producto, nombre, detalle, cantidad, precio_pagado, estado_producto, talle, color, remito ) VALUES ('$id_compra', '$id_producto', '$nombre', '$detalle', '$cantidad', '$precio_pagado', '$estado_producto', '$talle', '$color', ".$remito.")";
$result = $this->database->query($sql);
return $this->idCompra = mysql_insert_id($this->database->link);

}




/* UPDATE */

function update($id){

$sql = " UPDATE compra SET  idUsuario = '$this->idUsuario',fthCompra = '$this->fthCompra',intTipoPago = '$this->intTipoPago',dblTotal = '$this->dblTotal',idCredito = '$this->idCredito',detalle = '$this->detalle',estado = '$this->estados' WHERE idCompra = $id ";

$result = $this->database->query($sql);

}

} // class : end

?>