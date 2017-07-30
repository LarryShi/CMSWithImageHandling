<?php

 class Image_model extends CI_Model {
     /*
      * Columns and table name
      */

     var $image_uid = '';
     var $image_name = '';
     var $image_desc = '';
     var $image_location = '';
     var $imagetype_uid = '';
     var $table_name = 'sys_image';

     function __construct() {
         // Call the Model constructor
         parent::__construct();
         $this->load->library('uidgenerator/UidGenerator');
     }

     /*
      * Basic Model Operation
      */

     function values() {
         $value_array = array(
             "image_uid" => $this->image_uid,
             "image_name" => $this->image_name,
             "image_desc" => $this->image_desc,
             "image_location" => $this->image_location,
             "imagetype_uid" => $this->imagetype_uid
         );

         return $value_array;
     }
     function get_by_primary_key($id)
     {
         $query=$this->db->get_where('sys_image',array('image_uid'=>$id));
        
         return $query->result_array();
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

         $new_model->set_value('image_uid', $new_uid);

         $this->db->insert('sys_image', $new_model->values());

         return $new_uid;
     }

     //written by chenxidong

     function update($uid, $update_img) {
         $data = array(
             "image_uid" => $update_img['image_uid'],
             "image_name" => $update_img['image_name'],
             "image_desc" => $update_img['image_desc'],
             "image_location" => $update_img['image_location'],
             "imagetype_uid" => $update_img['imagetype_uid']
         );

         $this->db->where('image_uid', $uid);
         $this->db->update('sys_image', $data);
     }

     //written by chenxidong
     function delete($uid) {
         $salon_uid_delete = (int) $uid;
         $image_id_value = array(
             "large_image_uid" => 1,
             "medium_image_uid" => 1,
             "small_image_uid" => 1
         );

         $query_first = $this->db->get_where('sal_salon', array('salon_uid' => $salon_uid_delete));
         foreach ($query_first->result() as $row) {
             $image_id_value["large_image_uid"] = $row->large_image_uid;
             $image_id_value["medium_image_uid"] = $row->medium_image_uid;
             $image_id_value["small_image_uid"] = $row->small_image_uid;
         }
         foreach ($image_id_value as $key => $value) {
             $this->db->delete('sys_image', array('image_uid' => $value));
         }
     }
     function deleteRow($uid)
     {
         $this->db->delete('sys_image', array('image_uid' => $uid));
     }
/*might not use
     function newimage($data) {
         $newmodel = new Image_model() ;
         $query=$this->db->get_where('sys_uid_gen',array('uid_gen_table_name'=>'sys_image'));
         $newid=$query->first_row()->uid_gen_current_uid;
         $newid++;
         
         //update new sys_uid_gen
         $this->db->where('uid_gen_table_name','sys_image');
         $this->db->update('sys_uid_gen',array('uid_gen_current_uid'=>$newid));
         array_push($data, array('image_uid'=>$newid));
         $this->db->insert('sys_image',$data);
         return $newid;
         
     }
*/
 }
 