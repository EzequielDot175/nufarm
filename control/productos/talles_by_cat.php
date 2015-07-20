<?php error_reporting(ALL);

$idcategoria = $_GET['idcategoria']; 
$idproducto = $_GET['idproducto'];

				function build_boxes($talle, $nombre_talle, $idproducto){
					
					if($idproducto > 0)
					{
						//editar
						include_once("classes/class.talles_productos.php");
					
						$tallprod = new talles_productos();
						$tallprod->select_by_producto($idproducto, $talle);
						$id_talle_producto = $tallprod->getid();
						$id_talle = $tallprod->getid_talle();
						$id_producto = $tallprod->getid_producto();
						$cantidad = $tallprod->getcantidad();
						
						$salida .=   '
						<div class="tallebox">
							<p>'.$nombre_talle.'</p>	
							<p><input class="inputshort" type="text" name="talle['.$talle.']" value="'.$cantidad.'" id="'.$talle.'"></p>
						</div>';
						
						
					}
					else
					{
						//nuevo
						
						$salida .=   '
						<div class="tallebox">
							<p>'.$nombre_talle.'</p>
							<p><input class="inputshort" type="text" name="talle['.$talle.']" value="" id="'.$talle.'"></p>
						</div>';
					}
					echo $salida;	
				}

				
				
				function build_boxes_color($color, $nombre_color, $idproducto){
					
					if($idproducto > 0)
					{
						//editar
						include_once("classes/class.colores_productos.php");
					
						$colprod = new colores_productos();
						$colprod->select_by_producto($idproducto, $color);
						$id_color_producto = $colprod->getid();
						$id_color = $colprod->getid_color();
						$id_producto = $colprod->getid_producto();
						$cantidad = $colprod->getcantidad();
						
						$salida .=   '
						<div class="tallebox">
							<p>'.$nombre_color.'</p>	
							<p><input class="inputshort" type="text" name="color['.$color.']" value="'.$cantidad.'" id="'.$color.'"></p>
						</div>';
						
						
					}
					else
					{
						//nuevo
						
						$salida .=   '
						<div class="tallebox">
							<p>'.$nombre_color.'</p>
							<p><input class="inputshort" type="text" name="talle['.$color.']" value="" id="'.$color.'"></p>
						</div>';
					}
					echo $salida;	
				}
				
				
include_once("../categorias/classes/class.categorias.php");
$categorias= new categorias();
$categorias->select($idcategoria);
$talles=$categorias->gettalles();


				if($talles ==1)
				{
					//require talles
					include_once("../talles/classes/class.talles.php");
					$tll= new talles();
					$talles_disp = $tll->select_all_clean();
					
					
					foreach($talles_disp as $talle)
					{
						$talle_n= new talles();
						$talle_n->select($talle);
						$nombre_talle = $talle_n->getnombre_talle();
						//llamo funcion que genera cuadros con los imputs
						
						build_boxes($talle, $nombre_talle, $idproducto);
						$talle="";
						$nombre_talle="";
					
					}
				}
				else if ($talles ==2)
				{
					//require colores
					include_once("../colores/classes/class.colores.php");
					$tll= new colores();
					$colores_disp = $tll->select_all_clean();
					
					
					foreach($colores_disp as $color)
					{
						$color_n= new colores();
						$color_n->select($color);
						$nombre_color = $color_n->getnombre_color();
						//llamo funcion que genera cuadros con los imputs
						
						build_boxes_color($color, $nombre_color, $idproducto);
						$color="";
						$nombre_color="";
					
					}
				}
				else
				{
					//no require talles
					
					//si es un producto actualizandose necesit mostra la cantidad en stock por mas que cambie el imput
					if($idproducto){
						include_once("classes/class.productos.php");
						$productos= new productos();
						$productos->select($idproducto);
						$intStock=$productos->getintStock();
							echo '<label for="cintStock">IntStock</label>
							<input type="text" name="intStock" id="intStock" value="'.$intStock.'" />';
					}else{
						//si es un prod nuevo muestro imput vacio
						
						echo '<input type="text" name="intStock" id="intStock" />';
					}
					
					
					
					
				}




?>