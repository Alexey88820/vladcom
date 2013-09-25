<?php
class Block extends Admin_Controller
{

    public function __construct ()
    {
        parent::__construct();
        $this->load->model('block_model');
    }

    public function index ()
    {
        // Fetch all blocks
        $this->data['blocks'] = $this->block_model->get();

        // Load view
        $this->data['subview'] = 'admin/block/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit ($id = NULL)
    {
        // Fetch a block or set a new one
        if ($id) {
            $this->data['block'] = $this->block_model->get($id);
            count($this->data['block']) || $this->data['errors'][] = 'block could not be found';
        }
        else {
            $this->data['block'] = $this->block_model->get_new();
        }

        // Set up the form
        $rules = $this->block_model->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {
            $data = $this->block_model->array_from_post(array(
                'slug',
                'title',
                'body',
            ));

            if ($this->block_model->save($data, $id)) {
                $this->session->set_flashdata('success', 'Блок успешно изменен');
            } else {
                $this->session->set_flashdata('error', 'Блок не изменен');
            }

            redirect('admin/block');
        }

        // Load the view
        $this->data['subview'] = 'admin/block/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function delete ($id)
    {
        $this->block_model->delete($id);
        redirect('admin/block');
    }

    public function _unique_slug ($str)
    {
        // Do NOT validate if slug already exists
        // UNLESS it's the slug for the current page


        $id = $this->uri->segment(4);
        $this->db->where('slug', $this->input->post('slug'));
        ! $id || $this->db->where('id !=', $id);
        $page = $this->block_model->get();

        if (count($page)) {
            $this->form_validation->set_message('_unique_slug', '%s should be unique');
            return FALSE;
        }

        return TRUE;
    }

}