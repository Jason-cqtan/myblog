//获取随机文章
function getrand() {
	var listobj = $(".random").find("ul");
	var loading = '<div class="overlay">\
              <i class="fa fa-refresh fa-spin"></i>\
            </div>';
	$(".random").append(loading);
	$.ajax({
		type: "POST",
		url: site_url + "home/getRand",
		data: "",
		dataType: "json",
		success: function(msg) {
			if (msg.list.length > 0) {
				listobj.html('');
				$.each(msg.list, function(key, val) {
					var list = '<li>\
              <span><a href="'+site_url+'module/'+val.module_name+'.html">[' + val.module_name + ']</a></span>\
              <span><a href="'+site_url+'desc/'+val.id+'.html" title="' + val.title + '">' + val.title + '</a></span>\
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
function getsoul() {
	var obj = $(".soul").find(".box-body");
	var loading = '<div class="overlay">\
              <i class="fa fa-refresh fa-spin"></i>\
            </div>';
	$(".soul").append(loading);
	$.ajax({
		type: "POST",
		url: site_url + "home/getSoul",
		data: "",
		dataType: "json",
		success: function(msg) {
			if(msg.word.hasOwnProperty('content')){
				obj.html('').append('<span>' + msg.word.content + '</span>');
			}			
			$(".soul").find('.overlay').remove();
		}
	});
	return false;
}

$(function() {
	getTags();
	getMonthly();
	getstatistics();
})
//点击获取鸡汤
$("#getsoul").on("click", function() {
	$.ajax({
		type: "POST",
		url: site_url + "home/getclicknum",
		data: "",
		dataType: "json",
		success: function(msg) {
			if (parseInt(msg.num) >= 5) {
				layer.alert(msg.msg, {
					icon: 6
				});
			} else {
				getsoul()
			}
		}
	});
	return false;
})

function getMonthly() {
	$.ajax({
		type: "POST",
		url: site_url + "home/getStatisticsBymonth",
		data: "",
		dataType: "json",
		success: function(msg) {
			var obj = $("#monthbody");
			obj.html('');
			$.each(msg.list, function(key, val) {
				var one = '<li><a href="'+site_url+'month/'+val.month+'.html" class="btn btn-primary btn-sm">' + val.month + ' <small>(' + val.num + ')</small></a></li>';
				obj.append(one);
			});
			return false;
		}
	});
	return false;
}

function getTags() {
	$.ajax({
		type: "POST",
		url: site_url + "home/getStatisticsByTags",
		data: "",
		dataType: "json",
		success: function(msg) {
			var obj = $("#tagsbody");
			obj.html('');
			$.each(msg.list, function(key, val) {
				var one = '<li><a href="';
				if(val.type == 'moduletag'){
                    one += site_url + 'module/'+val.name+'.html"';
				}else{
					one += site_url + 'tag/'+val.name+'.html"';
				}
				one += ' class="btn btn-primary btn-sm">' + val.name + ' <small>(' + val.num + ')</small></a></li>';
				obj.append(one);
			});
			return false;
		}
	});
	return false;
}

function getstatistics() {
	$.ajax({
		type: "POST",
		url: site_url + "home/getSimpleStatistics",
		data: "",
		dataType: 'json',
		success: function(msg) {
			var simplebody = $("#simplebody");
			simplebody.find('.articletotal').html(msg.articletotal);
			simplebody.find('.tagtotal').html(msg.tagtotal);
			simplebody.find('.commenttotal').html(msg.commenttotal);
		}
	});
}