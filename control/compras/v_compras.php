<?php 
// error_reporting(E_ALL);
// ini_set('display_errors', 'On');
include_once('../resources/control.php');
include_once('helper_titulos.php');
require_once('../../libs.php');

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
     <?php
        $vSelected = Filter::idSelected('vendedor');
        $cSelected = Filter::idSelected('cliente');
        $eSelected = Filter::idSelected('estado');
        ?>
    <input type="hidden" name="client" value="<?php echo $cSelected ?>">

    <div class="filtros_container">   
       <div class="filtros-Default filtros-100">   
            <form action="" method="POST"> 
            <input type="hidden" name="filter"> 
                  <h3> FILTRAR POR:</h3>   
                  <select name="vendedor" id="svendedor">                     
                    <option value="">VENDEDOR</option>   
                    <?php Vendedor::options($vSelected); ?>  
                 </select>    
                  
                  <select name="cliente"  id="scliente">    
                    <option value="">CLIENTE</option>    
                     <?php Cliente::options() ?> 
                  </select>  

                  <select name="estado"  id="sestado">   
                    <option value="">ESTADO</option>   
                    <?php Compra::optionsEstado($eSelected); ?>    
                  </select>    
     
                  <button class="button-image" type="submit" ><img src="../layout/ver.png" alt=""> VER LISTADO DE RESULTADOS </button>     
            </form>    
      </div>   
  </div>

    <div class="prod_container">

      <div class="three_444 contenedor-default contenedor-A">
        <!-- /////////////////////////////////////////////BACKEND CANJES //////////////////////////////////////////////////////////-->
       



        <hr class="separador">

        <div class="menuorden"><a href="v_compras.php?orden=1&activo=1&sub=c"><img src="../layout/btn-orden1.png" alt="desc"/></a><a href="v_compras.php?orden=2&activo=1&sub=c"><img src="../layout/btn-orden2.png" alt="desc"/></a></div>
        <table>
         <tr class="tablacolor3 tablaDefault">
           <td  class="colA" align="center">FECHA</td>  
           <td  class="colB" align="center">TOTAL PUNTOS</td>
           <td  class="colC" align="center">PRODUCTO</td>
           <td class="colD" align="center">CANTIDAD</td>
           <td class="colE" align="center">COLOR</td>
           <td class="colF" align="center">TALLE</td>
           <td class="colG" align="center">REMITO</td>
           <td  class="colH" align="center">ESTADO</td>
         </tr>
       </table>
       <div style="height:10px"></div>
       <?php
       /* SELECT */
       if(isset($_POST['filter'])):
        $collection = Filter::Compras($_POST);

      else:
        $collection = Compra::all();
      endif;

      foreach($collection as $key => $v):
        ?>
      <div class="item">

        <div class="olive-bar_new2">
          <span class="tit_pedido">
            <span class="bold">Usuario: <?php echo $v[0]->v_nombre ?> <?php echo $v[0]->v_apellido ?></span> / <?php echo $v[0]->email ?></span> 
            <span class="fecha_tit_admin"><?php echo $v[0]->fthCompra ?></span>
          </div>

          <form name="listado_productos" id="estform" action="update_proceso.php" method="post">

            <div class="estadopedido_box">

              <input type="hidden" name="id_compra" value="356">

              <select name="estado_compra" id="estado1">
                <option value="1" selected="selected">Pendiente</option>
                <option value="2">Finalizado</option>
              </select>

              <button type="sybmit" class="button mainbtn">GUARDAR</button>

            </div>


            <?php $i = 0;$z = 0;  foreach($v as $itemk => $itemv): ?>
            <div class="botones">
              <div class="item editar">
                <a href="edit_compra.php?id=<?php echo $itemv->id_detalle ?>">
                  <img class="imagen" src="../layout/editar.png" alt="">
                </a>
              </div>
              <div class="item borrar">
                <a class="confirm-link"  href="delete_compras.php?id=<?php echo $itemv->id_detalle ?>">
                  <img class="imagen" src="../layout/borrar.png" alt="">
                </a>
              </div>
            </div>

            <table>
              <tbody>
                <tr class="tablaDetalle tablaDefault">
                  <td class="colA" align="center">
                    <?php 
                    if($i == 0):
                      echo($itemv->fthCompra);
                    $i++;
                    endif;
                    ?>
                  </td>  
                  <td class="colB" align="center">
                    <?php 
                    if($z == 0):
                      echo($itemv->dblTotal);
                    $z++;
                    endif;
                    ?>

                  </td>
                  <td class="colC tdBackground" align="center">
                    <div class="sub"><img class="imagen" src="../../images_productos/<?php echo $itemv->prod_imagen ?>" alt=""></div>
                    <div class="sub text "><span><?php echo $itemv->precio_pagado ?></span></div>
                    <span class="sub text"><?php echo $itemv->prod_nombre ?></span>
                  </td>
                  <td class="colD tdBackground" align="center">
                    <span><?php echo $itemv->cantidad ?> </span>
                  </td>
                  <td class="colE tdBackground" align="center">
                    <span><?php echo $itemv->color ?></span>
                  </td>
                  <td class="colF tdBackground" align="center">
                    <span><?php echo $itemv->talle ?></span>
                  </td>
                  <td class="colG tdBackground" align="center">
                    <input type="text" name="remito" value="<?php echo $itemv->remito ?>" style="width:90%;">
                  </td>
                  <td class="colH tdBackground" align="center">
                    <select name="detalles[<?php echo $itemv->id_detalle ?>]" id="estado2">
                      <?php Compra::optionsEstado($itemv->estado_detalle); ?>
                    </select>
                  </td>
                </tr>

              </tbody>
            </table>

            <p> </p>
          <?php endforeach; ?>
        </form>
      </div>

      <?php
      endforeach; ?>


      <div class="navigate">
        <?php 
        $current = (isset($_GET['page']) ? $_GET['page'] : 1 );
        for ($i=1; $i <= Compra::sBarPag(); $i++): ?>
        <a class="<?php echo( $i == $current ? 'current' : 'paginate') ?>" href="?page=<?php echo($i) ?>&activo=1&sub=c"><?php echo($i) ?></a>
      <?php endfor; ?>
    </div>


  </div>
