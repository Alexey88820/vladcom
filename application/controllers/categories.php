<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends Frontend_Controller {

    public $data;

    public function __construct() {
        parent::__construct();

        $this->load->model('main_model');
        $this->load->model('meta_model');
        $this->load->model('catalog_model');
        $this->load->model('categories_model');

        $this->data['course'] = $this->catalog_model->getExchangeRatesCBRF('USD');
        $this->data['content']['leaders'] = $this->catalog_model->getLeaders();

        $this->data['left_nav']['sections'] = $this->catalog_model->getSectionElements();
        $this->data['left_nav']['groups']   = $this->catalog_model->getGroupsWithSectionsKeys();
    }

    public function index($category = FALSE) {

        // var_dump($category);

        $this->data['nav'] = $this->categories_model->getActiveNavigation($category);

        $this->data['meta'] = $this->meta_model->getCategoryMeta($category);
        $this->data['header'] = $this->main_model->getMainContent();

        $this->meta_model->getLastModifiedInfoOfPage($category);

        $this->data['content']['category'] = $this->categories_model->getCategoryData($this->categories_model->getCategoryIdByName($category));

         view_loader($this->data,
                array(
                    array(0 => 'templates', 1 => 'open_container'),
                    array(0 => 'categories', 1 => 'category_view'),
                    array(0 => 'templates', 1 => 'close_container')
                    ));

    }

}
