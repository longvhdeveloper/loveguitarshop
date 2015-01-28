<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title;?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="<?php echo base_url() . 'public/' . $template_html . '/' . $module;  ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() . 'public/' . $template_html . '/' . $module;  ?>/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url() . 'public/' . $template_html . '/' . $module;  ?>/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() . 'public/' . $template_html . '/' . $module;  ?>/css/main.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <?php
        if (isset($css) && !empty($css)) {
            foreach ($css as $file) {
                echo '<link href="'.base_url().'public/'.$template_html . '/' . $module.'/css/'.$file.'" rel="stylesheet" type="text/css" />';
            }
        }
        ?>
        <script type="text/javascript">
            var baseUrl = "<?php echo base_url(); ?>";
        </script>
        <script type="text/javascript" src="<?php echo base_url(). 'public/' . $template_html . '/' . $module . '/js/plugin/ckeditor/ckeditor.js'; ?>"></script>
    </head>
	<body class="skin-blue">
		<header class="header">
            <a href="<?php echo base_url() . $module . '/user';?>" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                LoveGuitarShop
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                                <span><?php echo $userInfo['fullname']; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <?php
                                    if ($userInfo['avatar'] == '') {
                                        echo '<img src="' .base_url().'public/default/admin/img/no-avatar.png" class="img-circle" alt="'.$userInfo['fullname'].'" />';
                                    } else {
                                        echo '<img src="' .base_url().'uploads/user/avatar/'.$userInfo['avatar'].'" class="img-circle" alt="'.$userInfo['fullname'].'" />';
                                    }
                                    ?>
                                    <p>
                                        <?php echo $userInfo['fullname']; ?> - Web Developer
                                        <?php
                                        if ($userInfo['datecreated'] != '') {
                                            echo '<small>Member since '.date('M.Y', $userInfo['datecreated']).'</small>';
                                        }
                                        ?>
                                    </p>
                                </li>
                                <!-- Menu Body -->
<!--                                <li class="user-body">-->
<!--                                    <div class="col-xs-4 text-center">-->
<!--                                        <a href="#">Followers</a>-->
<!--                                    </div>-->
<!--                                    <div class="col-xs-4 text-center">-->
<!--                                        <a href="#">Sales</a>-->
<!--                                    </div>-->
<!--                                    <div class="col-xs-4 text-center">-->
<!--                                        <a href="#">Friends</a>-->
<!--                                    </div>-->
<!--                                </li>-->
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo base_url() . 'admin/user/edit/' . $userInfo['uid']; ?>" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo base_url() . 'admin/verify/logout'; ?>" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <div class="wrapper row-offcanvas row-offcanvas-left">