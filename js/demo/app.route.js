(function() {
  'use strict';

  // routes
  angular
    .module('material-lite')
    .config(['$routeProvider', routeProvider])
    .run(['$route', routeRunner]);

  function routeProvider($routeProvider) {

    $routeProvider.when('/', {
      //templateUrl: 'plantillas/dashboard.php'
      templateUrl: 'plantillas/usuaris/llistat.html'

    }).when('/:folder/:tpl', {
        templateUrl: function(attr){
          return 'plantillas/' + attr.folder + '/' + attr.tpl + '.html';
        }
    }).when('/:folder/:tpl/:id', {
      templateUrl: function(attr){
        return 'plantillas/' + attr.folder + '/' + attr.tpl + '.html';
      }

    }).when('/:tpl', {
      templateUrl: function(attr){
        return 'plantillas/' + attr.tpl + '.php';
      }

    }).otherwise({ redirectTo: '/' });
  }

  function routeRunner($route) {
    // $route.reload();
  }

})();
