<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>后台登录</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('public/common/bower_components/bootstrap/dist/css/bootstrap.min.css');?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('public/common/bower_components/font-awesome/css/font-awesome.min.css');?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('public/common/bower_components/Ionicons/css/ionicons.min.css');?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('public/common/dist/css/AdminLTE.min.css');?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('public/common/plugins/iCheck/square/blue.css');?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css" media="screen">
    .login-page, .register-page{
      background: url("<?php echo base_url('public/common/dist/img/boxed-bg.jpg');?>") repeat;
    }
    .vcode{
      margin-bottom: 10px;
    }
    .vcode img{
      margin:0 auto;
      cursor: pointer;
    }
    .vcodeipt{
      height: 40px;
      line-height: 40px;
    }
    .vcodeipt input{
      margin-top: 5px;
      vertical-align: middle;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url('common/index2.html');?>"><b>Admin</b>TJC</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <!-- <p class="login-box-msg">Sign in to start your session</p> -->

    <form method="post" id="loginform">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" placeholder="用户名">
        <span class="glyphicon glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="密码">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row vcode <?php if($_SESSION['usererror'] <= 1){echo 'hidden';}?>">
        <div class="col-xs-6 text-center">
          <img src="<?php echo site_url('common/generateQr/')?>" data-src="<?php echo site_url('common/generateQr/')?>"   id="changevcode" class="img-responsive" title="看不清，点击更换">
        </div>
        <div class="col-xs-6 vcodeipt">
          <input type="text" name="vcode" placeholder="图片验证码" class="form-control">
        </div>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="rememberme" value="1" checked> 记住我
            </label>
          </div>
        </div>
        <div class="col-xs-4">
          <button type="button" class="btn btn-primary btn-block btn-flat" id="sure">登录</button>
        </div>
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url('public/common/bower_components/jquery/dist/jquery.min.js');?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('public/common/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url('public/common/plugins/iCheck/icheck.min.js');?>"></script>
<!-- layer -->
<script src="<?php echo base_url('public/common/plugins/layer/layer.js')?>"></script>
<script>
$(function () {
  $('input').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass: 'iradio_square-blue',
    increaseArea: '20%' // optional
  });
  //点击切换验证码
  $("#changevcode").click(function(){
    var src = $(this).data('src');
    $(this).attr("src",src+Math.random());
  });
  var errornum = 0;
  $("#sure").on("click",function(){
    //表单验证
    var $formobj = $("#loginform");
    var name = $.trim($formobj.find("input[name='username']").val());
    var pwd = $.trim($formobj.find("input[name='password']").val());
    if(name.length < 1 || pwd.length < 1){
      layer.msg('用户名或密码不能为空！', {icon: 5});
      return false;
    }
    $obj = $(this);
    if($obj.hasClass('disabled')){
      return false;
    }
    $obj.addClass('disabled').html('登录中...');
    $.ajax({
       type: "POST",
       url: "<?php echo site_url('admin/login/login') ?>",
       data: $formobj.serialize(),
       dataType:"json",
       success: function(msg){
         $obj.removeClass('disabled').html('登录');
         if(msg['status'] == 'ok'){
          window.location.href='article/allarticle';
         }else{
          errornum++;
          if(errornum > 1){
            $formobj.find("input[name='vcode']").val('');
            $(".vcode").removeClass('hidden');
            $("#changevcode").click();
          }
          layer.msg(msg['msg'], {icon: 5});
         }
       }
    });
    return false;
  })
});
</script>
</body>
</html>
