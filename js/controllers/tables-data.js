(function() {
  'use strict';


  angular
    .module('material-lite')
    //.controller('TablaUsuari', ['$scope', '$http', 'PlaceholderTextService', 'ngTableParams', '$filter','$window','$mdDialog', TablaUsuari]);
    .controller('TablaUsuari', ['$scope', '$http', 'PlaceholderTextService', 'ngTableParams', '$filter','$window', TablaUsuari]);

  function TablaUsuari($scope, $http, PlaceholderTextService, ngTableParams, $filter,$window) {
    /*
    //el modal
    $scope.status = '  ';
    $scope.customFullscreen = false;

    $scope.showConfirm = function(ev,id_usuari) {
      // Appending dialog to document.body to cover sidenav in docs app
      var confirm = $mdDialog.confirm()
            .title('Esta segur de voler borrar?')
            .textContent('Esta acció no es pot desfer!')
            .ariaLabel('Lucky day')
            .targetEvent(ev)
            .ok('SI!')
            .cancel('No per favor!');

      $mdDialog.show(confirm).then(function() {
        delUsuari(id_usuari);

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
    */
    var url = "secciones/usuaris/llistat.php";
    var usuaris = [];
    
    $http.post(url,{})
      .then(function(resposta){
        console.log("res:", resposta.data);
        usuaris = resposta.data;
        $scope.usuaris = usuaris;
        refrescaTabla($scope,$filter, ngTableParams, usuaris);
      });

    function delUsuari(id_usuari){
        $http.post("secciones/usuaris/borrar.php",{id: id_usuari})
        .then(function(resposta){
            $window.location.reload(true);
        });
        
    };

    
    
  }

  
  function refrescaTabla($scope,$filter,ngTableParams, usuaris){
    $scope.tableParams = new ngTableParams({
      page: 1,            // show first page
      count: 10,
      sorting: {
        nom: 'asc'     // initial sorting
      }
    }, {
      filterDelay: 50,
      total: usuaris.length, // length of usuaris
      getData: function ($defer, params) {
        var searchStr = params.filter().search;
        var mydata = [];

        if (searchStr) {

          searchStr = searchStr.toLowerCase();
          mydata = usuaris.filter(function (item) {
            return item.nom.toLowerCase().indexOf(searchStr) > -1 ;
          });

        } else {
          mydata = usuaris;
        }
        mydata = params.sorting() ? $filter('orderBy')(mydata, params.orderBy()) : mydata;
        $defer.resolve(mydata.slice((params.page() - 1) * params.count(), params.page() * params.count()));

        
      }
    });
  }

})();

(function() {
  'use strict';

  angular
    .module('material-lite')
    .controller('TablaAgrupacio', ['$scope', '$http', 'PlaceholderTextService', 'ngTableParams', '$filter', TablaAgrupacio]);

  function TablaAgrupacio($scope, $http, PlaceholderTextService, ngTableParams, $filter) {
    var url = "secciones/agrupacio/llistat.php";
    var agrupacio = [];
    var agraupcio_select = {};
    
    $http.post(url,{})
      .then(function(resposta){
        console.log("res:", resposta.data);
        agrupacio = resposta.data;
        $scope.agrupacio = agrupacio;
        refrescaTabla($scope,$filter, ngTableParams, agrupacio);
      });
    
  }
  
  function refrescaTabla($scope,$filter,ngTableParams, agrupacio){
    $scope.tableParams = new ngTableParams({
      page: 1,            // show first page
      count: 10,
      sorting: {
        nom: 'asc'     // initial sorting
      }
    }, {
      filterDelay: 50,
      total: agrupacio.length, // length of agrupacio
      getData: function ($defer, params) {
        var searchStr = params.filter().search;
        var mydata = [];

        if (searchStr) {

          searchStr = searchStr.toLowerCase();
          mydata = agrupacio.filter(function (item) {
            return item.nom.toLowerCase().indexOf(searchStr) > -1 ;
          });

        } else {
          mydata = agrupacio;
        }
        mydata = params.sorting() ? $filter('orderBy')(mydata, params.orderBy()) : mydata;
        $defer.resolve(mydata.slice((params.page() - 1) * params.count(), params.page() * params.count()));

        
      }
    });
  }

})();

