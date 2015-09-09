
$(document).ready(function(){

	$(window).resize(function() {
		var windowHeight = $(window).height();
		if(windowHeight > 1000){
			$('.footer').css('position', 'fixed');
			$('.contenedor-encuesta').css('padding-bottom', '130px');
		}else{
			$('.footer').css('position', 'relative');
			$('.contenedor-encuesta').css('padding-bottom', '130px');
		}
	});

	var windowHeight = $(window).height();
	console.log(windowHeight);
	if(windowHeight > 1000){
		$('.footer').css('position', 'fixed');
	}else{
		$('.footer').css('position', 'relative');
	}



	/**
	 * Busqueda de productos en la home
	 * Facil...
	 */

	 $('.find-input-in-results').keyup(function(event) {
	 	var collection = $('.find-box-in-results');
	 	var find = $(this).val().toUpperCase();
	 	if (find != "") {
		 	$('.find-box-in-results').parent().parent().hide();
		 	$.each(collection, function(index, val) {
		 		var title = $(val).text().toUpperCase();
		 		if (title.search(find) != -1) {
		 			$(val).parent().parent().show();
		 		};
		 	});
	 	}else{
	 		$('.find-box-in-results').parent().parent().show();
	 	}
	 });



	 /**
	  * Combo en historial.php
	  */
	 
	 $('#findBy').change(function(event) {
	 	event.preventDefault();
	 	var obj = $(this);
	 	var comboSelect = $('#results');


		/**
		 * cambio el nombre del select segun la opcion
		 */

	 	switch(obj.val()){
	 		case '1':
	 		comboSelect.attr('name', 'producto');
	 		break;
	 		case '2':
	 		comboSelect.attr('name', 'estado');
	 		break;
	 		case '3':
	 		comboSelect.attr('name', 'remito');
	 		break;
	 		case '4':
	 		comboSelect.attr('name', '');
	 		break;

	 		default:
	 		comboSelect.attr('name', '');

	 		break;
	 	}

	 	if (obj.val() != 4) {
	 		comboSelect.removeClass('hidden');
	 		$('#date').addClass('hidden');

	 		if (obj.val() != "" || obj.val() == 4) {
	 			$.post('control/ajax.front.php', {frontAjax: '',method: 'selectHistorial' , option: obj.val()}, function(data) {
	 				/**
	 				 * decoding
	 				 */
	 				var collection = $.parseJSON(data);
	 				
	 				comboSelect.empty();
	 				
	 				$.each(collection, function(index, val) {
	 					comboSelect.append('<option value="'+val.value+'">'+val.text+'</option>');
	 				});
	 				

		 		});
	 		}else{
	 			comboSelect.empty();
	 		}
	 	}else{
	 		comboSelect.addClass('hidden');
	 		$('#date').removeClass('hidden');
	 	}

	 });



	    
});


