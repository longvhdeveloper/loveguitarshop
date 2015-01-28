<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1 class="header-main">
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url() . 'admin/user' ?>"><i class="fa fa-user"></i> User</a></li>
			<li class="active">Add</li>
		</ol>
		<div class="header-right pull-right"><a href="<?php echo base_url() . $module . '/user'; ?>" class="btn btn-default"><?php echo $this->lang->line('default_cancel');?></a></div>
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<form action="<?php echo base_url() . $module . '/user/add'; ?>" method="post" id="my_form">
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
            ?>
			<div class="row section">
				<div class="col-md-3 section-summary">
					<h1>User information</h1>
					<p>The information of user in system</p>
				</div>
				<div class="col-md-9 section-content">
                    <div class="col-md-6 clear form-group">
                        <label for="flevel"><?php echo $this->lang->line('user_level');?><span class="star_required">*</span></label>
                        <select id="flevel" name="flevel" class="form-control">
                            <option value="0">Choose level</option>
                            <?php
                            foreach ($levelOptions as $level['lv_id']) {
                                if ((int)set_value('flevel') == $level) {
                                    echo '<option selected value="' . $level['lv_id'] . '">' . $level['lv_name'] . '</option>';
                                } else {
                                    echo '<option value="' . $level['lv_id'] . '">' . $level['lv_name'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
					<div class="col-md-6 clear form-group">
						<label for="ffullname"><?php echo $this->lang->line('user_fullname');?><span class="star_required">*</span></label>
						<input type="text" class="form-control" name="ffullname" id="ffullname" value="<?php echo set_value('ffullname'); ?>" />
					</div>
					<div class="col-md-6 clear form-group">
						<label for="femail"><?php echo $this->lang->line('user_email');?><span class="star_required">*</span></label>
						<input type="text" class="form-control" name="femail" id="femail" value="<?php echo set_value('femail'); ?>" />
					</div>
					<div class="col-md-6 clear form-group">
						<label for="fpassword"><?php echo $this->lang->line('user_password');?><span class="star_required">*</span></label>
						<input type="password" class="form-control" name="fpassword" id="fpassword" />
					</div>
					<div class="col-md-6 clear form-group">
						<label for="frepassword"><?php echo $this->lang->line('user_repassword');?><span class="star_required">*</span></label>
						<input type="password" class="form-control" name="frepassword" id="frepassword" />
					</div>
				</div>
			</div>
            <div class="row section buttons">
                <input type="submit" class="btn btn-success pull-right" id="fsubmit" name="fsubmit" value="Add" />
                <span class="pull-left">
                    <span class="star_required">*</span> : is required
                </span>
            </div>
		</form>
	</section>
</aside>