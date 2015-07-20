<?php

include_once("Connections/class.database.php");

/* CLASS DECLARATION */


class productos{ 
// class : begin
/* ATTRIBUTE DECLARATION */
var $idProducto;   // KEY ATTR. WITH AUTOINCREMENT
var $strNombre;
var $strDetalle;
var $intCategoria;
var $dblPrecio;
var $intStock;
var $strImagen;
var $database; // Instance of class database


/* CONSTRUCTOR METHOD */

function productos(){

$this->database = new Database();

}


/* GETTER METHODS */
function getidProducto(){return $this->idProducto;}
function getstrNombre(){return $this->strNombre;}
function getstrDetalle(){return $this->strDetalle;}
function getintCategoria(){return $this->intCategoria;}
function getdblPrecio(){return $this->dblPrecio;}
function getintStock(){return $this->intStock;}
function getstrImagen(){return $this->strImagen;}

/* SETTER METHODS */
function setidProducto($val){ $this->idProducto =  $val;}
function setstrNombre($val){ $this->strNombre =  $val;}
function setstrDetalle($val){ $this->strDetalle =  $val;}
function setintCategoria($val){ $this->intCategoria =  $val;}
function setdblPrecio($val){ $this->dblPrecio =  $val;}
function setintStock($val){ $this->intStock =  $val;}
function setstrImagen($val){ $this->strImagen =  $val;}

/* SELECT METHOD / LOAD */
function select($id){

$sql =  "SELECT * FROM productos WHERE idProducto = $id;";
$result =  $this->database->query($sql);
$result = $this->database->result;

$row = mysql_fetch_object($result);


$this->idProducto = $row->idProducto;
$this->strNombre = $row->strNombre;
$this->strDetalle = $row->strDetalle;
$this->intCategoria = $row->intCategoria;
$this->dblPrecio = $row->dblPrecio;
$this->intStock = $row->intStock;
$this->strImagen = $row->strImagen;

}

/* SELECT ALL */
function select_all($pagina, $orden){
include('../resources/paginator.class.php');
$sql ="SELECT * FROM productos ;";
$result = $this->database->query($sql);
$result = $this->database->result;
$quantity= mysql_num_rows($result);
		if($quantity < 1)
		{echo '<div class="notify">
			<p>No hay producto en el sistema!</p>
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

$sql ="SELECT * FROM productos ORDER BY $orden $pages->limit;";
$result = $this->database->query($sql);
$result = $this->database->result;
while($row = mysql_fetch_array($result)){
$idProducto = $row['idProducto'];
$strNombre = $row['strNombre'];
$intCategoria = $row['intCategoria'];
$dblPrecio = $row['dblPrecio'];
$intStock = $row['intStock'];
$strImagen = $row['strImagen'];

echo '<div class="item">

<h4>[ Poner aca titulo o nombre ]</h4>
<p><strong>Descripcion: </strong><p></p>[ poner aca descripcion u otro campo ]</p>

<p>
<a href="e_producto.php?id='.$idProducto.'">Editar</a>
<a href="d_producto.php?id='.$idProducto.'">Borrar</a>
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


/* SELECT ALL */
function select_busqueda($busqueda){

$sql ="SELECT * FROM productos WHERE strNombre LIKE '%$busqueda%' OR strDetalle LIKE '%$busqueda%';";
$result = $this->database->query($sql);
$result = $this->database->result;
$quantity= mysql_num_rows($result);
		if($quantity < 1)
		{echo '<div class=notify>
			<p style="margin: 5px 0 0 0;color:#008B39">No hay productos que coincidan con la busqueda para, '.$busqueda.'</p>
		</div>';}
		else{
$count=0;
while($row = mysql_fetch_array($result)){
$count++;
}


$sql ="SELECT * FROM productos WHERE strNombre LIKE '%$busqueda%' OR strDetalle LIKE '%$busqueda%';";
$result = $this->database->query($sql);
$result = $this->database->result;
while($row = mysql_fetch_array($result)){
$idProducto = $row['idProducto'];
$strNombre = $row['strNombre'];
$detalle = $row['strDetalle'];
$intCategoria = $row['intCategoria'];
$dblPrecio = $row['dblPrecio'];
$intStock = $row['intStock'];
$strImagen = $row['strImagen'];

if($strImagen!=""){
	echo '
	<div class="itemcontainer">	
			<div class="sombra2345"></div>
	              <ul>
				  <a href="ver_producto.php?recordID='.$idProducto.'&activo=1&prod=1">
                <li>
                  <div class="tipro">
                    <div class="titlef"></div>
                    <p>$'.$dblPrecio.'</p>
					<p class="smallsub">canjear</p>
                  </div>
	
		<div class="box-imagen3">
			<a href="ver_producto.php?recordID='.$idProducto.'&activo=1&prod=1"><img src="images_productos/'.$strImagen.'" width="307" height="270"></a>
		</div>
	

	
	</a>
	
	</li>
	<div class="descripcion ie8_desc">
	<span class="title_product">'.$strNombre.'</span><br>
	         <span>Stock '.$intStock.' U</span> 
	         <p>'.substr(utf8_encode($detalle), 0, 50).'...</p>                
	        </div>
	
	
	</ul> 	
	</div>
	';
	//'.utf8_encode($detalle).'
}else{

	echo '
	
	<ul>
	
		<div class="sombra"></div>
		<li>
		<div class="tipro"><span>'.$strNombre.'</span></div>
	
		<div class="box-imagen3">
			
		</div>
	
	<div class="info">
	
	   <h4><a href="ver_producto.php?recordID='.$idProducto.'&activo=1&prod=1">CANJEAR</a></h4>
	 
	
	</div>
	</li>
	<div class="descripcion  ie8_desc">
	         <span>Stock '.$intStock.' U</span> 
	         <p>'.$detalle.'</p>                
	        </div>              
	</div>
	
	</ul> 
	
	
	';
	
}

}



}
}


/* DELETE */
function delete($id){
$sql = "DELETE FROM productos WHERE idProducto = $id;";
$result = $this->database->query($sql);

}


/* INSERT */

function insert(){
$this->idProducto = ""; // clear key for autoincrement

$sql = "INSERT INTO productos ( strNombre,strDetalle,intCategoria,dblPrecio,intStock,strImagen ) VALUES ( '$this->strNombre','$this->strDetalle','$this->intCategoria','$this->dblPrecio','$this->intStock','$this->strImagen' )";
$result = $this->database->query($sql);
$this->idProducto = mysql_insert_id($this->database->link);

}


/* UPDATE */

function update($id){

$sql = " UPDATE productos SET  strNombre = '$this->strNombre',strDetalle = '$this->strDetalle',intCategoria = '$this->intCategoria',dblPrecio = '$this->dblPrecio',intStock = '$this->intStock',strImagen = '$this->strImagen' WHERE idProducto = $id ";

$result = $this->database->query($sql);

}

} // class : end

?>