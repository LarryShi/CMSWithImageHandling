<?php

//written by chenxidong
class Advertise_model extends CI_Model {

    var $ad_uid = '';
    var $ad_link = '';
    var $ad_image_uid = '0';
    var $ad_type = '';
    
    var $table_name = 'mkt_ad';
    
    const allow_edit = true;
    const allow_delete = true;
    const uid_column_name = 'ad_uid';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('uidgenerator/UidGenerator');
        $this->load->model('sysparam_model');
    }
    
    function get_by_primary_key($uid) {
        $query = $this->db->get_where($this->table_name, array($this::uid_column_name => $uid));
        return $query->result();
    }
    
    function get_all_for_admin() {
        $this->db->select('advertise.*, adi.image_name adv_image');
        $this->db->from('mkt_ad advertise');
        $this->db->join('sys_image adi', 'advertise.ad_image_uid = adi.image_uid' , 'left');
        
        $query = $this->db->get();
        
        return $query->result();
    }
    
    
    function get_listall_field_setting(){
        
        $setting = array(
            "ad_uid" => array( "display" => true, "type" => "text"),
            "ad_link" => array("display" => true, "type" => "text"),
            "ad_type" => array("display" => true, "type" => "text"),
            "ad_image_uid" => array("display" => false, "type" => "image"),
            "adv_image" => array("display" => true, "type" => "image")
        );
        
        return $setting;
    }
    
    function get_create_field_setting(){

        $option_array = array(
            array("option_name"=>"細", "option_value"=>"small"),
            array("option_name"=>"全頁", "option_value"=>"big")
            );
        $object = json_decode(json_encode($option_array), FALSE);
        
        $setting = array(
            "ad_uid" => array( "display" => false, "type" => "text", "required" => false),
            "ad_link" => array("display" => true, "type" => "text", "required" => true),
            "ad_image_uid" => array("display" => true, "type" => "file", "required" => true),
            "ad_type"    => array("display" =>true, "type"=>"dropdown","required"=>true, "list"=>$object)
        );
        
        return $setting;
    }
    
    function get_edit_field_setting(){
        $option_array = array(
            array("option_name"=>"細", "option_value"=>"small"),
            array("option_name"=>"全頁", "option_value"=>"big")
            );
        $object = json_decode(json_encode($option_array), FALSE);
        
        $setting = array(
            "ad_uid" => array( "display" => false, "type" => "text", "required" => false),
            "ad_link" => array("display" => true, "type" => "text", "required" => true),
            "ad_image_uid" => array("display" => true, "type" => "file", "required" => false),
            "ad_type" => array("display" => true, "type" => "dropdown", "required" => true, "list"=>$object)
        );
        
        return $setting;
    }
    
    function get_field_translation($language){
        if ($language=="tc"){
            $ad_uid = "ID";
            $ad_link = "連結";
            $ad_image_uid = "廣告圖片";
            $adv_image    ="廣告圖片";
            $ad_type    ="類別";
        } else {
            $ad_uid = "Advertisement ID";
            $ad_link = "Advertisement Link";
            $ad_image_uid = "Advertisement Image UID";
            $adv_image    ="Advertisement Image";
            $ad_type    ="Type";
        }
        
        $translation_array = array(
            "ad_uid" => array("value" => $ad_uid),
            "ad_link" => array("value" => $ad_link),
            "ad_image_uid" => array("value" => $ad_image_uid),  
            "adv_image"    =>array ("value"=>$adv_image),
            "ad_type"    =>array ("value"=>$ad_type)
        );

        return $translation_array;
    }
    
    
    function values(){
        $value_array = array(
            "ad_uid" => $this->ad_uid,
            "ad_link" => $this->ad_link,
            "ad_image_uid" => $this->ad_image_uid,  
            "ad_type" => $this->ad_type 
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
        
        $new_model->set_value('ad_uid', $new_uid);
        
        return $this->db->insert('mkt_ad', $new_model->values());
    }
    
    function update($model){
        $new_array = $model->values();
        $uid = $model->ad_uid;
        $this->db->where('ad_uid', $uid);
        $this->db->update('mkt_ad', $new_array);
    }
    
    function delete($object_uid) {
        $uid_delete = (int) $object_uid;

        $this->db->select('image.image_name large_image');
        $this->db->from('mkt_ad ad');
        $this->db->where('ad_uid', $uid_delete);
        $this->db->join('sys_image image', 'ad.ad_image_uid = image.image_uid', 'left');
        
        $query = $this->db->get();
        $image_location = $_SERVER['DOCUMENT_ROOT'].'/'.$this->sysparam_model->get_upload_img_path();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $large_image = $row->large_image;
                $large = $image_location . $large_image;
                unlink($large);
            }
        }
        $this->db->delete('mkt_ad', array('ad_uid' => $uid_delete));
    }
}
?>
