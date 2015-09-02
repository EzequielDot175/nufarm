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

	var user = root.user;
	// ajax.user();

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
		scope.selClientes = a;
	});

	ajax.ve({method: 'catPremios'},function(a){
		// console.info('categorias premios :', a);
		scope.categorias_premios = a;
	});

	scope.setClientes = function(){
		ajax.ve({method: 'clientes', id: scope.vendedores, user: user},function(a){
			scope.selClientes = a;
		});
	}

	scope.submitFilter = function(){
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

		ajax.ve({method: 'filter', params: submit, user: user},function(a){
			scope.resultados = a;


			scope.facturacion_total = 0;
			scope.facturacion_prod_clave = 0;
			a.map(function(elem, index) {
				scope.facturacion_total += parseFloat(elem.total);
				scope.facturacion_prod_clave += parseFloat(elem.total_prod_clave);
			});
			scope.facturacion_prod_clave = Math.round( (scope.facturacion_prod_clave / scope.facturacion_total)*100 );
			console.info('FILTRO RESPUESTA :', a);
		});
	}

	scope.percentage = function(a,b){
		if (b == 0) {
			return 0;
		}else{
			var result = Math.round((parseFloat(b)/parseFloat(a))*100);
			return result;
		}
	}

	scope.categoria = function(a,b){
		if (b == 0) {
			return 'Sin Categoria';
		}else{
			var result = Math.round((parseFloat(b)/parseFloat(a))*100);
			var cat = 0;
			scope.categorias_premios.map(function(elem, index) {
				if (elem.max_req == 0) {elem.max_req = 999999999999};
				if (result >= elem.min_req && result <= elem.max_req) {
					cat = elem.categoria;
				};
			});

			return cat;
		}
		// console.info('Reporting :', a);
	}
}])