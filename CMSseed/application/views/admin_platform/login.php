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
        <title>Admin Platform__</title>

        <link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/admin_platform/login.css'); ?>" rel="stylesheet">

    </head>
    <body data-ember-extension="1">
        <div class="container" style="width: 300px;">
            <div class="login_div_box">

                <h2 class="form-signin-heading">登入</h2>
                <?php if ($error) echo "<p class='alert alert-danger' style='text-align: center;'>" . $error . "</p>"; ?>
                <?php
                /*
                 * [Generate the login form]
                 * - login id
                 * - password
                 * - remember me
                 */
                $attributes = array('class' => 'form-signin', 'role' => 'form');
                echo form_open('admin_platform/login/request_login', $attributes);
                $username_data = array(
                    'name' => 'user_login_id',
                    'class' => 'form-control',
                    'placeholder' => 'Username/email',
                    'required' => '',
                    'autofocus' => ''
                );
                echo form_input($username_data);
                $password_data = array(
                    'name' => 'user_password',
                    'class' => 'form-control',
                    'placeholder' => 'Password',
                    'required' => ''
                );
                echo form_password($password_data);

//                    $checkbox_data = array(
//                        'value' => 'remember-me'
//                    );
//                    echo form_checkbox($checkbox_data);
//                    echo form_label('Remember me');

                $button_data = array(
                    'name' => 'loginBut',
                    'class' => 'btn btn-lg btn-primary btn-block',
                    'value' => 'Login'
                );

                echo form_submit($button_data);
                echo form_close();

                $attributes = array('class' => 'form-signin', 'role' => 'form');
                echo form_open('admin_platform/login/register', $attributes);

                //Register button
                echo form_submit($button_data = array(
                'name' => 'registerBut',
                'class' => 'btn btn-lg btn-wranning btn-block',
                'value' => 'User(Change)登記'
                )
                );

                echo form_close();
                
               
                /*
                 * End [Generate the login form]
                 */
                ?>
            </div>
        </div>
         <blockquote>
 <center>       
<br>
 <h2>< INSTRUCTION Here></h2>
<br>


            </center></blockquote>
    </body>
</html>