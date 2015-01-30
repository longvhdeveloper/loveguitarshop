<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="header-main">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(). $module . 'productcategory'; ?>"><i class="fa fa-square"></i> <?php echo $this->lang->line('category_head_list'); ?>(<?php echo $total; ?>)</a></li>
            </ol>
            <div class="header-right pull-right">
                <a href="<?php echo base_url() . $module . '/productcategory/add'; ?>" class="btn btn-success pull-right"><i class="fa fa-plus"></i>&nbsp;<?php echo $this->lang->line('default_add');?></a>
            </div>
        </h1>
    </section>

     <!-- Main content -->
    <section class="content">
        <div class="box-body">
            <?php
            if ($message != '') {
            ?>
            <div class="alert alert-success alert-dismissable">
                <i class="fa fa-check"></i>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $message; ?>
            </div>
            <?php } ?>
            <table id="users" class="table table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th width="100"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($productcategorys as $productcategory) {
                    echo '<tr>';
                    echo '<td>'.$productcategory['pc_id'].'</td>';
                    echo '<td>'.$productcategory['pc_name'].'</td>';
                    echo '<td>'.$productcategory['pc_slug'].'</td>';
                    if ($productcategory['pc_status'] == 1) {
                        echo '<td><span class="label label-success">Enable</span></td>';
                    } else{
                        echo '<td><span class="label label-danger">Disable</span></td>';
                    }
                    echo '<td>';
                ?>
                    <!-- Single button -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Action <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo base_url() . $module . '/productcategory/edit/' . $productcategory['pc_id']; ?>"><i class="fa fa-pencil"></i>&nbsp;Edit</a></li>
                            <li><a href="javascript:void(0)" rel="<?php echo base_url() .$module . '/productcategory/delete/' . $productcategory['pc_id']; ?>" class="btn-delete"><i class="fa fa-trash-o"></i>&nbsp;Delete</a></li>
                        </ul>
                    </div>
                    <?php
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
                </tbody>
            </table>
        </div><!-- /.box-body -->
    </section>
</aside>