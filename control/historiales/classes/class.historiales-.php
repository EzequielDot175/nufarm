<?php  
include_once("../resources/class.database.php");


/* CLASS DECLARATION */


class historiales{ 
// class : begin
/* ATTRIBUTE DECLARATION */
var $id_usuario;   // KEY ATTR. WITH AUTOINCREMENT
var $fecha;
var $realizado_por;
var $tipo_modificacion;
var $monto_modificado;
var $idCredito;
var $detalle;
var $database; // Instance of class database


/* CONSTRUCTOR METHOD */

function historiales(){

$this->database = new Database();

}


/* GETTER METHODS */
function getid_usuario(){return $this->id_usuario;}
function getfecha(){return $this->fecha;}
function getrealizado_por(){return $this->realizado_por;}
function gettipo_modificacion(){return $this->tipo_modificacion;}
function getmonto_modificado(){return $this->monto_modificado;}



/* SETTER METHODS */
function setid_usuario($val){ $this->id_usuario =  $val;}
function setfecha($val){ $this->fecha =  $val;}
function setrealizado_por($val){ $this->realizado_por =  $val;}
function settipo_modificacion($val){ $this->tipo_modificacion =  $val;}
function setmonto_modificado($val){ $this->monto_modificado =  $val;}


/* SELECT METHOD / LOAD */
function select($id){

$sql =  "SELECT * FROM historiales WHERE id_usuario = $id;";
$result =  $this->database->query($sql);
$result = $this->database->result;
$row = mysql_fetch_object($result);

$this->id_usuario = $row->id_usuario;
$this->fecha = $row->fecha;
$this->realizado_por = $row->realizado_por;
$this->tipo_modificacion = $row->tipo_modificacion;
$this->monto_modificado = $row->monto_modificado;


}

function show_by_usuario($id_usuario){
	$sql ="SELECT * FROM historiales WHERE id_usuario = $id_usuario ORDER BY id DESC;";
	$result = $this->database->query($sql);
	$result = $this->database->result;
	while($row = mysql_fetch_array($result)){

	$id_usuario = $row['id_usuario'];
	$fecha = $row['fecha'];
	$realizado_por = $row['realizado_por'];
	$tipo_modificacion = $row['tipo_modificacion'];
	$monto_modificado = $row['monto_modificado'];
	
	list($anio, $mes, $dia) = explode('-', $fecha);
	$fecha = $dia.'/'.$mes.'/'.$anio;
	
	$linea .='<div class="detalle_historial">'.$fecha.' -'.$realizado_por.'- '.$tipo_modificacion.'</div>';
	}
	return $linea;
}

/* SELECT ALL */
function select_all($pagina, $orden){
include('../resources/paginator.class.php');
$sql ="SELECT * FROM historiales ;";
$result = $this->database->query($sql);
$result = $this->database->result;
$quantity= mysql_num_rows($result);
		if($quantity < 1)
		{echo '<div class="notify">
			<p>No hay historiales en el sistema!</p>
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

$sql ="SELECT * FROM historiales ORDER BY $orden $pages->limit;";
$result = $this->database->query($sql);
$result = $this->database->result;
while($row = mysql_fetch_array($result)){




$id_usuario = $row['id_usuario'];
$fecha = $row['fecha'];
$realizado_por = $row['realizado_por'];
$tipo_modificacion = $row['tipo_modificacion'];
$monto_modificado = $row['monto_modificado'];




}

echo '<div class="navigate">';
echo $pages->display_pages();


 // Optional call which will display the page numbers after the results.
//$pages->display_jump_menu(); // Optional – displays the page jump menu
//echo $pages->display_items_per_page(); //Optional – displays the items per
//echo  $pages->current_page . ' of ' .$pages->num_pages.'';
echo '</div>';
}

}





/* DELETE */
function delete($id){
$sql = "DELETE FROM historiales WHERE id_usuario = $id;";
$result = $this->database->query($sql);

}


/* INSERT */

function insert(){
$this->id = ""; // clear key for autoincrement

$sql = "INSERT INTO historiales ( id_usuario,fecha,realizado_por,tipo_modificacion,monto_modificado ) VALUES ( '$this->id_usuario','$this->fecha','$this->realizado_por','$this->tipo_modificacion','$this->monto_modificado')";
$result = $this->database->query($sql);
$this->id_usuario = mysql_insert_id($this->database->link);

}


/* UPDATE */

function update($id){

$sql = " UPDATE historiales SET  fecha = '$this->fecha',realizado_por = '$this->realizado_por',tipo_modificacion = '$this->tipo_modificacion',monto_modificado = '$this->monto_modificado' WHERE id_usuario = $id ";

$result = $this->database->query($sql);

}

} // class : end


?>