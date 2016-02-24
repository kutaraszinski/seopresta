<?php

Class Suggest
{


	public function SuggestByKeyword($keyword)
	{

		$keyword = urlencode($keyword);
		$data = file_get_contents('http://suggestqueries.google.com/complete/search?output=firefox&hl=fr&q='.$keyword);

		return utf8_encode($data);
		

	}

}