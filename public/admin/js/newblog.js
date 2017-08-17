$(".select2").select2();
//更换模块对应更换标签
$("#module").on("change",function(){
	var $obj = $(this);
	var moduleid = parseInt($obj.val());
	$.ajax({
	   type: "POST",
	   url: site_url + "admin/article/getTagsBymoduleid",
	   data: "moduleid="+moduleid,
	   dataType:"json",
	   success: function(msg){
	      var htm = '';
          $.each(msg['msg'],function(index,val){
            htm += '<option value="'+val.id+'">'+val.name+'</option>';
            
          })
          $("#chosetags").html('').append(htm);
          $("#chosetags").select2();
	   }
	});
	return false;
})
//添加tag
$(".addtag").on("click",function(){
	layer.prompt({
	  formType: 2,
	  title: '请输入新标签',
	}, function(value, index, elem){
	  var newtag = '<span class="text-center onetag"><input type="hidden" name="tagnames[]" value="'+value+'"><i class="fa fa-close" onclick="$(this).parent().remove();"></i>'+value+'</span>';
      $(".tages").append(newtag);
	  layer.close(index);
	});
})
window.UEDITOR_HOME_URL = base_url + 'public/common/plugins/';
// 实例化编辑器
var ue = UE.getEditor('container');

//确认发布
$("#surepush").on("click",function(){
	var $form = $("#artileform");
	var title = $.trim($form.find("input[name='title']").val());
	if(title.length < 1){
		layer.alert('请填写标题！', {icon: 5});
		return false;
	}
	var index = layer.load(1);
	var posturl = site_url + 'admin/article/insertArticle';
	var $obj = $(this);
	if($obj.hasClass('disabled')){
		return false;
	}
	$obj.html('处理中...').addClass('disabled');
	$.ajax({
	   type: "POST",
	   url: posturl,
	   data: $("#artileform").serialize(),
	   dataType:"json",
	   success: function(msg){
	   	 layer.close(index);
         $obj.html('确认发布').removeClass('disabled');
	     if(parseInt(msg['status']) === 0){
	     	window.location.href=msg.url;
	     }else{
	     	layer.alert(msg.msg, {icon: 5});
	     	return false;
	     }
	   }
	});
	return false;
})
//预览
$("#review").on("click",function(){
	var $form = $("#artileform");
	var title = $.trim($form.find("input[name='title']").val());
	if(title.length < 1){
		layer.alert('请填写标题！', {icon: 5});
		return false;
	}
	var posturl = site_url + 'admin/article/review';
	$("#artileform").attr('action',posturl);
    $form.submit();
    return false;
})