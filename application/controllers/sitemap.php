<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitemap extends Frontend_Controller {

    public $data;

    public function __construct() {
        parent::__construct();

        $this->load->model('meta_model');
        $this->load->model('main_model');
        $this->load->model('catalog_model');
        $this->load->model('categories_model');

        $this->data['meta']   = $this->meta_model->getMainMeta();
        $this->data['header'] = $this->main_model->getMainContent();
        $this->data['nav']    = $this->categories_model->getActiveNavigation(get_class($this));

        $this->data['meta']['meta_title'] = 'Карта сайта vladcom.su';

        $this->data['course'] = $this->catalog_model->getExchangeRatesCBRF('USD');
        $this->data['content']['leaders'] = $this->catalog_model->getLeaders();

        $this->data['left_nav']['sections'] = $this->catalog_model->getSectionElements();
        $this->data['left_nav']['groups']   = $this->catalog_model->getGroupsWithSectionsKeys();

    }

    public function index() {

        $this->data['categories'] = $this->categories_model->getCategories();

        $this->data['catalog']['sections'] = $this->catalog_model->getSectionElements();
        $this->data['catalog']['groups']   = $this->catalog_model->getGroupElements();
        $this->data['catalog']['items']    = $this->catalog_model->getCatalogElements();

        $this->data['catalog']['commercial_groups'] = $this->catalog_model->getCommercialGroupElements();
        $this->data['catalog']['commercials']       = $this->catalog_model->getCommercialElements();

        view_loader($this->data,
                    array(
                        array(0 => 'templates', 1 => 'open_container'),
                        array(0 => 'templates', 1 => 'sitemap'),
                        array(0 => 'templates', 1 => 'close_container'),
                        ));


    }


}