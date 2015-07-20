<?php



include_once("../resources/class.database.php");



/* CLASS DECLARATION */





class novedades{ 

// class : begin

/* ATTRIBUTE DECLARATION */

var $idNovedades;   // KEY ATTR. WITH AUTOINCREMENT

var $titulo;

var $cuerpo;

var $imagen;

var $fecha;

var $database; // Instance of class database





/* CONSTRUCTOR METHOD */



function novedades(){



$this->database = new Database();



}





/* GETTER METHODS */

function getidNovedades(){return $this->idNovedades;}

function gettitulo(){return $this->titulo;}

function getcuerpo(){return $this->cuerpo;}

function getimagen(){return $this->imagen;}

function getfecha(){return $this->fecha;}



/* SETTER METHODS */

function setidNovedades($val){ $this->idNovedades =  $val;}

function settitulo($val){ $this->titulo =  $val;}

function setcuerpo($val){ $this->cuerpo =  $val;}

function setimagen($val){ $this->imagen =  $val;}

function setfecha($val){ $this->fecha =  $val;}



/* SELECT METHOD / LOAD */

function select($id){



$sql =  "SELECT * FROM novedades WHERE idNovedades = $id;";

$result =  $this->database->query($sql);

$result = $this->database->result;

$row = mysql_fetch_object($result);



$this->idNovedades = $row->idNovedades;

$this->titulo = $row->titulo;

$this->cuerpo = $row->cuerpo;

$this->imagen = $row->imagen;

$this->fecha = $row->fecha;



}



/* SELECT ALL */

function select_all($pagina, $orden){

include('../resources/paginator.class.php');

$sql ="SELECT * FROM novedades ;";

$result = $this->database->query($sql);

$result = $this->database->result;

$quantity= mysql_num_rows($result);

		if($quantity < 1)

		{echo '<div class="notify">

			<p style="margin:10px 0 0 30px;font-family:"Open sans",sans-serif",text-transform:uppercase>No hay novedad en el sistema!</p>

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



$sql ="SELECT * FROM novedades ORDER BY $orden $pages->limit;";

$result = $this->database->query($sql);

$result = $this->database->result;

while($row = mysql_fetch_array($result)){

$idNovedades = $row['idNovedades'];

$titulo = $row['titulo'];

$cuerpo = $row['cuerpo'];

$imagen = $row['imagen'];

$fecha = $row['fecha'];







if($imagen){

$item .= '

<div class="item">
<div class="olive-bar"><h4>'.$titulo.'  </h4></div>
	<div class="divideritem" style="width:25%; float:left; padding:.5em">
	<div class="nov-img">
		<img style="margin-left: 15px" src="'.BASEURLRAIZ.'../images-novedades/'.$imagen.'" alt="" width="200"/></div>
	</div>
	
	<div class="divideritem" style="width:45%;float:left;padding:.5em;">
		<p style="margin-left: 25px">'.$cuerpo.'</p>
	</div>
	
	<div class="divideritem" style="width:20%;float:left;padding:.5em">
		
	</div>
	<div class="opcionesitem">
		<a class="btn-micuenta4" href="e_novedad.php?id='.$idNovedades.'">Editar</a>
		<a class="btn-micuenta4" href="d_novedad.php?id='.$idNovedades.'">Borrar</a>
	</div>
</div>

';

//'<p></p>';



}else{
$item .= '

<div class="item">
<h4>'.$titulo.'  </h4>
	<div class="divideritem" style="width:25%; float:left; padding:.5em">
		<div style="width:120px; height:120px; float:left; margin:.5em; background:#ccc;"></div>
	</div>
	
	<div class="divideritem" style="width:45%;float:left;padding:.5em">
		<p>'.$cuerpo.'</p>
	</div>
	
	<div class="divideritem" style="width:20%;float:left;padding:.5em">
		
	</div>
	<p>
		<a class="btn-micuenta4" href="e_novedad.php?id='.$idNovedades.'">Editar</a>
		<a class="btn-micuenta4" href="d_novedad.php?id='.$idNovedades.'">Borrar</a>
	</p>
</div>

';


}

//

}
echo $item;



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

function novedades_drop_list(){



$sql ="SELECT * FROM novedades ;";

$result = $this->database->query($sql);

$result = $this->database->result;

while($row = mysql_fetch_array($result)){

$id= $row['id_novedades'];

$name= $row['name_novedades'];
echo '<option value='.$id.'>'.$name.'</option>';

}
}





/* DELETE */

function delete($id){

$sql = "DELETE FROM novedades WHERE idNovedades = $id;";

$result = $this->database->query($sql);



}





/* INSERT */



function insert(){

$this->idNovedades = ""; // clear key for autoincrement



$sql = "INSERT INTO novedades ( titulo, cuerpo, imagen, fecha ) VALUES ( '$this->titulo','$this->cuerpo','$this->imagen','$this->fecha' )";

$result = $this->database->query($sql);

$this->idNovedades = mysql_insert_id($this->database->link);



}





/* UPDATE */



function update($id){



$sql = " UPDATE novedades SET  titulo = '$this->titulo',cuerpo = '$this->cuerpo',imagen = '$this->imagen',fecha = '$this->fecha' WHERE idNovedades = $id ";



$result = $this->database->query($sql);



}



} // class : end



?>



