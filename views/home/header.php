<header class="main-header">
    <!-- 导航 -->
    <nav class="navbar navbar-static-top ">
      <div class="container">
			<div class="navbar-header">
	          <a href="../../index2.html" class="navbar-brand"><b>Admin</b>LTE</a>
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
	            <i class="fa fa-bars"></i>
	          </button>
	        </div>
	        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
	          <ul class="nav navbar-nav">
	            <li class="active"><a href="<?php echo base_url() ?>">首页<span class="sr-only">(current)</span></a></li>
	            <?php foreach ($_SESSION['navs'] as $key => $nav){if(isset($nav->children)){ ?>
                    <li class="dropdown">
		              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $nav->name ?> <span class="caret"></span></a>
		              <ul class="dropdown-menu" role="menu">
		                <?php foreach ($nav->children as $key => $child): ?>
		                	<li><a href="<?php echo site_url('home/moduleArticle/'.$child->name) ?>"><?php echo $child->name ?></a></li>
		                <?php endforeach ?>
		              </ul>
		            </li>
	            <?php }else{ ?>
	                <li><a href="<?php echo site_url('home/moduleArticle/'.$nav->name) ?>"><?php echo $nav->name ?></a></li>
	            <?php }} ?>
	            <li><a href="<?php echo site_url('website') ?>" target="view_window">优站推荐</a></li>
	            <li><a href="<?php echo site_url('home/aboutme') ?>">关于我</a></li>
				<li id="search"><a href="#"><i class="fa fa-search"></i></a></li>
	          </ul>
	        </div>
	        <?php if(!isset($_SESSION['home_username'])){ ?>
	        <div class="navbar-custom-menu">
	        	<ul class="nav navbar-nav">
                    <li class="dropdown user user-menu visitormenu">
	              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	                <span>当前身份：游客</span>
	              </a>
	              <ul class="dropdown-menu visitor">
	                <li><p>访问IP <span class="pull-right"><?php echo $_SESSION['assip'] ?></span></p></li>
	                <li><p>归属地 <span class="pull-right"><?php echo $_SESSION['ipaddress'] ?></span></p></li>
	                <li><p>系统 <span class="pull-right"><?php echo $_SESSION['platform'] ?></span></p></li>
	                <li><p>浏览器 <span class="pull-right"><?php echo $_SESSION['browserdesc'] ?></span></p></li>
	                <li class="user-footer">
	                  <!-- <div class="pull-left">
	                    <a href="#" class="btn btn-default btn-flat"></a>
	                  </div> -->
	                  <div class="pull-right">
	                    <a href="#" class="btn btn-default btn-flat homelogin">登录解锁更多权限</a>
	                  </div>
	                </li>
	              </ul>
	            </li>
	        	</ul>
	        </div>
	        <?php }else{ ?>
	        <div class="navbar-custom-menu">
	          <ul class="nav navbar-nav">
	            <li class="dropdown notifications-menu">
	              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	                <i class="fa fa-bell-o"></i>
	                <span class="label label-warning">10</span>
	              </a>
	              <ul class="dropdown-menu">
	                <li class="header">你有10条信息</li>
	                <li>
	                  <ul class="menu">
	                    <li>
	                      <a href="#" title=“dsfsdf在《xxxxxxxxxxxxxxxxxxxxxxxxxxxxx》回复了你”>
	                        <i class="fa fa-users text-aqua"></i> @dsfsdf在《xxxxxxxxxxxxxxxxxxxxxxxxxxxxx》回复了你
	                      </a>
	                    </li>
	                  </ul>
	                </li>
	                <li class="footer"><a href="#">查看所有</a></li>
	              </ul>
	            </li>
	            <li class="dropdown user user-menu">
	              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	                <img src="<?php echo base_url('public/common/dist/img/user2-160x160.jpg') ?>" class="user-image" alt="User Image">
	                <span class="hidden-xs">Alexander Pierce</span>
	              </a>
	              <ul class="dropdown-menu">
	                <li class="user-header">
	                  <img src="<?php echo base_url('public/common/dist/img/user2-160x160.jpg') ?>" class="img-circle" alt="User Image">

	                  <p>
	                    Alexander Pierce - Web Developer
	                    <small>自2017年6月23日加入</small>
	                  </p>
	                </li>
	                <li class="user-body">
	                  <div class="row">
	                    <div class="col-xs-4 text-center">
	                      <a href="#">Followers</a>
	                    </div>
	                    <div class="col-xs-4 text-center">
	                      <a href="#">Sales</a>
	                    </div>
	                    <div class="col-xs-4 text-center">
	                      <a href="#">Friends</a>
	                    </div>
	                  </div>
	                </li>
	                <li class="user-footer">
	                  <div class="pull-left">
	                    <a href="#" class="btn btn-default btn-flat">Profile</a>
	                  </div>
	                  <div class="pull-right">
	                    <a href="#" class="btn btn-default btn-flat">Sign out</a>
	                  </div>
	                </li>
	              </ul>
	            </li>
	          </ul>
	        </div>
	        <?php } ?>
	  </div>
    </nav>
</header>