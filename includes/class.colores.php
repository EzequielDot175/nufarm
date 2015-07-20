<?php

include_once("Connections/class.database.php");

/* CLASS DECLARATION */


class colores{ 
// class : begin
/* ATTRIBUTE DECLARATION */
var $id_talle;   // KEY ATTR. WITH AUTOINCREMENT
var $nombre_talle;

var $database; // Instance of class database


/* CONSTRUCTOR METHOD */

function colores(){

$this->database = new Database();

}


/* GETTER METHODS */
function getid_color(){return $this->id_color;}
function getnombre_color(){return $this->nombre_color;}


/* SETTER METHODS */
function setid_color($val){ $this->id_color =  $val;}
function setnombre_color($val){ $this->nombre_color =  $val;}


/* SELECT METHOD / LOAD */
function select($id){

$sql =  "SELECT * FROM colores WHERE id_color = $id;";
$result =  $this->database->query($sql);
$result = $this->database->result;
$row = mysql_fetch_object($result);

$this->id_color = $row->id_color;
$this->nombre_color = $row->nombre_color;


}

/* SELECT ALL */
function select_all($pagina, $orden){
include('../resources/paginator.class.php');
$sql ="SELECT * FROM colores ;";
$result = $this->database->query($sql);
$result = $this->database->result;
$quantity= mysql_num_rows($result);
		if($quantity < 1)
		{echo '<div class="notify">
			<p>No hay colores en el sistema!</p>
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

$sql ="SELECT * FROM colores ORDER BY $orden $pages->limit;";
$result = $this->database->query($sql);
$result = $this->database->result;
while($row = mysql_fetch_array($result)){
$id_color = $row['id_color'];
$nombre_color = $row['nombre_color'];


echo '<div class="item">

<h4>'.$nombre_color.'</h4>


<p>
<a href="e_talle.php?id='.$id_color.'">Editar</a>
<a href="d_talle.php?id='.$id_color.'">Borrar</a>
</p>

</div>';
}

echo '<div class="navigate">';
echo $pages->display_pages();


 // Optional call which will display the page numbers after the results.
//$pages->display_jump_menu(); // Optional � displays the page jump menu
//echo $pages->display_items_per_page(); //Optional � displays the items per
//echo  $pages->current_page . ' of ' .$pages->num_pages.'';
echo '</div>';
}

}

/* SELECT DROP LIST */
function colores_drop_list(){

$sql ="SELECT * FROM colores ;";
$result = $this->database->query($sql);
$result = $this->database->result;
while($row = mysql_fetch_array($result)){
$id= $row['id_color'];
$name= $row['nombre_color'];
echo '<option value='.$id.'>'.$name.'</option>';
}
}

function select_all_clean(){

$sql ="SELECT * FROM colores ;";
$result = $this->database->query($sql);
$result = $this->database->result;
while($row = mysql_fetch_array($result)){
$id[]= $row['id_color'];

}
return $id;
}


/* DELETE */
function delete($id){
$sql = "DELETE FROM colores WHERE id_color = $id;";
$result = $this->database->query($sql);

}


/* INSERT */

function insert(){
$this->id_color = ""; // clear key for autoincrement

$sql = "INSERT INTO colores ( nombre_color ) VALUES ( '$this->nombre_color' )";
$result = $this->database->query($sql);
$this->id_color = mysql_insert_id($this->database->link);

}


/* UPDATE */

function update($id){

$sql = " UPDATE colores SET  nombre_color = '$this->nombre_color' WHERE id_color = $id ";

$result = $this->database->query($sql);

}

} // class : end

?>

