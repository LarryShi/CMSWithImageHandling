<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

        <title>CMS</title>

        <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

    </head>

    <body>
        <div class="page-header"><h3>APPLICATION Name<small> Content Management System</small></h3></div>
        <div class="bs-example">
            <ul class="nav nav-tabs">
                <?php
                    if ($user_role == 'super'){
                ?> 
                
                <li class="dropdown <?php if ($module_name=='option') echo 'active'; ?>">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                        <span class="glyphicon glyphicon-certificate"></span>选项1<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo site_url('admin_platform/option/create'); ?>">創建</a></li>
                        <li><a href="<?php echo site_url('admin_platform/option/listall'); ?>">顯示全部</a></li>
                    </ul>
                </li>
                <li class="dropdown <?php if ($module_name=='userrole') echo 'active'; ?>">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                        <span class="glyphicon glyphicon-user"></span> 用戶 <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo site_url('admin_platform/user/listall'); ?>">用戶</a></li>
                        <!--<li><a href="<?php echo site_url('admin_platform/role/listall'); ?>">Role</a></li>-->
                    </ul>
                </li>
              
                <?php
                    }
                ?>
                <li class="dropdown pull-right <?php if ($module_name=='system') echo 'active'; ?>">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                        <span class="glyphicon glyphicon-cog"></span> 系統 <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo site_url('admin_platform/system/account'); ?>">戶口</a></li>
                        <li><a href="<?php echo site_url('admin_platform/login/request_logout'); ?>">登出</a></li>
                        <li class="divider"></li>
                        <li><a href="#">關於</a></li>
                    </ul>
                </li>
            </ul>
        </div>