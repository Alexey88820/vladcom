<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error_404 extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('meta_model');
        $this->load->model('main_model');
        $this->load->model('categories_model');

        $this->data['nav'] = $this->categories_model->getActiveNavigation(get_class($this));
        $this->data['categories'] = $this->categories_model->getCategories();
    }


    public function index() {
        header("HTTP/1.1 404 Not Found");
        $this->output->set_status_header('404');

        $this->data['meta']   = $this->meta_model->getMainMeta();
        $this->data['header'] = $this->main_model->getMainContent();

        $this->data['meta']['meta_title'] = 'Ошибка 404. Страница не найдена!';

        view_loader($this->data,
                array(
                    array(0 => 'templates', 1 => 'open_container'),
                    array(0 => 'templates', 1 => 'error_404'),
                    array(0 => 'templates', 1 => 'close_container')
                    ));
    }
}
