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

/* SETTER METHODS */
function setidCompra($val){ $this->idCompra =  $val;}
function setidUsuario($val){ $this->idUsuario =  $val;}
function setfthCompra($val){ $this->fthCompra =  $val;}
function setintTipoPago($val){ $this->intTipoPago =  $val;}
function setdblTotal($val){ $this->dblTotal =  $val;}
function setidCredito($val){ $this->idCredito =  $val;}
function setdetalle($val){ $this->detalle =  $val;}
function setestado($val){ $this->estado =  $val;}

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

#include_once('productos/classes/class.productos.php');
$sql ="SELECT * FROM detalles_compras WHERE id_compra = $id_compra;";
$result = $this->database->query($sql);
$result = $this->database->result;
while($row = mysql_fetch_array($result)){
	
	$id_producto = $row['id_producto'];
	$nombre = $row['nombre'];
	$detalle = $row['detalle'];
	$cantidad = $row['cantidad'];
	$precio_pagado = $row['precio_pagado'];
	

	//verifico si tiene imagen
	$prod = new productos();
	$prod->select($id_producto);
	$imagen_producto = $prod->getstrImagen();
	
	if( strlen($imagen_producto) > 0 ){
		//con imagen
		$recuadro .= '
		<div id="BloqueGeneral">
	<div id="BloqueImagen"><img src="images_productos/'.$imagen_producto.'" height="60" alt="" /></div> <p>ID:'.$id_producto.'<br>'.$nombre.' <br>CANT:'.$cantidad.' <br> $'.$precio_pagado.'</p></div>
		';
	
	}else{
		//sin imagen
		$recuadro .= '
		<p>ID:'.$id_producto.'| '.$nombre.', | CANT:'.$cantidad.'  $ '.$precio_pagado.'</p>	
		';
		
	}
	
	

}
return $recuadro;
}






function insert_detalle_productos($id_compra,$id_producto,$nombre,$detalle,$cantidad,$precio_pagado){

#$this->idCompra = ""; // clear key for autoincrement
$sql = "INSERT INTO detalles_compras( id_compra, id_producto, nombre, detalle, cantidad, precio_pagado ) VALUES ('$id_compra', '$id_producto', '$nombre', '$detalle', '$cantidad', '$precio_pagado')";
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