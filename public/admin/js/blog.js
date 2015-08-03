/* blog common js */
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
		alert(id);
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
// 留言首页添加回复
function doContactReply(id) {
	$("#reply_id").val('');
	$("#reply_id").val(id);
	var replay_box = document.getElementById("replay-box");
	if(replay_box.style.display=='none') {
		replay_box.style.display='block';
	} else {
		replay_box.style.display='none';
	}
}
//添加评论回复
function doCommentReply(reply_id,comment_id) {
	$("#reply_id").val('');
	$("#comment_id").val('');
	$("#reply_id").val(reply_id);
	$("#comment_id").val(comment_id);
	var top = ($(window).height() - $("#replay-box").height())/2;
    var left = ($(window).width() - $("#replay-box").width())/2;
    var scrollTop = $(document).scrollTop();
    var scrollLeft = $(document).scrollLeft();
    left = $("#replay-box").width()/2;
    top = $("#replay-box").height()/2;
    $("#replay-box").css( { position : 'absolute', top : top + scrollTop, left : left + scrollLeft } ).show();
	$("#replay-box .widget").show();
	$("#cover").show();
}
//关闭评论回复框
function closePop() {
	$("#reply_id").val('');
	$("#comment_id").val('');
	$("#replay-box").hide();
	$("#cover").hide();
}
// 增加新页面
function newPage() {
	var main_new = document.getElementById("new_page");
	if(main_new.style.display=='none') {
		main_new.style.display='block';
	} else {
		main_new.style.display='none';
	}
	$("#new_page input[type='text'],textarea").each(function() {
		$(this).val("");
	});
}
/* site menu */
function menuC(id) {
	var c_class = $("#ch"+id).attr("class");
	if(c_class == 'imgcheck') {
		//修改为开启
		var status = 'show';
		$.post(__A+'site/ajaxMenu', {id:id,status:status});
		$("#ch"+id).attr("class","imgcheck-on");
	}
	if(c_class == 'imgcheck-on') {
		//修改问关闭
		var status = 'hide';
		$.post(__A+'site/ajaxMenu', {id:id,status:status});
		$("#ch"+id).attr("class","imgcheck");
	}
}


function updNotice() {
	id = getCheckbox();
	$.ajax({
		url:__A+'other/updNotice',
		data:'id='+id,
		type:'post',
		success:function(data){
			if(data){
				window.location.reload();
			}
		}
	})
}
// sort条件搜索
function searchSort(val) {
	window.location = __A+'search/index?sort='+val;
}
// user条件搜索
function searchUser(val) {
	window.location = __A+'search/index?user='+val;
}
// keyword 条件搜索
function searchKeyWord() {
	var q = $("#search_input").val();
	window.location = __A+'search/index?q='+q;
}
// 改变sort
function changeSort(val) {
	$("input[type='checkbox']:checked").each(function(){
		var strid = '';
		//获取所有选中条目的id
		$("input[type='checkbox']:checked").each(function(){
			strid += $(this).attr("id") + ",";
		});
		if(strid =="," || strid=="") {
			return false;
		}
		id = strid;
	});
	$.post(
		__A+'sort/sortChange',
		{id:id,val:val},
		function(data){
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
	$("input[type='checkbox']:checked").each(function(){
		var strid = '';
		//获取所有选中条目的id
		$("input[type='checkbox']:checked").each(function(){
			strid += $(this).attr("id") + ",";
		});
		if(strid =="," || strid=="") {
			return false;
		}
		id = strid;
	});
	$.ajax({
		url:__A+'article/doArticleTop',
		data:'id='+id+'&val='+val,
		type:'post',
		success:function(data){
			if(data){
				window.location.reload();
			} else {
				alert("置顶修改失败");
			} 
		}
	})
}
// 文章密码显示
$(function(){
   $(".rad").click(function(){
	  	if($(this).attr("value")=="0") {
	  		$("#password").show();
		} else {
			$("#password").hide();
		}
   });
});
/* record */
// 加载
$(function () {
	$(".record_re").toggle(
		function() {
        	tid = $(this).attr('id');
       		$.post(__A+'record/getComment', {id:tid}, function(data){
       			$("#r_" + tid).html(data);
        		$("#rp_"+tid).show();
			});
		},
      	function() {
        	tid = $(this).attr('id');
        	$("#r_" + tid).html('');
        	$("#rp_"+tid).hide();
    	}
	);
});
// 删除评论
function delComment(cid,id){
    if(confirm('你确定要删除该条回复吗？')) {
    	$.post(__A+'record/delComment', {'cid':cid,'id':id}, function(data) {
            var cnum = $("#"+id+" span").text();
            $("#"+id+" span").text(cnum-1);
			$("#reply_"+cid).hide("slow");
		})
	} else {
		return;
	}
}
// 评论说说
function addComment(id){
    var comment = $("#rp_"+id+" textarea").val();
	$.post(__A+'record/doComment', {'id':id,'comment':comment}, function(data){
		data = $.trim(data);
		if (data == 'err1'){
            $(".huifu span").text('回复长度需在140个字内');
		} else {
    		//$("#r_"+id).append(data);	//插入尾部
    		$(data).prependTo("#r_"+id);//插入开头
    		var cnum = Number($("#"+id+" span").text());
    		$("#"+id+" span").text(cnum+1);
    		$(".huifu span").text('');
    		$(".rcon").attr("value","");
    	}
	});
}
// 回复评论
function reply(id, rp){
    $("#rp_"+id+" textarea").val(rp);
    $("#rp_"+id+" textarea").focus();
}
