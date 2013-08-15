<?php
class Frontend_Controller extends MY_Controller
{

	function __construct ()
	{
		parent::__construct();

		$server_name = $_SERVER['SERVER_NAME'];
		$request_uri = $_SERVER['REQUEST_URI'];

		if (strstr($request_uri, '/index.php/')) {
			$request_uri = str_replace('/index.php/', '/', $request_uri);
			redirect('http://' . $server_name . $request_uri, 'location', 301);
		}
		if (strstr($request_uri, '/index.php')) {
			$request_uri = str_replace('/index.php', '/', $request_uri);
			redirect('http://' . $server_name . $request_uri, 'location', 301);
		}

		if ((isset($request_uri[1])) && ($request_uri[1] == '?')) {
			redirect(site_url(), 'location', 301);
		}

		$path = 'http://' . $server_name . $request_uri;
		if (substr($path, -1) != '/') {
			redirect($path . '/', 'location', 301);
		}
	}
}