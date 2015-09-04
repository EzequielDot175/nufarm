app.controller('CtrlFilter', ['$scope','ajax','$rootScope', function(scope,ajax,root){

	scope.vendedores = "";
	scope.clientes = "";
	scope.filter_date = "";
	scope.selVendedores = [];
	scope.selClientes = [];
	scope.selFilterDate = [];
	scope.resultados = [];
	scope.categorias_premios = [];
	scope.facturacion_total = 0;
	scope.facturacion_prod_clave = 0;
	scope.isAdmin = false;
	scope.canEdit = false;
	scope.inEdit = false;
	scope.inEditItemData = [];
	scope.chart = [];
	scope.id_current_edit = 0;
	scope.avance_producto = 0;
	scope.accede_categoria = 0;
	scope.start_app = false;
	/**
	 * Scope meses
	 */
	scope.meses ={

		agosto     : {
			total : 0,
			total_prod_clave : 0
		},
	
		septiembre : {
			total : 0,
			total_prod_clave : 0
		},
	
		octubre    : {
			total : 0,
			total_prod_clave : 0
		},
	
		noviembre  : {
			total : 0,
			total_prod_clave : 0
		},
	
		diciembre  : {
			total : 0,
			total_prod_clave : 0
		},
	
		enero      : {
			total : 0,
			total_prod_clave : 0
		},
	
		febrero    : {
			total : 0,
			total_prod_clave : 0
		},
	
		marzo      : {
			total : 0,
			total_prod_clave : 0
		}
	}






	var user = root.user;
	// ajax.user();
	
	if (user.role != 3) {
		scope.isAdmin = true;
	};	

	if (user.role != 3) {
		ajax.ve({method: 'vendedores', user: user},function(a){
			scope.selVendedores = a;
			// console.info('Reporting vendedores:', a);
		});
	};

	ajax.ve({method: 'periodos'},function(a){
		scope.selFilterDate = a;
	});

	ajax.ve({method: 'clientes', user: user},function(a){
		console.info('Reporting setClientes:', a);

		scope.selClientes = a;
	});

	ajax.ve({method: 'catPremios'},function(a){
		scope.categorias_premios = a;
	});

	scope.setClientes = function(){
		ajax.ve({method: 'clientes', id: scope.vendedores, user: user},function(a){
			scope.selClientes = a;
		});
	}

	scope.submitFilter = function(){

		if (window.myLine != undefined) {
			window.myLine.destroy();
		};

		if (scope.filter_date == "") {
			alert('Por favor ingrese un periodo primero');
			return "";
		};
		var submit = {
			cliente: scope.clientes,
			date: scope.filter_date
		};
		if (user.role != 3) {
			submit.vendedor = scope.vendedores;
		};

		scope.inEdit = false;

		ajax.ve({method: 'filter', params: submit, user: user},function(a){
			console.info('Reporting FILTRO:', a);
			scope.resultados = a;

		});
		
		// ajax.ve({method: 'totalByPeriod', date: scope.filter_date},function(a){
		// 	scope.facturacion_total = Math.round(a.total);
		// 	scope.facturacion_prod_clave = Math.round(a.producto_clave);
		// });

		ajax.ve({method : 'checkPeriod' , date: scope.filter_date}, function(a){
			var result = Boolean(parseInt(a));
			scope.canEdit = result;
		});

		scope.start_app = true;
	}


	scope.percentage = function(a,b){
		if (b == 0) {
			return 0;
		}else{
			var result = Math.round((parseFloat(b)/parseFloat(a))*100);
			return result;
		}
	}

	scope.avancetotal = function(curr_total,old_total){
		
		// console.info('Reporting curr_total:', curr_total);
		// console.info('Reporting old_total:', old_total);

		// return 0;
		if (curr_total != 0 && old_total != 0) {
			return Math.round( ( parseFloat(curr_total) / parseFloat(old_total) ) * 100 );
		}else{
			return 0;
		}
	}

	scope.oldPeriod = function(a){

		// console.info('Reporting check period:', a != undefined);
		if (a != undefined) {
			return true;
		}else{
			return false;
		}
		return false;
	}

	scope.prodClave = function(curr_total, curr_prod_clave){
		if (curr_total != 0 && curr_prod_clave != 0) {
			return Math.round( (parseFloat(curr_prod_clave) / parseFloat(curr_total)) * 100 );
		}else{
			return 0;
		}
	}

	scope.categoria = function(curr_prod_clave,curr_total,old_total){
		var total = 0;
		var prod_clave = 0;

		/**
		 * Formula
		 *
		 * Porcentaje de prod clave
		 * curr_total / curr_prod_clave * 100
		 *
		 * Porcentaje Avance total
		 * curr_total / old_total * 100
		 */
		var prod_clave = 0;
		if (curr_total != 0 && curr_prod_clave != 0) {
			prod_clave = Math.round( (parseFloat(curr_prod_clave) / parseFloat(curr_total)) * 100 );;
		};

		var avance_total = 0;
		if (curr_total != 0 && curr_prod_clave != 0) {
			avance_total = Math.round( (parseFloat(curr_total) / parseFloat(old_total)) * 100 );
		};

		
		if (prod_clave == 0 && avance_total == 0) {
			return 0;
		}else{
			if (avance_total >= 100) {

				var cat = 0;
				scope.categorias_premios.map(function(elem, index) {
					if (elem.max_req == 0) {elem.max_req = 999999999999};
					if (prod_clave >= elem.min_req && prod_clave <= elem.max_req) {
						cat = elem.categoria;
					};
				});

				return cat;
			}else{
				return 0;
			}
		}


		// console.info('Reporting :', a);
	}

	scope.editItem = function(val){

		if (window.myLine != undefined) {
			window.myLine.destroy();
		};
		scope.inEdit = true;
		// console.info('REPORTING COLLECTION:', val);
		scope.id_current_edit = val.id;
		var json_data = JSON.parse(val.facturacion);
		// console.info('Reporting :', scope.agosto);

		scope.meses = {

			agosto     : {
				total : json_data.Agosto.facturacion_total,
				total_prod_clave : json_data.Agosto.facturacion_prod_clave
			},
		
			septiembre : {
				total : json_data.Septiembre.facturacion_total,
				total_prod_clave : json_data.Septiembre.facturacion_prod_clave
			},
		
			octubre    : {
				total : json_data.Octubre.facturacion_total,
				total_prod_clave : json_data.Octubre.facturacion_prod_clave
			},
		
			noviembre  : {
				total : json_data.Noviembre.facturacion_total,
				total_prod_clave : json_data.Noviembre.facturacion_prod_clave
			},
		
			diciembre  : {
				total : json_data.Diciembre.facturacion_total,
				total_prod_clave : json_data.Diciembre.facturacion_prod_clave
			},
		
			enero      : {
				total : json_data.Enero.facturacion_total,
				total_prod_clave : json_data.Enero.facturacion_prod_clave
			},
		
			febrero    : {
				total : json_data.Febrero.facturacion_total,
				total_prod_clave : json_data.Febrero.facturacion_prod_clave
			},
		
			marzo      : {
				total : json_data.Marzo.facturacion_total,
				total_prod_clave : json_data.Marzo.facturacion_prod_clave
			}
		}

		scope.graph(scope.graphArray());


		// console.info('Reporting :', val);
		scope.avance_producto = scope.avancetotal(val.total,val.ultimo_total);
		scope.accede_categoria = scope.categoria(val.total_prod_clave, val.total , val.ultimo_total);

	}

	scope.graphArray = function(){
		var percentage = [];
		$.each(scope.meses, function(index, val) {
			if (val.total_prod_clave != 0) {
				percentage.push( Math.round( (parseFloat(val.total_prod_clave) / parseFloat(val.total)) * 100 ) );
			}else{
				percentage.push("0");
			}
		});
		return percentage;
	}

	scope.updateFacturacion = function(){
		// console.info('Reporting :', scope.meses);
		scope.updateGraph(scope.graphArray());
		ajax.ve({method: 'updateDataFacturacion', data: scope.meses ,id : scope.id_current_edit},function(a){

			/**
			 * Update datos de de la pantalla
			 */
			scope.avance_producto = scope.avancetotal(a.total,a.ultimo_total);
			scope.accede_categoria = scope.categoria(a.total_prod_clave, a.total , a.ultimo_total);

			scope.resultados.map(function(elem, index) {
				if (a.id == elem.id) {
					scope.resultados[index].total = a.total;
					scope.resultados[index].total_prod_clave = a.total_prod_clave;
					scope.resultados[index].ultimo_prod_clave = a.ultimo_prod_clave;
					scope.resultados[index].ultimo_prod_clave = a.ultimo_prod_clave;
					scope.resultados[index].ultimo_total = a.ultimo_total;
					scope.resultados[index].facturacion = a.facturacion;
				};
			})
			console.info('Reporting update:', a);	
			console.info('Reporting resultados:', scope.resultados);	
		});


	}


	scope.updateGraph = function(array){
		
		window.myLine.destroy();
		scope.graph(array);
	}
	scope.graph = function(array){
		scope.chart = {
			labels : ["Agosto","Septiembre","Octubre","Noviembre","Diciembre","Enero","Febrero","Marzo"],
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
		window.myLine = new Chart(ctx).Line(scope.chart, {
			responsive: true
		});
	}

				








}])