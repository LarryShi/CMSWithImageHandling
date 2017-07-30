<?php

 if (!defined('BASEPATH'))
     exit('No direct script access allowed');

 /**
  * @desc The user module
  * @author Rico Chan
  * @required 
  */
 class User extends CI_Controller {

     //Define a constant that hold the path of the all the view files
     const view_dir_path = 'admin_platform/';
     const model_name = 'user_model';
     const image_model_name = 'image_model';
     const object_name = 'User';
     const module_name = 'user';

     var $model_object = null;

     public function __construct() {
         parent::__construct();

         $this->load->model($this::model_name);
         $this->load->model($this::image_model_name);
         $this->model_object = $this->user_model;

         $this->load->library('lib_admin/CRUDLibrary');
     }

     public function index() {
         //Show all the user
     }

     /**
      * @desc list all records
      * @param 
      * @return
      */
     public function listall() {
         $this->crudlibrary->listall($this);
     }

     public function register() {
//        $first_name = $_POST['user_first_name'];
//        $last_name = $_POST['user_last_name'];
         $nickname = $_POST['user_nickname'];
         $email = $_POST['user_email'];
         $chinesename = $_POST['chinese_name'];
         $simplename = $_POST['simple_name'];
         $exp = $_POST['exp'];
         //check uniqueness of email
         $query = $this->model_object->get_by_email($email);

         if ($query->num_rows() > 0) {
             echo "user email exist, go back and try again.";
         } else {
             //insert into user table
             $user_model = new User_model();
             $random_password = rand(0, 9999);

//        $user_model->set_value('user_first_name', $first_name);
//        $user_model->set_value('user_last_name', $last_name);
             $user_model->set_value('user_nick_name', $nickname);
             $user_model->set_value('user_email', $email);
             $user_model->set_value('user_verified', false);
             $user_model->set_value('user_login_id', $email);
             $user_model->set_value('user_password', md5($random_password));
             $user_model->set_value('user_tel', $_POST['phone']);

             //set its role to hair stylist
             $user_uid = $this->model_object->insert($user_model);
             //add in stylist_model
             $this->load->model('stylist_model');
             $stylist_model = new Stylist_model();

             $stylist_model->set_value('stylist_name_tc', $chinesename);
             $stylist_model->set_value('stylist_name_sc', $simplename);
             $stylist_model->set_value('stylist_name_en', $nickname);
             $stylist_model->set_value('user_uid', $user_uid);
             $stylist_model->set_value('stylist_experience', $exp);
             $stylist_model->set_value('dayoff', $_POST['dayoff']);

             $stylist_uid = $this->stylist_model->insert($stylist_model);

             //add user role
             $query = $this->db->get('usr_userrole');
             $id = $query->num_rows();

             do {
                 $id++;
                 $queryforid = $this->db->get_where('usr_userrole', array('usr_userrole_uid' => $id));
             } while ($queryforid->num_rows() != 0);
             $data = array(
                 'usr_userrole_uid' => $id,
                 'user_uid'=>$user_uid,
                 'role_uid'=>'1001'
             );
             $this->db->insert('usr_userrole',$data);

//        $email = 'ricocmc@gmail.com';
//             $name = 'Rico';
             $body = '你的密碼是 ' . $random_password;

             //Send password email
             $err = $this->_sendEmail($email, $nickname, $body);
             
             if ($err) {
                 echo $err;
             } else {
                 redirect(base_url() . index_page() . "/admin_platform/login/check_email", 'refresh');
             }
             
             return true;
         }
     }

     function _sendEmail($email, $name, $body) {
         $err = "";
         date_default_timezone_set('Asia/Hong_Kong');
         require __DIR__ . '/phpmailer/PHPMailerAutoload.php';
         $mail = new PHPMailer();
         $mail->IsSMTP(true);
         $mail->SMTPDebug = 1;
         $mail->Debugoutput = 'html';
         $mail->Host= "tls://email-smtp.us-east-1.amazonaws.com";
         $mail->Port = 587;
         $mail->SMTPSecure = 'tls';
         $mail->SMTPAuth = true;
         $mail->Username = "AKIAJJ5DMEPRMVPDMAHQ";
         $mail->Password = "AkP/1rfETCkwUFijCJAKt/y9usdqXwGCPGBcbhw7ckpU";
         $mail->setFrom('Thisistophair@gmail.com', '12345!@#$%');
         $mail->Subject = 'TopHair';
         $mail->MsgHTML($body);
         $mail->addAddress($email, $name);
        
         if (!$mail->send()) {
             $err = "Mailer Error: " . $mail->ErrorInfo;
         } else {
             $err = "";
         }
         return $err;
     }

 }

?>
