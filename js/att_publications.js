
$(document).ready(function(){

	$('.scroll-holder').sly({
		itemNav: 'forceCentered',
		horizontal: 1,
		scrollBy: 1, 
		easing: 'easeOutCirc',
		next: '.scroll .next',
		prev: '.scroll .prev',
		startAt: 1
	});
	
	$('.scroll .next').show();


	$('.scroll-holder ul').find('li').each(function(){
		$(this).on( 'sly:active', function( event, $items, relatives ){ 
			
			if (relatives.activeItem == 0) { 
				$('.scroll-holder').sly('toCenter', 1);					
				return;
			}
			
			if (relatives.activeItem > relatives.items-2) { 
				$('.scroll-holder').sly('toCenter', relatives.items-2);					
				return;
			}			
			
			//кнопка назад
			if (relatives.activeItem > 1) 
				$('.scroll .prev').show();
			else
				$('.scroll .prev').hide();
				
			//кнопка вперед
			if (relatives.activeItem >= relatives.items-2) 
				$('.scroll .next').hide();
			else
				$('.scroll .next').show();

		} );
	});	
	
	//отключаем переход слайдера по клику итема
	$('.scroll-holder ul li').unbind('mouseup');


	
	//высота бэкграунда
	$('.lightbox-holder').css('height',popupbg());
	
	//обработка событий закрытия лайтбокса
	$('.lightbox-holder .bg, .lightbox-holder .close').click(function(){
		$(this).parents('.lightbox-holder').fadeOut(200);
		$('.scroll').show();
		$('#footer').css('margin-top', 0 );				
		return false;
	});
	
	
	
	
	


	//открытие лайтбокса и загрузка
	$('.publications li div a').click(function() {
		
		
		//очистка и подготовка лайтбокса
		$('#frame').sly( 'destroy' );
		$('#frame').sly( false );
		$('.lightbox h3').text(''); 
		$('.slidee').html('');
		$('.lightbox .lightbox-frame .image ul').html('');
		$('.lightbox .scrollbar').hide();
		$('.lightbox .image').hide();
		$('.lightbox ').addClass('ajax_loading');
		//---
		/*
		var header_height = $('#header').offset().top + $('#header').height();
		$('.lightbox-holder').css('top', header_height + 10);
		$('.lightbox-holder').css('height', $('.lightbox-holder').height() - header_height-10);
		*/
		
		$('.lightbox-holder .lightbox').css({top:($('.scroll').offset().top)});
		$('.scroll').hide();
		$('#footer').css('margin-top', 320 );
		
		$('.lightbox-holder').fadeIn(200);
		//$('.lightbox-holder .lightbox').css({top:($(window).height()/2-$('.lightbox-holder .lightbox').outerHeight()/2 + $(window).scrollTop())});
		
		var container_main = $(this).parent().parent().find('.where-will-be-data');
		if (container_main.html() == "") {
			container_main.load(
				container_main.attr('data-link'),
				{},
				function() {
					LoadLightBox(container_main);
				});
		} 
		else {
			LoadLightBox(container_main);
		}
		
		return false;
	});

});


function LoadLightBox(container_main) {

	var _slideList = container_main.html();
	var _title = container_main.parent().find('.head').text();
	
	$('.lightbox h3').text(_title); 
	
	$('.slidee').html(_slideList);
	
	
	$('.slidee').each(function(){
		$(this).find('li').each(function(){
			$('.lightbox .lightbox-frame .image ul').append('<li><center><img src="'+$(this).find('a').attr('href')+'" alt="'+$(this).find('img').attr('alt')+'" style="display:none;" /></center><span class="description">'+$(this).find('img').attr('alt')+'</span></li>');
			$(this).find('a').attr('src', $(this).find('a').attr('href'));
			$(this).find('a').attr('href', "#");
			$(this).find('a').click(function () {return false;});
			
			$(this).on( 'sly:active', function( event, $items, relatives ){ 
				
				$active_src = $(this).find('a').attr('src');
				$('.lightbox .lightbox-frame .image ul').find('li').each(function(){

					if (!$(this).find('img').is(":hidden"))
						$(this).find('img').fadeOut();
					
					if ($active_src  == $(this).find('img').attr('src'))
						$(this).find('img').fadeIn();

				});
										
			} );
		});
	});
	

	$('#frame').sly({
		horizontal: 0, 
		itemNav: 'smart', 
		scrollBy: 1, 
		startAt: 0,
		next:'.lightbox .image .next, .lightbox .lightbox-frame .image ul li img',
		prev:'.lightbox .image .prev',
		speed:650,
		scrollBar: '.lightbox-holder .scrollbar'
	});	

	$('.lightbox ').removeClass('ajax_loading');	

	$('.lightbox .scrollbar').show();				
	$('.lightbox .image').show();
	
	$('.lightbox .lightbox-frame .image ul li img').css('cursor' ,  'pointer');
}

function popupbg () {
	$('.lightbox-holder').css('height','auto');
	var _height = $(document).height();
	if (_height < $(window).height()) {_height = $(window).height()};
	return _height;
}