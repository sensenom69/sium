(function() {
  'use strict';

  angular
    .module('material-lite')
    .controller('NouUsuari', ['$scope', '$http', '$window', NouUsuari]);

  function NouUsuari($scope, $http, $window) {
    $scope.permis = [];
    var url = "secciones/usuaris/nou.php";
    var nou_usuari = [];
    nou_usuari.instrument = [];
    nou_usuari.agrupacio = [];
    nou_usuari.nom;
    nou_usuari.dni;
    nou_usuari.pass;
    nou_usuari.email;
    nou_usuari.permis = [];
    var usuari_valid = false;

    $scope.addUsuari = function(){
      $scope.nou_usuari.id_instrument = $scope.nou_usuari.instrument.id;
      $scope.nou_usuari.id_agrupacio = $scope.nou_usuari.agrupacio.id;
      $scope.nou_usuari.id_permis = $scope.permis.id;
      $scope.nou_usuari.id = -1;
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



