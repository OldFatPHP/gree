function resize_window(){
	$("#left").height($(window).height()-50);
	$("#right").height($(window).height()-50).width($(window).width()-211);
}
$(function(){
	resize_window();
	$(window).resize(function(){
		resize_window();
	})
})
