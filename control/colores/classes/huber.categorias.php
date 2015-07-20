
<form method="post" action="c_categoria.php" id="simpleform" >
<fieldset>
<legend><strong> &nbsp; categorias &nbsp; </strong></legend>

<div class="form-item">

<label for="cstrDescripcion">StrDescripcion</label>
<p><input type="text" name="strDescripcion" id="strDescripcion" /></p>

</div>

<div class="form-item">

<label for="ctalles">Talles</label>
<p><input type="text" name="talles" id="talles" /></p>

</div>


<div class="form-item">
<p><button type="submit">Aceptar</button> <button type="reset">Borrar</button> <button type="button" class="button" onClick="location.href=\'v_categorias.php\'">Cancelar</button></p>
</div>

</fieldset>
</form>

$strDescripcion=$_POST['strDescripcion'];
$talles=$_POST['talles'];


/* INSERT */
include_once("classes/class.categorias.php");
$categorias= new categorias();
$categorias->idCategorias=$idCategorias;
$categorias->strDescripcion=$strDescripcion;
$categorias->talles=$talles;
$categorias->insert();

echo '<div class="notify"><p>categoria Creada!</p><p><a href="v_categorias.php">Regresar</a></p></div>';

$id =$_GET['id'];
/* SELECT */
include_once("classes/class.categorias.php");
$categorias= new categorias();
$categorias->select($id);
$idCategorias=$categorias->getidCategorias();
$strDescripcion=$categorias->getstrDescripcion();
$talles=$categorias->gettalles();

<form method="post" action="u_categoria.php" id="simpleform"  >
<fieldset>
<legend><strong> &nbsp; categorias &nbsp; </strong></legend>


<div class="form-item">
<label for="cstrDescripcion">StrDescripcion</label>
<input type="text" name="strDescripcion" id="strDescripcion" value="<?php echo $strDescripcion;?>" />
</div>


<div class="form-item">
<label for="ctalles">Talles</label>
<input type="text" name="talles" id="talles" value="<?php echo $talles;?>" />
</div>

<input type="hidden" name="idCategorias" id="idCategorias" value="<?php echo $idCategorias; ?>" />
<div class="form-item">
<p><button type="submit">Aceptar</button> <button type="button" class="btnback" onclick="javascript:history.back(1)">Cancelar</button></p>
</div>

</fieldset>
</form>
$idCategorias = $_POST['idCategorias'];
$strDescripcion=$_POST['strDescripcion'];
$talles=$_POST['talles'];


/* UPDATE */
include_once("classes/class.categorias.php");
$categorias= new categorias();

$categorias->select($idCategorias);
$categorias->idCategorias=$idCategorias;
$categorias->strDescripcion=$strDescripcion;
$categorias->talles=$talles;
$categorias->update($idCategorias);


echo '<div class="notify"><p>categoria actualizada!</p><p><a href="v_categorias.php">Regresar</a></p></div>';

$id=$_GET['id'];

if(!$_POST['confirm'] && $_POST['pulsado']){$msgpulsado ='<div class="notify"><p>Debe marcar el campo de confirmacion para poder eliminar..</p></div>';}else{$msgpulsado="";}
echo $msgpulsado;
/* SELECT */
include_once("classes/class.categorias.php");
$categorias= new categorias();
$categorias->select($id);
$idCategorias=$categorias->getidCategorias();
$strDescripcion=$categorias->getstrDescripcion();
$talles=$categorias->gettalles();

if($_POST['confirm']){
$id=$_POST['id_categoria'];

/* DELETE */

include_once("classes/class.categorias.php");
$categorias= new categorias();
$categorias->select($id);
$categorias->delete($id);

echo '<div class="notify"><p>categoria, eliminado!</p><p><a href="v_categorias.php">Regresar</a></p></div>';

}
else{
echo '<div class="dividerclean"><form action="d_categoria.php?id='.$id.'" id="simpleform" method="post">
		<fieldset>
			<legend><strong> &nbsp; categoria &nbsp; </strong></legend>
	
			<div class="form-item">
				<label for=""></label>
				<p>Confirma Eliminar este categoria? <input type="checkbox" name="confirm" id="confirm" class="checkbox" /></p>
			</p> <input type="hidden" name="id_categoria" name="id_categoria" value="'.$id.'" />
			<input type="hidden" name="pulsado" value="1" />
			</div>
	
<div class="form-item">
<button name="btnborrar" class="button">Aceptar</button> 
<button type="button" class="button" onClick="location.href=\'v_categorias.php\'">Cancelar</button></div>
	
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
$orden = "idCategorias DESC";
}
if($orden==2){
$orden = "idCategorias ASC";
}
if($orden==3){
$orden = "idCategorias ASC";
}
if($orden==""){
$orden = "idCategorias ASC";
}

echo '<div class="menuorden"><a href="v_categorias.php?orden=1"><img src="../layout/btn-orden1.jpg" alt="desc"/></a><a href="v_categorias.php?orden=2"><img src="../layout/btn-orden2.jpg" alt="desc"/></a></div>';
/* SELECT */
include_once("classes/class.categorias.php");
$categorias= new categorias();
$categorias->select_all($pagina, $orden);
<div id="ajax_strDescripcion"><p onclick="modify_strDescripcion();">strDescripcion</p></div>
<div id="ajax_talles"><p onclick="modify_talles();">talles</p></div>
