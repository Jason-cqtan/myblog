 <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
     <div class="col-xs-12">
       <strong>Copyright &copy; 2015-2017 <a href="#">xxx</a>.</strong> 存手工打造
     </div>
    </div>
    <!-- /.container -->
  </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo base_url('public/common/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('public/common/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('public/common/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('public/common/bower_components/fastclick/lib/fastclick.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('public/common/dist/js/adminlte.min.js') ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('public/common/dist/js/demo.js') ?>"></script>
<!-- layer -->
<script src="<?php echo base_url('public/common/plugins/layer/layer.js')?>"></script>
<script type="text/javascript">
  $("#search").on("click",function(){
    //清空表单
    $("#searchModal").modal("toggle");
  })
  var site_url = "<?php echo site_url()?>";
  var base_url = "<?php echo base_url()?>";
</script>