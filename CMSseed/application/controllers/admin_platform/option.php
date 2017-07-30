<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Option extends CI_Controller {

    //Define a constant that hold the path of the all the view files
    const view_dir_path = 'admin_platform/';
    // Here we need to defines the Model Name:
    const model_name = 'option_model';
    
    const object_name = 'Option';//Here Change the Name of the object to display the content
   
    const module_name = 'option'; //please remain same as the name of this page
    
    //define the primary key here, in order to use the library
    //please be the same with the var name in the model
    //Don't change the var name
    const uid_field_name = "id";

    var $model_object = null;
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model($this::model_name);
        $this->model_object = $this->option_model;
        $this->load->library('lib_admin/CRUDLibrary');
        $this->load->library('userrole/UserModule');
    }

    /**
     * @desc list all records
     * @param 
     * @return
     */
    
    public function listall() {
        $this->usermodule->restrict_role_login('super');
        $this->crudlibrary->listall($this);
    }

    /**
     * @desc create records
     * @param 
     * @return
     */
    public function create() {
        $this->usermodule->restrict_role_login('super');
        $this->crudlibrary->create($this);
    }
    
    public function edit($object_uid) {
        $this->usermodule->restrict_role_login('super');
        $this->crudlibrary->edit($this, $object_uid);
    }
    
    //changed by chenxidong
    public function insert() {
        $this->usermodule->restrict_role_login('super');
    
        if ($this->crudlibrary->insert($this,new Option_model())) {
            redirect(base_url() . index_page() . "/admin_platform/option/listall", 'refresh');
        } else {
            
        }
    }
    
    public function update($object_uid) {
        /**
        for example only
        please modify it as needed 
        */
        //please change the model to your own model
        $updateModel = new Option_model();
        $this->crudlibrary->update($this, $object_uid, $updateModel);
        redirect(base_url() . index_page() . "/admin_platform/option/listall", 'refresh');
    }
    
    public function delete($object_uid) {
        /**
        for example only
        please modify it as needed 
        */
        
        $this->usermodule->restrict_role_login('super');
        $this->crudlibrary->delete($this->model_object, $object_uid);
        redirect(base_url() . index_page() . "/admin_platform/option/listall", 'refresh');
        //to do  
    }
}
?>