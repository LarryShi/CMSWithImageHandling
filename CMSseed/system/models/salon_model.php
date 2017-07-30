<?php

class Salon_model extends CI_Model {

    /*
     * Columns and table name
     */
    var $salon_uid = '';
    var $name_tc = '';
    var $name_sc = '';
    var $name_en = '';
    var $address_tc = '';
    var $address_sc = '';
    var $address_en = '';
    var $lang = '';
    var $long = '';
    var $opening_hour = '';
    var $tel = '';
    var $hiring_info_tc = '';
    var $hiring_info_sc = '';
    var $hiring_info_en = '';
    var $price_list_tc = '';
    var $price_list_sc = '';
    var $price_list_en = '';
    var $detailed = '';
    var $large_image_uid = '0';
    var $medium_image_uid = '0';
    var $small_image_uid = '0';
    var $user_uid = '0';
    var $rank = '0';
    var $discount_uid = '0';
    var $other_service = '';
    var $wcb_print='0';
    
    var $district='0';
    var $table_name = 'sal_salon';
    
    const allow_edit = true;
    const allow_delete = true;

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('uidgenerator/UidGenerator');
        $this->load->model('sysparam_model');
    }
    
    function get_by_primary_key($uid) {
        $query = $this->db->get_where('sal_salon', array('salon_uid' => $uid));
        return $query->result();
    }
     
    
    function get_by_primary_key_for_edit($uid) {
        $this->db->select('salon.*, user_table.user_login_id user_id, large.image_name large_image, medium.image_name medium_image, small.image_name small_image, discount.discount_uid discount_uid,salon.wcb_price wcb_price');
        $this->db->from('sal_salon salon');
        $this->db->join('usr_user user_table', 'salon.user_uid = user_table.user_uid' , 'left');
        $this->db->join('sys_image large', 'salon.large_image_uid = large.image_uid' , 'left');
        $this->db->join('sys_image medium', 'salon.medium_image_uid = medium.image_uid' , 'left');
        $this->db->join('sys_image small', 'salon.small_image_uid = small.image_uid' , 'left');
        $this->db->join('sal_discount discount', 'salon.salon_uid = discount.salon_uid' , 'left');
        
        $this->db->where('salon.salon_uid', $uid);
        $query = $this->db->get();
        return $query->result();
    }
    
    function get_all_for_admin() {
        $this->db->select('salon.*, user_table.user_login_id user_id, large.image_name large_image, medium.image_name medium_image, small.image_name small_image, discount.discount_uid discount_uid');
        $this->db->from('sal_salon salon');
        $this->db->join('usr_user user_table', 'salon.user_uid = user_table.user_uid' , 'left');
        $this->db->join('sys_image large', 'salon.large_image_uid = large.image_uid' , 'left');
        $this->db->join('sys_image medium', 'salon.medium_image_uid = medium.image_uid' , 'left');
        $this->db->join('sys_image small', 'salon.small_image_uid = small.image_uid' , 'left');
        $this->db->join('sal_discount discount', 'salon.salon_uid = discount.salon_uid' , 'left');
        
        $query = $this->db->get();
        //var_dump($query);
       // exit;
        
        return $query->result();
    }
    
