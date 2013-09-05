<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends MY_Staff_Controller {

    public $data;

    public function __construct() {
        parent::__construct();

        $this->load->model('meta_model');
        $this->load->model('categories_model');

        $this->form_messages['success_message']  = NULL;
        $this->form_messages['error_message']    = NULL;
    }

    public function index($id = FALSE) {

        $data['meta']   = $this->meta_model->getStaffMeta();
        $data['messages'] = $this->form_messages;

        if ($id===FALSE) {
            $data['form_values'] = $this->categories_model->getEmptyFields();
            $data['form_values']['button'] = 'Создать категорию';
            $data['operation'] = 'create';
        } else {
            $data['form_values'] = $this->categories_model->getCategory($id);
            $data['form_values']['button'] = 'Изменить категорию';
            $data['operation'] = 'edit/' . $id;
        }

        $data['list_values'] = $this->categories_model->getCategories();

        staff_view_loader($data,
                    array(
                        array(0 => 'staff/categories', 1 => 'categories_form'),
                        array(0 => 'staff/categories', 1 => 'categories_list')
                        ));
    }

    public function create() {

        $this->form_validation->set_rules('name', 'Название категории');
        $this->form_validation->set_rules('title', 'Заголовок');
        $this->form_validation->set_rules('description', 'Краткое описание');
        $this->form_validation->set_rules('content', 'Содержимое');
        $this->form_validation->set_rules('meta_title', 'Мета-тег: Заголовок');
        $this->form_validation->set_rules('meta_keywords', 'Мета-тег: Ключевые слова');
        $this->form_validation->set_rules('meta_description', 'Мета-тег: Описание');

        if ($this->form_validation->run() === FALSE) {

        } else {
            $this->categories_model->createCategory();
        }
        $this->index();
    }

    public function edit($id = NULL) {

        $this->form_validation->set_rules('name', 'Название категории');
        $this->form_validation->set_rules('title', 'Заголовок');
        $this->form_validation->set_rules('description', 'Краткое описание');
        $this->form_validation->set_rules('content', 'Содержимое');
        $this->form_validation->set_rules('meta_title', 'Мета-тег: Заголовок');
        $this->form_validation->set_rules('meta_keywords', 'Мета-тег: Ключевые слова');
        $this->form_validation->set_rules('meta_description', 'Мета-тег: Описание');

        if ($this->form_validation->run() === FALSE) {

        } else {
            $this->categories_model->editCategory($id);
        }
        $this->index($id);
    }

    public function delete($id) {
        $this->categories_model->deleteCategory($id);
        $this->index();
    }

}