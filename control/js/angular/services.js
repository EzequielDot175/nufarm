app.service('ajax', ['$http',function (ajax) {

	this.url = 'ajax.php';

	this.post = function(param,callback){
		ajax.post('ajax.php',param).success(callback).error(function(a){
			console.info('Error: ',a);
		});
	}


}])
