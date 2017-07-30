<?php
 error_reporting(E_ALL ^ E_NOTICE);
 session_start();

 $this->load->helper('form');
?>
<br/>
<div class="panel panel-default" style="width: 80%; margin-left: auto; margin-right: auto;">
    <div class="panel-heading">
        <h3 class="panel-title">Role object</h3>
    </div>
    <div class="panel-body">
        <?php
         echo $welcome_message . "<br/><br/>";
//        echo "Role UID: ".$user_role."<br/>";
//        echo "By using this role uid to design role specific content.";
         if ($user_role == "super") {
             
         } else if ($user_role == "1000") {
             /*
             This part is just the demo, please change it if needed.
             //Salon
             echo "Stylist list:";
             echo "<br/>";
             foreach ($stylist_list as $value) {
                 echo $value->stylist_name_tc;
                 echo '<a href="' . base_url() . index_page() . '/admin_platform/system/salonDelStylist/' .$value->stylist_uid . '"><span class="glyphicon glyphicon-remove"></span></a>';
                 
                 echo "<br/>";
             }


             echo "Add hair stylist to salon:<br/>";
             echo form_open('admin_platform/system/addstylish');
             echo ""
             . "<select name='stylist_id'>"
             . "<option value=''></option>";

             foreach ($stylist as $record) {
                 echo "<option value='" . $record->stylist_uid . "' >" . $record->email .' '.$record->stylist_name_tc. "</option>";
             }

             echo "</select>"
             . "<br>"
             . "<input type='hidden' value='" . $this->session->userdata('user_uid_using') . "' name='salon_id'>"
             . "<input type='submit' value='Submit'>"
             . "</form>";
             */
         } else if ($user_role == "1001") {
            /*
            This is just a demo
            Please change this part of code   
             //hair stylist
             echo "Paid account:<br/>"; 
             if($paid==0){
                 echo 'false';
             }else {
                 echo 'true';
             }
             echo "<br/>";
             echo "<br/>Current hair style:<br/>";
             
             foreach ($hairstyle_path_list as $key => $value) {
                 if($key%3==0)
                 {
                     echo'<br>';
                 }
                echo "<div style='display:inline-block;width:210px;text-align:center;'>";
                echo "<img style='width: 200px;height: 200px;;' src='http://46.137.211.46/tophair_uploaded_image/img/" . $value . "'/>";
                echo "<br/>";
                echo "<a href='" . base_url() . index_page() . "/admin_platform/system/delete_hairstyle/" . $hairstyle_id_list[$key] . "'><button>Delete</button></a>";
                echo "</div>";
            }
            
            if($paid==1){
            echo "<br/><br/>Upload hair style:<br/>";
              $attributes = array('method' => 'POST', 'role' => 'form','enctyle'=>'multipart/form-data');
            // echo form_open('/admin_platform/stylistUpload/uploadimage',$attributes);
            //use form_open the utf-8 make it unable to upload 
              
              echo '<form role="form" action="' . base_url() . index_page() . '/admin_platform/system/uploadimage" method="post" enctype="multipart/form-data" class=" col-xs-12 " >
';
             $username_data = array(
                 'name' => 'file',
                 
                 'type' => 'file'
             );
            //echo form_input($username_data);
            echo '<input type="file" name="file"/> ';
             echo form_submit($button_data = array(
                 'name' => 'registerBut',
                 'class' => '',
                 'value' => 'submit'
                     )
             );
             echo form_close();
              }  else {
                  
              }
     
         echo "<br/>Current Stylist information:<br/>";
         //big icon 
         echo "<br/>big_icon:";
         $query= $this->db->get_where('sys_image',array('image_uid'=>$stylist_detail[0]->icon_big));
         $iconPath=$query->first_row()->image_name;
         echo "<img style='width: 200px;height: 200px;;' src='http://46.137.211.46/tophair_uploaded_image/img/" . $iconPath . "'/>";
         //upload icon
          echo '<form role="form" action="' . base_url() . index_page() . '/admin_platform/system/uploadicon_big" method="post" enctype="multipart/form-data" class=" col-xs-12 " >
';
             $username_data = array(
                    'name' => 'id',
                    
                    'type'=>'hidden',
                    
                    'value'=>$stylist_detail[0]->stylist_uid
                );
                
                echo form_input($username_data);
            
            echo '<input type="file" name="file"/> ';
             echo form_submit($button_data = array(
                 'name' => 'registerBut',
                 'class' => '',
                 'value' => 'submit'
                     )
             );
             echo form_close();
                 
         echo "<p>the image of big icon suggested in resolution 895WX895H</p>";
         //end of big icon by camille
         //find the related icon of hairstylist
         echo "<br/>Icon:";
         $query= $this->db->get_where('sys_image',array('image_uid'=>$stylist_detail[0]->icon));
         $iconPath=$query->first_row()->image_name;
         echo "<img style='width: 200px;height: 200px;;' src='http://46.137.211.46/tophair_uploaded_image/img/" . $iconPath . "'/>";
         //upload icon
          echo '<form role="form" action="' . base_url() . index_page() . '/admin_platform/system/uploadicon" method="post" enctype="multipart/form-data" class=" col-xs-12 " >
';
             $username_data = array(
                    'name' => 'id',
                    
                    'type'=>'hidden',
                    
                    'value'=>$stylist_detail[0]->stylist_uid
                );
                
                echo form_input($username_data);
            
            echo '<input type="file" name="file"/> ';
             echo form_submit($button_data = array(
                 'name' => 'registerBut',
                 'class' => '',
                 'value' => 'submit'
                     )
             );
             echo form_close();
              
             echo "<p>the image of icon must in resolution 634WX396H</p>";
         echo form_open('admin_platform/system/updatestylistdetail', $attributes);
                
                $nickname_data = array(
                    'name' => 'user_nickname',
                    'class' => 'form-control',
                    'placeholder' => '名字（英)',
                    'required' => 'true',
                    'autofocus' => '',
                    'value'=>$stylist_detail[0]->stylist_name_en
                );
                    
                echo form_input($nickname_data);
                $username_data = array(
                    'name' => 'chinese_name',
                    'class' => 'form-control',
                    'placeholder' => '名字（繁）',
                    'required' => 'true',
                    'autofocus' => '',
                    'value'=>$stylist_detail[0]->stylist_name_tc
                );
                
                echo form_input($username_data);
                $username_data = array(
                    'name' => 'simple_name',
                    'class' => 'form-control',
                    'placeholder' => '名字（簡）',
                    'required' => 'true',
                    'autofocus' => '',
                'value'=>$stylist_detail[0]->stylist_name_sc
                );
                
                
                
                echo form_input($username_data);
                $username_data = array(
                    'name' => 'experience',
                    'class' => 'form-control',
                    'placeholder' => '經驗（數字）',
                    'required' => 'true',
                    'autofocus' => '',
                'value'=>$stylist_detail[0]->stylist_experience
                );
                
                
                
                echo form_input($username_data);
                 $username_data = array(
                    'name' => 'phone',
                    'class' => 'form-control',
                    'placeholder' => ' 電話',
                    'required' => 'true',
                    'autofocus' => '',
                'value'=>$stylist_info[0]->user_tel
                );
                
                
                
                echo form_input($username_data);
                $username_data = array(
                    'name' => 'dayoff',
                    'class' => 'form-control',
                    'placeholder' => ' 休息日',
                    'required' => 'true',
                    'autofocus' => '',
                'value'=>$stylist_detail[0]->dayoff
                );
                
                
                
                echo form_input($username_data);
                $username_data = array(
                    'name' => 'id',
                    'class' => 'form-control',
                    'type'=>'hidden',
                    'autofocus' => '',
                    'value'=>$stylist_detail[0]->stylist_uid
                );
                
                echo form_input($username_data);
                $username_data = array(
                    'name' => 'old_icon',
                    'class' => 'form-control',
                    'type'=>'hidden',
                    'autofocus' => '',
                    'value'=>$stylist_detail[0]->icon
                );
                
                echo form_input($username_data);
                $button_data = array(
                    'name' => 'loginBut',
                    'class' => 'btn btn-lg btn-primary btn-block',
                    'value' => 'Update'
                );

                echo form_submit($button_data);
                echo form_close();
                */
             
                }



        ?>
    </div>
