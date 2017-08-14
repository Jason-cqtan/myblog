<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
  <?php $this->load->view('home/meta') ?>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/home/css/aboutme.css')?>">
	<title>首页</title>
</head>
<body class="hold-transition skin-blue-light layout-top-nav fixed">
<div class="wrapper">

  <?php $this->load->view('home/header')?>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
			<!-- 面包屑 -->
			<section class="content-header">
		        <ol class="breadcrumb">
		          <li><i class="fa fa-map-pin"></i> 你当前所在：<a href="#">主页</a></li>
		          <li><a href="#">Layout</a></li>
		          <li class="active">Top Navigation</li>
		        </ol>
		    </section>
			<div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="../../common/dist/img/user4-128x128.jpg" alt="User profile picture">
              <h3 class="profile-username text-center">谭佳成</h3>
              <p class="text-muted text-center">php程序员</p>
              <strong><i class="fa fa-book margin-r-5"></i> 教育背景</strong>
              <p class="text-muted">
                2012.9-2015-6 重庆电子工程职业学院 机电一体化
              </p>
              <hr>
              <strong><i class="fa fa-map-marker margin-r-5"></i> 所在地</strong>
              <p class="text-muted">重庆市，渝北区</p>
              <hr>
              <strong><i class="fa fa-pencil margin-r-5"></i> 技能</strong>
              <p>
                <span class="label label-danger">UI Design</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">html5</span>
                <span class="label label-info">css3</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-primary">Apache</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Mysql</span>
                <span class="label label-primary">Node.js</span>
              </p>
              <hr>
              <strong><i class="fa fa-file-text-o margin-r-5"></i> 备注</strong>
              <p>大专毕业后，培训结构学习php后开始工作</p>
            </div>
            <!-- /.box-body -->
          </div>	
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
<?php $this->load->view('home/footer')?>
 <!-- 下面加载自己的js -->
</body>
</html>