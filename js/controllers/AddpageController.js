
var app = angular.module('addpage', []);

function AddpageController($scope, $http) {

	$scope.current_page = [];
	$scope.pages = [];
	$scope.label = [];
	$scope.suggests = [];
	$scope.label['name'] = "Nom du produit";
	$scope.label['category'] = "Catégories";
	$scope.label['product'] = "Produits";
	$scope.label['cms'] = "CMS";
	$scope.label['autres'] = "Autres";
	$scope.type_page = "product";
	$scope.tab_index = [];
	$scope.nbrresult = 10;
    $scope.page = 0;
    $scope.nbr_page = 0;
    $scope.total_result = 0;

    $scope.setTypePage = function(type) {
    	$scope.type_page = type;
    	$scope.loadPages();
    }

    $scope.changePage = function(type) {
    	$scope.page = type;
    	$scope.loadPages();
    }

    $scope.getSuggest = function(id_page) {

    	var keyword = $scope.pages[id_page].info.keyword;

    	var httpRequest = $http({
	            method: 'POST',
	            url: 'api/suggest.php',
	            data : {action : 'suggest', keyword : keyword}

	        }).success(function(data, status) {
	        	
	        	$scope.suggests[id_page] = data[1];
	        	console.log(data)
	        	
	        });


    }

    $scope.setKeyword = function(id_page, suggest)
    {
    	$scope.pages[id_page].info.keyword = suggest;
    }


    $scope.updatePages = function(id_page)
    {
    	$scope.showajax = true;
    	//console.log($scope.products[id_product].name);
    	$scope.current_page = $scope.pages[id_page];
    	var httpRequest = $http({
	            method: 'POST',
	            url: 'api/addpage.php',
	            data : {action : 'update', url : $scope.current_page.url, keyword : $scope.current_page.info.keyword, type : $scope.current_page.type}

	        }).success(function(data, status) {

	        	$scope.showajax = false;

	        });
    }

  	$scope.loadPages = function() {


      	
     var httpRequest = $http({
	            method: 'POST',
	            url: 'api/addpage.php',
	            data : {page : $scope.page, nbrresult : $scope.nbrresult, type_page : $scope.type_page, name: $scope.name}

	        }).success(function(data, status) {
	        	//console.log(data);
	            $scope.pages = data.pages;
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
    $scope.loadPages();

}