<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="header-main">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'admin/user' ?>"><i class="fa fa-user"></i> User</a></li>
                <li class="active">Edit</li>
            </ol>
            <div class="header-right pull-right"><a href="<?php echo base_url() . $module . '/user'; ?>" class="btn btn-default"><?php echo $this->lang->line('default_cancel'); ?></a>
            </div>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="<?php echo base_url() . $module . '/user/edit/' . $user['u_id']; ?>" method="post" id="my_form" enctype="multipart/form-data">
            <ul id="myTab" class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#userinfo" id="userinfo-tab" role="tab"
                                                          data-toggle="tab" aria-controls="home" aria-expanded="true">User
                        info</a></li>
                <li role="presentation"><a href="#resetpassword" id="resetpassword-tab" role="tab" data-toggle="tab"
                                           aria-controls="home" aria-expanded="true">Reset password</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="userinfo" aria-labelledby="userinfo-tab">
                    <?php
                    if (validation_errors('<li>', '</li>') != '') {
                        ?>
                        <div class="alert alert-danger alert-dismissable">
                            <i class="fa fa-ban"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo validation_errors('<li>', '</li>'); ?>
                        </div>
                    <?php
                    }
                    if (isset($error) && $error != '') {?>
                        <div class="alert alert-danger alert-dismissable">
                            <i class="fa fa-ban"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $error; ?>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="row section">
                        <div class="col-md-3 section-summary">
                            <h1>User information</h1>

                            <p>The information of user in system</p>
                        </div>
                        <div class="col-md-9 section-content">
                            <div class="col-md-6 clear form-group">
                                <label for="flevel"><?php echo $this->lang->line('user_level'); ?><span
                                        class="star_required">*</span></label>
                                <select id="flevel" name="flevel" class="form-control">
                                    <option value="0">Choose level</option>
                                    <?php
                                    foreach ($levelOptions as $level) {
                                        if ($user['lv_id'] == $level['lv_id']) {
                                            echo '<option selected value="' . $level['lv_id'] . '">' . $level['lv_name'] . '</option>';
                                        } else {
                                            echo '<option value="' . $level['lv_id'] . '">' . $level['lv_name'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 clear form-group">
                                <label for="ffullname"><?php echo $this->lang->line('user_fullname'); ?><span
                                        class="star_required">*</span></label>
                                <input type="text" class="form-control" name="ffullname" id="ffullname"
                                       value="<?php echo $user['u_fullname']; ?>"/>
                            </div>
                            <div class="col-md-6 clear form-group">
                                <label for="fscreenname"><?php echo $this->lang->line('user_screenname'); ?></label>
                                <input type="text" class="form-control" name="fscreenname" id="fscreenname"
                                       value="<?php echo $user['u_screenname']; ?>"/>
                            </div>
                            <div class="col-md-6 clear form-group">
                                <label for="femail"><?php echo $this->lang->line('user_email'); ?><span
                                        class="star_required">*</span></label>
                                <input type="text" class="form-control" name="femail" id="femail"
                                       value="<?php echo $user['up_email']; ?>"/>
                            </div>
                            <div class="col-md-3 clear form-group">
                                <label for="fgender"><?php echo $this->lang->line('user_gender'); ?></label>
                                <select name="fgender" class="form-control">
                                    <option value="0">---</option>
                                    <option <?php if ($user['u_gender'] == 1) { echo 'selected';} ?> value="1">Male</option>
                                    <option <?php if ($user['u_gender'] == 2) { echo 'selected';} ?> value="2">Female</option>
                                </select>
                            </div>
                        </div>
                    </div><!-- end of section -->
                    <div class="row section">
                        <div class="col-md-3 section-summary">
                            <h1>More information</h1>
                            <p>The more information of user in system</p>
                        </div>
                        <div class="col-md-9 section-content">
                            <div class="col-md-6 clear form-group">
                                <label for="fbirthday"><?php echo $this->lang->line('user_fbirthday'); ?></label>
                                <input type="text" class="form-control date-picker" name="fbirthday" id="fbirthday"
                                       value="<?php echo $user['up_birthday']; ?>" data-mask="9999-99-99"/>
                            </div>
                            <div class="col-md-6 clear form-group">
                                <label for="fphone"><?php echo $this->lang->line('user_phone'); ?></label>
                                <input type="text" class="form-control" name="fphone" id="fphone"
                                       value="<?php echo $user['up_phone']; ?>"/>
                            </div>
                            <div class="col-md-8 clear form-group">
                                <label for="faddress"><?php echo $this->lang->line('user_address'); ?></label>
                                <input type="text" class="form-control" name="faddress" id="faddress"
                                       value="<?php echo $user['up_address']; ?>"/>
                            </div>
                            <div class="col-md-8 clear form-group">
                                <label for="fbio"><?php echo $this->lang->line('user_bio'); ?></label>
                                <textarea class="form-control" cols="" rows="4" name="fbio" id="fbio"><?php echo $user['up_bio']; ?></textarea>
                            </div>
                            <div class="col-md-6 clear form-group">
                                <label for="fscreenname"><?php echo $this->lang->line('user_avatar'); ?></label>
                                <input type="file" name="favatar" />
                            </div>
                        </div>
                    </div><!-- end of section -->
                    <div class="row section">
                        <div class="col-md-3 section-summary">
                            <h1>Date & Time</h1>
                            <p>Date time tracking in system</p>
                        </div>
                        <div class="col-md-9 section-content">
                            <div class="col-md-6 clear form-group">
                                <label>Date registered : </label>
                                <span><?php echo date('d-m-Y H:i:s', $user['u_datecreated']) ?>&nbsp;(IP : <?php echo long2ip($user['up_ipaddress']) ?>)</span>
                            </div>
                            <div class="col-md-6 clear form-group">
                                <label>Date modified : </label>
                                <span><?php if($user['up_datemodified'] > 0) {echo date('d-m-Y H:i:s', $user['up_datemodified']);} else {echo 'n/a';} ?></span>
                            </div>
                            <div class="col-md-6 clear form-group">
                                <label>Date last login : </label>
                                <span><?php if($user['up_datelastlogin'] > 0) {echo date('d-m-Y H:i:s', $user['up_datelastlogin']);} else {echo 'n/a';} ?></span>
                            </div>
                        </div>
                    </div><!-- end of section -->
                </div>
                <!-- end of tab -->
                <div role="tabpanel" class="tab-pane fade in" id="resetpassword" aria-labelledby="resetpassword-tab">
                    <div class="row section">
                        <div class="col-md-3 section-summary">
                            <h1>Reset password</h1>
                            <p>Reset password of user in system</p>
                        </div>
                        <div class="col-md-9 section-content">
                            <div class="col-md-6 clear form-group">
                                <label for="fpassword"><?php echo $this->lang->line('user_password');?></label>
                                <input type="password" class="form-control" name="fpassword" id="fpassword" />
                            </div>
                            <div class="col-md-6 clear form-group">
                                <label for="frepassword"><?php echo $this->lang->line('user_repassword');?></label>
                                <input type="password" class="form-control" name="frepassword" id="frepassword" />
                            </div>
                        </div>
                    </div>
                </div><!-- end of tab-->
            </div>
            <!-- end of tab content-->
            <div class="row section buttons">
                <input type="submit" class="btn btn-success pull-right" id="fsubmit" name="fsubmit" value="Edit"/>
                <span class="pull-left">
                    <span class="star_required">*</span> : is required
                </span>
            </div>
        </form>
    </section>
</aside>