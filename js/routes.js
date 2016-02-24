// Empty JS for your own code to be here

/**** Frame src ***/ 

// js/script.js
'use strict';


/**
 * Déclaration de l'application routeApp
 */
var routeApp = angular.module('routeApp', [
    // Dépendances du "module"
    'ngRoute',
    'routeAppControllers'
]);


routeApp.directive('script', function() {
    return {
      restrict: 'E',
      scope: false,
      link: function(scope, elem, attr) {
        if (attr.type === 'text/javascript-lazy') {
          var code = elem.text();
          var f = new Function(code);
          f();
        }
      }
    };
  });


var routeAppControllers = angular.module('routeAppControllers', []);

routeApp.config(['$routeProvider',
    function($routeProvider) { 
        
        // Système de routage
        $routeProvider
        .when('/home', {
            templateUrl: 'includes/home.html',
            controller: 'homeCtrl'
        })
        .when('/products', {
            templateUrl: 'includes/products.html',
            controller: 'productsCtrl'
        })
        .when('/categories', {
            templateUrl: 'includes/categories.html',
            controller: 'CategoriesCtrl'
        })
        .when('/images', {
            templateUrl: 'includes/images.html',
            controller: 'ImagesCtrl'
        })
        .when('/addpage', {
            templateUrl: 'includes/add_page.html',
            controller: 'AddpageCtrl'
        })
        .when('/page/:id_page', {
            templateUrl: 'includes/page.html',
            controller: 'PageCtrl'
        })
        .otherwise({
            redirectTo: '/home'
        });
    }
]);


routeAppControllers.controller('homeCtrl', ['$scope', '$location', '$http',
    function($scope,$location, $http){

    }
]);

routeAppControllers.controller('AddpageCtrl', ['$scope', '$location', '$http',
    function($scope,$location, $http){

    }
]);

routeAppControllers.controller('productsCtrl', ['$scope', '$location', '$http',
    function($scope,$location, $http){

    }
]);

routeAppControllers.controller('CategoriesCtrl', ['$scope', '$location', '$http',
    function($scope,$location, $http){

    }
]);

routeAppControllers.controller('ImagesCtrl', ['$scope', '$location', '$http',
    function($scope,$location, $http){

    }
]);

routeAppControllers.controller('PageCtrl', ['$scope', '$location', '$http', '$routeParams',
    function($scope,$location, $http, $routeParams){
        $scope.id_page = $routeParams.id_page;
    }
]);