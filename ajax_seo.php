<?php
include('../config/config.inc.php');
require_once('seo.class.php');

if(isset($_POST['action']))
{
	$seo =  new SEO();
	$seo->updateProduct($_POST);
}
elseif(isset($_POST['updateCategory']))
{
	$seo =  new SEO();
	$seo->updateCategory($_POST);
}
else
{
	$seo =  new SEO();
	$seo->filtersProducts($_GET);
	echo $seo->getProducts();
}