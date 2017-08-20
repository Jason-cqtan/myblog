//获取文章推荐列表
function getRandRecommend()
{
	var listobj = $(".related").find("ul");
	var loading = '<div class="overlay">\
              <i class="fa fa-refresh fa-spin"></i>\
            </div>';
	$(".related").append(loading);
	$.ajax({
	   type: "POST",
	   url: site_url + "info/getRandRecommend",
	   data: $("#recommendform").serialize(),
	   dataType:"json",
	   success: function(msg){
	     if(parseInt(msg.list.length) >= 1){
	     	var obj = $("#recommendbody");
	     	obj.html('');
	     	$.each(msg.list,function(key,val){
	     		var one = '<li class="col-xs-12 col-xs-6">\
	     		<span><a href="'+site_url+'article/'+val.id+'.html"\
	     		title="'+val.title+'">'+val.title+'</a></span></li>';
	     		obj.append(one);
	     	});
	     }
	     $(".related").find('.overlay').remove();
	   }
	});
	return false;
}
//查看文章修改文章浏览数
function viewadd1()
{
	$.ajax({
	   type: "POST",
	   url: site_url + "info/articleViewadd1",
	   data: "id="+$("#article_id").val(),
	   success: function(msg){
	     
	   }
	});
	return false;
}
$(function(){
	viewadd1();
})
$('.allcomments').find('input[type="radio"]').iCheck({
	radioClass: 'iradio_square-blue',
	increaseArea: '20%'
});

//未登录点击评论框，弹出登录框
$("#commentform").on("click",function(){
	if($(this).find('textarea').attr('disabled',true)){
		$("#loginmodal").modal('show');
	    return false;
	}	
})