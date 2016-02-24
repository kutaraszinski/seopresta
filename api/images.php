<?php
include('../../config/config.inc.php');

require_once('../classes/Images.php');

$data = json_decode($HTTP_RAW_POST_DATA, true);

if(isset($data['action']) && $data['action'] == "update")
{
	$images =  new Images();
	$images->updateImage($data);
}
else
{
	$images =  new Images();
	$images->filtersImages(json_decode($HTTP_RAW_POST_DATA, true));
	echo $images->getImages();
}