(function() {
  'use strict';

  angular
    .module('material-lite')
    .controller('SelectAgrupacio', ['$scope', '$http', SelectAgrupacio]);

  function SelectAgrupacio($scope, $http) {
    var url = "secciones/agrupacio/llistat.php";
    var agrupacio = [];
    $scope.agrupacio_select = [];
    
    $http.post(url,{})
      .then(function(resposta){
        console.log("res_agrupacio:", resposta.data);
        agrupacio = resposta.data;
        $scope.agrupacio = agrupacio;
      });

  }

})();