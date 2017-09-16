<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
  <?php $this->load->view('home/meta') ?>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/common/plugins/iCheck/all.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/home/css/info.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/common/plugins/prism/prism.css')?>">
  <title><?php echo $articlebasic->title ?></title>
</head>
<body class="hold-transition skin-blue-light layout-top-nav fixed">
<div class="wrapper">

  <?php $this->load->view('home/header')?>
  <div class="content-wrapper">
    <div class="container">
      <!-- Main content -->
      <section class="content">
          <!-- 面包屑 -->
          <section class="content-header">
            <ol class="breadcrumb">
              <li><i class="fa fa-map-pin"></i> 你当前所在：<a href="<?php echo base_url() ?>">主页</a></li>
              <?php if(isset($crumbs)){foreach ($crumbs as $key => $crumb){ ?>
                  <li <?php if($key+1 == count($crumbs)){echo 'class="active"';} ?>><a href="#"><?php echo $crumb ?></a></li>
                <?php }} ?>
              <li class="active"><?php echo $articlebasic->title ?></li>
            </ol>
          </section>
          <!-- 文章详情 -->
          <section class="info">
            <input type="hidden" id="article_id" name="article_id" value="<?php echo $articlebasic->id?>">
            <div class="row">
              <h1 class="text-center"><?php echo $articlebasic->title ?></h1>
            </div>
            <div class="row extra">
               <div class="col-xs-3 col-sm-3">
                 <span><i class="fa fa-user"></i> 谭佳成</span>
               </div>
               <div class="col-xs-4 col-sm-3">
                 <span data-toggle="tooltip" data-placement="top" title="<?php echo date("Y-m-d H:i",$articlebasic->create_time) ?>"><i class="fa fa-edit"></i> <?php echo $this->common->formatTime($articlebasic->create_time) ?></span>
               </div>
               <div class="col-xs-2 col-sm-3">
                 <span><i class="fa fa-eye"></i> (<?php echo $articlebasic->views ?>)</span>
               </div>
               <?php
                   if(strlen($articlebasic->tag_ids) >= 1){
                    $needarr = [];
                    $tag_name = explode(',',$articlebasic->tag_names);
                    $tag_id = explode(',',$articlebasic->tag_ids);
                    foreach ($tag_name as $key => $tag) {
                      $needarr[] = (object)array(
                            'id' =>  $tag_id[$key],
                            'name' => $tag
                      );
                    }?>
               <div class="col-xs-4 col-sm-3">
                 <span><i class="fa fa-tags"></i>
                     <?php foreach ($needarr as $key => $tag) {?>
                     <a href="<?php echo site_url('tag/'.$tag->name) ?>" target="_blank" class="btn btn-xs btn-primary"><?php echo $tag->name ?></a>
                     <?php } ?>
                 </span>
               </div>
               <?php } ?>
            </div>
            <hr>
            <!-- 主要内容 -->
            <div id="article-body"><?php echo $articlecontent->content ?></div>
            <p id="announcement"><i class="fa fa-volume-up"></i> 如无说明，本站文章均为原创，转载或引用注明来源：<span><?php echo site_url('article/'.$articlebasic->id) ?></span></p>
            <hr>
            <div class="bdsharebuttonbox">
              <a href="#" class="bds_more" data-cmd="more"></a>
              <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
              <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
              <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
            </div>

            <!-- 评分、分享、打赏 -->
            <div class="row interactive hidden">
              <!-- <div class="col-xs-12 col-sm-6">
                <p>打分：<i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <span>4.6分</span> <span>目前共 <b>5</b>人参与评分</span></p>
              </div> -->
              <div class="col-xs-12 col-sm-6">

              </div>
              <div class="col-xs-12">
                <p>打赏：本站乐意接受任何形式的打赏，你的鼓励是我最大的动力，我会继续努力，发布更多更好的文章：）</p>
              </div>
            </div>
            <!-- 上下篇 -->
            <div class="row prev-next">
              <?php if($prevarticle){ ?>
              <div class="col-xs-12">
                <p>上一篇：<a href="<?php echo site_url('article/'.$prevarticle->id) ?>" title="<?php echo $prevarticle->title ?>"><?php echo $prevarticle->title ?></a></p>
              </div>
              <?php } ?>
              <?php if($nextarticle){ ?>
              <div class="col-xs-12">
                <p>下一篇：<a href="<?php echo site_url('article/'.$nextarticle->id) ?>" title="<?php echo $nextarticle->title ?>"><?php echo $nextarticle->title ?></a></p>
              </div>
              <?php } ?>
            </div>
            <!-- 猜你喜欢 -->
            <?php if(count($recommend) >= 2){ ?>
            <div class="box box-primary related">
              <div class="box-header with-border">
                <h3 class="box-title">猜你喜欢</h3>
                <div class="box-tools pull-right">
                  <button data-toggle="tooltip" onclick="getRandRecommend()" title="" class="btn btn-box-tool hidden"  data-original-title=""><i class="fa fa-refresh"></i> 换一换</button>
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
              </div>
              <div class="box-body">
                <form id="recommendform" class="hidden">
                    <input type="hidden" name="article_id" value="<?php echo $articlebasic->id?>">
                    <input type="hidden" name="module_id" value="<?php echo $articlebasic->module_id?>">
                </form>
                <ul class="list-unstyled" id="recommendbody">
                  <?php foreach ($recommend as $key => $rec): ?>
                  <li class="col-xs-12 col-xs-6"><span><a href="<?php echo site_url('article/'.$rec->id) ?>" title="<?php echo $rec->title ?>"><?php echo $rec->title ?></a></span></li>
                  <?php endforeach ?>
                </ul>
              </div>
            </div>
            <?php } ?>
            <!-- 发表评论 -->
            <div class="box box-primary postcomment hidden">
              <div class="box-header with-border">
                <h3 class="box-title">发表评论</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
              </div>
              <div class="box-body">
                <form id="commentform">
                  <textarea class="form-control" rows="3" name="comment" placeholder="扯淡、吐槽、鼓励、聊天。。。。。想说啥就说啥！" maxlength="400" <?php if(empty($_SESSION['home_username'])){echo 'disabled="true';} ?> data-status="notlogin"></textarea>
                </form>
              </div>
              <div class="box-footer <?php if(empty($_SESSION['home_username'])){echo 'hidden';} ?>">
                  <div class="row logined">
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
            <!-- 所有评论 -->
            <div class="box box-primary allcomments hidden">
              <div class="box-header">
                <h3 class="box-title">所有评论</h3>
                <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i> 刷新</button>
                <label><input type="radio" name="orderby" checked> <span>最新</span></label>
                <label><input type="radio" name="orderby"> <span>最早</span></label>
              </div>
              <div class="box-body">
                <div class="row comment-body hidden">
                      <ul class="list-unstyled">
                          <li class="col-xs-12">
                            <div class="col-xs-2 col-sm-1 u-left text-center">
                                <span><img src="<?php echo base_url('public/common/dist/img/avatar.png') ?>" class="img-circle" alt="头像" width="30" height="30"></span>
                                <p class="lv"><span class="text-center">Lv.11</span></p>
                            </div>
                            <div class="col-xs-10 col-sm-11">
                              <p>
                                  <span><a href="#">这是昵称这是昵称这是昵称</a> <i class="fa fa-user male"></i></span>&nbsp;&nbsp;
                                  <span class="hidden-xs"><i class="fa fa-map-marker"></i> 重庆市</span>&nbsp;&nbsp;
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
                                  <span class="hidden-xs"><i class="fa fa-map-marker"></i> 重庆市</span>&nbsp;&nbsp;
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
                                  <span class="hidden-xs"><i class="fa fa-map-marker"></i> 重庆市</span>&nbsp;&nbsp;
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
                                        <span class="hidden-xs"><i class="fa fa-map-marker"></i> 重庆市</span>&nbsp;&nbsp;
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
                                        <span class="hidden-xs"><i class="fa fa-map-marker"></i> 重庆市</span>&nbsp;&nbsp;
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
                                        <span class="hidden-xs"><i class="fa fa-map-marker"></i> 重庆市</span>&nbsp;&nbsp;
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
                <div class="callout callout-info">
                <h4>暂无评论</h4>
                <p>或许你有话说</p>
              </div>
              </div>
            </div>
          </section>
        </div>
      </section>
      <div class="go-top">
        <div class="arrow"></div>
        <div class="stick"></div>
      </div>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
 <?php $this->load->view('home/footer')?>
 <!-- 下面加载自己的js -->
 <script src="<?php echo base_url('public/common/plugins/iCheck/icheck.min.js') ?>"></script>
 <script src="<?php echo base_url('public/home/js/info.js')?>"></script>
 <script src="<?php echo base_url('public/common/plugins/prism/prism.js')?>"></script>
 <script>
  //
  //prism代码亮高
  //
  var doc_pre = $("#article-body pre");
    doc_pre.each(function(){
        var class_val = $(this).attr('class');
        var class_arr = new Array();
        class_arr = class_val.split(';');
        class_arr = class_arr['0'].split(':');
        var lan_class = 'language-'+class_arr['1'];
        var pre_content = '<code class="'+lan_class+'">'+$(this).html()+'</code>';
        $(this).html(pre_content);
        $(this).attr("class",'line-numbers '+lan_class);
    });
 </script>
 <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdPic":"","bdStyle":"0","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
</body>
</html>
