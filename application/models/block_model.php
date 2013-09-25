<?php
class Block_Model extends MY_Model
{
    protected $_table_name = 'blocks';
    protected $_order_by = 'id';
    protected $_timestamps = true;
    public $rules = array(
        'slug' => array(
            'field' => 'slug',
            'label' => 'Идентификатор блока',
            'rules' => 'trim|required|max_length[100]|callback__unique_slug|xss_clean'
        ),
        'title' => array(
            'field' => 'title',
            'label' => 'Описание',
            'rules' => 'trim|required|max_length[50]|xss_clean'
        ),
        'body' => array(
            'field' => 'body',
            'label' => 'Содержимое',
            'rules' => 'trim|required'
        )
    );

    public function get_new ()
    {
        $block = new stdClass();

        $block->slug     = '';
        $block->title      = '';
        $block->body      = '';

        return $block;
    }


}