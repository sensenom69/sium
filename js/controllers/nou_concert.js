(function() {
  'use strict';

  angular
    .module('material-lite')
    .controller('NouConcert', ['$scope', '$http', '$window', NouConcert]);

  function NouConcert($scope, $http, $window) {
    var tabla = "concert";
    var url = "secciones/"+tabla+"/nou.php";
    var nou_item = [];
    nou_item.obra = [];
    nou_item.data;
    nou_item.lloc;
    nou_item.preu;

    $scope.add = function(){
      var myDate = $scope.nou_item.data;
      myDate=myDate.split("-");
      var newDate=myDate[1]+"/"+myDate[0]+"/"+myDate[2];

      $scope.nou_item.data =myDate[2]+"-"+myDate[1]+"-"+myDate[0]+" "+$scope.nou_item.hora+":"+$scope.nou_item.minuts+":00" ;
      //$scope.nou_item.id_agrupacio = $scope.nou_item.agrupacio.id;
      $scope.nou_item.id = -1;
      $http.post(url,angular.toJson($scope.nou_item))
        .then(function(resposta){
          $window.location.href = "#/"+tabla+"/llistat";
        });
    }

    $scope.cancel = function(){
      $window.location.href = "#/"+tabla+"/llistat";
    }

  }


})();
