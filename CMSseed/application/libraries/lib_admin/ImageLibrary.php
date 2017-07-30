<?php

class ImageLibrary extends CI_Controller {
    
    const view_dir_path = 'admin_platform/';
    const image_model_name = 'image_model';
    const sysparam_model_name = 'sysparam_model';
    
    var $ci = null;

    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->model($this::image_model_name);
        $this->ci->load->model($this::sysparam_model_name);
    }

    public function handle_updating_image($file_value, $uid) {
        /*
         * $file_value is the $_FILE['input name']
         * $uid is the current uid of the image
         */
        
        //Remove the old image
       // print_r($this->ci->image_model->get_by_primary_key($uid));
        $old_image_result = $this->ci->image_model->get_by_primary_key($uid);
        $old_image_name = $old_image_result[0]['image_name'];
        $old_image_location = $old_image_result[0]['image_location'];

        $tmp =$old_image_location.$old_image_name;
        $tmp = str_replace('//', '/', $tmp);
        unlink( $tmp);

                  
        //Upload the new image and update record
        $time = time();
        $image_name = $time.'_'.$file_value["name"];
        $image_location = $_SERVER['DOCUMENT_ROOT'].'/'.$this->ci->sysparam_model->get_upload_img_path();
        $image_description = '';
        $tmp = str_replace('//', '/', $file_value['tmp_name']);
        $tmp2 = $image_location.$image_name;
        $tmp2 = str_replace('//', '/', $tmp2);
        move_uploaded_file($tmp, $tmp2);
        
        $update_img=array(
            "image_uid"      => $uid,
            "image_name"     => $image_name,
            "image_desc"     => $image_description,
            "image_location" => $image_location,
            "imagetype_uid"  => 0
        );

        $this->ci->image_model->update($uid,$update_img);

        return array("name"=>$image_name, "location"=>$image_location);
        
    }
    
    public function handle_insert_image($file_value){
        //insert new image
        $time = time();
        $image_name = $time . '_' . $file_value["name"];
        $image_description = '';
        $image_location = $_SERVER['DOCUMENT_ROOT'].'/'.$this->ci->sysparam_model->get_upload_img_path();
        $imagetype_uid = 1; 
        
        $image_model = new Image_model();
        $image_model->set_value("image_name", $image_name);
        $image_model->set_value("image_desc", $image_description);
        $image_model->set_value("image_location", $image_location);
        $image_model->set_value("imagetype_uid", $imagetype_uid);
        
        $image_uid = $this->ci->image_model->insert($image_model);
        $tmp2 = $image_location.$image_name;
        $tmp2 = str_replace('//', '/', $tmp2);
        move_uploaded_file($file_value["tmp_name"],  $tmp2);
        //exit;
        return $image_uid;
    }
}
