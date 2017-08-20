function getModuleArticles(init1) {
	var objform = $("#pageform");
	if (init1) {
		//初始化为第一页
		objform.find("input[name='page_index']").val(1);
	}
	var index = layer.load(1);
	$.ajax({
		type: "POST",
		url: site_url + "home/ajaxgetModuleArticles",
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
	getModuleArticles(true);
})
//点击分页
$("#pagestr").on("click",'li',function(){
	var obj = $(this);
	if(obj.hasClass('active')){
		return false;
	}
	var page_index = parseInt(obj.find('a').attr('pageval'));
	$("#pageform").find("input[name='page_index']").val(page_index);
	getModuleArticles(false);
	return false;
})