(function() {
  'use strict';

  angular
    .module('material-lite')
    .controller('NouFamilia', ['$scope', '$http', '$window', NouFamilia]);

  function NouFamilia($scope, $http, $window) {
    var tabla = "familia";
    var url = "secciones/"+tabla+"/nou.php";
    var nou_item = [];
    nou_item.nom;

    $scope.add = function(){

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



