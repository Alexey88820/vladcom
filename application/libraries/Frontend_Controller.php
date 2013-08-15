<?php
class Frontend_Controller extends MY_Controller
{

	function __construct ()
	{
		parent::__construct();

		//

		$path = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

		if (substr($path, -1) != '/') {
			// var_dump($path . '/');
			redirect($path . '/', 'location', 301);
		}



	}
}