<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class UserModule {

    var $ci = null;

    public function __construct() {
        $this->ci = & get_instance();
    }

    public function login_procedure($username, $password) {
        $login_success = false;
        
        //Check if it is the super user
        if ($username=="super" && $password="admin"){
            
            //Save session
            $login_data = array(
                'brightsystem_login_username' => $username,
                'brightsystem_login_password' => $password,
                'brightsystem_login_role' => 'super'
            );
            $this->ci->session->set_userdata($login_data);
                
            $login_success = true;
        } else {
            $user_exist = false;
            $query = $this->_check_if_user_exist($username, md5($password));
            
            if ($query->num_rows() > 0) {
                $user_exist = true;
            }
            
            $query_result = $query->result();
            
            if ($user_exist) {
                //Check the role
                $user_uid = $query_result[0]->user_uid;
                $role_query = $this->ci->db->get_where('usr_userrole', array('user_uid' => $user_uid));
                
                if ($role_query->num_rows() > 0){
                    $role_result = $role_query->result();
                    $role_uid = $role_result[0]->role_uid;
                    
                    //Save session
                    $login_data = array(
                        'brightsystem_login_username' => $username,
                        'brightsystem_login_password' => $password,
                        'brightsystem_login_role' => $role_uid,
                        'user_uid_using'=>$user_uid
                    );
                    $this->ci->session->set_userdata($login_data);
                }
                
                
            } else {

            }
            $login_success = $user_exist;
        }
        
        return $login_success;
    }
    
    public function logout_procedure() {
        //Clear session
        $login_data = array(
            'brightsystem_login_username' => '',
            'brightsystem_login_password' => '',
            'brightsystem_login_role' => ''
        );
        $this->ci->session->set_userdata($login_data);
            
        return true;
    }
    
    /**
     * @desc check if the user's login id and password is in the database
     * @param $username - the login id, $password - the user password
     * @return
     */
    function _check_if_user_exist($username, $password) {

        //Get the user
        $query = $this->ci->db->get_where('usr_user', array('user_login_id' => $username, 'user_password' => $password));

        //Check if the user exist
//        if ($query->num_rows() > 0) {
//            //User exist
//            return true;
//        } else {
//            //Not exist
//            return false;
//        }
        
        return $query;
    }
    
    function restrict_role_login($rolename){
        $cur_rolename = $this->ci->session->userdata('brightsystem_login_role');
        
        if ($cur_rolename == $rolename){
            return true;
        } else {
            redirect(base_url().index_page()."/admin_platform/login/login_error", 'refresh');
        }
    }
}

/* End of file UserModule.php */
?>