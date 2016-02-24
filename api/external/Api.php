<?php

 require_once('lib/WSAclient.php');
 require_once('lib/WSAParser.php');

Class API
{

	public $WSA_USER_ID = '24802';
    public $WSA_API_KEY = 'ba198af81a12d996a43083ec3d7ee82ee585a5db';
    public $WSA_SUBSCRIPTION_ID = '28023';

	public function __construct()
	{
		$this->WSAclient = new WSAclient($this->WSA_USER_ID, $this->WSA_API_KEY);
	}


	public function getResults($id_tool, $params)
	{

        $result=$this->WSAclient->newReport($id_tool,$params,$this->WSA_SUBSCRIPTION_ID,'json','FR');

        return $result;
	}

}
