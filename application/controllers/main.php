<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

    public $data;

    public function __construct() {
        parent::__construct();

        $this->load->model('meta_model');
        $this->load->model('main_model');
        $this->load->model('blocks_model');
        $this->load->model('catalog_model');
        $this->load->model('news_model');
        $this->load->model('categories_model');

        $this->data['course'] = $this->catalog_model->getExchangeRatesCBRF('USD');
        $this->meta_model->getLastModifiedInfoOfPage(strtolower(get_class($this)));

        $this->data['left_nav']['sections'] = $this->catalog_model->getSectionElements();
        $this->data['left_nav']['groups']   = $this->catalog_model->getGroupsWithSectionsKeys();
    }

    public function index() {
        $this->data['meta']   = $this->meta_model->main_meta;
        $this->data['header'] = $this->main_model->getMainContent();
        $this->data['nav']    = $this->categories_model->getActiveNavigation(get_class($this));

        $special_id    = 6;
        $this->data['content']['special'] = $this->catalog_model->getElement($special_id, $this->catalog_model->getDbComercialsName());


        $this->data['content']['leaders'] = $this->catalog_model->getLeaders();


        $this->data['content']['blocks']['main_text']        = $this->categories_model->getCategoryData($this->categories_model->getCategoryIdByName('main'));
        $this->data['content']['blocks']['preview-sections'] = $this->catalog_model->getSectionElements();
        $this->data['content']['blocks']['preview-groups']   = $this->catalog_model->getGroupsWithSectionsKeys();
        $this->data['content']['blocks']['preview-news']     = $this->news_model->getLimitNewsList(3);

        view_loader($this->data,
                    array(
                        array(0 => 'blocks',    1 => 'hero_unit_special_block'),

                        array(0 => 'catalog',   1 => 'section_elements_on_main'),
                        array(0 => 'blocks',    1 => 'main_description_block'),
                        array(0 => 'news',      1 => 'news_on_main')
                    )
        );
    }

}