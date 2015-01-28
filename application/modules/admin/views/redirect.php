<?php
$this->load->view($module . '/top');
$this->load->view($module . '/menu');
?>
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Main content -->
    <section class="content">

        <div class="error-page" style="margin-top: 160px;">
            <div class="error-content">
                <h3><i class="fa fa-warning text-yellow"></i> Oops! Data not found.</h3>
                <p>
                    You can click <a class="redirect_url" href="<?php echo $redirectUrl; ?>">here</a> , If you don't want to wait.
                </p>
            </div><!-- /.error-content -->
        </div><!-- /.error-page -->

    </section>
</aside>
<?php
$this->load->view($module . '/bottom');
?>
<script type="text/javascript">
    setTimeout(function(){
        var redirect_url = $('.redirect_url').attr('href');
        location.href = redirect_url;
    },2000);
</script>