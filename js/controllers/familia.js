(function() {
  'use strict';

  angular
    .module('material-lite')
    .controller('SelectFamilia', ['$scope', '$http', SelectFamilia]);

  function SelectFamilia($scope, $http) {
    var url = "secciones/familia/llistat.php";
    var familia = [];
    $scope.familia_select = [];
    
    $http.post(url,{})
      .then(function(resposta){
        console.log("res_familia:", resposta.data);
        familia = resposta.data;
        $scope.familia = familia;
        alert( resposta.data);
      });

  }

})();