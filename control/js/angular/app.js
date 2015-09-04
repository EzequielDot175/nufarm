 var app = angular.module('ve', []);
 app.run(['$rootScope',function(rsp) {

 	// console.log($('meta[name="auth"]')[0].content);
 	// console.log($('meta[name="auth-role"]')[0].content);
 	rsp.user = {};
 	rsp.user.role = parseInt($('meta[name="auth-role"]')[0].content);
 	rsp.user.id =  parseInt($('meta[name="auth"]')[0].content );
 }]);


// app.config(['$routeProvider',
//         function(root) {
//             root.
//                 when('/', {
//                     templateUrl: 've/inc/filtros.html',
//                     controller: 'CtrlFilter'
//                 }).
//                 when('/edit/:id', {
//                     templateUrl: 've/inc/filtros.html',
//                     controller: 'CtrlFilter'
//                 }).
//                 otherwise({
//                     redirectTo: '/'
//                 });
//         }]);