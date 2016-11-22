(function() {
  'use strict';

  angular
    .module('material-lite')
    .controller('SelectPermis', ['$scope', '$http', SelectPermis]);

  function SelectPermis($scope, $http) {
    $scope.items = [{"id":"1", "nom" : "Super"},{"id":"2", "nom" : "Admin"},{"id":"3", "nom" : "Biblio"},{"id":"4", "nom" : "Usuari"}];
    console.log("res_permis"+$scope.items);
    $scope.$parent.permis = $scope.items[3];
  }

})();
