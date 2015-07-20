<?php

include_once("../resources/class.database.php");

/* CLASS DECLARATION */


class talles_productos{ 
// class : begin
/* ATTRIBUTE DECLARATION */
var $id; 
var $id_talle;
var $id_producto;   // KEY ATTR. WITH AUTOINCREMENT
var $cantidad;

var $database; // Instance of class database


/* CONSTRUCTOR METHOD */

function talles_productos(){

$this->database = new Database();

}


/* GETTER METHODS */
function getid(){return $this->id;}
function getid_talle(){return $this->id_talle;}
function getid_producto(){return $this->id_producto;}
function getcantidad(){return $this->cantidad;}


/* SETTER METHODS */
function setid($val){ $this->id =  $val;}
function setid_talle($val){ $this->id_talle =  $val;}
function setid_producto($val){ $this->id_producto =  $val;}
function setcantidad($val){ $this->cantidad =  $val;}


/* SELECT METHOD / LOAD */
function select($id){
$sql =  "SELECT * FROM talles WHERE id = $id;";
$result =  $this->database->query($sql);
$result = $this->database->result;
$row = mysql_fetch_object($result);

$this->id = $row->id;
$this->id_talle = $row->id_talle;
$this->id_producto = $row->id_producto;
$this->cantidad = $row->cantidad;


}

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



function select_by_producto($id_producto, $id_talle){
$sql ="SELECT * FROM talles_productos WHERE id_producto = '$id_producto' AND id_talle = '$id_talle' AND cantidad >= 1;";
$result =  $this->database->query($sql);
$result = $this->database->result;
$row = mysql_fetch_object($result);

$this->id = $row->id;
$this->id_talle = $row->id_talle;
$this->id_producto = $row->id_producto;
$this->cantidad = $row->cantidad;

}


/* DELETE */
function delete($id){
#$sql = "DELETE FROM talles_productos WHERE id = $id;";
#$result = $this->database->query($sql);

}

function clean_by_producto($id){
$sql = "DELETE FROM talles_productos WHERE id_producto = $id;";
$result = $this->database->query($sql);

}


/* INSERT */

function insert(){
$this->id = ""; // clear key for autoincrement
$sql = "INSERT INTO talles_productos ( id_talle, id_producto, cantidad ) VALUES ( '$this->id_talle','$this->id_producto','$this->cantidad' )";
$result = $this->database->query($sql);
return $this->id = mysql_insert_id($this->database->link);

}

function insert_update(){
$this->id = ""; // clear key for autoincrement
$sql = "INSERT INTO talles_productos ( id_talle, id_producto, cantidad ) VALUES ( '$this->id_talle','$this->id_producto','$this->cantidad' )";
$result = $this->database->query($sql);
$this->id = mysql_insert_id($this->database->link);

}


/* UPDATE */

function update($id){

#$sql = " UPDATE talles SET  nombre_talle = '$this->nombre_talle' WHERE id_talle = $id ";

#$result = $this->database->query($sql);

}

} // class : end

?>