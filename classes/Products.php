<?php
ini_set('display_errors', true);


Class Products
{

	public function __construct()
	{

	}


	public function getProducts()
	{

		$data['products'] = $this->products;
		$data['filters'] = $this->filters;

		return json_encode($data);
	}

	public function updateProduct($params)
	{
		$id_product = $params['id_product'];
		unset($params['id_product']);
		unset($params['action']);
		$sql = 'UPDATE `'._DB_PREFIX_.'product_lang` SET ';
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

		$sql .= ' WHERE id_product = "'.$id_product.'"';

		Db::getInstance()->Execute($sql) or die(mysql_error());

	}


	public function filtersProducts($params)
	{

		
		$nbrresult = $params['nbrresult'];
		$where = '';
		$groupby = ' GROUP BY p.id_product ';
		$inner_join = '';
		foreach($params as $key => $val)
		{
			if(!$val)
				continue;

			if($val != "false")
			{
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

				if($key == "content_double")
				{
					$where .= " AND EXISTS (
							              SELECT *
							              FROM `'._DB_PREFIX_.'product_lang` pl2
							              WHERE pl.id_product <> pl2.id_product
							              AND   pl.".$val." = pl2.".$val.") AND ".$val." != '' ";
				}

				if($key == "content_short")
				{
						$where .= " AND LENGTH(pl.".$val.") < 10 AND ".$val." != '' ";
				}

				if($key == 'actif')
				{
					
					$where .= ' AND p.active = 1 ';
				}
				
				if($key == 'empty')
				{
					$where .= ' AND pl.'.$val.' = "" ';
				}

				if($key  == "id_category")
				{
					$inner_join .= ' INNER JOIN `'._DB_PREFIX_.'category_product` cp ON cp.id_product = p.id_product ';
					$where .= ' AND cp.id_category = '.(int)$val.' ';
				}

				if($key == "images")
				{
						$where .= ' AND p.id_product NOT IN (SELECT id_product FROM `'._DB_PREFIX_.'image`) ';
				}

			}
		}

		
		$sql =  'SELECT  count(DISTINCT p.id_product) as nbr FROM `'._DB_PREFIX_.'product` p 
				INNER JOIN `'._DB_PREFIX_.'product_lang` pl ON  pl.id_product = p.id_product
				LEFT JOIN `'._DB_PREFIX_.'image` i ON i.id_product = p.id_product 
				'.$inner_join.'
				WHERE 1 = 1 
				'.$where;

		$nombre = Db::getInstance()->getRow($sql);

		$page = $params['page'];

		$nombre_page = $nombre['nbr'] / $nbrresult;

		$limit1 = $page * $nbrresult;

		$limit = " LIMIT ".$limit1.",".$nbrresult." ";

		
		$sql = 'SELECT p.id_product,i.id_image as id_image, p.reference, pl.name, pl.link_rewrite, pl.description, pl.description_short, pl.meta_description, pl.meta_keywords, pl.meta_title FROM `'._DB_PREFIX_.'product` p 
				INNER JOIN `'._DB_PREFIX_.'product_lang` pl ON  pl.id_product = p.id_product
				LEFT JOIN `'._DB_PREFIX_.'image` i ON i.id_product = p.id_product 
				'.$inner_join.'
				WHERE 1 = 1 
				'.$where.' 
				'.$groupby.'
				'.$limit;

		//echo $sql."\n";

		$this->products = Db::getInstance()->ExecuteS($sql);

		$tab_product = array(); 
		$link = new Link();
		if($this->products)
			foreach($this->products as $k => $product)
			{

				$this->products[$k]['image'] = $link->getImageLink($product['link_rewrite'], $product['id_image'], 'small_default');

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

		if($this->products)
		foreach($this->products as $key => $product)
		{
			if(isset($tab[$product['id_product']]))
			{
				$this->products[$key]['categories'] = $tab[$product['id_product']];
			}
		}


		$this->filters = array('page' => $page, 'nbr_page' => ceil($nombre_page), 'total_result' => $nombre['nbr']);



	}

}