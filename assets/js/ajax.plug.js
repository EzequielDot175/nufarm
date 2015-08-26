(function($){
	/**
	 * Este plugin es para dejar en comun un fichero de ajax, la ruta se setea sola
	 */
	$.fn.ajaxCore = function(params){

		// var settings = {
		// }
		// var options = $.extend(true, target object, object1);
		// 
		$.post('./core/ajax/ajax.php',params, function(data, textStatus, xhr) {
			console.info('Reporting :', data);
		});
		
	}
})(jQuery);