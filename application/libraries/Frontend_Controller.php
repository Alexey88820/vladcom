<?php
class Frontend_Controller extends MY_Controller
{

	function __construct ()
	{
		parent::__construct();

        $this->_redirectSeo();

		// Load stuff
		$this->load->model('page_model');
        $this->load->model('block_model');

		// Fetch navigation
        $this->data['menu'] = $this->page_model->get();

		$this->data['meta_title'] = config_item('site_name');

        $main_page_info = $this->page_model->get_by(array('slug' => ''), TRUE);
        $this->data['meta_keywords']    = $main_page_info->meta_keywords;
        $this->data['meta_description'] = $main_page_info->meta_description;
        // $this->data['meta_index']       = $main_page_info->meta_index;

        $this->data['header'] = $this->block_model->get_by(array('slug' => 'header'), true);
        $this->data['footer'] = $this->block_model->get_by(array('slug' => 'footer'), true);

        // $this->_get_last_modified_header();

        $this->data['course'] = 0;

        $this->data['course'] = getExchangeRatesCBRF('USD');
	}

    private function _redirectSeo()
    {
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

    protected function _get_last_modified_header($timestamp = false) {
        // $delay = mt_rand(2000,10000); // случайная задержка
        // $this->output->set_header('Last-Modified: ' . gmdate('D, d M Y H:i:s\G\M\T', time() - $delay) . ' GMT');
        // return true;

        $if_modified_since = false;
        if (isset($_ENV['HTTP_IF_MODIFIED_SINCE'])) {
            $if_modified_since = strtotime(substr($_ENV['HTTP_IF_MODIFIED_SINCE'], 5));
        }
        if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])) {
            $if_modified_since = strtotime(substr($_SERVER['HTTP_IF_MODIFIED_SINCE'], 5));
        }
        if ($if_modified_since && $if_modified_since >= $timestamp) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 304 Not Modified');
            exit;
        }
        $this->output->set_header('Last-Modified: ' . gmdate('D, d M Y H:i:s\G\M\T', $timestamp) . ' GMT');

        return true;
    }
}