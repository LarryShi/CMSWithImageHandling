<?php

class Slideshow_model extends CI_Model {
    
    var $slideshow_1 = '';
    var $slideshow_2 = '';
    var $slideshow_3 = '';
    var $slideshow_4 = '';
    var $slideshow_5 = '';
    var $slideshow_6 = '';
    var $slideshow_7 = '';
    var $slideshow_8 = '';
    var $slideshow_9 = '';
    var $slideshow_10 = '';
   
    var $table_name = 'sys_slideshow';
   
    const uid_column_name = 'slideshow_uid';
    
    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('uidgenerator/UidGenerator');
    }
    
    function name(){
        $name = array(
            "slideshow_1" => array("name" => "slideshow_1"),
            "slideshow_2" => array("name" => "slideshow_2"),
            "slideshow_3" => array("name" => "slideshow_3"),
            "slideshow_4" => array("name" => "slideshow_4"),
            "slideshow_5" => array("name" => "slideshow_5"),
            "slideshow_6" => array("name" => "slideshow_6"),
            "slideshow_7" => array("name" => "slideshow_7"),
            "slideshow_8" => array("name" => "slideshow_8"),
            "slideshow_9" => array("name" => "slideshow_9"),
            "slideshow_10" => array("name" => "slideshow_10")
    );
}
    
     function get_by_primary_key($uid) {
        $query = $this->db->get_where($this->table_name, array($this::uid_column_name => $uid));
        return $query->result();
    }
    
    
    function insert($new_model) {
        //Request a new uid
        $new_uid_result = $this->uidgenerator->request_uid(sys_slideshow);
        $new_uid = $new_uid_result[0]->uid_gen_current_uid;
        
        $new_model->set_value('slideshow_uid', $new_uid);
        var_dump($new_model);
        
        return $this->db->insert('sys_slideshow', $new_model);
    }
    
    function get_required_or_not(){
        $setting = array(
            "slideshow_uid" => array("display" => false, "type" => "file"),
            "slideshow_1" => array("display" => true, "type" => "file"),
            "slideshow_2" => array("display" => true, "type" => "file"),
            "slideshow_3" => array("display" => true, "type" => "file"),
            "slideshow_4" => array("display" => true, "type" => "file"),
            "slideshow_5" => array("display" => true, "type" => "file"),
            "slideshow_6" => array("display" => true, "type" => "file"),
            "slideshow_7" => array("display" => true, "type" => "file"),
            "slideshow_8" => array("display" => true, "type" => "file"),
            "slideshow_9" => array("display" => true, "type" => "file"),
            "slideshow_10" => array("display" => true, "type" => "file"),
            "first_image" => array("display" => false, "type" => "file"),
            "second_image" => array("display" => false, "type" => "file"),
            "third_image" => array("display" => false, "type" => "file"),
            "4th_image" => array("display" => false, "type" => "file"),
            "fifth_image" => array("display" => false, "type" => "file"),
            "6th_image" => array("display" => false, "type" => "file"),
            "7th_image" => array("display" => false, "type" => "file"),
            "8h_image" => array("display" => false, "type" => "file"),
            "ninth_image" => array("display" => false, "type" => "file"),
            "10th_image" => array("display" => true, "type" => "file"),
            );
        return $setting;
    }
    
    function get_by_primary_key_for_edit($uid) {
        $this->db->select('slideshow.*, '
                . 'first.image_name first_image, '
                . 'second.image_name second_image, '
                . 'third.image_name third_image ,'
                . 'forth.image_name forth_image,'
                . 'fifth.image_name fifth_image,'
                . 'sixth.image_name sixth_image,'
                . 'seventh.image_name seventh_image,'
                . 'eighth.image_name eighth_image,'
                . 'ninth.image_name nighth_image, '
                . 'tenth.image_name tenth_image');
        
        $this->db->from('sys_slideshow slideshow');
        $this->db->join('sys_image first', 'slideshow.slideshow_1 = first.image_uid' , 'left');
        $this->db->join('sys_image second','slideshow.slideshow_2 = second.image_uid' , 'left');
        $this->db->join('sys_image third', 'slideshow.slideshow_3 = third.image_uid' , 'left');
        $this->db->join('sys_image forth','slideshow.slideshow_4 = forth.image_uid' , 'left');
        $this->db->join('sys_image fifth', 'slideshow.slideshow_5 = fifth.image_uid' , 'left');
        $this->db->join('sys_image sixth', 'slideshow.slideshow_6 = sixth.image_uid' , 'left');
        $this->db->join('sys_image seventh','slideshow.slideshow_7 = seventh.image_uid' , 'left');
        $this->db->join('sys_image eighth', 'slideshow.slideshow_8 = eighth.image_uid' , 'left');
        $this->db->join('sys_image ninth', 'slideshow.slideshow_9 = ninth.image_uid' , 'left');
        $this->db->join('sys_image tenth', 'slideshow.slideshow_10 = tenth.image_uid' , 'left');
        
        $this->db->where('slideshow_uid', $uid);
        $query = $this->db->get();
        return $query->result();
    }
function values(){
        $value_array = array(
            "slideshow_1" => $this->slideshow_1,
            "slideshow_2" => $this->slideshow_2,
            "slideshow_3" => $this->slideshow_3,
            "slideshow_4" => $this->slideshow_4,
            "slideshow_5" => $this->slideshow_5,
            "slideshow_6" => $this->slideshow_6,
            "slideshow_7" => $this->slideshow_7,
            "slideshow_8" => $this->slideshow_8,
            "slideshow_9" => $this->slideshow_9,
            "slideshow_10" => $this->slideshow_10   
        );
        
        return $value_array;
    }
    
    function set_value($fieldname, $value) {
        $this->$fieldname = $value;
    } 
    
    function update($model){
        $new_array = $model->values();
        $uid_column_name = $this::uid_column_name;
        $uid = $model->$uid_column_name;
        $this->db->where($this::uid_column_name, $uid);
        $this->db->update($this->table_name, $new_array);
    }
}

