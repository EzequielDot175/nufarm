<?php

include_once("../resources/class.database.php");

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
var $strImagen2;
var $strImagen3;
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
function getstrImagen2(){return $this->strImagen2;}
function getstrImagen3(){return $this->strImagen3;}

/* SETTER METHODS */
function setidProducto($val){ $this->idProducto =  $val;}
function setstrNombre($val){ $this->strNombre =  $val;}
function setstrDetalle($val){ $this->strDetalle =  $val;}
function setintCategoria($val){ $this->intCategoria =  $val;}
function setdblPrecio($val){ $this->dblPrecio =  $val;}
function setintStock($val){ $this->intStock =  $val;}
function setstrImagen($val){ $this->strImagen =  $val;}
function setstrImagen2($val){ $this->strImagen2 =  $val;}
function setstrImagen3($val){ $this->strImagen3 =  $val;}

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
$this->strImagen2 = $row->strImagen2;
$this->strImagen3 = $row->strImagen3;

}


/* SELECT ALL */
function select_busqueda($search){

$sql ="SELECT * FROM productos  WHERE strNombre LIKE '%$search%' OR strDetalle LIKE '%$search%' ORDER BY strNombre ASC";
$result = $this->database->query($sql);
$result = $this->database->result;

$count_resultados =0;
include_once("../categorias/classes/class.categorias.php");
while($row = mysql_fetch_array($result)){
$idProducto = $row['idProducto'];
$strNombre = $row['strNombre'];
$strDetalle = $row['strDetalle'];
$intCategoria = $row['intCategoria'];
$dblPrecio = $row['dblPrecio'];
$intStock = $row['intStock'];
$strImagen = $row['strImagen'];
$strImagen2 = $row['strImagen2'];
$strImagen3 = $row['strImagen3'];

//veo si requiere talles
$categorias= new categorias();
$categorias->select($intCategoria);
$talles=$categorias->gettalles();


if($talles ==1){
	include_once("../talles/classes/class.talles.php");
	$tll= new talles();
	$talles_disp = $tll->select_all_clean();
	
	
	foreach($talles_disp as $id_talle_m){
		
		$talle_n= new talles();
		$talle_n->select($id_talle_m);
		$nombre_talle = $talle_n->getnombre_talle();
		$id_talle_tabla = $talle_n->getid_talle();

		
		
		include_once("class.talles_productos.php");
	
		$tallprod = new talles_productos();
		$tallprod->select_by_producto($idProducto, $id_talle_m);
		$id_talle_producto = $tallprod->getid();
		#echo $id_talle = $tallprod->getid_talle();
		$id_producto = $tallprod->getid_producto();
		$cantidad = $tallprod->getcantidad();
		
		if($cantidad==""){$cantidad=0;}
		
		$talles_item .=  '
		
		<span>[<strong>'.$nombre_talle.':'.$cantidad.'</strong>] &nbsp;&nbsp;  </span>
		';
		$id_talle_m ="";
		
	}
	
	
}else{
$talles_item .="";
}
//fin talles

$item_prod="";
if( strlen($strImagen) > 2){

$item_prod.= '

<div class="item">
<div class="purple-bar"><h4>'.$strNombre.'  </h4></div> 
	<div class="divideritemuno" >
		<img src="'.BASEURLRAIZ.'/images_productos/'.$strImagen.'" alt="" width="100"/>
		<p>'.$talles_item.'</p>
	</div>
	
	<div class="divideritemdos" >
		<p>'.$strDetalle.'</p>
	</div>
	
	<div class="divideritemtres" >
		
	</div>

<div class="opcionesitem">
	<a href="'.BASEURL.'/productos/e_producto.php?id='.$idProducto.'">Editar</a>
	<a href="'.BASEURL.'/productos/d_producto.php?id='.$idProducto.'">Borrar</a>
</div>
</div>

';




}else{
$item_prod .= '

<div class="item">
<div class="purple-bar"><h4>'.$strNombre.'  </h4></div> 
	<div class="divideritemuno">
		<div class="no_img"></div>
		<p>'.$talles_item.'</p>
	</div>
	
	<div class="divideritemdos">
		<p>'.$strDetalle.'</p>
	</div>
	
	<div class="divideritemtres">
		
	</div>
	<div class="opcionesitem">
	<a href="e_producto.php?id='.$idProducto.'">Editar</a>
	<a href="d_producto.php?id='.$idProducto.'">Borrar</a>
	</div>
</div>

';


}


$count_resultados++;
}


echo '<p>Resultados: '.$count_resultados.'</p>';

echo $item_prod;
$talles_item = "";
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

include_once("../categorias/classes/class.categorias.php");


$sql ="SELECT * FROM productos ORDER BY $orden $pages->limit;";
$result = $this->database->query($sql);
$result = $this->database->result;
while($row = mysql_fetch_array($result)){
$idProducto = $row['idProducto'];
$strNombre = $row['strNombre'];
$strDetalle = $row['strDetalle'];
$intCategoria = $row['intCategoria'];
$dblPrecio = $row['dblPrecio'];
$intStock = $row['intStock'];
$strImagen = $row['strImagen'];
$strImagen2 = $row['strImagen2'];
$strImagen3 = $row['strImagen3'];

//veo si requiere talles
$categorias= new categorias();
$categorias->select($intCategoria);
$talles=$categorias->gettalles();

$stock = '<p>STOCK: '.$intStock.'</p>';

if($talles ==1){
	include_once("../talles/classes/class.talles.php");
	$tll= new talles();
	$talles_disp = $tll->select_all_clean();
	
	
	foreach($talles_disp as $id_talle_m){
		
		$talle_n= new talles();
		$talle_n->select($id_talle_m);
		$nombre_talle = $talle_n->getnombre_talle();
		$id_talle_tabla = $talle_n->getid_talle();

		
		
		include_once("classes/class.talles_productos.php");
	
		$tallprod = new talles_productos();
		$tallprod->select_by_producto($idProducto, $id_talle_m);
		$id_talle_producto = $tallprod->getid();
		#echo $id_talle = $tallprod->getid_talle();
		$id_producto = $tallprod->getid_producto();
		$cantidad = $tallprod->getcantidad();
		
		if($cantidad==""){$cantidad=0;}
		
		$talles_item .=  '<br />
		
		<div class="t-bg">
		<p>'.$nombre_talle.': '.$cantidad.'</p>
		</div>
		';
		$id_talle_m ="";
		
		$stock = '';
	}
	
	
}else{
$talles_item .="";
}

$item ="";
if($strImagen){

$item .= '

<div class="item">
<div class="purple-bar"><h4>'.$strNombre.'  </h4></div>               
	<div class="divideritem" style="width:20%; float:left;padding:.5em;">
	    <div class="sombra"></div>
		<div class="box-img"><img src="../../images_productos/'.$strImagen.'" alt="" width="120"/></div>
		
	</div>
	
	<div class="divideritem" style="width:45%;float:left;padding:.5em;">
		<p style="margin: 8px 0 0 0">'.$strDetalle.'</p>
		
	</div>
	
	<div class="divideritem" style="width:20%;float:left;padding:.5em;">
	<div class="box-pre">
	<div class="box-v"><p>VALOR<p></div>
		<p style="color"><strong> $'.$dblPrecio.' </strong></p> <div class="box-iva"><p>+ IVA</p></div>
		</div>
		<div class="box-detalle"><p>ID: '.$idProducto.'</p>
		<p>'.$stock.'</p>
		'.$talles_item.'</div>
	</div>
	<hr style="margin: 50px 0 8px 0;border-top: 1px solid #ccc">
	<div class="opcionesitem">
		<a href="e_producto.php?id='.$idProducto.'">Editar</a>
		<a href="d_producto.php?id='.$idProducto.'">Borrar</a>
	</div>
</div>

';




}else{
$item .= '

<div class="item">
<div class="purple-bar"><h4>'.$strNombre.'</h4></div> 
	<div class="divideritem" style="width:25%; float:left; padding:.5em">
		<div style="width:120px; height:120px; float:left; margin:.5em; background:#ccc;"></div>
		
	</div>
	
	<div class="divideritem" style="width:45%;float:left;padding:.5em">
		<p>'.$strDetalle.'</p>
		
	</div>
	
	<div class="divideritem" style="width:20%;float:left;padding:.5em">
	 	<p><strong>VALOR: $'.$dblPrecio.' </strong>+ IVA</p>
		<p>ID: '.$idProducto.'</p>
		'.$stock.'
		<p>'.$talles_item.'</p>
	</div>
	<div class="opcionesitem">
		<a href="e_producto.php?id='.$idProducto.'">Editar</a>
		<a href="d_producto.php?id='.$idProducto.'">Borrar</a>
	</div>
</div>

';


}


echo $item; //'<p></p>';
$talles_item="";
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
function productos_drop_list(){

$sql ="SELECT * FROM productos ;";
$result = $this->database->query($sql);
$result = $this->database->result;
while($row = mysql_fetch_array($result)){
$id= $row['id_productos'];
$name= $row['name_productos'];
echo '<option value='.$id.'>'.$name.'</option>';
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

$sql = "INSERT INTO productos ( strNombre,strDetalle,intCategoria,dblPrecio,intStock,strImagen,strImagen2,strImagen3 ) VALUES ( '$this->strNombre','$this->strDetalle','$this->intCategoria','$this->dblPrecio','$this->intStock','$this->strImagen','$this->strImagen2','$this->strImagen3' )";
$result = $this->database->query($sql);
return $this->idProducto = mysql_insert_id($this->database->link);

}


/* UPDATE */

function update($id){

$sql = " UPDATE productos SET  strNombre = '$this->strNombre',strDetalle = '$this->strDetalle',intCategoria = '$this->intCategoria',dblPrecio = '$this->dblPrecio',intStock = '$this->intStock',strImagen = '$this->strImagen',strImagen2 = '$this->strImagen2',strImagen3 = '$this->strImagen3' WHERE idProducto = $id ";

$result = $this->database->query($sql);

}

} // class : end

?>