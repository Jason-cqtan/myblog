function getTagArticles(init1) {
	var objform = $("#pageform");
	if (init1) {
		//初始化为第一页
		objform.find("input[name='page_index']").val(1);
	}
	var index = layer.load(1);
	$.ajax({
		type: "POST",
		url: site_url + "home/ajaxGetTagArticles",
		data: objform.serialize(),
		dataType: "json",
		success: function(msg) {
			if(msg.list.length >= 1){
                $("#articlebody").html('').append(msg.list);
                $("#totalnum").html(msg.statistics.totalnum);
                $("#page_index").html(msg.statistics.currentpage);
                $("#total_page").html(msg.statistics.total_page);
                $("#pagestr").html(msg.pagestr);
			}			
            layer.close(index); 
		}
	});
	return false;
}
//改变每页显示条数
$("#pageform").on('change','select',function(){
	getTagArticles(true);
})
//点击分页
$("#pagestr").on("click",'li',function(){
	var obj = $(this);
	if(obj.hasClass('active')){
		return false;
	}
	var page_index = parseInt(obj.find('a').attr('pageval'));
	$("#pageform").find("input[name='page_index']").val(page_index);
	getTagArticles(false);
	return false;
})
//获取推荐文章
function getrecommend()
{
	var objform = $("#pageform");
	var listobj = $(".recommend").find("ul");
	var loading = '<div class="overlay">\
              <i class="fa fa-refresh fa-spin"></i>\
            </div>';
	$(".recommend").append(loading);
	$.ajax({
		type: "POST",
		url: site_url + "home/ajaxGetRecommendByTagid",
		data: objform.serialize(),
		dataType: "json",
		success: function(msg) {
			if (msg.list.length >= 1) {
				listobj.html('');
				$.each(msg.list, function(key, val) {
					var list = '<li>\
              <span><a href="'+site_url+'module/'+val.module_name+'.html">[' + val.module_name + ']</a></span>\
              <span><a href="'+site_url+'article//'+val.id+'.html" title="' + val.title + '">' + val.title + '</a></span>\
              </li>';
					listobj.append(list);
				});
			}
			$(".recommend").find('.overlay').remove();
		}
	});
	return false;
}