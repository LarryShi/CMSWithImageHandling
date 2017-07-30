<?php

//written by chenxidong
class Hairstyle_model extends CI_Model {

    var $hairstyle_uid = '';
    var $small_img_uid = '';
    var $large_img_uid = '';
    var $category='';
    var $source='';
    var $stylist_uid='';
    var $date='';
    var $table_name = 'sal_hairstyle';
    
    const allow_edit = true;
    const allow_delete = true;

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('uidgenerator/UidGenerator');
    }
    
    function get_by_primary_key($uid) {
        $query = $this->db->get_where('sal_hairstyle', array('hairstyle_uid' => $uid));
        return $query->result();
    }
    function get_by_image($uid){
        $query = $this->db->get_where('sal_hairstyle', array('small_img_uid' => $uid));
        return $query->result_array();
    }
    function get_by_stylist_key($uid) {
        $query = $this->db->get_where('sal_hairstyle', array('stylist_uid' => $uid));
        return $query->result_array();
    }
    
    function get_all_for_admin() {
        $this->db->select('hairstyle.*, stylist.stylist_name_tc stylist_name, style_large.image_name large_style_image , style_small.image_name small_style_image');
        $this->db->from('sal_hairstyle hairstyle');
        $this->db->join('sys_image style_large', 'hairstyle.large_img_uid = style_large.image_uid' , 'left');
        $this->db->join('sys_image style_small', 'hairstyle.small_img_uid = style_small.image_uid' , 'left');
        $this->db->join('sal_stylist stylist', 'hairstyle.stylist_uid = stylist.stylist_uid' , 'left');
        
        $query = $this->db->get();
        
        return $query->result();
    }
    
    
    function get_listall_field_setting(){
        
        $setting = array(
            "hairstyle_uid" => array( "display" => true, "type" => "text"),
            "small_img_uid" => array("display" => false, "type" => "image"),
            "large_img_uid" => array("display" => false, "type" => "image"),
            "category" => array("display" => true, "type" => "text"),
            "source" => array("display" => true, "type" => "text"),
            "stylist_uid" => array("display" => false, "type" => "text"),
            "stylist_name" => array("display" => true, "type" => "text"),
            "large_style_image" => array("display" => true, "type" => "image"),
            "small_style_image" => array("display" => true, "type" => "image")
        );
        
        return $setting;
    }
    
    function get_create_field_setting(){

        $option_array = array(
            array("option_name"=>"男", "option_value"=>"male"),
            array("option_name"=>"女", "option_value"=>"female")
            );
        $object = json_decode(json_encode($option_array), FALSE);
        
        $setting = array(
            "hairstyle_uid" => array( "display" => false, "type" => "text", "required" =>false),
            "small_img_uid" => array("display" => true, "type" => "file", "required" =>true),
            "large_img_uid" => array("display" => true, "type" => "file","required" =>true),
            "category" => array("display" => true, "type" => "dropdown" , "required" =>true, "list"=>$object),
            "source" => array("display" => true, "type" => "text" , "required" =>false),
            "stylist_uid" => array("display" => false, "type" => "text" , "required" =>false),
            "large_style_image" => array("display" => false, "type" => "file" , "required" =>false),
            "small_style_image" => array("display" => false, "type" => "file", "required"=>false),
            "date" => array("display" => false, "type" => "text", "required"=>false)
        ); 
        return $setting;
    }
    
    function get_edit_field_setting(){
        
        $this->db->select('stylist_name_tc option_name, stylist_uid option_value');
        $this->db->from('sal_stylist');
        $query = $this->db->get();
        $data_array = $query->result();
        
        $option_array = array(
            array("option_name"=>"男", "option_value"=>"male"),
            array("option_name"=>"女", "option_value"=>"female")
            );
        $object = json_decode(json_encode($option_array), FALSE);
        
        $setting = array(
        "hairstyle_uid" => array( "display" => false, "type" => "text", "required" =>false),
        "small_img_uid" => array("display" => true, "type" => "file", "required" =>false),
        "large_img_uid" => array("display" => true, "type" => "file","required" =>false),
        "category" => array("display" => true, "type" => "dropdown" , "required" =>true, "list"=>$object),
        "source" => array("display" => true, "type" => "text" , "required" =>false),
        "stylist_uid" => array("display" => true, "type" => "dropdown" , "required" =>false, "list"=>$data_array),
        "large_style_image" => array("display" => false, "type" => "file" , "required" =>false),
        "small_style_image" => array("display" => false, "type" => "file", "required"=>false),
            "date" => array("display" => false, "type" => "text", "required"=>false)
        );
        
        return $setting;
    }
    
    function get_field_translation($language){
        if ($language=="tc"){
            $hairstyle_uid = "ID";
            $small_img_uid = "細圖";
            $large_img_uid = "大圖";
            $category    ="男或女";
            $source    ="資料來源";
            $stylist_uid = "髮師 ID";
            $stylist_name = "髮師";
            $large_style_image="大圖";
            $small_style_image="細圖";
            
        } else {
            $hairstyle_uid = "Hair Style UID";
            $small_img_uid = "Small Image ID";
            $large_img_uid = "Large Image ID";
            $category    ="Male or Female";
            $source    ="資料來源";
            $stylist_uid = "Stylist ID";
            $stylist_name = "Stylist Name";
            $large_style_image="Large Style Image";
            $small_style_image="Small Style Image";
        }
        
        $translation_array = array(
            "hairstyle_uid" => array("value" => $hairstyle_uid),
            "small_img_uid" => array("value" => $small_img_uid),
            "large_img_uid" => array("value" => $large_img_uid),  
            "category"    =>array ("value"=>$category), 
            "source"    =>array ("value"=>$source), 
            "stylist_uid"    =>array ("value"=>$stylist_uid),
            "stylist_name"    =>array ("value"=>$stylist_name),
            "large_style_image"    =>array ("value"=>$large_style_image),
            "small_style_image"    =>array ("value"=>$small_style_image)
        );

        return $translation_array;
    }
    
    
    function values(){
        $value_array = array(
            "hairstyle_uid" => $this->hairstyle_uid,
            "small_img_uid" => $this->small_img_uid,
            "large_img_uid" => $this->large_img_uid,
            "category" => $this->category,
            "source" => $this->source,
            "stylist_uid" => $this->stylist_uid,
                'date'=>$this->date
        );
        
        return $value_array;
    }
    
    function set_value($fieldname, $value) {
        $this->$fieldname = $value;
    }
    

    function insert($new_model) {
        //Request a new uid
        $new_uid_result = $this->uidgenerator->request_uid($this->table_name);
        $new_uid = $new_uid_result[0]->uid_gen_current_uid;
        
        $new_model->set_value('hairstyle_uid', $new_uid);
        
        return $this->db->insert('sal_hairstyle', $new_model->values());
    }
    
    function update($model){
        $new_array = $model->values();
        $uid = $model->hairstyle_uid;
        
        $this->db->where('hairstyle_uid', $uid);
        $this->db->update('sal_hairstyle', $new_array);
    }
    
    function delete($object_uid){
        $uid_delete = (int) $object_uid;

        $this->db->select('large.image_name large_image, small.image_name small_image');
        $this->db->from('sal_hairstyle hairstyle');
        $this->db->where('hairstyle_uid', $uid_delete);
        $this->db->join('sys_image large', 'hairstyle.large_img_uid = large.image_uid', 'left');
        $this->db->join('sys_image small', 'hairstyle.small_img_uid = small.image_uid', 'left');
        
        $query = $this->db->get();
        $image_location = $_SERVER['DOCUMENT_ROOT'].'/'.$this->sysparam_model->get_upload_img_path();
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $large_image = $row->large_image;
                $small_image = $row->small_image;
                $large = $image_location.$large_image;
                $small = $image_location.$small_image;
                unlink($large);
                unlink($small);
            }
        }
        
        $this->db->delete('sal_hairstyle', array('hairstyle_uid' => $uid_delete));
    }
}
?>