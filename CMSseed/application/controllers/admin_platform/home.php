<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @desc Front page of admin platform
 * @author Rico Chan
 * @required 
 */
class Home extends CI_Controller {

    //Define a constant that hold the path of the all the view files
    const view_dir_path = 'admin_platform/';

    public function __construct() {
        parent::__construct();
    }

    /**
     * @desc the first page entering the admin page
     * @param 
     * @return
     */
    public function index() {
        $header_data['module_name'] = '';
        $header_data['user_role'] = $this->session->userdata('brightsystem_login_role');
            
        $this->load->view($this::view_dir_path.'admin_header', $header_data);
        $this->load->view($this::view_dir_path.'admin_home');
        $this->load->view($this::view_dir_path.'admin_footer');
    }
}

?>