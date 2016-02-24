
var app = angular.module('products', []);

function ProductsController($scope, $http) {

	$scope.current_product = [];
	$scope.label = [];
	$scope.products = [];
    $scope.categories = [];
    $scope.tab_index = [];
	$scope.label['name'] = "Nom du produit";
	$scope.label['meta_title'] = "Meta title";
	$scope.label['meta_description'] = "Meta description";
	$scope.label['description'] = "Description";
	$scope.label['description_short'] = "Description courte";
	$scope.label['meta_keywords'] = "Meta keywords";
	$scope.showajax = false;
    $scope.type_search = "Contient";
    $scope.name = "";
    $scope.label_category = false;
    $scope.id_category = false;
    $scope.content_double = false;
    $scope.content_short  = false;
    $scope.actif = false;
    $scope.empty = false;
    $scope.images = false;
    $scope.nbrresult = 10;
    $scope.page = 0;
    $scope.nbr_page = 0;
    $scope.total_result = 0;
    

    $scope.setNbrResult = function(type) {
    	$scope.nbrresult = type;
    	$scope.loadProducts();
    }

    $scope.changePage = function(type) {
    	$scope.page = type;
    	$scope.loadProducts();
    }

    $scope.setType = function(type) {
    	$scope.type_search = type;
    	$scope.loadProducts();
    }

 	$scope.setActif = function(type) {
    	$scope.actif = type;
    	$scope.loadProducts();
    }

    $scope.setEmpty = function(type) {
    	$scope.empty = type;
    	$scope.loadProducts();
    }

    $scope.setImages = function(type) {
    	$scope.images = type;
    	$scope.loadProducts();
    }

    $scope.choiceCategory = function(id_category) {

    	if(!id_category)
    	{
    		$scope.label_category = false;
    		$scope.id_category = false;
    	}	
    	else
    	{
	    	$scope.label_category = $scope.categories[id_category].name;
	    	$scope.id_category = id_category;
    	}
    	$scope.loadProducts();

    }

    $scope.setContentDouble = function(label) {
    	$scope.content_double = label;
    	$scope.loadProducts();
    }

    $scope.setContentShort = function(label) {
    	$scope.content_short = label;
    	$scope.loadProducts();
    }

    $scope.loadCategories = function() {
    	var httpRequest = $http({
	            method: 'POST',
	            url: 'api/categories.php'

	        }).success(function(data, status) {

	        	$scope.categories = data;
	        	//console.log(data);

	        });
    }

    $scope.updateProduct = function(id_product) {
    	$scope.showajax = true;
    	//console.log($scope.products[id_product].name);
    	$scope.current_product = $scope.products[id_product];
    	var httpRequest = $http({
	            method: 'POST',
	            url: 'api/products.php',
	            data : {action : 'update', id_product : $scope.current_product.id_product, name : $scope.current_product.name, meta_title : $scope.current_product.meta_title, meta_description : $scope.current_product.meta_description, description : $scope.current_product.description, description_short : $scope.current_product.description_short, link_rewrite : $scope.current_product.link_rewrite, meta_keywords : $scope.current_product.meta_keywords}

	        }).success(function(data, status) {

	        	$scope.showajax = false;

	        });


    }

    $scope.loadProducts = function() {


      	
     var httpRequest = $http({
	            method: 'POST',
	            url: 'api/products.php',
	            data : {page : $scope.page, nbrresult : $scope.nbrresult, type : $scope.type_search, name: $scope.name, id_category : $scope.id_category,  content_double : $scope.content_double, content_short : $scope.content_short , actif : $scope.actif, empty : $scope.empty,  images : $scope.images}

	        }).success(function(data, status) {
	        	//console.log(data);
	            $scope.products = data.products;
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

    $scope.loadProducts();
    $scope.loadCategories();
}