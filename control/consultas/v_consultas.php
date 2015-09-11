<?php 
include_once('../resources/control.php');
include_once('helper_titulos.php');
error_reporting(E_ALL);
ini_set('display_errors', 'On');

/**
 * @internal  LIBS (CORE)
 */
require_once('../../libs.php');

$consultas = new Consulta();
if(isset($_POST['submit'])):
	$collection = $consultas->filtro();
else:
	$collection = $consultas->getAdmin();
endif;

?>
<!DOCTYPE html>
<html>
<head>

	<?php include_once('../resources/includes.php'); ?>
	
	

	<!-- charset -->
	<meta charset="utf-8">
	<!-- Mobile Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<!-- Description -->
	<meta name="description" content="">

<style type="text/css">

.fecha{
	font-size: 14px;
	color: #008752;
	float: right;
}
</style>

<?php include_once('../resources/includes.php'); ?>
<script type="text/javascript">
function changueoferta(div){
$('#oferta'+div).load('changue_oferta.php?id='+div);
}
</script>
<script type="text/javascript"> 
$(document).ready(function(){
    $("#simpleform").validate({
      event: "blur",
      rules: {
       nombre: { 
		required: true, 
		minlength: 2 
		},
		     
      
      },
      messages: {
        nombre: { 
		required: " Complete nombre de tipo", 
		minlength: "* 2 caracteres minimo." 
		},
			
             
        },
      debug: true,
      errorElement: "p",
      submitHandler: function(form){
         //alert('Los datos seran enviados');
          form.submit();
      }
   });
});
</script> 
<script type="text/javascript">
$(function() {
$("#fecha").datepicker({altFormat: 'yy-mm-dd'});

});
</script>
</head>
<body>
<!-- Header -->

	<?php include_once('../inc/header.php') ?>

<div class="block">
	
<div class="contenedor-filtros">
	<div class="sub-contenedor">
		<div class="filtros">   
            <form action="" method="POST"> 
            <input type="hidden" name="filter"> 
                  	<h3> FILTRAR POR:</h3>   
                 	<select name="vendedores">                     
                  		<option value="">TODOS LOS VENDEDORES</option>
                  		<?php Vendedor::options(); ?>
                 	</select>
                 	<select name="estado">                     
                  		<option value="">ESTADO</option>
                  		<option value="1">RESPONDIDO</option> 
                  		<option value="0">NO RESPONDIDO</option> 
                 	</select>    
                  	<!-- <select name="">   
                    		<option value="">CLIENTE</option>   
                    	</select>     -->
                    <input type="hidden" name="submit" >
                  	<button class="button-image" type="submit"><img src="../layout/ver.png" alt=""> VER RESULTADOS </button>
            </form>    
      	</div>
	</div>
</div>

<div class="prod_container">
<div class="three_444 contenedor-default">

<?php foreach($collection as $k => $val): ?>
<div id="content-consultas">
	<div class="left"><!-- left -->
		<div class="receipt ">
			<?php echo($val->strEmpresa) ?>
		</div>
		<div class="qry">
			<div class="date">
				<p>
					<?php Consulta::formatDate($val->fecha) ?>
					<br>
					<span>
					<?php Consulta::formatTime($val->fecha) ?>
					</span>
				</p>
			</div>
			<div class="message">
				<p>
					<span>
						consulta
					</span>
	
					<?php echo $val->strCampo ?>
				</p>
			</div>
		</div>
		
		<?php 
			if(!empty($val->respuestas)):
				foreach($val->respuestas as $kRespuesta => $respuesta):
		 ?>
		<div class="answer">
			<div class="date">
				<p>
					<?php Consulta::formatDate($respuesta->fecha) ?>
					<br>
					<span>
						<?php Consulta::formatTime($respuesta->fecha) ?>
					</span>
				</p>
			</div>
			<div class="message">
				<p>
					<span>
						respuesta
					</span>
					<?php echo $respuesta->strCampo ?>
				</p>
			</div>
		</div>
		<?php 
				endforeach;
			endif;
		 ?>
	</div>
		
	<div class="right"><!-- right -->
		<a href="responder_consulta.php?id=<?php echo $val->idConsulta ?>&activo=2&sub=f">
			responder
		</a>
		<span>
			<?php 
				if($val->respondido == 1):
					echo("respondido");
				else:
					echo("sin responder");
				endif;
			 ?>
		</span>
	</div>
</div><!-- end #content-consultas -->
<?php endforeach; ?>
<!--SIDEBAR ADMINISTRADOR
<div class="product_filter_consulta_column">
<div class="item">
<a href="v_consultas.php?activo=2&sub=f&respondido=todos"><div class="olive-bar_new3"><span>VER TODOS</span></div></a>
</div><div class="item">

	<a href="v_consultas.php?activo=2&sub=f&respondido=0"><div class="pub-eve"><span>NO LEIDO</span></div></a>

	<a href="v_consultas.php?activo=2&sub=f&respondido=0"><div class="pub-eve2"><span>PENDIENTE</span></div></a>
	
	<a href="v_consultas.php?activo=2&sub=f&respondido=1"><div class="pub-eve4"><span>RESPONDIDA</span></div></a>

	</div>
</div>			
-->
<?php
// if($_SESSION['msg_ok']){echo '<div class="notify_ok"><p>'.$_SESSION['msg_ok'].'</p></div>'; unset($_SESSION['msg_ok']);}
// if($_SESSION['msg_error']){echo '<div class="notify_error"><p>'.$_SESSION['msg_error'].'</p></div>'; unset($_SESSION['msg_error']);}
// if($_SESSION['msg_warning']){echo '<div class="notify_warning"><p>'.$_SESSION['msg_warning'].'</p></div>'; unset($_SESSION['msg_warning']);}


// $pagina=$_GET['page'];
// $ipp=$_GET['ipp'];
// if(!$pagina){
// $pagina==0;
// }
// $orden= $_GET['orden'];

// if($orden==1){
// $orden = "idConsulta DESC";
// }
// if($orden==2){
// $orden = "idConsulta ASC";
// }
// if($orden==3){
// $orden = "idConsulta ASC";
// }
// if($orden==""){
// $orden = "idConsulta ASC";
// }

// echo '<div class="menuorden"><a href="v_consultas.php?orden=1"><img src="../layout/btn-orden1.png" alt="desc"/></a><a href="v_consultas.php?orden=2"><img src="../layout/btn-orden2.png" alt="desc"/></a></div>';
/* SELECT */
// include_once("classes/class.consultas.php");
// $consultas= new consultas();
// $consultas->select_all($pagina, $orden);

?>	
</div>
<?php include_once('../inc/footer.php') ?>
</div><!-- end block -->
</div>
</body></html>