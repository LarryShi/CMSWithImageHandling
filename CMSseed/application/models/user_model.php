<?php

class User_model extends CI_Model {

    /*
     * Columns and table name
     */
    var $user_uid = '';
    var $user_first_name = '';
    var $user_last_name = '';
    var $user_nick_name = '';
    var $user_email = '';
    var $user_tel = '';
    var $user_gender = '';
    var $user_login_id = '';
    var $user_password = '';
    var $user_last_login = '';
    var $last_update_user = '';
    var $last_update_date = '';
    var $create_user = '';
    var $create_date = '';
    var $user_verified = '';
    
    var $table_name = 'usr_user';

    const role_table_name = 'usr_role';
    const userrole_table_name = 'usr_userrole';
    
    const allow_edit = false;
    const allow_delete = false;
    
    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('uidgenerator/UidGenerator');
    }
    
    function get_by_primary_key($uid) {
        $key = (int)$uid;
        $query = $this->db->get_where($this->table_name, array('user_uid' => $key));
        return $query->result();
    }
    
    function get_role_uid_by_primary_key($uid){
        $query = $this->db->get_where('userrole', array('user_uid' => $uid));
        return $query->result();
    }
    
    function get_by_email($email) {
        $query = $this->db->get_where($this->table_name, array('user_email' => $email));
        return $query;
    }
    
    function get_by_user_login_id($user_login_id) {
        $query = $this->db->get_where($this->table_name, array('user_login_id' => $user_login_id));
        return $query;
    }
    
    function get_all_for_admin() {
        $query = $this->db->get($this->table_name);
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
            "user_uid" => array( "display" => true, "type" => "text"),
            "user_first_name" => array("display" => true, "type" => "text"),
            "user_last_name" => array("display" => true, "type" => "text"),
            "user_nick_name" => array("display" => true, "type" => "text"),
            "user_email" => array("display" => true, "type" => "text"),
            "user_tel" => array("display" => true, "type" => "text"),
            "user_gender" => array("display" => true, "type" => "text"),
            "user_login_id" => array("display" => true, "type" => "text"),
            "user_password" => array("display" => false, "type" => "boolean"),
            "user_verified" => array("display" => false, "type" => "boolean"),
            "user_last_login" => array("display" => false, "type" => "image"),
            "last_update_user" => array("display" => false, "type" => "image"),
            "last_update_date" => array("display" => false, "type" => "image"),
            "create_user" => array("display" => false, "type" => "image"),
            "create_date" => array("display" => false, "type" => "image")
        );
        
        return $setting;
    }
    
    function get_create_field_setting(){
        /*
         * Setup this array, then you can control the display of the column
         * control the type of column
         */
        $setting = array(
            "user_uid" => array( "display" => false, "type" => "text", "required" => false),
            "user_first_name" => array("display" => true, "type" => "text", "required" => true),
            "user_last_name" => array("display" => true, "type" => "text", "required" => true),
            "user_nick_name" => array("display" => true, "type" => "text", "required" => true),
            "user_email" => array("display" => true, "type" => "text", "required" => true),
            "user_tel" => array("display" => true, "type" => "text", "required" => true),
            "user_gender" => array("display" => true, "type" => "text", "required" => true),
            "user_login_id" => array("display" => true, "type" => "text", "required" => true),
            "user_password" => array("display" => true, "type" => "boolean", "required" => true),
            "user_verified" => array("display" => true, "type" => "boolean", "required" => true),
            "user_last_login" => array("display" => false, "type" => "image", "required" => true),
            "last_update_user" => array("display" => false, "type" => "image", "required" => true),
            "last_update_date" => array("display" => false, "type" => "image", "required" => true),
            "create_user" => array("display" => true, "type" => "image", "required" => true),
            "create_date" => array("display" => true, "type" => "image", "required" => true)
        );
        
        return $setting;
    }
    
