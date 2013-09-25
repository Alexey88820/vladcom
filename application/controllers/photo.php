<?php

class Photo extends Frontend_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('photo_model');
    }

    public function ajax_get_image()
    {
        // echo '1 ';

        if (!$this->input->is_ajax_request()) {
            return false;
        }

        // echo '2 ';

        // var_dump($_POST);

        if (!isset($_POST['photo_id'])) {
            return false;
        }

        // echo '3 ';

        $photo = $this->photo_model->get($_POST['photo_id'], true);

        if (empty($photo)) {
            return false;
        }

        echo '<img data-id="' . $photo->id . '" src="' . site_url('assets/uploads/photos/' . $photo->filename) . '" alt="' . $photo->title . '">';

        // var_dump($photo);
        //
    }

}
?>