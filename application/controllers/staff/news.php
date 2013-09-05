<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends MY_Staff_Controller {

    // $data['meta']
    // $data['header']
    // $data['nav']
    // $data['content']
    public $data;

    public function __construct() {
        parent::__construct();

    // $data['meta']
    // $data['header']
    // $data['nav']
    // $data['content']

        $this->load->model('meta_model');
        $this->load->model('news_model');

        $this->form_messages['success_message']  = NULL;
        $this->form_messages['error_message']    = NULL;
    }

    public function index($id = FALSE) {

        $data['meta']   = $this->meta_model->getStaffMeta();
        $data['messages'] = $this->form_messages;

        if ($id===FALSE) {
            $data['form_values'] = $this->news_model->getEmptyFields();
            $data['form_values']['button'] = 'Создать новость';
            $data['operation'] = 'create';
        } else {
            $data['form_values'] = $this->news_model->getOneNewsById($id);
            $data['form_values']['button'] = 'Изменить новость';
            $data['operation'] = 'edit/' . $id;
        }

        $data['list_values'] = $this->news_model->getLimitNewsList();

        staff_view_loader($data,
                    array(
                        array(0 => 'staff/news', 1 => 'news_form'),
                        array(0 => 'staff/news', 1 => 'news_list')
                        ));
    }

    public function create() {

        $this->form_validation->set_rules('header', 'Заголовок новости');
        $this->form_validation->set_rules('text', 'Текст новости');

        if ($this->form_validation->run() === FALSE) {

        } else {
            $this->news_model->createNews();
        }
        $this->index();
    }

    public function edit($id = NULL) {

        $this->form_validation->set_rules('header', 'Заголовок новости');
        $this->form_validation->set_rules('text', 'Текст новости');

        if ($this->form_validation->run() === FALSE) {

        } else {
            $this->news_model->editNews($id);
        }
        $this->index($id);
    }

    public function delete($id) {
        $this->news_model->deleteNews($id);
        $this->index();
    }

}