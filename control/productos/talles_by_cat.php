<?php 
error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once('../../libs.php');



// die('asdas');
$idcategoria = $_GET['idcategoria']; 
$idproducto = $_GET['idproducto'];


$prod = new Producto();


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
						include_once("class.colores_productos.php");
					
						// $colprod = new colores_productos();
						// $colprod->select_by_producto($idproducto, $color);
						// $id_color_producto = $colprod->getid();
						// $id_color = $colprod->getid_color();
						// $id_producto = $colprod->getid_producto();
						// $cantidad = $colprod->getcantidad();
						
						// $salida .=   '
						// <div class="tallebox">
						// 	<p>'.$nombre_color.'</p>	
						// 	<p><input class="inputshort" type="text" name="color['.$color.']" value="'.$cantidad.'" id="'.$color.'"></p>
						// </div>';

						echo "<pre>";
						print_r($idproducto);
						echo "</pre>";
						
						
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
					$colores = $prod->colores($idproducto);
				

					$html = '';

					if(!empty($colores)):
						foreach($colores as $key => $val):
							$html .=   '
							<div class="tallebox">
								<p>'.$val->color.'</p>	
								<p><input class="inputshort" type="text" name="color['.$val->id.']" value="'.$val->cantidad.'" id="'.$val->id.'"></p>
							</div>';
						endforeach;
					else:
						$colores = $prod->allColores();
						echo "<pre>";
						print_r($var);
						echo "</pre>";
						// foreach($colores as $key => $val):
						// 	$html .=   '
						// 	<div class="tallebox">
						// 		<p>'.$val->color.'</p>	
						// 		<p><input class="inputshort" type="text" name="color['.$val->id.']" value="'.$val->cantidad.'" id="'.$val->id.'"></p>
						// 	</div>';
						// endforeach;
					endif;

					var_dump($html);

					//require colores
					// include_once("../colores/classes/class.colores.php");
					// $tll= new colores();
					// $colores_disp = $tll->select_all_clean();
					
					
					// foreach($colores_disp as $color)
					// {
					// 	$color_n= new colores();
					// 	$color_n->select($color);
					// 	$nombre_color = $color_n->getnombre_color();
					// 	//llamo funcion que genera cuadros con los imputs
						
					// 	build_boxes_color($color, $nombre_color, $idproducto);
					// 	$color="";
					// 	$nombre_color="";

					// }
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

					$key = rand();
					


					if (isset($_GET['action']) && $_GET['action'] == 'add' || empty($all)):
					?>
					<div class="segmentTalleColor">
								<label for="">Color</label>
								<select name="color_talle[<?php echo($key) ?>][color]" class="color">
									<?php foreach($colores as $val): ?>
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
						?>
						<div class="segmentTalleColor">
								<label for="">Color</label>
								<select name="color_talle[<?php echo($key) ?>][color]" class="color">
									<?php foreach($colores as $val):
										if ($val['id_color'] == $k): $current_color = $val['id_color']; ?>
										<option selected="" value="<?php echo($val['id_color']) ?>"><?php echo($val['nombre_color']) ?></option>
										<?php else: ?>
										<option value="<?php echo($val['id_color']) ?>"><?php echo($val['nombre_color']) ?></option>
								<?php 	endif;
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



						/*if(	!$x->exist(array('id_producto',$_GET['idproducto'])) || isset($_GET['action'])	):
							// SI EL PRODUCTO NO EXISTE O SI SE ENVIA UNA PETICION ACTION
							
							$randId = substr(strtoupper(md5(rand().rand())), 0,10);
						?>
							<div class="segmentTalleColor">
								<label for="">Color</label>
								<select name="talleColor[<?php echo($randId) ?>][color]" class="color">
									<?php foreach($colores as $val): ?>
									<option value="<?php echo($val['id_color']) ?>"><?php echo($val['nombre_color']) ?></option>
									<?php endforeach; ?>
								</select>
								<label for="">Talles</label>
								<div class="tipotalles">
									<?php foreach($talles as $val): ?>
									<div class="tallebox">
										<p><?php echo($val['nombre_talle']) ?></p>	
										<p><input class="inputshort valid" type="text" name="talleColor[<?php echo($randId) ?>][talle][<?php echo($val['id_talle']) ?>]" value=""></p>
									</div>
									<?php endforeach; ?>
								</div>
								<div class="addColor">
									<button class="newColor" >Agregar color</button>
								</div>
							</div>
						<?php
						else:
							// SI EL PRODUCTO EXISTE Y NO SE ENVIA UNA PETICION ACTION
							$data = $x->get($_GET['idproducto']);
							$data = json_decode($data['colores_talles']);

							$count =  count($data);
							foreach($data as $k => $v):
							?>
							<div class="segmentTalleColor">
								<label for="">Color</label>
								<select name="talleColor[<?php echo($k) ?>][color]" class="color">
									<?php foreach($colores as $val): 
											if($val['id_color'] == $v->color): ?>
											<option selected="" value="<?php echo($val['id_color']) ?>"><?php echo($val['nombre_color']) ?></option>
										<?php else:	?>
												<option value="<?php echo($val['id_color']) ?>"><?php echo($val['nombre_color']) ?></option>
										<?php endif;
										endforeach; ?>
								</select>
								<label for="">Talles</label>
								<div class="tipotalles">
									<?php foreach($talles as $val): ?>
									<div class="tallebox">
										<p><?php echo($val['nombre_talle']) ?></p>	
										<p><input class="inputshort valid" type="text" value="<?php echo $v->talle->{$val['id_talle']} ?>" name="talleColor[<?php echo($k) ?>][talle][<?php echo($val['id_talle']) ?>]" value=""></p>
									</div>
									<?php endforeach; ?>
								</div>
								<div class="addColor">
									<?php if($count == 1): ?>
									<button class="newColor" >Agregar color</button>
									<?php else: ?>
									<button class="removeColor" >Borrar color</button>
									<?php endif; ?>
								</div>
							</div>

							<?php
							endforeach;
						endif;*/
					
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