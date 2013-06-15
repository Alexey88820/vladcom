<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Meta_model extends CI_Model {

    public function __construct() {
        parent::__construct();

        $this->main_meta = $this->getMainMeta();
    }

    public function getStaffMeta() {
        $row['meta_title']       = 'Владком. Админка';
        $row['meta_keywords']    = '';
        $row['meta_description'] = '';

        return $row;
    }

    public function getMainMeta() {
        $this->db->select('meta_title, meta_keywords, meta_description');
        $query = $this->db->get_where('categories', array('name' => 'main'));
        $row = $query->row_array();

        return $row;
    }

    public function getCategoryMeta($category_name) {
        $this->db->select('meta_title, meta_keywords, meta_description');
        $query = $this->db->get_where('categories', array('name' => $category_name));
        $row = $query->row_array();

        foreach ($row as $key => $value) {
            if (empty($value)) {
                $row[$key] = $this->main_meta[$key];
            }
        }

        return $row;
    }

    public function getElementMeta($uid = FALSE, $tablename = FALSE, $category_name = FALSE) {



        if (($uid===FALSE) || ($tablename===FALSE)) {
            return NULL;
        }

        if (is_numeric($uid)) {
            $field = 'id';
        } else {
            $field = 'slug';
        }

        $this->db->select('meta_title, meta_keywords, meta_description');
        $query = $this->db->get_where($tablename, array($field => $uid));
        $row = $query->row_array();

        if ($category_name!==FALSE) {
            $common_meta = $this->getCategoryMeta($category_name);
            if (empty($common_meta)) {
                $common_meta = $this->main_meta;
            }
        } else {
            $common_meta = $this->main_meta;
        }

        foreach ($row as $key => $value) {
            if (empty($value)) {
                $row[$key] = $common_meta[$key];
            }
        }

        return $row;
    }

    public function getLastModifiedDataOfElement($uid, $tablename) {
        if (is_numeric($uid)) {
            $field = 'id';
        } else {
            $field = 'slug';
        }

        $this->db->select('edit_date');
        $this->db->limit(1);
        $this->db->order_by('edit_date', 'desc');
        $query = $this->db->get_where($tablename, array($field => $uid));
        $row = $query->row_array();

        if (!isset($row['edit_date'])) {
            return NULL;
        }

        return $row['edit_date'];
    }

    public function getLastModifiedData($tablename, $field = FALSE, $value = FALSE) {

        if (($field===FALSE) && ($value===FALSE)) {

            $this->db->select('edit_date');
            $this->db->limit(1);
            $this->db->order_by('edit_date', 'desc');
            $query = $this->db->get($tablename);
            $row = $query->row_array();

            if (!isset($row['edit_date'])) {
                return NULL;
            }

            return $row['edit_date'];
        }

        $this->db->select('edit_date');
        $this->db->limit(1);
        $this->db->order_by('edit_date', 'desc');
        $query = $this->db->get_where($tablename, array($field => $value));
        $row = $query->row_array();

        if (!isset($row['edit_date'])) {
            return NULL;
        }

        return $row['edit_date'];
    }

    public function getLastModifiedInfoOfPage($category = FALSE, $uids = FALSE) {

        $delay = mt_rand(2000,10000); // случайная задержка
        // header('Last-Modified: '.gmdate('D, d M Y H:i:s \G\M\T', time()-$num));
        $this->output->set_header('Last-Modified: ' . gmdate('D, d M Y H:i:s\G\M\T', time() - $delay) . ' GMT');

        return FALSE;

        $datetime = array();

        $datetime[] = $this->getLastModifiedData('main');

        if ($category!==FALSE) {
            $datetime[] = $this->getLastModifiedData('categories', 'name', $category);
        }

        if ($category=='main') {
            $datetime[] = $this->getLastModifiedData('categories', 'name', $category);
            $datetime[] = $this->getLastModifiedData('blocks');
            $datetime[] = $this->getLastModifiedData('news');
        }

        if ($uids!==FALSE) {
            foreach ($uids as $tablename => $uid) {
                $datetime[] = $this->getLastModifiedDataOfElement($uid, $tablename);
            }
        }


        // if ($group!==FALSE) {
        //     $datetime[] = $this->getLastModifiedData('c_groups', 'slug', $group);
        // }

        // if (($category=='catalog') && ($group=='all')) {
        //     $datetime[] = $this->getLastModifiedData('c_catalog');
        // }

        // echo "<pre>";
        //     var_dump($datetime);
        // echo "</pre>";

        $datetime = max($datetime);

        // echo $datetime;

        $datetime = convertDatetimeToUnix($datetime);

        $IfModifiedSince = NULL;

        if (isset($_ENV['HTTP_IF_MODIFIED_SINCE'])) {
            $IfModifiedSince = strtotime(substr($_ENV['HTTP_IF_MODIFIED_SINCE'], 5));
        }
        if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])) {
            $IfModifiedSince = strtotime(substr($_SERVER['HTTP_IF_MODIFIED_SINCE'], 5));
        }
        if ($IfModifiedSince && $IfModifiedSince >= $datetime) {
            $this->output->set_header($_SERVER['SERVER_PROTOCOL'] . ' 304 Not Modified');
        }

        $this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s', $datetime).' GMT');

        return FALSE;
    }

}
