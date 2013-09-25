<?php

class Page extends Frontend_Controller {

    private $_modified = array();

    public function __construct(){
        parent::__construct();

        $this->load->model('catalog_section_model');
        $this->load->model('catalog_group_model');
        $this->load->model('catalog_item_model');

        $this->data['blocks']   = $this->block_model->get();
        $this->data['sections'] = $this->catalog_section_model->get();
        $this->data['groups']   = $this->catalog_group_model->get();
        $this->data['leaders']  = $this->catalog_item_model->get_by(array('leader' => 1));

        $this->_checkLastModifiedInModel($this->data['sections']);
        $this->_checkLastModifiedInModel($this->data['groups']);
        $this->_checkLastModifiedInModel($this->data['blocks']);

        shuffle($this->data['leaders']);
    }

    public function index() {
    	// Fetch the page template
        $slug               = (string) $this->uri->segment(1);

        switch ($slug) {
            case 'article':
                $this->_route_article();
                break;
            case 'catalog':
                $this->_route_catalog($this->uri->segment(2));
                break;
            default:
                $this->_route_page($slug);
                break;
        }

        $this->_get_last_modified_header(max($this->_modified));

        $this->load->view('_layout_main', $this->data);
    }

    private function _error_404()
    {
        $this->output->set_status_header('404');

        $this->data['meta_title'] = 'Ошибка 404. Страница не найдена!';
        $this->data['subview'] = 'error_404';
        $this->load->view('_layout_main', $this->data);

        // exit();
    }

    private function _route_homepage()
    {

    }

    private function _route_page($slug)
    {
        $this->data['page'] = $this->page_model->get_by(array('slug' => $slug), TRUE);


        if (!count($this->data['page'])) {
            $this->_error_404();
            return false;
        }

        $this->_modified[] = strtotime($this->data['page']->modified);

        $view   = !empty($slug) ? $slug       : 'homepage';
        $method = !empty($slug) ? '_' . $slug : '_homepage';

        if (method_exists($this, $method)) {
            $this->$method();
            $this->data['subview'] = $view;
        } else {
            $this->_page();
            $this->data['subview'] = 'page';
        }
    }

    private function _route_article()
    {
        $this->_article();
    }

    private function _route_catalog($slug)
    {
        if (empty($slug)) {
            $this->_catalog();
        } else {
            $this->load->model('catalog_section_model');
            $this->load->model('catalog_group_model');
            $this->load->model('catalog_item_model');

            $section = $this->catalog_section_model->get_by(array('slug' => $slug), true);
            $group   = $this->catalog_group_model->get_by(array('slug' => $slug), true);
            $item    = $this->catalog_item_model->get_by(array('slug' => $slug), true);

            if (count($section)) {
                $this->_catalog_section($slug);
            } elseif (count($group)) {
                $this->_catalog_group($slug);
            } elseif (count($item)) {
                $this->_catalog_item($slug);
            } else {
                show_404(current_url());
            }
        }
    }

    private function _catalog_section($slug)
    {
        $this->data['catalog_section'] = $this->catalog_section_model->get_by(array('slug' => $slug), true);

        $this->data['catalog_groups']  = $this->catalog_group_model->get_by(array('section_id' => $this->data['catalog_section']->id));

        $this->data['subview'] = 'catalog_section';
    }

    private function _catalog_group($slug)
    {
        $this->data['catalog_group']   = $this->catalog_group_model->get_by(array('slug' => $slug), true);
        $this->data['catalog_section'] = $this->catalog_section_model->get($this->data['catalog_group']->section_id, true);

        $this->data['catalog_items']   = $this->catalog_item_model->get_by(array('group_id' => $this->data['catalog_group']->id));

        $this->data['subview'] = 'catalog_group';
    }

    private function _catalog_item($slug)
    {
        $this->data['catalog_item']    = $this->catalog_item_model->get_by(array('slug' => $slug), true);

        $this->data['catalog_group']   = $this->catalog_group_model->get($this->data['catalog_item']->group_id, true);
        $this->data['catalog_section'] = $this->catalog_section_model->get($this->data['catalog_group']->section_id, true);

        $this->data['subview'] = 'catalog_item';
    }

    private function _catalog()
    {
        $this->data['canonical'] = site_url();
        $this->data['subview'] = 'catalog';
    }

    private function _page()
    {

    }

    private function _homepage()
    {
        $this->load->model('article_model');

        $this->data['hero_unit'] = $this->block_model->get_by(array('slug' => 'hero-unit'), true);
        $this->data['product_samples'] = $this->block_model->get_by(array('slug' => 'product-samples'), true);
        $this->data['recent_articles'] = $this->article_model->get_recent();

        $this->_checkLastModifiedInModel($this->data['recent_articles']);
    }

    private function _article()
    {
        $this->load->model('article_model');
    	$this->data['articles'] = $this->article_model->get();

        $this->_checkLastModifiedInModel($this->data['articles']);

        $this->data['subview'] = 'article';
    }

    private function _checkLastModifiedInModel($data)
    {
        foreach ($data as $value) {
            $this->_modified[] = strtotime($value->modified);
        }
    }

}
