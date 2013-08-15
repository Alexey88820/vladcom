<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends Frontend_Controller {

    function __construct() {
        parent::__construct();

        // $this->load->library('form_validation');
        $this->load->helper(array('form'));

        $this->load->model('meta_model');
        $this->load->model('main_model');
        $this->load->model('categories_model');

        $this->form_messages['success_message']  = NULL;
        $this->form_messages['error_message']    = NULL;
    }

    function index() {

        // $this->load->view('login_view');

        $data['meta']   = $this->meta_model->getStaffMeta();
        $data['header'] = $this->main_model->getMainContent();
        $data['nav'] = $this->categories_model->getActiveNavigation(get_class($this));
        $data['messages'] = $this->form_messages;

        view_loader($data,
                    array(
                        array(0 => '', 1 => 'login_view')
                        ));



    }

}

?>