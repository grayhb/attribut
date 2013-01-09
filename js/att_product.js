
$(window).ready(function(){

	//двери
		$("#dveri-frame h3 a").each(function(){
			var ahref=$(this).attr("href");
			$(this).parents("h3").next().find("a").attr("href", ahref);
		});
		
		
		
		//слайдер
		$('#dveri-frame').sly({
			horizontal: 1,
			itemNav: 'forceCentered',
			startAt: 1,
			scrollBy: 1, 
			speed:1000,
			easing: 'easeOutCirc',
			next:'.dveri .next',
			prev:'.dveri .prev'
		});	
		
		$('#dveri-frame ul').find('li').each(function(){
			$(this).on( 'sly:active', function( event, $items, relatives ){ 
				
				if (relatives.activeItem == 0) { 
					$('#dveri-frame').sly('toCenter', 1);					
					return;
				}
				
				if (relatives.activeItem > relatives.items-2) { 
					$('#dveri-frame').sly('toCenter', relatives.items-2);					
					return;
				}
				
				
				//кнопка назад
				if (relatives.activeItem > 1) 
					$('.dveri .prev').show();
				else
					$('.dveri .prev').hide();
					
				//кнопка вперед
				if (relatives.activeItem >= relatives.items-2) 
					$('.dveri .next').hide();
				else
					$('.dveri .next').show();
					
			} );
		});
		
	
		//отключаем переход слайдера по клику итема
		$('#dveri-frame ul li').unbind('mouseup');
		
		//показываем кнопку дальше
		$('.dveri .next').show();
	
	//---


	
	//активируем слайдер моделей
	$('.model .image-holder').sly({
			scrollBy: 120,
			scrollBar: '.scrollbar'
	});	
	
	//активируем изображение по клику превью
	$('.model .image-holder .slide-list a').click(function() {
		modelShowImg($('.image-holder .slide-list').find('a').index($(this)));
	});
		
		
	//кнопка - вперед
	$('.model .image a.next').click(function() {
		var _ItemIndex = $('.model .image ul').find('li').index($('.model .image ul li:visible'));
		var _ItemCount = $('.model .image ul li').size();
		
		if (_ItemIndex + 1 < _ItemCount) 
			modelShowImg(_ItemIndex+1);
		else 
			modelShowImg(0);
	});
		
	
	//кнопка - назад
	$('.model .image a.prev').click(function() {
		
		var _ItemIndex = $('.model .image ul').find('li').index($('.model .image ul li:visible'));
		var _ItemCount = $('.model .image ul li').size();
		
		if (_ItemIndex - 1 >= 0) 
			modelShowImg(_ItemIndex-1);
		else 
			modelShowImg(_ItemCount-1);
		
	});		
	
	
	initTabs ();
	initPhotos ();
	

});


//управление модел€ми в продукции
function modelShowImg(_ItemIndex) {
	
	$('.model .image-holder .slide-list a').removeClass('active');
	$('.model .image-holder .slide-list').find('a').eq(_ItemIndex).addClass('active');
	
	$('.model .image ul').find('li:visible').fadeOut();
	$('.model .image ul').find('li').eq(_ItemIndex).fadeIn();
	
	var _ItemTop = $('.model .image-holder .slide-list a').eq(_ItemIndex).offset().top;
	
	if (_ItemTop < 33) 
		$('.model .image-holder').sly( 'toStart' , $('.model .image-holder .slide-list').find('a').eq(_ItemIndex) );
		
	if (_ItemTop > 393) 
		$('.model .image-holder').sly( 'toEnd' , $('.model .image-holder .slide-list').find('a').eq(_ItemIndex) );
	
}


//управление “абами в продукции

	function initTabs () {
		$('.production').makeTabset({
			tab : '.content',
			control : '.menu',
			parent : '.production'
		});
	}


	(function($) {
		$.fn.makeTabset = function(o) {
			o = $.extend( {
				tab : '.tab',
				control : '.tabcontrol',
				parent : '.tabset'
			}, o || {});
			$(this).each(
					function() {
						tabset_holder = $(this);
						tabset_holder.find(o.control + ' li').each(function(){
							$(this).children('a').attr('href','tab'+($(this).index()+1));
						});
						var index = 1;	
						tabset_holder.find(o.tab).each(function(){
							$(this).addClass('tab'+index);
				
							if (index > 1 ) {
								//фикс дл€ моделей
								$(this).hide();
								$(this).removeClass('hide');
							} else {
								$(this).show();
							}

							
							if ( jQuery.trim($(this).html()).length == 0 ) {
								tabset_holder.find(o.control + ' li').eq(index-1).hide();
							}
							
							index += 1;
						});
						tabset_holder.find(o.control + ' li > a').bind('click',function(){
							if (!$(this).parent().is('.active')) {
								$(this).parents(o.parent).find(o.control + ' .active').removeClass('active');
								$(this).parents(o.parent).find(o.tab).slideUp(500);
								$(this).parent().addClass('active');
								$(this).parents(o.parent).find(o.tab + '.' + $(this).attr('href')).slideDown(500);
							}
							return false;
						});
					});
		};
	})(jQuery);

	function initPhotos () {
	
		$('.menu div a').click(function(){
			$(this).parent().find('.active').removeClass('active');
			$(this).addClass('active');
			
			var img = $(this).parents('.production').find('.tab1 .photo img');
			
			img.css('width', 'auto');
			img.hide();
			
			img.attr('src',$(this).attr('href')).load(function() {
			  
				_height = img.height();
				_width  = img.width();
				_max_w = 653;  //максимальна€ допустима€ ширина

				//соотношение сторон
				_k = _width / _height;
				
				//мен€ем ширину
				_width = _max_w;
				_height = _width / _k;
				
				//если высота больша€ мен€ем 
				if (_height > _max_w) {
					_height = _max_w;
					_width = _height * _k;
				}
				
				//центрирование
				_margin_left = img.parent().width();
				_margin_left -= _width;
				_margin_left = _margin_left / 2;
				
				img.height(_height);
				img.width(_width);	
				img.css('margin-left', _margin_left);		

				img.fadeIn();				
			
			});;

			return false;
		});
	}
//---	