<?php
class Catalog_Section extends Admin_Controller
{
    public function __construct ()
    {
        parent::__construct();
        $this->load->model('catalog_section_model');
    }

    public function index ()
    {
        // Fetch all catalog_sections
        $this->data['catalog_sections'] = $this->catalog_section_model->get();

        // Load view
        $this->data['subview'] = 'admin/catalog_section/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function order ()
    {
        $this->data['sortable'] = TRUE;
        $this->data['subview'] = 'admin/catalog_section/order';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function order_ajax ()
    {
        // Save order from ajax call
        if (isset($_POST['sortable'])) {
            $this->catalog_section_model->save_order($_POST['sortable']);
        }

        // Fetch all catalog_sections
        $this->data['catalog_sections'] = $this->catalog_section_model->get();

        // Load view
        $this->load->view('admin/catalog_section/order_ajax', $this->data);
    }

    public function edit ($id = NULL)
    {
        // Fetch a catalog_section or set a new one
        if ($id) {
            $this->data['catalog_section'] = $this->catalog_section_model->get($id);
            count($this->data['catalog_section']) || $this->data['errors'][] = 'catalog_section could not be found';
        }
        else {
            $this->data['catalog_section'] = $this->catalog_section_model->get_new();
        }

        // Set up the form
        $rules = $this->catalog_section_model->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {
            $data = $this->catalog_section_model->array_from_post(array(
                'slug',
                'title',
                'body',
                'img',
                'annotation',
                'meta_index',
                'meta_title',
                'meta_keywords',
                'meta_description',
            ));

            $config['upload_path'] = './assets/pics/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file_img')) {
                $filedata = $this->upload->data();
                $data['img'] = $filedata['full_path'];

                $config_resize['source_image']   = $filedata['full_path']; //get original image
                $config_resize['new_image']      = $filedata['file_path'] . 'thumb_' . $filedata['file_name']; //save as new image //need to create thumbs first
                $config_resize['maintain_ratio'] = true;
                $config_resize['master_dim']     = 'width';
                $config_resize['width']          = 300;
                $config_resize['height']         = 1;

                $this->load->library('image_lib', $config_resize); //load library
                $this->image_lib->resize(); //generating thumbs

                if (!empty($this->data['catalog_section']->img)) {
                    unlink('./assets/uploads/photos/' . $this->data['catalog_section']->img);
                    unlink('./assets/uploads/photos/' . 'thumb_' . $this->data['catalog_section']->img);
                }
            } else {
                // $this->session->set_flashdata('error_file', 'Файл не загружен. ' . $this->upload->display_errors());
            }

            // var_dump($data);

            // return false;

            if ($this->catalog_section_model->save($data, $id)) {
                $this->session->set_flashdata('success', 'Страница успешно изменена');
            } else {
                $this->session->set_flashdata('error', 'Страница не изменена');
            }

            redirect('admin/catalog_section');
        }

        // Load the view
        $this->data['subview'] = 'admin/catalog_section/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function delete ($id)
    {
        $this->catalog_section_model->delete($id);
        redirect('admin/catalog_section');
    }



}

