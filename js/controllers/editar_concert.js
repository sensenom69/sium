(function() {
  'use strict';

  angular
    .module('material-lite')
    .controller('EditarConcert', ['$scope', '$http', '$window', '$location', EditarConcert]);

  function EditarConcert($scope, $http, $window, $location) {
    var tabla = "concert";
    $scope.nou_item = [];
    
    var url = "secciones/"+tabla+"/llistat.php";
    
    $http.post(url,{id: $location.search().id})
      .then(function(resposta){
        console.log("res_editar:", resposta.data);
        $scope.nou_item = resposta.data[0];
        $scope.nou_item.clase = "is-dirty";
      });


    $scope.add = function(){
       var myDate = $scope.nou_item.data;
      myDate=myDate.split("-");
      var newDate=myDate[1]+"/"+myDate[0]+"/"+myDate[2];
      $scope.nou_item.data =myDate[2]+"-"+myDate[1]+"-"+myDate[0]+" "+$scope.nou_item.hora+":"+$scope.nou_item.minuts+":00" ;
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
