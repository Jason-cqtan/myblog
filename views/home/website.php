<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
	<?php $this->load->view('home/meta') ?>
	<title>优站推荐</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/home/css/website.css') ?>">	
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
		          <li class="active"><i class="fa fa-map-pin"></i> 你当前所在：优站推荐</li>
		        </ol>
		    </section>
		    <div class="callout callout-info">
                <h4>hey，你来啦！</h4>
                <p>这是我收集到的网站，也是我的在线书签，如你有更好的资源，欢迎分享</p>
            </div>
            <?php foreach ($list as $key => $site): ?>
            <div class="box box-solid">
	            <div class="box-header with-border">
	              <h3 class="box-title"><?php echo $site->cate ?></h3>
	            </div>
	            <div class="box-body">
	                <?php if(isset($site->childcate)){ 
                        $menuid = $key.random_string('alnum',6);
	                ?>
	                <div class="box-group" id="<?php echo $menuid?>">
                        <?php foreach ($site->childcate as $key => $info){ 
                             $panelid = $key.random_string('alnum',6);
                        	?>
		                <div class="panel box box-solid">
		                  <div class="box-header with-border">
		                    <h4 class="box-title">
		                      <a class="paneltitle" data-toggle="collapse" data-parent="#<?php echo $menuid?>" href="#collapse<?php echo $panelid?>">
		                        <?php echo $info->cate ?>
		                      </a>
		                    </h4>
		                  </div>
		                  <div id="collapse<?php echo $panelid?>" class="panel-collapse collapse in">
		                    <div class="box-body">
                                <div class="row">
                                    <?php foreach ($info->urls as $key => $url){ ?>
		             		    	<div class="col-xs-6 col-sm-3 text-center">
		             		    		<p><a data-toggle="tooltip" data-placement="top" title="<?php echo $url->remark ?>" href="<?php echo $url->url ?>" target="_blank"><?php echo $url->name ?></a></p>
		             		    	</div>
		             		    	<?php } ?>
		             		    </div>
		                    </div>
		                  </div>
		                </div>
                        <?php } ?>
		            </div>
		            <?php }else{ ?>
                    <div class="row">
                        <?php if(isset($site->urls)){foreach ($site->urls as $key => $url){ ?>
		             	<div class="col-xs-6 col-sm-3 text-center">
		             		<p><a data-toggle="tooltip" data-placement="top" title="<?php echo $url->remark ?>" href="<?php echo $url->url ?>" target="_blank"><?php echo $url->name ?></a></p>
		             	</div>
		             	<?php }} ?>
		             </div>
		            <?php } ?>
	            </div>
	        </div>
            <?php endforeach ?>
            <!-- 发表评论 -->
            <div class="box box-primary postcomment">
              <div class="box-header with-border">
                <h3 class="box-title">发表评论</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
              </div>
              <div class="box-body">
                <form action="info_submit" method="get" accept-charset="utf-8">
                  <textarea class="form-control" rows="3" name="comment" placeholder="扯淡、吐槽、鼓励、聊天。。。。。想说啥就说啥！" maxlength="400" disabled></textarea>
                </form>
              </div>
              <div class="box-footer">
                  <div class="row">
                    <div class="nologin">
                      <div class="col-xs-12 col-sm-3">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-user"></i></span>
                          <input type="text" class="form-control" placeholder="用户名">
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-3">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-key"></i></span>
                          <input type="password" class="form-control" placeholder="密码">
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-6 opreate">
                        <button type="button" class="btn btn-primary btn-sm">登陆</button>
                        <span>其他登陆： 
                            <a href="#" class="weixin"><i class="fa fa-weixin"></i></a> 
                            <a href="#" class="weibo"><i class="fa fa-weibo"></i></a> 
                            <a href="#" class="qq"><i class="fa fa-qq"></i></a>
                        </span>                      
                      </div>
                    </div>
                    <div class="logined hidden">
                      <div class="col-xs-12 col-sm-6">
                        <div id="userinfo">
                          <span><img src="<?php echo base_url('public/common/dist/img/avatar.png') ?>" alt="头像" class="img-circle" width="30" height="30"></span>
                          <span><a href="#">这是昵称这是昵称这是昵称</a> <i class="fa fa-user male"></i></span>
                        </div>
                        <div id="userextra">
                              <span><i class="fa fa-map-marker"></i> 重庆市</span>
                              <span><i class="fa fa-windows"></i>win7 旗舰版</span>
                              <span><i class="fa fa-chrome"></i>谷歌浏览器 49.5</span>                    
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-6 text-right">
                        <button type="button" class="btn btn-primary btn-sm" id="surepost"><i class="fa fa-commenting"></i> 写好了</button>
                      </div>
                    </div>                                         
                  </div>                
              </div>
            </div>
            <!-- 全部评论 -->
            <div class="box box-solid">
	            <div class="box-header with-border">
	              <h3 class="box-title">全部评论</h3>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body">
	                <p id="panel">
                      <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i> 刷新</button>
                      <label><input type="radio" name="orderby" checked> <span>最新</span></label>
                      <label><input type="radio" name="orderby"> <span>最早</span></label>
                  </p>
                  <!-- 全部包含热门评论，右下角都展开+点击展开后，右下角显示完全，否则只显示两个  -->
                  <div class="row comment-body">
                    <ul class="list-unstyled">
                        <li class="col-xs-12">
                          <div class="col-xs-2 col-sm-1 u-left text-center">
                              <span><img src="<?php echo base_url('public/common/dist/img/avatar.png') ?>" class="img-circle" alt="头像" width="30" height="30"></span>
                              <p class="lv"><span class="text-center">Lv.11</span></p>
                          </div>
                          <div class="col-xs-10 col-sm-11">
                            <p>
                                <span><a href="#">这是昵称这是昵称这是昵称</a> <i class="fa fa-user male"></i></span>&nbsp;&nbsp;  
                                <span><i class="fa fa-map-marker"></i> 重庆市</span>&nbsp;&nbsp;  
                                <span class="hidden-xs"><i class="fa fa-windows"></i>win7 旗舰版</span>&nbsp;&nbsp;  
                                <span class="hidden-xs"><i class="fa fa-chrome"></i>谷歌浏览器 49.5</span>&nbsp;&nbsp;  
                                <span class="hidden-xs">2017-7-14 12:12:12</span>&nbsp;&nbsp;
                                <span class="location">1楼</span>
                            </p>
                            <p>的是大幅杀跌发送到发送到防守打法多少速度防守打法第三方速度反倒是 发送到</p>
                            <p class="text-right">
                              <span class="interact">
                                <span class="report"><i class="fa fa-info-circle"></i> 举报</span>
                                <span class="agree"><i class="fa fa-thumbs-o-up"></i> 赞同(123)</span>
                                <span class="disagree"><i class="fa fa-thumbs-o-down"></i> 反对(456)</span>
                                <span><i class="fa fa-reply"></i> 回复</span>
                              </span>
                            </p>
                          </div>
                        </li>
                        <li class="col-xs-12">
                          <div class="col-xs-2 col-sm-1 u-left text-center">
                              <span><img src="<?php echo base_url('public/common/dist/img/avatar.png') ?>" class="img-circle" alt="头像" width="30" height="30"></span>
                              <p class="lv"><span class="text-center">Lv.11</span></p>
                          </div>
                          <div class="col-xs-10 col-sm-11">
                            <p>
                                <span><a href="#">这是昵称这是昵称这是昵称</a> <i class="fa fa-user male"></i></span>&nbsp;&nbsp;  
                                <span><i class="fa fa-map-marker"></i> 重庆市</span>&nbsp;&nbsp;  
                                <span class="hidden-xs"><i class="fa fa-windows"></i>win7 旗舰版</span>&nbsp;&nbsp;  
                                <span class="hidden-xs"><i class="fa fa-chrome"></i>谷歌浏览器 49.5</span>&nbsp;&nbsp;  
                                <span class="hidden-xs">2017-7-14 12:12:12</span>&nbsp;&nbsp;
                                <span class="location">1楼</span>
                            </p>
                            <p>的是大幅杀跌发送到发送到防守打法多少速度防守打法第三方速度反倒是 发送到</p>
                            <p class="text-right">
                              <span class="unopen interact">
                                <span>点击展开(123) <i class="fa fa-angle-down"></i></span>
                                <span class="interac2">
                                  <span class="agree"><i class="fa fa-thumbs-o-up"></i> 赞同(123)</span>
                                  <span class="disagree"><i class="fa fa-thumbs-o-down"></i> 反对(456)</span>
                                </span>                              
                              </span>
                              <span class="opened interact hidden">
                                <span class="report"><i class="fa fa-info-circle"></i> 举报</span>
                                <span class="agree"><i class="fa fa-thumbs-o-up"></i> 赞同(123)</span>
                                <span class="disagree"><i class="fa fa-thumbs-o-down"></i> 反对(456)</span>
                                <span><i class="fa fa-reply"></i> 回复</span>
                              </span>
                            </p>
                          </div>
                        </li>
                        <li class="col-xs-12">
                          <div class="col-xs-2 col-sm-1 u-left text-center">
                              <span><img src="<?php echo base_url('public/common/dist/img/avatar.png') ?>" class="img-circle" alt="头像" width="30" height="30"></span>
                              <p class="lv"><span class="text-center">Lv.11</span></p>
                          </div>
                          <div class="col-xs-10 col-sm-11">
                            <p>
                                <span><a href="#">这是昵称这是昵称这是昵称</a> <i class="fa fa-user male"></i></span>&nbsp;&nbsp;  
                                <span><i class="fa fa-map-marker"></i> 重庆市</span>&nbsp;&nbsp;  
                                <span class="hidden-xs"><i class="fa fa-windows"></i>win7 旗舰版</span>&nbsp;&nbsp;  
                                <span class="hidden-xs"><i class="fa fa-chrome"></i>谷歌浏览器 49.5</span>&nbsp;&nbsp;  
                                <span class="hidden-xs">2017-7-14 12:12:12</span>&nbsp;&nbsp;
                                <span class="location">2楼</span>
                            </p>
                            <p>的是大幅杀跌发送到发送到防守打法多少速度防守打法第三方速度反倒是 发送到</p>
                            <p class="text-right">
                              <span class="interact">
                                <span class="report"><i class="fa fa-info-circle"></i> 举报</span>
                                <span class="agree"><i class="fa fa-thumbs-o-up"></i> 赞同(123)</span>
                                <span class="disagree"><i class="fa fa-thumbs-o-down"></i> 反对(456)</span>
                                <span><i class="fa fa-reply"></i> 回复</span>
                              </span>
                            </p>
                          </div>
                        </li>
                        <li class="col-xs-12">
                          <div class="col-xs-2 col-sm-1 u-left text-center">
                              <span><img src="<?php echo base_url('public/common/dist/img/avatar.png') ?>" class="img-circle" alt="头像" width="30" height="30"></span>
                              <p class="lv"><span class="text-center">Lv.11</span></p>
                          </div>
                          <div class="col-xs-10 col-sm-11">
                            <p>
                                <span><a href="#">这是昵称这是昵称这是昵称</a> <i class="fa fa-user male"></i></span>&nbsp;&nbsp;  
                                <span><i class="fa fa-map-marker"></i> 重庆市</span>&nbsp;&nbsp;  
                                <span class="hidden-xs"><i class="fa fa-windows"></i>win7 旗舰版</span>&nbsp;&nbsp;  
                                <span class="hidden-xs"><i class="fa fa-chrome"></i>谷歌浏览器 49.5</span>&nbsp;&nbsp;  
                                <span class="hidden-xs">2017-7-14 12:12:12</span>&nbsp;&nbsp;
                                <span class="location">3楼</span>
                            </p>
                            <p>的是大幅杀跌发送到发送到防守打法多少速度防守打法第三方速度反倒是 发送到</p>
                            <p class="interact text-right">
                              <span class="report"><i class="fa fa-info-circle"></i> 举报</span>
                              <span class="agree"><i class="fa fa-thumbs-o-up"></i> 赞同(123)</span>
                              <span class="disagree"><i class="fa fa-thumbs-o-down"></i> 反对(456)</span>
                              <span><i class="fa fa-reply"></i> 回复</span>
                            </p>
                            <ul class="list-unstyled belong">
                              <li class="col-xs-12">
                                <div class="col-xs-2 col-sm-1 u-left text-center">
                                    <span><img src="<?php echo base_url('public/common/dist/img/avatar.png') ?>" class="img-circle" alt="头像" width="30" height="30"></span>
                                    <p class="lv"><span class="text-center">Lv.11</span></p>
                                </div>
                                <div class="col-xs-10 col-sm-11">
                                  <p>
                                      <span><a href="#">这是昵称这是昵称这是昵称</a> <i class="fa fa-user male"></i></span>&nbsp;&nbsp;  
                                      <span><i class="fa fa-map-marker"></i> 重庆市</span>&nbsp;&nbsp;  
                                      <span class="hidden-xs"><i class="fa fa-windows"></i>win7 旗舰版</span>&nbsp;&nbsp;  
                                      <span class="hidden-xs"><i class="fa fa-chrome"></i>谷歌浏览器 49.5</span>&nbsp;&nbsp;  
                                      <span class="hidden-xs">2017-7-14 12:12:12</span>&nbsp;&nbsp;
                                      <span class="location">1楼</span>
                                  </p>
                                  <p>的是大幅杀跌发送到发送到防守打法多少速度防守打法第三方速度反倒是 发送到</p>
                                  <p class="interact text-right">
                                    <span class="report"><i class="fa fa-info-circle"></i> 举报</span>
                                    <span class="agree"><i class="fa fa-thumbs-o-up"></i> 赞同(123)</span>
                                    <span class="disagree"><i class="fa fa-thumbs-o-down"></i> 反对(456)</span>
                                    <span class=""><i class="fa fa-reply"></i> 回复</span>
                                  </p>
                                </div>
                              </li>
                              <li class="col-xs-12">
                                <div class="col-xs-2 col-sm-1 u-left text-center">
                                    <span><img src="<?php echo base_url('public/common/dist/img/avatar.png') ?>" class="img-circle" alt="头像" width="30" height="30"></span>
                                    <p class="lv"><span class="text-center">Lv.11</span></p>
                                </div>
                                <div class="col-xs-10 col-sm-11">
                                  <p>
                                      <span><a href="#">这是昵称这是昵称这是昵称</a> <i class="fa fa-user male"></i></span>&nbsp;&nbsp;  
                                      <span><i class="fa fa-map-marker"></i> 重庆市</span>&nbsp;&nbsp;  
                                      <span class="hidden-xs"><i class="fa fa-windows"></i>win7 旗舰版</span>&nbsp;&nbsp;  
                                      <span class="hidden-xs"><i class="fa fa-chrome"></i>谷歌浏览器 49.5</span>&nbsp;&nbsp;  
                                      <span class="hidden-xs">2017-7-14 12:12:12</span>&nbsp;&nbsp;
                                      <span class="location">2楼</span>
                                  </p>
                                  <p>的是大幅杀跌发送到发送到防守打法多少速度防守打法第三方速度反倒是 发送到</p>
                                  <p class="interact text-right">
                                    <span class="report"><i class="fa fa-info-circle"></i> 举报</span>
                                    <span class="agree"><i class="fa fa-thumbs-o-up"></i> 赞同(123)</span>
                                    <span class="disagree"><i class="fa fa-thumbs-o-down"></i> 反对(456)</span>
                                    <span class=""><i class="fa fa-reply"></i> 回复</span>
                                  </p>
                                </div>
                              </li>
                              <li class="col-xs-12">
                                <div class="col-xs-2 col-sm-1 u-left text-center">
                                    <span><img src="<?php echo base_url('public/common/dist/img/avatar.png') ?>" class="img-circle" alt="头像" width="30" height="30"></span>
                                    <p class="lv"><span class="text-center">Lv.11</span></p>
                                </div>
                                <div class="col-xs-10 col-sm-11">
                                  <p>
                                      <span><a href="#">这是昵称这是昵称这是昵称</a> <i class="fa fa-user male"></i></span>&nbsp;&nbsp;  
                                      <span><i class="fa fa-map-marker"></i> 重庆市</span>&nbsp;&nbsp;  
                                      <span class="hidden-xs"><i class="fa fa-windows"></i>win7 旗舰版</span>&nbsp;&nbsp;  
                                      <span class="hidden-xs"><i class="fa fa-chrome"></i>谷歌浏览器 49.5</span>&nbsp;&nbsp;  
                                      <span class="hidden-xs">2017-7-14 12:12:12</span>&nbsp;&nbsp;
                                      <span class="location">3楼</span>
                                  </p>
                                  <p>的是大幅杀跌发送到发送到防守打法多少速度防守打法第三方速度反倒是 发送到</p>
                                  <p class="interact text-right">
                                    <span class="report"><i class="fa fa-info-circle"></i> 举报</span>
                                    <span class="agree"><i class="fa fa-thumbs-o-up"></i> 赞同(123)</span>
                                    <span class="disagree"><i class="fa fa-thumbs-o-down"></i> 反对(456)</span>
                                    <span class=""><i class="fa fa-reply"></i> 回复</span>
                                  </p>
                                </div>
                              </li>
                            </ul>
                          </div>
                        </li>                      
                    </ul>
                  </div>
	            </div>
          </div>
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
