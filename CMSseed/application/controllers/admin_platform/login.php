<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @desc Handles all actions related to user login
 * @author Rico Chan
 * @required 
 */
class Login extends CI_Controller {

    //Define a constant that hold the path of the all the view files
    const view_dir_path = 'admin_platform/';

    public function __construct() {
        parent::__construct();
        $this->load->library('userrole/UserModule');
    }

    /**
     * @desc loads the login form for user to enter user name and password
     * @param 
     * @return
     */
    public function index() {
        $this->load->view($this::view_dir_path . 'login');
    }

    
    public function login_error() {
        $data['error'] = "Your login id or password is not correct";
        $this->load->view($this::view_dir_path . 'login', $data);
    }
    
    public function check_email() {
        $data['error'] = "Please check your email for login password";
        $this->load->view($this::view_dir_path . 'login', $data);
    }

    /*     * @desc request login action
     * @param 
     * @return
     */
    public function request_login() {
        if (isset($_POST['user_login_id']) && isset($_POST['user_password'])) {
            $username = $_POST['user_login_id'];
            $password = $_POST['user_password'];

            $login_success = $this->usermodule->login_procedure($username, $password);

            if ($login_success) {
                //Redirect to member page
                redirect(base_url().index_page()."/admin_platform/home", 'refresh');
            } else {
                //Show login error message
                redirect(base_url().index_page()."/admin_platform/login/login_error", 'refresh');
            }
        }
    }
     public function confirm_login() {
        if (isset($_POST['user_login_id']) && isset($_POST['user_password'])) {
            $username = $_POST['user_login_id'];
            $password = $_POST['user_password'];
            
            $login_success = $this->usermodule->login_procedure($username, $password);

            if ($login_success) {
               return true;
            } else {
                return false;
            }
        }
    }
    
    public function request_logout() {
        $this->usermodule->logout_procedure();
        
        redirect(base_url().index_page()."/admin_platform/login", 'refresh');
    }

    public function register() {
        $this->load->view($this::view_dir_path . 'register');
    }
}

?>