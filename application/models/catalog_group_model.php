<?php
class Catalog_Group_Model extends MY_Model
{
    protected $_table_name = 'catalog_groups';
    protected $_order_by = 'order, title';
    protected $_timestamps = true;
    public $rules = array(
        'section_id' => array(
            'field' => 'section_id',
            'label' => 'Секция',
            'rules' => 'trim|required|intval|greater_than[0]'
        ),
        'slug' => array(
            'field' => 'slug',
            'label' => 'Идентификатор',
            'rules' => 'trim|required|callback__unique_catalog_slug|max_length[200]|xss_clean'
        ),
        'title' => array(
            'field' => 'title',
            'label' => 'Заголовок',
            'rules' => 'trim|required|max_length[256]|xss_clean'
        ),
        'body' => array(
            'field' => 'body',
            'label' => 'Содержимое',
            'rules' => 'trim'
        ),
        'img' => array(
            'field' => 'img',
            'label' => 'Изображение группы',
            'rules' => 'trim|max_length[256]|xss_clean'
        ),
        'annotation' => array(
            'field' => 'annotation',
            'label' => 'Аннотация',
            'rules' => 'trim'
        ),
        'meta_index' => array(
            'field' => 'meta_index',
            'label' => 'Индексация',
            'rules' => 'trim|max_length[1]|xss_clean'
        ),
        'meta_title' => array(
            'field' => 'meta_title',
            'label' => 'Мета-теги: Title',
            'rules' => 'trim|max_length[256]|xss_clean'
        ),
        'meta_keywords' => array(
            'field' => 'meta_keywords',
            'label' => 'Мета-теги: Keywords',
            'rules' => 'trim|max_length[512]|xss_clean'
        ),
        'meta_description' => array(
            'field' => 'meta_description',
            'label' => 'Мета-теги: Description',
            'rules' => 'trim|max_length[512]|xss_clean'
        ),
    );

    public function get_new ()
    {
        $catalog_group              = new stdClass();

        $catalog_group->section_id       = '';
        $catalog_group->slug             = '';
        $catalog_group->title            = '';
        $catalog_group->body             = '';
        $catalog_group->img              = '';
        $catalog_group->annotation       = '';
        $catalog_group->meta_index       = '';
        $catalog_group->meta_title       = '';
        $catalog_group->meta_keywords    = '';
        $catalog_group->meta_description = '';

        return $catalog_group;
    }

    public function save_order ($catalog_group)
    {
        if (count($catalog_group)) {
            foreach ($catalog_group as $order => $item) {
                if ($item['item_id'] != '') {
                    $data = array('order' => $order);
                    $this->db->set($data)->where($this->_primary_key, $item['item_id'])->update($this->_table_name);
                }
            }
        }
    }



}