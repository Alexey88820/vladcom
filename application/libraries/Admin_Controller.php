<?php
class Admin_Controller extends MY_Controller
{

	function __construct ()
	{
		parent::__construct();

		$this->data['meta_title'] = config_item('site_name') . ': Админка';

		$this->load->helper('form');

		$this->load->library('form_validation');
		$this->load->library('session');

		$this->load->model('user_model');

		// Login check
		$exception_uris = array(
			'admin/user/login',
			'admin/user/logout'
		);
		if (in_array(uri_string(), $exception_uris) == FALSE) {
			if ($this->user_model->loggedin() == FALSE) {
				redirect('admin/user/login');
			}
		}
	}

    public function _unique_catalog_slug ($str)
    {
        // Do NOT validate if slug already exists
        // UNLESS it's the slug for the current page

        $id = $this->uri->segment(4);

        $this->load->model('catalog_section_model');
        $this->load->model('catalog_group_model');
        $this->load->model('catalog_item_model');

        $translit_slug = transliteration($this->input->post('slug'));

		$this->db->where('slug', $translit_slug);
		! $id || $this->db->where('id !=', $id);
		$sections = $this->catalog_section_model->get();

		$this->db->where('slug', $translit_slug);
		! $id || $this->db->where('id !=', $id);
		$groups = $this->catalog_group_model->get();

		$this->db->where('slug', $translit_slug);
		! $id || $this->db->where('id !=', $id);
		$items = $this->catalog_item_model->get();

        if (
            (count($sections)) ||
            (count($groups)) ||
            (count($items))
           ) {
            $this->form_validation->set_message('_unique_catalog_slug', '%s should be unique');
            return FALSE;
        }

        return $translit_slug;
    }

}