//    function get_edit_field_setting(){
//        /*
//         * Setup this array, then you can control the display of the column
//         * control the type of column
//         */
//        $setting = array(
//            "salon_uid" => array( "display" => false, "type" => "text", "required" => false),
//            "address" => array("display" => true, "type" => "text", "required" => true),
//            "lang" => array("display" => true, "type" => "text", "required" => true),
//            "long" => array("display" => true, "type" => "text", "required" => true),
//            "opening_hour" => array("display" => true, "type" => "text", "required" => true),
//            "tel" => array("display" => true, "type" => "text", "required" => true),
//            "hiring_info" => array("display" => true, "type" => "text", "required" => true),
//            "price_list" => array("display" => true, "type" => "text", "required" => true),
//            "detailed" => array("display" => true, "type" => "checkbox", "required" => false),
//            "large_image_uid" => array("display" => true, "type" => "file", "required" => true),
//            "medium_image_uid" => array("display" => true, "type" => "file", "required" => true),
//            "small_image_uid" => array("display" => true, "type" => "file", "required" => true),
//            "large_image" => array("display" => false, "type" => "file", "required" => false),
//            "medium_image" => array("display" => false, "type" => "file", "required" => false),
//            "small_image" => array("display" => false, "type" => "file", "required" => false)
//        );
//        
//        return $setting;
//    }
    
    function get_field_translation($language){
        if ($language=="tc"){
            $user_uid = 'ID';
            $user_first_name = 'First Name';
            $user_last_name = 'Last Name';
            $user_nick_name = 'Nick Name';
            $user_email = 'Email';
            $user_tel = 'Tel';
            $user_gender = 'Gender';
            $user_login_id = 'LoginID';
            $user_password = 'Password';
            $user_verified = '已認證';
            $user_last_login = 'Last Login';
            $last_update_user = 'Last Update User';
            $last_update_date = 'Last Update';
            $create_user = 'Create User';
            $create_date = 'Create Date';
        } else {
            $user_uid = 'ID';
            $user_first_name = 'First Name';
            $user_last_name = 'Last Name';
            $user_nick_name = 'Nick Name';
            $user_email = 'Email';
            $user_tel = 'Tel';
            $user_gender = 'Gender';
            $user_login_id = 'LoginID';
            $user_password = 'Password';
            $user_last_login = 'Last Login';
            $last_update_user = 'Last Update User';
            $last_update_date = 'Last Update';
            $create_user = 'Create User';
            $create_date = 'Create Date';
        }
        
        /*
         * Setup this array, then you can control the display of the column
         * control the type of column
         */
        $translation_array = array(
            "user_uid" => array("value" => $user_uid),
            "user_first_name" => array("value" => $user_first_name),
            "user_last_name" => array("value" => $user_last_name),
            "user_nick_name" => array("value" => $user_nick_name),
            "user_email" => array("value" => $user_email),
            "user_tel" => array("value" => $user_tel),
            "user_gender" => array("value" => $user_gender),
            "user_login_id" => array("value" => $user_login_id),
            "user_password" => array("value" => $user_password),
            "user_last_login" => array("value" => $user_last_login),
            "last_update_user" => array("value" => $last_update_user),
            "last_update_date" => array("value" => $last_update_date),
            "create_user" => array("value" => $create_user),
            "create_date" => array("value" => $create_date)
        );

        return $translation_array;
    }
    
    /*
     * Basic Model Operation
     */
    function values(){
        $value_array = array(
            "user_uid" => $this->user_uid,
            "user_first_name" => $this->user_first_name,
            "user_last_name" => $this->user_last_name,
            "user_nick_name" => $this->user_nick_name,
            "user_email" => $this->user_email,
            "user_tel" => $this->user_tel,
            "user_gender" => $this->user_gender,
            "user_login_id" => $this->user_login_id,
            "user_password" => $this->user_password,
            "user_last_login" => $this->user_last_login,
            "last_update_user" => $this->last_update_user,
            "last_update_date" => $this->last_update_date,
            "create_user" => $this->create_user,
            "create_date" => $this->create_date
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
        
        $new_model->set_value('user_uid', $new_uid);
        $this->db->insert('usr_user', $new_model->values());
        
        return $new_uid;
    }
    
    function insert_user_role($user_uid, $role_uid){
        //Request a new uid
        $new_uid_result = $this->uidgenerator->request_uid($this::userrole_table_name);
        $new_uid = $new_uid_result[0]->uid_gen_current_uid;
        
//        $new_model->set_value('user_uid', $new_uid);
        $value_array = array("usr_userrole_uid"=>$new_uid,"user_uid"=>$user_uid,"role_uid"=>$role_uid);
        $this->db->insert($this::userrole_table_name, $value_array);
        
        return $new_uid;
    }

//    function update($new_model) {
//        $this->title = $_POST['title'];
//        $this->content = $_POST['content'];
//        $this->date = time();
//
//        $this->db->update('entries', $this, array('id' => $_POST['id']));
//    }
//
    function delete($uid){
        $uid_delete=(int)$uid;
        $this->db->delete('usr_user', array('user_uid' => $uid_delete));
    }
    
    function delete_userrole($uid){
        $uid_delete=(int)$uid;
        $this->db->delete('usr_userrole', array('user_uid' => $uid_delete));
    }
     function update($model){
        $new_array = $model->values();
        
        $uid = $model->user_uid;
            $this->db->where('user_uid', $uid);
           $this->db->update('usr_user', $new_array);

    }
}
?>