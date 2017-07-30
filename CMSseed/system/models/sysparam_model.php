<?php

class Sysparam_model extends CI_Model {
    
    var $table_name = 'sys_param';
    
    function get() {
        $query = $this->db->get($this->table_name);
        return $query->result();
    }
    
    function get_upload_img_path(){
        $query = $this->db->get($this->table_name);
        
        $result = $query->result();
        return $result[0]->upload_img_path;
    }
}