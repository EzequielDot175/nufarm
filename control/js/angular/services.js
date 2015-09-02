app.service('ajax', ['$http','$rootScope',function (ajax,root) {

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

	this.user = function(){
		ajax.post('ve/ajax.php',{method: 'User', user: root.user,vendedor_estrella : ""}).success(function(a){
			// console.info('User :', a);
			console.log(a);
		}).error(function(a) {
			console.info('Error :', a);
		});
	}

	this.veClient = function(){
		return {
			post: function(param,callback){
				var extend = param;
					extend.vendedor_estrella = "";
				ajax.post('control/ve/ajax.php',extend).success(callback).error(function(a){
					console.error(a);
				});
			},
			myData: function(id,callback){
				var param = {method: 'myData'};
					param.id = id;
				this.post(param,callback);
			}

		};
	}

}])

