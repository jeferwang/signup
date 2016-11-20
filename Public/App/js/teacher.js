$(document).ready(function(){
	// 三个页面切换
//	$("#nav li").click(function(){
//		var i = $(this).index();
//		if(i==0){
//			$(".creative").show();
//			$(".verify").hide();
//			$(".score").hide();
//			//颜色
//			$("#nav a:eq(0)").removeClass("select unselect")
//			$("#nav a:eq(1)").addClass("select")
//			$("#nav a:eq(2)").addClass("select")
//		}
//		else if(i==1){
//			$(".creative").hide();
//			$(".verify").show();
//			$(".score").hide();
//
//			//颜色
//			$("#nav a:eq(0)").addClass("select")
//			$("#nav a:eq(1)").removeClass("select unselect")
//			$("#nav a:eq(2)").addClass("select")
//		}
//		else{
//			$(".creative").hide();
//			$(".verify").hide();
//			$(".score").show();
//
//			//颜色
//			$("#nav a:eq(0)").addClass("select")
//			$("#nav a:eq(1)").addClass("select")
//			$("#nav a:eq(2)").removeClass("select unselect")
//		}
//	});

	//第一个页面2个子页面切换
	var oCreative = $(".creative form");
	var oHistory = $(".creative .game");

	$(".nav_title li").click(function(){
		var i = $(this).index();
		if(i==0){
			oCreative.show();
			oHistory.hide();
			$(".nav_title li").addClass("nav_focus");
			$(".nav_title li").next().removeClass("nav_focus");
		}else{
			oCreative.hide();
			oHistory.show();
			$(".nav_title li").addClass("nav_focus");
			$(".nav_title li:eq(0)").removeClass("nav_focus");
		}
	})
});