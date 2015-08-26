<?php 
	
	/**
	* 
	*/
	class Producto extends DB
	{
		protected $table = "productos";
		private $id;
		private $category;
		private $meta;
		
		public function __construct($id = null)
		{
			$this->id = (int)$id;
			parent::__construct();
		}
		public function all(){

			$collection = $this->query(self::PRODUCTO_ALL)->fetchAll();
		
			foreach($collection as $key => $val):
				$type = $this->defineType($val->idProducto);
				
				switch ($type->type):
					case '1':
						$stock = $this->stockFromSumTalle($val->idProducto);
						$collection[$key]->intStock = $stock;
						break;
					case '2':
						$stock = $this->stockFromSumColor($val->idProducto);
						$collection[$key]->intStock = $stock;
						break;
					case '3':
						$stock = $this->stockFromSumColorTalle($val->idProducto);
						$collection[$key]->intStock = $stock;
						break;
					
					default:

						break;
				endswitch;
			endforeach;
			
			foreach($collection as $key => $val):
				if($val->intStock < 1):
				unset($collection[$key]);				
				endif;
			endforeach;

			return $collection;
		}

		/**
		 * Obtengo el detalle del producto
		 * @return [Object]
		 */
		
		public function details(){
			$this->allById();
			$this->defineType();
			switch ($this->category->type) {
				case '1':
					$this->meta->{'talles'} = $this->talles();
					break;
				case '2':
					$this->meta->{'colores'} = $this->colores();
					break;
				case '3':
					$this->meta->{'talles_colores'} = $this->talles_colores();
					break;
				
				default:

					break;
			}
			$this->meta->{'type'} = $this->category->type;
			return $this->meta;
		}


		public static function disable($num){
			$prop = new stdClass();
			$prop->{'opacity'} = "";			
			$prop->{'disabled'} = "";			

			if((int)$num == 0):

			$prop->{'opacity'} = "style='opacity:0.5'";			
			$prop->{'disabled'} = "disabled=''";
			
			endif;

			return $prop;
		}

		/**
		 * @internal
		 * @return  Stock del producto directamente desde la suma de sus talles
		 */
		public function stockFromSumTalle($id){
			$sel = $this->prepare(self::PRODUCTO_STOCKSUMTALLE);
			$sel->bindParam(':id',$id, PDO::PARAM_INT);
			return ( $sel->execute() ? $sel->fetch()->stock : 0);
		}

		/**
		 * @internal
		 * @return  Stock del producto directamente desde la suma de sus colores
		 */
		public function stockFromSumColor($id){
			$sel = $this->prepare(self::PRODUCTO_STOCKSUMCOLOR);
			$sel->bindParam(':id',$id, PDO::PARAM_INT);
			return ( $sel->execute() ? $sel->fetch()->stock : 0);
		}

		/**
		 * @internal
		 * @return  Stock del producto directamente desde la suma de sus colores
		 */
		public function stockFromSumColorTalle($id){
			$sel = $this->prepare(self::PRODUCTO_STOCKSUMTALLECOLOR);
			$sel->bindParam(':id',$id, PDO::PARAM_INT);
			return ( $sel->execute() ? $sel->fetch()->stock : 0);
		}

		public function allById($id = null){
			$take = ( is_null($id) ? $this->id : $id);
			$meta = $this->prepare(self::PRODUCTO_ALLBYID);
			$meta->bindParam(':id',$take, PDO::PARAM_INT);
			$meta->execute();


			if(is_null($id)):
				$this->meta = $meta->fetch();
			else:
				return $meta->fetch();			
			endif;
		}

		/**
		 * Obtengo el tipo de producto
		 * @param  1 - talles
		 * @param  2 - colores
		 * @param  3 - talles-colores
		 * @param  4 - sin nada
		 * @return [INT] [tipo del producto]
		 */
		public function defineType($id = null){
			$take = ( is_null($id) ? $this->id : $id);
			$type = $this->prepare(self::PRODUCTO_BYTYPE);
			$type->bindParam(':id', $take, PDO::PARAM_INT);
			$type->execute();
			if(is_null($id)):
				$this->category = $type->fetch();
			else:
				return $type->fetch();			
			endif;
		}

		/**
		 * Traigo los talles del producto 
		 * @return [Object] [resultado]
		 */
		public function talles($id = null){
			$take = ( is_null($id) ? $this->id : $id);
			$talles = $this->prepare(self::PRODUCTO_TALLESBYPROD);
			$talles->bindParam(':id', $take, PDO::PARAM_INT);
			$talles->execute();
			return $talles->fetchAll();
		}
		/**
		 * Traigo los colores del producto 
		 * @return [Object] [resultado]
		 */
		public function colores($id = null){
			$take = ( is_null($id) ? $this->id : $id);
			$colores = $this->prepare(self::PRODUCTO_COLORESBYPROD);
			$colores->bindParam(':id', $take, PDO::PARAM_INT);
			$colores->execute();
			return $colores->fetchAll();
		}
		/**
		 * Traigo los talles_colores del producto 
		 * @return [Object] [resultado]
		 */
		public function talles_colores($id = null){
			$take = ( is_null($id) ? $this->id : $id);
			$talles_colores = $this->prepare(self::PRODUCTO_TALLES_COLORESBYPROD);
			$talles_colores->bindParam(':id', $take, PDO::PARAM_INT);
			$talles_colores->execute();

			$data = $talles_colores->fetchAll();
			$format = array();

			foreach($data as $key => $val):
				$item = new stdClass();
				$item->{'id_color'} = $val->id_color;
				$item->{'nombre'} = $val->nombre_color;
				$format[$val->id_color] = array('color' => $item);
			endforeach;

			foreach($data as $key => $val):
				$item = new stdClass();
				$item->{'id_talle'} = $val->id_talle;
				$item->{'nombre'} = $val->nombre_talle;
				$item->{'cantidad'} = $val->cantidad;
				$format[$val->id_color]['talle'][] = $item;
			endforeach;
			return $format;
		}

		/**
		 * Obtengo todos los colores
		 * @return [ARRAY]
		 */
		public function allColores(){
			return $this->query(self::PRODUCTO_ALLCOLORES)->fetchAll();
		}
		/**
		 * Obtengo todos los talles
		 * @return [ARRAY]
		 */
		public function allTalles(){
			return $this->query(self::PRODUCTO_ALLTALLES)->fetchAll();
		}
		/**
		 * @internal
		 * Trae todas las categorias
		 */
		
		public function categorias(){
			return $this->query(self::PRODUCTO_CATEGORIAS)->fetchAll();
		}
		

		public function updCategoria($intCat, $intProd){
			$upd = $this->prepare(self::PRODUCTO_UPDCAT);
			$upd->bindParam(':cat', $intCat , PDO::PARAM_INT);
			$upd->bindParam(':prod', $intProd , PDO::PARAM_INT);
			$upd->execute();
		}

		


	}

 ?>