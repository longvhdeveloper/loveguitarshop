<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="header-main">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(). $module . 'level'; ?>"><i class="fa fa-bars"></i> <?php echo $this->lang->line('user_head_list'); ?>(<?php echo $total; ?>)</a></li>
            </ol>
            <div class="header-right pull-right">
                <a href="<?php echo base_url() . $module . '/level/add'; ?>" class="btn btn-success pull-right"><i class="fa fa-plus"></i>&nbsp;<?php echo $this->lang->line('default_add');?></a>
                <div class="formfilterpaginatorwrapper pull-right">
                    <?php
                    echo $pagination_link;
                    ?>
                </div>
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
            <table id="levels" class="table table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th width="100"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($levels as $level) {
                    echo '<tr>';
                    echo '<td>'.$level['lv_id'].'</td>';
                    echo '<td>'.$level['lv_name'].'</td>';
                    echo '<td>';
                ?>
                 <!-- Single button -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Action <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo base_url() . $module . '/level/edit/' . $level['lv_id']; ?>"><i class="fa fa-pencil"></i>&nbsp;Edit</a></li>
                            <li><a href="javascript:void(0)" rel="<?php echo base_url() .$module . '/level/delete/' . $level['lv_id']; ?>" class="btn-delete"><i class="fa fa-trash-o"></i>&nbsp;Delete</a></li>
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