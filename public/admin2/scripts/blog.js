/* blog common js */

// 删除操作
function doDel(id,url) {
	if(confirm("确定要删除吗？")){
		$.ajax({
			url:url,
			data:'id='+id,
			type:'post',
			success:function(res){
				window.location.reload();
			}
		})
	}
}
// 增加新页面
function newPage() {
	var main_new = document.getElementById("main_new");
	if(main_new.style.display=='none') {
		main_new.style.display='block';
	} else {
		main_new.style.display='none';
	}
}
// 隔行换色
$(document).ready(function(){   
    $("#article_table tr").mouseover(function(){   
      $(this).addClass("over");}).mouseout(function(){    //给这行添加class值为over，并且当鼠标一出该行时执行函数
            $(this).removeClass("over");
      }) //移除该行的class    
  	$("#article_table tr:even").addClass("alt");    //给class为stripe的表格的偶数行添加class值为alt
});
/* article */
// jQuery 实现复选框的全选和取消全选
function selectAll() {
	if($("input[name='select[]']").attr('checked')) {
		$("input[name='select[]']").removeAttr('checked');
	} else {
		$("input[name='select[]']").attr('checked','checked');
	}
}
function getCheckbox() {
	var id = '';
	//遍历判断
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
	return id;
}
// 实现删除操作
function delAll() {
	if(confirm("确定要删除吗？")){
		id = getCheckbox();
		$.ajax({
			url:__A+'article/doDel',
			data:'id='+id,
			type:'post',
			success:function(data){
				if(data){
					window.location.reload();
				}else{
					alert("文章删除失败");
				}
			}
		})
	}
}
//实现删除操作
function delSelect(type) {
	if(confirm("确定要删除吗？")){
		id = getCheckbox();
		$.ajax({
			url:__A+'comment/doDel',
			data:'id='+id+'&type='+type,
			type:'post',
			success:function(data){
				if(data){
					window.location.reload();
				}else{
					alert("评论删除失败");
				}
			}
		})
	}
}
//实现删除操作
function delNotice() {
	if(confirm("确定要删除吗？")) {
		id = getCheckbox();
		$.ajax({
			url:__A+'other/delNotice',
			data:'id='+id,
			type:'post',
			success:function(data){
				if(data){
					window.location.reload();
				}else{
					alert("消息删除失败");
				}
			}
		})
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
/* site menu */
function changeClass(id) {
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