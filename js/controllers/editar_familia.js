(function() {
  'use strict';

  angular
    .module('material-lite')
    .controller('EditarFamilia', ['$scope', '$http', '$window', '$location', EditarFamilia]);

  function EditarFamilia($scope, $http, $window, $location) {
    var tabla = "familia";
    $scope.nou_item = [];
    
    var url = "secciones/"+tabla+"/llistat.php";
    
    $http.post(url,{id: $location.search().id})
      .then(function(resposta){
        console.log("res_editar:", resposta.data);
        $scope.nou_item = resposta.data[0];
        $scope.nou_item.clase = "is-dirty";
      });


    $scope.add = function(){
      var url = "secciones/"+tabla+"/nou.php";
      $http.post(url,angular.toJson($scope.nou_item))
        .then(function(resposta){
          $window.location.href = '#/'+tabla+'/llistat';
        });
    }

    $scope.cancel = function(){
      $window.location.href = '#/'+tabla+'/llistat';
    }

  }


})();



