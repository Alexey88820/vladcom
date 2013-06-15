<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {

    const SALT1 = 'xit58s';
    const SALT2 = 'y6gbvs';

    public function __construct() {
        $this->load->database();
    }

    public function getUser($id) {
        $this->db->select('id, username, hash, description, last_entrance');
        $query = $this->db->get_where('users', array('id' => $id));

        return $query->row_array();
    }

    public function getUsers() {
        $this->db->select('id, username, hash, description, last_entrance');
        $query = $this->db->get('users');

        return $query->result_array();
    }

    public function getEmptyFields() {
        $fields = $this->db->list_fields('users');
        foreach ($fields as $value) {
            $result[$value] = '';
        }
        return $result;
    }

    public function hashPassword($password) {
        $hash = sha1(self::SALT1 . md5($password) . self::SALT2);
        return $hash;
    }

    public function login($username, $password) {
        $this->db->select('id, username, hash, description');
        $this->db->from('users');
        $this->db->where('username', $username);
        $this->db->where('hash', $this->hashPassword($password));
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows()==1) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function createUser() {
        $data = array(
                'username' => $this->input->post('username'),
                'hash' => $this->hashPassword($this->input->post('password')),
                'description' => $this->input->post('description')
            );
        $this->db->insert('users', $data);
    }

    public function editUser($id) {
        $data = array(
                'username' => $this->input->post('username'),
                'hash' => $this->hashPassword($this->input->post('password')),
                'description' => $this->input->post('description')
            );

        $this->db->where('id', $id);
        $this->db->update('users', $data);
    }

    public function deleteUser($id) {
        $this->db->delete('users', array('id' => $id));
    }

}
