<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
  <?php $this->load->view('home/meta') ?>
	<title>站内搜索</title>
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
    		          <li class="active">站内搜索</li>
    		        </ol>
    		    </section>
            <div>
              <script type="text/javascript">(function(){document.write(unescape('%3Cdiv id="bdcs"%3E%3C/div%3E'));var bdcs = document.createElement('script');bdcs.type = 'text/javascript';bdcs.async = true;bdcs.src = 'http://znsv.baidu.com/customer_search/api/js?sid=14695925890912627671' + '&plate_url=' + encodeURIComponent(window.location.href) + '&t=' + Math.ceil(new Date()/3600000);var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(bdcs, s);})();</script>
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
