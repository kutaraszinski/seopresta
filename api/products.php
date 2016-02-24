<?php
include('../../config/config.inc.php');

require_once('../classes/Products.php');

$data = json_decode($HTTP_RAW_POST_DATA, true);

if(isset($data['action']) && $data['action'] == "update")
{
	$products =  new Products();
	$products->updateProduct($data);
}
else
{
	$products =  new Products();
	$products->filtersProducts(json_decode($HTTP_RAW_POST_DATA, true));
	echo $products->getProducts();
}