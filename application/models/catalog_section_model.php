<?php
class Catalog_Section_Model extends MY_Model
{
    protected $_table_name = 'catalog_sections';
    protected $_order_by = 'order, title';
    protected $_timestamps = true;
    public $rules = array(
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
            'label' => 'Изображение секции',
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
        $catalog_section              = new stdClass();

        $catalog_section->slug             = '';
        $catalog_section->title            = '';
        $catalog_section->body             = '';
        $catalog_section->img              = '';
        $catalog_section->annotation       = '';
        $catalog_section->meta_index       = '';
        $catalog_section->meta_title       = '';
        $catalog_section->meta_keywords    = '';
        $catalog_section->meta_description = '';

        return $catalog_section;
    }

    public function save_order ($catalog_section)
    {
        if (count($catalog_section)) {
            foreach ($catalog_section as $order => $item) {
                if ($item['item_id'] != '') {
                    $data = array('order' => $order);
                    $this->db->set($data)->where($this->_primary_key, $item['item_id'])->update($this->_table_name);
                }
            }
        }
    }

}