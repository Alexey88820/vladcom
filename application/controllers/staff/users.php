<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Staff_Controller {

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
        $this->load->model('users_model');

        $this->form_messages['success_message']  = NULL;
        $this->form_messages['error_message']    = NULL;
    }

    public function index($id = FALSE) {

        $data['meta']   = $this->meta_model->getStaffMeta();
        $data['messages'] = $this->form_messages;

        if ($id===FALSE) {
            $data['form_values'] = $this->users_model->getEmptyFields();
            $data['form_values']['button'] = 'Создать пользователя';
            $data['operation'] = 'create';
        } else {
            $data['form_values'] = $this->users_model->getUser($id);
            $data['form_values']['button'] = 'Изменить пользователя';
            $data['operation'] = 'edit/' . $id;
        }

        $data['list_values'] = $this->users_model->getUsers();

        staff_view_loader($data,
                    array(
                        array(0 => 'staff/users', 1 => 'users_form'),
                        array(0 => 'staff/users', 1 => 'users_list')
                        ));
    }

    public function create() {

        $this->form_validation->set_rules('username', 'Логин');
        $this->form_validation->set_rules('password', 'Пароль');
        $this->form_validation->set_rules('description', 'Описание');

        if ($this->form_validation->run() === FALSE) {

        } else {
            $this->users_model->createUser();
        }
        $this->index();
    }

    public function edit($id = NULL) {

        $this->form_validation->set_rules('username', 'Логин');
        $this->form_validation->set_rules('password', 'Пароль');
        $this->form_validation->set_rules('description', 'Описание');

        if ($this->form_validation->run() === FALSE) {

        } else {
            $this->users_model->editUser($id);
        }
        $this->index($id);
    }

    public function delete($id) {
        $this->users_model->deleteUser($id);
        $this->index();
    }

    public function logout() {
        $this->session->unset_userdata('logged_in');
        // session_destroy();
        redirect('staff', 'refresh');
    }

}