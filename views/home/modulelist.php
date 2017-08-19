<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
	<?php $this->load->view('home/meta') ?>
	<title>分类为<?php echo '['.urldecode($module_name).']' ?>的所有文章</title>
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
           <!-- 左部 -->
           <div class="col-xs-12 col-sm-8 allarticle">
				<!-- 面包屑 -->
				<section class="content-header">
			        <ol class="breadcrumb">
			          <li <?php if(!isset($crumbs)){echo 'active';} ?>><i class="fa fa-map-pin"></i> 你当前所在：<a href="<?php echo base_url() ?>">主页</a></li>
			          <?php if(isset($crumbs)){foreach ($crumbs as $key => $crumb){ ?>
			          	<li <?php if($key+1 == count($crumbs)){echo 'class="active"';} ?>><a href="#"><?php echo $crumb ?></a></li>
			          <?php }} ?>
			        </ol>
				</section>
				<?php foreach ($list as $key => $article): ?>
			    <div class="box box-solid">
	              <div class="box-header with-border">
	                <h3 class="box-title"><a href="<?php echo site_url('module/'.$article->module_name) ?>"><?php echo $article->module_name ?></a></h3>
	              </div>
	              <div class="box-body">
	                <h3><a href="<?php echo site_url('article/'.$article->id) ?>" class="title"><?php echo $article->title ?></a></h3>
	                <h4>
	                <?php                 
	                if(strlen($article->tag_ids) >= 1){
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
	                    <a type="button" href="<?php echo site_url('tag/'.$tag->name) ?>" class="btn btn-xs bg-gray"><?php echo $tag->name ?></a>
	                <?php }} ?>
	                    <span><small class="text-gray"><?php echo $article->remark ?></small></span>
	                </h4>
	                <p class="brief">
	                	<?php echo $article->brief ?>
	                </p>
	                <p>
	                	 <a type="button" href="<?php echo site_url('article/'.$article->id) ?>" class="btn btn-primary btn-sm">查看详情>></a>               	
	                </p>
	              </div>
	              <div class="box-footer">
	                 <span data-toggle="tooltip"  title="<?php echo date("Y-m-d H:i",$article->create_time) ?>"><i class="fa fa-edit"></i> <?php echo $this->common->formatTime($article->create_time) ?></span>
	                 <span><i class="fa fa-eye"></i> ( <?php echo $article->views ?> )</span>
	                 <a href="#"><span><i class="fa fa-comment"></i> ( 0 )</span></a>
	              </div>
	              <!-- /.box-body -->
	            </div>
	            <?php endforeach ?>
	            <!-- 分页 -->
	            <?php if($totalnum > 0){ ?>
				<section class="row">
					  <form id="pageform">	
				      <input type="hidden" name="page_index" value="1">	
				      <input type="hidden" name="module_name" value="<?php echo $module_name ?>">		
					  <div class="col-xs-6 col-sm-3 text-center">
						  <div class="pagination">
						      <p><span>共</span><b id="totalnum"><?php echo $totalnum ?></b><span>条</span> <span>第</span><b id="page_index"><?php echo $page_index ?></b><span>页/共</span><b id="total_page"><?php echo $total_page ?></b><span>页</span></p>
						  </div>
					  </div>
					  <div class="col-xs-6 col-sm-4 text-center">
						  <div class="pagination">
						  	<span>每页显示</span>
							    <select name="page_size"  class="input-sm">
									<option value="10">10</option>
									<option value="25">25</option>
									<option value="50">50</option>
									<option value="100">100</option>
								</select> 
							<span>条记录</span>
						  </div>						    
					  </div>
					  <div class="col-xs-12 col-sm-5 text-center">
							<ul class="pagination" id="pagestr">
							<?php echo $pagestr ?>
							</ul>
					  </div>
					</form>
				</section>
				<?php }else{ ?>
                    <div class="alert alert-warning alert-dismissible">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                <h4><i class="icon fa fa-warning"></i> 提示!</h4>
		                该分类下暂无数据，查看其它的吧:>
		            </div>
				<?php } ?>
           </div>
           <!-- 右部 -->
           <div class="col-xs-12 col-sm-4 right_aside">
				<!-- 什么网站 -->
	            <div class="box box-primary box-solid">
	              <div class="box-header">
	                <h3 class="box-title">What's this?</h3>
	              </div>
	              <div class="box-body">
	                本站是个人博客，主要记录和分享个人软件开发生涯中的一些经验、笔记，随时欢迎大家参与互动，共同学习：）
	              </div>
	            </div>
	            <!-- 热度排行 -->
	            <div class="box box-primary hots">
	              <div class="box-header with-border">
	                  <h3 class="box-title">热门文章</h3>
	                  <div class="box-tools pull-right">
	                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
	                  </button>
	                  </div>
	              </div>
	              <div class="box-body">
	                <ul class="list-unstyled">
	                  <?php foreach ($hots as $key => $hot): ?>
	                  	<li><span><?php echo ($key + 1) ?></span><span><a href="<?php echo site_url('module/'.$hot->module_name)?>">[<?php echo $hot->module_name ?>]</a></span><b><a href="<?php echo site_url('article/'.$hot->id) ?>" title="<?php echo $hot->title ?>"><?php echo $hot->title ?></a></b></li>
	                  <?php endforeach ?>
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
		                <?php foreach ($rands as $key => $rand): ?>
		                	<li><span><a href="<?php echo site_url('module/'.$rand->module_name)?>">[<?php echo $rand->module_name ?>]</a></span> <span><a href="<?php echo site_url('article/'.$rand->id) ?>" title="<?php echo $rand->title ?>"><?php echo $rand->title ?></a></span></li>
		                <?php endforeach ?>
		                <!-- <li><span><a href="#">[分类名]</a></span> <span><a href="#" title="文章标题文章标题">文章标题文章标题文章标题文章标题</a></span></li> -->
		              </ul>
		            </div>
		        </div>
				<!-- 心灵鸡汤 -->
				<div class="box box-primary soul">
		            <div class="box-header with-border">
		              <h3 class="box-title">唧唧复唧唧</h3>
		              <div class="box-tools pull-right">
		                <button data-toggle="tooltip" title="换一个" class="btn btn-box-tool"  data-original-title="换一个" onclick="getsoul()"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		              </div>
		            </div>
		            <div class="box-body">
		              <?php echo $soul->content ?>
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
						  <ul class="list-inline" id="tagsbody">		                
			              </ul>
		              </div>
		              <div class="tab-pane" id="tab_2">
						  <ul class="list-inline" id="monthbody">
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
						 <ul class="list-group list-group-unbordered" id="simplebody">
			                <li class="list-group-item">
			                  <b>文章总数</b> <a class="pull-right articletotal"></a>
			                </li>
			                <li class="list-group-item">
			                  <b>标签总数</b> <a class="pull-right tagtotal"></a>
			                </li>
			                <li class="list-group-item hidden">
			                  <b>评论总数</b> <a class="pull-right commenttotal"></a>
			                </li>
							<li class="list-group-item hidden">
			                  <b >今日访问本站排行</b> <a class="pull-right viewrank"></a>
			                </li>
			                <li class="list-group-item">
			                  <b>网站已运行</b> <a class="pull-right" id="runtotaltime"></a>
			                </li>
			              </ul>
					 </div>
				</div>
	        </div>
        </div>
      </section>
      <div class="go-top">
        <div class="arrow"></div>
        <div class="stick"></div>
      </div>
      <!-- /.content -->
    </div>
  </div>
 <?php $this->load->view('home/footer')?>
 <!-- 下面加载自己的js -->
 <script>show_date_time();</script>
 <script src="<?php echo base_url('public/home/js/rightmodule.js')?>" async="true"></script>
 <script src="<?php echo base_url('public/home/js/modulelist.js')?>" async="true"></script>
</body>
</html>
