<?php 
header ("Location: index.php");
require_once('Connections/conexion.php');error_reporting(0); ?>
<?php

if (!function_exists("GetSQLValueString")) {

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 

{

  if (PHP_VERSION < 6) {

    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  }



  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);



  switch ($theType) {

    case "text":

      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";

      break;    

    case "long":

    case "int":

      $theValue = ($theValue != "") ? intval($theValue) : "NULL";

      break;

    case "double":

      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";

      break;

    case "date":

      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";

      break;

    case "defined":

      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;

      break;

  }

  return $theValue;

}

}



$currentPage = $_SERVER["PHP_SELF"];



$maxRows_RecordProductos = 35;

$pageNum_RecordProductos = 0;

if (isset($_GET['pageNum_RecordProductos'])) {

  $pageNum_RecordProductos = $_GET['pageNum_RecordProductos'];

}

$startRow_RecordProductos = $pageNum_RecordProductos * $maxRows_RecordProductos;



mysql_select_db($database_conexion, $conexion);

$query_RecordProductos = "SELECT * FROM productos WHERE intStock >=1 ORDER BY productos.strNombre DESC";

$query_limit_RecordProductos = sprintf("%s LIMIT %d, %d", $query_RecordProductos, $startRow_RecordProductos, $maxRows_RecordProductos);

$RecordProductos = mysql_query($query_limit_RecordProductos, $conexion) or die(mysql_error());

$row_RecordProductos = mysql_fetch_assoc($RecordProductos);



if (isset($_GET['totalRows_RecordProductos'])) {

  $totalRows_RecordProductos = $_GET['totalRows_RecordProductos'];

} else {

  $all_RecordProductos = mysql_query($query_RecordProductos);

  $totalRows_RecordProductos = mysql_num_rows($all_RecordProductos);

}

$totalPages_RecordProductos = ceil($totalRows_RecordProductos/$maxRows_RecordProductos)-1;



$queryString_RecordProductos = "";

if (!empty($_SERVER['QUERY_STRING'])) {

  $params = explode("&", $_SERVER['QUERY_STRING']);

  $newParams = array();

  foreach ($params as $param) {

    if (stristr($param, "pageNum_RecordProductos") == false && 

        stristr($param, "totalRows_RecordProductos") == false) {

      array_push($newParams, $param);

    }

  }

  if (count($newParams) != 0) {

    $queryString_RecordProductos = "&" . htmlentities(implode("&", $newParams));

  }

}

$queryString_RecordProductos = sprintf("&totalRows_RecordProductos=%d%s", $totalRows_RecordProductos, $queryString_RecordProductos);

?>

<?php include("includes/header.php"); ?>



<div id="menu">

 <div class="link"><p><a href="index.php">Inicio</a></p></div>

             <div class="link-activo"><p><a href="canjes.php">Canjes</a></p></div>

              <div class="link"><p><a href="mi_cuenta.php">Mi Cuenta</a></p></div>

                <div class="link"><p><a href="novedades.php">Novedades</a></p></div>

 </ul>

</div>

<div id="buscador">

   <form name="form1" method="post" action="buscar.php">

    <input type="text" name="buscar" id="buscar" placeholder="Buscar...">

  </form>

</div>



<section>

<aside>

<?php include("includes/catalogo.php"); ?>

</aside>

<article>

<div class="productos">

<h2>Eventos</h2>

