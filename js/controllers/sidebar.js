(function() {
  'use strict';

  angular
    .module('material-lite')
    .controller('SidebarController', ['$scope', '$http', SidebarController]);

  function SidebarController($scope, $http) {
    var url = "secciones/usuaris/dades.php";
    $http.post(url,{})
      .then(function(resposta){
        console.log("res:", resposta.data);
        $scope.usuari =  resposta.data;
      });
    
  }
})();
