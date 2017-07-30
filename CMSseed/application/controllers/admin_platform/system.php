<?php

 if (!defined('BASEPATH'))
     exit('No direct script access allowed');

 /**
  * @desc System controller of admin platform
  * @author Rico Chan
  * @required 
  */
 class System extends CI_Controller {

     //Define a constant that hold the path of the all the view files
     const view_dir_path = 'admin_platform/';
//    const model_name = 'salon_model';
//    const image_model_name = 'image_model';
    const sysparam_model_name = 'sysparam_model';
    
     const object_name = 'System';
     const module_name = 'system';

//    var $model_object = null;

     public function __construct() {
         parent::__construct();

//        $this->load->model($this::model_name);
//        $this->load->model($this::image_model_name);
         
        $this->load->model($this::sysparam_model_name);
//        $this->model_object = $this->salon_model;
//        $this->load->library('lib_admin/CRUDLibrary');
     }

     public function account() {
         $user_role = $this->session->userdata('brightsystem_login_role');
         $content_data['user_role'] = $user_role;
         $content_data['user_uid'] = $this->session->userdata('user_uid_using');
         //get the role object detail
         if ($user_role == "super") {
             //
             $content_data['welcome_message'] = 'You are currently login as SUPER account';
         } else if ($user_role == "1000") {
             /*
             Please modify this part
             //Salon
             $this->load->model('stylist_model');
             $this->load->model('salon_model');
             //the using client record
             $content_data['using_client'] = $this->salon_model->get_by_primary_key($content_data['user_uid']);
             //get stylist list
             $content_data['stylist_list'] = $this->stylist_model->getStylistRowBySalonId($content_data['user_uid']);
             //stylist ac
             $array=$this->stylist_model->get_all_for_admin();
             
             $this->load->model('user_model');
             foreach($array as $key => $value)
             {
                 $email=$this->user_model->get_by_primary_key($value->user_uid);
                 if($email!=null)
                 {
                 echo '<br>';
                 
                 $value->email= $email[0]->user_email;
                 }else
                 {
                     $value->email=null;
                 }
                 
                 
                
             }       
            // print_r($array);
             $content_data['stylist'] = $array ;
             $content_data['welcome_message'] = 'You are currently login as SALON account';
             */
             $content_data['welcome_message'] = 'You are currently login as Role 1000 account';
         } else if ($user_role == "1001") {
             /*
             Please modify this part
             //Hair stylist
             $this->load->model('user_model');
             //get the id in hairstyle_model
             $this->load->model('hairstyle_model');
             $this->load->model('stylist_model');
             $sid=$this->stylist_model->get_by_user_key($this->session->userdata('user_uid_using'));
             $content_data['stylist_detail']=$sid;
             $sid=$sid[0]->stylist_uid;
             
             $hairstylearray = array();
             $hairstylearray = $this->hairstyle_model->get_by_stylist_key($sid);
             //get the image path in image_model
             $this->load->model('image_model');
             //get stylist pay or not
             
             $this->load->model('stylist_model');
             $paid= $this->stylist_model->get_by_user_key($content_data['user_uid'] );
             
             $paid= $paid[0]->stylist_paid;
             $content_data['paid'] =$paid;
             $harstyle_path = array();
             $harstyle_id = array();
             foreach ($hairstylearray as $value) {
                 $query = $this->image_model->get_by_primary_key($value['small_img_uid']);
                 array_push($harstyle_path, $query[0]['image_name']);
                 array_push($harstyle_id, $query[0]['image_uid']);
             }


             $content_data['hairstyle_path_list'] = $harstyle_path;
             $content_data['hairstyle_id_list'] = $harstyle_id;
             $content_data['stylist_info'] = $this->user_model->get_by_primary_key($this->session->userdata('user_uid_using'));
             
         */
             $content_data['welcome_message'] = 'You are currently login as Role 1001 account';
         } else {
             $content_data['welcome_message'] = 'Unkonwn role: ' . $user_role;
         }

         //get the user detail
         //Get the current object data
         $header_data['module_name'] = $this::module_name;
         $header_data['user_role'] = $this->session->userdata('brightsystem_login_role');

         $this->load->view($this::view_dir_path . 'admin_header', $header_data);
         $this->load->view($this::view_dir_path . 'system/account', $content_data);
         $this->load->view($this::view_dir_path . 'admin_footer');
     }

     public function addstylish() {
         // echo 'salon_id:'.$_POST['salon_id'];
         // echo 'stylist_id:'.$_POST['stylist_id'];


         $array = array('salon_uid' => $_POST['salon_id']);
         $this->load->model('stylist_model');

         $this->stylist_model->updateStylist($_POST['stylist_id'], $array);
         redirect(base_url() . index_page() . "/admin_platform/system/account", 'refresh');
     }
     
     public function changePW() {
         $this->load->library('userrole/UserModule');
         if (isset($_POST['user_old_password'])) {
             $this->load->model('user_model');

             $username = $this->session->userdata('using_user_name');
             $password = $_POST['user_old_password'];

             $login_success = $this->usermodule->login_procedure($username, $password);
             echo $this->usermodule->login_procedure($username, $password);
             if ($login_success) {
                 if ($_POST['user_new_password'] == $_POST['user_confirm_password']) {
                     /*
                       $newmodel=new User_model();
                       $newmodel=$this->user_model->get_by_primary_key($this->session->userdata('user_uid_using'));
                       print_r($newmodel);
                       $newmodel->set_value('user_password', md5($_POST['user_new_password']));
                       //$newmodel->set_value('user_password',md5($_POST['user_new_password']));
                       echo $newmodel->user_password; */
                     $data = array('user_password' => md5($_POST['user_new_password']));
                     $this->db->where('user_uid', $this->session->userdata('user_uid_using'));
                     $this->db->update('usr_user', $data);
                     redirect(base_url() . index_page() . "/admin_platform/system/account", 'refresh');
             
                 } else {


                     echo 'the new password do not match';
                 }
                 return true;
             } else {

                 return false;
             }
         }
     }

     public function changeInfo() {
         $this->load->library('userrole/UserModule');
         $this->load->model('user_model');
         $edituser = new User_model();
         
         //output old password
         $old=$this->user_model->get_by_primary_key($this->session->userdata('user_uid_using'));
         //print_r($old);
         
         date_default_timezone_set('Hongkong');
         $edituser->set_value("user_uid", $this->session->userdata('user_uid_using'));
         $edituser->set_value("user_first_name", $_POST["first_name"]);
         $edituser->set_value("user_last_name", $_POST["last_name"]);
         $edituser->set_value("user_nick_name", $_POST["nick_name"]);
         $edituser->set_value("user_email", $_POST["email"]);
         $edituser->set_value("user_tel", $_POST["tel"]);
         $edituser->set_value("user_gender", $_POST["gender"]);
         $edituser->set_value("user_login_id", $_POST["login_id"]);
         $edituser->set_value("last_update_date", date('Y-m-d H:i:s'));
         $edituser->set_value("user_password", $old[0]->user_password);
         echo $edituser->first_name;
         print_r($edituser->values());
         $this->user_model->update($edituser);
        redirect(base_url() . index_page() . "/admin_platform/system/account", 'refresh');
     }
     public function updatestylistdetail()
     {
         $this->load->model('stylist_model');
         $edituser= new Stylist_model;
         $edituser=$this->stylist_model->get_by_primary_key($_POST['id']);
         $edituser[0]->stylist_name_tc=$_POST['chinese_name'];
         $edituser[0]->stylist_name_sc=$_POST['simple_name'];
         $edituser[0]->stylist_name_en=$_POST['user_nickname']; 
         $edituser[0]->stylist_experience=$_POST['experience'];
         $edituser[0]->dayoff=$_POST['dayoff'];
         
         
         
         $this->db->where('stylist_uid',$_POST['id']);
         $this->db->update('sal_stylist',$edituser[0]);
         //update phone
         
         $this->load->model('user_model');
         $editmodel=new User_model;
         $editmodel=$this->user_model->get_by_primary_key($edituser[0]->user_uid);
         $editmodel[0]->user_tel=$_POST['phone'];
         
         //$this->user_model->update($editmodel);
           $this->db->where('user_uid', $edituser[0]->user_uid );
           $this->db->update('usr_user', $editmodel[0]);
      
     
         
         redirect(base_url() . index_page() . "/admin_platform/system/account", 'refresh');
     }
     public function uploadimage() {
         $this->load->model('image_model');

         $image_location = $_SERVER['DOCUMENT_ROOT'].$this->sysparam_model->get_upload_img_path();
         echo $image_location;
         $time = time();
         $image_name = $time . '_' . $_FILES["file"]["name"];
         echo' <br>'.$image_name;
         $newmodel = new Image_model();
         //upload file and add record into image_model and sys_image table
         //echo $_FILES["file"]["name"];

         $newmodel->set_value('image_name', $image_name);
         $newmodel->set_value('image_location', $image_location);
         $newmodel->set_value('imagetype_uid', '1');
         
         $id = $this->image_model->insert($newmodel);
         //echo $id;
         move_uploaded_file($_FILES["file"]["tmp_name"], $image_location.$image_name);
         //add record into sal_hairstyle table

         $this->load->model('hairstyle_model');
         $newhairstyle = new Hairstyle_model;
         $newhairstyle->set_value('small_img_uid', $id);
         $newhairstyle->set_value('date',date('Y-m-d H:i:s'));
         $this->load->model('stylist_model');
         $sid= $this->stylist_model->get_by_user_key($this->session->userdata('user_uid_using'));
         $sid= $sid[0]->stylist_uid;
         echo $sid;
         $newhairstyle->set_value('stylist_uid', $sid);
         $this->hairstyle_model->insert($newhairstyle);
         redirect(base_url() . index_page() . "/admin_platform/system/account", 'refresh');
     }
     public function uploadicon() {
         echo $_POST['id'];
         echo $_FILES['file']['name'];
         
         
         $this->load->model('image_model');

         $image_location = $_SERVER['DOCUMENT_ROOT'].$this->sysparam_model->get_upload_img_path();
         echo $image_location;
         $time = time();
         $image_name = $time . '_' . $_FILES["file"]["name"];
         $image_name_png=$image_name.'.png';
         echo' <br>'.$image_name;
         $newmodel = new Image_model();
         //upload file and add record into image_model and sys_image table
         //echo $_FILES["file"]["name"];

         $newmodel->set_value('image_name', $image_name);
         $newmodel->set_value('image_location', $image_location);
         $newmodel->set_value('imagetype_uid', '1');
         
         $id = $this->image_model->insert($newmodel);
         //echo $id;
         move_uploaded_file($_FILES["file"]["tmp_name"], $image_location.$image_name);
         //set the left and right image of small icon by camille
                     
                     
//////////////////////////
                     $dude_L = new Imagick($image_location.$image_name);
                     $dude_R = new Imagick($image_location.$image_name);
                     $mask_L= new Imagick(getcwd() . '\application\controllers\admin_platform\img\mask.png');
                     $mask_R= new Imagick(getcwd() . '\application\controllers\admin_platform\img\mask2.png');

// IMPORTANT! Must activate the opacity channel
// See: http://www.php.net/manual/en/function.imagick-setimagematte.php
                     $dude_L->setImageMatte(1);
                     $dude_R->setImageMatte(1);

// Create composite of two images using DSTIN
// See: http://www.imagemagick.org/Usage/compose/#dstin
                     $dude_L->compositeImage($mask_L, Imagick::COMPOSITE_DSTIN, 0, 0);
                     $dude_R->compositeImage($mask_R, Imagick::COMPOSITE_DSTIN, 0, 0);

// Write image to a file.
                     $dude_L->writeImage($image_location .'LL'. $image_name_png);
                     $dude_R->writeImage($image_location .'RR'.$image_name_png);
                     $image_model_L = new Image_model();
                     $image_model_L->set_value("image_name", 'LL'.$image_name_png);
                     $image_model_L->set_value("image_desc", $image_description);
                     $image_model_L->set_value("image_location", $image_location);
                     $image_model_L->set_value("imagetype_uid", $imagetype_uid);

                     $image_uid_L = $this->image_model->insert($image_model_L);
                     $image_model_R = new Image_model();
                     $image_model_R->set_value("image_name", 'RR'.$image_name_png);
                     $image_model_R->set_value("image_desc", $image_description);
                     $image_model_R->set_value("image_location", $image_location);
                     $image_model_R->set_value("imagetype_uid", $imagetype_uid);

                     $image_uid_R = $this->image_model->insert($image_model_R);
                     echo'<br>image uid L:'.$image_uid_L.$image_name_png;
                     echo'<br>image uid R:'.$image_uid_R.$image_name_png;
                     //$new_salon_model->set_value('small_image_uid_L', $image_uid_L);
                     //$new_salon_model->set_value('small_image_uid_R', $image_uid_R);
//////////////////////////
         $data=array('icon'=>$id,'icon_L'=>$image_uid_L,'icon_R'=>$image_uid_R);
         
         $this->db->where('stylist_uid', $_POST['id']);
         $this->db->update('sal_stylist', $data); 
         
         redirect(base_url() . index_page() . "/admin_platform/system/account", 'refresh');
     
         
     }
     public function uploadicon_big() {
         echo $_POST['id'];
         echo $_FILES['file']['name'];
         
         
         $this->load->model('image_model');

         $image_location = $_SERVER['DOCUMENT_ROOT'].$this->sysparam_model->get_upload_img_path();
         echo $image_location;
         $time = time();
         $image_name = $time . '_' . $_FILES["file"]["name"];
         $image_name_png=$image_name.'.png';
         echo' <br>'.$image_name;
         $newmodel = new Image_model();
         //upload file and add record into image_model and sys_image table
         //echo $_FILES["file"]["name"];

         $newmodel->set_value('image_name', $image_name);
         $newmodel->set_value('image_location', $image_location);
         $newmodel->set_value('imagetype_uid', '1');
         
         $id = $this->image_model->insert($newmodel);
         //echo $id;
         move_uploaded_file($_FILES["file"]["tmp_name"], $image_location.$image_name);
  
         $data=array('icon_big'=>$id);
         $this->db->where('stylist_uid', $_POST['id']);
         $this->db->update('sal_stylist', $data); 
         
         redirect(base_url() . index_page() . "/admin_platform/system/account", 'refresh');
     
         
     }

     public function salonDelStylist($id) {
         $this->load->model('stylist_model');

         $this->stylist_model->salonDelstylist($id);
         redirect(base_url() . index_page() . "/admin_platform/system/account", 'refresh');
     }

     //stylist delete hairstyle
     public function delete_hairstyle($id) {
         $this->load->model('hairstyle_model');
         
         
         
         $this->load->model('image_model');
         $hairmodel_id=$this->hairstyle_model->get_by_image($id);
         //echo $hairmodel_id[0]['hairstyle_uid'];
         $imagemodel_id=$this->image_model->get_by_primary_key($hairmodel_id[0]['small_img_uid']);
         //echo $imagemodel_id[0]['image_name'];
         $this->image_model->deleteRow($imagemodel_id[0]['image_uid']);
         $this->hairstyle_model->delete($hairmodel_id[0]['hairstyle_uid']);
         unlink( $_SERVER['DOCUMENT_ROOT'] . $this->sysparam_model->get_upload_img_path() .$imagemodel_id[0]['image_name']);
         redirect(base_url() . index_page() . "/admin_platform/system/account", 'refresh');
     }

 }

?>