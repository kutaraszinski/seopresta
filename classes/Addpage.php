<?php

ini_set('display_errors', true);
Class Addpage {


	public function __construct($bdd)
	{
		$this->link = $bdd;
	}


	public function updatePage($params)
	{

		$sql = 'SELECT * FROM pages WHERE url = "'.$params['url'].'"';
		$donnees = mysql_query($sql, $this->link);
		$res = mysql_fetch_assoc($donnees);
		if($res)
		{

			$sql = 'UPDATE keyword SET keyword = "'.$params['keyword'].'" WHERE id_page = "'.$res['id_page'].'"';
			mysql_query($sql, $this->link);

			$sql = "DELETE FROM keywords WHERE id_page =".$res['id_page']."";
			mysql_query($sql, $this->link);



			$api = new API();

			$data['keyword'] = $params['keyword'];
			$data['findStats'] = 0;
			$id_tool = 15;

			$results = $api->getResults($id_tool, $data);


			$tab = json_decode($results, true);

			$keywords = $tab['ResultSet']['output']['keywordRearchList']['keywordEntry'];
			
			foreach($keywords as $values)
			{
				$sql = 'INSERT INTO keywords (id_page, keyword) VALUES("'.$res['id_page'].'","'.utf8_decode($values['keyword']).'")';
				mysql_query($sql, $this->link);
			}
		}
		else
		{

			$sql = 'INSERT INTO pages (type_page, url) VALUES("'.$params['type'].'","'.$params['url'].'")';
			mysql_query($sql, $this->link);
			$id_page = mysql_insert_id();

			$sql = 'INSERT INTO keyword (id_page, keyword) VALUES("'.$id_page.'","'.$params['keyword'].'")';
			mysql_query($sql, $this->link);


			$sql = "DELETE FROM keywords WHERE id_page =".$id_page."";
			mysql_query($sql, $this->link);

			$api = new API();

			$data['keyword'] = $params['keyword'];
			$data['findStats'] = 0;
			$id_tool = 15;

			$results = $api->getResults($id_tool, $data);


			$tab = json_decode($results, true);

			$keywords = $tab['ResultSet']['output']['keywordRearchList']['keywordEntry'];
			
			foreach($keywords as $values)
			{
				$sql = 'INSERT INTO keywords (id_page, keyword) VALUES("'.$id_page.'","'.utf8_decode($values['keyword']).'")';
				mysql_query($sql, $this->link);
			}


		}

	}

	public function getPages()
	{

		$data['pages'] = $this->results;
		$data['filters'] = $this->filters;

		return json_encode($data);
	}


	public function filtersPages($params)
	{

		$nbrresult = $params['nbrresult'];
		$where = '';
		$inner_join = '';
		foreach($params as $key => $val)
		{
			if(!$val)
				continue;

				if($key == "type_page")
				{
					$type_page = $val;
				}

				if($key == "name")
				{

					switch($params['type'])
					{
						case 'Contient':
							$where .= ' AND pl.name LIKE "%'.$val.'%" ';
						break;

						case 'Commence':
							$where .= ' AND pl.name LIKE "'.$val.'%" ';
						break;

						case 'Termine':
							$where .= ' AND pl.name LIKE "%'.$val.'" ';
						break;

						case 'Egale':
							$where .= ' AND pl.name = "'.$val.'" ';
						break;

					}
					
				}	

		}

		$groupby = ' GROUP BY p.id_'.$type_page.' ';

		
		$sql =  'SELECT  count(DISTINCT p.id_'.$type_page.') as nbr FROM `'._DB_PREFIX_.$type_page.'` p 
				INNER JOIN `'._DB_PREFIX_.$type_page.'_lang` pl ON  pl.id_'.$type_page.' = p.id_'.$type_page.'
				'.$inner_join.'
				WHERE 1 = 1 
				'.$where;

		$nombre = Db::getInstance()->getRow($sql);

		$page = $params['page'];

		$nombre_page = $nombre['nbr'] / $nbrresult;

		$limit1 = $page * $nbrresult;

		$limit = " LIMIT ".$limit1.",".$nbrresult." ";

		
		$sql = 'SELECT  p.id_'.$type_page.',  pl.name, pl.link_rewrite FROM `'._DB_PREFIX_.$type_page.'` p 
				INNER JOIN `'._DB_PREFIX_.$type_page.'_lang` pl ON  pl.id_'.$type_page.' = p.id_'.$type_page.'
				'.$inner_join.'
				WHERE 1 = 1 
				'.$where.' 
				'.$limit;

		//echo $sql."\n";

		$this->results = Db::getInstance()->ExecuteS($sql);

		$link = new Link();

		foreach($this->results as $k => $result)
		{


			if($type_page == "product")
			{
				$this->results[$k]['url'] = $link->getProductLink($result['id_product'], 'test');
				$this->results[$k]['type'] = "Produits";
			}
			elseif($type_page == "category")
			{
				$this->results[$k]['url'] = $link->getCategoryLink($result['id_category']);
				$this->results[$k]['type'] = "Categories";
			}

			$info = $this->getInfoByPage($this->results[$k]['url']);
			if($info)
				$this->results[$k]['info'] = $info;
		}

		
		$this->filters = array('page' => $page, 'nbr_page' => ceil($nombre_page), 'total_result' => $nombre['nbr']);
	}


	public function getInfoByPage($page)
	{
		$sql = 'SELECT * FROM pages p 
				INNER JOIN keyword k ON k.id_page = p.id_page
				WHERE url = "'.$page.'"';

				//echo $sql;
		$donnees = mysql_query($sql, $this->link) or die(mysql_error());
		$res = mysql_fetch_assoc($donnees);

		return $res;
	}	



}