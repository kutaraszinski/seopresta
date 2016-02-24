<?php

require_once('../classes/Page.php');


$link = mysql_connect('localhost', 'root', 'toto');
mysql_select_db('api_presta', $link);


$data = json_decode($HTTP_RAW_POST_DATA, true);
if(isset($data['action']) && $data['action'] == "info")
{
	$page = new Page($link);
	echo $page->getInfos($data['id_page']);
}
elseif(isset($data['action']) && $data['action'] == "viewkeywords")
{
	$page = new Page($link);
	echo $page->getKeywords($data['id_page']);
}
elseif(isset($data['action']) && $data['action'] == "addkeywords")
{
	$page = new Page($link);
	$page->addKeywords($data['id_page'], $data['data']);
	
}

