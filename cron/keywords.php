<?php
include('../classes/Google.php');


$link = mysql_connect('localhost', 'root', 'toto');
mysql_select_db('api_presta', $link);




$sql = 'SELECT p.id_page, ks.keyword, p.url FROM pages p 
		LEFT JOIN keywords ks ON p.id_page = ks.id_page
		WHERE ks.actif = 1';

$gRank = new GoogleKeywordsRank('http://www.dalloz-avocats.fr');
$gRank->setMaxPages(5);
$keywords = array();
$keywords[] = "avocat";
$keywordsPositions = $gRank->getKeywordsArrayRank($keywords);
foreach ($keywordsPositions as $keywords) {
    echo 'For the keyword "' . $keywords[0] . '": ';
    if ($keywords[1] == 0) {
        echo 'you are not in the ' . ($maxPages * 10) . ' first results';
    } else {
        echo 'you are ranked ' . $keywords[1];
    }
}