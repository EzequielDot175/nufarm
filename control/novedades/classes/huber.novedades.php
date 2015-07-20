
<form method="post" action="c_novedad.php" id="simpleform" >
<fieldset>
<legend><strong> &nbsp; novedades &nbsp; </strong></legend>

<div class="form-item">

<label for="ctitulo">Titulo</label>
<p><input type="text" name="titulo" id="titulo" /></p>

</div>

<div class="form-item">

<label for="ccuerpo">Cuerpo</label>
<p><input type="text" name="cuerpo" id="cuerpo" /></p>

</div>

<div class="form-item">

<label for="cimagen">Imagen</label>
<p><input type="text" name="imagen" id="imagen" /></p>

</div>

<div class="form-item">

<label for="cfecha">Fecha</label>
<p><input type="text" name="fecha" id="fecha" /></p>

</div>


<div class="form-item">
<p><button type="submit">Aceptar</button> <button type="reset">Borrar</button> <button type="button" class="button" onClick="location.href=\'v_novedades.php\'">Cancelar</button></p>
</div>

</fieldset>
</form>

$titulo=$_POST['titulo'];
$cuerpo=$_POST['cuerpo'];
$imagen=$_POST['imagen'];
$fecha=$_POST['fecha'];


/* INSERT */
include_once("classes/class.novedades.php");
$novedades= new novedades();
$novedades->idNovedades=$idNovedades;
$novedades->titulo=$titulo;
$novedades->cuerpo=$cuerpo;
$novedades->imagen=$imagen;
$novedades->fecha=$fecha;
$novedades->insert();

echo '<div class="notify"><p>novedad Creada!</p><p><a href="v_novedades.php">Regresar</a></p></div>';

$id =$_GET['id'];
/* SELECT */
include_once("classes/class.novedades.php");
$novedades= new novedades();
$novedades->select($id);
$idNovedades=$novedades->getidNovedades();
$titulo=$novedades->gettitulo();
$cuerpo=$novedades->getcuerpo();
$imagen=$novedades->getimagen();
$fecha=$novedades->getfecha();

<form method="post" action="u_novedad.php" id="simpleform"  >
<fieldset>
<legend><strong> &nbsp; novedades &nbsp; </strong></legend>


<div class="form-item">
<label for="ctitulo">Titulo</label>
<input type="text" name="titulo" id="titulo" value="<?php echo $titulo;?>" />
</div>


<div class="form-item">
<label for="ccuerpo">Cuerpo</label>
<input type="text" name="cuerpo" id="cuerpo" value="<?php echo $cuerpo;?>" />
</div>


<div class="form-item">
<label for="cimagen">Imagen</label>
<input type="text" name="imagen" id="imagen" value="<?php echo $imagen;?>" />
</div>


<div class="form-item">
<label for="cfecha">Fecha</label>
<input type="text" name="fecha" id="fecha" value="<?php echo $fecha;?>" />
</div>

<input type="hidden" name="idNovedades" id="idNovedades" value="<?php echo $idNovedades; ?>" />
<div class="form-item">
<p><button type="submit">Aceptar</button> <button type="button" class="btnback" onclick="javascript:history.back(1)">Cancelar</button></p>
</div>

</fieldset>
</form>
$idNovedades = $_POST['idNovedades'];
$titulo=$_POST['titulo'];
$cuerpo=$_POST['cuerpo'];
$imagen=$_POST['imagen'];
$fecha=$_POST['fecha'];


/* UPDATE */
include_once("classes/class.novedades.php");
$novedades= new novedades();

$novedades->select($idNovedades);
$novedades->idNovedades=$idNovedades;
$novedades->titulo=$titulo;
$novedades->cuerpo=$cuerpo;
$novedades->imagen=$imagen;
$novedades->fecha=$fecha;
$novedades->update($idNovedades);


echo '<div class="notify"><p>novedad actualizada!</p><p><a href="v_novedades.php">Regresar</a></p></div>';

$id=$_GET['id'];

if(!$_POST['confirm'] && $_POST['pulsado']){$msgpulsado ='<div class="notify"><p>Debe marcar el campo de confirmacion para poder eliminar..</p></div>';}else{$msgpulsado="";}
echo $msgpulsado;
/* SELECT */
include_once("classes/class.novedades.php");
$novedades= new novedades();
$novedades->select($id);
$idNovedades=$novedades->getidNovedades();
$titulo=$novedades->gettitulo();
$cuerpo=$novedades->getcuerpo();
$imagen=$novedades->getimagen();
$fecha=$novedades->getfecha();

if($_POST['confirm']){
$id=$_POST['id_novedad'];

/* DELETE */

include_once("classes/class.novedades.php");
$novedades= new novedades();
$novedades->select($id);
$novedades->delete($id);

echo '<div class="notify"><p>novedad, eliminado!</p><p><a href="v_novedades.php">Regresar</a></p></div>';

}
else{
echo '<div class="dividerclean"><form action="d_novedad.php?id='.$id.'" id="simpleform" method="post">
		<fieldset>
			<legend><strong> &nbsp; novedad &nbsp; </strong></legend>
	
			<div class="form-item">
				<label for=""></label>
				<p>Confirma Eliminar este novedad? <input type="checkbox" name="confirm" id="confirm" class="checkbox" /></p>
			</p> <input type="hidden" name="id_novedad" name="id_novedad" value="'.$id.'" />
			<input type="hidden" name="pulsado" value="1" />
			</div>
	
<div class="form-item">
<button name="btnborrar" class="button">Aceptar</button> 
<button type="button" class="button" onClick="location.href=\'v_novedades.php\'">Cancelar</button></div>
	
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
$orden = "idNovedades DESC";
}
if($orden==2){
$orden = "idNovedades ASC";
}
if($orden==3){
$orden = "idNovedades ASC";
}
if($orden==""){
$orden = "idNovedades ASC";
}

echo '<div class="menuorden"><a href="v_novedades.php?orden=1"><img src="../layout/btn-orden1.jpg" alt="desc"/></a><a href="v_novedades.php?orden=2"><img src="../layout/btn-orden2.jpg" alt="desc"/></a></div>';
/* SELECT */
include_once("classes/class.novedades.php");
$novedades= new novedades();
$novedades->select_all($pagina, $orden);
<div id="ajax_titulo"><p onclick="modify_titulo();">titulo</p></div>
<div id="ajax_cuerpo"><p onclick="modify_cuerpo();">cuerpo</p></div>
<div id="ajax_imagen"><p onclick="modify_imagen();">imagen</p></div>
<div id="ajax_fecha"><p onclick="modify_fecha();">fecha</p></div>
