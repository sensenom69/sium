(function() {
  'use strict';

  angular
    .module('material-lite')
    .controller('EditarParticheles', ['$scope', '$http', '$window', '$location','PlaceholderTextService', 'ngTableParams', '$filter','$mdDialog', EditarParticheles]);

  function EditarParticheles($scope, $http, $window, $location, PlaceholderTextService, ngTableParams, $filter,$mdDialog) {
    var id_obra = $location.search().id;
    
    $http.post("secciones/obra/llistat.php",{id: id_obra})
      .then(function(resposta){
        console.log("res_editar:", resposta.data);
        $scope.obra = resposta.data[0]; 
      });
      var url = "secciones/particella/llistat.php";
    var item_llistar = [];
    
    $http.post(url,{id_obra: id_obra})
      .then(function(resposta){
        console.log("res_llistar_particheles:", resposta.data);
        item_llistar = resposta.data;
        $scope.item_llistar = item_llistar;
        refrescaTabla($scope,$filter, ngTableParams, item_llistar);
      });

    var tabla= "particella";
    $scope.nou_item = [];
    
    var url = "secciones/"+tabla+"/llistat.php";


    $scope.add = function(){
      var url = "secciones/"+tabla+"/nou.php";
      $scope.nou_item.id_instrument = $scope.nou_item.instrument.id;
      $http.post(url,angular.toJson($scope.nou_item))
        .then(function(resposta){
          $window.location.href = "#/obra/editar_particheles?id="+id_obra;
        });
    }

    $scope.cancel = function(){
      $window.location.href = "#/obra/editar?id="+id_obra;
    }

    $scope.pujarParticella = function(){
      $window.location.href = "particella.php";
    }

    $scope.editarParticella = function(id_particella){
      $window.location.href = "particella.php?id_particella="+id_particella;
    }


    //particheles
    var tabla = "particella";
    //el modal
    $scope.status = '  ';
    $scope.customFullscreen = false;

    $scope.showConfirm = function(ev,identificador) {
      // Appending dialog to document.body to cover sidenav in docs app
      var confirm = $mdDialog.confirm()
            .title('Esta segur de voler borrar?')
            .textContent('Esta acció no es pot desfer!')
            .ariaLabel('Lucky day')
            .targetEvent(ev)
            .ok('SI!')
            .cancel('No per favor!');

      $mdDialog.show(confirm).then(function() {
        del(identificador);

      }, function() {
        
      });
    };
  
    function DialogController($scope, $mdDialog) {
      $scope.hide = function() {
        $mdDialog.hide();
      };

      $scope.cancel = function() {
        $mdDialog.cancel();
      };

      $scope.answer = function(answer) {
        $mdDialog.hide(answer);
      };
    }
    //fins aci el modal

    
     function del(identificador){
        $http.post("secciones/"+tabla+"/borrar.php",{id: identificador})
        .then(function(resposta){
            $window.location.reload(true);
        });
        
    };
  }

  function refrescaTabla($scope,$filter,ngTableParams, item_llistar){
    $scope.tableParams = new ngTableParams({
      page: 1,            // show first page
      count: 100,
      sorting: {
        nom: 'asc'     // initial sorting
      }
    }, {
      filterDelay: 50,
      total: item_llistar.length, // length of agrupacio
      getData: function ($defer, params) {
        var searchStr = params.filter().search;
        var mydata = [];

        if (searchStr) {

          searchStr = searchStr.toLowerCase();
          mydata = item_llistar.filter(function (item) {
            return item.nom.toLowerCase().indexOf(searchStr) > -1 || item.instrument.toLowerCase().indexOf(searchStr) > -1;
          });

        } else {
          mydata = item_llistar;
        }
        mydata = params.sorting() ? $filter('orderBy')(mydata, params.orderBy()) : mydata;
        $defer.resolve(mydata.slice((params.page() - 1) * params.count(), params.page() * params.count()));
        
      }
    });
  }

})();


