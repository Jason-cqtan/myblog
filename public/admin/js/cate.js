 //添加模块
 $("#sureadd").on("click", function() {
   var $obj = $(this);
   if ($obj.hasClass('disabled')) {
     return false;
   }
   var name = $("#cateform").find("input[name='name']").val();
   if ($.trim(name).length < 1) {
     layer.msg('请填写模块名！', {
       icon: 2
     });
     return false;
   }
   $obj.addClass('disabled').html('操作中...');
   $.ajax({
     type: "POST",
     url: site_url + "admin/cate/insertCate",
     data: $("#cateform").serialize(),
     dataType: "json",
     success: function(msg) {
       if (msg.status === 0) {
         window.location.reload();
       } else {
         layer.msg(msg.msg, {
           icon: 5
         });
       }
     }
   });
   return false;
 });

 //删除module
 $(".delmodule").on("click", function() {
   var id = $(this).parent().data('moduleid');
   layer.confirm('是否删除该模块？', {
     icon: 3,
     title: '提示'
   }, function(index) {
     $.ajax({
       type: "POST",
       url: site_url + "admin/cate/delCate",
       data: "id=" + id,
       dataType: "json",
       success: function(msg) {
         if (msg.status === 0) {
           window.location.reload();
         } else {
           layer.msg(msg.msg, {
             icon: 5
           });
         }
       }
     });
     layer.close(index);
     return false;
   });
 })

 //修改module
 $(".editmodule").on("click", function() {
     var id = $(this).parent().data('moduleid');
     var name = $(this).parent().prevAll('.name').html();
     layer.prompt({
       formType: 3,
       value: name,
       title: '请输入模块名',
     }, function(value, index, elem) {
       $.ajax({
         type: "POST",
         url: site_url + "admin/cate/editCate",
         dataType: 'JSON',
         data: "id=" + id + "&name=" + value,
         success: function(msg) {
           if (msg.status === 0) {
             window.location.reload();
           } else {
             layer.msg(msg.msg, {
               icon: 5
             });
           }
         }
       });
       return false;
     });
   })
   //新增子模块弹出显示
 $(".addson").on("click", function() {
     var pid = $(this).parent().data('moduleid');
     $("#addmoduleson").find("input[name='pid']").val(pid);
     $("#addmoduleson").modal("toggle");
     return false;
   })
   //确认新增子模块
 $("#sureaddson").on("click", function() {
     var $obj = $(this);
     if ($obj.hasClass('disabled')) {
       return false;
     }
     var name = $("#cateform2").find("input[name='name']").val();
     if ($.trim(name).length < 1) {
       layer.msg('请填写模块名！', {
         icon: 2
       });
       return false;
     }
     $obj.addClass('disabled').html('操作中...');
     $.ajax({
       type: "POST",
       url: site_url + "admin/cate/insertCate",
       data: $("#cateform2").serialize(),
       dataType: "json",
       success: function(msg) {
         if (msg.status === 0) {
           window.location.reload();
         } else {
           layer.msg(msg.msg, {
             icon: 5
           });
         }
       }
     });
     return false;
   })
   //新增模块附属标签
 $(".addmoduletag").on("click", function() {
     var moduleid = $(this).parent().data('moduleid');
     layer.prompt({
       formType: 3,
       title: '请输入标签名',
     }, function(value, index, elem) {
       $.ajax({
         type: "POST",
         url: site_url + "admin/cate/insertTag",
         dataType: 'JSON',
         data: "module_id=" + moduleid + "&name=" + value,
         success: function(msg) {
           if (msg.status === 0) {
             window.location.reload();
           } else {
             layer.msg(msg.msg, {
               icon: 5
             });
           }
         }
       });
       return false;
     });
   })
   //删除标签
 $(".deltag").on("click", function() {
     var id = $(this).parent().data('tagid');
     layer.confirm('是否删除该标签？', {
       icon: 3,
       title: '提示'
     }, function(index) {
       $.ajax({
         type: "POST",
         url: site_url + "admin/cate/delTag",
         data: "id=" + id,
         dataType: "json",
         success: function(msg) {
           if (msg.status === 0) {
             window.location.reload();
           } else {
             layer.msg(msg.msg, {
               icon: 5
             });
           }
         }
       });
       layer.close(index);
       return false;
     });
   })
   //修改标签
 $(".edittag").on("click", function() {
   var id = $(this).parent().data('tagid');
   var name = $(this).parent().prevAll('.name').html();
   layer.prompt({
     formType: 3,
     value: name,
     title: '请输入标签名',
   }, function(value, index, elem) {
     $.ajax({
       type: "POST",
       url: site_url + "admin/cate/editTag",
       dataType: 'JSON',
       data: "id=" + id + "&name=" + value,
       success: function(msg) {
         if (msg.status === 0) {
           window.location.reload();
         } else {
           layer.msg(msg.msg, {
             icon: 5
           });
         }
       }
     });
     return false;
   });
 })