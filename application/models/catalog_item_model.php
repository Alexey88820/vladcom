<?php
class Catalog_Item_Model extends MY_Model
{
    protected $_table_name = 'catalog_items';
    protected $_order_by = 'order, title';
    protected $_timestamps = true;
    public $rules = array(
        'group_id' => array(
            'field' => 'group_id',
            'label' => 'Группа',
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
        'price' => array(
            'field' => 'price',
            'label' => 'Цена',
            'rules' => 'trim|max_length[32]|xss_clean'
        ),
        'units' => array(
            'field' => 'units',
            'label' => 'Единицы',
            'rules' => 'trim|max_length[32]|xss_clean'
        ),
        'body' => array(
            'field' => 'body',
            'label' => 'Содержимое',
            'rules' => 'trim'
        ),
        'img' => array(
            'field' => 'img',
            'label' => 'Изображение товара',
            'rules' => 'trim|max_length[256]|xss_clean'
        ),
        'leader' => array(
            'field' => 'leader',
            'label' => 'Добавить в лидеры продаж',
            'rules' => 'trim|max_length[1]|xss_clean'
        ),
        'ajax_group' => array(
            'field' => 'ajax_group',
            'label' => 'Открывать в новом окне',
            'rules' => 'trim|max_length[1]|xss_clean'
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
        $catalog_item              = new stdClass();

        $catalog_item->group_id         = '';
        $catalog_item->slug             = '';
        $catalog_item->title            = '';
        $catalog_item->price            = '';
        $catalog_item->units            = '';
        $catalog_item->body             = '';
        $catalog_item->img              = '';
        $catalog_item->leader           = '';
        $catalog_item->ajax_group       = 1;
        $catalog_item->meta_index       = 1;
        $catalog_item->meta_title       = '';
        $catalog_item->meta_keywords    = '';
        $catalog_item->meta_description = '';

        return $catalog_item;
    }

    public function save_order ($catalog_item)
    {
        if (count($catalog_item)) {
            foreach ($catalog_item as $order => $item) {
                if ($item['item_id'] != '') {
                    $data = array('order' => $order);
                    $this->db->set($data)->where($this->_primary_key, $item['item_id'])->update($this->_table_name);
                }
            }
        }
    }

}