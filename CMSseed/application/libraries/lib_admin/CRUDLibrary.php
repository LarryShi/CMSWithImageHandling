<?php

class CRUDLibrary extends CI_Controller {
    
    const view_dir_path = 'admin_platform/';
    const sysparam_model_name = 'sysparam_model';
    const image_location='';
    
    var $ci = null;
   
    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->library('lib_admin/ImageLibrary');
        $this->ci->load->model($this::sysparam_model_name);
        $this->image_location = $this->ci->sysparam_model->get_upload_img_path();
        $this->image_location = str_replace('//', '/', $this->image_location);
    }
    
    public function listall($controller){
        $module_name = $controller::module_name;
        $model_object = $controller->model_object;
        $object_name = $controller::object_name;
        
        //Header
        {
            $header_data['module_name'] = $module_name;
            $header_data['user_role'] = $this->ci->session->userdata('brightsystem_login_role');
            
            $this->ci->load->view($this::view_dir_path . 'admin_header', $header_data);
        }
        
        //Content
        {
            $query_result = $model_object->get_all_for_admin();

            /*
            foreach ($query_result as $row)
            {
                echo '--------------------';
                print_r($row);
            }*/
           
            $fields = $this->ci->db->list_fields($model_object->table_name);
            $display_field_name = $model_object->get_field_translation('tc');
            $field_setting = $model_object->get_listall_field_setting();

            $content_data['query_result'] = $query_result;
            $content_data['fields'] = $fields;
            $content_data['display_field_name'] = $display_field_name;
            $content_data['field_setting'] = $field_setting;
            $content_data['uid_field_name'] = $controller::uid_field_name;
            $content_data['object_name'] = $object_name;
            $content_data['allow_edit'] = $model_object::allow_edit;
            $content_data['allow_delete'] = $model_object::allow_delete;
            $content_data['image_pre_url'] = $this->image_location;

            $this->ci->load->view($this::view_dir_path . 'object/listall', $content_data);
        }
        
        //Footer
        {
            $this->ci->load->view($this::view_dir_path . 'admin_footer');
        }
    }
    
    /**
     * @desc create records
     * @param 
     * @return
     */
    public function create($controller) {
        $module_name = $controller::module_name;
        $model_object = $controller->model_object;
        $object_name = $controller::object_name;
        
        $fields = $this->ci->db->list_fields($model_object->table_name);
        $display_field_name = $model_object->get_field_translation('tc');
        $field_setting = $model_object->get_create_field_setting();

        $content_data['fields'] = $fields;
        $content_data['display_field_name'] = $display_field_name;
        $content_data['field_setting'] = $field_setting;

        $content_data['object_name'] = $object_name;
        
        $header_data['module_name'] = $module_name;
        $header_data['user_role'] = $this->ci->session->userdata('brightsystem_login_role');
        
        $this->ci->load->view($this::view_dir_path.'admin_header', $header_data);
        $this->ci->load->view($this::view_dir_path.'object/create', $content_data);
        $this->ci->load->view($this::view_dir_path.'admin_footer');
    }
    
    public function edit($controller, $object_uid){
        $module_name = $controller::module_name;
        $model_object = $controller->model_object;
        $object_name = $controller::object_name;
        
        $query_result = $model_object->get_by_primary_key($object_uid);
        $content_data['query_result'] = $query_result;
        $content_data['uid']=$object_uid;
        
        $fields = $this->ci->db->list_fields($model_object->table_name);
        $display_field_name = $model_object->get_field_translation('tc');
        $field_setting = $model_object->get_edit_field_setting();
        
        $content_data['fields'] = $fields;
        $content_data['display_field_name'] = $display_field_name;
        $content_data['field_setting'] = $field_setting;
        
        $content_data['object_name'] = $object_name;
        $content_data['module_name'] = $module_name;
        
        //Get the current object data
        $header_data['module_name'] = $module_name;
        $header_data['user_role'] = $this->ci->session->userdata('brightsystem_login_role');
        
        $this->ci->load->view($this::view_dir_path.'admin_header', $header_data);
        $this->ci->load->view($this::view_dir_path.'object/edit', $content_data);    
        $this->ci->load->view($this::view_dir_path.'admin_footer');
    }
    
    public function update($controller, $object_uid, $updateModel){
        $object_uid_update=(int)$object_uid;
        $fields = $this->ci->db->list_fields($controller->model_object->table_name);
        $field_setting = $controller->model_object->get_edit_field_setting();
        
        $obj = $controller->model_object;
        $uid_column_name = $obj::uid_column_name;
        
        $query_first = $this->ci->db->get_where($controller->model_object->table_name, array($uid_column_name => $object_uid_update));
        
        foreach ($query_first->result() as $row) {
            foreach ($row as $key=>$value){
                $updateModel->set_value($key, $value);
            }
        }
        
        foreach ($fields as $field_name) {
            if ($field_setting[$field_name]['type'] == "file" && $_FILES[$field_name]["name"]) {
                /*
                 * Handle image files
                 */
                //find the original image uid
                $model_values = $updateModel->values();
                $uid=$model_values[$field_name];
                //update the current image file info
                $this->ci->imagelibrary->handle_updating_image($_FILES[$field_name], $uid);
                
                //set the value of the update model
                $updateModel->set_value($field_name, $uid);
                
            } else if (isset ($_POST[$field_name])){
                /*
                 * Handle text / textarea / checkbox
                 */
                $updateModel->set_value($field_name, $_POST[$field_name]);
            }
        }
        $updateModel->set_value($uid_column_name, $object_uid);
        $controller->model_object->update($updateModel);
    }

    public function delete($model_object, $object_uid){
            
            $model_object->delete($object_uid);
    }
    
    public function insert($controller, $insertModel){
        $fields = $this->ci->db->list_fields($controller->model_object->table_name);
        $field_setting = $controller->model_object->get_create_field_setting();

        foreach ($fields as $field_name) {
          
            if ($field_setting[$field_name]['type'] == "file") {
                /*
                 * Handle image files
                 */

                //insert the current image file info
                $uid=$this->ci->imagelibrary->handle_insert_image($_FILES[$field_name]);
                
                //set the value of the insert model
                $insertModel->set_value($field_name, $uid);
            } else if (isset($_POST[$field_name])) {
               $insertModel->set_value($field_name, $_POST[$field_name]);
            }
        }

        if ($controller->model_object->insert($insertModel)) {
            return true;
        } else {
            return false;
        }
    }
}

