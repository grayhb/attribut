
	
	$(window).scroll(function() {
		//var offset = $("#header").offset();
		//$("#header").stop().animate({top: $(window).scrollTop()}, 250);
	});	


$(document).ready(function(){
	
	//главное меню
		if($('#menu-menu > li').hasClass('current-menu-item'))
			initCurrentMenuItemt();
		
		if($('#menu-menu > li').hasClass('current-menu-parent'))
			initCurrentMenuParent();
	//---
		
		
	
	
	
});
	
	

//управление главным меню
	function initCurrentMenuItemt () {
		$('#menu-menu > li')
		.mouseenter(function(){
			if($(this).find('.sub-menu').length == 1){
				if(!$(this).hasClass('current-menu-item')){
					$('.sub-menu').hide();
					$(this).find('.sub-menu').show();
				};
			};
		})
		.mouseleave(function(){
			if(!$(this).hasClass('current-menu-item')){
				$('.sub-menu').hide();
				$('#menu-menu > li.current-menu-item').find('.sub-menu').show();
			}
		});
	};

	function initCurrentMenuParent () {
		$('#menu-menu > li')
		.mouseenter(function(){
			if($(this).find('.sub-menu').length == 1){
				if(!$(this).hasClass('current-menu-parent')){
					$('#menu-menu .sub-menu').hide();
					$(this).find('.sub-menu').show();
				};
			};
		})
		.mouseleave(function(){
			if(!$(this).hasClass('current-menu-parent')){
				$(this).find('.sub-menu').hide();
				$('#menu-menu li.current-menu-parent').find('.sub-menu').show();
			};
		});
	};
//---
