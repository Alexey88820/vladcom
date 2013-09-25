<?php
class Page_Model extends MY_Model
{
	protected $_table_name = 'pages';
	protected $_order_by = 'order';
	protected $_timestamps = true;
	public $rules = array(
		'title' => array(
			'field' => 'title',
			'label' => 'Название страницы',
			'rules' => 'trim|required|max_length[100]|xss_clean'
		),
		'slug' => array(
			'field' => 'slug',
			'label' => 'Латинское имя страницы',
			'rules' => 'trim|max_length[100]|url_title|callback__unique_slug|xss_clean'
		),
		'body' => array(
			'field' => 'body',
			'label' => 'Body',
			'rules' => 'trim'
		),
		'meta_index' => array(
			'field' => 'meta_index',
			'label' => 'Индексация',
			'rules' => 'trim|max_length[1]|xss_clean'
		),
		'meta_title' => array(
			'field' => 'meta_title',
			'label' => 'Мета-тег: Title',
			'rules' => 'trim|max_length[100]|xss_clean'
		),
		'meta_keywords' => array(
			'field' => 'meta_keywords',
			'label' => 'Мета-тег: Keywords',
			'rules' => 'trim|max_length[200]|xss_clean'
		),
		'meta_description' => array(
			'field' => 'meta_description',
			'label' => 'Мета-тег: Description',
			'rules' => 'trim|max_length[300]|xss_clean'
		),
	);

	public function get_new ()
	{
		$page = new stdClass();

		$page->title            = '';
		$page->slug             = '';
		$page->body             = '';
		$page->meta_index       = '';
		$page->meta_title       = '';
		$page->meta_keywords    = '';
		$page->meta_description = '';

		return $page;
	}

	public function save_order ($pages)
	{
		if (count($pages)) {
			foreach ($pages as $order => $page) {
				if ($page['item_id'] != '') {
					$data = array('order' => $order);
					$this->db->set($data)->where($this->_primary_key, $page['item_id'])->update($this->_table_name);
				}
			}
		}
	}

}