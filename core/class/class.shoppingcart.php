<?php 
	
	/**
	* @internal Clase controladorea del carrito
	*/
	class ShoppingCart extends DB
	{
		
		private $total = 0;
		private $count = 0;
		private $user_id;

		public function __construct()
		{
			parent::__construct();
			$this->user_id = Auth::id();
		}


		/**
		 * Metodo en el que llama todos los productos del carrito con el usuario logueado
		 * @internal Este metodo tambien setea la cantidad total en credito y la cantidad de productos los cuales son
		 * @param  private $total
		 * @param  private $count
		 */
		public function all(){
			$all = $this->prepare(self::SHOPPINGCART_ALL);
			$all->bindParam(':id',$this->user_id,PDO::PARAM_INT);
			$all->execute();
			$data = $all->fetchAll();
			
			foreach($data as $key => $val):
				
				if(is_null($val->talle) && !is_null($val->color)):
					$data[$key]->{'type'} = 2;
				elseif (!is_null($val->talle) && is_null($val->color)):
					$data[$key]->{'type'} = 1;
				elseif (!is_null($val->talle) && !is_null($val->color)):
					$data[$key]->{'type'} = 3;
				else:
					$data[$key]->{'type'} = 0;
				endif;

				$this->total += $val->cantidad * $val->precio;
				$this->count += $val->cantidad;
			endforeach;
			return $data;
		}


		public function total(){
			echo $this->total;
		}
		public function getTotal(){
			return $this->total;
		}

		public function cantidad(){
			echo $this->count;
		}


		public function getSum(){
			$sum = $this->prepare(self::SHOPPINGCART_SUM);
			$sum->bindParam(':id', $this->user_id, PDO::PARAM_INT);
			$sum->execute();
			return $sum->fetch()->cantidad;
		}

		public static function sum(){
			return (new ShoppingCart())->getSum();
		}








	}

 ?>