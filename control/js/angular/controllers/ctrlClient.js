app.controller('name', ['$scope','ajax','$rootScope', function(scp, ajax, root){
	var auth = root.id;
	var client = ajax.veClient();

	client.periodos(auth,function(data){
		console.log(data);
	});

}])