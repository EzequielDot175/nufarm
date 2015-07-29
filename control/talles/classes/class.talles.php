<?php

include_once("../resources/class.database.php");

/* CLASS DECLARATION */


class talles{ 
// class : begin
/* ATTRIBUTE DECLARATION */
var $id_talle;   // KEY ATTR. WITH AUTOINCREMENT
var $nombre_talle;

var $database; // Instance of class database


/* CONSTRUCTOR METHOD */

function talles(){

$this->database = new Database();

}
function all(){
	$sql =  "SELECT * FROM talles";
	$result = $this->database->query($sql);
	$array = [];
	while ($res = mysql_fetch_array($this->database->result)) {
		$array[] = $res;
	}
	return $array;
}


/* GETTER METHODS */
function getid_talle(){return $this->id_talle;}
function getnombre_talle(){return $this->nombre_talle;}


/* SETTER METHODS */
function setid_talle($val){ $this->id_talle =  $val;}
function setnombre_talle($val){ $this->nombre_talle =  $val;}


/* SELECT METHOD / LOAD */
function select($id){

$sql =  "SELECT * FROM talles WHERE id_talle = $id;";
$result =  $this->database->query($sql);
$result = $this->database->result;
$row = mysql_fetch_object($result);

$this->id_talle = $row->id_talle;
$this->nombre_talle = $row->nombre_talle;


}

/* SELECT ALL */
function select_all($pagina, $orden){
include('../resources/paginator.class.php');
$sql ="SELECT * FROM talles ;";
$result = $this->database->query($sql);
$result = $this->database->result;
$quantity= mysql_num_rows($result);
		if($quantity < 1)
		{echo '<div class="notify">
			<p>No hay talles en el sistema!</p>
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

$sql ="SELECT * FROM talles ORDER BY $orden $pages->limit;";
$result = $this->database->query($sql);
$result = $this->database->result;
while($row = mysql_fetch_array($result)){
$id_talle = $row['id_talle'];
$nombre_talle = $row['nombre_talle'];


echo '<div class="item-box-talles">

<div class="box-t">
<div class="box-dt"></div>
<span>'.$nombre_talle.'</span>
</div>



<a class="BtnTalle" href="e_talle.php?id='.$id_talle.'">ADMINISTRAR</a>
<a class="BtnTalle" href="d_talle.php?id='.$id_talle.'">ELIMINAR</a>

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
function talles_drop_list(){

$sql ="SELECT * FROM talles ;";
$result = $this->database->query($sql);
$result = $this->database->result;
while($row = mysql_fetch_array($result)){
$id= $row['id_talle'];
$name= $row['nombre_talle'];
echo '<option value='.$id.'>'.$name.'</option>';
}
}

function select_all_clean(){

$sql ="SELECT * FROM talles ;";
$result = $this->database->query($sql);
$result = $this->database->result;
while($row = mysql_fetch_array($result)){
$id[]= $row['id_talle'];

}
return $id;
}


/* DELETE */
function delete($id){
$sql = "DELETE FROM talles WHERE id_talle = $id;";
$result = $this->database->query($sql);

}


/* INSERT */

function insert(){
$this->id_talle = ""; // clear key for autoincrement

$sql = "INSERT INTO talles ( nombre_talle ) VALUES ( '$this->nombre_talle' )";
$result = $this->database->query($sql);
$this->id_talle = mysql_insert_id($this->database->link);

}


/* UPDATE */

function update($id){

$sql = " UPDATE talles SET  nombre_talle = '$this->nombre_talle' WHERE id_talle = $id ";

$result = $this->database->query($sql);

}

} // class : end

?>