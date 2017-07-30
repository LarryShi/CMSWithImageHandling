<?php

class Stylist_model extends CI_Model {

    var $stylist_uid = '';
    var $stylist_name_tc = '';
    var $stylist_name_sc = '';
    var $stylist_name_en = '';
    var $stylist_experience = '';
    var $salon_uid = '';
    var $stylist_paid = '';
    var $user_uid = '';
    var $dayoff = '';
    
    var $table_name = 'sal_stylist';

    const allow_edit = true;
    const allow_delete = false;
    const uid_column_name = 'stylist_uid';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('uidgenerator/UidGenerator');
    }

    function get_by_primary_key($uid) {
        $query = $this->db->get_where($this->table_name, array($this::uid_column_name => $uid));
        return $query->result();
    }
    function get_by_user_key($uid) {
        $query = $this->db->get_where($this->table_name, array('user_uid' => $uid));
        return $query->result();
    }
    
    function get_all_for_admin() {
        $this->db->select('stylist.*, salon.name_tc salon_name');
        $this->db->from('sal_stylist stylist');
        $this->db->join('sal_salon salon', 'salon.salon_uid = stylist.salon_uid' , 'left');
        
        $query = $this->db->get();
        
        return $query->result();
    }

    function get_listall_field_setting() {
        /*
         * Setup this array, then you can control the display of the column
         * control the type of column
         */
        $setting = array(
            "stylist_uid" => array("display" => true, "type" => "text"),
            "stylist_name_tc" => array("display" => true, "type" => "text"),
            "stylist_name_sc" => array("display" => true, "type" => "text"),
            "stylist_name_en" => array("display" => true, "type" => "text"),
            "stylist_experience" => array("display" => true, "type" => "text"),
            "salon_uid" => array("display" => false, "type" => "text"),
            "salon_name" => array("display" => true, "type" => "text"),
            "stylist_paid" => array("display" => true, "type" => "boolean"),
            "user_uid" => array("display" => false, "type" => "text"),
            "dayoff" => array("display" => true, "type" => "text")
        );

        return $setting;
    }

    function get_create_field_setting() {
        /*
         * Setup this array, then you can control the display of the column
         * control the type of column
         */
        $setting = array(
            "stylist_uid" => array("display" => false, "type" => "text", "required" => false),
            "stylist_name_tc" => array("display" => true, "type" => "text", "required" => true),
            "stylist_name_sc" => array("display" => true, "type" => "text", "required" => true),
            "stylist_name_en" => array("display" => true, "type" => "text", "required" => true),
            "stylist_experience" => array("display" => true, "type" => "text", "required" => true),
            "salon_uid" => array("display" => true, "type" => "text", "required" => true),
            "user_uid" => array("display" => false, "type" => "text", "required" => false),
            "dayoff" => array("display" => true, "type" => "text", "required" => true)
        );

        return $setting;
    }

    function get_edit_field_setting() {
        /*
         * Setup this array, then you can control the display of the column
         * control the type of column
         */
        $this->db->select('name_tc option_name, salon_uid option_value');
        $this->db->from('sal_salon');
        $query = $this->db->get();
        $data_array = $query->result();
        
        $paid_option_array = array(
            array("option_name"=>"已付款", "option_value"=>1),
            array("option_name"=>"未付款", "option_value"=>0)
            );
        $object = json_decode(json_encode($paid_option_array), FALSE);
        
        $setting = array(
            "stylist_uid" => array("display" => false, "type" => "text", "required" => false),
            "stylist_name_tc" => array("display" => true, "type" => "text", "required" => true),
            "stylist_name_sc" => array("display" => true, "type" => "text", "required" => true),
            "stylist_name_en" => array("display" => true, "type" => "text", "required" => true),
            "stylist_experience" => array("display" => true, "type" => "text", "required" => true),
            "salon_uid" => array("display" => true, "type" => "dropdown", "required" => true, "list" => $data_array),
            "stylist_paid" => array("display" => true, "type" => "dropdown", "required" => true, "list" => $object),
            "user_uid" => array("display" => false, "type" => "text", "required" => true),
            "dayoff" => array("display" => true, "type" => "text", "required" => true)
        );

        return $setting;
    }

    function get_field_translation($language) {
        if ($language == "tc") {
            $stylist_uid = "ID";
            $stylist_name_tc = "名稱_繁";
            $stylist_name_sc = "名稱_簡";
            $stylist_name_en = "名稱_英";
            $stylist_experience = "經驗";
            $salon_uid = "髮屋ID";
            $salon_name = "髮屋";
            $stylist_paid = "付費";
            $user_uid = "用戶 ID";
            $dayoff = "放假";
        } else {
            $stylist_uid = "ID";
            $stylist_name_tc = "名稱_繁";
            $stylist_name_sc = "名稱_簡";
            $stylist_name_en = "名稱_英";
            $stylist_experience = "Experience";
            $salon_uid = "Salon ID";
            $salon_name = "Salon Name";
            $stylist_paid = "Paid";
            $user_uid = 'User ID';
            $dayoff = 'Dayoff';
        }

        $translation_array = array(
            "stylist_uid" => array("value" => $stylist_uid),
            "stylist_name_tc" => array("value" => $stylist_name_tc),
            "stylist_name_sc" => array("value" => $stylist_name_sc),
            "stylist_name_en" => array("value" => $stylist_name_en),
            "stylist_experience" => array("value" => $stylist_experience),
            "salon_uid" => array("value" => $salon_uid),
            "salon_name" => array("value" => $salon_name),
            "stylist_paid" => array("value" => $stylist_paid),
            "user_uid" => array("value" => $user_uid),
            "dayoff" => array("value" => $dayoff)
        );

        return $translation_array;
    }

    /*
     * Basic Model Operation
     */

    function values() {
        $value_array = array(
            "stylist_uid" => $this->stylist_uid,
            "stylist_name_tc" => $this->stylist_name_tc,
            "stylist_name_sc" => $this->stylist_name_sc,
            "stylist_name_en" => $this->stylist_name_en,
            "stylist_experience" => $this->stylist_experience,
            "salon_uid" => $this->salon_uid,
            "stylist_paid" => $this->stylist_paid,
            "user_uid" => $this->user_uid,
            "dayoff" => $this->dayoff
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

        $new_model->set_value('stylist_uid', $new_uid);

        return $this->db->insert('sal_stylist', $new_model->values());
    }

    //get a row of stylist by the id is salon id
    function getStylistRowBySalonId($id) {
        $query = $this->db->get_where('sal_stylist', array('salon_uid' => $id));
        return $query->result();
    }

//    function updateStylist($id, $array) {
//        $this->db->where('stylist_uid', $id);
//        $this->db->update('sal_stylist', $array);
//    }
    
    function update($model){
        $new_array = $model->values();
        $uid_column_name = $this::uid_column_name;
        $uid = $model->$uid_column_name;
        $this->db->where($this::uid_column_name, $uid);
        $this->db->update($this->table_name, $new_array);
    }

    function salonDelStylist($id) {
        $this->db->where('stylist_uid', $id);
        $this->db->update('sal_stylist', array('salon_uid' => ''));
    }

}

?>