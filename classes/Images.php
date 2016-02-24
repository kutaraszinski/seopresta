<?php
ini_set('display_errors', true);


Class Images
{

	public function __construct()
	{

	}


	public function getImages()
	{

		$data['images'] = $this->images;
		$data['filters'] = $this->filters;

		return json_encode($data);
	}

	public function updateImage($params)
	{
		$id_image = $params['id_image'];
		unset($params['id_image']);
		unset($params['action']);
		$sql = 'UPDATE `'._DB_PREFIX_.'image_lang` SET ';
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

		$sql .= ' WHERE id_image = "'.$id_image.'"';

		Db::getInstance()->Execute($sql) or die(mysql_error());

	}


	public function filtersImages($params)
	{
		
		$nbrresult = $params['nbrresult'];
		$where = '';
		$groupby = ' GROUP BY i.id_image ';
		$inner_join = '';
		foreach($params as $key => $val)
		{
			if(!$val)
				continue;

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

		
		$sql =  'SELECT  count(DISTINCT p.id_product) as nbr FROM `'._DB_PREFIX_.'product` p 
				INNER JOIN `'._DB_PREFIX_.'product_lang` pl ON  pl.id_product = p.id_product
				INNER JOIN `'._DB_PREFIX_.'image` i ON i.id_product = p.id_product 
				'.$inner_join.'
				WHERE 1 = 1 
				'.$where;

		$nombre = Db::getInstance()->getRow($sql);

		$page = $params['page'];

		$nombre_page = $nombre['nbr'] / $nbrresult;

		$limit1 = $page * $nbrresult;

		$limit = " LIMIT ".$limit1.",".$nbrresult." ";

		
		$sql = 'SELECT p.id_product,i.id_image as id_image, pl.name, pl.link_rewrite, il.legend FROM `'._DB_PREFIX_.'product` p 
				INNER JOIN `'._DB_PREFIX_.'product_lang` pl ON  pl.id_product = p.id_product
				INNER JOIN `'._DB_PREFIX_.'image` i ON i.id_product = p.id_product 
				INNER JOIN `'._DB_PREFIX_.'image_lang` il ON i.id_image = il.id_image  
				'.$inner_join.'
				WHERE 1 = 1 
				'.$where.' 
				'.$groupby.'
				'.$limit;

		//echo $sql."\n";

		$this->images = Db::getInstance()->ExecuteS($sql);

		$tab_product = array(); 
		$link = new Link();
		if($this->images)
			foreach($this->images as $k => $product)
			{

				$this->images[$k]['image'] = $link->getImageLink($product['link_rewrite'], $product['id_image'], 'small_default');

				$tab_product[] = $product['id_product'];
			}

		$sql = 'SELECT cp.id_product,cp.id_category, cl.name  FROM `'._DB_PREFIX_.'category_product` cp
				LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON cl.id_category = cp.id_category
				WHERE id_product IN ('.implode(',', $tab_product).') AND cl.name != ""';
		$categories = Db::getInstance()->ExecuteS($sql);

		if($categories)
		foreach($categories as $category)
		{
			$tab[$category['id_product']][$category['id_category']] = $category['name'];
		}

		if($this->images)
		foreach($this->images as $key => $product)
		{
			if(isset($tab[$product['id_product']]))
			{
				$this->images[$key]['categories'] = $tab[$product['id_product']];
			}
		}


		$this->filters = array('page' => $page, 'nbr_page' => ceil($nombre_page), 'total_result' => $nombre['nbr']);



	}

}