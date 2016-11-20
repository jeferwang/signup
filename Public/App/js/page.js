//Ajax获取某一页面的内容
function setPage($url,$page){
	$.post($url,{'page':$page},function(data){
		var arr=eval(data);
		$(".page").empty();
		$.each(arr, function($i,$item) {
			$(".page").append(
				'<li><a href="javascript:void(0)">'+$item['title']+'</a><p>'+$item['status']+'<span>'+$item['starttime']+'</span></p></li>'
			);
		});
//		给当前页码添加id标识
		$('.page_num').removeAttr('id');
		$('#'+$page).parent('li').attr('id','current');
//		对所有页码取消高亮
		$('.page_num').children('a').removeClass('special');
//		给当前页码加上高亮
		$('#'+$page).addClass('special');
	});
}
function prev($url){
	var $page=$('#current').children('a').attr('id');
	if($page==1){
		return false;
	}else{
		$page=Number($page)-1;
	}
	$.post($url,{'page':$page},function(data){
		var arr=eval(data);
		$(".page").empty();
		$.each(arr, function($i,$item) {
			$(".page").append(
				'<li><a href="javascript:void(0)">'+$item['title']+'</a><p>'+$item['status']+'<span>'+$item['starttime']+'</span></p></li>'
			);
		});
		//		给当前页码添加id标识
		$('.page_num').removeAttr('id');
		$('#'+$page).parent('li').attr('id','current');
//		对所有页码取消高亮
		$('.page_num').children('a').removeClass('special');
//		给当前页码加上高亮
		$('#'+$page).addClass('special');
	});
}
function next($url,$count){
	var $page=$('#current').children('a').attr('id');
	if($page==$count){
		return false;
	}else{
		$page=Number($page)+1;
	}
	$.post($url,{'page':$page},function(data){
		var arr=eval(data);
		$(".page").empty();
		$.each(arr, function($i,$item) {
			$(".page").append(
				'<li><a href="javascript:void(0)">'+$item['title']+'</a><p>'+$item['status']+'<span>'+$item['starttime']+'</span></p></li>'
			);
		});
		//		给当前页码添加id标识
		$('.page_num').removeAttr('id');
		$('#'+$page).parent('li').attr('id','current');
//		对所有页码取消高亮
		$('.page_num').children('a').removeClass('special');
//		给当前页码加上高亮
		$('#'+$page).addClass('special');
	});
}