<div class="box-content7">

        

         <ul>

         <div class="sombra"></div>

            <li>

            <div class="tipro"><span>Externo</span></div>

            <div class="box-imagen7">

          <a href="evento_externo.php"><img src="eventos/evento-externo.png" width="307" height="270"></a></div>

         

          

                    <div class="info">

                            <h4><a href="evento_externo.php">CANJEAR</a></h4>

                            <p><a href="evento_externo.php">Enviar Propuesta</a></p>

                                           </div>

                                          

                                            </li>

                                            <div class="descripcion">

                                             <h4>Eventos zonales, Exposiciones y Jornadas</h4>

                                                  <p>Sponsoreos, patrocinios, presencia de marca.</p>               

                                                            </div>

              </ul> 

               

               <ul>

               <div class="sombra"></div>

            <li>

            <div class="tipro"><span>Interno</span></div>

            <div class="box-imagen7">

          <a href="evento_interno.php"><img src="eventos/evento-interno.png" width="307" height="270"></a></div>

         

          

                    <div class="info">

                            <h4><a href="evento_interno.php">CANJEAR</a></h4>

                            <p><a href="evento_interno.php">Enviar Propuesta</a></p>

                                           </div>

                                          

                                            </li>

                                            <div class="descripcion">

                                             <h4>Charlas y Reuniones</h4> 

                                                  <p>Comunicación de novedades, beneficios, etc</p>               

                                                            </div>

              </ul>               

        

        

                       </div><!---- Fin box-content ---->

        <div class="line-transparent"></div>

        <div class="line"></div><!----- fin eventos --->

        

        <h2>Publicidad</h2>

        <div class="box-content">

         <ul>

          <div class="sombra"></div>

            <li>

            <div class="tipro"><span>Cartel Frente</span></div>

            <div class="box-imagen3">

          <a href="cartel_frente.php"><img src="publicidades/cartel-frente-02.png" width="190" height="170"></a></div>

         

          

                    <div class="info">

                            <h4><a href="cartel_frente.php">CANJEAR</a></h4>

                            <p><a href="cartel_frente.php">Enviar Propuesta</a></p>

                                           </div>

                                          

                                            </li>

                                            <div class="descripcion">

                                             <h4>Carteles agronomías y locales</h4> 

                                                  <p>Promoción producto</p>               

                                                            </div>

              </ul> 

              

               <ul>

               <div class="sombra"></div>

            <li>

            <div class="tipro"><span>PLOTEO VIDRIERA</span></div>

            <div class="box-imagen3b">

          <a href="ploteo_vidriera.php"><img src="publicidades/ploteo.png" width="326" height="236"></a></div>

         

          

                    <div class="info">

                            <h4><a href="ploteo_vidriera.php">CANJEAR</a></h4>

                            <p><a href="ploteo_vidriera.php">Enviar Propuesta</a></p>

                                           </div>

                                          

                                            </li>

                                            <div class="descripcion">

                                             <h4>Carteles agronomías y locales</h4> 

                                                  <p>Promoción producto</p>               

                                                            </div>

              </ul>  

              

               <ul>

               <div class="sombra"></div>

                  <li>

            <div class="tipro"><span>CARTEL INTERIOR</span></div>

            <div class="box-imagen3b">

          <a href="cartel_interior.php"><img src="images_productos/c9cbc4_nufarm-logo-producto-2.jpg" width="307" height="270"></a></div>

         

          

                    <div class="info">

                            <h4><a href="cartel_interior.php">CANJEAR</a></h4>

                            <p><a href="cartel_interior.php">Enviar Propuesta</a></p>

                                           </div>

                                          

                                            </li>

                                            <div class="descripcion">

                                             <h4>Carteles agronomías y locales</h4> 

                                                  <p>Promoción producto</p>               

                                                            </div>

              </ul> 

              

              <ul>

              <div class="sombra"></div>

                  <li>

            <div class="tipro"><span>AVISO GRAFICO</span></div>

            <div class="box-imagen3">

          <a href="aviso_grafico.php"><img src="publicidades/aviso-grafico.png" width="191" height="269"></a></div>

         

          

                    <div class="info">

                            <h4><a href="aviso_grafico.php">CANJEAR</a></h4>

                            <p><a href="aviso_grafico.php">Enviar Propuesta</a></p>

                                           </div>

                                          

                                            </li>

                                            <div class="descripcion">

                                             <h4>Institucional o Producto</h4> 

                                                  <p>Página completa, Pie de página, Lateral</p>               

                                                            </div>

              </ul> 

              

              

              <ul>

              <div class="sombra"></div>

                  <li>

            <div class="tipro"><span>AVISO RADIAL	</span></div>

            <div class="box-imagen3">

          <a href="aviso_radial.php"><img src="images_productos/c9cbc4_nufarm-logo-producto-2.jpg" width="307" height="270"></a></div>

         

          

                    <div class="info">

                            <h4><a href="aviso_radial.php">CANJEAR</a></h4>

                            <p><a href="aviso_radial.php">Enviar Propuesta</a></p>

                                           </div>

                                          

                                            </li>

                                            <div class="descripcion">

                                             <h4>Institucional o Producto</h4> 

                                                  <p>Duración, 19"</p>               

                                                            </div>

              </ul> 

        

                       </div><!---- Fin box-content ---->





        <div class="line"></div><!------- fin publicidades -------->

        

        

