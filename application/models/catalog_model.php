<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalog_model extends CI_Model {

    const DB_SECTIONS           = 'c_sections';
    const DB_GROUPS             = 'c_groups';
    const DB_CATALOG            = 'c_catalog';
    const DB_COMMERCIALS        = 'c_commercials';
    const DB_COMMERCIALS_GROUPS = 'c_commercials_groups';

    public function __construct() {
        $this->load->database();
        $this->leaders = array(47, 6, 103, 104);
    }

    public function getDbSectionsName() {
        return self::DB_SECTIONS;
    }
    public function getDbGroupsName() {
        return self::DB_GROUPS;
    }
    public function getDbCatalogName() {
        return self::DB_CATALOG;
    }
    public function getDbComercialsName() {
        return self::DB_COMMERCIALS;
    }
    public function getDbComercialsGroupsName() {
        return self::DB_COMMERCIALS_GROUPS;
    }

    public function getElement($uid, $tablename) {
        if (is_numeric($uid)) {
            $field = 'id';
        } else {
            $field = 'slug';
        }

        $query = $this->db->get_where($tablename, array($field => $uid));
        return $query->row_array();
    }


    public function getSectionElements() {
        $this->db->select('id, slug, img, annotation, name');
        $query = $this->db->get(self::DB_SECTIONS);
        return $query->result_array();
    }

    public function getGroupElements() {
        $this->db->select('id, section, slug, name');
        $query = $this->db->get(self::DB_GROUPS);
        return $query->result_array();
    }
    public function getGroupElementsOfSection($section_id) {
        $this->db->select('id, section, slug, name, invisible');
        $query = $this->db->get_where(self::DB_GROUPS, array('section' => $section_id));
        return $query->result_array();
    }
    public function getGroupsWithSectionsKeys() {
        $sections = $this->getSectionElements();

        $this->db->select('id, section, invisible, slug, name');
        $this->db->order_by("id", "asc");
        $query = $this->db->get(self::DB_GROUPS);
        $result = $query->result_array();

        $groups = array();

        foreach ($sections as $section) {
            $groups[$section['id']] = $this->getGroupElementsOfSection($section['id']);
        }

        return $groups;
    }

    public function getCatalogElements() {
        $this->db->select('id, name, group, price, slug, description, create_date, edit_date');
        $this->db->order_by("create_date", "desc");
        $query = $this->db->get_where(self::DB_CATALOG, array('active' => 1));

        return $query->result_array();
    }
    public function getCatalogElementsOfSection($section_id) {

    }
    public function getCatalogElementsOfGroup($group_id) {
        $this->db->select('id, group, price, slug, name, description');
        $query = $this->db->get_where(self::DB_CATALOG, array('group' => $group_id));
        return $query->result_array();
    }

    public function getCommercialGroupElements() {
        $this->db->select('id, slug, section, title, img, create_date, edit_date');
        $this->db->order_by("title", "asc");
        $query = $this->db->get(self::DB_COMMERCIALS_GROUPS);

        return $query->result_array();
    }

    public function getCommercialElements() {
        $this->db->select('id, slug, comm_group, title, price, create_date, edit_date');
        $this->db->order_by("title", "asc");
        $query = $this->db->get(self::DB_COMMERCIALS);

        return $query->result_array();
    }

    public function getLeaders() {
        foreach ($this->leaders as $id) {
            $leaders[$id] = $this->getElement($id, $this->getDbCatalogName());
            $group = $this->getElement($leaders[$id]['group'], $this->getDbGroupsName());
            $leaders[$id]['img'] = $group['img'];
        }

        return $leaders;
    }


    public function getEmptyFields($tablename) {
        $fields = $this->db->list_fields($tablename);
        foreach ($fields as $value) {
            $result[$value] = '';
        }
        return $result;
    }

    public function getIdElementBySlug($slug, $tablename) {
        $this->db->select('id');
        $query = $this->db->get_where($tablename, array('slug' => $slug));
        $row = $query->row_array();
        if (isset($row)) {
            return $row['id'];
        }
        return NULL;
    }

    public function checkSlug($slug = FALSE) {
        if (!empty($slug)) {
            $check_slug = array();

            $tables = array(self::DB_SECTIONS, self::DB_GROUPS, self::DB_CATALOG);
            foreach ($tables as $value) {
                $this->db->select('id');
                $query = $this->db->get_where($value, array('slug' => $slug));
                $row = $query->row_array();
                if (isset($row['id'])) {
                    $check_slug[] = $row['id'];
                }
            }

            if (empty($check_slug)) {
                return FALSE;
            }

        } else {
            return FALSE;
        }

        return TRUE;
    }

    public function getElementTypeBySlug($slug) {
        $information = array();

        // get section
        $query = $this->db->get_where(self::DB_SECTIONS, array('slug' => $slug));
        $information['section'] = $query->row_array();
        // get group
        $query = $this->db->get_where(self::DB_GROUPS, array('slug' => $slug));
        $information['group'] = $query->row_array();
        // get catalog
        $query = $this->db->get_where(self::DB_CATALOG, array('slug' => $slug));
        $information['catalog'] = $query->row_array();
        // get commercial
        $query = $this->db->get_where(self::DB_COMMERCIALS, array('slug' => $slug));
        $information['commercial'] = $query->row_array();
        // get commercial group
        $query = $this->db->get_where(self::DB_COMMERCIALS_GROUPS, array('slug' => $slug));
        $information['commercial_group'] = $query->row_array();

        // var_dump($slug);

        return $information;
    }

    public function checkDublicateSlugs() {

    }

    public function setSlugFromName($name = FAlSE) {
        if (empty($name)) {
            return FALSE;
        }
        $this->load->helper('my_transliteration_helper');
        $slug = transliteration($name);

        return $slug;
    }


    // ============= OPERATIONS ==============

    /* --- SectionElement --- */

    public function createSectionElement() {
        $slug = strtolower($this->input->post('slug'));
        if (empty($slug)) {
            $slug = $this->setSlugFromName($this->input->post('name'));
        }
        $data = array(
                'name'             => $this->input->post('name'),
                'slug'             => $slug,
                'description'      => $this->input->post('description'),
                'meta_title'       => $this->input->post('meta_title'),
                'meta_description' => $this->input->post('meta_description'),
                'meta_keywords'    => $this->input->post('meta_keywords'),
                'create_date'      => date('Y-m-d H:i:s'),
                'edit_date'        => date('Y-m-d H:i:s')
            );
        return $this->db->insert(self::DB_SECTIONS, $data);
    }
    public function editSectionElement($id) {
        $slug = strtolower($this->input->post('slug'));
        if (empty($slug)) {
            $slug = $this->setSlugFromName($this->input->post('name'));
        }
        $data = array(
                'name'             => $this->input->post('name'),
                'slug'             => $slug,
                'description'      => $this->input->post('description'),
                'meta_title'       => $this->input->post('meta_title'),
                'meta_description' => $this->input->post('meta_description'),
                'meta_keywords'    => $this->input->post('meta_keywords'),
                'edit_date'        => date('Y-m-d H:i:s')
            );
        $this->db->where('id', $id);
        return $this->db->update(self::DB_SECTIONS, $data);
    }
    public function deleteSectionElement($id) {
        return $this->db->delete(self::DB_SECTIONS, array('id' => $id));
    }

    /* --- GroupElement --- */

    public function createGroupElement() {
        $slug = strtolower($this->input->post('slug'));
        if (empty($slug)) {
            $slug = $this->setSlugFromName($this->input->post('name'));
        }
        $data = array(
                'name'             => $this->input->post('name'),
                'slug'             => $slug,
                'section'          => $this->input->post('section'),
                'description'      => $this->input->post('description'),
                'meta_title'       => $this->input->post('meta_title'),
                'meta_description' => $this->input->post('meta_description'),
                'meta_keywords'    => $this->input->post('meta_keywords'),
                'create_date'      => date('Y-m-d H:i:s'),
                'edit_date'        => date('Y-m-d H:i:s')
            );
        return $this->db->insert(self::DB_GROUPS, $data);
    }
    public function editGroupElement($id) {
        $slug = strtolower($this->input->post('slug'));
        if (empty($slug)) {
            $slug = $this->setSlugFromName($this->input->post('name'));
        }
        $data = array(
                'name'             => $this->input->post('name'),
                'slug'             => $slug,
                'section'          => $this->input->post('section'),
                'description'      => $this->input->post('description'),
                'meta_title'       => $this->input->post('meta_title'),
                'meta_description' => $this->input->post('meta_description'),
                'meta_keywords'    => $this->input->post('meta_keywords'),
                'edit_date'        => date('Y-m-d H:i:s')
            );

        $this->db->where('id', $id);
        return $this->db->update(self::DB_GROUPS, $data);
    }
    public function deleteGroupElement($id) {
        return $this->db->delete(self::DB_GROUPS, array('id' => $id));
    }

    /* --- CatalogElement --- */

    public function createCatalogElement() {
        $slug = strtolower($this->input->post('slug'));
        if (empty($slug)) {
            $slug = $this->setSlugFromName($this->input->post('name'));
        }
        $data = array(
                'name'             => $this->input->post('name'),
                'slug'             => $slug,
                'price'            => $this->input->post('price'),
                'units'            => $this->input->post('units'),
                'group'            => $this->input->post('group'),
                'description'      => $this->input->post('description'),
                'full_description' => $this->input->post('full_description'),
                'meta_title'       => $this->input->post('meta_title'),
                'meta_description' => $this->input->post('meta_description'),
                'meta_keywords'    => $this->input->post('meta_keywords'),
                'create_date'      => date('Y-m-d H:i:s'),
                'edit_date'        => date('Y-m-d H:i:s')
            );
        return $this->db->insert(self::DB_CATALOG, $data);
    }
    public function editCatalogElement($id) {
        $slug = strtolower($this->input->post('slug'));
        if (empty($slug)) {
            $slug = $this->setSlugFromName($this->input->post('name'));
        }
        $data = array(
                'name'             => $this->input->post('name'),
                'slug'             => $slug,
                'price'            => $this->input->post('price'),
                'units'            => $this->input->post('units'),
                'group'            => $this->input->post('group'),
                'description'      => $this->input->post('description'),
                'full_description' => $this->input->post('full_description'),
                'meta_title'       => $this->input->post('meta_title'),
                'meta_description' => $this->input->post('meta_description'),
                'meta_keywords'    => $this->input->post('meta_keywords'),
                'edit_date'        => date('Y-m-d H:i:s')
            );
        $this->db->where('id', $id);
        return $this->db->update(self::DB_CATALOG, $data);
    }
    public function deleteCatalogElement($id) {
        return $this->db->delete(self::DB_CATALOG, array('id' => $id));
    }

    /* --- CommercialGroupElement --- */

    public function createCommercialGroupElement() {
        $slug = strtolower($this->input->post('slug'));
        if (empty($slug)) {
            $slug = $this->setSlugFromName($this->input->post('title'));
        }

        $data = array(
                'slug'             => $slug,
                'section'          => $this->input->post('section'),
                'title'            => $this->input->post('title'),
                'content'          => $this->input->post('content'),
                'img'              => $this->input->post('img'),
                'meta_title'       => $this->input->post('meta_title'),
                'meta_description' => $this->input->post('meta_description'),
                'meta_keywords'    => $this->input->post('meta_keywords'),
                'create_date'      => date('Y-m-d H:i:s'),
                'edit_date'        => date('Y-m-d H:i:s')
            );
        return $this->db->insert(self::DB_COMMERCIALS_GROUPS, $data);
    }
    public function editCommercialGroupElement($id) {
        $slug = strtolower($this->input->post('slug'));
        if (empty($slug)) {
            $slug = $this->setSlugFromName($this->input->post('title'));
        }

        $data = array(
                'slug'             => $slug,
                'section'          => $this->input->post('section'),
                'title'            => $this->input->post('title'),
                'content'          => $this->input->post('content'),
                'img'              => $this->input->post('img'),
                'meta_title'       => $this->input->post('meta_title'),
                'meta_description' => $this->input->post('meta_description'),
                'meta_keywords'    => $this->input->post('meta_keywords'),
                'edit_date'        => date('Y-m-d H:i:s')
            );
        $this->db->where('id', $id);
        return $this->db->update(self::DB_COMMERCIALS_GROUPS, $data);
    }
    public function deleteCommercialGroupElement($id) {
        return $this->db->delete(self::DB_COMMERCIALS_GROUPS, array('id' => $id));
    }

    /* --- CommercialElement --- */

    public function createCommercialElement() {
        $slug = strtolower($this->input->post('slug'));
        if (empty($slug)) {
            $slug = $this->setSlugFromName($this->input->post('title'));
        }

        $data = array(
                'slug'             => $slug,
                'comm_group'       => $this->input->post('comm_group'),
                'title'            => $this->input->post('title'),
                'price'            => $this->input->post('price'),
                'content'          => $this->input->post('content'),
                'full_content'     => $this->input->post('full_content'),
                'meta_title'       => $this->input->post('meta_title'),
                'meta_description' => $this->input->post('meta_description'),
                'meta_keywords'    => $this->input->post('meta_keywords'),
                'create_date'      => date('Y-m-d H:i:s'),
                'edit_date'        => date('Y-m-d H:i:s')
            );
        return $this->db->insert(self::DB_COMMERCIALS, $data);
    }
    public function editCommercialElement($id) {
        $slug = strtolower($this->input->post('slug'));
        if (empty($slug)) {
            $slug = $this->setSlugFromName($this->input->post('title'));
        }

        $data = array(
                'slug'             => $slug,
                'comm_group'       => $this->input->post('comm_group'),
                'title'            => $this->input->post('title'),
                'price'            => $this->input->post('price'),
                'content'          => $this->input->post('content'),
                'full_content'     => $this->input->post('full_content'),
                'meta_title'       => $this->input->post('meta_title'),
                'meta_description' => $this->input->post('meta_description'),
                'meta_keywords'    => $this->input->post('meta_keywords'),
                'edit_date'        => date('Y-m-d H:i:s')
            );
        $this->db->where('id', $id);
        return $this->db->update(self::DB_COMMERCIALS, $data);
    }
    public function deleteCommercialElement($id) {
        return $this->db->delete(self::DB_COMMERCIALS, array('id' => $id));
    }



/* -------------------------------------------------------------------------------------------- */

    public function getExchangeRatesCBRF($code, $date = NULL) {

        // return 1;

        $client = new SoapClient("http://www.cbr.ru/DailyInfoWebServ/DailyInfo.asmx?WSDL");
        if (!isset($date)) {
            $date = date("Y-m-d");
        }
        $curs = $client->GetCursOnDate(array("On_date" => $date));
        $this->rates = new SimpleXMLElement($curs->GetCursOnDateResult->any);

        $code1 = (int)$code;
        if ($code1!=0) {
            $result = $this->rates->xpath('ValuteData/ValuteCursOnDate/Vcode[.='.$code.']/parent::*');
        } else {
            $result = $this->rates->xpath('ValuteData/ValuteCursOnDate/VchCode[.="'.$code.'"]/parent::*');
        }

        if (!$result) {
            return false;
        } else {
            $vc = (float)$result[0]->Vcurs;
            $vn = (int)$result[0]->Vnom;
            return ($vc/$vn);
        }
    }



}

?>
