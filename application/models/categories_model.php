<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getBreadcrumbs($data) {

        if (isset($data['category'])) {
            $category = $this->getCategory($this->getCategoryIdByName($data['category']));

            $levels[1] = $category;
            $levels[1]['link'] = base_url() . $data['category'] . '/';

            $levels[1]['name'] = $levels[1]['title'];
            unset($levels[1]['title']);
        }

        if (isset($data['group'])) {
            $this->load->model('catalog_model');
            foreach ($data['group'] as $key => $value) {
                switch ($key) {
                    case 'group':
                        $group = $this->catalog_model->getGroup($value);
                        $levels[2] = $group;
                        $levels[2]['link'] = base_url() . $data['category'] . '/' . $group['name'] . '/';
                        break;
                    case 'collection':
                        $collection = $this->catalog_model->getCollection($value);
                        $levels[2] = $collection;
                        $levels[2]['link'] = base_url() . $data['category'] . '/' . $collection['name'] . '/';
                        break;
                }
            }
        }

        return $levels;
    }

    public function getCategoryIdByName($name) {
        $this->db->select('id');
        $query = $this->db->get_where('categories', array('name' => $name));
        $row = $query->row_array();

        if (isset($row['id'])) {
            return $row['id'];
        }

        return NULL;
    }

    public function getCategoryMeta($id) {
        $this->db->select('meta_title, meta_keywords, meta_description');
        $query = $this->db->get_where('categories', array('id' => $id));

        return $query->row_array();
    }

    public function getCategoryData($id) {
        $this->db->select('id, name, title, description, content');
        $query = $this->db->get_where('categories', array('id' => $id));

        return $query->row_array();
    }

    public function getCategory($id) {
        $this->db->select('id, name, title, description, content, meta_title, meta_keywords, meta_description');
        $query = $this->db->get_where('categories', array('id' => $id));

        return $query->row_array();
    }

    public function getCategories() {
        $this->db->select('id, name, title, description, content');
        $query = $this->db->get('categories');

        return $query->result_array();
    }

    public function getEmptyFields() {
        $fields = $this->db->list_fields('categories');
        foreach ($fields as $value) {
            $result[$value] = '';
        }
        return $result;
    }

    public function getNavigation() {
        $this->db->select('name, title, description');
        $query = $this->db->get('categories');

        $result = $query->result_array();
        foreach ($result as $key => $nav_item) {
            if ('main'==$nav_item['name']) {
                $result[$key]['name'] = '';
            }
        }
        return $result;
    }

    public function getActiveNavigation($controller) {
        $this->db->select('name, title, description');
        $query = $this->db->get('categories');

        $data['nav'] = $query->result_array();

        foreach ($data['nav'] as $key => $value) {
            $keyname = $value['name'] . '_class';
            if (strtolower($controller)==$value['name']) {
                $data['nav'][$key]['active'] = TRUE;
            } else {
                $data['nav'][$key]['active'] = FALSE;
            }
        }

        foreach ($data['nav'] as $key => $nav_item) {
            if ('main'==$nav_item['name']) {
                $data['nav'][$key]['name'] = '';
            }
        }

        return $data['nav'];
    }


    public function createCategory() {
        $data = array(
                'name'             => $this->input->post('header'),
                'title'            => $this->input->post('text'),
                'description'      => $this->input->post('description'),
                'content'          => $this->input->post('content'),
                'meta_title'       => $this->input->post('meta_title'),
                'meta_description' => $this->input->post('meta_description'),
                'meta_keywords'    => $this->input->post('meta_keywords'),
                'create_date'      => date('Y-m-d h:i:s'),
                'edit_date'        => date('Y-m-d h:i:s')
            );
        return $this->db->insert('categories', $data);
    }
    public function editCategory($id) {
        $data = array(
                'name'             => $this->input->post('name'),
                'title'            => $this->input->post('title'),
                'description'      => $this->input->post('description'),
                'content'          => $this->input->post('content'),
                'meta_title'       => $this->input->post('meta_title'),
                'meta_description' => $this->input->post('meta_description'),
                'meta_keywords'    => $this->input->post('meta_keywords'),
                'create_date'      => date('Y-m-d h:i:s'),
                'edit_date'        => date('Y-m-d h:i:s')
            );
        $this->db->where('id', $id);
        return $this->db->update('categories', $data);
    }
    public function deleteCategory($id) {
        $this->db->delete('categories', array('id' => $id));
    }

}