<?php
class Frontend_Controller extends MY_Controller
{

	function __construct ()
	{
		parent::__construct();

		$request_uri = $_SERVER['REQUEST_URI'];
		if ((isset($request_uri[1])) && ($request_uri[1] == '?')) {
			redirect(site_url(), 'location', 301);
		}

		$path = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

		$path = str_replace('?', '', $path);

		if (substr($path, -1) != '/') {
			redirect($path . '/', 'location', 301);
		}
	}
}