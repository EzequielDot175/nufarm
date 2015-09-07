app.controller('ctrlClient', ['$scope','ajax','$rootScope', function(scp, ajax, root){
	var auth       = root.user.id;
	var client     = ajax.veClient();
	
	scp.periodos   = [];
	scp.myData     = [];
	scp.categoria  = 0;
	
	scp.fact_total = 0;
	
	/**
	 * Scope Meses
	 */
	scp.agosto     = 0;                
	scp.septiembre = 0;
	scp.octubre    = 0;            
	scp.noviembre  = 0;    
	scp.diciembre  = 0;    
	scp.enero      = 0;                    
	scp.febrero    = 0;            
	scp.marzo      = 0;                    

	/**
	 * Scope totales
	 */
	scp.total = 0;
	scp.procentaje_prod_clave = 0;
	scp.progreso = 0;
	scp.categoria = 0;
	scp.hasMonths = false;

	/**
	 * Seteo los periodos disponibles
	 */
	client.periodos(auth,function(data){
		scp.periodos = data;
	});


	/**
	 * Event: Onchange Periodo
 	 * Description : Cuando cambie el periodo, traigo los datos correspondientes de mi usuario logueado
	 */
	scp.selectPeriodo = function(){
		client.myData({cliente: auth,date: scp.periodo},function(data){
			
			console.info('Reporting :', data);
			var collection = data[0];
			scp.total = data[0].total;
			scp.procentaje_prod_clave = scp.porc_prod_clave(data[0].total, data[0].total_prod_clave);
			scp.progreso = collection.progreso;
			if (collection.data != undefined) {
				scp.hasMonths = true;
			};
		});

	}

	scp.porc_prod_clave = function(prod_total, prod_clave){
		if (prod_total != 0, prod_clave != 0) {
			return Math.round( (parseFloat(prod_clave) / parseFloat(prod_total)) * 100 );
		}else{
			return 0;
		}
	}

	

}])