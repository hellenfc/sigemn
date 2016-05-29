var app = angular.module('myApp',  ['ngRoute','ngResource']);
app.controller('customersCtrl', function($scope, $http) {
  $scope.findCursos = function(){
  	console.log('Entrando a Angular');
    var url = "http://localhost/sigemn/public/cursos/";
    $http.get( url + $scope.selectedJornada)
    .success(function (response) {$scope.names = response;});
  };
});
