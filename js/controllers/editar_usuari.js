(function() {
  'use strict';

  angular
    .module('material-lite')
    .controller('EditarUsuari', ['$scope', '$http', '$window', '$location', EditarUsuari]);

  function EditarUsuari($scope, $http, $window, $location) {
    $scope.nou_usuari = [];
    
    var url = "secciones/usuaris/llistat.php";
   //var nou_usuari = [];
    
    $http.post(url,{id: $location.search().id})
      .then(function(resposta){
        console.log("res_editar:", resposta.data);
        $scope.nou_usuari = resposta.data[0];
        $scope.nou_usuari.clase = "is-dirty";
        var aux  = $scope.nou_usuari.agrupacio;
        $scope.nou_usuari.agrupacio = [];
        $scope.nou_usuari.agrupacio.nom= aux;
        aux  = $scope.nou_usuari.instrument;
        $scope.nou_usuari.instrument = [];
        $scope.nou_usuari.instrument.nom= aux;
      });


    $scope.addUsuari = function(){
      var url = "secciones/usuaris/nou.php";
    
      $scope.nou_usuari.id_instrument = $scope.nou_usuari.instrument.id;
      $scope.nou_usuari.id_agrupacio = $scope.nou_usuari.agrupacio.id;
      $http.post(url,angular.toJson($scope.nou_usuari))
        .then(function(resposta){
          $window.location.href = '#/usuaris/llistat';
        });
    }

    $scope.cancelUsuari = function(){
      $window.location.href = '#/usuaris/llistat';
    }

  }


})();



