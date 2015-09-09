<?php 
	/**
	* 
	*/
	class Mail extends PHPMailer
	{

		/**
		 * @internal FACADE
		 */
		use Facade;

		public $html;

		public function __construct()
		{
			$this->isSMTP();
			$this->Host = 'mail.productosnufarm.com';
			$this->SMTPAuth = true;
			$this->Username = 'mknet@productosnufarm.com';
			$this->Password = 'mkn1243';
			$this->SMTPSecure = 'tls';
			$this->From = 'mknet@productosnufarm.com';
			$this->FromName = 'MarketingNet';

			/**
			 * Direcciones de destino
			 */
			$this->addAddress('ezequiel@dot175.com', '--');
			$this->isHTML(true);
			$this->Subject = 'Mensaje de Nufarm Maxx';
			$this->Body    = "Mensaje sin definir";

		}




		public function infConsulta($array){
			$obj = (Object)$array;
			$usuario = Auth::User();
			try {
				$template = new Template('consulta',array(
					'nombre' => $usuario->strNombre,
					'apellido' => $usuario->strApellido,
					'mensaje' => $obj->descripcion,
					'asunto' => $obj->asunto
					));

				$this->Body = $template->get();

				$this->send();
				
			} catch (Exception $e) {
				echo($e->getMessage());
			}
		}

		public function respuestaConsulta($array){
			$obj = (Object)$array;
			$usuario = Auth::UserAdmin();
			$template = new Template('consulta-response',
				array(
					'asunto' => $obj->asunto,
					'nombre' => $obj->nombre,
					'apellido' => $obj->apellido,
					'mensaje' => $obj->mensaje
					)
				);

			$this->Body = $template->get();

			$this->send();
		}



		public static function informarConsulta($array){
			self::method('infConsulta',$array);
		}

		public static function informarRespuestaConsulta($array){
			self::method('respuestaConsulta',$array);
		}
		
	}
 ?>