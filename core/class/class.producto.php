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
			return $this->query(self::PRODUCTO_ALL)->fetchAll();
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
		 * Traigo los talles del producto 
		 * @return [Object] [resultado]
		 */
		private function talles(){
			$talles = $this->prepare(self::PRODUCTO_TALLESBYPROD);
			$talles->bindParam(':id', $this->id, PDO::PARAM_INT);
			$talles->execute();
			return $talles->fetchAll();
		}
		/**
		 * Traigo los colores del producto 
		 * @return [Object] [resultado]
		 */
		private function colores(){
			$colores = $this->prepare(self::PRODUCTO_COLORESBYPROD);
			$colores->bindParam(':id', $this->id, PDO::PARAM_INT);
			$colores->execute();
			return $colores->fetchAll();
		}
		/**
		 * Traigo los talles_colores del producto 
		 * @return [Object] [resultado]
		 */
		private function talles_colores(){
			$talles_colores = $this->prepare(self::PRODUCTO_TALLES_COLORESBYPROD);
			$talles_colores->bindParam(':id', $this->id, PDO::PARAM_INT);
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
		
		private function allById(){
			$meta = $this->prepare(self::PRODUCTO_ALLBYID);
			$meta->bindParam(':id',$this->id, PDO::PARAM_INT);
			$meta->execute();
			$this->meta = $meta->fetch();

		}

		/**
		 * Obtengo el tipo de producto
		 * @param  1 - talles
		 * @param  2 - colores
		 * @param  3 - talles-colores
		 * @param  4 - sin nada
		 * @return [INT] [tipo del producto]
		 */
		private function defineType(){
			$type = $this->prepare(self::PRODUCTO_BYTYPE);
			$type->bindParam(':id', $this->id, PDO::PARAM_INT);
			$type->execute();
			$this->category = $type->fetch();
		}


	}

 ?>