
var app = angular.module('images', []);

function ImagesController($scope, $http) {

	$scope.current_image = [];
	$scope.label = [];
	$scope.images = [];
    $scope.categories = [];
    $scope.tab_index = [];
	$scope.showajax = false;
    $scope.type_search = "Contient";
    $scope.name = "";
    $scope.nbrresult = 10;
    $scope.page = 0;
    $scope.nbr_page = 0;
    $scope.total_result = 0;
    

    $scope.setNbrResult = function(type) {
    	$scope.nbrresult = type;
    	$scope.loadImages();
    }

    $scope.changePage = function(type) {
    	$scope.page = type;
    	$scope.loadImages();
    }

   

    $scope.updateImages = function(id_image) {
    	$scope.showajax = true;
    	//console.log($scope.images[id_image].name);
    	$scope.current_image = $scope.images[id_image];
    	var httpRequest = $http({
	            method: 'POST',
	            url: 'api/images.php',
	            data : {action : 'update', id_image : $scope.current_image.id_image, legend : $scope.current_image.legend}

	        }).success(function(data, status) {

	        	$scope.showajax = false;

	        });


    }

    $scope.loadImages = function() {


      	
     var httpRequest = $http({
	            method: 'POST',
	            url: 'api/images.php',
	            data : {page : $scope.page, nbrresult : $scope.nbrresult, type : $scope.type_search, name: $scope.name}

	        }).success(function(data, status) {
	        	//console.log(data);
	            $scope.images = data.images;
	            $scope.filters = data.filters;

	  		$scope.nbr_page = $scope.filters.nbr_page;
	  		$scope.filters.nbr_page = new Array();
			for(var u = 0; u != $scope.nbr_page; u++)
			{
				$scope.filters.nbr_page.push(u);
			}
			index = parseInt($scope.page);
			tab_index = Array();
			z = 0;
			for(var x = $scope.page; x < (index+5); x++)
			{
				if(x < $scope.nbr_page)
				{
					tab_index[x] = x;
					z ++;
				}
			}

			if(z < 10)
			{
				for(var x = $scope.page; x > (index-5); x--)
				{
					if(x >= 0)
					{
						if(!tab_index[x])
						{
							tab_index[x] = x;
							z ++;
						}
					}
				}
			}
			liste_page = "";
			var i = 0;
			$scope.tab_index = new Array();
			for (var key in d = tab_index){
			   //console.log(data[key]);

			   $scope.tab_index[i] = d[key];
			   i++;
			  
			}
			$scope.total_result = data.filters.total_result;

	        });
    };

    $scope.loadImages();
}