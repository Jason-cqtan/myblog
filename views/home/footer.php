 <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
     <div class="col-xs-12">
       <strong>Copyright &copy; 2015-2017 <a href="#">xxx</a>.</strong> 存手工打造
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
<!-- layer -->
<script src="<?php echo base_url('public/common/plugins/layer/layer.js')?>"></script>
<script type="text/javascript">
  $("#search").on("click",function(){
    //清空表单
    $("#searchModal").modal("toggle");
  })
  var site_url = "<?php echo site_url()?>";
  var base_url = "<?php echo base_url()?>";
  //游客点击查看信息
  $("#visitormenu").on("click",function(){
    if($(this).hasClass('open')){
      //
    }
  })
  //前端登录
  $(".homelogin").on("click",function(){
layer.open({
  type: 1,
  content: '<div>hello world!</div>' //这里content是一个DOM，注意：最好该元素要存放在body最外层，否则可能被其它的相对元素所影响
});
  })
</script>