<?php

//written by chenxidong
//Modified by SHI ZHONGQI
//Please Modify the function according to the requirements 
class Option_model extends CI_Model {

    var $id = '';
    var $name = '';
    var $content = '';
    var $like='';
    var $link='';
    var $image_uid='';
    var $image_url='';
    
    var $table_name = 'mytable';
    
    const allow_edit = true;
    const allow_delete = true;

    //define the primary key here, in order to use the library
    const uid_column_name='id';
    
    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('uidgenerator/UidGenerator');
    }
    
    function get_by_primary_key($uid) {
        /**
        for example only
        please modify it as needed 
        */
        $query = $this->db->get_where('mytable', array('id' => $uid));
        return $query->result();
    }
    
    function get_by_image($uid){
        $query = $this->db->get_where('mytable', array('image_uid' => $uid));
        return $query->result_array();
    }
    
    function get_all_for_admin() {
        /**
        for example only
        please modify it as needed 
        */
        $this->db->select('mytable.*, sys_image.image_name image_name');
        $this->db->from('mytable');
        $this->db->join('sys_image', 'mytable.image_uid = sys_image.image_uid' , 'left');
        
        $query = $this->db->get();
        
        return $query->result();
    }
    
    
    function get_listall_field_setting(){
        /**
        for example only
        please modify it as needed 
        */
        $setting = array(
            "id" => array( "display" => true, "type" => "int"),
            "name" => array("display" => true, "type" => "text"),
            "content" => array("display" => true, "type" => "text"),
            "like" => array("display" => true, "type" => "int"),
            "link" => array("display" => true, "type" => "text"),
            "image_uid"=>array("display" => false, "type" => "image"),
            "image_name" => array("display" => true, "type" => "image"),
        );
        
        return $setting;
    }
    
    function get_create_field_setting(){
        /**
        for example only
        please modify it as needed 
        */
        $setting = array(
            "id" => array( "display" => false, "type" => "int", "required" =>true),
            "name" => array("display" => true, "type" => "text", "required" =>true),
            "content" => array("display" => true, "type" => "text", "required" =>true),
            "like" => array("display" => true, "type" => "int", "required" =>false),
            "link" => array("display" => true, "type" => "text", "required" =>false),
            "image_uid"=>array("display" => true, "type" => "file","required" =>false),
             "image_name" => array("display" => false, "type" => "file","required" =>false)
        );
        return $setting;
    }
    
    function get_edit_field_setting(){
        /**
        for example only
        please modify it as needed 
        */
        $setting = array(
            "id" => array( "display" => false, "type" => "int", "required" =>true),
            "name" => array("display" => true, "type" => "text", "required" =>true),
            "content" => array("display" => true, "type" => "text", "required" =>true),
            "like" => array("display" => true, "type" => "int", "required" =>false),
            "link" => array("display" => true, "type" => "text", "required" =>false),
            "image_uid"=>array("display" => true, "type" => "file","required" =>false),
            "image_name" => array("display" =>false, "type" => "file","required" =>false)
        );
        return $setting;
    }
    
    function get_field_translation($language){
        /**
        for example only
        please modify it as needed 
        */
        if ($language=="tc"){
            $id = "ID";
            $name = "名字";
            $content="内容";
            $like="赞";
            $link="链接";
            $image_uid="图片";
            $image_name="图片";
            
        } else {
            $id = "ID";
            $name = "Name";
            $content="Content";
            $like="Like";
            $link="Link";
            $image_uid="Image";
            $image_name="Image";
        }
        $translation_array = array(
            "id" => array("value" => $id),
            "name" => array("value" => $name),
            "content" => array("value" => $content),  
            "like"    =>array ("value"=>$like), 
            "link"    =>array ("value"=>$link),
            "image_uid"=>array("value"=>$image_uid),
            "image_name" =>array("value"=>$image_name)
        );

        return $translation_array;
    }
    
    
    function values(){
        /**
        for example only
        please modify it as needed 
        */
        $value_array = array(
            "id" => $this->id,
            "name" => $this->name,
            "content" => $this->content,
            "like" => $this->like,
            "link" => $this->link,
            "image_uid"=> $this->image_uid
        );
        
        return $value_array;
    }
    
    function set_value($fieldname, $value) {
        /**
        for example only
        please modify it as needed 
        */
        $this->$fieldname = $value;
    }
    

    function insert($new_model) {
        /**
        for example only
        please modify it as needed 
        */
        //Request a new uid
        $new_uid_result = $this->uidgenerator->request_uid($this->table_name);
        $new_uid = $new_uid_result[0]->uid_gen_current_uid;
        
        $new_model->set_value('id', $new_uid);
        
        return $this->db->insert('mytable', $new_model->values());
    }
    
    function update($model){
        /**
        for example only
        please modify it as needed 
        */
        $new_array = $model->values();
        $uid = $model->id;
        
        $this->db->where('id', $uid);
        $this->db->update('mytable', $new_array);
    }
    
    function delete($object_uid){
        $uid_delete = (int) $object_uid;
        $this->db->select('sys_image.image_name image');
        $this->db->from('mytable');
        $this->db->where('id', $uid_delete);
        $this->db->join('sys_image', 'mytable.image_uid = sys_image.image_uid', 'left');
        
        $query = $this->db->get();
        $image_location = $_SERVER['DOCUMENT_ROOT'].'/'.$this->sysparam_model->get_upload_img_path();
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $image = $row->image;
                $image = $image_location.$image;
                unlink($image);
            }
        }   
        $this->db->delete('mytable', array('id' => $uid_delete));
    
    }
}
?>