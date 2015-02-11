<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="header-main">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . $module . '/productcategory'; ?>"><i class="fa fa-square"></i> Product category</a></li>
                <li class="active">Edit</li>
            </ol>
            <div class="header-right pull-right"><a href="<?php echo base_url() . $module . '/productcategory'; ?>" class="btn btn-default"><?php echo $this->lang->line('default_cancel');?></a></div>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <ul class="nav nav-tabs">
            <li role="presentation"><a href="<?php echo base_url() . $module . '/productcategory/edit/' . $productcategory['pc_id'] ?>"><i class="fa fa-info-circle"></i>&nbsp;Info</a></li>
            <li role="presentation" class="active"><a href="javascript:void(0)"><i class="fa fa-square"></i>&nbsp;Attribute</a></li>
        </ul>
        <form action="<?php echo base_url() . $module . '/productfieldgroup/detail/' . $productcategory['pc_id']; ?>" method="post" id="my_form" enctype="multipart/form-data" onsubmit="return false">
            <input type="hidden" id="fpcid" name="fpcid" value="<?php echo $productcategory['pc_id'] ?>" />
            <div class="error">
            </div>
            <div class="row section">
                <div class="col-md-3 section-summary">
                    <h1>Attribute information</h1>
                    <p>The information of product category's attribute in system</p>
                </div>
                <div class="col-md-9 section-content" id="content-data">
                    
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