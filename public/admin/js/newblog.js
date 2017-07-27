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
// 实例化编辑器
var ue = UE.getEditor('container');