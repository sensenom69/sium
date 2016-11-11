(function() {
  'use strict';


  angular
    .module('material-lite')
    .controller('TablaUsuari', ['$scope', '$http', 'PlaceholderTextService', 'ngTableParams', '$filter','$window','$mdDialog', TablaUsuari]);
    

  function TablaUsuari($scope, $http, PlaceholderTextService, ngTableParams, $filter,$window,$mdDialog) {
    
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
    .controller('TablaAgrupacio', ['$scope', '$http', 'PlaceholderTextService', 'ngTableParams', '$filter','$window','$mdDialog', TablaAgrupacio]);

  function TablaAgrupacio($scope, $http, PlaceholderTextService, ngTableParams, $filter,$window,$mdDialog) {
    var tabla = "agrupacio";
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
    var url = "secciones/"+tabla+"/llistat.php";
    var item_llistar = [];
    
    $http.post(url,{})
      .then(function(resposta){
        console.log("res:", resposta.data);
        item_llistar = resposta.data;
        $scope.item_llistar = item_llistar;
        refrescaTabla($scope,$filter, ngTableParams, item_llistar);
      });
    
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
      count: 10,
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
            return item.nom.toLowerCase().indexOf(searchStr) > -1 ;
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

(function() {
  'use strict';

  angular
    .module('material-lite')
    .controller('TablaFamilia', ['$scope', '$http', 'PlaceholderTextService', 'ngTableParams', '$filter','$window','$mdDialog', TablaFamilia]);

  function TablaFamilia($scope, $http, PlaceholderTextService, ngTableParams, $filter,$window,$mdDialog) {
    var tabla = "familia";
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
    var url = "secciones/"+tabla+"/llistat.php";
    var item_llistar = [];
    
    $http.post(url,{})
      .then(function(resposta){
        console.log("res_llistar_familia:", resposta.data);
        item_llistar = resposta.data;
        $scope.item_llistar = item_llistar;
        refrescaTabla($scope,$filter, ngTableParams, item_llistar);
      });
    
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
      count: 10,
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
            return item.nom.toLowerCase().indexOf(searchStr) > -1 ;
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


(function() {
  'use strict';

  angular
    .module('material-lite')
    .controller('TablaInstrument', ['$scope', '$http', 'PlaceholderTextService', 'ngTableParams', '$filter','$window','$mdDialog', TablaInstrument]);

  function TablaInstrument($scope, $http, PlaceholderTextService, ngTableParams, $filter,$window,$mdDialog) {
    var tabla = "instrument";
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
    var url = "secciones/"+tabla+"/llistat.php";
    var item_llistar = [];
    
    $http.post(url,{})
      .then(function(resposta){
        console.log("res_llistar_instruments:", resposta.data);
        item_llistar = resposta.data;
        $scope.item_llistar = item_llistar;
        refrescaTabla($scope,$filter, ngTableParams, item_llistar);
      });
    
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
      count: 10,
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
            return item.nom.toLowerCase().indexOf(searchStr) > -1 ;
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


(function() {
  'use strict';

  angular
    .module('material-lite')
    .controller('TablaObra', ['$scope', '$http', 'PlaceholderTextService', 'ngTableParams', '$filter','$window','$mdDialog', TablaObra]);

  function TablaObra($scope, $http, PlaceholderTextService, ngTableParams, $filter,$window,$mdDialog) {
    var tabla = "obra";
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
    var url = "secciones/"+tabla+"/llistat.php";
    var item_llistar = [];
    
    $http.post(url,{})
      .then(function(resposta){
        console.log("res_llistar_obres:", resposta.data);
        item_llistar = resposta.data;
        $scope.item_llistar = item_llistar;
        refrescaTabla($scope,$filter, ngTableParams, item_llistar);
      });
    
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
      count: 10,
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

})();

(function() {
  'use strict';

  angular
    .module('material-lite')
    .controller('TablaConcert', ['$scope', '$http', 'PlaceholderTextService', 'ngTableParams', '$filter','$window','$mdDialog', TablaConcert]);

  function TablaConcert($scope, $http, PlaceholderTextService, ngTableParams, $filter,$window,$mdDialog) {
    var tabla = "concert";
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
    var url = "secciones/"+tabla+"/llistat.php";
    var item_llistar = [];
    
    $http.post(url,{})
      .then(function(resposta){
        console.log("res_llistar_concert:", resposta.data);
        item_llistar = resposta.data;
        $scope.item_llistar = item_llistar;
        refrescaTabla($scope,$filter, ngTableParams, item_llistar);
      });
    
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
      count: 10,
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
            return item.lloc.toLowerCase().indexOf(searchStr) > -1 ;
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

(function() {
  'use strict';

  angular
    .module('material-lite')
    .controller('TablaComunicacio', ['$scope', '$http', 'PlaceholderTextService', 'ngTableParams', '$filter','$window','$mdDialog', TablaComunicacio]);

  function TablaComunicacio($scope, $http, PlaceholderTextService, ngTableParams, $filter,$window,$mdDialog) {
    var tabla = "comunicacio";
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
    var url = "secciones/"+tabla+"/llistat.php";
    var item_llistar = [];
    
    $http.post(url,{})
      .then(function(resposta){
        console.log("res_llistar_concert:", resposta.data);
        item_llistar = resposta.data;
        $scope.item_llistar = item_llistar;
        refrescaTabla($scope,$filter, ngTableParams, item_llistar);
      });
    
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
      count: 10,
      sorting: {
        id: 'asc'     // initial sorting
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
            return item.assumpte.toLowerCase().indexOf(searchStr) > -1 ;
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