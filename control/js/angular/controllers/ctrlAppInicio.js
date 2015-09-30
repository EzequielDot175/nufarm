app.controller('ctrlAppInicio', ['$scope','ajax', function(scp,ajax){

	scp.currentUser = [];

	var srv = ajax.formInit();
	// 	srv.user = 10;
	srv.getUser(function(a){
		console.info('Reporting User:', a);
		scp.currentUser = a;

		scp.company   = a.strEmpresa;
		scp.direction = a.direccion;
		scp.name      = a.strNombre;
		scp.city      = a.ciudad;
		scp.lastname  = a.strApellido;
		scp.cod       = a.cp;
		scp.phone     = a.telefono;
		scp.province  = a.provincia;
	});
	// var user = src.getUser();

	// console.info('Reporting user:', srv.getUser());

	scp.basics = function(){
		var user = {
			company   : scp.company  ,
			direction : scp.direction,
			name      : scp.name     ,
			lastname  : scp.lastname ,
			city  	  : scp.city 	 ,
			cod       : scp.cod      ,
			phone     : scp.phone    ,
			province  : scp.province 
		};

		srv.basics(user,function(a){
			console.info('Reporting a:', a);
		});

	}

}]);