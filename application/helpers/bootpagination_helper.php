<?php defined('BASEPATH') OR exit('No direct script access allowed');
//公共分页函数
if ( ! function_exists('bootpagination'))
{

	function bootpagination($current_page,$total_page,$pageoffset)
	{
		//组装分页按钮
		$page_str = '';
		$p_limit = floor($pageoffset/2);//偏移量

		$start_page = $current_page-$p_limit;
		$end_page = $current_page+$p_limit;

		if($current_page <= $p_limit){//如果当前页码小于等于浮动页码
			$start_page = 1;//左边页码显示第一页，不能为负
			$end_page = $p_limit*2+1;//右边显示所有当前页码为中时的所有页码
		}

		if($current_page > $total_page-$p_limit){
			$start_page = $total_page-$p_limit*2;
			$end_page = $total_page;
		}
		if($total_page<=$p_limit*2+1){
			$start_page = 1;
			$end_page = $total_page;
		}


		// $page_str .= "<a class='home_page' href='1'>首页</a>";
		//$prev_page = $current_page-1;//上一页
		// if($current_page!=1){
		// 	$page_str .= '<li class="paginate_button"><a href="#" pageval='.$prev_page.'>上一页</a></li>';
		// }
		//向上要显示的页码
		$prevshowpage = $current_page-$pageoffset;
		if($prevshowpage>=0){
			$page_str .= "<li class='paginate_button'><a href='#' pageval='".$prevshowpage."'><<<</a></li>";
		}
		for($i=$start_page;$i<=$end_page;$i++){
			if($current_page==$i){
				$page_str .= "<li class='paginate_button active'><a  href='#' pageval='".$i."'>".$i."</a></li>";
			}else{
				$page_str .= "<li class='paginate_button'><a  href='#' pageval='".$i."'>".$i."</a></li>";
			}
		}
		//向下要显示的页码
		$nextshowpage = $current_page+$pageoffset;
		if($nextshowpage<=$total_page){
			$page_str .= "<li class='paginate_button'><a href='#' pageval='".$nextshowpage."'>>>></a></li>";
		}


		//$next_page = $current_page+1;//下一页
		// if($current_page<$total_page){
		// 	$page_str .= "<li class='paginate_button'><a href='#' pageval='".$next_page."' >下一页</a></li>";
		// }
		// $page_str .= "<a class='end_page' href='".$total_page."'>尾页</a>";
		return $page_str;
	}
}