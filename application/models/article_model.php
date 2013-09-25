<?php
class Article_Model extends MY_Model
{
    protected $_table_name = 'articles';
    protected $_order_by = 'created DESC';
    // protected $_order_by = 'pubdate desc, id desc';
    protected $_timestamps = TRUE;

    public $rules = array(
        'title' => array(
            'field' => 'title',
            'label' => 'Название заметки',
            'rules' => 'trim|required|max_length[100]|xss_clean'
        ),
        'body' => array(
            'field' => 'body',
            'label' => 'Текст заметки',
            'rules' => 'trim|required'
        )
    );

    public function get_new ()
    {
        $news_item = new stdClass();

        $news_item->title     = '';
        $news_item->body      = '';

        return $news_item;
    }

    public function get_recent($limit = 3)
    {
        // Fetch a limited number of recent articles
        $limit = (int) $limit;
        // $this->set_published();
        $this->db->limit($limit);

        return parent::get();
    }

}