(function() {
  'use strict';

  angular
    .module('material-lite')
    .controller('EditarComunicacio', ['$scope', '$http', '$window', '$location', EditarComunicacio]);

  function EditarComunicacio($scope, $http, $window, $location) {
    var tabla= "comunicacio";
    $scope.nou_item = [];
    
    var url = "secciones/"+tabla+"/llistat.php";
   //var nou_usuari = [];
    
    $http.post(url,{id: $location.search().id})
      .then(function(resposta){
        console.log("res_editar_comunicacio:", resposta.data);
        $scope.nou_item = resposta.data[0];
        $scope.nou_item.clase = "is-dirty";
        
      });


    $scope.add = function(){
      var url = "secciones/"+tabla+"/nou.php";
      $http.post(url,angular.toJson($scope.nou_item))
        .then(function(resposta){
          $window.location.href = "#/"+tabla+"/llistat";
        });
    }

    $scope.cance = function(){
      $window.location.href = "#/"+tabla+"/llistat";
    }

  }


})();


(function() {
  'use strict';

  angular
    .module('material-lite')
    .controller('EditarTextEditorController', ['$scope', TextEditor]);

  function TextEditor($scope) {
    //$scope.text1 = '<h1>Lorem ipsum</h1><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe maxime similique, ab voluptate dolorem incidunt, totam dolores illum eum ad quas odit. Magnam rerum doloribus vitae magni quasi molestias repellat.</p><ul><li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus tempora explicabo fugit unde maxime alias.</li><li>Numquam, nihil. Fugiat aspernatur suscipit voluptatum dolorum nisi numquam, fugit at, saepe alias assumenda autem.</li><li>Iste dolore sed placeat aperiam alias modi repellat dolorem, temporibus odio adipisci obcaecati, est facere!</li><li>Quas totam itaque voluptatibus dolore ea reprehenderit ut quibusdam, odit beatae aliquam, deleniti unde tempora!</li><li>Rerum quis soluta, necessitatibus. Maxime repudiandae minus at eum, dicta deserunt dignissimos laborum doloribus. Vel.</li></ul><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis enim illum, iure cumque amet. Eos quisquam, nemo voluptates. Minima facilis, recusandae atque ullam illum quae iure impedit nihil dolorum hic?</p>';
    //$scope.text1 = $parent.nou_item.comunicacio;
  }

})();

