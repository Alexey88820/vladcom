<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends Frontend_Controller {

    public $data;

    public function __construct() {
        parent::__construct();

        $this->load->model('meta_model');
        $this->load->model('main_model');
        $this->load->model('news_model');
        $this->load->model('categories_model');
        $this->load->model('catalog_model');

        $this->data['nav']    = $this->categories_model->getActiveNavigation(get_class($this));

        $this->meta_model->getLastModifiedInfoOfPage(strtolower(get_class($this)));

        $this->data['course'] = $this->catalog_model->getExchangeRatesCBRF('USD');
        $this->data['content']['leaders'] = $this->catalog_model->getLeaders();

        $this->data['left_nav']['sections'] = $this->catalog_model->getSectionElements();
        $this->data['left_nav']['groups']   = $this->catalog_model->getGroupsWithSectionsKeys();
    }

    public function index() {
        $this->data['meta']   = $this->meta_model->getMainMeta();
        $this->data['header'] = $this->main_model->getMainContent();

        // var_dump($this->data['nav']);

        $this->data['meta']['meta_title'] = 'Новости. ' . $this->data['meta']['meta_title'];

        $this->data['content']['news'] = $this->news_model->getLimitNewsList();

        view_loader($this->data,
                    array(
                        array(0 => 'news', 1 => 'news_view')
                        ));
    }

}