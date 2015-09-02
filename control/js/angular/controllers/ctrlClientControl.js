app.controller('CTRLClientController', ['$scope','ajax','$rootScope', function(scp,ajax,rsp){
	scp.facturacion = [];

	var user = rsp.user;
	var client = ajax.veClient();

	client.myData(user,function(data){
		var format = data;
			format.data = JSON.parse(data.data);
		scp.facturacion = format;

		console.info('Reporting :', scp.facturacion);
	});

	// console.info('Reporting :', rsp);
}])




