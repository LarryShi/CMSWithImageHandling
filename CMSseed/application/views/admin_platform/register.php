<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

$this->load->helper('form');
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">
        <title>Admin Platform</title>

        <link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/admin_platform/login.css'); ?>" rel="stylesheet">
    </head>
    <body data-ember-extension="1">
        <div class="container" style="width: 300px;">
            <div class="login_div_box">
                <h2 class="form-signin-heading">User登記 Example, Please Change this Code in register.php</h2>
                <?php if ($error) echo "<p class='alert alert-danger' style='text-align: center;'>" . $error . "</p>"; ?>
                <?php
                /*
                 * [Generate the login form]
                 * - login id
                 * - password
                 * - remember me
                 */
                $attributes = array('class' => 'form-signin', 'role' => 'form');
                echo form_open('api_1_0_0/user/register', $attributes);

//                $firstname_data = array(
//                    'name' => 'user_first_name',
//                    'class' => 'form-control',
//                    'placeholder' => 'First Name',
//                    'required' => 'true',
//                    'autofocus' => ''
//                );
//                echo form_input($firstname_data);
//                
//                $lastname_data = array(
//                    'name' => 'user_last_name',
//                    'class' => 'form-control',
//                    'placeholder' => 'Last Name',
//                    'required' => 'true',
//                    'autofocus' => ''
//                );

                $nickname_data = array(
                    'name' => 'user_nickname',
                    'class' => 'form-control',
                    'placeholder' => '名字（英)',
                    'required' => 'true',
                    'autofocus' => ''
                );
                    
                echo form_input($nickname_data);
                $username_data = array(
                    'name' => 'chinese_name',
                    'class' => 'form-control',
                    'placeholder' => '名字（繁）',
                    'required' => 'true',
                    'autofocus' => ''
                );
                
                echo form_input($username_data);
                $username_data = array(
                    'name' => 'simple_name',
                    'class' => 'form-control',
                    'placeholder' => '名字（簡）',
                    'required' => 'true',
                    'autofocus' => ''
                );
                
                echo form_input($username_data);
                $username_data = array(
                    'name' => 'user_email',
                    'class' => 'form-control',
                    'placeholder' => '電郵',
                    'required' => 'true',
                    'autofocus' => ''
                );
                
                echo form_input($username_data);
                $username_data = array(
                    'name' => 'exp',
                    'class' => 'form-control',
                    'placeholder' => '經驗（數字）',
                    'required' => 'true',
                    'autofocus' => ''
                );
                
                echo form_input($username_data);
                $username_data = array(
                    'name' => 'phone',
                    'class' => 'form-control',
                    'placeholder' => '電話（數字）',
                    'required' => 'true',
                    'autofocus' => ''
                );
                
                echo form_input($username_data);
                $username_data = array(
                    'name' => 'dayoff',
                    'class' => 'form-control',
                    'placeholder' => '休息日',
                    'required' => 'true',
                    'autofocus' => ''
                );
                
                echo form_input($username_data);
                
                $button_data = array(
                    'name' => 'loginBut',
                    'class' => 'btn btn-lg btn-primary btn-block',
                    'value' => 'Register'
                );

                echo form_submit($button_data);
                echo form_close();

                /*
                 * End [Generate the login form]
                 */
                ?>
            </div>
        </div>
    </body>
</html>