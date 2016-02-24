
var app = angular.module('page', []);

function PageController($scope, $http) {

	$scope.infos = [];

	$scope.showchoicekeywords = false;
	$scope.keywords_secondaire = [];
	$scope.keywords = [];

	$scope.select = function(event) {
            if($(event.target).hasClass('active'))
                $(event.target).removeClass('active');
            else
                $(event.target).addClass('active');
    }

    $scope.down = function(event) {

            $('.encart_suggestion .well .active').each(function() {

                var keyword = $(this).data('keyword');
                var id = $(this).data('id');
                var obj = new Array();
                obj['keyword'] = keyword;
                obj['id'] = id;

                $scope.keywords_secondaire.push(obj);
                
                for(var data in  $scope.keywords)
                {
                      if(id ==  $scope.keywords[data]['id'])
                        $scope.keywords.splice(data, 1);
                }


            });

        }

        $scope.savekeywordSecondaire = function() 
        {
        	var i = 0 ;
        	var data = [];
        	for(keyword in $scope.keywords_secondaire)
        	{
        		data[i] = $scope.keywords_secondaire[keyword]['id'];
        		i++;
        	}

        	var httpRequest = $http({
	            method: 'POST',
	            url: 'api/page.php',
	            data : {action : 'addkeywords', id_page : $scope.id_page, data : data}

	        }).success(function(data, status) {	
	        	$scope.infos = data;
	        });
        }

        $scope.up = function(event)
        {
            $('.keywords_content.well .active').each(function() {

                var obj = new Array();
                var keyword = $(this).data('keyword');
                var id = $(this).data('id');
                obj['keyword'] = keyword;
                obj['id'] = id;
                $scope.keywords.push(obj);

               for(var data in  $scope.keywords_secondaire)
               {
                      if(id ==  $scope.keywords_secondaire[data]['id'])
                        $scope.keywords_secondaire.splice(data, 1);
               }
            });
        }


	$scope.init = function() {


		var httpRequest = $http({
	            method: 'POST',
	            url: 'api/page.php',
	            data : {action : 'info', id_page : $scope.id_page}

	        }).success(function(data, status) {
	        	
	        	$scope.infos = data;

	        });

	    var httpRequest = $http({
	            method: 'POST',
	            url: 'api/page.php',
	            data : {action : 'viewkeywords', id_page : $scope.id_page}

	        }).success(function(data, status) {
	        	$scope.keywords = data;
	        	for(id_key in $scope.keywords)
	        	{
	        		if($scope.keywords[id_key]['actif'] == 1)
	        		{

	        			var obj = new Array();
		                var keyword = $scope.keywords[id_key]['keyword'];
		                var id = $scope.keywords[id_key]['id']
		                obj['keyword'] = keyword;
		                obj['id'] = id;

	        			$scope.keywords_secondaire.push(obj);
	        		}
	        	}
	        	console.log($scope.keywords_secondaire);
	        });
	}


	$scope.addkeywords = function() {

			$scope.showchoicekeywords = true;
	}
	$scope.init();
}