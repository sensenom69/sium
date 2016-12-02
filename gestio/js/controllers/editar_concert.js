(function() {
  'use strict';

  angular
    .module('material-lite')
    .controller('EditarConcert',  ['$scope', '$http', 'PlaceholderTextService', 'ngTableParams', '$filter','$window','$mdDialog', '$location', EditarConcert]);

  function EditarConcert($scope, $http, PlaceholderTextService, ngTableParams, $filter,$window,$mdDialog, $location) {
    //gestio dobres
    $scope.selected = [];
    $scope.checks = {};
    $scope.obres = [];

    var url = "secciones/obra/llistat.php";
    var item_llistar = [];
    
    $http.post(url,{})
      .then(function(resposta){
        console.log("res_llistar_obres:", resposta.data);
        item_llistar = resposta.data;
        $scope.item_llistar = item_llistar;
       refrescaTabla($scope,$filter, ngTableParams, item_llistar, $scope.selected);
      });
    //fi de gestio dobres


    var tabla = "concert";
    $scope.nou_item = [];
    
    var url = "secciones/"+tabla+"/llistat.php";
    
    $http.post(url,{id: $location.search().id})
      .then(function(resposta){
        console.log("res_editar:", resposta.data);
        $scope.nou_item = resposta.data[0];
        $scope.nou_item.clase = "is-dirty";
        $scope.id_obres = resposta.data[1]['obres'];
        for(var i=0; i< $scope.id_obres.length; i++){
          $scope.apunta($scope.id_obres[i].id_obra);
          $scope.checks[$scope.id_obres[i].id_obra] = true;
        }
      });


    $scope.add = function(){
      $scope.nou_item.obra = $scope.obres;
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

    $scope.apunta = function (id) {
        var posicion = $scope.selected.indexOf(id);
        if(posicion>=0){
          $scope.selected.splice(posicion,1);
          posicion = tornaPosObra($scope.obres, id);
          $scope.obres.splice(posicion,1);
          $scope.checks[id]=false;
        }
        else{
          $scope.selected.push(id);
          $scope.obres.push($scope.item_llistar[tornaPosObra($scope.item_llistar, id)]);
        }

    }; 

    $scope.showModal = function(ev) {
        $mdDialog.show({
          controller: DialogController($scope,$mdDialog),
          contentElement: '#myDialog',
          parent: angular.element(document.body),
          targetEvent: ev,
          clickOutsideToClose: true
        });
    };

    $scope.pujarArxiu = function(){
      $window.location.href = "concert.php";
    }


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

  }

  function marcaCanviPagina($scope){
        for(var i=0; i<$scope.selected; i++){
          $scope.checks[$scope.selected[i]] = true;
        }
  }

  function refrescaTabla($scope,$filter,ngTableParams, item_llistar, selected){
    $scope.tableParams = new ngTableParams({
      page: 1,            // show first page
      count: 10,
      sorting: {
        nom: 'asc'     // initial sorting
      }
    }, {
      filterDelay: 50,
      total: item_llistar.length, // length of agrupacio
      getData: function ($defer, params) {
        marcaCanviPagina($scope);
        console.log("el selected: ", selected);
        var searchStr = params.filter().search;
        var mydata = [];

        if (searchStr) {
          searchStr = searchStr.toLowerCase();
          mydata = item_llistar.filter(function (item) {
            return item.nom.toLowerCase().indexOf(searchStr) > -1 || item.compositor.toLowerCase().indexOf(searchStr) > -1 || item.etiquetes.toLowerCase().indexOf(searchStr) > -1 || item.agrupacio.toLowerCase().indexOf(searchStr) > -1 ;
          });

        } else {
          mydata = item_llistar;
        }
        mydata = params.sorting() ? $filter('orderBy')(mydata, params.orderBy()) : mydata;
        $defer.resolve(mydata.slice((params.page() - 1) * params.count(), params.page() * params.count()));
        
      }
    });
  }

  function tornaPosObra(llistat, id){
    for(var i=0; i<llistat.length; i++){
          if(llistat[i].id==id)
            return i;
        }
        return 0;
  }

  


})();
