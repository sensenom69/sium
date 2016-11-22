(function() {
  'use strict';

  angular
    .module('material-lite')
    .controller('NouObra', ['$scope', '$http', '$window', NouObra]);

  function NouObra($scope, $http, $window) {
    var tabla = "obra";
    var url = "secciones/"+tabla+"/nou.php";
    var nou_item = [];
    nou_item.agrupacio = [];
    nou_item.nom;
    nou_item.descripcio;
    nou_item.compositor;
    nou_item.partitura;
    nou_item.audio;
    nou_item.etiquetes;

    $scope.add = function(){
      $scope.nou_item.id_agrupacio = $scope.nou_item.agrupacio.id;
      $scope.nou_item.id = -1;
      $http.post(url,angular.toJson($scope.nou_item))
        .then(function(resposta){
          $window.location.href = "#/"+tabla+"/llistat";
        });
    }

    $scope.cancel = function(){
      $window.location.href = "#/"+tabla+"/llistat";
    }

  }


})();
