<?php require_once('Connections/conexion.php'); ?>


<?php include("includes/header.php"); ?>
<section>
<?php $activo = $_GET['activo']; include_once("includes/menu.php"); ?>
<aside>
<?php include("includes/catalogo2.php"); ?>
</aside>
      <article>
        <div class="inicio">
          <div class="slide_btn"></div>
		   <div class="welcometitle"><h2>Bienvenido a la edición 2014 del Catálogo Marketing Net</h2></div>
          <div class="inicio2">
            <video width="691" height="385" controls>
			<source src="video/Entering_The_Stronghold_Audio_Visual_Animation_HD.mp4" type="video/mp4">
			<source src="video/Entering_The_Stronghold_Audio_Visual_Animation_HD.ogv" type="video/ogg">
			<source src="video/Entering_The_Stronghold_Audio_Visual_Animation_HD.webm" type="video/webm">
			Your browser does not support the video tag.
			</video>
		
            <div class="cont original">
              <div class="tx-left">           
                <img class="item6" src="imagenes/item7.png" width="67" height="42" />
                <p>Se trata de una iniciativa de cooperación integral, que Nufarm le brinda a un grupo de distribuidores
                seleccionados, con el fin de realizar acciones de marketing en conjunto.</p>
              </div>
            </div>

            <div class="cont original">
              <div class="tx-left">
                <img class="item7" src="imagenes/item8.png" width="72" height="33" />
                <p>El objetivo de este programa es generar un vínculo directo entre Nufarm y su red de distribuidores, unificando
                la comunicación y la aplicación la imagen corporativa.</p>
              </div>
            </div>

             <div class="cont original">
              <div class="tx-left">
                <img class="item7" src="imagenes/item9.png" width="73" height="34" />
                <p>Vigencia del programa:<br> 
19 de Septiembre al 31 de Julio 2015. La asignación no es acumulable por lo que todos los canjes que no ingresen dentro de ese período no serán contemplados. </p>
              </div>
            </div>

            <div class="subtitulo original">LAS PÁGINAS SUCESIVAS CONTIENEN INFORMACIÓN ÚTIL PARA LLEVAR ADELANTE LAS SIGUIENTES
            ACCIONES:</div>
            <!--<div class="pie-inicio">EL PAGO DE LAS ACCIONES SERÁ ABONADO POR NUFARM DE ACUERDO A UN PRESUPUESTO ASIGNADO. EL MONTO QUE LE CORRESPONDE A CADA DISTRIBUIDOR, SERÁ INFORMADO POR EL REPRESENTANTE TÉCNICO-COMERCIAL DE NUFARM.
    <br><br>EN CASO DE QUE EL GASTO SUPERE EL PRESUPUESTO, NUFARM OFRECE DOS ALTERNATIVAS, QUE DEPENDEN DEL DESTINO DEL DINERO:
     <br><br>
     A) NUFARM ABANDONARÁ EL EXCEDENTE Y LUEGO HARÁ UNA NOTA DE DÉBITO QUE EL CLIENTE DEBERÁ CANCELAR.
     <br>
    B) NUFARM ABONARÁ SOLO EL PRESUPUESTO ASIGNADO Y EL CLIENTE SE ENCARGARÁ DE ABONAR EL EXCEDENTE.
    </div>-->
          </div>
        </div>
      </article><?php include("includes/menu2.php"); ?>
<article>
      <div class="mcuenta_bg">

<div class="resultados">
<h4>Resultado de Busqueda</h4>
</div><!--/resultados-->

<div class="box-content-resultado">
<div class="box-content bc_width">
<?php  
include_once('includes/class.productos.php');
$busqueda= $_POST['buscar'];
$search = new productos();
$search->select_busqueda($busqueda);

?>

 </div><!---- Fin box-content ---->
</div><!---- Fin box-content-resultado ---->
 </div>
</article>
<?php include("includes/footer.php"); ?>
</section>
