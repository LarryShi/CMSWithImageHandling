<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @desc The user module
 * @author Rico Chan
 * @required 
 */
class User extends CI_Controller {
    
    const view_dir_path = 'admin_platform/';
    const model_name = 'user_model';
    const image_model_name = 'image_model';
    const object_name = 'User';
    const module_name = 'userrole';
    const uid_field_name = 'user_uid';

    var $model_object = null;
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model($this::model_name);
        $this->load->model($this::image_model_name);
        $this->model_object = $this->user_model;
        
        $this->load->library('lib_admin/CRUDLibrary');
        $this->load->library('userrole/UserModule');
    }
    
    public function listall(){
        $this->usermodule->restrict_role_login('super');
        
        $this->crudlibrary->listall($this);
    }
    
}

?>
