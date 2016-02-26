<?php

include('PSWebServiceLibrary.php');


Class Synchronise
{


	public $url;
	public $key;

	public function __construct($url, $key, $code_site)
	{
		$this->link = mysql_connect('localhost', 'root', 'toto');
		$this->url = $url;
		$this->key = $key;
		$this->prestashop = new PrestaShopWebservice($url, $key, false);


		// CRÉATION DE LA BDD SI NON EXISTANTE
		if(!$this->checkIssetBdd($code_site))
			$this->createBdd($code_site);
		else
			$this->connectBdd($code_site);

	}


	public function connectBdd($bdd)
	{
		mysql_select_db($bdd, $this->link);
	}


	public function checkIssetBdd($bdd)
	{
		$showdb=mysql_query("SHOW DATABASES LIKE '$bdd'", $this->link);
		if (!$resultsd2=mysql_fetch_array($showdb)) 
			return false;
		else 
			return true;
	}

	public function createBdd($bdd)
	{
		// Création de la base de données
		$sql = 'CREATE DATABASE IF NOT EXISTS `'.$bdd.'` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;';
		mysql_query($sql, $this->link);

		// SELECTION DE LA BDD

		mysql_select_db($bdd, $this->link);

		// Création des tables 

		$sql = 'CREATE TABLE IF NOT EXISTS `ps_category` (
				  `id_category` int(11) NOT NULL,
				  `name` text NOT NULL,
				  `description` text NOT NULL,
				  `link_rewrite` text NOT NULL,
				  `meta_title` text NOT NULL,
				  `meta_keywords` text NOT NULL,
				  `meta_description` text NOT NULL
				) ENGINE=InnoDB DEFAULT CHARSET=latin1;';

		mysql_query($sql, $this->link);

		$sql = 'CREATE TABLE IF NOT EXISTS `ps_product` (
				  `id_product` int(11) NOT NULL,
				  `reference` text NOT NULL,
				  `name` text NOT NULL,
				  `meta_title` text NOT NULL,
				  `meta_description` text NOT NULL,
				  `description` text NOT NULL,
				  `description_short` text NOT NULL,
				  `link_rewrite` text NOT NULL
				) ENGINE=InnoDB DEFAULT CHARSET=latin1;';

		mysql_query($sql, $this->link);


	}

	public function getCategories()
	{
		/* NEED id_category, name, description, link_rewrite, meta_title, meta_keywords, meta_description */
		$fields = array('id_category', 'name', 'description', 'link_rewrite', 'meta_title','meta_keywords', 'meta_description');

		$start = true;
		$page = 0;
		while($start)
		{
			$limit1 = $page * 3;
			$opt = array('resource' => 'categories', 'limit' => $limit1.',3');

			$xml = $this->prestashop->get($opt);

		    $resources = $xml->categories->children();

		    if($resources)
			    foreach ($resources as $resource)
			    {
			    	 $opt = Array();
			    	 $id_category = $resource->attributes();
			    	 $opt['resource'] = 'categories';
			    	 $opt['id'] = $id_category;
			    	 $xml = $this->prestashop->get($opt);

			    	 $data = array();

			    	 $data['id_category'] = $id_category;
			    	 $data['name'] = utf8_decode($xml->category->name->language[0]);
			    	 $data['description'] = utf8_decode($xml->category->description->language[0]);
			    	 $data['link_rewrite'] = utf8_decode($xml->category->link_rewrite->language[0]);
			    	 $data['meta_title'] = utf8_decode($xml->category->meta_title->language[0]);
			    	 $data['meta_keywords'] = utf8_decode($xml->category->meta_keywords->language[0]);
			    	 $data['meta_description'] = utf8_decode($xml->category->meta_description->language[0]);

			    	 if($this->checkIsset($id_category, 'category', $fields))
			    	 	$this->update($id_category, 'category', $fields, $data);
			    	 else
			    	 	$this->add($id_category, 'category', $fields, $data);
			    }
			else
			{
				$start = false;
			}
			$page ++;
		}

	}


	public function getProducts()
	{
		/* NEED id_product, reference, name, meta_title, meta_description, description, description_short, link_rewrite, meta_keywords */
		$fields = array('id_product', 'reference', 'name', 'meta_title', 'meta_description','description', 'description_short', 'link_rewrite');

		$start = true;
		$page = 0;
		while($start)
		{
			$limit1 = $page * 3;
			$opt = array('resource' => 'products', 'limit' => $limit1.',3');

			$xml = $this->prestashop->get($opt);

		    $resources = $xml->products->children();

		    if($resources)
			    foreach ($resources as $resource)
			    {
			    	 $opt = Array();
			    	 $id_product = $resource->attributes();
			    	 $opt['resource'] = 'products';
			    	 $opt['id'] = $id_product;
			    	 $xml = $this->prestashop->get($opt);

			    	 $o['resource'] = 'images/products';
			    	 $o['display'] = 'full';
			    	 $o['id'] = $id_product;
			    	 $m = $this->prestashop->get($o);

			    	 var_dump($m);

			    	 exit;

			    	 $data = array();

			    	 $data['id_product'] = $id_product;
			    	 $data['reference'] = utf8_decode($xml->product->reference);
			    	 $data['name'] = utf8_decode($xml->product->name->language[0]);
			    	 $data['meta_title'] = utf8_decode($xml->product->meta_title->language[0]);
			    	 $data['meta_description'] = utf8_decode($xml->product->meta_description->language[0]);
			    	 $data['description'] = utf8_decode($xml->product->description->language[0]);
			    	 $data['description_short'] = utf8_decode($xml->product->description_short->language[0]);
			    	 $data['link_rewrite'] = utf8_decode($xml->product->link_rewrite->language[0]);

			    	 if($this->checkIsset($id_product, 'product', $fields))
			    	 	$this->update($id_product, 'product', $fields, $data);
			    	 else
			    	 	$this->add($id_product, 'product', $fields, $data);

			    }
			else
			{
				$start = false;
			}
			$page ++;
		}
	}

	public function getImages()
	{
		/* NEED id_image, id_product, legend */
		$fields = array('id_image', 'id_product', 'legend');

		$start = true;
		$page = 0;
		while($start)
		{
			$limit1 = $page * 3;
			$opt = array('resource' => 'images', 'limit' => $limit1.',3');

			$xml = $this->prestashop->get($opt);



		    $resources = $xml->image_types->products->children();

		    var_dump($resources);
		    var_dump($xml->image_types->products);
		    exit;

		    if($resources)
			    foreach ($resources as $resource)
			    {
			    	 $opt = Array();
			    	 $id_product = $resource->attributes();
			    	 $opt['resource'] = 'products';
			    	 $opt['id'] = $id_product;
			    	 $xml = $this->prestashop->get($opt);

			    	 $data = array();

			    	 $data['id_product'] = $id_product;
			    	 $data['reference'] = utf8_decode($xml->product->reference);
			    	 $data['name'] = utf8_decode($xml->product->name->language[0]);
			    	 $data['meta_title'] = utf8_decode($xml->product->meta_title->language[0]);
			    	 $data['meta_description'] = utf8_decode($xml->product->meta_description->language[0]);
			    	 $data['description'] = utf8_decode($xml->product->description->language[0]);
			    	 $data['description_short'] = utf8_decode($xml->product->description_short->language[0]);
			    	 $data['link_rewrite'] = utf8_decode($xml->product->link_rewrite->language[0]);

			    	 if($this->checkIsset($id_product, 'product', $fields))
			    	 	$this->update($id_product, 'product', $fields, $data);
			    	 else
			    	 	$this->add($id_product, 'product', $fields, $data);

			    }
			else
			{
				$start = false;
			}
			$page ++;
		}
	}


	public function checkIsset($id, $table, $fields)
	{
		$sql = 'SELECT * FROM ps_'.$table.' WHERE id_'.$table.' = '.$id.'';
		$donnees = mysql_query($sql);
		$res = mysql_fetch_assoc($donnees);
		if($res)
			return true;
		
		return false;
	}

	public function add($id, $table, $fields, $data)
	{
		$implodeArray = '"'.implode( '","', $data ).'"';
		$sql = 'INSERT INTO ps_'.$table.' ('.implode(',', $fields).')  VALUES('.$implodeArray.')';
		mysql_query($sql, $this->link) or die(mysql_error());
	}

	public function update($id, $table, $fields, $data)
	{
		$sql = 'UPDATE ps_'.$table.' SET ';
		
		foreach($fields as $field)
		{
			if($field == 'id_'.$table)
				continue;

			$sql .= $field . ' = "'.$data[$field].'", ';
		}
		$sql = substr($sql,0, -2);
		$sql .= ' WHERE id_'.$table.' = '.$id.'';
		mysql_query($sql, $this->link) or die(mysql_error());
	}


}
