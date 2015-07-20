<?php

include_once("../resources/class.database.php");

/* CLASS DECLARATION */


class creditos{ 
// class : begin
/* ATTRIBUTE DECLARATION */
var $idCredito;   // KEY ATTR. WITH AUTOINCREMENT
var $idUsuario;
var $idProducto;
var $database; // Instance of class database


/* CONSTRUCTOR METHOD */

function creditos(){

$this->database = new Database();

}


/* GETTER METHODS */
function getidCredito(){return $this->idCredito;}
function getidUsuario(){return $this->idUsuario;}
function getidProducto(){return $this->idProducto;}

/* SETTER METHODS */
function setidCredito($val){ $this->idCredito =  $val;}
function setidUsuario($val){ $this->idUsuario =  $val;}
function setidProducto($val){ $this->idProducto =  $val;}

/* SELECT METHOD / LOAD */
function select($id){

$sql =  "SELECT * FROM creditos WHERE idCredito = $id;";
$result =  $this->database->query($sql);
$result = $this->database->result;
$row = mysql_fetch_object($result);

$this->idCredito = $row->idCredito;
$this->idUsuario = $row->idUsuario;
$this->idProducto = $row->idProducto;

}

/* SELECT ALL */
function select_all($pagina, $orden){
include('../resources/paginator.class.php');
$sql ="SELECT * FROM creditos ;";
$result = $this->database->query($sql);
$result = $this->database->result;
$quantity= mysql_num_rows($result);
		if($quantity < 1)
		{echo '<div class="notify">
			<p>No hay credito en el sistema!</p>
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

$sql ="SELECT * FROM creditos ORDER BY $orden $pages->limit;";
$result = $this->database->query($sql);
$result = $this->database->result;
while($row = mysql_fetch_array($result)){
$idCredito = $row['idCredito'];
$idUsuario = $row['idUsuario'];
$idProducto = $row['idProducto'];

echo '<div class="item">

<h4>[ Poner aca titulo o nombre ]</h4>
<p><strong>Descripcion: </strong><p></p>[ poner aca descripcion u otro campo ]</p>

<p>
<a href="e_credito.php?id='.$idCredito.'">Editar</a>
<a href="d_credito.php?id='.$idCredito.'">Borrar</a>
</p>

</div>';
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
function creditos_drop_list(){

$sql ="SELECT * FROM creditos ;";
$result = $this->database->query($sql);
$result = $this->database->result;
while($row = mysql_fetch_array($result)){
$id= $row['id_creditos'];
$name= $row['name_creditos'];
echo '<option value='.$id.'>'.$name.'</option>';
}
}


/* DELETE */
function delete($id){
$sql = "DELETE FROM creditos WHERE idCredito = $id;";
$result = $this->database->query($sql);

}


/* INSERT */

function insert(){
$this->idCredito = ""; // clear key for autoincrement

$sql = "INSERT INTO creditos ( idUsuario,idProducto ) VALUES ( '$this->idUsuario','$this->idProducto' )";
$result = $this->database->query($sql);
$this->idCredito = mysql_insert_id($this->database->link);

}


/* UPDATE */

function update($id){

$sql = " UPDATE creditos SET  idUsuario = '$this->idUsuario',idProducto = '$this->idProducto' WHERE idCredito = $id ";

$result = $this->database->query($sql);

}

} // class : end

?>

