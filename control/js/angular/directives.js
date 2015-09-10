app.directive('preventDefault',function(){
	return {
		restric: 'A',
		link: function(scope,elem,attr){
			$(elem).click(function(event) {
				event.preventDefault();
			});
		}
	};
})