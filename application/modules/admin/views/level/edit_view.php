<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="header-main">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'admin/level' ?>"><i class="fa fa-bars"></i> Level</a></li>
            <li class="active">Edit</li>
        </ol>
        <div class="header-right pull-right"><a href="<?php echo base_url() . $module . '/level'; ?>" class="btn btn-default"><?php echo $this->lang->line('default_cancel');?></a></div>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="<?php echo base_url() . $module . '/level/edit/' . $level['lv_id']; ?>" method="post" id="my_form">
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
                    <h1>Level information</h1>
                    <p>The information of user's level in system</p>
                </div>
                <div class="col-md-9 section-content">
                    <div class="col-md-6 clear form-group">
                        <label for="fname"><?php echo $this->lang->line('level_name');?><span class="star_required">*</span></label>
                        <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $level['lv_name']; ?>" />
                    </div>
                    <div class="col-md-6 clear form-group">
                        <label for="fdescription"><?php echo $this->lang->line('level_description');?></label>
                        <textarea class="form-control" cols="" rows="4" name="fdescription" id="fdescription"><?php echo $level['lv_description']; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="row section buttons">
                <input type="submit" class="btn btn-success pull-right" id="fsubmit" name="fsubmit" value="Edit" />
                <span class="pull-left">
                    <span class="star_required">*</span> : is required
                </span>
            </div>
        </form>
    </section>
</aside>