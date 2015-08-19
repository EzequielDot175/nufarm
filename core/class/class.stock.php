<?php 
	/**
	* @internal Stock Class
	*/
	class Stock extends DB
	{
		
		public function __construct()
		{
			parent::__construct();
		}
		/**
		 * @param talle : id_talle
		 * @param color : id_color
		 * @param num : id_color
		 * @param prod : id_color
		 * @internal Suma de stock al stock actual
		 */
		public function sumStock($talle = null,$color = null,$num,$prod){


			if(is_null($talle) && !is_null($color)):
			#color
			$upd = $this->prepare(self::STOCK_SUMSTOCK_COLOR);
			$upd->bindParam(':num',$num,PDO::PARAM_INT);
			$upd->bindParam(':color',$color,PDO::PARAM_INT);
			$upd->bindParam(':prod',$prod,PDO::PARAM_INT);
				if(!$upd->execute()):
					throw new PDOException("Error, sumStock : Color; Not working", 1);
				endif;
			
			elseif (!is_null($talle) && is_null($color)):
				
			#talle
			$upd = $this->prepare(self::STOCK_SUMSTOCK_TALLE);
			$upd->bindParam(':num',$num,PDO::PARAM_INT);
			$upd->bindParam(':talle',$talle,PDO::PARAM_INT);
			$upd->bindParam(':prod',$prod,PDO::PARAM_INT);
				if(!$upd->execute()):
					throw new PDOException("Error, sumStock : Talle; Not working", 1);
				endif;

			elseif (!is_null($talle) && !is_null($color)):
			#tallecolor


			$upd = $this->prepare(self::STOCK_SUMSTOCK_TALLECOLOR);
			$upd->bindParam(':num',$num,PDO::PARAM_INT);
			$upd->bindParam(':talle',$talle,PDO::PARAM_INT);
			$upd->bindParam(':color',$color,PDO::PARAM_INT);
			$upd->bindParam(':prod',$prod,PDO::PARAM_INT);
				if(!$upd->execute()):
					throw new PDOException("Error, sumStock : Color Talle; Not working", 1);
				endif;
			endif;
			$this->sumStockProd($prod,$num);
		}

		/**
		 * @param prod: id producto
		 * @param num: cantidad
		 */
		public function sumStockProd($prod,$num){
			$upd = $this->prepare(self::STOCK_SUMSTOCK_PROD);
			$upd->bindParam(':num',$num,PDO::PARAM_INT);
			$upd->bindParam(':prod',$prod,PDO::PARAM_INT);
			if(!$upd->execute()):
				throw new PDOException("Error, sumStockProd not working", 1);
			endif;
		}
	}

 ?>