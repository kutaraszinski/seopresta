<?php
include('Synchronise.php');

$link_main = mysql_connect('localhost', 'root', 'toto');
mysql_select_db('seopresta', $link_main);

$sql = 'SELECT * FROM customers WHERE actif = 1';

$donnees = mysql_query($sql);
while($res = mysql_fetch_assoc($donnees))
{
	$synchro = new Synchronise($res['url'], $res['key'], $res['code_site']);
	// $synchro->getImages();
	// exit;
	$synchro->getProducts();
	// $synchro->getCategories();
}


