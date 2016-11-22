(function() {
  'use strict';

  angular
    .module('material-lite')
    .controller('SelectParticella', ['$scope', '$http', SelectParticella]);

  function SelectParticella($scope, $http, id_obra) {
    var url = "secciones/particella/llistat.php";
    var particella = [];
    $scope.particella = [];
    
    $http.post(url,{id_obra: id_obra})
      .then(function(resposta){
        console.log("res_particella:", resposta.data);
        particella = resposta.data;
        $scope.particella = particella;
      });

  }
})();



