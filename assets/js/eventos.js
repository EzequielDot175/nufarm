
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
	 */

	 $('.find-input-in-results').keyup(function(event) {
	 	// var collection = $('');
	 	// console.log($(this).val());
	 	// $.each(array/object, function(index, val) {
	 	// 	 /* iterate through array or object */
	 	// });
	 });
	    
});