</div>

<div class="panel panel-default" style="width: 80%; margin-left: auto; margin-right: auto;">
    <div class="panel-heading">
        <h3 class="panel-title">User</h3>
    </div>
    <div class="panel-body">
        UserUID: <?php echo $user_uid ?>
        <br/>
       
<?php
  /*
 if ($user_role != "1000" &&$user_role != "super") {
     
     echo "<br/>";
     echo "更新資料:";

     $attributes = array('class' => 'form-signin', 'role' => 'form');
     echo form_open('admin_platform/system/changeInfo', $attributes);
     $username_data = array(
         'name' => 'first_name',
         'class' => 'form-control',
         'placeholder' => 'First name',
         'required' => '',
         'autofocus' => '',
         'value' => $stylist_info[0]->user_first_name
     );
     echo form_input($username_data);
     $username_data = array(
         'name' => 'last_name',
         'class' => 'form-control',
         'placeholder' => 'Last name',
         'required' => '',
         'autofocus' => '',
         'value' => $stylist_info[0]->user_last_name
     );
     echo form_input($username_data);
     $username_data = array(
         'name' => 'nick_name',
         'class' => 'form-control',
         'placeholder' => 'Nick name',
         'required' => '',
         'autofocus' => '',
         'value' => $stylist_info[0]->user_nick_name
     );
     echo form_input($username_data);
     $username_data = array(
         'name' => 'email',
         'class' => 'form-control',
         'placeholder' => 'Email',
         'required' => '',
         'autofocus' => '',
         'value' => $stylist_info[0]->user_email
     );
     echo form_input($username_data);
     $username_data = array(
         'name' => 'tel',
         'class' => 'form-control',
         'placeholder' => 'Tel',
         'required' => '',
         'autofocus' => '',
         'value' => $stylist_info[0]->user_tel
     );
     echo form_input($username_data);
     $username_data = array(
         'name' => 'gender',
         'class' => 'form-control',
         'placeholder' => 'Gender',
         'required' => '',
         'autofocus' => '',
         'value' => $stylist_info[0]->user_gender
     );
     echo form_input($username_data);
     $username_data = array(
         'name' => 'login_id',
         'class' => 'form-control',
         'placeholder' => 'LoginID',
         'required' => '',
         'autofocus' => '',
         'value' => $stylist_info[0]->user_login_id
     );
     echo form_input($username_data);
     $username_data = array(
         'name' => 'user_login_id',
         'class' => 'form-control',
         'placeholder' => 'Verified',
         'required' => '',
         'autofocus' => ''
     );
     echo form_input($username_data);
     echo form_submit($button_data = array(
         'name' => 'registerBut',
         'class' => 'btn btn-lg btn-wranning btn-block',
         'value' => '更新資料'
             )
     );
     echo form_close();
   
 }* 
   */
 if($user_role != "super")
 {
 echo "<br/>";
 echo "更改密碼:";


 $this->session->set_userdata(array('using_user_name' => $using_client->user_login_id));
 echo form_open('admin_platform/system/changePW/', $attributes);

 $old_password_data = array(
     'name' => 'user_old_password',
     'class' => 'form-control',
     'placeholder' => 'Old Password',
     'required' => ''
 );
 echo form_password($old_password_data);
 $new_password_data = array(
     'name' => 'user_new_password',
     'class' => 'form-control',
     'placeholder' => 'New Password',
     'required' => ''
 );
 echo form_password($new_password_data);
 $confirm_password_data = array(
     'name' => 'user_confirm_password',
     'class' => 'form-control',
     'placeholder' => 'Confirm Password',
     'required' => ''
 );
 echo form_password($confirm_password_data);

 echo form_submit($button_data = array(
     'name' => 'registerBut',
     'class' => 'btn btn-lg btn-wranning btn-block',
     'value' => '更改密碼'
         )
 );

 echo form_close();
 }
?>
    </div>
</div>