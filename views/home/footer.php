 <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
     <div class="col-xs-12">
       <strong>Copyright &copy; 2015-2017.</strong> 纯手工打造 <a href="<?php echo base_url() ?>"><?php echo base_url() ?></a>
     </div>
    </div>
    <!-- /.container -->
  </footer>
  
<!-- ./wrapper -->
<!-- 登录模态框 -->
<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="false" id="loginmodal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">登录、无需注册使用快捷登录</h4>
      </div>
      <div class="modal-body">
        <a class="btn btn-block btn-social btn-github">
          <i class="fa fa-github"></i> GitHub账号登录
        </a>
        <a class="btn btn-block btn-social btn-google">
          <i class="fa fa-weibo"></i> 新浪微博登录
        </a>
        <a class="btn btn-block btn-social btn-twitter">
          <i class="fa fa-weixin"></i> 微信登录
        </a>
        <a class="btn btn-block btn-social btn-facebook">
          <i class="fa fa-qq"></i> qq账号登录
        </a>
      </div>
    </div>
  </div>
</div>
</div>
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
<!-- PACE -->
<script src="<?php echo base_url('public/common/plugins/pace/pace.min.js') ?>"></script>
<!-- layer -->
<script src="<?php echo base_url('public/common/plugins/layer/layer.js')?>"></script>
<script type="text/javascript">
  $(document).ajaxStart(function() { Pace.restart(); });
  var site_url = "<?php echo site_url()?>";
  var base_url = "<?php echo base_url()?>";
  // 计时
  function show_date_time() {
    window.setTimeout("show_date_time()", 1000);
    BirthDay = new Date("2015-10-30 23:09:35");
    today = new Date();
    //总时间
    timeold = (today.getTime() - BirthDay.getTime());
    sectimeold = timeold / 1000
    secondsold = Math.floor(sectimeold); 
    msPerDay = 24 * 60 * 60 * 1000
    e_daysold = timeold / msPerDay
    daysold = Math.floor(e_daysold);
    e_hrsold = (e_daysold - daysold) * 24;
    hrsold = Math.floor(e_hrsold);
    e_minsold = (e_hrsold - hrsold) * 60;
    minsold = Math.floor((e_hrsold - hrsold) * 60);
    seconds = Math.floor((e_minsold - minsold) * 60);
    var str = daysold + "天" + hrsold + "小时" + minsold + "分" + seconds + "秒";
    $("#runtotaltime").html(str);
}
show_date_time();
// 返回顶部
$(window).scroll(function() {
    if ($(window).scrollTop() > 200)
        $('div.go-top').show();
    else
        $('div.go-top').hide();
});
$('div.go-top').click(function() {
    $('html, body').animate({scrollTop: 0}, 1000);
});
</script>