
<form method="post" action="c_producto.php" id="simpleform" enctype="multipart/form-data">
<fieldset>
<legend><strong> &nbsp; productos &nbsp; </strong></legend>

<div class="form-item">

<label for="cstrNombre">StrNombre</label>
<p><input type="text" name="strNombre" id="strNombre" /></p>

</div>

<div class="form-item">

<label for="cstrDetalle">StrDetalle</label>
<p><input type="text" name="strDetalle" id="strDetalle" /></p>

</div>

<div class="form-item">

<label for="cintCategoria">IntCategoria</label>
<p><input type="text" name="intCategoria" id="intCategoria" /></p>

</div>

<div class="form-item">

<label for="cdblPrecio">DblPrecio</label>
<p><input type="text" name="dblPrecio" id="dblPrecio" /></p>

</div>

<div class="form-item">

<label for="cintStock">IntStock</label>
<p><input type="text" name="intStock" id="intStock" /></p>

</div>

<div class="form-item">

<label for="cstrImagen">StrImagen</label>
<p><input type="text" name="strImagen" id="strImagen" /></p>

</div>

<div class="form-item">

<label for="cstrImagen2">StrImagen2</label>
<p><input type="text" name="strImagen2" id="strImagen2" /></p>

</div>

<div class="form-item">

<label for="cstrImagen3">StrImagen3</label>
<p><input type="text" name="strImagen3" id="strImagen3" /></p>

</div>


<div class="form-item">
<p><button type="submit">Aceptar</button> <button type="reset">Borrar</button> <button type="button" class="button" onClick="location.href=\'v_productos.php\'">Cancelar</button></p>
</div>

</fieldset>
</form>

$strNombre=$_POST['strNombre'];
$strDetalle=$_POST['strDetalle'];
$intCategoria=$_POST['intCategoria'];
$dblPrecio=$_POST['dblPrecio'];
$intStock=$_POST['intStock'];
$strImagen=$_POST['strImagen'];
$strImagen2=$_POST['strImagen2'];
$strImagen3=$_POST['strImagen3'];


/* INSERT */
include_once("classes/class.productos.php");
$productos= new productos();
$productos->idProducto=$idProducto;
$productos->strNombre=$strNombre;
$productos->strDetalle=$strDetalle;
$productos->intCategoria=$intCategoria;
$productos->dblPrecio=$dblPrecio;
$productos->intStock=$intStock;
$productos->strImagen=$strImagen;
$productos->strImagen2=$strImagen2;
$productos->strImagen3=$strImagen3;
$productos->insert();

echo '<div class="notify"><p>producto Creada!</p><p><a href="v_productos.php">Regresar</a></p></div>';

$id =$_GET['id'];
/* SELECT */
include_once("classes/class.productos.php");
$productos= new productos();
$productos->select($id);
$idProducto=$productos->getidProducto();
$strNombre=$productos->getstrNombre();
$strDetalle=$productos->getstrDetalle();
$intCategoria=$productos->getintCategoria();
$dblPrecio=$productos->getdblPrecio();
$intStock=$productos->getintStock();
$strImagen=$productos->getstrImagen();
$strImagen2=$productos->getstrImagen2();
$strImagen3=$productos->getstrImagen3();

<form method="post" action="u_producto.php" id="simpleform"  enctype="multipart/form-data">
<fieldset>
<legend><strong> &nbsp; productos &nbsp; </strong></legend>


<div class="form-item">
<label for="cstrNombre">StrNombre</label>
<input type="text" name="strNombre" id="strNombre" value="<?php echo $strNombre;?>" />
</div>


<div class="form-item">
<label for="cstrDetalle">StrDetalle</label>
<input type="text" name="strDetalle" id="strDetalle" value="<?php echo $strDetalle;?>" />
</div>


<div class="form-item">
<label for="cintCategoria">IntCategoria</label>
<input type="text" name="intCategoria" id="intCategoria" value="<?php echo $intCategoria;?>" />
</div>


<div class="form-item">
<label for="cdblPrecio">DblPrecio</label>
<input type="text" name="dblPrecio" id="dblPrecio" value="<?php echo $dblPrecio;?>" />
</div>


<div class="form-item">
<label for="cintStock">IntStock</label>
<input type="text" name="intStock" id="intStock" value="<?php echo $intStock;?>" />
</div>


<div class="form-item">
<label for="cstrImagen">StrImagen</label>
<input type="text" name="strImagen" id="strImagen" value="<?php echo $strImagen;?>" />
</div>


<div class="form-item">
<label for="cstrImagen2">StrImagen2</label>
<input type="text" name="strImagen2" id="strImagen2" value="<?php echo $strImagen2;?>" />
</div>


<div class="form-item">
<label for="cstrImagen3">StrImagen3</label>
<input type="text" name="strImagen3" id="strImagen3" value="<?php echo $strImagen3;?>" />
</div>

