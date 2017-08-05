<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
  <?php $this->load->view('admin/meta')?>
  <title>所有优站</title>
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
        优站推荐
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>主页</a></li>
        <li class="active">优站推荐</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        <div class="box">
          <div class="box-header with-border">
            <div class="operatepanel action_box">
              <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#searchpanel" aria-expanded="false" aria-controls="#searchpanel" id="clicksearch">点击筛选&nbsp; <i class="fa fa-angle-left"></i></button>
              <button type="button" class="btn btn-primary" id="selecteddel">选中删除</button>
              <a href="#" class="btn btn-info" data-toggle="modal" data-target="#addurl">添加新优站</a>
            </div>
            <div class="collapse" id="searchpanel">
            <form id="searchform" action="" method="post">  
              <input type="hidden" name="page_index" value="1">
              <input type="hidden" name="page_size" value="10">
              <div class="row">
                  <div class="col-xs-4 form-group">
                    <label for="name">模块</label>
                    <select name="module_ids[]" multiple class="select2" style="width: 100%" id="chosemodule">
                      <?php foreach ($tree as $key => $module){?>
                           <option value="<?php echo $module->id?>" <?php if(isset($module->children)){echo 'disabled';} ?>><?php echo $module->name ?></option>
                           <?php if(isset($module->children)){foreach ($module->children as $key => $son){ ?>
                             <option value="<?php echo $son->id?>"><?php echo $son->name ?></option>
                           <?php }} ?>
                      <?php } ?>                    
                    </select>
                  </div>
                  <div class="col-xs-4 form-group">
                    <label for="name">网站名称</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="网站名称">
                  </div>
                  <div class="col-xs-4 form-group">
                    <label for="create_time">创建时间</label>
                    <input type="text" class="form-control" onclick="WdatePicker({maxDate:'%y-%M-%d'});" placeholder="点击选择创建时间" name="create_time">
                  </div>
              </div>
              <div class="row">
                <div class="col-xs-12">
                  <button type="button" class="btn btn-primary min_w_100" onclick="getlist(true)"><i class="fa fa-search"></i>&nbsp;搜索</button>
                  &nbsp;&nbsp;                
                  <button type="reset" id="resetSearch" class="btn btn-info min_w_100"><i class="fa fa-refresh"></i>&nbsp;重置</button>
                </div>
              </div>
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
                          <th>所属模块</th>
                          <th>网站名称</th> 
                          <th>url</th>   
                          <th>备注</th> 
                          <th>创建时间</th>         
                          <th>操作</th>
                        </tr>
                      </thead>
                      <tbody id="ajaxcontent">
                      <?php foreach ($list as $key => $item): ?>
                        <tr>
                          <td class="text-center"><input type="checkbox" name="ids[]" value="<?php echo $item->id?>"></td>
                          <td><?php echo $item->id ?></td>
                          <td><?php echo $item->module_name ?></td>
                          <td><?php echo $item->name ?></td>
                          <td><a href="<?php echo $item->url ?>" target="_blank"><?php echo $item->url ?></a></td>
                          <td><?php echo $item->remark ?></td>
                          <td><?php echo date("Y-m-d H:i:s",$item->create_time) ?></td>
                          <td data-urlid="<?php echo $item->id?>">
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
    <section>
      <div class="modal fade" tabindex="-1" role="dialog" data-backdrop="false" id="addurl">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">新增优站</h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" id="opreateform">
              <div class="box-body">
                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">所属模块</label>
                  <div class="col-sm-10">
                    <select name="module_id" class="select2" style="width:100%">
                      <?php foreach ($tree as $key => $module){?>
                           <option value="<?php echo $module->id?>" <?php if(isset($module->children)){echo 'disabled';} ?>><?php echo $module->name ?></option>
                           <?php if(isset($module->children)){foreach ($module->children as $key => $son){ ?>
                             <option value="<?php echo $son->id?>"><?php echo $son->name ?></option>
                           <?php }} ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">网站名称</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name" placeholder="网站名称">
                  </div>
                </div>
                <div class="form-group">
                  <label for="url" class="col-sm-2 control-label">url</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="url" id="url" placeholder="url">
                  </div>
                </div>
                <div class="form-group">
                  <label for="remark" class="col-sm-2 control-label">备注说明</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="remark" name="remark" placeholder="备注说明">
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
      </div><!-- /.modal -->
      <div class="modal fade" tabindex="-1" role="dialog" data-backdrop="false" id="editurl">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">修改优站</h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" id="editform">
              <input type="hidden" name="id" :value="editobj.id">
              <div class="box-body">
                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">所属模块</label>
                  <div class="col-sm-10">
                    <select name="module_id" class="form-control" style="width:100%" :value="editobj.module_id">
                      <?php foreach ($tree as $key => $module){?>
                           <option value="<?php echo $module->id?>" <?php if(isset($module->children)){echo 'disabled';} ?>><?php echo $module->name ?></option>
                           <?php if(isset($module->children)){foreach ($module->children as $key => $son){ ?>
                             <option value="<?php echo $son->id?>"><?php echo $son->name ?></option>
                           <?php }} ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">网站名称</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" :value="editobj.name" id="name" placeholder="网站名称">
                  </div>
                </div>
                <div class="form-group">
                  <label for="url" class="col-sm-2 control-label">url</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="url" id="url" :value="editobj.url" placeholder="url">
                  </div>
                </div>
                <div class="form-group">
                  <label for="remark" class="col-sm-2 control-label">备注说明</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="remark" id="remark" :value="editobj.remark" placeholder="备注说明">
                  </div>
                </div>
              </div>
            </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
              <button type="button" class="btn btn-primary" id="sureedit">确定</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    </section>
    <!-- /.content -->
  </div>
  <?php $this->load->view('admin/footer') ?>
  <script src="https://unpkg.com/vue"></script>
  <script src="<?php echo base_url('public/admin/js/website.js')?>"></script>

</body>
</html>
