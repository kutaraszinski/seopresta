<?php

require_once('../classes/Suggest.php');

$data = json_decode($HTTP_RAW_POST_DATA, true);

if(isset($data) && $data['action'] == "suggest")
{
	$suggest = new Suggest();
	echo $suggest->SuggestByKeyword($data['keyword']);
}