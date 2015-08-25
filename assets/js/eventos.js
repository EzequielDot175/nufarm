
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
	    
});