//    function get_last_ten_entries() {
//        $query = $this->db->get($this->table_name, 10);
//        return $query->result();
//    }
    
    function get_listall_field_setting(){
        /*
         * Setup this array, then you can control the display of the column
         * control the type of column
         */
        $setting = array(
            "salon_uid" => array( "display" => true, "type" => "text"),
            "name_tc" => array("display" => true, "type" => "text"),
            "name_sc" => array("display" => true, "type" => "text"),
            "name_en" => array("display" => true, "type" => "text"),
            "address_tc" => array("display" => true, "type" => "text"),
            "address_sc" => array("display" => true, "type" => "text"),
            "address_en" => array("display" => true, "type" => "text"),
            "lang" => array("display" => false, "type" => "text"),
            "long" => array("display" => false, "type" => "text"),
            "opening_hour" => array("display" => true, "type" => "text"),
            "other_service" => array("display" => true, "type" => "text"),
            "tel" => array("display" => true, "type" => "text"),
            "hiring_info_tc" => array("display" => true, "type" => "text"),
            "hiring_info_sc" => array("display" => true, "type" => "text"),
            "hiring_info_en" => array("display" => true, "type" => "text"),
            "price_list_tc" => array("display" => false, "type" => "text"),
            "price_list_sc" => array("display" => false, "type" => "text"),
            "price_list_en" => array("display" => false, "type" => "text"),
            "large_image_uid" => array("display" => false, "type" => "image"),
            "medium_image_uid" => array("display" => false, "type" => "image"),
            "small_image_uid" => array("display" => false, "type" => "image"),
            "discount_uid" => array("display" => true, "type" => "text"),
            "rank" => array("display" => true, "type" => "text"),
            "user_uid" => array("display" => false, "type" => "text"),
            "user_id" => array("display" => true, "type" => "text"),
            "large_image" => array("display" => true, "type" => "image"),
            "medium_image" => array("display" => true, "type" => "image"),
            "small_image" => array("display" => true, "type" => "image"),
             "wcb_price" => array("display" => true, "type" => "text"),
            
            "district" => array("display" => true, "type" => "text")
        );
        
        return $setting;
    }
    
    function get_create_field_setting(){
        /*
         * Setup this array, then you can control the display of the column
         * control the type of column
         */
        $setting = array(
            "salon_uid" => array( "display" => false, "type" => "text", "required" => false),
            "name_tc" => array("display" => true, "type" => "text", "required" => true),
            "name_sc" => array("display" => true, "type" => "text", "required" => true),
            "name_en" => array("display" => true, "type" => "text", "required" => true),
            "address_tc" => array("display" => true, "type" => "text", "required" => true),
            "address_sc" => array("display" => true, "type" => "text", "required" => true),
            "address_en" => array("display" => true, "type" => "text", "required" => true),
            "lang" => array("display" => true, "type" => "text", "required" => true),
            "long" => array("display" => true, "type" => "text", "required" => true),
            "opening_hour" => array("display" => true, "type" => "textarea", "required" => true),
            "other_service" => array("display" => true, "type" => "textarea", "required" => false),
            "tel" => array("display" => true, "type" => "text", "required" => true),
            "hiring_info_tc" => array("display" => true, "type" => "textarea", "required" => true),
            "hiring_info_sc" => array("display" => true, "type" => "textarea", "required" => true),
            "hiring_info_en" => array("display" => true, "type" => "textarea", "required" => true),
            "price_list_tc" => array("display" => true, "type" => "price_list", "required" => true),
            "price_list_sc" => array("display" => true, "type" => "price_list", "required" => true),
            "price_list_en" => array("display" => true, "type" => "price_list", "required" => true),
            "large_image_uid" => array("display" => true, "type" => "file", "required" => true),
            "medium_image_uid" => array("display" => true, "type" => "file", "required" => true),
            "small_image_uid" => array("display" => true, "type" => "file", "required" => true),
            "discount_uid" => array("display" => true, "type" => "text", "required" => false),
            "large_image" => array("display" => false, "type" => "file", "required" => false),
            "medium_image" => array("display" => false, "type" => "file", "required" => false),
            "small_image" => array("display" => false, "type" => "file", "required" => false),
            "rank" => array("display" => true, "type" => "text", "required" => false),
            "user_uid" => array("display" => true, "type" => "text", "required" => true),
            "user_id" => array("display" => false, "type" => "text", "required" => true),
            "wcb_price" => array("display" => true, "type" => "text", "required" => true),
            
            "district" => array("display" => true, "type" => "text", "required" => true)
        );
        
        return $setting;
    }
    
    function get_edit_field_setting(){
        /*
         * Setup this array, then you can control the display of the column
         * control the type of column
         */
        $setting = array(
            "salon_uid" => array( "display" => false, "type" => "text", "required" => false),
            "name_tc" => array("display" => true, "type" => "text", "required" => true),
            "name_sc" => array("display" => true, "type" => "text", "required" => true),
            "name_en" => array("display" => true, "type" => "text", "required" => true),
            "address_tc" => array("display" => true, "type" => "text", "required" => true),
            "address_sc" => array("display" => true, "type" => "text", "required" => true),
            "address_en" => array("display" => true, "type" => "text", "required" => true),
            "lang" => array("display" => true, "type" => "text", "required" => true),
            "long" => array("display" => true, "type" => "text", "required" => true),
            "opening_hour" => array("display" => true, "type" => "textarea", "required" => true),
            "other_service" => array("display" => true, "type" => "textarea", "required" => false),
            "tel" => array("display" => true, "type" => "text", "required" => true),
            "hiring_info_tc" => array("display" => true, "type" => "textarea", "required" => true),
            "hiring_info_sc" => array("display" => true, "type" => "textarea", "required" => true),
            "hiring_info_en" => array("display" => true, "type" => "textarea", "required" => true),
            "price_list_tc" => array("display" => true, "type" => "price_list", "required" => true),
            "price_list_sc" => array("display" => true, "type" => "price_list", "required" => true),
            "price_list_en" => array("display" => true, "type" => "price_list", "required" => true),
            "large_image_uid" => array("display" => true, "type" => "file", "required" => false),
            "medium_image_uid" => array("display" => true, "type" => "file", "required" => false),
            "small_image_uid" => array("display" => true, "type" => "file", "required" => false),
            "large_image" => array("display" => false, "type" => "file", "required" => false),
            "medium_image" => array("display" => false, "type" => "file", "required" => false),
            "small_image" => array("display" => false, "type" => "file", "required" => false),
            "rank" => array("display" => true, "type" => "text", "required" => false),
            "user_uid" => array("display" => false, "type" => "text", "required" => false),
            "user_id" => array("display" => false, "type" => "text", "required" => false),
            "wcb_price" => array("display" => true, "type" => "text", "required" => false),
            
            "district" => array("display" => true, "type" => "text", "required" => false)
        );
        
        return $setting;
    }
    
    function get_field_translation($language){
        if ($language=="tc"){
            $salon_uid = "ID";
            $name_tc = "名稱_繁";
            $name_sc = "名稱_簡";
            $name_en = "名稱_英";
            $address_tc = "地址_繁";
            $address_sc = "地址_簡";
            $address_en = "地址_英";
            $lang = "Langtitude";
            $long = "Longtitude";
            $opening_hour = "開放時間";
            $other_service = "其他服務";
            $tel = "電話";
            $hiring_info_tc = "招聘資料_繁";
            $hiring_info_sc = "招聘資料_簡";
            $hiring_info_en = "招聘資料_英";
            $price_list_tc = "價格表_繁";
            $price_list_sc = "價格表_簡";
            $price_list_en = "價格表_英";
            $large_image_uid = "大圖";
            $medium_image_uid = "中圖";
            $small_image_uid = "小圖";
            $discount_uid = "優惠ID";
            $large_image = "大圖";
            $medium_image = "中圖";
            $small_image = "小圖";
            $rank = "排名";
            $user_uid = "用户帳號名稱";
            $user_id = "用户帳號名稱";
            $wcb_price="洗剪吹價錢";
            
            $district="地區";
        } else {
            $salon_uid = "ID";
            $name_tc = "名稱_繁";
            $name_sc = "名稱_簡";
            $name_en = "名稱_英";
            $address_tc = "地址_繁";
            $address_sc = "地址_簡";
            $address_en = "地址_英";
            $lang = "Langtitude";
            $long = "Longtitude";
            $opening_hour = "Opening Hour";
            $other_service = "其他服務";
            $tel = "Tel";
            $hiring_info_tc = "招聘資料_繁";
            $hiring_info_sc = "招聘資料_簡";
            $hiring_info_en = "招聘資料_英";
            $price_list_tc = "價格表_繁";
            $price_list_sc = "價格表_簡";
            $price_list_en = "價格表_英";
            $large_image_uid = "大圖";
            $medium_image_uid = "中圖";
            $small_image_uid = "小圖";
            $discount_uid = "優惠ID";
            $large_image = "大圖";
            $medium_image = "中圖";
            $small_image = "小圖";
            $rank = "排名";
            $user_uid = "User UID";
            $user_id = "User ID";
            $wcb_price="洗剪吹價錢";
            
            $district="地區";
        }
        
        /*
         * Setup this array, then you can control the display of the column
         * control the type of column
         */
        $translation_array = array(
            "salon_uid" => array("value" => $salon_uid),
            "name_tc" => array("value" => $name_tc),
            "name_sc" => array("value" => $name_sc),
            "name_en" => array("value" => $name_en),
            "address_tc" => array("value" => $address_tc),
            "address_sc" => array("value" => $address_sc),
            "address_en" => array("value" => $address_en),
            "lang" => array("value" => $lang),
            "long" => array("value" => $long),
            "opening_hour" => array("value" => $opening_hour),
            "other_service" => array("value" => $other_service),
            "tel" => array("value" => $tel),
            "hiring_info_tc" => array("value" => $hiring_info_tc),
            "hiring_info_sc" => array("value" => $hiring_info_sc),
            "hiring_info_en" => array("value" => $hiring_info_en),
            "price_list_tc" => array("value" => $price_list_tc),
            "price_list_sc" => array("value" => $price_list_sc),
            "price_list_en" => array("value" => $price_list_en),
            "large_image_uid" => array("value" => $large_image_uid),
            "medium_image_uid" => array("value" => $medium_image_uid),
            "small_image_uid" => array("value" => $small_image_uid),
            "discount_uid" => array("value" => $discount_uid),
            "large_image" => array("value" => $large_image),
            "medium_image" => array("value" => $medium_image),
            "small_image" => array("value" => $small_image),
            "rank" => array("value" => $rank),
            "user_uid" => array("value" => $user_uid),
            "user_id" => array("value" => $user_id),
             "wcb_price" => array("value" => $wcb_price),
            
            "district" => array("value" => $district)
            
        );

        return $translation_array;
    }
    
    /*
     * Basic Model Operation
     */
    function values(){
        $value_array = array(
            "salon_uid" => $this->salon_uid,
            "name_tc" => $this->name_tc,
            "name_sc" => $this->name_sc,
            "name_en" => $this->name_en,
            "address_tc" => $this->address_tc,
            "address_sc" => $this->address_sc,
            "address_en" => $this->address_en,
            "lang" => $this->lang,
            "long" => $this->long,
            "opening_hour" => $this->opening_hour,
            "other_service" => $this->other_service,
            "tel" => $this->tel,
            "hiring_info_tc" => $this->hiring_info_tc,
            "hiring_info_sc" => $this->hiring_info_sc,
            "hiring_info_en" => $this->hiring_info_en,
            "price_list_tc" => $this->price_list_tc,
            "price_list_sc" => $this->price_list_sc,
            "price_list_en" => $this->price_list_en,
            "large_image_uid" => $this->large_image_uid,
            "medium_image_uid" => $this->medium_image_uid,
            "small_image_uid" => $this->small_image_uid,
            "rank" => $this->rank,
            "user_uid" => $this->user_uid,
            "wcb_price"=>$this->wcb_price,
           
            "district"=>$this->district
                
        );
        
        return $value_array;
    }
    
    function set_value($fieldname, $value) {
        $this->$fieldname = $value;
    }
    
    /*
     * Basic DB Operation
     */
    function insert($new_model) {
        //Request a new uid
        $new_uid_result = $this->uidgenerator->request_uid($this->table_name);
        $new_uid = $new_uid_result[0]->uid_gen_current_uid;
        
        $new_model->set_value('salon_uid', $new_uid);
        
        return $this->db->insert('sal_salon', $new_model->values());
    }

