(function() {
  'use strict';

  angular
    .module('material-lite')
    .controller('NouComunicacio', ['$scope', '$http', '$window', NouComunicacio]);

  function NouComunicacio($scope, $http, $window) {
    $scope.receptors = {};
    $scope.receptors["agrupacio"] = {};//agrupacio
    $scope.receptors["familia"] = {};//familia
    $scope.receptors["instrument"] = {};//instrument
    var tabla = "comunicacio";
    var url = "secciones/"+tabla+"/nou.php";
    var nou_item = [];
    nou_item.assumpte;
    nou_item.comunicacio;
    //traure agrupacions
    var item_llistar = [];
    
    $http.post("secciones/agrupacio/llistat.php",{})
      .then(function(resposta){
        console.log("res:", resposta.data);
        item_llistar = resposta.data;
        $scope.item_llistar_agrupacio = item_llistar;
        //refrescaTabla($scope,$filter, ngTableParams, item_llistar);
      });

    $http.post("secciones/familia/llistat.php",{})
      .then(function(resposta){
        console.log("res:", resposta.data);
        item_llistar = resposta.data;
        $scope.item_llistar_familia = item_llistar;
        //refrescaTabla($scope,$filter, ngTableParams, item_llistar);
      });

     $http.post("secciones/instrument/llistat.php",{})
      .then(function(resposta){
        console.log("res:", resposta.data);
        item_llistar = resposta.data;
        $scope.item_llistar_instrument = item_llistar;
        //refrescaTabla($scope,$filter, ngTableParams, item_llistar);
      });

    $scope.add = function(){
      $scope.nou_item.id = -1;
      $scope.nou_item.receptors = $scope.receptors;
      $http.post(url,angular.toJson($scope.nou_item))
        .then(function(resposta){
          $window.location.href = "#/"+tabla+"/llistat";
        });
    }

    $scope.cancel = function(){
      $window.location.href = "#/"+tabla+"/llistat";
    }

    $scope.apunta = function (opcio, id) {
      console.log("el json: "+angular.toJson($scope.receptors));
      console.log("en el apunta agrupacio: "+$scope.receptors[0]+"  familia: "+$scope.receptors[1]+" instrument: "+$scope.receptors[2]);
    }; 

  }


})();


(function() {
  'use strict';

  angular
    .module('material-lite')
    .controller('TextEditorController', ['$scope', TextEditor]);

  function TextEditor($scope) {
    $scope.text1 = '<h1>Lorem ipsum</h1><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe maxime similique, ab voluptate dolorem incidunt, totam dolores illum eum ad quas odit. Magnam rerum doloribus vitae magni quasi molestias repellat.</p><ul><li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus tempora explicabo fugit unde maxime alias.</li><li>Numquam, nihil. Fugiat aspernatur suscipit voluptatum dolorum nisi numquam, fugit at, saepe alias assumenda autem.</li><li>Iste dolore sed placeat aperiam alias modi repellat dolorem, temporibus odio adipisci obcaecati, est facere!</li><li>Quas totam itaque voluptatibus dolore ea reprehenderit ut quibusdam, odit beatae aliquam, deleniti unde tempora!</li><li>Rerum quis soluta, necessitatibus. Maxime repudiandae minus at eum, dicta deserunt dignissimos laborum doloribus. Vel.</li></ul><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis enim illum, iure cumque amet. Eos quisquam, nemo voluptates. Minima facilis, recusandae atque ullam illum quae iure impedit nihil dolorum hic?</p>';
  }

})();


