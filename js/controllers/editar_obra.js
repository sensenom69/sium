(function() {
  'use strict';

  angular
    .module('material-lite')
    .controller('EditarObra', ['$scope', '$http', '$window', '$location', EditarObra]);

  function EditarObra($scope, $http, $window, $location) {
    var tabla= "obra";
    $scope.nou_item = [];
    
    var url = "secciones/"+tabla+"/llistat.php";
   //var nou_usuari = [];
    
    $http.post(url,{id: $location.search().id})
      .then(function(resposta){
        console.log("res_editar:", resposta.data);
        $scope.nou_item = resposta.data[0];
        $scope.nou_item.clase = "is-dirty";
        var aux  = $scope.nou_item.agrupacio;
        $scope.nou_item.agrupacio = [];
        $scope.nou_item.agrupacio.nom= aux;
        
      });


    $scope.add = function(){
      var url = "secciones/"+tabla+"/nou.php";
      $scope.nou_item.id_agrupacio = $scope.nou_item.agrupacio.id;
      $http.post(url,angular.toJson($scope.nou_item))
        .then(function(resposta){
          $window.location.href = "#/"+tabla+"/llistat";
        });
    }

    $scope.cance = function(){
      $window.location.href = "#/"+tabla+"/llistat";
    }

  }


})();


