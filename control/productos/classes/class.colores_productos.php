<?php

// include_once("../resources/class.database.php");
// require_once($_SESSION['basecontrol']."resources/class.database.php");

error_reporting(E_ALL);
ini_set('display_errors', 'on');

/* CLASS DECLARATION */


class colores_productos{ 
// class : begin
/* ATTRIBUTE DECLARATION */
var $id; 
var $id_color;
var $id_producto;   // KEY ATTR. WITH AUTOINCREMENT
var $cantidad;

var $database; // Instance of class database


/* CONSTRUCTOR METHOD */

function colores_productos(){

$this->database = new Database();

}


/* GETTER METHODS */
function getid(){return $this->id;}
function getid_color(){return $this->id_color;}
function getid_producto(){return $this->id_producto;}
function getcantidad(){return $this->cantidad;}


/* SETTER METHODS */
function setid($val){ $this->id =  $val;}
function setid_color($val){ $this->id_color =  $val;}
function setid_producto($val){ $this->id_producto =  $val;}
function setcantidad($val){ $this->cantidad =  $val;}


/* SELECT METHOD / LOAD */
// function select($id){
// $sql =  "SELECT * FROM colores WHERE id = $id";
// $result =  $this->database->query($sql);
// $result = $this->database->result;
// $row = mysql_fetch_object($result);

// $this->id = $row->id;
// $this->id_color = $row->id_color;
// $this->id_producto = $row->id_producto;
// $this->cantidad = $row->cantidad;


// }

/* SELECT DROP LIST 
function talles_drop_list(){

$sql ="SELECT * FROM talles ;";
$result = $this->database->query($sql);
$result = $this->database->result;
while($row = mysql_fetch_array($result)){
$id= $row['id_talle'];
$name= $row['nombre_talle'];
echo '<option value='.$id.'>'.$name.'</option>';
}
}*/



function select_by_producto($id_producto, $id_color){
$sql ="SELECT * FROM colores_productos WHERE id_producto = '$id_producto' AND id_color = '$id_color' ";
$result =  $this->database->query($sql);
$result = $this->database->result;
$row = mysql_fetch_object($result);

$this->id = $row->id;
$this->id_color = $row->id_color;
$this->id_producto = $row->id_producto;
$this->cantidad = $row->cantidad;

}


/* DELETE */
function delete($id){
$sql = "DELETE FROM talles_productos WHERE id = $id;";
$result = $this->database->query($sql);

}

function clean_by_producto($id){
$sql = "DELETE FROM colores_productos WHERE id_producto = $id;";
$result = $this->database->query($sql);

}


/* INSERT */

function insert(){
$this->id = ""; // clear key for autoincrement
$sql = "INSERT INTO colores_productos ( id_color, id_producto, cantidad ) VALUES ( '$this->id_color','$this->id_producto','$this->cantidad' )";
$result = $this->database->query($sql);
$this->id = mysql_insert_id($this->database->link);
}

function insert_update(){
$this->id = ""; // clear key for autoincrement
$sql = "INSERT INTO colores_productos ( id_color, id_producto, cantidad ) VALUES ( '$this->id_color','$this->id_producto','$this->cantidad' )";
$result = $this->database->query($sql);
$this->id = mysql_insert_id($this->database->link);

}

function getAllCategories($id = null){
	$sql = "SELECT 
				cp.cantidad as cantidad,
			    cp.id_color as idColor,
			    colores.nombre_color as nombre
			FROM 
				colores_productos as cp
			LEFT JOIN
				colores ON colores.id_color = cp.id_color
			WHERE
				cp.id_producto = ".$id." ORDER BY cp.id_producto ASC";

	$this->database->query($sql);
	$result = $this->database->result;
	$row = mysql_fetch_object($result);
	$resultado = array();
	while ($row = mysql_fetch_object($result)) {
		$resultado[] = $row;
	}
	return $resultado;
}
function updateAllColours($array,$id){

	foreach ($array as $key => $value) {
		$sel = "SELECT COUNT(id) as exist FROM colores_productos WHERE id_color = ".$key." AND id_producto = ".$id;
		$this->database->query($sel);
		$sel = $this->database->result;
		$sel = mysql_fetch_object($sel);
		$sel = ($sel->exist == 0 ? false : true);
		if(!$sel):
			$sql = "INSERT INTO colores_productos (id_producto, id_color,cantidad) VALUES (".$id.",".$key.",".(int)$value.")";
		else:
			$sql = "UPDATE colores_productos SET cantidad = ".(int)$value." WHERE id_color = ".$key." AND id_producto = ".$id;
		endif;
		$this->database->query($sql);
	}

	
}
/* UPDATE */

function update($id){

#$sql = " UPDATE talles SET  nombre_talle = '$this->nombre_talle' WHERE id_talle = $id ";

#$result = $this->database->query($sql);

}

} // class : end

?>