//    function update($new_model) {
//        $this->title = $_POST['title'];
//        $this->content = $_POST['content'];
//        $this->date = time();
//
//        $this->db->update('entries', $this, array('id' => $_POST['id']));
//    }
//
//    function delete($new_model) {
//    
//    }
    
    //written by chenxidong
    
    function update($model){
        $new_array = $model->values();
        $uid = $model->salon_uid;
        $this->db->where('salon_uid', $uid);
        $this->db->update('sal_salon', $new_array);
    }
    
    function delete($salon_uid) {
        $salon_uid_delete = (int) $salon_uid;

        $this->db->select('large.image_name large_image, medium.image_name medium_image, small.image_name small_image');
        $this->db->from('sal_salon salon');
        $this->db->where('salon_uid', $salon_uid_delete);
        $this->db->join('sys_image large', 'salon.large_image_uid = large.image_uid', 'left');
        $this->db->join('sys_image medium', 'salon.medium_image_uid = medium.image_uid', 'left');
        $this->db->join('sys_image small', 'salon.small_image_uid = small.image_uid', 'left');
        $query = $this->db->get();
        $image_location = $_SERVER['DOCUMENT_ROOT'].'/'.$this->sysparam_model->get_upload_img_path();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $large_image = $row->large_image;
                $medium_image = $row->medium_image;
                $small_image = $row->small_image;
                $large = $image_location . $large_image;
                $medium = $image_location . $large_image;
                $small = $image_location . $large_image;
                unlink($large);
                unlink($medium);
                unlink($small);
            }
        }
        $this->db->delete('sal_salon', array('salon_uid' => $salon_uid_delete));
    }

}

?>