(function() {
  'use strict';

  angular
    .module('material-lite')
    .controller('NouAgrupacio', ['$scope', '$http', '$window', NouAgrupacio]);

  function NouAgrupacio($scope, $http, $window) {
    
    var url = "secciones/agrupacio/nou.php";
    var nou_item = [];
    nou_item.nom;

    $scope.add = function(){

      $scope.nou_item.id = -1;
      $http.post(url,angular.toJson($scope.nou_item))
        .then(function(resposta){
          $window.location.href = '#/agrupacio/llistat';
        });
    }

    $scope.cancel = function(){
      $window.location.href = '#/agrupacio/llistat';
    }

  }


})();



