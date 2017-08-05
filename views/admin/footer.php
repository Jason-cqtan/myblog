
<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo base_url('public/common/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('public/common/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url('public/common/bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('public/common/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url('public/common/plugins/iCheck/icheck.min.js') ?>"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('public/common/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('public/common/bower_components/fastclick/lib/fastclick.js') ?>"></script>
<!-- 日历 -->
<script src="<?php echo base_url('public/common/plugins/My97DatePicker/WdatePicker.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('public/common/dist/js/adminlte.min.js') ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('public/common/dist/js/demo.js') ?>"></script>
<!-- layer -->
<script src="<?php echo base_url('public/common/plugins/layer/layer.js')?>"></script>
<script src="<?php echo base_url('public/admin/js/common.js')?>"></script>
<!-- select2 -->
<script src="<?php echo base_url('public/common/bower_components/select2/dist/js/select2.full.min.js') ?>"></script>
<!-- PACE -->
<script src="<?php echo base_url('public/common/plugins/pace/pace.min.js') ?>"></script>
<script>
  var site_url = "<?php echo site_url();?>";
  var base_url = "<?php echo base_url();?>";
  $(document).ajaxStart(function() { Pace.restart(); });
    var current_method = "<?php echo (empty($this->uri->segment(3)) || strlen($this->uri->segment(3))<3)?urldecode($this->uri->segment(2)):$this->uri->segment(3); ?>";
  $(".sidebar-menu").find('li[currentmethod="'+current_method+'"]').addClass('active').parent().parent().addClass('active');
  //展开标记
  $(".sidebar-menu").find('li').on("click",function(){
     var isopen = $(this).is('.active');
     if(!isopen){
       $(".sidebar-menu").find('li[currentmethod="'+current_method+'"]').addClass('active').parent().parent().addClass('active');
     }
  });
</script>