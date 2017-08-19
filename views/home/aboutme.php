<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
  <?php $this->load->view('home/meta') ?>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/home/css/aboutme.css')?>">
	<title>关于我</title>
</head>
<body class="hold-transition skin-blue-light layout-top-nav fixed">
<div class="wrapper">
  <?php $this->load->view('home/header')?>
  <div class="content-wrapper">
    <div class="container">
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
  			    <!-- 面包屑 -->
  			    <section class="content-header">
  		        <ol class="breadcrumb">
  		          <li><i class="fa fa-map-pin"></i> 你当前所在：<a href="<?php echo base_url() ?>">主页</a></li>
  		          <li class="active">关于我</li>
  		        </ol>
  		      </section>
			      <div class="box box-primary">
                <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" src="../../common/dist/img/user4-128x128.jpg" alt="User profile picture">
                  <h3 class="profile-username text-center">谭佳成</h3>
                  <p class="text-muted text-center">程序员</p>
                  <strong><i class="fa fa-book margin-r-5"></i> 教育背景</strong>
                  <p class="text-muted">
                    2012.9-2015-6 重庆电子工程职业学院（大专） 机电一体化专业
                  </p>
                  <hr>
                  <strong><i class="fa fa-map-marker margin-r-5"></i> 目前所在地</strong>
                  <p class="text-muted">重庆市，渝北区</p>
                  <hr>
                  <strong><i class="fa fa-pencil margin-r-5"></i> 技能</strong>
                  <p>
                    <span class="label label-success">Coding</span>
                    <span class="label label-info">html5</span>
                    <span class="label label-info">css3</span>
                    <span class="label label-info">Javascript</span>
                    <span class="label label-info">Jquery</span>
                    <span class="label label-primary">Apache</span>
                    <span class="label label-primary">PHP</span>
                    <span class="label label-primary">Mysql</span>
                  </p>
                  <hr>
                  <strong><i class="fa fa-file-text-o margin-r-5"></i> 其他说明</strong>
                  <p>非计算机专业，毕业后培训机构培训php后开始工作，目前还是noob，弄这个网站的目的就是记录一些经验，日积月累，时间长了就是宝贵的财富。终极目标是全栈，能写前端，能搞后台、能做app、饭要一口一口的吃，慢慢来吧。</p>
                  <strong><i class="fa fa-search margin-r-5"></i> 找到我</strong>
                  <p><button type="btn btn-sm"><i class="fa fa-wechat"></i> 微信</button></p>
                </div>
            </div>	
           </div>
        </div>
      </section>
    </div>
  </div>
<?php $this->load->view('home/footer')?>
 <!-- 下面加载自己的js -->
</body>
</html>