</div>







<?php include_once('../inc/footer.php') ?></div>

<script src="../js/modal.nufarm.js"></script>



<div class="modal-alert">
  <div class="box-alert">
    <span class="close-alert">Close</span>
    <h3>¿Esta seguro que desea borrar este elemento?</h3>
    <p class="pad">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui odio at, non asperiores veritatis omnis aliquid animi ipsa enim ab atque ea, quasi similique reiciendis! Voluptatibus laboriosam, sapiente amet debitis.</p>
    <p class="pad">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui odio at, non asperiores veritatis omnis aliquid animi ipsa enim ab atque ea, quasi similique reiciendis! Voluptatibus laboriosam, sapiente amet debitis.</p>
    <p class="pad">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui odio at, non asperiores veritatis omnis aliquid animi ipsa enim ab atque ea, quasi similique reiciendis! Voluptatibus laboriosam, sapiente amet debitis.</p>
    <p class="pad">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui odio at, non asperiores veritatis omnis aliquid animi ipsa enim ab atque ea, quasi similique reiciendis! Voluptatibus laboriosam, sapiente amet debitis.</p>
    <div class="box-alert-menu-bottom">
      <div class="left">
        <button>Aceptar</button>
      </div>
      <div class="right">
        <button>Cancelar</button>
      </div>
    </div>
  </div>
</div>
<script>
  jQuery(document).ready(function($) {
      $('#svendedor').change(function(event) {
        event.preventDefault();
        $.post('ajax.php', {comboFiltro: '' , vendedor: $(this).val()}, function(data, textStatus, xhr) {
          $('#scliente').html(data);
          $('input[name="client"]').trigger('click'); 
        });
      });

      var client_val = $('input[name="client"]').val();
      if (client_val != "") {
        $('#svendedor').trigger('change');
        // $('option[value="'+client_val+'"]').attr('selected', 'true');
        $('input[name="client"]').on('click', function(event) {
            $('option[value="'+client_val+'"]').attr('selected', '');
        });
      };


      $('#svendedor').trigger('change');


      $('.confirm-link').click(function(event) {
        if (!confirm('¿Esta seguro que desea borrar este item?')) {
          event.preventDefault();
        };
      });

  });
</script>

</body>
</html>