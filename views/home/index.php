<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
	<?php $this->load->view('home/meta') ?>
	<title>首页</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/home/css/index.css') ?>">
	
</head>
<body class="hold-transition skin-blue-light layout-top-nav fixed">
<div class="wrapper">

  <?php $this->load->view('home/header')?>
  <div class="content-wrapper">
    <div class="container">
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12 col-sm-8 allarticle">
						<!-- 面包屑 -->
						<section class="content-header">
			        <ol class="breadcrumb">
			          <li><i class="fa fa-map-pin"></i> 你当前所在：<a href="#">主页</a></li>
			          <li><a href="#">Layout</a></li>
			          <li class="active">Top Navigation</li>
			        </ol>
			      </section>
			<!-- 搜索结果，标记搜索填入的 -->
			<section>
				<form class="form-horizontal">
				<div class="box-body">
					<div class="form-group">
						<label for="articletitle" class="col-sm-2 control-label">文章标题</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="articletitle" placeholder="请输入文章标题">
						</div>
					</div>
					<div class="form-group">
						<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
							<div class="col-sm-10">
							<input type="password" class="form-control" id="inputPassword3" placeholder="Password">
						</div>
					</div>
				</div>
			  </form>
				<p>以下是搜索结果：</p>
			</section>
			<?php foreach ($list as $key => $article): ?>
		    <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title"><a href="info.html"><?php echo $article->module_name ?></a></h3>
              </div>
              <div class="box-body">
                <h3><a href="#" class="title"><?php echo $article->title ?></a></h3>
                <h4>
                <?php 
                
                if(strlen($article->tag_ids) > 1){
                    $needarr = [];
	                $tag_name = explode(',',$article->tag_names);
	                $tag_id = explode(',',$article->tag_ids);
	                foreach ($tag_name as $key => $tag) {
	                	$needarr[] = (object)array(
	                        'id' =>  $tag_id[$key],
	                        'name' => $tag
	                	);
	                }
	                foreach ($needarr as $key => $tag) {?>
                    <a type="button" href="<?php echo site_url($tag->id) ?>" class="btn btn-xs bg-gray"><?php echo $tag->name ?></a>
                <?php }} ?>
                    <span><small class="text-gray"><?php echo $article->remark ?></small></span>
                </h4>
                <?php echo $article->brief ?>
                <a type="button" href="#" class="btn btn-primary btn-sm">查看详情>></a>
              </div>
              <div class="box-footer">
                 <span data-toggle="tooltip"  title="<?php echo date("Y-m-d H:i",$article->create_time) ?>"><i class="fa fa-calendar"></i> <?php echo $this->common->formatTime($article->create_time) ?></span>
                 <span><i class="fa fa-eye"></i>( <?php echo $article->views ?> )</span>
                 <a href="#"><span><i class="fa fa-comment"></i>( 0 )</span></a>
              </div>
              <!-- /.box-body -->
            </div>
            <?php endforeach ?>
           <!-- 分页 -->
			<div class="row">
					<div class="col-xs-12 col-sm-3">
					  <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">当前第一页，共20页，共100条</div>
				  </div>
					<div class="col-xs-12 col-sm-3">
						<div class="dataTables_length" id="example1_length">
							<label>每页显示
								<select name="example1_length" aria-controls="example1" class="form-control input-sm">
									<option value="10">10</option>
									<option value="25">25</option>
									<option value="50">50</option>
									<option value="100">100</option>
								</select> 条记录
						</label>
						</div>
					</div>
				  <div class="col-xs-12 col-sm-6">
						<div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
							<ul class="pagination">
								<li class="paginate_button previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a></li>
								<li class="paginate_button active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">1</a></li>
								<li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0">2</a></li>
								<li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0">3</a></li>
								<li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0">4</a></li>
								<li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0">5</a></li>
								<li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0">6</a></li>
								<li class="paginate_button next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0">Next</a></li>
							</ul>
						</div>
				  </div>
			</div>

          </div>
          <div class="col-xs-12 col-sm-4 right_aside">
			<!-- 什么网站 -->
            <div class="box box-primary box-solid">
              <div class="box-header">
                <h3 class="box-title">这是什么网站</h3>
              </div>
              <div class="box-body">
                您好,本站是个人博客，主要记录和分享个人web开发中的一些问题笔记，如有疑问，随时欢迎大家参与互动，共同探讨。
              </div>
            </div>

            <!-- 热度排行 -->
            <div class="box box-primary hots">
              <div class="box-header with-border">
                  <h3 class="box-title">最热文章</h3>
                  <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  </div>
              </div>
              <div class="box-body">
                <ul class="list-unstyled">
                  <!-- <li><span>1</span><span><a href="">[文章分类]</a></span><b><a href="#" title="这是文章标题这是文章标题这是文章标题这是文章标题">这是文章标题这是文章标题这是文章标题这是文章标题</a></b></li> -->
                </ul>
              </div>
            </div>

            <!-- 随机 -->
            <div class="box box-primary random">
	            <div class="box-header with-border">
	              <h3 class="box-title">喔唷，手气不错</h3>
	              <div class="box-tools pull-right">
	                <button data-toggle="tooltip" title="点击随机" class="btn btn-box-tool"  data-original-title="点击随机" onclick="getrand()"><i class="fa fa-refresh"></i></button>
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	              </div>
	            </div>
	            <div class="box-body">
	              <ul class="list-unstyled">
	                <!-- <li><span><a href="#">[分类名]</a></span> <span><a href="#" title="文章标题文章标题">文章标题文章标题文章标题文章标题</a></span></li> -->
	              </ul>
	            </div>
	          </div>

			  <!-- 心灵鸡汤 -->
			  <div class="box box-primary soul">
	            <div class="box-header with-border">
	              <h3 class="box-title">唧唧复唧唧</h3>
	              <div class="box-tools pull-right">
	                <button data-toggle="tooltip" title="换一个" class="btn btn-box-tool"  data-original-title="换一个" id="getsoul"><i class="fa fa-refresh"></i></button>
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	              </div>
	            </div>
	            <div class="box-body">
	              <!-- <span>学而不思则亡，思而不学则殆。</span> -->
	            </div>
	          </div>

			  <!-- 标签云 -->
			  <div class="nav-tabs-custom">
	            <ul class="nav nav-tabs">
	              <li class="active"><a href="#tab_1" data-toggle="tab">标签云</a></li>
	              <li><a href="#tab_2" data-toggle="tab">按月归档</a></li>
	            </ul>
	            <div class="tab-content tags">
	              <div class="tab-pane active" id="tab_1">
									<ul class="list-inline">
		                <li><a href="#" class="btn btn-primary btn-sm">xxx <small>(123)</small></a></li>
										<li><a href="#" class="btn btn-primary btn-sm">xxx <small>(123)</small></a></li>
										<li><a href="#" class="btn btn-primary btn-sm">xxx <small>(123)</small></a></li>
										<li><a href="#" class="btn btn-primary btn-sm">xxx <small>(123)</small></a></li>
										<li><a href="#" class="btn btn-primary btn-sm">xxx <small>(123)</small></a></li>
										<li><a href="#" class="btn btn-primary btn-sm">xxx <small>(123)</small></a></li>
										<li><a href="#" class="btn btn-primary btn-sm">xxx <small>(123)</small></a></li>
		              </ul>
	              </div>
	              <div class="tab-pane" id="tab_2">
									<ul class="list-inline">
		                <li><a href="#" class="btn btn-primary btn-sm">2017-6 <small>(123)</small></a></li>
										<li><a href="#" class="btn btn-primary btn-sm">2017-5 <small>(123)</small></a></li>
										<li><a href="#" class="btn btn-primary btn-sm">2017-4 <small>(123)</small></a></li>
										<li><a href="#" class="btn btn-primary btn-sm">2017-3 <small>(123)</small></a></li>
		              </ul>
	              </div>
	            </div>
	          </div>


					 <!-- 简单统计 -->
					 <div class="box box-primary statistics">
						 <div class="box-header with-border">
							 <h3 class="box-title">网站统计</h3>
							 <div class="box-tools pull-right">
								 <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							 </div>
						 </div>
						 <div class="box-body">
							 <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>文章总数</b> <a class="pull-right">1,322</a>
                </li>
                <li class="list-group-item">
                  <b>标签总数</b> <a class="pull-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>评论总数</b> <a class="pull-right">13,287</a>
                </li>
								<li class="list-group-item">
                  <b>注册总人数</b> <a class="pull-right">13,287</a>
                </li>
              </ul>
						 </div>
					 </div>

					 <!--ad -->
					 <div class="small-box bg-aqua">
            <div class="inner">
              <h3>150</h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
					</div>
        </div>
      </section>
      <!-- /.content -->
    </div>
  </div>
  <section>
		<div class="modal fade" tabindex="-1" role="dialog" id="searchModal" data-backdrop="false">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">搜索本站文章</h4>
		      </div>
		      <div class="modal-body">
						<form class="form-horizontal">
						<div class="box-body">
							<div class="form-group">
								<label for="articletitle" class="col-sm-2 control-label">文章标题</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="articletitle" placeholder="请输入文章标题">
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
									<div class="col-sm-10">
									<input type="password" class="form-control" id="inputPassword3" placeholder="Password">
								</div>
							</div>
						</div>
					  </form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
						<button type="button" class="btn btn-primary"><i class="fa fa-search"></i> 开始搜索</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
  </section>
 <?php $this->load->view('home/footer')?>
 <!-- 下面加载自己的js -->
 <script src="<?php echo base_url('public/home/js/index.js')?>" async="true"></script>
</body>
</html>
