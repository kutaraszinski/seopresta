<?php
ini_set('display_errors', true);
Class Categories
{


	public function getCategories()
	{

		$categories = Category::getSimpleCategories(1);

		foreach($categories as $category)
		{
			$tab_category[$category['id_category']] = $category;
		}
		
		return json_encode($tab_category);
	}


	public function filtersCategory($params)
	{
		$nbrresult = $params['nbrresult'];
		$where = '';
		$groupby = '';
		$inner_join = '';
		foreach($params as $key => $val)
		{
				if(!$val)
					continue;


				if($key == "name")
					$where .= ' AND cl.name LIKE "%'.$val.'%" ';

				if($key == "content_double")
				{
					
							$where .= " AND EXISTS (
								              SELECT *
								              FROM ps_category_lang cl2
								              WHERE cl.id_category <> cl2.id_category
								              AND   cl.".$val." = cl2.".$val.") AND ".$val." != '' ";

				}

				if($key == "content_short")
				{
					switch($val)
					{
						case 'meta_title':
							$where .= " AND LENGTH(cl.meta_title) < 10 AND meta_title != '' ";
						break;
						case 'meta_description':
							$where .= " AND LENGTH(cl.meta_description) < 50 AND meta_description != '' ";
						break;
					}
				}
				if($key == 'actif')
				{
					if($val)
						$where .= ' AND c.active = 1 ';
				}
				
				if($key == 'empty')
				{
					
					$where .= ' AND cl.'.$val.' = "" ';
				}

			
		}

		
		$sql =  'SELECT count(*) as nbr FROM ps_category c 
				INNER JOIN ps_category_lang cl ON  cl.id_category = c.id_category
				'.$inner_join.'
				WHERE 1 = 1 
				'.$where.' 
				'.$groupby;

		$nombre = Db::getInstance()->getRow($sql);

		$page = $params['page'];

		$nombre_page = $nombre['nbr'] / $nbrresult;

		$limit1 = $page * $nbrresult;

		$limit = " LIMIT ".$limit1.",".$nbrresult." ";

		
		$sql = 'SELECT c.id_category, cl.name, cl.link_rewrite, cl.description, cl.meta_description, cl.meta_keywords, cl.meta_title FROM ps_category c 
				INNER JOIN ps_category_lang cl ON  cl.id_category = c.id_category
				'.$inner_join.'
				WHERE 1 = 1 
				'.$where.' 
				'.$groupby.'
				'.$limit;

		$this->categories = Db::getInstance()->ExecuteS($sql);
		$this->filters = array('page' => $page, 'nbr_page' => ceil($nombre_page), 'total_result' => $nombre['nbr']);
	}


	public function getCategoriesByFilters()
	{

		$data['categories'] = $this->categories;
		$data['filters'] = $this->filters;

		return json_encode($data);
	}


	public function updateCategory($params)
	{
		$id_category = $params['id_category'];
		unset($params['id_category']);
		unset($params['action']);
		$sql = 'UPDATE ps_category_lang SET ';
		$i = 0;
		foreach($params as $key => $val)
		{
			if(!empty($val))
			{
				$sql .= ' '.$key.' = "'.$val.'", ';
				$i++;
			}
		}
		if($i == 0)
			return false;


		$sql = substr($sql, 0,-2);

		$sql .= ' WHERE id_category = "'.$id_category.'"';

		
		Db::getInstance()->Execute($sql);

	}
	

}