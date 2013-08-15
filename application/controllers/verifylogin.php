<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends Frontend_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library('session');

        $this->load->model('users_model');
    }

    public function index() {
        $this->form_validation->set_rules('username', 'Логин', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Пароль', 'trim|required|xss_clean|callback_check_database');

        if ($this->form_validation->run() == FALSE) {
            redirect('login', 'refresh');
        } else {
            redirect('staff', 'refresh');
        }
    }

    public function check_database($password) {
        $username = $this->input->post('username');

        $result = $this->users_model->login($username, $password);

        if ($result) {
            $sess_array = array();
            foreach ($result as $row) {
                $sess_array = array(
                    'id'            => $row->id,
                    'username'      => $row->username,
                    'description'   => $row->description
                );
                $this->session->set_userdata('logged_in', $sess_array);
            }
            return TRUE;
        } else {
            $this->form_validation->set_message('check_database', 'Invalid username or password');
            return FALSE;
        }
    }

}

?>