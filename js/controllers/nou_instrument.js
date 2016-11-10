(function() {
  'use strict';

  angular
    .module('material-lite')
    .controller('NouInstrument', ['$scope', '$http', '$window', NouInstrument]);

  function NouInstrument($scope, $http, $window) {
    var tabla = "instrument";
    var url = "secciones/"+tabla+"/nou.php";
    var nou_item = [];
    nou_item.familia = [];
    nou_item.nom;

    $scope.add = function(){
      $scope.nou_item.id_familia = $scope.nou_item.familia.id;
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
