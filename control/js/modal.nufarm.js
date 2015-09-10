(function($){
	$.fn.modalNufarm = function(params){
		var modal = $('.modal-alert');
		var btn_action = $(param.link);

		return {
			link: function(){
				btn_action.click(function(event) {
					event.preventDefault();
					modal.animate({opacity: 1, zIndex: 100}, speed)
				});
			}
		}
	}
})(jQuery);