<h2>Productos</h2>

<div class="box-content">

      <?php do { ?> 

         <ul>

            <li>

            <div class="tipro">

	<div class="titlef"><span><?php echo $row_RecordProductos['strNombre']; ?></span></div>

	<p>$<?php echo $row_RecordProductos['dblPrecio']; ?></p>

	</div>

            

	<div class="box-imagen3">

    <a href="ver_producto.php?recordID=<?php echo $row_RecordProductos['idProducto']; ?>">

	
	<?php
	if($row_RecordProductos['strImagen']){
	echo '<img src="images_productos/'.$row_RecordProductos['strImagen'].'" alt="" width="156" height="158"/>';
	}
	?>
	

	</a>

	</div>

         

          

    <div class="info">

    <h4><a href="ver_producto.php?recordID=<?php echo $row_RecordProductos['idProducto']; ?>">CANJEAR</a></h4>

    </div>

                                          

     </li>

      <div class="descripcion">

         <span>Stock 

		<?php //STOCK

		

		

		include_once("includes/class.categorias.php");

		$cat = new categorias();

		$cat->select($row_RecordProductos['intCategoria']);

		$requiere_talles = $cat->gettalles();

		

		if($requiere_talles){

			//traigo total de todos los talles para ese id de producto

			include_once("includes/class.talles_productos.php");

			$tall = new talles_productos();

			$row_RecordProductos['idProducto'];

			$cantidad_gral = $tall->cantidad_by_producto($row_RecordProductos['idProducto']);

			echo $cantidad_gral;

		}else{

			echo $row_RecordProductos['intStock']; 

		}

		

		

		?> U</span> 

         <p><?php echo $row_RecordProductos['strDetalle']; ?></p>                

        </div>

              </ul>        

        <?php } while ($row_RecordProductos = mysql_fetch_assoc($RecordProductos)); ?>

        

                       </div><!---- Fin box-content ---->

                            </div><!--- Fin Productos --->

                            <table border="0">

                              <tr>

                                <td><?php if ($pageNum_RecordProductos > 0) { // Show if not first page ?>

                                    <a href="<?php printf("%s?pageNum_RecordProductos=%d%s", $currentPage, 0, $queryString_RecordProductos); ?>"><img src="First.gif"></a>

                                    <?php } // Show if not first page ?></td>

                                <td><?php if ($pageNum_RecordProductos > 0) { // Show if not first page ?>

                                    <a href="<?php printf("%s?pageNum_RecordProductos=%d%s", $currentPage, max(0, $pageNum_RecordProductos - 1), $queryString_RecordProductos); ?>"><img src="Previous.gif"></a>

                                    <?php } // Show if not first page ?></td>

                                <td><?php if ($pageNum_RecordProductos < $totalPages_RecordProductos) { // Show if not last page ?>

                                    <a href="<?php printf("%s?pageNum_RecordProductos=%d%s", $currentPage, min($totalPages_RecordProductos, $pageNum_RecordProductos + 1), $queryString_RecordProductos); ?>"><img src="Next.gif"></a>

                                    <?php } // Show if not last page ?></td>

                                <td><?php if ($pageNum_RecordProductos < $totalPages_RecordProductos) { // Show if not last page ?>

                                    <a href="<?php printf("%s?pageNum_RecordProductos=%d%s", $currentPage, $totalPages_RecordProductos, $queryString_RecordProductos); ?>"><img src="Last.gif"></a>

                                    <?php } // Show if not last page ?></td>

                              </tr>

                            </table>

</article>

</section>

</div>

</div></div></div></div>

<?php include("includes/footer.php"); ?>

<?php

mysql_free_result($RecordProductos);

?>

