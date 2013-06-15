<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MY_Staff_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('main_model');
        $this->load->model('meta_model');

        $this->form_messages['success_message']  = NULL;
        $this->form_messages['error_message']    = NULL;
    }


    public function index() {
        $data['meta']   = $this->meta_model->getStaffMeta();
        $data['messages'] = $this->form_messages;

        $data['form_values'] = $this->main_model->getMainContent();
        $data['form_values']['button'] = 'Редактировать основную информацию';

        $data['operation'] = 'edit';

        staff_view_loader($data,
                    array(
                        array(0 => 'staff/main', 1 => 'main_form')
                    )
        );
    }

    public function edit() {
        $this->form_validation->set_rules('site_name', 'Название компании', 'trim');
        $this->form_validation->set_rules('site_description', 'Краткое описание', 'trim');
        $this->form_validation->set_rules('phone1', 'Телефон 1');
        $this->form_validation->set_rules('phone2', 'Телефон 2');
        $this->form_validation->set_rules('email', 'Email', 'trim');

        if ($this->form_validation->run() === FALSE) {
            redirect('staff/main');
        } else {
            $this->main_model->editMainInformation();
            redirect('staff/main');
        }
    }



}