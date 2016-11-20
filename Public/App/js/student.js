$(document).ready(function(){
	// 三个页面切换
	$("#nav li").click(function(){
		var i = $(this).index();
		if(i==0){
			$(".choose").show();
			$(".upload").hide();
			//颜色
			$("#nav a:eq(0)").removeClass("select")
			$("#nav a:eq(1)").addClass("select")
		}else{
			$(".choose").hide();
			$(".upload").show();

			//颜色
			$("#nav a:eq(0)").addClass("select")
			$("#nav a:eq(1)").removeClass("select")
		}
	});
});