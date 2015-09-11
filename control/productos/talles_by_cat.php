<?php 
error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once('../../libs.php');



// die('asdas');
$idcategoria = $_GET['idcategoria']; 
$idproducto = $_GET['idproducto'];


$prod = new Producto();

function findUsedColours($collection, $used, $current){


	$used = array_keys($used);
	foreach($collection as $key => $val):
		if(in_array($val['id_color'], $used)):
			if($val['id_color'] != $current):

				unset($collection[$key]);
			endif;
		endif;
	endforeach;

	return $collection;
	
	
}

				
				
				include_once("../categorias/classes/class.categorias.php");
				$categorias= new categorias();
				$categorias->select($idcategoria);
				$talles=$categorias->gettalles();



				if($talles ==1)
				{
					$talles = array();
					$byProd = $prod->talles($idproducto);
					$allTalles = $prod->allTalles();
					$formatAll = array();

					foreach($byProd as $key => $val):
						$formatAll[$val->id]['nombre'] = $val->talle; 
						$formatAll[$val->id]['cantidad'] = $val->cantidad; 
					endforeach;

					foreach($allTalles as $key => $val):
						$item               = new stdClass();
						$item->{'nombre'}   = $val->nombre_talle;
						$item->{'id'}       = $val->id_talle;
						$item->{'cantidad'} = ( isset($formatAll[$val->id_talle]) ? $formatAll[$val->id_talle]['cantidad'] : 0 );
						$talles[]           = $item;
					endforeach;

					$html = "";

					foreach($talles as $key => $val):
						$html .=   '
						<div class="tallebox">
							<p>'.$val->nombre.'</p>
							<p><input class="inputshort" type="text" name="talle['.$val->id.']" value="'.$val->cantidad.'" id="talle'.$val->id.'"></p>
						</div>';
					endforeach;
					

					echo($html);
				}
				else if ($talles ==2)
				{
					$colores = array();
					$byProd = $prod->colores($idproducto);
					$allColores = $prod->allColores();
					$formatAll = array();



					foreach($byProd as $key => $val):
						$formatAll[$val->id]['nombre'] = $val->color; 
						$formatAll[$val->id]['cantidad'] = $val->cantidad; 
					endforeach;

			
					foreach($allColores as $key => $val):
						$item               = new stdClass();
						$item->{'nombre'}   = $val->nombre_color;
						$item->{'id'}       = $val->id_color;
						$item->{'cantidad'} = ( isset($formatAll[$val->id_color]) ? $formatAll[$val->id_color]['cantidad'] : 0 );
						$colores[]           = $item;
					endforeach;

					$html = '';

					
					foreach($colores as $key => $val):
						$html .=   '
						<div class="tallebox">
							<p>'.$val->nombre.'</p>
							<p><input class="inputshort" type="text" name="color['.$val->id.']" value="'.$val->cantidad.'" id="color'.$val->id.'"></p>
						</div>';
					endforeach;
					

					echo($html);

				}
				else if ($talles == 3)
				{
					//require colores
					include_once("../colores/classes/class.colores.php");
					include_once("../talles/classes/class.talles.php");
					include_once("../productos/classes/class.tallesColores.php");


					$x = new tallesColores();
					$talles = new talles();
					$talles = $talles->all();
					$colores = new colores();
					$colores = $colores->all();
					

					$all = $x->all($_GET['idproducto']);

					$id_colores_usados = array_keys($all);
					

			
					$key = rand();
					
					$used = array_keys($all);

					if (isset($_GET['action']) && $_GET['action'] == 'add' || empty($all)):

					?>
					<div class="segmentTalleColor">
								<label for="">Color</label>
								<select name="color_talle[<?php echo($key) ?>][color]" class="color">
									<?php foreach($colores as $val):

										if(in_array($val['id_color'], $used)):
											continue;
										endif;

									 ?>

									<option value="<?php echo($val['id_color']) ?>"><?php echo($val['nombre_color']) ?></option>
									
									<?php endforeach; ?>
								</select>
								<label for="">Talles</label>
								<div class="tipotalles">
									<?php foreach($talles as $val): ?>
									<div class="tallebox">
										<p><?php echo($val['nombre_talle']) ?></p>	
										<p><input class="inputshort valid" type="text" name="color_talle[<?php echo($key) ?>][talle][<?php echo($val['id_talle']) ?>]" value=""></p>
									</div>
									<?php endforeach; ?>
								</div>
								<div class="addColor">
									<button class="newColor" >Agregar color</button>
									<button class="removeColor" >Borrar color</button>
								</div>
							</div>
					<?php
					elseif (isset($_GET['action']) && $_GET['action'] == 'delete'):
						var_dump($x->delete($_GET['idproducto'],$_GET['color']));
						die();
					else: 

						foreach($all as $k => $v):
							$current_color = null;
							$key = rand();

							// die();
						?>
						<div class="segmentTalleColor">
								<label for="">Color</label>



								<select name="color_talle[<?php echo($key) ?>][color]" class="color">

									<?php foreach($colores as $color_key => $val):
										
										if(in_array($val['id_color'],$used) && $val['id_color'] != $k ):
											continue;
										endif;
											
											if ($val['id_color'] == $k ): $current_color = $val['id_color']; ?>

											<option selected="" value="<?php echo($val['id_color']) ?>"><?php echo($val['nombre_color']) ?></option>

											<?php 

											else:

											 ?>

											<option value="<?php echo($val['id_color']) ?>"><?php echo($val['nombre_color']) ?></option>
											<?php endif;

										

										endforeach; ?>
								</select>




								<label for="">Talles</label>
								<div class="tipotalles">
									<?php foreach($talles as $val): ?>
									<div class="tallebox">
										<p><?php echo($val['nombre_talle']) ?></p>	
										<p><input class="inputshort valid" 
													type="text" name="color_talle[<?php echo($key) ?>][talle][<?php echo($val['id_talle']) ?>]" 
													value="<?php echo (	isset($v['talle'][$val['id_talle']]) ? $v['talle'][$val['id_talle']] : 0 ) ?>"></p>
										<p></p>
									</div>
									<?php endforeach; ?>
								</div>
								<div class="addColor">
									<button class="newColor" >Agregar color</button>
									<button class="removeColor" >Borrar color</button>
									<input type="hidden" name="id_color" value="<?php echo $current_color; ?>">
									<input type="hidden" name="id_talle" value="<?php echo $val['id_talle']; ?>">
									<input type="hidden" name="id_prod" value="<?php echo $_GET['idproducto']; ?>">
								</div>
							</div>
					<?php
						endforeach;
					endif;



					
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