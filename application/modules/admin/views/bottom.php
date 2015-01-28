</section>
<!-- right col -->
</div>
<!-- /.row (main row) -->

</section>
<!-- /.content -->
</aside>
<!-- /.right-side -->
</div>
<!-- ./wrapper -->
<script type="text/javascript">
    var menu = "<?php echo ($menu != '' ? $menu : 'dashboard'); ?>";
</script>
<script src="<?php echo base_url() . 'public/' . $template_html . '/' . $module; ?>/js/jquery.min.js"></script>
<script src="<?php echo base_url() . 'public/' . $template_html . '/' . $module; ?>/js/bootstrap.min.js" type="text/javascript"></script>
<!--<script src="--><?php //echo base_url() . 'public/' . $template_html . '/' . $module; ?><!--/js/jquery-ui.min.js" type="text/javascript"></script>-->
<script src="<?php echo base_url() . 'public/' . $template_html . '/' . $module; ?>/js/plugin/bootstrap-confirmation.min.js" type="text/javascript"></script>
<?php
if (isset($js) && !empty($js)) {
    foreach ($js as $file) {
        echo '<script type="text/javascript" src="'.base_url().'public/'.$template_html . '/' . $module.'/js/'.$file.'"></script>';
    }
}
?>
<!-- AdminLTE App -->
<script src="<?php echo base_url() . 'public/' . $template_html . '/' . $module; ?>/js/app.js" type="text/javascript"></script>
<script src="<?php echo base_url() . 'public/' . $template_html . '/' . $module; ?>/js/main.js" type="text/javascript"></script>

</body>
</html>
