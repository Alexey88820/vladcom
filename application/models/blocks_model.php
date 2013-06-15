<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blocks_model extends CI_Model {

    const DB_BLOCKS = 'blocks';

    public function __construct() {
        $this->load->database();
    }

    public function getEmptyFields() {
        $fields = $this->db->list_fields(self::DB_BLOCKS);
        foreach ($fields as $value) {
            $result[$value] = '';
        }
        return $result;
    }

    public function getBlockIdByName($name) {
        $this->db->select('id');
        $query = $this->db->get_where(self::DB_BLOCKS, array('name' => $name));
        $rows = $query->row_array();

        return $rows['id'];
    }

    public function getBlock($id) {
        $query = $this->db->get_where(self::DB_BLOCKS, array('id' => $id));
        return $query->row_array();
    }

    public function getBlocks() {
        $this->db->select('id, page, name, description, text');
        $query = $this->db->get(self::DB_BLOCKS);
        return $query->result_array();
    }

    public function createBlock() {
        $data = array(
                'page'        => $this->input->post('page'),
                'name'        => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'text'        => $this->input->post('text'),
                'create_date' => date('Y-m-d H:i:s'),
                'edit_date'   => date('Y-m-d H:i:s')
            );
        return $this->db->insert(self::DB_BLOCKS, $data);
    }

    public function editBlock($id) {
        $data = array(
                'page'        => $this->input->post('page'),
                'name'        => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'text'        => $this->input->post('text'),
                'edit_date'   => date('Y-m-d H:i:s')
            );
        $this->db->where('id', $id);
        return $this->db->update(self::DB_BLOCKS, $data);
    }

    public function deleteBlock($id) {
        $this->db->delete(self::DB_BLOCKS, array('id' => $id));
    }

}