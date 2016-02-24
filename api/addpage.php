<?php
ini_set('display_errors', true);
include('../../config/config.inc.php');

require_once('../classes/Addpage.php');
include('external/Api.php');

$link = mysql_connect('localhost', 'root', 'toto');
mysql_select_db('api_presta', $link);

$data = json_decode($HTTP_RAW_POST_DATA, true);

if(isset($data['action']) && $data['action'] == "update")
{
	$addpage =  new Addpage($link);
	$addpage->updatePage($data);
}
else
{
	$addpage =  new Addpage($link);
	$addpage->filtersPages(json_decode($HTTP_RAW_POST_DATA, true));
	echo $addpage->getPages();
}