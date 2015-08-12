<?php 

	/**
	* 
	*/
	class Template
	{
		private $template;
		/**
		 * @param $name = Nombre del template
		 * @param $data = Datos a insertar
		 */
		public function __construct($name,$data)
		{
			$this->{'get'.$name}($data);
		}


		public function getOption($data){
			$html = "";
			foreach($data as $k => $v):
				$html .= '<option value="'.$v->value.'">'.$v->text.'</option>';
			endforeach;
			echo $html;
		}
		


		
		public static function get($name,$data){
			$x = new Template($name,$data);
		}
	}

 ?>