$(".select2").select2();
$("#showarticle").on("click",function(){
getarticle(true);
})
//根据模型id获取标签列表
$('#chosemodule').on('change', function(evt) {
  $.ajax({
    type: "POST",
    url: site_url + "admin/article/getTags",
    data: $("#searchform").serialize(),
    dataType: "json",
    success: function(msg) {
      var htm = '';
      $.each(msg['msg'], function(index, val) {
        htm += '<option value="' + val.id + '">' + val.name + '</option>';

      })
      $("#chosetags").html('').append(htm);
      $("#chosetags").select2();
    }
  });
  return false;
});

function getarticle(init1) {
  if (init1) {
    //初始化为第一页
    $("#searchform").find("input[name='page_index']").val(1);
  }
  var index = layer.load(1, {
    time: 10 * 1000
  }); //又换了种风格，并且设定最长等待10秒 
  $.ajax({
    type: "POST",
    url: site_url + "admin/article/ajaxGetlist",
    data: $("#searchform").serialize(),
    dataType: "json",
    success: function(msg) {
      layer.close(index);
      var status = msg['status'];
      if (status != 'ok') {
        layer.alert(msg['msg'], {
          icon: 2
        });
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
        var checkednum = parseInt(obj.find('input:checked').legnth);
        var trnum = parseInt(obj.find('tr').legnth);
        if (checkednum != trnum) {
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
//重置搜索条件
$("#resetSearch").on('click', function() {
  document.getElementById("searchform").reset();
  $("#searchform").find('select[name="module_ids[]"]').val(null).trigger("change");
  $("#searchform").find('select[name="tag_ids[]"]').val(null).trigger("change");
  var $obj = $(this);
  $obj.find('i').addClass('fa-spin');
  getarticle(true);
  setTimeout(function() {
    $obj.find('i').removeClass('fa-spin');
  }, 1000);
});
//跳转指定页面
$(".jumppage").on("click", function() {
  var skippagenum = $("#skippagenum").val().length;
  if (skippagenum < 1) {
    layer.alert('请先输入跳转页！', {
      icon: 2
    });
    return false;
  }
  var pageindex = $("#skippagenum").val();
  $("#searchform").find("input[name='page_index']").val(pageindex);
  getarticle(false);
});
document.onkeydown = function(e) {
    var ev = document.all ? window.event : e;
    if (ev.keyCode == 13) {
      $(".jumppage").click();
    }
  }
  //限制输入跳转页
$("input[name='skippagenum']").on("change keyup", function() {
  var maxnum = parseInt($(this).attr("max"));
  var inptnum = parseInt($(this).val());
  if (inptnum > maxnum) {
    $(this).val(maxnum);
  }
  if (inptnum < 1) {
    $(this).val(1);
  }
});

//改变每页显示条数
$('.dataTables_length').find("select").on("change", function() {
  var pagesize = $(this).val();
  $("#searchform").find("input[name='page_size']").val(pagesize);
  getarticle(true);
});
//分页点击跳转
$(".pagination").on("click", 'a', function() {
  if ($(this).parent().hasClass('active')) {
    return false;
  }
  var page = parseInt($(this).attr('pageval'));
  $('#searchform').find("input[name='page_index']").val(page);
  getarticle(false);
});
//移动至回收站
$("#ajaxcontent").on("click",'.del', function() {
  var id = $(this).parent().data('id');
  layer.confirm('移动至回收站该文章？', {
    icon: 3,
    title: '提示'
  }, function(index) {
    $.ajax({
      type: "POST",
      url: site_url + "admin/article/recycleArticle",
      data: "id=" + id,
      dataType: "json",
      success: function(msg) {
        if (msg.status === 0) {
          getarticle();
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
  //选中移动至回收站
$("#selecteddel").on("click", function() {
  var selectednum = $("#ajaxcontent tr").find('div.checked').length;
  if (selectednum < 1) {
    layer.msg('请至少选中一个！', {
      icon: 2
    });
    return false;
  }
  layer.confirm('你确移动至回收站所选中的吗？！', {
    icon: 3,
    title: '提示'
  }, function(index) {
    $.ajax({
      type: "POST",
      url: site_url + "admin/article/recycleManyArticle",
      data: $("#operateform").serialize(),
      dataType: "json",
      success: function(msg) {
        if (msg['status'] === 0) {
          getarticle(false);
        } else {
          layer.alert(msg['msg'], {
            icon: 2
          });
        }
      }
    });
    layer.close(index);
    return false;
  })
});