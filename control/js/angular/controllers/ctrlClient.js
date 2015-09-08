app.controller('ctrlClient', ['$scope','ajax','$rootScope', function(scp, ajax, root){
	var auth       = root.user.id;
	var client     = ajax.veClient();
	
	scp.periodos   = [];
	scp.myData     = [];
	scp.categorias_premios = [];	
	scp.fact_total = 0;

	/**
	 * Scope Meses
	 */
	scp.meses 			 = {};
	scp.meses.Agosto     = 0;                
	scp.meses.Septiembre = 0;
	scp.meses.Octubre    = 0;            
	scp.meses.Noviembre  = 0;    
	scp.meses.Diciembre  = 0;    
	scp.meses.Enero      = 0;                    
	scp.meses.Febrero    = 0;            
	scp.meses.Marzo      = 0;                    

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
	 * Seteo los datos de los premios de categorias y sus rangos
	 */
	client.premios(function(a){
		scp.categorias_premios = a || [];
	});

	/**
	 * Event: Onchange Periodo
 	 * Description : Cuando cambie el periodo, traigo los datos correspondientes de mi usuario logueado
	 */
	scp.selectPeriodo = function(){

		if (scp.periodo == "") {
			if (window.myLine != undefined) {
				window.myLine.destroy();
				scp.hasMonths = false;
			};
		};
		client.myData({cliente: auth,date: scp.periodo},function(data){
			
			console.info('Reporting :', data);
			var collection = data[0];
			scp.total = collection.total ;
			scp.procentaje_prod_clave = scp.porc_prod_clave(collection.total, collection.total_prod_clave);

			if (collection.facturacion != undefined) {
				var meses = JSON.parse(collection.facturacion);
				scp.hasMonths = true;
				scp.progreso = scp.calcularProgreso( collection.total,collection.ultimo_total );
				scp.calcularCategoriaNew( collection.total , collection.total_prod_clave );

				/**
				 * Actualizo los valores de los meses segun el index
				 */
				var array = [];
				$.each(meses, function(index, val) {
					scp.meses[index] = val.facturacion_total;
					array.push(val.facturacion_total);
				});

				scp.graph(array);

			}else{
				scp.hasMonths = false;
				scp.progreso = collection.progreso;
				scp.calcularCategoriaOld(collection.progreso,collection.total,collection.total_prod_clave);

				var array = [0,collection.total];
				scp.graph(array);
			}
		});

	}

	scp.porc_prod_clave = function(prod_total, prod_clave){
		if (prod_total != 0, prod_clave != 0) {
			return Math.round( (parseFloat(prod_clave) / parseFloat(prod_total)) * 100 );
		}else{
			return 0;
		}
	}

	scp.calcularProgreso = function(total,ultimo_total){
		if (total != 0 && ultimo_total != 0) {
			return Math.round( ( parseFloat(ultimo_total) / parseFloat(total) ) * 100  );
		}else{
			return 0;
		}
	}

	scp.calcularCategoriaNew = function(total,prod_clave){
		var porcentaje = scp.porc_prod_clave(total,prod_clave);

		if (scp.progreso >= 100 ) {
			scp.categorias_premios.map(function(elem, index) {
				if (elem.max_req == 0) { elem.max_req = 999999999};
				if (porcentaje >= elem.min_req && porcentaje <= elem.max_req ) {
					scp.categoria = elem.categoria;
				}else{
					scp.categoria = 0;
				}
				

			});
		}else{
			scp.categoria = 0;
		}
	}

	scp.calcularCategoriaOld = function(progreso,prod_total,prod_clave){
		var porcentaje = scp.porc_prod_clave(prod_total,prod_clave);

		if (progreso >= 100 ) {
			scp.categorias_premios.map(function(elem, index) {
				if (elem.max_req == 0) { elem.max_req = 999999999};
				if (porcentaje >= elem.min_req && porcentaje <= elem.max_req ) {
					scp.categoria = elem.categoria;
				}else{
					scp.categoria = 0;
				}
				

			});
		}else{
			scp.categoria = 0;
		}
	}

	scp.graph = function(array){

		if (window.myLine != undefined) {
			window.myLine.destroy();
		};
		var labels = [];
		for (var i = 0; i < array.length; i++) {
			labels.push("");
		};

		var lineChartData = {
			//labels : ["Agosto","Septiembre","Octubre","Noviembre","Diciembre","Enero","Febrero","Marzo"], con labels
			labels : labels, // sin labels
			datasets : [
			{
				fillColor : "rgba(0,0,0,0.1)",
				strokeColor : "rgba(220,220,220,1)",
				pointColor : "#666666",
				pointStrokeColor : "#666666",
				pointHighlightFill : "#666666",
				pointHighlightStroke : "rgba(220,220,220,1)",
				data : array //valor correspondiente a la categoria de 0 a 3 por mes
			},
			]

		}

		var ctx = document.getElementById("canvas").getContext("2d");
		window.myLine = new Chart(ctx).Line(lineChartData, {
			responsive: true
		});
	}
	

}])


							