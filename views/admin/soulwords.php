<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
  <?php $this->load->view('admin/meta')?>
  <title>心灵鸡汤</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/common/bower_components/select2/dist/css/select2.min.css')?>">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <?php $this->load->view('admin/header') ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        心灵鸡汤
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>主页</a></li>
        <li class="active">心灵鸡汤</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        <div class="box">
          <div class="box-header with-border">
            <div class="operatepanel action_box">
              <a href="#" class="btn btn-info" id="newsoul">添加新鸡汤</a>
              <button type="button" class="btn btn-primary" id="selecteddel">选中删除</button>              
            </div>
            <div class="collapse" id="searchpanel">
            <form id="searchform" action="" method="post">  
              <input type="hidden" name="page_index" value="1">
              <input type="hidden" name="page_size" value="10">
              </form>
            </div>
          </div>
          <div class="box-body">
            <form id="operateform">  
            <div class="row">
              <div class="col-xs-12">
                 <div class=" table-responsive">
                    <table class="table table-hover table-striped table-bordered table-condensed">
                      <thead>
                        <tr>
                          <th class="text-center"><input type="checkbox"></th>
                          <th class="text-center">id</th>
                          <th>鸡汤</th>
                          <th>创建时间</th>         
                          <th>操作</th>
                        </tr>
                      </thead>
                      <tbody id="ajaxcontent">
                      <?php foreach ($list as $key => $item): ?>
                        <tr>
                          <td class="text-center"><input type="checkbox" name="ids[]" value="<?php echo $item->id?>"></td>
                          <td><?php echo $item->id ?></td>
                          <td class="content"><?php echo $item->content ?></td>
                          <td><?php echo date("Y-m-d H:i:s",$item->create_time) ?></td>
                          <td data-id="<?php echo $item->id?>">
                              <a href="#" class="edit">修改</a>
                              <a href="#" class="del">删除</a>
                          </td>
                        </tr>
                      <?php endforeach ?>                         
                      </tbody>  
                    </table>
                </div>  
              </div>
            </div>                       
            </form>
          </div>
          <div class="box-footer resultpagination">
                  <div class="row">
                    <div class="col-xs-12 col-sm-3 statistics text-center">
                          <p><span>共<b id="totalnum"><?php echo $totalnum ?></b>条</span> <span>当前第<b id="currentpage"><?php echo $page_index ?></b>页/共<b id="totalpage"><?php echo $total_page ?></b>页</span></p>
                      </div>
                      <div class="col-xs-12 col-sm-3">
                          <div class="dataTables_length" id="example1_length">
                          <label>每页显示&nbsp;
                          <select name="example1_length" aria-controls="example1" class="form-control input-sm">
                          <option value="10">10</option>
                          <option value="25">25</option>
                          <option value="50">50</option>
                          <option value="100">100</option>
                          </select>&nbsp;&nbsp;条
                          </label>
                          </div>
                      </div>
                      <div class="col-xs-12 col-sm-3 text-center">
                        <ul class="pagination">
                          <?php echo $pagestr ?>
                       </ul>
                      </div>
                      <div class="col-xs-4 col-xs-offset-4 col-sm-3 col-sm-offset-0">
                          <div class="input-group">
                          <input type="number" name="skippagenum" class="form-control" min="1" max="<?php echo $total_page?>" id="skippagenum">
                          <span class="input-group-addon jumppage">跳转</span>
                        </div>
                      </div>
                  </div>
          </div>
        </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <?php $this->load->view('admin/footer') ?>
  <script src="https://unpkg.com/vue"></script>
  <script src="<?php echo base_url('public/admin/js/soulwords.js')?>"></script>

</body>
</html>
