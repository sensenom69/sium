(function() {
  'use strict';

  angular
    .module('material-lite')
    .controller('BorrarUsuari', ['$scope', '$http', '$window', '$location', BorrarUsuari]);

  function BorrarUsuari($scope, $http, $window, $location) {

    

    $scope.delUsuari = function(id_usuari){
      alert(id_usuari);
      var url = "secciones/usuaris/borrar.php";
/*
      $http.post(url,id:id_usuari);
        .then(function(resposta){
          $window.location.href = '#/usuaris/llistat';
        });
        */
    }

  }


})();


