
$(document).ready(function(){


	//основной слайдер
	
	$('#frame-portfolio').sly({
		horizontal: 1,
		itemNav: "forceCentered",
		scrollBy: 1,
		startAt: 0,
		next: '.portfolio .next',
		prev: '.portfolio .prev',
		pagesBar: '.portfolio .pages'
	});

	$('.portfolio .prev').hide();
	$('.portfolio .next').fadeIn();
	$('#frame-portfolio').sly('toCenter', 1);
	
	
	//отключаем переход слайдера по клику итема
	$('#frame-portfolio ul li').unbind('mouseup');

	$('#frame-portfolio ul').find('li').each(function(){
		$(this).on( 'sly:active', function( event, $items, relatives ){ 
			
			if (relatives.activeItem == 0) { 
				$('#frame-portfolio').sly('toCenter', 1);					
				return;
			}
			
			relatives.items = $('#frame-portfolio ul li').size();
			
			//фикс для IE
			if (relatives.activeItem > relatives.items-2) { 
				$('#frame-portfolio').sly('toCenter', relatives.items-2);					
				return;
			}
			
			
			//кнопка назад
			if (relatives.activeItem > 1) 
				$('.portfolio .prev').show();
			else
				$('.portfolio .prev').hide();
				
			//кнопка вперед
			if (relatives.activeItem >= relatives.items-2) 
				$('.portfolio .next').hide();
			else
				$('.portfolio .next').show();
				
		} );
	});	
	
	//фикс страниц
	$('.portfolio .pages').find('li').each(function() {
		if ($(this).index()==0) $(this).hide();
		if ($(this).index() >= $('#frame-portfolio ul li').size()-1) $(this).hide();
	});
	
	$('.lightbox-holder').css('height',popupbg());
	
	$('.lightbox-holder .bg, .lightbox-holder .close').click(function(){
		$(this).parents('.lightbox-holder').fadeOut(200);
		return false;
	});


	$('.portfolio li div a').click(function() {
		
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
		
		$('.lightbox-holder').fadeIn(200);
		$('.lightbox-holder .lightbox').css({top:($(window).height()/2-$('.lightbox-holder .lightbox').outerHeight()/2 + $(window).scrollTop())});
		
		var container_main = $(this).parent().find('.where-will-be-data');

		if (container_main.html() == "") {
			container_main.load(
				container_main.attr('data-link'),
				{},
				function() {
					LoadLightBox(container_main);
				});
		} else 
		{
			LoadLightBox(container_main);
		}
		
		return false;
	});


});

//Загрузка данных в лайтбокс
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
		itemNav: 'centered', 
		scrollBy: 1, 
		startAt: 0,
		next:'.lightbox a.next, .lightbox .lightbox-frame .image ul li img',
		prev:'.lightbox a.prev',
		speed:650,
		scrollBar: '.lightbox-holder .scrollbar'
	});	


	$('.lightbox  ').removeClass('ajax_loading');	
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