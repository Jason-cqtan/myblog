// 左部导航
$(document).ready(function () {
    $('.sidebar-menu').tree()
})
// 列表筛选
$("#clicksearch").on("click", function() {
    var collapsein = $(this).find('i').hasClass('fa-angle-left') ? false : true;
    if (collapsein) {
    $(this).find('i').removeClass('fa-angle-down').addClass('fa-angle-left');
    } else {
    $(this).find('i').removeClass('fa-angle-left').addClass('fa-angle-down');
    }
})
//全选多选
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
//icheck
$('input[type="checkbox"],#searchform input[type="radio"]').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass: 'iradio_minimal-blue'
});