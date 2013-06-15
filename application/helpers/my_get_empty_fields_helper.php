<?php
    function get_empty_fields($tablename) {
        $fields = $this->db->list_fields($tablename);
        foreach ($fields as $value) {
            $result[$value] = '';
        }
        return $result;
    }

?>