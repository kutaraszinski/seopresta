
var app = angular.module('categories', []);

function CategoriesController($scope, $http) {

	$scope.label = [];
    $scope.categories = [];
    $scope.tab_index = [];
    $scope.filters = [];
	$scope.label['name'] = "Nom du produit";
	$scope.label['meta_title'] = "Meta title";
	$scope.label['meta_description'] = "Meta description";
	$scope.label['description'] = "Description";
	$scope.label['description_short'] = "Description courte";
	$scope.label['meta_keywords'] = "Meta keywords";
    $scope.type_search = "Contient";
    $scope.name = "";
    $scope.showajax = false;
    $scope.content_double = false;
    $scope.content_short  = false;
    $scope.actif = false;
    $scope.empty = false;
    $scope.nbrresult = 10;
    $scope.page = 0;
    $scope.nbr_page = 0;
    $scope.total_result = 0;
    

    $scope.setNbrResult = function(type) {
    	$scope.nbrresult = type;
    	$scope.loadCategories();
    }

    $scope.changePage = function(type) {
    	$scope.page = type;
    	$scope.loadCategories();
    }

    $scope.setType = function(type) {
    	$scope.type_search = type;
    	$scope.loadCategories();
    }

 	$scope.setActif = function(type) {
    	$scope.actif = type;
    	$scope.loadCategories();
    }

    $scope.setEmpty = function(type) {
    	$scope.empty = type;
    	$scope.loadCategories();
    }

    $scope.setContentDouble = function(label) {
        $scope.content_double = label;
        $scope.loadCategories();
    }

    $scope.setContentShort = function(label) {
        $scope.content_short = label;
        $scope.loadCategories();
    }



    $scope.updateCategory = function(id_category) {
        $scope.showajax = true;
        //console.log($scope.products[id_product].name);
        $scope.current_category = $scope.categories[id_category];
        var httpRequest = $http({
                method: 'POST',
                url: 'api/categories.php',
                data : {action : 'update', id_category : $scope.current_category.id_category, name : $scope.current_category.name, meta_title : $scope.current_category.meta_title, meta_description : $scope.current_category.meta_description, description : $scope.current_category.description, description_short : $scope.current_category.description_short, link_rewrite : $scope.current_category.link_rewrite, meta_keywords : $scope.current_category.meta_keywords}

            }).success(function(data, status) {

                $scope.showajax = false;;

            });


    }


    $scope.loadCategories = function() {

        
     var httpRequest = $http({
                method: 'POST',
                url: 'api/categories.php',
                data : {action : 'filters', page : $scope.page, nbrresult : $scope.nbrresult, type : $scope.type_search, name: $scope.name,  content_double : $scope.content_double, content_short : $scope.content_short , actif : $scope.actif, empty : $scope.empty}

            }).success(function(data, status) {
                //console.log(data);
                $scope.categories = data.categories;
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

    $scope.loadCategories();

}