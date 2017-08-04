<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
  <?php $this->load->view('admin/meta')?>
  <title>模块分类管理</title>
  <style type="text/css" media="screen">
    .second{
      text-indent: 40px;
    }
    .three{
      text-indent: 80px;
    }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <?php $this->load->view('admin/header') ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        模块分类管理
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>主页</a></li>
        <li class="active">模块分类管理</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content table-responsive">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">所有模块和标签</h3>
              <button type="button" class="btn btn-primary" id="add" data-toggle="modal" data-target="#addmodule"><i class="fa fa-plus"></i> 新增模块</button>
              <!-- <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover table-striped">
                <thead>
                  <tr>
                    <th>模块名、标签名</th>
                    <th>是导航</th>
                    <th>是标签</th>
                    <th>是优站推荐模块</th>
                    <th>操作</th>
                  </tr>
                </thead>
                <tbody> 
                  <?php foreach ($tree as $key => $item): ?>
                      <tr>
                        <td class="name"><?php echo $item->name ?></td>
                        <td><?php echo $item->is_nav?'<span class="label label-success"><i class="fa fa-navicon"></i></span>':''; ?></td>
                        <td><?php echo $item->is_tag?'<span class="label label-success"><i class="fa fa-tag"></i></span>':''; ?></td>
                        <td><?php echo ($item->is_nav == 0&& $item->is_tag ==0)?'<span class="label label-success"><i class="fa fa-anchor"></i></span>':'';?></td>
                        <td data-moduleid="<?php echo $item->id?>">
                            <a href="#" class="addson">新增子</a>
                            <a href="#" class="editmodule">修改</a>
                            <?php if(!isset($item->children)){ ?>
                            <a href="#" class="delmodule">删除</a>
                            <?php  }?>
                        </td>
                      </tr> 
                      <?php 
                          if(isset($item->children)){
                            foreach ($item->children as $key => $child) {?>   
                        <tr>
                          <td class="second name"><?php echo $child->name ?></td>
                          <td><?php echo $child->is_nav?'<span class="label label-success"><i class="fa fa-navicon"></i></span>':''; ?></td>
                          <td><?php echo $child->is_tag?'<span class="label label-success"><i class="fa fa-tag"></i></span>':''; ?></td>
                          <td><?php echo ($child->is_nav == 0&& $child->is_tag ==0)?'<span class="label label-success"><i class="fa fa-anchor"></i></span>':'';?></td>
                          <td data-moduleid="<?php echo $child->id?>">
                              <a href="#" class="addmoduletag">新增附属标签</a>
                              <a href="#" class="editmodule">修改</a>
                              <?php if(!isset($child->tags)){ ?>
                              <a href="#" class="delmodule">删除</a>
                              <?php  }?>
                          </td>
                        </tr>
                        <?php if(isset($child->tags)){foreach ($child->tags as $key => $tag){ ?>
                          <tr>
                          <td class="three name"><?php echo $tag->name ?></td>
                          <td></td>
                          <td><span class="label label-success"><i class="fa fa-tag"></i></span></td>
                          <td></td>
                          <td data-tagid="<?php echo $tag->id?>">
                              <a href="#" class="edittag">修改</a>
                              <a href="#" class="deltag">删除</a>
                          </td>
                        </tr>
                        <?php }} ?>
                      <?php }} ?>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- 弹出层 -->
    <section>
      <!-- 新增主模块 -->
      <div class="modal fade" tabindex="-1" role="dialog" data-backdrop="false" id="addmodule">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">新增模块</h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" id="cateform">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">模块名</label>
                  <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="模块名">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">是导航</label>
                  <div class="col-sm-10">
                    <div class="radio">
                    <label>
                      <input type="radio" name="is_nav" value="1">
                      是
                    </label>
                    <label>
                     <input type="radio" name="is_nav" value="0" checked="checked">
                      否
                    </label>
                  </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">是标签</label>
                  <div class="col-sm-10">
                    <div class="radio">
                    <label>
                      <input type="radio" name="is_tag" value="1" >
                      是
                    </label>
                    <label>
                     <input type="radio" name="is_tag" value="0" checked="checked">
                      否
                    </label>
                  </div>
                  </div>
                </div>
              </div>
            </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
              <button type="button" class="btn btn-primary" id="sureadd">确定</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>
      <!-- 新增模块附属模块 -->
      <div class="modal fade" tabindex="-1" role="dialog" data-backdrop="false" id="addmoduleson">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">新增模块附属模块</h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" id="cateform2">
              <input type="hidden" name="pid" >
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">模块名</label>
                  <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="模块名">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">是导航</label>
                  <div class="col-sm-10">
                    <div class="radio">
                    <label>
                      <input type="radio" name="is_nav" value="1">
                      是
                    </label>
                    <label>
                     <input type="radio" name="is_nav" value="0" checked="checked">
                      否
                    </label>
                  </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">是标签</label>
                  <div class="col-sm-10">
                    <div class="radio">
                    <label>
                      <input type="radio" name="is_tag" value="1" >
                      是
                    </label>
                    <label>
                     <input type="radio" name="is_tag" value="0" checked="checked">
                      否
                    </label>
                  </div>
                  </div>
                </div>
              </div>
            </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
              <button type="button" class="btn btn-primary" id="sureaddson">确定</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <?php $this->load->view('admin/footer') ?>
  <script src="<?php echo base_url('public/admin/js/cate.js')?>"></script>
</body>
</html>
