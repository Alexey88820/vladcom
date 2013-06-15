<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model {

    public function __construct() {
        // $this->load->database();
    }

    public function getMainContent() {
        $this->db->select('site_name, site_description, phone1, phone2, phone3, email');
        $query = $this->db->get('main');
        return $query->row_array();
    }

    public function editMainInformation() {
        $data = array(
               'site_name' => $this->input->post('site_name'),
               'site_description' => $this->input->post('site_description'),
               'phone1' => $this->input->post('phone1'),
               'phone2' => $this->input->post('phone2'),
               'email' => $this->input->post('email'),
               'edit_date' => date('Y-m-d H:i:s')
            );
        $this->db->where('id', 1);
        $this->db->update('main', $data);
    }
}