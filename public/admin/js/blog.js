/*
 * blog common js
 * 后台页面js调用
 *
 * @author 	wangyongdong
 * @time	2015年8月12日18:22:21
 *
 */

//jquery 实现复选框的全选和取消全选
$("#checkall").click(function() {
	if(this.checked) {
        $("input[name='select[]']").prop("checked", true);   
    } else {    
        $("input[name='select[]']").prop("checked", false); 
    }
});
//获取checked多选的id
function getCheckbox() {
	var id = '';
	//遍历判断
	$("input[type='checkbox']:checked").each(function() {
		var strid = '';
		//获取所有选中条目的id
		$("input[type='checkbox']:checked").each(function() {
			strid += $(this).attr("id") + ",";
		});
		if(strid =="," || strid=="") {
			return false;
		}
		id = strid;
	});
	return id;
}
//实现删除操作
function delAll(url) {
	if(confirm("确定要删除吗？")) {
		id = getCheckbox();
		$.ajax({
			url:url,
			data:'id='+id,
			type:'post',
			success:function(data) {
				if(data) {
					window.location.reload();
				} else {
					alert("删除失败");
				}
			}
		})
	}
}
//删除操作
function doDel(id,url) {
	if(confirm("确定要删除吗？")) {
		$.ajax({
			url:url,
			data:'id='+id,
			type:'post',
			success:function(res) {
				window.location.reload();
			}
		})
	}
}
//标记为已读，隐藏等
function doStatus(url) {
	id = getCheckbox();
	$.ajax({
		url:url,
		data:'id='+id,
		type:'post',
		success:function(data) {
			if(data) {
				window.location.reload();
			} else {
				alert("操作失败");
			}
		}
	})
}
// 修改 sort
function changeSort(val) {
	id = getCheckbox();
	$.post(
		__A+'article/sortChange',
		{id:id,val:val},
		function(data) {
			if(data) {
				window.location.reload();
			} else {
				alert("类别修改失败");
			}
		}
	);
}
// 修改置顶
function changeTop(val) {
	id = getCheckbox();
	$.ajax({
		url:__A+'article/ArticleTop',
		data:'id='+id+'&val='+val,
		type:'post',
		success:function(data) {
			if(data) {
				window.location.reload();
			} else {
				alert("置顶修改失败");
			}
		}
	})
}
//保存图片
function saveImg(val) {
	var id = $("#id").val();
	$.post(
		__A+'member/doProfile',
		{id:id,picname:val,type:'img'},
		function(data) {
			if(!data) {
				alert("保存失败");
			}
		}
	);
}
//搜索提交
function searchF(url) {
	var keyword = $("#s_keyword").val();
	window.location = url+'?s='+keyword;
}
//sort条件搜索
function searchSort(val,url) {
	window.location = url+'?sort='+val;
}
// user条件搜索
function searchUser(val,url) {
	window.location = url+'?author='+val;
}
// 搜索操作日志
function searchActionLog() {
	var date_start = $("#date_start").val();
	var date_end = $("#date_end").val();
	window.location = __A+'site/action?ds='+date_start+'&de='+date_end;
}
// 删除操作日志
function delActionLog() {
	if(confirm("确定要清空吗？")) {
		$.ajax({
			url:__A+'site/delActionLog',
			type:'post',
			success:function(data) {
				if(data) {
					window.location.reload();
				} else {
					alert("删除失败");
				}
			}
		})
	}
}
//弹出提示框
function popTips(val) {
	var win_str = '<div id="myModal" class="modal fade in" style="display: block;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-dialog win-min"><div class="modal-content"><div class="modal-header win-header"><button type="button" class="close" onclick="close_pop();">×</button><h4 class="modal-title">&nbsp;</h4></div><div class="modal-body"><p class="center">'+val+'</p></div><div class="modal-footer win-footer"></div></div></div></div><div class="modal-backdrop fade in"></div>';
	$(document.body).addClass("modal-open");
	$(".pop_tips").append(win_str);
	return false;
}
//关闭提示框
function close_pop() {
	$(document.body).addClass("");
	$(".pop_tips").html("");
}
//数据验证
function checkFormA() {
	var title = $("#title").val();
	var keyword = $("#keyword").val();
	var content = UE.getEditor('editor').getContent();
	
	if(title.length == 0) {
		popTips('请输入标题');
		return false;
	}
	if(content.length == 0) {
		popTips('请输入内容');
		return false;
	}
	if(keyword.length == 0) {
		popTips('请输入关键词');
		return false;
	}
	return true;
}
function checkFormC() {
	var content = $("#content").val();
	
	if(content.length == 0) {
		popTips('请输入内容');
		return false;
	}
	return true;
}
function checkFormL() {
	var name = $("#name").val();
	var url = $("#url").val();
	
	if(name.length == 0) {
		popTips('请输入名称');
		return false;
	}
	if(url.length == 0) {
		popTips('请输入url');
		return false;
	}
	return true;
}
function checkFormM() {
	var name = $("#name").val();
	if(name.length == 0) {
		popTips('请输入用户名');
		return false;
	}
	return true;
}
function checkFormS() {
	var name = $("#name").val();
	var alias = $("#alias").val();
	
	if(name.length == 0) {
		popTips('请输入名称');
		return false;
	}
	if(alias.length == 0) {
		popTips('请输入别名');
		return false;
	}
	return true;
}
function checkPopL() {
	var name = $("#name").val();
	var url = $("#url").val();
	if(name.length == 0) {
		$("#name").addClass('form-pop');
		return false;
	}
	if(url.length == 0) {
		$("#url").addClass('form-pop');
		return false;
	}
	return true;
}

