<?php

include_once("../resources/class.database.php");

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

/* SELECT ALL */
function select_all($pagina, $orden){
include('../resources/paginator.class.php');
$sql ="SELECT * FROM categorias ;";
$result = $this->database->query($sql);
$result = $this->database->result;
$quantity= mysql_num_rows($result);
		if($quantity < 1)
		{echo '<div class="notify">
			<p>No hay categoria en el sistema!</p>
		</div>';}
		else{
$count=0;
while($row = mysql_fetch_array($result)){
$count++;
}

$pages = new Paginator;
$pages->items_total = $count;
$pages->mid_range = 10;
$pages->paginate();
$pages->display_pages();

$sql ="SELECT * FROM categorias ORDER BY $orden $pages->limit;";
$result = $this->database->query($sql);
$result = $this->database->result;
while($row = mysql_fetch_array($result)){
$idCategorias = $row['idCategorias'];
$strDescripcion = $row['strDescripcion'];
$talles = $row['talles'];

echo '<div class="item-box-cat">

<h4>'.$strDescripcion.'</h4>

<div class="box-btn-cat">

<a  class="cat" href="e_categoria.php?id='.$idCategorias.'&activo=2&sub=d">ADMINISTRAR</a>
<div style="width:100%;height:10px;float:left;display:block"></div>
<a  class="cat" href="d_categoria.php?id='.$idCategorias.'&activo=2&sub=d">ELIMINAR</a>

</div>
</div>
';
}

echo '<div class="navigate">';
echo $pages->display_pages();


 // Optional call which will display the page numbers after the results.
//$pages->display_jump_menu(); // Optional Ð displays the page jump menu
//echo $pages->display_items_per_page(); //Optional Ð displays the items per
//echo  $pages->current_page . ' of ' .$pages->num_pages.'';
echo '</div>';
}

}

/* SELECT DROP LIST */
function categorias_drop_list($id_recibido){
echo $id_recibido;
$sql ="SELECT * FROM categorias ;";
$result = $this->database->query($sql);
$result = $this->database->result;
while($row = mysql_fetch_array($result)){
	
	
$id= $row['idCategorias'];
$name= $row['strDescripcion'];

if($id ==$id_recibido){$selected = "selected=\"selected\"";}else{$selected="";}
echo '<option value='.$id.' '.$selected.'>'.$name.'</option>';
}
}


/* DELETE */
function delete($id){
$sql = "DELETE FROM categorias WHERE idCategorias = $id;";
$result = $this->database->query($sql);

}


/* INSERT */

function insert(){
$this->idCategorias = ""; // clear key for autoincrement

$sql = "INSERT INTO categorias ( strDescripcion,talles ) VALUES ( '$this->strDescripcion','$this->talles' )";
$result = $this->database->query($sql);
$this->idCategorias = mysql_insert_id($this->database->link);

}


/* UPDATE */

function update($id){

$sql = " UPDATE categorias SET  strDescripcion = '$this->strDescripcion',talles = '$this->talles' WHERE idCategorias = $id ";

$result = $this->database->query($sql);

}

} // class : end

?>