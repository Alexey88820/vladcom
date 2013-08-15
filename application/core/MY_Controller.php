<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
}

class MY_Staff_Controller extends CI_Controller {

    function __construct() {
        // session_start();
        parent::__construct();

        $this->load->library('session');
        $this->load->library('form_validation');

        $this->_auth_checking();
    }

    public function _auth_checking() {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            // $this->load->view('home_view', $data);
        } else {
            redirect('login');
        }
    }
}

?>