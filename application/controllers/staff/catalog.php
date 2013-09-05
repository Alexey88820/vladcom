<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalog extends MY_Staff_Controller {

    const DB_SECTIONS           = 'c_sections';
    const DB_GROUPS             = 'c_groups';
    const DB_CATALOG            = 'c_catalog';
    const DB_COMMERCIALS        = 'c_commercials';
    const DB_COMMERCIALS_GROUPS = 'c_commercials_groups';

    public function __construct() {
        parent::__construct();

        $this->load->model('meta_model');
        $this->load->model('catalog_model');

        $this->data['meta']   = $this->meta_model->getStaffMeta();

        $this->data['messages']['success_message']  = NULL;
        $this->data['messages']['error_message']    = NULL;
    }

    public function index($what = FALSE) {
        switch ($what) {
            case 'commercial':
                $this->launchCommercialsPage();
                break;
            case 'commercial_group':
                $this->launchCommercialGroupsPage();
                break;
            case 'section':
                $this->launchSectionsPage();
                break;
            case 'group':
                $this->launchGroupsPage();
                break;
            case 'catalog':
                $this->launchCatalogPage();
                break;
            default:
                $this->launchMainCatalogPage();
                break;
        }
    }

    public function create($what) {
        switch ($what) {
            case 'commercial':
                $this->createCommercialElement();
                break;
            case 'commercial_group':
                $this->createCommercialGroupElement();
                break;
            case 'section':
                $this->createSectionElement();
                break;
            case 'group':
                $this->createGroupElement();
                break;
            case 'catalog':
                $this->createCatalogElement();
                break;
        }
    }

    public function edit($what, $id) {
        switch ($what) {
            case 'commercial':
                $this->editCommercialElement($id);
                break;
            case 'commercial_group':
                $this->editCommercialGroupElement($id);
                break;
            case 'section':
                $this->editSectionElement($id);
                break;
            case 'group':
                $this->editGroupElement($id);
                break;
            case 'catalog':
                $this->editCatalogElement($id);
                break;
        }
    }

    public function delete($what, $id) {
        switch ($what) {
            case 'commercial':

                break;
            case 'commercial_group':

                break;
            case 'section':
                $this->deleteSectionElement($id);
                break;
            case 'group':
                $this->deleteGroupElement($id);
                break;
            case 'catalog':
                $this->deleteCatalogElement($id);
                break;
        }
    }

    /* ================ */
    /* ===  LAUNCH  === */
    /* ================ */

    private function repeatValues($repeat) {
        if ($repeat!==FALSE) {
            if (isset($_POST)) {
                foreach ($this->data['form_values'] as $key => $value) {
                    if (isset($_POST[$key])) {
                        $this->data['form_values'][$key] = $_POST[$key];
                    }
                }
            }
        }
    }

    private function launchMainCatalogPage() {
        $this->showMainCatalog($this->data);
    }

    private function launchGroupsPage($id = FALSE, $repeat = FALSE) {
        if ($id===FALSE) {
            $this->data['form_values']           = $this->catalog_model->getEmptyFields(self::DB_GROUPS);
            $this->data['form_values']['button'] = 'Добавить группу';
            $this->data['operation']             = 'create/group';
        } else {
            $this->data['form_values']           = $this->catalog_model->getElement($id, self::DB_GROUPS);
            $this->data['form_values']['button'] = 'Редактировать группу';
            $this->data['operation']             = 'edit/group/' . $id;
        }
        $this->data['list_values']             = $this->catalog_model->getGroupElements();
        $this->data['form_values']['sections'] = $this->catalog_model->getSectionElements();

        $this->repeatValues($repeat);
        $this->showGroups($this->data);
    }

    private function launchSectionsPage($id = FALSE, $repeat = FALSE) {
        if ($id===FALSE) {
            $this->data['form_values']           = $this->catalog_model->getEmptyFields(self::DB_SECTIONS);
            $this->data['form_values']['button'] = 'Добавить секцию';
            $this->data['operation']             = 'create/section';
        } else {
            $this->data['form_values']           = $this->catalog_model->getElement($id, self::DB_SECTIONS);
            $this->data['form_values']['button'] = 'Редактировать секцию';
            $this->data['operation']             = 'edit/section/' . $id;
        }
        $this->data['list_values']             = $this->catalog_model->getSectionElements();

        $this->repeatValues($repeat);
        $this->showSections($this->data);
    }

    private function launchCatalogPage($id = FALSE, $repeat = FALSE) {
        if ($id===FALSE) {
            $this->data['form_values']           = $this->catalog_model->getEmptyFields(self::DB_CATALOG);
            $this->data['form_values']['button'] = 'Добавить товар';
            $this->data['operation']             = 'create/catalog';
        } else {
            $this->data['form_values']           = $this->catalog_model->getElement($id, self::DB_CATALOG);
            $this->data['form_values']['button'] = 'Редактировать товар';
            $this->data['operation']             = 'edit/catalog/' . $id;
        }
        $this->data['list_values']           = $this->catalog_model->getCatalogElements();
        $this->data['form_values']['groups'] = $this->catalog_model->getGroupElements();

        $this->repeatValues($repeat);
        $this->showCatalog($this->data);
    }

    private function launchCommercialGroupsPage($id = FALSE, $repeat = FALSE) {
        if ($id===FALSE) {
            $this->data['form_values']           = $this->catalog_model->getEmptyFields(self::DB_COMMERCIALS_GROUPS);
            $this->data['form_values']['button'] = 'Добавить группу коммерческих предложений';
            $this->data['operation']             = 'create/commercial_group';
        } else {
            $this->data['form_values']           = $this->catalog_model->getElement($id, self::DB_COMMERCIALS_GROUPS);
            $this->data['form_values']['button'] = 'Редактировать группу коммерческих предложений';
            $this->data['operation']             = 'edit/commercial_group/' . $id;
        }
        $this->data['list_values']             = $this->catalog_model->getCommercialGroupElements();
        $this->data['form_values']['sections'] = $this->catalog_model->getSectionElements();

        $this->repeatValues($repeat);
        $this->showCommercialGroups($this->data);
    }

    private function launchCommercialsPage($id = FALSE, $repeat = FALSE) {
        if ($id===FALSE) {
            $this->data['form_values']           = $this->catalog_model->getEmptyFields(self::DB_COMMERCIALS);
            $this->data['form_values']['button'] = 'Добавить коммерческое предложение';
            $this->data['operation']             = 'create/commercial';
        } else {
            $this->data['form_values']           = $this->catalog_model->getElement($id, self::DB_COMMERCIALS);
            $this->data['form_values']['button'] = 'Редактировать коммерческое предложение';
            $this->data['operation']             = 'edit/commercial/' . $id;
        }
        $this->data['list_values']           = $this->catalog_model->getCommercialElements();
        $this->data['form_values']['groups'] = $this->catalog_model->getCommercialGroupElements();

        $this->repeatValues($repeat);
        $this->showCommercials($this->data);
    }

    /* ============== */
    /* ===  SHOW  === */
    /* ============== */

    private function showMainCatalog($data) {
        staff_view_loader($data,
                    array(
                        array(0 => 'templates', 1 => 'div_open'),
                        array(0 => 'templates', 1 => 'div_close'),
                        ), TRUE);
    }


    private function showCatalog($data) {
        staff_view_loader($data,
                    array(
                        array(0 => 'staff/catalog', 1 => 'catalog_form'),
                        array(0 => 'staff/catalog', 1 => 'catalog_list'),
                        ), TRUE);
    }

    private function showGroups($data) {
        staff_view_loader($data,
                    array(
                        array(0 => 'staff/catalog', 1 => 'group_form'),
                        array(0 => 'staff/catalog', 1 => 'group_list')
                        ), TRUE);
    }
    private function showSections($data) {
        staff_view_loader($data,
                    array(
                        array(0 => 'staff/catalog', 1 => 'section_form'),
                        array(0 => 'staff/catalog', 1 => 'section_list')
                        ), TRUE);
    }

    private function showCommercials($data) {
        staff_view_loader($data,
                    array(
                        array(0 => 'staff/catalog', 1 => 'commercial_form'),
                        array(0 => 'staff/catalog', 1 => 'commercial_list')
                        ), TRUE);
    }

    private function showCommercialGroups($data) {
        staff_view_loader($data,
                    array(
                        array(0 => 'staff/catalog', 1 => 'commercial_group_form'),
                        array(0 => 'staff/catalog', 1 => 'commercial_group_list')
                        ), TRUE);
    }

    /* ================= */
    /* === SET RULES === */
    /* ================= */

    private function setRulesCatalog() {
        $this->form_validation->set_rules('name', 'Название товара');
        $this->form_validation->set_rules('slug', 'Alias');
        $this->form_validation->set_rules('price', 'Цена', 'required|trim');
        $this->form_validation->set_rules('units', 'Единицы');
        $this->form_validation->set_rules('group', 'Groups', 'required');
        $this->form_validation->set_rules('description', 'Краткое описание');
        $this->form_validation->set_rules('full_description', 'Полное описание');
        $this->form_validation->set_rules('meta_title', 'Мета-тег: Заголовок');
        $this->form_validation->set_rules('meta_keywords', 'Мета-тег: Ключевые слова');
        $this->form_validation->set_rules('meta_description', 'Мета-тег: Описание');
    }

    private function setRulesGroups() {
        $this->form_validation->set_rules('section', 'Раздел товара', 'required');
        $this->form_validation->set_rules('name', 'Название товара', 'required');
        $this->form_validation->set_rules('slug', 'Алиас');
        $this->form_validation->set_rules('description', 'Краткое описание');
        $this->form_validation->set_rules('meta_title', 'Мета-тег: Заголовок');
        $this->form_validation->set_rules('meta_keywords', 'Мета-тег: Ключевые слова');
        $this->form_validation->set_rules('meta_description', 'Мета-тег: Описание');
    }

    private function setRulesSections() {
        $this->form_validation->set_rules('name', 'Название товара', 'required');
        $this->form_validation->set_rules('slug', 'Алиас');
        $this->form_validation->set_rules('description', 'Краткое описание');
        $this->form_validation->set_rules('meta_title', 'Мета-тег: Заголовок');
        $this->form_validation->set_rules('meta_keywords', 'Мета-тег: Ключевые слова');
        $this->form_validation->set_rules('meta_description', 'Мета-тег: Описание');
    }

    private function setRulesCommercials() {
        $this->form_validation->set_rules('title', 'Название товара');
        $this->form_validation->set_rules('comm_group', 'Группа предложений');
        $this->form_validation->set_rules('price', 'Цена', 'required|trim');
        $this->form_validation->set_rules('content', 'Содержимое');
        $this->form_validation->set_rules('full_content', 'Полное содержимое');
        $this->form_validation->set_rules('meta_title', 'Мета-тег: Заголовок');
        $this->form_validation->set_rules('meta_keywords', 'Мета-тег: Ключевые слова');
        $this->form_validation->set_rules('meta_description', 'Мета-тег: Описание');
    }

    private function setRulesCommercialGroups() {
        $this->form_validation->set_rules('section', 'Раздел', 'required');
        $this->form_validation->set_rules('title', 'Название группы', 'required');
        $this->form_validation->set_rules('content', 'Содержимое');
        $this->form_validation->set_rules('img', 'Изображение');
        $this->form_validation->set_rules('meta_title', 'Мета-тег: Заголовок');
        $this->form_validation->set_rules('meta_keywords', 'Мета-тег: Ключевые слова');
        $this->form_validation->set_rules('meta_description', 'Мета-тег: Описание');
    }

    /* ============== */
    /* === CREATE === */
    /* ============== */

    private function createPattern($what, $success_message, $error_message, $s = FALSE) {
        $set_rules_method      = 'setRules' . $what . $s;
        $launch_page_method    = 'launch' . $what . $s . 'Page';
        $create_element_method = 'create' . $what . 'Element';

        $repeat = FALSE;
        $this->$set_rules_method();
        if ($this->form_validation->run() === FALSE) {
            $repeat = TRUE;
        } else {
            if ($this->catalog_model->$create_element_method()) {
                $this->data['messages']['success_message'] = $success_message;
            } else {
                $this->data['messages']['error_message'] = $error_message;
                $repeat = TRUE;
            }
        }
        $this->$launch_page_method(FALSE, $repeat);
    }

    private function createSectionElement() {
        $this->createPattern('section', 'Секция успешно добавлена', 'Секция не добавлена', 's');
    }

    private function createGroupElement() {
        $this->createPattern('group', 'Группа товаров успешно добавлена', 'Группа товаров не добавлена', 's');
    }

    private function createCatalogElement() {
        $this->createPattern('catalog', 'Товар успешно добавлен', 'Товар не добавлен');
    }

    private function createCommercialGroupElement() {
        $this->createPattern('commercialgroup', 'Группа коммерческих предложений успешно добавлена', 'Группа коммерческих предложений не добавлена', 's');
    }

    private function createCommercialElement() {
        $this->createPattern('commercial', 'Коммерческое предложение успешно добавлено', 'Коммерческое предложение не добавлено', 's');
    }

    /* ============== */
    /* ===  EDIT  === */
    /* ============== */

    private function editPattern($id, $what, $success_message, $error_message, $s = FALSE) {
        $set_rules_method      = 'setRules' . $what . $s;
        $launch_page_method    = 'launch' . $what . $s . 'Page';
        $edit_element_method = 'edit' . $what . 'Element';

        $repeat = FALSE;
        $this->$set_rules_method();
        if ($this->form_validation->run() === FALSE) {
            $repeat = TRUE;
        } else {
            if ($this->catalog_model->$edit_element_method($id)) {
                $this->data['messages']['success_message'] = $success_message;
            } else {
                $this->data['messages']['error_message'] = $error_message;
                $repeat = TRUE;
            }
        }
        $this->$launch_page_method($id, $repeat);
    }

    private function editSectionElement($id) {
        $this->editPattern($id, 'section', 'Секция товаров успешно изменена', 'Секция товаров не изменена', 's');
    }

    private function editGroupElement($id) {
        $this->editPattern($id, 'group', 'Группа товаров успешно изменена', 'Группа товаров не изменена', 's');
    }

    private function editCatalogElement($id) {
        $this->editPattern($id, 'catalog', 'Товар успешно изменен', 'Товар не изменен');
    }

    private function editCommercialGroupElement($id) {
        $this->editPattern($id, 'commercialgroup', 'Группа коммерческих предложений успешно отредактирована', 'Группа коммерческих предложений не отредактирована', 's');
    }

    private function editCommercialElement($id) {
        $this->editPattern($id, 'commercial', 'Коммерческое предложение успешно отредактировано', 'Коммерческое предложение не отредактировано', 's');
    }

    /* ============== */
    /* === DELETE === */
    /* ============== */

    private function deletePattern($id, $what, $success_message, $error_message, $s = FALSE) {
        $launch_page_method    = 'launch' . $what . $s . 'Page';
        $delete_element_method = 'delete' . $what . 'Element';

        if ($this->catalog_model->$delete_element_method($id)) {
            $this->data['messages']['success_message'] = $success_message;
        } else {
            $this->data['messages']['error_message'] = $error_message;
        }
        $this->$launch_page_method();
    }

    private function deleteSectionElement($id) {
        $this->editPattern($id, 'section', 'Секция товаров успешно удалена', 'Секция товаров не удалена', 's');
    }
    private function deleteGroupElement($id) {
        $this->editPattern($id, 'group', 'Группа товаров успешно удалена', 'Группа товаров не удалена', 's');
    }
    private function deleteCatalogElement($id) {
        $this->editPattern($id, 'catalog', 'Товар успешно удален', 'Товар не удален');
    }
    private function deleteCommercialGroupElement($id) {
        $this->deletePattern($id, 'commercialgroup', 'Группа коммерческих предложений успешно удалена', 'Группа коммерческих предложений не удалена', 's');
    }
    private function deleteCommercialElement($id) {
        $this->deletePattern($id, 'commercial', 'Коммерческое предложение успешно удалено', 'Коммерческое предложение не удалено', 's');
    }

}
