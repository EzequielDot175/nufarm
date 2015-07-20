
<form method="post" action="c_consulta.php" id="simpleform" >
<fieldset>
<legend><strong> &nbsp; consultas &nbsp; </strong></legend>

<div class="form-item">

<label for="cidUsuario">IdUsuario</label>
<p><input type="text" name="idUsuario" id="idUsuario" /></p>

</div>

<div class="form-item">

<label for="cstrAsunto">StrAsunto</label>
<p><input type="text" name="strAsunto" id="strAsunto" /></p>

</div>

<div class="form-item">

<label for="cstrCampo">StrCampo</label>
<p><input type="text" name="strCampo" id="strCampo" /></p>

</div>


<div class="form-item">
<p><button type="submit">Aceptar</button> <button type="reset">Borrar</button> <button type="button" class="button" onClick="location.href=\'v_consultas.php\'">Cancelar</button></p>
</div>

</fieldset>
</form>

$idUsuario=$_POST['idUsuario'];
$strAsunto=$_POST['strAsunto'];
$strCampo=$_POST['strCampo'];


/* INSERT */
include_once("classes/class.consultas.php");
$consultas= new consultas();
$consultas->idConsulta=$idConsulta;
$consultas->idUsuario=$idUsuario;
$consultas->strAsunto=$strAsunto;
$consultas->strCampo=$strCampo;
$consultas->insert();

echo '<div class="notify"><p>consulta Creada!</p><p><a href="v_consultas.php">Regresar</a></p></div>';

$id =$_GET['id'];
/* SELECT */
include_once("classes/class.consultas.php");
$consultas= new consultas();
$consultas->select($id);
$idConsulta=$consultas->getidConsulta();
$idUsuario=$consultas->getidUsuario();
$strAsunto=$consultas->getstrAsunto();
$strCampo=$consultas->getstrCampo();

<form method="post" action="u_consulta.php" id="simpleform"  >
<fieldset>
<legend><strong> &nbsp; consultas &nbsp; </strong></legend>


<div class="form-item">
<label for="cidUsuario">IdUsuario</label>
<input type="text" name="idUsuario" id="idUsuario" value="<?php echo $idUsuario;?>" />
</div>


<div class="form-item">
<label for="cstrAsunto">StrAsunto</label>
<input type="text" name="strAsunto" id="strAsunto" value="<?php echo $strAsunto;?>" />
</div>


<div class="form-item">
<label for="cstrCampo">StrCampo</label>
<input type="text" name="strCampo" id="strCampo" value="<?php echo $strCampo;?>" />
</div>

<input type="hidden" name="idConsulta" id="idConsulta" value="<?php echo $idConsulta; ?>" />
<div class="form-item">
<p><button type="submit">Aceptar</button> <button type="button" class="btnback" onclick="javascript:history.back(1)">Cancelar</button></p>
</div>

</fieldset>
</form>
$idConsulta = $_POST['idConsulta'];
$idUsuario=$_POST['idUsuario'];
$strAsunto=$_POST['strAsunto'];
$strCampo=$_POST['strCampo'];


/* UPDATE */
include_once("classes/class.consultas.php");
$consultas= new consultas();

$consultas->select($idConsulta);
$consultas->idConsulta=$idConsulta;
$consultas->idUsuario=$idUsuario;
$consultas->strAsunto=$strAsunto;
$consultas->strCampo=$strCampo;
$consultas->update($idConsulta);


echo '<div class="notify"><p>consulta actualizada!</p><p><a href="v_consultas.php">Regresar</a></p></div>';

$id=$_GET['id'];

if(!$_POST['confirm'] && $_POST['pulsado']){$msgpulsado ='<div class="notify"><p>Debe marcar el campo de confirmacion para poder eliminar..</p></div>';}else{$msgpulsado="";}
echo $msgpulsado;
/* SELECT */
include_once("classes/class.consultas.php");
$consultas= new consultas();
$consultas->select($id);
$idConsulta=$consultas->getidConsulta();
$idUsuario=$consultas->getidUsuario();
$strAsunto=$consultas->getstrAsunto();
$strCampo=$consultas->getstrCampo();

if($_POST['confirm']){
$id=$_POST['id_consulta'];

/* DELETE */

include_once("classes/class.consultas.php");
$consultas= new consultas();
$consultas->select($id);
$consultas->delete($id);

echo '<div class="notify"><p>consulta, eliminado!</p><p><a href="v_consultas.php">Regresar</a></p></div>';

}
else{
echo '<div class="dividerclean"><form action="d_consulta.php?id='.$id.'" id="simpleform" method="post">
		<fieldset>
			<legend><strong> &nbsp; consulta &nbsp; </strong></legend>
	
			<div class="form-item">
				<label for=""></label>
				<p>Confirma Eliminar este consulta? <input type="checkbox" name="confirm" id="confirm" class="checkbox" /></p>
			</p> <input type="hidden" name="id_consulta" name="id_consulta" value="'.$id.'" />
			<input type="hidden" name="pulsado" value="1" />
			</div>
	
<div class="form-item">
<button name="btnborrar" class="button">Aceptar</button> 
<button type="button" class="button" onClick="location.href=\'v_consultas.php\'">Cancelar</button></div>
	
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
$orden = "idConsulta DESC";
}
if($orden==2){
$orden = "idConsulta ASC";
}
if($orden==3){
$orden = "idConsulta ASC";
}
if($orden==""){
$orden = "idConsulta ASC";
}

echo '<div class="menuorden"><a href="v_consultas.php?orden=1"><img src="../layout/btn-orden1.jpg" alt="desc"/></a><a href="v_consultas.php?orden=2"><img src="../layout/btn-orden2.jpg" alt="desc"/></a></div>';
/* SELECT */
include_once("classes/class.consultas.php");
$consultas= new consultas();
$consultas->select_all($pagina, $orden);
<div id="ajax_idUsuario"><p onclick="modify_idUsuario();">idUsuario</p></div>
<div id="ajax_strAsunto"><p onclick="modify_strAsunto();">strAsunto</p></div>
<div id="ajax_strCampo"><p onclick="modify_strCampo();">strCampo</p></div>
