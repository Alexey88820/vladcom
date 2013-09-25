<?php
class Photo extends Admin_Controller
{

    public function __construct ()
    {
        parent::__construct();
        $this->load->model('photo_model');
    }

    public function index ()
    {
        // Fetch all photos
        $this->data['photos'] = $this->photo_model->get();

        // Load view
        $this->data['subview'] = 'admin/photo/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function order ()
    {
        $this->data['sortable'] = TRUE;
        $this->data['subview'] = 'admin/photo/order';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function order_ajax ()
    {
        // Save order from ajax call
        if (isset($_POST['sortable'])) {
            $this->photo_model->save_order($_POST['sortable']);
        }

        // Fetch all photos
        $this->data['photos'] = $this->photo_model->get();

        // Load view
        $this->load->view('admin/photo/order_ajax', $this->data);
    }

    public function edit ($id = NULL)
    {
        // Fetch a photo or set a new one
        if ($id) {
            $this->data['photo'] = $this->photo_model->get($id);
            count($this->data['photo']) || $this->data['errors'][] = 'photo could not be found';
        }
        else {
            $this->data['photo'] = $this->photo_model->get_new();
        }

        // Set up the form
        $rules = $this->photo_model->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {
            $data = $this->photo_model->array_from_post(array(
                'title',
                'description',
            ));

            $config['upload_path'] = './assets/uploads/photos/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('filename')) {
                $filedata = $this->upload->data();
                $data['filename'] = $filedata['file_name'];

                $config_resize['source_image']   = $filedata['full_path']; //get original image
                $config_resize['new_image']      = $filedata['file_path'] . 'thumb_' . $filedata['file_name']; //save as new image //need to create thumbs first
                $config_resize['maintain_ratio'] = true;
                $config_resize['master_dim']     = 'width';
                $config_resize['width']          = 300;
                $config_resize['height']         = 1;

                $this->load->library('image_lib', $config_resize); //load library
                $this->image_lib->resize(); //generating thumbs

                if (!empty($this->data['photo']->filename)) {
                    unlink('./assets/uploads/photos/' . $this->data['photo']->filename);
                    unlink('./assets/uploads/photos/' . 'thumb_' . $this->data['photo']->filename);
                }
            } else {
                // $this->session->set_flashdata('error_file', 'Файл не загружен. ' . $this->upload->display_errors());
            }

            if ($this->photo_model->save($data, $id)) {
                $this->session->set_flashdata('success', 'Фотография успешно сохранена');
            } else {
                $this->session->set_flashdata('error', 'Фотография не сохранена');
            }

            redirect('admin/photo');
        }

        // Load the view
        $this->data['subview'] = 'admin/photo/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function delete ($id)
    {
        $this->photo_model->delete($id);
        redirect('admin/photo');
    }

}