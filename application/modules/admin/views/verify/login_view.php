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
    </head>
    <body class="bg-guitar">

        <div class="form-box" id="login-box">
            <div class="header">Sign In</div>
            <form action="" method="post" id="my_form">
                <div class="body bg-gray">
                    <?php
                        if (validation_errors('<li>','</li>') != '') {
                        ?>
                            <div class="alert alert-danger alert-dismissable">
                                <i class="fa fa-ban"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <?php echo validation_errors('<li>', '</li>'); ?>
                            </div>
                        <?php
                        }

                        if (isset($error) && $error != '') { ?>
                            <div class="alert alert-danger alert-dismissable">
                                <i class="fa fa-ban"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <?php echo '<li>'.$error.'</li>'; ?>
                            </div>
                    <?php
                        }
                    ?>
                    <div class="form-group">
                        <input type="text" name="femail" class="form-control" placeholder="Your email"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="fpassword" class="form-control" placeholder="Password"/>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="frememberme"/> Remember me
                    </div>
                </div>
                <div class="footer">
                    <button type="submit" class="btn bg-olive btn-block">Sign me in</button>

                    <p><a href="#">I forgot my password</a></p>

                    <a href="register.html" class="text-center">Register a new membership</a>
                </div>
            </form>

            <div class="margin text-center">
                <span>Sign in using social networks</span>
                <br/>
                <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
                <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
                <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>

            </div>
        </div>

        <script src="<?php echo base_url() . 'public/' . $template_html . '/' . $module; ?>/js/jquery.min.js"></script>
        <script src="<?php echo base_url() . 'public/' . $template_html . '/' . $module; ?>/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>