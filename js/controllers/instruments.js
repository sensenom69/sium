(function() {
  'use strict';

  angular
    .module('material-lite')
    .controller('SelectInstrument', ['$scope', '$http', SelectInstrument]);

  function SelectInstrument($scope, $http) {
    var url = "secciones/instrument/llistat.php";
    var instrument = [];
    $scope.instrument = [];
    
    $http.post(url,{})
      .then(function(resposta){
        console.log("res_instrument:", resposta.data);
        instrument = resposta.data;
        $scope.instrument = instrument;
      });

  }



})();



