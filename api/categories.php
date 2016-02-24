<?php
include('../../config/config.inc.php');

require_once('../classes/Categories.php');

if($data = json_decode($HTTP_RAW_POST_DATA, true))
{
	if(isset($data['action']) && $data['action'] == "filters")
	{
		$categories =  new Categories();
		$categories->filtersCategory($data);
		echo $categories->getCategoriesByFilters();
	}
	elseif(isset($data['action']) && $data['action'] == "update")
	{
		$categories =  new Categories();
		$categories->updateCategory($data);
	}
}
else
{
	$categories =  new Categories();
	echo $categories->getCategories();
}