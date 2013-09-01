<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalog extends Frontend_Controller {

    public $data;

    public function __construct() {
        parent::__construct();

        $this->load->model('meta_model');
        $this->load->model('main_model');
        $this->load->model('catalog_model');
        $this->load->model('categories_model');

        $this->data['header'] = $this->main_model->getMainContent();
        $this->data['nav']    = $this->categories_model->getActiveNavigation(get_class($this));
        $this->data['course'] = $this->catalog_model->getExchangeRatesCBRF('USD');
        $this->data['content']['leaders'] = $this->catalog_model->getLeaders();
        // $this->meta_model->getLastModifiedInfoOfPage('catalog');

        $this->data['left_nav']['sections'] = $this->catalog_model->getSectionElements();
        $this->data['left_nav']['groups']   = $this->catalog_model->getGroupsWithSectionsKeys();
    }

    public function index($slug = FALSE) {

        if ($slug === FALSE) {
            $this->launchMainCatalog();
            return FALSE;
        }

        $information = $this->catalog_model->getElementTypeBySlug($slug);

        $catalog_type = NULL;

        if (!empty($information['section'])) {
            $catalog_type = 'section';
        } elseif (!empty($information['group'])) {
            $catalog_type = 'group';
        } elseif (!empty($information['catalog'])) {
            $catalog_type = 'catalog';
        } elseif (!empty($information['commercial'])) {
            $catalog_type = 'commercial';
        } elseif (!empty($information['commercial_group'])) {
            $catalog_type = 'commercial_group';
        }

        switch ($catalog_type) {
            case 'section':
                $this->launchSectionElement($slug);
                break;
            case 'group':
                $this->launchGroupElement($slug);
                break;
            case 'catalog':
                $this->launchCatalogElement($slug);
                break;
            case 'commercial_group':
                $this->launchCommercialGroupElement($slug);
                break;
            case 'commercial':
                $this->launchCommercialElement($slug);
                break;
            default:
                redirect('catalog');
            // var_dump($slug);
                break;
        }
    }

    public function launchMainCatalog() {
        $this->data['meta']                = $this->meta_model->getCategoryMeta(get_class());
        $this->data['content']['sections'] = $this->catalog_model->getSectionElements();
        $this->data['content']['groups']   = $this->catalog_model->getGroupElements();
        $this->data['content']['items']    = $this->catalog_model->getCatalogElements();

        $this->data['content']['commercial_groups'] = $this->catalog_model->getCommercialGroupElements();
        $this->data['content']['commercials']       = $this->catalog_model->getCommercialElements();

        $this->meta_model->getLastModifiedInfoOfPage('catalog');

        $this->showAllCatalogElements($this->data);
    }

    public function launchSectionElement($slug) {
        $section_id = $this->catalog_model->getIdElementBySlug($slug, $this->catalog_model->getDbSectionsName());

        $this->data['meta']               = $this->meta_model->getElementMeta($slug, $this->catalog_model->getDbSectionsName());
        $this->data['content']['section'] = $this->catalog_model->getElement($slug, $this->catalog_model->getDbSectionsName());
        $this->data['content']['groups']  = $this->catalog_model->getGroupElementsOfSection($section_id);

        $this->meta_model->getLastModifiedInfoOfPage('catalog', array($this->catalog_model->getDbSectionsName() => $slug));

        $this->showSectionElementView($this->data);
    }

    public function launchGroupElement($slug) {
        $group_id = $this->catalog_model->getIdElementBySlug($slug, $this->catalog_model->getDbGroupsName());

        $this->data['meta']             = $this->meta_model->getElementMeta($slug, $this->catalog_model->getDbGroupsName());
        $this->data['content']['group'] = $this->catalog_model->getElement($slug, $this->catalog_model->getDbGroupsName());
        $this->data['content']['items'] = $this->catalog_model->getCatalogElementsOfGroup($group_id);
        $this->data['content']['section'] = $this->catalog_model->getElement($this->data['content']['group']['section'], $this->catalog_model->getDbSectionsName());

        switch ($group_id) {
            // Если выбирается группа "Готовые окрасочные комплексы", то запускаем методы для работы с коммерческими предложениями
            case 10:
                $this->data['content']['commercial_groups'] = $this->catalog_model->getCommercialGroupElements();
                $this->data['content']['commercials']       = $this->catalog_model->getCommercialElements();
                $this->meta_model->getLastModifiedInfoOfPage('catalog', array($this->catalog_model->getDbComercialsGroupsName() => $slug));
                $this->showCommercialGroupsList($this->data);
                break;
            default:
                $this->meta_model->getLastModifiedInfoOfPage('catalog', array($this->catalog_model->getDbGroupsName() => $slug));
                $this->showGroupElementView($this->data);
                break;
        }
    }

    public function launchCatalogElement($slug) {
        $this->data['meta']            = $this->meta_model->getElementMeta($slug, $this->catalog_model->getDbCatalogName());
        $this->data['content']['item'] = $this->catalog_model->getElement($slug, $this->catalog_model->getDbCatalogName());

        $this->data['content']['group'] = $this->catalog_model->getElement($this->data['content']['item']['group'], $this->catalog_model->getDbGroupsName());
        $this->data['content']['section'] = $this->catalog_model->getElement($this->data['content']['group']['section'], $this->catalog_model->getDbSectionsName());

        $this->meta_model->getLastModifiedInfoOfPage('catalog', array($this->catalog_model->getDbCatalogName() => $slug));

        $this->showCatalogElementView($this->data);
    }

    public function launchCommercialElement($slug) {
        $this->data['meta']            = $this->meta_model->getElementMeta($slug, $this->catalog_model->getDbComercialsName());
        $this->data['content']['item'] = $this->catalog_model->getElement($slug, $this->catalog_model->getDbComercialsName());
        $this->data['content']['commercial_group'] = $this->catalog_model->getElement($this->data['content']['item']['comm_group'], $this->catalog_model->getDbComercialsGroupsName());
        $this->data['content']['group'] = $this->catalog_model->getElement(10, $this->catalog_model->getDbGroupsName());
        $this->data['content']['section'] = $this->catalog_model->getElement($this->data['content']['commercial_group']['section'], $this->catalog_model->getDbSectionsName());

        $this->meta_model->getLastModifiedInfoOfPage('catalog', array($this->catalog_model->getDbComercialsName() => $slug));

        $this->showCommercialElementView($this->data);
    }

    public function launchCommercialGroupElement($slug) {
        $this->data['meta']                        = $this->meta_model->getElementMeta($slug, $this->catalog_model->getDbComercialsGroupsName());
        $this->data['content']['commercials']      = $this->catalog_model->getCommercialElements();
        $this->data['content']['commercial_group'] = $this->catalog_model->getElement($slug, $this->catalog_model->getDbComercialsGroupsName());
        $this->data['content']['group'] = $this->catalog_model->getElement(10, $this->catalog_model->getDbGroupsName());
        $this->data['content']['section'] = $this->catalog_model->getElement($this->data['content']['commercial_group']['section'], $this->catalog_model->getDbSectionsName());

        $this->meta_model->getLastModifiedInfoOfPage('catalog', array($this->catalog_model->getDbComercialsGroupsName() => $slug));

        $this->showCommercialGroupView($this->data);
    }


    public function showAllCatalogElements($data) {
        $data['breadcrumbs'][0] = array('name' => 'Каталог', 'link' => base_url() . 'catalog');

        view_loader($data,
                array(
                    array(0 => 'templates', 1 => 'open_container'),
                    array(0 => 'catalog',   1 => 'all_elements_list'),
                    array(0 => 'templates', 1 => 'close_container')
                    ));
    }

    public function showSectionElementsList($data) {
        $data['breadcrumbs'][0] = array('name' => 'Каталог', 'link' => FALSE);

        view_loader($data,
                array(
                    array(0 => 'templates', 1 => 'open_container'),
                    array(0 => 'catalog', 1 => 'section_elements_list'),
                    array(0 => 'templates', 1 => 'close_container')
                    ));
    }
    public function showSectionElementView($data) {

        $data['breadcrumbs'][0] = array('name' => 'Каталог', 'link' => base_url() . 'catalog');
        $data['breadcrumbs'][1] = array('name' => $this->data['content']['section']['name'], 'link' => FALSE);

        view_loader($data,
                array(
                    array(0 => 'templates', 1 => 'open_container'),
                    array(0 => 'catalog', 1 => 'group_elements_list'),
                    array(0 => 'templates', 1 => 'close_container')
                    ));
    }

    public function showGroupElementView($data) {

        $data['breadcrumbs'][0] = array('name' => 'Каталог', 'link' => base_url() . 'catalog');
        $data['breadcrumbs'][1] = array('name' => $this->data['content']['section']['name'], 'link' => base_url() . 'catalog/' . $this->data['content']['section']['slug']);
        $data['breadcrumbs'][2] = array('name' => $this->data['content']['group']['name'], 'link' => FALSE);

        view_loader($data,
                array(
                    array(0 => 'templates', 1 => 'open_container'),
                    array(0 => 'catalog', 1 => 'group_element_view'),
                    array(0 => 'templates', 1 => 'close_container')
                    ));
    }

    public function showCatalogElementView($data) {

        $data['breadcrumbs'][0] = array('name' => 'Каталог', 'link' => base_url() . 'catalog');
        $data['breadcrumbs'][1] = array('name' => $this->data['content']['section']['name'], 'link' => base_url() . 'catalog/' . $this->data['content']['section']['slug']);
        $data['breadcrumbs'][2] = array('name' => $this->data['content']['group']['name'], 'link' => base_url() . 'catalog/' . $this->data['content']['group']['slug']);
        $data['breadcrumbs'][3] = array('name' => $this->data['content']['item']['name'], 'link' => FALSE);

        if (in_array($data['content']['group']['id'], array(9, 10, 11, 12, 14, 15))) {
            $data['meta']['noindex'] = true;
        }

        // var_dump($data);
        view_loader($data,
                array(
                    array(0 => 'templates', 1 => 'open_container'),
                    array(0 => 'catalog', 1 => 'catalog_element_view'),
                    array(0 => 'templates', 1 => 'close_container')
                    ));
    }

    public function showCommercialGroupsList($data) {

        $data['breadcrumbs'][0] = array('name' => 'Каталог', 'link' => base_url() . 'catalog');
        $data['breadcrumbs'][1] = array('name' => $this->data['content']['section']['name'], 'link' => base_url() . 'catalog/' . $this->data['content']['section']['slug']);
        $data['breadcrumbs'][2] = array('name' => $this->data['content']['group']['name'], 'link' => base_url() . 'catalog/' . $this->data['content']['group']['slug']);
        // $data['breadcrumbs'][4] = array('name' => $this->data['content']['commercial_group']['title'], 'link' => FALSE);

        view_loader($data,
                array(
                    array(0 => 'templates', 1 => 'open_container'),
                    array(0 => 'catalog', 1 => 'group_element_view'),
                    array(0 => 'catalog', 1 => 'commercial_groups_list'),
                    array(0 => 'templates', 1 => 'close_container')
                    ));
    }

    public function showCommercialGroupView($data) {

        $data['breadcrumbs'][0] = array('name' => 'Каталог', 'link' => base_url() . 'catalog');
        $data['breadcrumbs'][1] = array('name' => $this->data['content']['section']['name'], 'link' => base_url() . 'catalog/' . $this->data['content']['section']['slug']);
        $data['breadcrumbs'][2] = array('name' => $this->data['content']['group']['name'], 'link' => base_url() . 'catalog/' . $this->data['content']['group']['slug']);
        $data['breadcrumbs'][3] = array('name' => $this->data['content']['commercial_group']['title'], 'link' => FALSE);


        view_loader($data,
                array(
                    array(0 => 'templates', 1 => 'open_container'),
                    array(0 => 'catalog', 1 => 'commercial_group_view'),
                    array(0 => 'templates', 1 => 'close_container')
                    ));
    }

    public function showCommercialElementView($data) {

        $data['breadcrumbs'][0] = array('name' => 'Каталог', 'link' => base_url() . 'catalog');
        $data['breadcrumbs'][1] = array('name' => $this->data['content']['section']['name'], 'link' => base_url() . 'catalog/' . $this->data['content']['section']['slug']);
        $data['breadcrumbs'][2] = array('name' => $this->data['content']['group']['name'], 'link' => base_url() . 'catalog/' . $this->data['content']['group']['slug']);
        $data['breadcrumbs'][3] = array('name' => $this->data['content']['commercial_group']['title'], 'link' => base_url() . 'catalog/' . $this->data['content']['commercial_group']['slug']);
        $data['breadcrumbs'][4] = array('name' => $this->data['content']['item']['title'], 'link' => FALSE);



        view_loader($data,
                array(
                    array(0 => 'templates', 1 => 'open_container'),
                    array(0 => 'catalog', 1 => 'commercial_view'),
                    array(0 => 'templates', 1 => 'close_container')
                    ));
    }

}