app.service('ajax', ['$http',function (ajax) {

	this.url = 'ajax.php';

	this.post = function(param,callback){
		ajax.post('ajax.php',param).success(callback).error(function(a){
			console.info('Error: ',a);
		});
	}

	this.ve = function(param,callback){
		var options = param || {};
			options.vendedor_estrella = "";
		ajax.post('ve/ajax.php',options).success(callback).error(function(a){
			console.info('Error: ',a);
		});	
	}

}])
