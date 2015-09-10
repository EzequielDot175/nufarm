<?php 
	/**
	* @internal
	*/
	class Excel
	{
		private $excel;
		private $cells;
		private $name = "";

		/**
		 * Directorio donde se aloja los excel
		 */
		public $dir;

		function __construct()
		{
			$this->excel = new PHPExcel();
			$this->cells = range('A', 'Z');
			$this->dir = APP_DIR.'/excel/';
			$this->name = "Nufarm Excel - ".rand(100000,900000);

		}
		/**
		*	@param array
		*	       -> title
		*	       -> subject
		*	       -> description
		*	       -> keywords
		*	       -> category
		*/
		public function setProp($prop){

			$prop = (Object)$prop;
			$prop->creator = "Nufarm"; 

			foreach($prop as $key => $val):
				$this->excel->getProperties()->{'set'.$key}($val);
			endforeach;
		}

		/**
		 * Set name
		 */
		public function setName($name){
			$this->name = $name;
		}
		/**
		 * Get Name
		 */
		public function getName(){
			return $this->name;
		}

		/**
		 * Set Dir
		 */
		public function setDir($localPath){
			$this->dir = APP_DIR.$localPath;
		}

		/**
		 * Get Dir
		 */
		public function getDir(){
			return $this->dir;
		}

		/**
		 * @param $data
		 * Para seteat los datos tiene que ser un array de la siguiente forma
		 * array(
		 * 	array( //Fila numero 1
		 * 		'valor', //valor celda 1
		 * 		'valor', //valor celda 2
		 * 		'valor', //valor celda 3
		 * 	),
		 * 	array( //Fila numero 2
		 * 		'valor', //valor celda 1
		 * 		'valor', //valor celda 2
		 * 		'valor', //valor celda 3
		 * 	),
		 * )
		 */
		
		public function setData($data){

			
			array_unshift($data, array(''));
			
			foreach($data as $key => $columns):
				if($key > 0):
					foreach($columns as $ckey => $valorCelda):
						$celda = $this->cells[$ckey].$key;
						$this->excel->setActiveSheetIndex(0)->setCellValue($celda,$valorCelda);
					endforeach;
				endif;
			endforeach;
		}

		public function create(){
			
            $this->excel->setActiveSheetIndex(0);
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
            $objWriter->save($this->dir.$this->name.'.xlsx');
		}

		public function setFiltrosFormat($data){

			/**
			 * @ seteo el titulo
			 */

			$this->excel->setActiveSheetIndex(0);

			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(50);
			$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(50);
			$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(50);

			$this->excel->getActiveSheet()->setCellValue('A1','ID COMPRA');
			$this->excel->getActiveSheet()->setCellValue('B1','REMITO');
			$this->excel->getActiveSheet()->setCellValue('C1','TOTAL COMPRA');
			$this->excel->getActiveSheet()->setCellValue('D1','VENDEDOR ');
			$this->excel->getActiveSheet()->setCellValue('E1','CLIENTE');
			$this->excel->getActiveSheet()->setCellValue('F1','PRODUCTO');
			$this->excel->getActiveSheet()->setCellValue('G1','UNIDADES');
			$this->excel->getActiveSheet()->setCellValue('H1','PAGADO');
			$this->excel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A1:H1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$this->excel->getActiveSheet()->getStyle('A1:H1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$this->excel->getActiveSheet()->getStyle('A1:H1')->getFill()->getStartColor()->setARGB('DDD9C4');
	
			$formatData = array();

			$formatData[] = array(
			'ID COMPRA',
			'REMITO',
			'TOTAL COMPRA',
			'VENDEDOR ',
			'CLIENTE',
			'PRODUCTO',
			'UNIDADES',
			'PAGADO');
			
			$startKey = 2;



			foreach($data as $keyCompras => $compra):

					foreach($compra as $keyDetalle => $detalle):
						if($keyDetalle != "total"):
							$detalle = (Object)$detalle;

							$formatData[$startKey] = array(
								$detalle->idCompra,
								$detalle->remito,
								$compra['total'],
								$detalle->v_nombre." ".$detalle->v_apellido,
								$detalle->strNombre." ".$detalle->strApellido,
								$detalle->cantidad,
								$detalle->prod_nombre,
								$detalle->pagado
							);

							$startKey++;
						endif;
					endforeach;

			endforeach;

			$this->setData($formatData);

		}
	}


	

	// die();
 ?>