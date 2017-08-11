//获取最热文章
function gethots()
{
	var listobj = $(".hots").find("ul");
	var loading = '<div class="overlay">\
              <i class="fa fa-refresh fa-spin"></i>\
            </div>';
    $(".hots").append(loading);
	$.ajax({
	   type: "POST",
	   url: site_url+"home/getHots",
	   data: "",
	   dataType:"json",
	   success: function(msg){
	     if(msg.list.length > 0){
	     	$.each(msg.list,function(key,val){
              var list = '<li>\
              <span>'+(key+1)+'</span>\
              <span><a href="">['+val.module_name+']</a></span>\
              <b><a href="#" title="'+val.title+'">'+val.title+'</a></b>\
              </li>';
              listobj.append(list);
	       });
	     } 
	     $(".hots").find('.overlay').remove();
	   }
	});
	return false;
}
//获取随机文章
function getrand()
{
	var listobj = $(".random").find("ul");
	var loading = '<div class="overlay">\
              <i class="fa fa-refresh fa-spin"></i>\
            </div>';
    $(".random").append(loading);
	$.ajax({
	   type: "POST",
	   url: site_url+"home/getRand",
	   data: "",
	   dataType:"json",
	   success: function(msg){
	     if(msg.list.length > 0){
	     	listobj.html('');
	     	$.each(msg.list,function(key,val){
              var list = '<li>\
              <span><a href="#">['+val.module_name+']</a></span>\
              <span><a href="#" title="'+val.title+'">'+val.title+'</a></span>\
              </li>';
              listobj.append(list);
	       });
	     } 
	     $(".random").find('.overlay').remove();
	   }
	});
	return false;
}
//获取心灵鸡汤
function getsoul()
{
	var obj = $(".soul").find(".box-body");
	var loading = '<div class="overlay">\
              <i class="fa fa-refresh fa-spin"></i>\
            </div>';
    $(".soul").append(loading);
	$.ajax({
	   type: "POST",
	   url: site_url+"home/getSoul",
	   data: "",
	   dataType:"json",
	   success: function(msg){
	   	 obj.html('').append('<span>'+msg.word.content+'</span>');	   	   
	     $(".soul").find('.overlay').remove();
	   }
	});
	return false;
}

$(function(){
	gethots();
	getrand();
	getsoul();
})
//点击获取鸡汤
$("#getsoul").on("click",function(){
	$.ajax({
	   type: "POST",
	   url: site_url+"home/getclicknum",
	   data: "",
	   dataType:"json",
	   success: function(msg){
	   	if(parseInt(msg.num) >= 5){
            layer.alert(msg.msg, {
					icon: 6
				});
	   	}else{
	   		getsoul()
	   	}
	   }
	});
	return false;
})