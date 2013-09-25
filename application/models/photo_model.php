<?php
class Photo_Model extends MY_Model
{
    protected $_table_name = 'photos';
    protected $_order_by = 'order, created DESC';
    protected $_timestamps = TRUE;
    public $rules = array(
        'filename' => array(
            'field' => 'filename',
            'label' => 'Файл',
            'rules' => 'trim|max_length[100]|xss_clean'
        ),
        'title' => array(
            'field' => 'link',
            'label' => 'Заголовок',
            'rules' => 'trim|max_length[100]|xss_clean'
        ),
        'description' => array(
            'field' => 'description',
            'label' => 'Описание',
            'rules' => 'trim|required'
        )
    );

    public function get_new ()
    {
        $photo = new stdClass();

        $photo->filename    = '';
        $photo->title        = '';
        $photo->description = '';

        return $photo;
    }

    public function save_order ($photos)
    {
        if (count($photos)) {
            foreach ($photos as $order => $photo) {
                if ($photo['item_id'] != '') {
                    $data = array('order' => $order);
                    $this->db->set($data)->where($this->_primary_key, $photo['item_id'])->update($this->_table_name);
                }
            }
        }
    }

    public function get_recent($limit = 8)
    {
        // Fetch a limited number of recent articles
        $limit = (int) $limit;
        // $this->set_published();
        $this->db->limit($limit);

        return parent::get();
    }

    public function delete($id)
    {
        $filter = $this->_primary_filter;
        $id = $filter($id);

        if (!$id) {
            return FALSE;
        }

        $data = $this->get($id);
        $filename = $data->filename;

        $this->db->where($this->_primary_key, $id);
        $this->db->limit(1);
        $this->db->delete($this->_table_name);

        !file_exists('./assets/uploads/photos/' . $filename) || unlink('./assets/uploads/photos/' . $filename);
        !file_exists('./assets/uploads/photos/thumb_' . $filename) || unlink('./assets/uploads/photos/thumb_' . $filename);
    }

}