<input type="hidden" name="idProducto" id="idProducto" value="<?php echo $idProducto; ?>" />
<div class="form-item">
<p><button type="submit">Aceptar</button> <button type="button" class="btnback" onclick="javascript:history.back(1)">Cancelar</button></p>
</div>

</fieldset>
</form>
$idProducto = $_POST['idProducto'];
$strNombre=$_POST['strNombre'];
$strDetalle=$_POST['strDetalle'];
$intCategoria=$_POST['intCategoria'];
$dblPrecio=$_POST['dblPrecio'];
$intStock=$_POST['intStock'];
$strImagen=$_POST['strImagen'];
$strImagen2=$_POST['strImagen2'];
$strImagen3=$_POST['strImagen3'];


/* UPDATE */
include_once("classes/class.productos.php");
$productos= new productos();

$productos->select($idProducto);
$productos->idProducto=$idProducto;
$productos->strNombre=$strNombre;
$productos->strDetalle=$strDetalle;
$productos->intCategoria=$intCategoria;
$productos->dblPrecio=$dblPrecio;
$productos->intStock=$intStock;
$productos->strImagen=$strImagen;
$productos->strImagen2=$strImagen2;
$productos->strImagen3=$strImagen3;
$productos->update($idProducto);


echo '<div class="notify"><p>producto actualizada!</p><p><a href="v_productos.php">Regresar</a></p></div>';

$id=$_GET['id'];

if(!$_POST['confirm'] && $_POST['pulsado']){$msgpulsado ='<div class="notify"><p>Debe marcar el campo de confirmacion para poder eliminar..</p></div>';}else{$msgpulsado="";}
echo $msgpulsado;
/* SELECT */
include_once("classes/class.productos.php");
$productos= new productos();
$productos->select($id);
$idProducto=$productos->getidProducto();
$strNombre=$productos->getstrNombre();
$strDetalle=$productos->getstrDetalle();
$intCategoria=$productos->getintCategoria();
$dblPrecio=$productos->getdblPrecio();
$intStock=$productos->getintStock();
$strImagen=$productos->getstrImagen();
$strImagen2=$productos->getstrImagen2();
$strImagen3=$productos->getstrImagen3();

if($_POST['confirm']){
$id=$_POST['id_producto'];

/* DELETE */

include_once("classes/class.productos.php");
$productos= new productos();
$productos->select($id);
$productos->delete($id);

echo '<div class="notify"><p>producto, eliminado!</p><p><a href="v_productos.php">Regresar</a></p></div>';

}
else{
echo '<div class="dividerclean"><form action="d_producto.php?id='.$id.'" id="simpleform" method="post">
		<fieldset>
			<legend><strong> &nbsp; producto &nbsp; </strong></legend>
	
			<div class="form-item">
				<label for=""></label>
				<p>Confirma Eliminar este producto? <input type="checkbox" name="confirm" id="confirm" class="checkbox" /></p>
			</p> <input type="hidden" name="id_producto" name="id_producto" value="'.$id.'" />
			<input type="hidden" name="pulsado" value="1" />
			</div>
	
<div class="form-item">
<button name="btnborrar" class="button">Aceptar</button> 
<button type="button" class="button" onClick="location.href=\'v_productos.php\'">Cancelar</button></div>
	
		</fieldset>
	</form></div>
';
} 
$pagina=$_GET['page'];
$ipp=$_GET['ipp'];
if(!$pagina){
$pagina==0;
}
$orden= $_GET['orden'];

if($orden==1){
$orden = "idProducto DESC";
}
if($orden==2){
$orden = "idProducto ASC";
}
if($orden==3){
$orden = "idProducto ASC";
}
if($orden==""){
$orden = "idProducto ASC";
}

echo '<div class="menuorden"><a href="v_productos.php?orden=1"><img src="../layout/btn-orden1.jpg" alt="desc"/></a><a href="v_productos.php?orden=2"><img src="../layout/btn-orden2.jpg" alt="desc"/></a></div>';
/* SELECT */
include_once("classes/class.productos.php");
$productos= new productos();
$productos->select_all($pagina, $orden);
<div id="ajax_strNombre"><p onclick="modify_strNombre();">strNombre</p></div>
<div id="ajax_strDetalle"><p onclick="modify_strDetalle();">strDetalle</p></div>
<div id="ajax_intCategoria"><p onclick="modify_intCategoria();">intCategoria</p></div>
<div id="ajax_dblPrecio"><p onclick="modify_dblPrecio();">dblPrecio</p></div>
<div id="ajax_intStock"><p onclick="modify_intStock();">intStock</p></div>
<div id="ajax_strImagen"><p onclick="modify_strImagen();">strImagen</p></div>
<div id="ajax_strImagen2"><p onclick="modify_strImagen2();">strImagen2</p></div>
<div id="ajax_strImagen3"><p onclick="modify_strImagen3();">strImagen3</p></div>
