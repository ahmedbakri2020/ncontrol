$(document).ready(function(){
	$(".menu-toggle").click(function(){
		$(this).children('.sub-menu').toggleClass("show");
		$(this).toggleClass("toggled");
		$(this).children('a').find('.pull-right').toggleClass("fa-caret-down");
	});	
	$(".sidebar-toggle").click(function(){
		$(".left-sidebar").toggleClass("minified");
		$(".content-wrapper").toggleClass("expanded");
		$(this).children('a').find('.fa-toggle-left').toggleClass("fa-toggle-right");
	});
	$('#check-all').click(function(e){
		var table= $(e.target).closest('table');
		$('tbody tr th input:checkbox',table).prop('checked',this.checked);
		
	});
});