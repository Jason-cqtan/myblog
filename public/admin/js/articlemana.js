$(".select2").select2();
//根据模型id获取标签列表
$('#chosemodule').on('change', function (evt) {
    $.ajax({
       type: "POST",
       url: site_url +"admin/article/getTags",
       data: $("#searchform").serialize(),
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
});

function getarticle(init1)
{
  if (init1) {
    //初始化为第一页
    $("#searchform").find("input[name='page_index']").val(1);
  }
  $.ajax({
    type: "POST",
    url: site_url + "admin/article/ajaxGetlist",
    data: $("#searchform").serialize(),
    dataType: "json",
    success: function(msg) {
      var status = msg['status'];
      if (status != 'ok') {
        openNoticeModel(msg['msg']);
        return false;
      }
      $("#ajaxcontent").html("").append(msg['list']);
      $("#currentpage").html(msg['statistics']['currentpage']);
      $("#totalpage").html(msg['statistics']['total_page']);
      $("#totalnum").html(msg['statistics']['totalnum']);
      $(".pagination").html(msg['pagestr']);
      //清空跳转数字并赋值最大值
      $("input[name='skippagenum']").val('').attr('max', msg['statistics']['total_page']);
      //icheck
      $('input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
      });
      $('thead input').on('ifChecked', function(event) {
        $("#ajaxcontent").find("input[type='checkbox']").iCheck('check');
      });
      $('thead input').on('ifUnchecked', function(event) {
        var obj = $("#ajaxcontent");
        var checkednum = parseInt(obj.find('input:checked').size());
        var trnum = parseInt(obj.find('tr').size());
        if(checkednum != trnum){
          return false;
        }
        $("#ajaxcontent").find("input[type='checkbox']").iCheck('uncheck');
      });
      $("#ajaxcontent").find("input[type='checkbox']").on('ifUnchecked', function(event) {
        $('thead input').iCheck('uncheck');
      });
    }
  });
  return false;
}