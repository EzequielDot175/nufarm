<?php

include_once("Connections/class.database.php");

/* CLASS DECLARATION */


class categorias{ 
// class : begin
/* ATTRIBUTE DECLARATION */
var $idCategorias;   // KEY ATTR. WITH AUTOINCREMENT
var $strDescripcion;
var $talles;
var $database; // Instance of class database


/* CONSTRUCTOR METHOD */

function categorias(){

$this->database = new Database();

}


/* GETTER METHODS */
function getidCategorias(){return $this->idCategorias;}
function getstrDescripcion(){return $this->strDescripcion;}
function gettalles(){return $this->talles;}

/* SETTER METHODS */
function setidCategorias($val){ $this->idCategorias =  $val;}
function setstrDescripcion($val){ $this->strDescripcion =  $val;}
function settalles($val){ $this->talles =  $val;}

/* SELECT METHOD / LOAD */
function select($id){

$sql =  "SELECT * FROM categorias WHERE idCategorias = $id;";
$result =  $this->database->query($sql);
$result = $this->database->result;
$row = mysql_fetch_object($result);

$this->idCategorias = $row->idCategorias;
$this->strDescripcion = $row->strDescripcion;
$this->talles = $row->talles;

}



/* SELECT DROP LIST */
function categorias_drop_list(){

$sql ="SELECT * FROM categorias ;";
$result = $this->database->query($sql);
$result = $this->database->result;
while($row = mysql_fetch_array($result)){
$id= $row['id_categorias'];
$name= $row['name_categorias'];
echo '<option value='.$id.'>'.$name.'</option>';
}
}






} // class : end

?>

