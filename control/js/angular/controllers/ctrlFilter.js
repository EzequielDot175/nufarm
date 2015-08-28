app.controller('CtrlFilter', ['$scope','ajax', function(scope,ajax){

	scope.vendedores = "";
	scope.clientes = "";
	scope.filter_date = "";
	scope.selVendedores = [];
	scope.selClientes = [];
	scope.selFilterDate = [{k:'2014_2015', val: '2014 - 2015'}];

	ajax.ve({method: 'vendedores'},function(a){
		scope.selVendedores = a;
	});

	ajax.ve({method: 'clientes'},function(a){
		console.info('Reporting cliente:', a);
		scope.selClientes = a;
	});

	scope.setClientes = function(){
		ajax.ve({method: 'clientes', id: scope.vendedores},function(a){
			console.info('Reporting cliente:', a);
			scope.selClientes = a;
		});
	}

	scope.submitFilter = function(){
		var submit = {
			vendedor: scope.vendedores,
			cliente: scope.clientes,
			date: scope.filter_date
		};
		ajax.ve({method: 'filter', params: submit},function(a){
			console.info('Reporting :', a);
		});
	}
}])