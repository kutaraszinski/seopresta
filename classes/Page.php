<?php

Class Page
{

	public function __construct($bdd)
	{
		$this->link = $bdd;
	}

	public function getInfos($id_page)
	{
		$sql = 'SELECT * FROM pages p 
				INNER JOIN keyword k ON k.id_page = p.id_page
				WHERE p.id_page ='.$id_page.'';
		$donnees = mysql_query($sql, $this->link);
		$res = mysql_fetch_assoc($donnees);

		$data['main'] = $res;

		return json_encode($data);
	}


	public function addKeywords($id_page, $data)
	{

		$sql = 'UPDATE keywords SET actif = 0 WHERE id_page = '.$id_page.'';
		mysql_query($sql, $this->link);

		foreach($data as $id_keyword)
		{
			$sql = 'UPDATE keywords SET actif = 1 WHERE id ='.$id_keyword.'';
			mysql_query($sql, $this->link);
		}

	}

	public function getKeywords($id_page)
	{
		$sql = 'SELECT * FROM keywords WHERE id_page = '.$id_page.'';
		$donnees = mysql_query($sql, $this->link);
		while($res = mysql_fetch_assoc($donnees))
		{
			$res['keyword'] = utf8_encode($res['keyword']);
			$tab[]  = $res;
		}

		return json_encode($tab);
	}

}