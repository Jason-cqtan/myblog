<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
  <?php $this->load->view('admin/meta')?>
  <title>撰写新文章</title>
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
        撰写新文章
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>主页</a></li>
        <li><a href="#">文章管理</a></li>
        <li class="active">撰写新文章</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">新增一篇文章
                <small></small>
              </h3>
            </div>
            <div class="box-body pad">
              <form class="form-horizontal" method="post" action="<?php echo site_url('admin/article/insertArticle')?>">
                <div class="form-group">
                  <label for="atitle" class="col-sm-2 control-label">所属模块</label>
                  <div class="col-sm-10">
                    <select class="form-control select2" id="module" name="module_id_name" required>
                      <?php foreach ($modules as $key => $module) {?>
                      <option value="<?php echo $module->id.'-'.$module->name ?>"><?php echo $module->name ?></option>
                      <?php } ?>
                    </select>
                  </div>                  
                </div>
                <div class="form-group">
                  <label for="atitle" class="col-sm-2 control-label">子标签</label>
                  <div class="col-sm-10">
                    <select name="tag_ids[]" multiple class="select2" style="width: 100%" id="chosetags"></select>
                  </div>
                  <div class="col-sm-offset-2 col-sm-10 othertags">
                    <span class="tages">
                       <!--  <span class="text-center onetag"><input type="hidden" name="tags[]" value=""><i class="fa fa-close"></i>这是汉字</span> -->
                    </span> 
                    <button type="button" class="btn btn-default btn-sm addtag"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
                <div class="form-group">
                  <label for="atitle" class="col-sm-2 control-label">标题</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="atitle" placeholder="标题" name="title" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="aremark" class="col-sm-2 control-label">备注</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="aremark" placeholder="备注" name="remark">
                  </div>
                </div>
                <div class="form-group">               
                  <div class="col-xs-12">
                    <!-- 加载编辑器的容器 -->
                    <script id="container" name="content" type="text/plain"></script>
                  </div>                  
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    <button type="button" class="btn btn-default">预览</button>
                    <button type="submit" class="btn btn-primary">确定发布</button>
                  </div>
                </div>                    
              </form>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col-->
      </div>


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
