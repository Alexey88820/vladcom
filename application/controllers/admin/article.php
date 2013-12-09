<?php
class Article extends Admin_Controller
{

    public function __construct ()
    {
        parent::__construct();
        $this->load->model('article_model');
    }

    public function index ()
    {
        // Fetch all articles
        $this->data['articles'] = $this->article_model->get();

        // Load view
        $this->data['subview'] = 'admin/article/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit ($id = NULL)
    {
        // Fetch a articles item or set a new one
        if ($id) {
            $this->data['article'] = $this->article_model->get($id);
            count($this->data['article']) || $this->data['errors'][] = 'article could not be found';
        }
        else {
            $this->data['article'] = $this->article_model->get_new();
        }

        // Set up the form
        $rules = $this->article_model->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {
            $data = $this->article_model->array_from_post(array(
                'title',
                'body',
            ));
            if ($this->article_model->save($data, $id)) {
                $this->session->set_flashdata('success', 'Страница успешно изменена');
            } else {
                $this->session->set_flashdata('error', 'Страница не изменена');
            }

            redirect('admin/article');
        }

        // Load the view
        $this->data['subview'] = 'admin/article/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function delete ($id)
    {
        $this->article_model->delete($id);
        redirect('admin/article');
    }

}