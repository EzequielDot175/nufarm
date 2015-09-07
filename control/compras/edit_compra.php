<?php 
	require_once('../../libs.php');

	Auth::checkAdmin();
	$detalleCompra = new DetalleCompra();
?>
<!DOCTYPE html>
<html>
<head>

  <title></title>
  <link rel="stylesheet" type="text/css" media="all" href="../layout/base.css" />
  <link rel="stylesheet" type="text/css" media="all" href="../layout/header-footer-columns.css" />
  <link rel="stylesheet" type="text/css" media="all" href="../layout/forms.css" />
  <!-- charset -->
  <meta charset="utf-8">
  <!-- Mobile Meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <!-- Description -->
  <meta name="description" content="">

  <?php include_once('../resources/includes.php'); ?>

</head>
<body>
  <!-- Header -->

  <?php include_once('../inc/header.php') ?>


  <div class="block">
    
    <input type="hidden" name="client" value="<?php echo $cSelected ?>">

    <div class="prod_container">

      <div class="three_444 contenedor-default contenedor-A">
        <!-- /////////////////////////////////////////////BACKEND CANJES //////////////////////////////////////////////////////////-->
       



        <hr class="separador">

        <br>	
        EDITANDO CANJE REALIZADO:
        <br>	
        <br>	

		<div class="item">
			<div class="olive-bar_new2">
		        <span class="bold">Creadito Actual: 1200 </span>
		        <span class="bold">-</span>
		        <span class="bold">Credito Modificado: 1300</span>
		        <span class="fecha_tit_admin">Aceitera no</span>
		     </div>
		</div>

        <table>
         <tr class="tablacolor3 tablaDefault">
           <td  class="colA" align="center">FECHA</td>  
           <td  class="colC" align="center">PRODUCTO</td>
           <td class="colD" align="center">CANTIDAD</td>
           <td class="colE" align="center">COLOR</td>
           <td class="colF" align="center">TALLE</td>
         </tr>
		
       </table>

      
      <div class="item">

        

          <form name="listado_productos" id="estform" action="update_proceso.php" method="post">

            <div class="estadopedido_box">

              <input type="hidden" name="id_compra" value="356">

              <select name="estado_compra" id="estado1">
                <option value="1" selected="selected">Pendiente</option>
                <option value="2">Finalizado</option>
              </select>


            </div>


            <table>
              <tbody>
                <tr class="tablaDetalle tablaDefault">
                  <td class="colE tdBackground" style="width: 10%;" align="center">
                    <span></span>
                  </td>
                 
                  <td class="colC tdBackground" align="center">

                    <div class="sub">
                    	<img class="imagen" src="../../images_productos/" alt="">
                    </div>

                    <div class="sub text ">
                    	<spa class="bold">345p</span>
                  	</div>

                    <span class="sub text">Chaleco nextt</span>
                  </td>
                  
                  <td class="colE tdBackground" align="center">
                    <span></span>
                  </td>
                  <td class="colF tdBackground" align="center">
                    <span></span>
                  </td>
                  <td class="colG tdBackground" align="center">

                  </td>
                  
                </tr>

              </tbody>
            </table>

            <p> </p>
        </form>
      </div>

    

  </div>
</div>



<?php include_once('../inc/footer.php') ?></div>


</body>
</html>