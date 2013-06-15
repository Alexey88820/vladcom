<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blocks extends MY_Staff_Controller {

    // $data['meta']
    // $data['header']
    // $data['nav']
    // $data['content']
    public $data;

    public function __construct() {
        parent::__construct();

    // $data['meta']
    // $data['header']
    // $data['nav']
    // $data['content']

        $this->load->model('meta_model');
        $this->load->model('blocks_model');

        $this->form_messages['success_message']  = NULL;
        $this->form_messages['error_message']    = NULL;
    }

    public function index($id = FALSE) {

        $data['meta']   = $this->meta_model->getStaffMeta();
        $data['messages'] = $this->form_messages;

        if ($id===FALSE) {
            $data['form_values'] = $this->blocks_model->getEmptyFields();
            $data['form_values']['button'] = 'Создать блок';
            $data['operation'] = 'create';
        } else {
            $data['form_values'] = $this->blocks_model->getBlock($id);
            $data['form_values']['button'] = 'Изменить блок';
            $data['operation'] = 'edit/' . $id;
        }


        $data['list_values'] = $this->blocks_model->getBlocks();

        staff_view_loader($data,
                    array(
                        array(0 => 'staff/blocks', 1 => 'blocks_form'),
                        array(0 => 'staff/blocks', 1 => 'blocks_list')
                        ),
                    TRUE);
    }

    public function create() {

        $this->form_validation->set_rules('page', 'Имя страницы');
        $this->form_validation->set_rules('name', 'Название блока');
        $this->form_validation->set_rules('description', 'Краткое описание');
        $this->form_validation->set_rules('text', 'Содержимое');

        if ($this->form_validation->run() === FALSE) {

        } else {
            $this->blocks_model->createBlock();
            // redirect('staff/blocks/');
        }

        $this->index();
    }

    public function edit($id = NULL) {

        $this->form_validation->set_rules('page', 'Имя страницы');
        $this->form_validation->set_rules('name', 'Название блока');
        $this->form_validation->set_rules('description', 'Краткое описание');
        $this->form_validation->set_rules('text', 'Содержимое');

        if ($this->form_validation->run() === FALSE) {

        } else {
            $this->blocks_model->editBlock($id);
        }
        $this->index($id);
    }

    public function delete($id) {
        $this->news_model->deleteBlock($id);
        $this->index();
    }


}