function checkPopC(id) {
	//var content = $("#content"+id).text();
	var content = $("#myModal"+id+" #content").val();
	if(content.length == 0) {
		$("#content"+id).addClass('form-pop');
		return false;
	}
	comment = replace_em(content);
	$("#myModal"+id+" #content").val('');
	$("#myModal"+id+" #content").val(comment);
	return true;
}
function checkPopS() {
	var name = $("#name").val();
	var alias = $("#alias").val();
	
	if(name.length == 0) {
		$("#name").addClass('form-pop');
		return false;
	}
	if(alias.length == 0) {
		$("#alias").addClass('form-pop');
		return false;
	}
	return true;
}
function checkPopR() {
	var role = $("#role").val();
	var name = $("#name").val();
	if(role.length == 0) {
		$("#role").addClass('form-pop');
		return false;
	}
	if(name.length == 0) {
		$("#name").addClass('form-pop');
		return false;
	}
	return true;
}
//消除警示
$(function() {
	$(".form-horizontal input,.form-horizontal textarea").focus(function() {
		$(this).removeClass('form-pop');
	});
	$("#inputEmail").focus(function() {
		$(".login-warning").text("");
	});
	$("#inputPassword").focus(function() {
		$(".login-warning").text("");
	});
})
//登录
function signIn() {
	var email = $("#inputEmail").val();
	var pass = $("#inputPassword").val();
	
	if(email.length == 0) {
		$("#inputEmail").addClass('form-pop');
		return false;
	}
	/*if (/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(email) == false) {
		$("#inputEmail").addClass('form-pop');
		$(".login-warning").text("邮箱格式不正确，请重新填写");
		return false;
	}*/
	if(pass.length == 0) {
		$("#inputPassword").addClass('form-pop');
		return false;
	}
	if(pass.length < 6 || pass.length >16) {
		$("#inputPassword").addClass('form-pop');
		$("#pass").text("密码合法长度为6-16个字符");
		return false;
	}
	$.post(
		__A+'login/loginIn',
		{name:email,pass:pass},
		function(data) {
			if(data.success) {
				window.location.href = __A;
			}
			if(data.error) {
				if(data.status == -1) {
					$("#inputEmail").addClass('form-pop');
					$("#email").text(data.error);
					return false;
				}
				if(data.status == -2) {
					$("#inputPassword").addClass('form-pop');
					$("#pass").text(data.error);
					return false;
				}
				if(data.status == -3) {
					$("#inputEmail").addClass('form-pop');
					$("#pass").text(data.error);
					return false;
				}
			}
		},
		"json"
	);
}
// 
function doBakcup() {
	$.ajax({
		url:__A+'site/doBackup',
		data:'module=data',
		type:'post',
		success:function(data) {
			if(data) {
				window.location.reload();
			} else {
				alert("删除失败");
			}
		}
	})
}
