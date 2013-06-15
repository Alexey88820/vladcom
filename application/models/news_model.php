<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends CI_Model {

    const DB_NEWS = 'news';

    public function __construct() {
        $this->load->database();
    }

    public function getEmptyFields() {
        $fields = $this->db->list_fields(self::DB_NEWS);
        foreach ($fields as $value) {
            $result[$value] = '';
        }
        return $result;
    }

    public function getLimitNewsList($limit = FALSE) {
        if ($limit===FALSE) {
            $this->db->order_by("create_date", "desc");
            $query = $this->db->get_where(self::DB_NEWS, array('active' => 1));
            return $query->result_array();
        }

        $this->db->limit($limit);
        $this->db->order_by("create_date", "desc");
        $query = $this->db->get_where(self::DB_NEWS, array('active' => 1));
        return $query->result_array();
    }

    public function getLimitNews() {

    }

    public function getOneNewsById($id = FALSE) {
        $query = $this->db->get_where(self::DB_NEWS, array('id' => $id));
        return $query->row_array();
    }

    public function getAllNews($id = FALSE) {

    }

    public function checkId($id) {
        $query = $this->db->get_where(self::DB_NEWS, array('id' => $id, 'active' => 1));
        $row = $query->row_array();
        if (!empty($row)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function createNews() {
        // $slug = url_title($this->input->post('title'), 'dash', TRUE);

        $data = array(
            'header' => $this->input->post('header'),
            'create_date' => date('Y-m-d h:i:s'),
            'text' => $this->input->post('text')
        );

        return $this->db->insert(self::DB_NEWS, $data);
    }

    public function editNews($id) {
        $data = array(
               'header' => $this->input->post('header'),
               'edit_date' => date('Y-m-d h:i:s'),
               'text' => $this->input->post('text')
            );

        $this->db->where('id', $id);
        $this->db->update(self::DB_NEWS, $data);
    }

    public function deleteNews($id) {
        $this->db->delete(self::DB_NEWS, array('id' => $id));
    }

}