$("#recycle").on("click",function(){
getrecycle(true);
})

function getrecycle(init1) {
  if (init1) {
    //初始化为第一页
    $("#searchform2").find("input[name='page_index']").val(1);
  }
  var index = layer.load(1, {
    time: 10 * 1000
  }); //又换了种风格，并且设定最长等待10秒 
  $.ajax({
    type: "POST",
    url: site_url + "admin/article/getRecycle",
    data: $("#searchform2").serialize(),
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
      $("#ajaxcontent2").html("").append(msg['list']);
      $("#currentpage2").html(msg['statistics']['currentpage']);
      $("#totalpage2").html(msg['statistics']['total_page']);
      $("#totalnum2").html(msg['statistics']['totalnum']);
      $(".recyclepage").html(msg['pagestr']);
      //清空跳转数字并赋值最大值
      $("#tab_2").find("input[name='skippagenum']").val('').attr('max', msg['statistics']['total_page']);
      //icheck
      $('input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
      });
      $('thead input').on('ifChecked', function(event) {
        $("#ajaxcontent2").find("input[type='checkbox']").iCheck('check');
      });
      $('thead input').on('ifUnchecked', function(event) {
        var obj = $("#ajaxcontent2");
        var checkednum = parseInt(obj.find('input:checked').legnth);
        var trnum = parseInt(obj.find('tr').legnth);
        if (checkednum != trnum) {
          return false;
        }
        $("#ajaxcontent2").find("input[type='checkbox']").iCheck('uncheck');
      });
      $("#ajaxcontent2").find("input[type='checkbox']").on('ifUnchecked', function(event) {
        $('thead input').iCheck('uncheck');
      });
    }
  });
  return false;
}
//重置搜索条件
$("#resetSearch2").on('click', function() {
  document.getElementById("searchform").reset();
  $("#searchform2").find('select[name="module_ids[]"]').val(null).trigger("change");
  $("#searchform2").find('select[name="tag_ids[]"]').val(null).trigger("change");
  var $obj = $(this);
  $obj.find('i').addClass('fa-spin');
  getrecycle(true);
  setTimeout(function() {
    $obj.find('i').removeClass('fa-spin');
  }, 1000);
});
//跳转指定页面
$(".jumppage2",'.pagearea').on("click", function() {
  var skippagenum2 = $(".pagearea").find('input[name="skippagenum"]').val().size();
  console.log(skippagenum2);return;
  if (skippagenum2 < 1) {
    layer.alert('请先输入跳转页！', {
      icon: 2
    });
    return false;
  }
  var pageindex = $('#skippagenum2').val();
  $("#searchform2").find("input[name='page_index']").val(pageindex);
  getrecycle(false);
});
document.onkeydown = function(e) {
    var ev = document.all ? window.event : e;
    if (ev.keyCode == 13) {
      $(".jumppage2").click();
    }
  }
  //限制输入跳转页
$("input[name='skippagenum'] #tab2").on("change keyup", function() {
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
$('.dataTables_length2').find("select").on("change", function() {
  var pagesize = $(this).val();
  $("#searchform2").find("input[name='page_size']").val(pagesize);
  getrecycle(true);
});
//分页点击跳转
$(".recyclepage").on("click", 'a', function() {
  if ($(this).parent().hasClass('active')) {
    return false;
  }
  var page = parseInt($(this).attr('pageval'));
  $('#searchform2').find("input[name='page_index']").val(page);
  getrecycle(false);
});
//删除
$("#ajaxcontent2").on("click",'.realdel', function() {
  var id = $(this).parent().data('id');
  layer.confirm('是否删除该文章？', {
    icon: 3,
    title: '提示'
  }, function(index) {
    $.ajax({
      type: "POST",
      url: site_url + "admin/article/delArticle",
      data: "id=" + id,
      dataType: "json",
      success: function(msg) {
        if (msg.status === 0) {
          getrecycle();
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
  //选中批量删除
$("#selecteddel2").on("click", function() {
  var selectednum = $("#ajaxcontent2 tr").find('div.checked').length;
  if (selectednum < 1) {
    layer.msg('请至少选中一个！', {
      icon: 2
    });
    return false;
  }
  layer.confirm('你确定要删除所选中的吗？！', {
    icon: 3,
    title: '提示'
  }, function(index) {
    $.ajax({
      type: "POST",
      url: site_url + "admin/article/delManyArticle",
      data: $("#operateform2").serialize(),
      dataType: "json",
      success: function(msg) {
        if (msg['status'] === 0) {
          getrecycle(false);
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
//还原
$("#ajaxcontent2").on("click",'.recycle', function() {
  var id = $(this).parent().data('id');
  layer.confirm('是否还原该文章？', {
    icon: 3,
    title: '提示'
  }, function(index) {
    $.ajax({
      type: "POST",
      url: site_url + "admin/article/restoreArticle",
      data: "id=" + id,
      dataType: "json",
      success: function(msg) {
        if (msg.status === 0) {
          getrecycle();
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
