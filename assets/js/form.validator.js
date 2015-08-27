(function($){

	$.fn.message = function(param){
		var messages = [
			'respetar cantidad máxima',  // 0
			'excedidó límite de canjes para este producto', 	// 1
			'respetar cantidad minima', 	// 2
			'Por favor, llene los campos de productos'  // 3
		];
		var options = $.extend(true, {}, param);
		
		console.log(options);

		if (!param.def) {
			$(this).children('.text').text(messages[param.message]);
			console.log($(this).children('.text'));
			console.log(param);
			$(this).removeClass('hidden');
		}else{
			$(this).children('.text').text('');
			$(this).addClass('hidden');
		}

	}

})(jQuery);


jQuery(document).ready(function($) {
	
	/**
	 * @mensajes
	 */
	


	/**
	 * FORMULARIO DE PRODUCTOS
	 */
	
	var send = false;

	var max = $('#max').val();
	if (max == "notlimit") {
		max = 9999999999;
	};
	var min = parseInt($('#min').val()) || 0;

	$('#add_product').on('submit', function(event) {
		event.preventDefault();
		var total = 0;
		


		/**
		 * Evaluo el total
		 */
		$('.input_talle').each(function(index, val) {
			total += parseInt($(val).val()) || 0;
			console.info('value : ' , total);
		});

		if (total < min) {
			$('#error_1').message({message: 2});
			event.preventDefault();
		}else if(total > max){
			$('#error_1').message({message: 0});
			event.preventDefault();
		}else if(total == 0){
			$('#error_1').message({message: 3});
			event.preventDefault();		
		}else{
			$('#error_1').message({def: true});
			$(this).unbind(event);
			$(this).submit();
		}

	});


	$('.input_talle').change(function(event) {
		event.preventDefault();
		/**
		 * params
		 */
		var total = 0;

		/**
		 * Evaluo el total
		 */
		$('.input_talle').each(function(index, el) {
			total += parseInt($(el).val()) || 0;		
		});
		
		// console.info('Reporting :', total , min , max);

		console.log($('#max').val());
		if (total < min) {
			$('#error_1').message({message: 2});
		}else if(total > max){
			$('#error_1').message({message: 0});
		}else if(total == 0){
			$('#error_1').message({message: 3});		
		}else{
			$('#error_1').message({def: true});
		}

		/**
		 * Sanitizo inputs menores a 0
		 */
		if (parseInt($(this).val()) < 0 ) {
			$(this).val(0);
			$(this).trigger('change');
		};

	});



});