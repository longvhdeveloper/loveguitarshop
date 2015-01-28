<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="header-main">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . $module . '/vendor'; ?>"><i class="fa fa-male"></i> Vendor</a></li>
                <li class="active">Edit</li>
            </ol>
            <div class="header-right pull-right"><a href="<?php echo base_url() . $module . '/vendor'; ?>" class="btn btn-default"><?php echo $this->lang->line('default_cancel');?></a></div>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="<?php echo base_url() . $module . '/vendor/edit/' . $vendor['v_id']; ?>" method="post" id="my_form" enctype="multipart/form-data">
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
            <?php
            if (isset($error) && $error != ''){
            ?>
                <div class="alert alert-danger alert-dismissable">
                    <i class="fa fa-ban"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <li><?php echo $error; ?></li>
                </div>
            <?php }
            ?>
            <div class="row section">
                <div class="col-md-3 section-summary">
                    <h1>Vendor information</h1>
                    <p>The information of vendor in system</p>
                </div>
                <div class="col-md-9 section-content">
                    <div class="col-md-6 clear form-group">
                        <label for="fname"><?php echo $this->lang->line('vendor_name');?><span class="star_required">*</span></label>
                        <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $vendor['v_name']; ?>" />
                    </div>
                    <div class="col-md-6 clear form-group">
                        <label for="fslug"><?php echo $this->lang->line('vendor_slug');?><span class="star_required">*</span></label>
                        <input type="text" class="form-control" name="fslug" id="fslug" value="<?php echo $vendor['v_slug']; ?>" />
                    </div>
                    <div class="col-md-6 clear form-group">
                        <label for="flogo"><?php echo $this->lang->line('vendor_logo');?></label>
                        <input type="file" name="flogo" id="flogo" />
                    </div>
                    <?php
                        if ($vendor['v_logo'] != '') {
                            echo '<div class="col-md-6 clear form-group">';
                            echo '<img src="'.base_url().'uploads/vendor/logo/'.$vendor['v_logo'].'" width="200" height="200" /><br/>';
                            echo '<div style="margin-top:10px;">Is delete logo ?';
                            echo '<select name="fisdeletelogo" style="margin-left:20px;"><option value="0">No</option><option value="1">Yes</option></select></div>';
                            echo '</div>';
                        }
                        ?>
                    <div class="col-md-12 clear form-group">
                        <label for="fdescription"><?php echo $this->lang->line('vendor_description');?></label>
                        <textarea class="form-control" cols="" rows="4" name="fdescription" id="fdescription"><?php echo set_value('fdescription'); ?></textarea>
                    </div>
                    <script>
                        CKEDITOR.replace( 'fdescription' );
                    </script>

                    <div class="col-md-3 clear form-group">
                        <label for="fstatus"><?php echo $this->lang->line('vendor_status');?></label>
                        <select id="fstatus" name="fstatus" class="form-control">
                            <?php
                            foreach ($statusOptions as $id => $name) {
                                echo '<option value="'.$id.'">'.$name.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row section buttons">
                <input type="submit" class="btn btn-success" id="fsubmit" name="fsubmit" value="Edit" />
                <span class="pull-left">
                    <span class="star_required">*</span> : is required
                </span>
            </div>
        </form>
    </section>
</aside>