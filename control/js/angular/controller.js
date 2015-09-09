app.controller('FiltroController', ['$scope','ajax', function ($scope,ajax) {
	
	$scope.select_vendedores    = "all";
	$scope.select_prod_canjeado = "";
	$scope.vendedores           = [];
	$scope.filtroData           = [];
	// $scope.currentDate 		= true;


	/**
	 * Seteo el OBJECT filtro
	 */
	 $scope.filtro = {
	 	clientes 			: '',
	 	cant_canjes 		: '',
	 	punt_disponibles 	: '',
	 	prod_canjeado 		: '',
	 	estado 				: '',
	 	desde 				: '',
	 	typeSearch 			: ''
	 };


	/**
	 * Seteo los options de vendedores
	 */
	ajax.post({get: 'vendedores'},function(a){
		console.info('Reporting vendedores:', a);
		$scope.vendedores =	a ;
	});

	/**
	 * Seteo los options de productos canjeados
	 */
	ajax.post({get: 'ProdOptions'},function(a){
		console.info('Reporting prod options:', a);
		$scope.select_prod_canjeado = a;
	});

	/**
	 * Seteo cliente on change
	 */
	$scope.setCliente = function (){
		var id = $scope.select_vendedores || 'all';
		ajax.post({get: 'clientes',id: id},function(a){
			$scope.clientes = a ;
		});
	}
	$scope.setCliente();

	/**
	 * Envio el formulario 
	 */
	
	$scope.filter = function(){
		console.info('JS', $scope.filtro);
		ajax.post({get: 'filtrado' , parameters: $scope.filtro},function(a){
			console.info('RESPONSE', a);
			$scope.filtroData = a;
		});

	}

	$scope.estado = function(estate){

		switch(estate){
			case '1':
				return 'Pedido Pendiente';
				break;
			case '2':
				return 'Pedido en Proceso';
				break;
			case '3':
				return 'Pedido enviado';
				break;
			case '4':
				return 'Pedido entregado';
				break;
			default:
				return 'SIN ESTADO';
				break;
		}
	}



}])