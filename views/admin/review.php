<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
  <?php $this->load->view('admin/meta')?>
  <title>预览<?php echo $title?></title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/admin/css/newblog.css') ?>">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <?php $this->load->view('admin/header') ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        预览-<?php echo $title?>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>主页</a></li>
        <li><a href="#">文章管理</a></li>
        <li><a href="<?php echo site_url('admin/article/createArticle') ?>">撰写新文章</a></li>
        <li class="active">预览<?php echo $title?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <section class="info">
            <div class="row">
              <h1 class="text-center"><?php echo $title ?></h1>
            </div>
            <div class="row extra">
               <div class="col-xs-4 col-sm-3">
                 <span><i class="fa fa-user"></i> 谭佳成</span>
               </div>
               <div class="col-xs-4 col-sm-3">
                 <span><i class="fa fa-edit"></i> <?php echo date("Y-m-d") ?></span>
               </div>
               <div class="col-xs-4 col-sm-3">
                 <span><i class="fa fa-eye"></i> (123456)</span>
               </div>
               <div class="col-xs-4 col-sm-3">
                 <span><i class="fa fa-tags"></i> <a href="#" class="btn btn-xs btn-primary">xxx</a> <a href="#" class="btn btn-xs btn-primary">xxx</a></span>
               </div>
            </div>
            <hr>
            <!-- 主要内容 -->
            <div id="article-body">
              <?php echo $content ?>
            </div>
            <p id="announcement"><i class="fa fa-volume-up"></i> 自由转载，但请尽量附上本文地址：<span>http://www.tjc.cn/xxx/xxx/1.html</span></p>
            <hr> 
          </section>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('admin/footer') ?>
<!-- uedtor配置文件 -->
<script type="text/javascript" src="<?php echo base_url('public/common/plugins/ueditor/ueditor.config.js') ?>"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="<?php echo base_url('public/common/plugins/ueditor/ueditor.all.js') ?>"></script>
<script src="<?php echo base_url('public/admin/js/newblog.js')?>"></script>
</body>
</html>
