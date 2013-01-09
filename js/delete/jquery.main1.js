/* script by Alan Tshovrebov -ProVerstka- */
$(document).ready(function(){

	if($('#menu > li').hasClass('current-menu-item')){
		initCurrentMenuItemt();
	}
	if($('#menu > li').hasClass('current-menu-parent')){
		initCurrentMenuParent();
	}


$(".scroll-holder h3 a, .scroll-holder1 h3 a").each(function(){
var ahref=$(this).attr("href");
$(this).parents("h3").next().find("a").attr("href", ahref);
});


	


	$('.scroll, .scroll1').galleryScroll({
		step:1,
		duration:500
	});
	var height = $(window).height();
	$('.photo-holder').css('height', height-168);
	$(window).resize(function(){
		var height = $(window).height();
		$('.photo-holder').css('height', height-168);
	});
	initTabs ();
	initPhotos ();
	$('.lightbox-holder').css('height',popupbg());
	$('.lightbox-holder .bg, .lightbox-holder .close').click(function(){
		$(this).parents('.lightbox-holder').fadeOut(200);
		return false;
	});
	$('.portfolio a').click(function(){
		$('.lightbox-holder .lightbox').css('top',$(window).scrollTop()+113);
		$('.lightbox-holder').fadeIn(200);
		return false;
	});
	$('.publications a').click(function(){
		$('.lightbox-holder .lightbox').css('top',$(window).scrollTop()+78);
		$('.lightbox-holder').fadeIn(200);
		return false;
	});
	$('div.lightbox-frame, div.production').fadeGallery({
		slideElements:'div.image ul li',
		btnNext:'div.image a.next',
		btnPrev:'div.image a.prev',
		pauseOnHover:false,
		autoRotation:false,
		switchTime:2000,
		duration:650,
		event:'click'
	});
	$('.lightbox-frame .image-list, .production .image-list').makeVertGallery({
		gallery_holder : 'ul.slide-list',
		gallery_item : 'li.slide-item'
	});
	$('.scroll .photo a,.scroll .alignnone, .scroll1 .photo a')
	.mouseleave(function(){
		$(this).parents('.scroll, .scroll1').find('.prev, .next').hide();
	})
	.mouseenter(function(){
		$(this).parents('.scroll, .scroll1').find('.prev, .next').show();
	});
	$('.scroll a.prev, .scroll a.next, .scroll1 a.prev, .scroll1 a.next')
	.mouseleave(function(){
		$('.scroll a.prev, .scroll a.next, .scroll1 a.prev, .scroll1 a.next').hide();
	})
	.mouseenter(function(){
		$('.scroll a.prev, .scroll a.next, .scroll1 a.prev, .scroll1 a.next').show();
	});
});
function initCurrentMenuItemt () {
	$('#menu > li')
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
			$('#menu > li.current-menu-item').find('.sub-menu').show();
		}
	});
};
function initCurrentMenuParent () {
	$('#menu > li')
	.mouseenter(function(){
		if($(this).find('.sub-menu').length == 1){
			if(!$(this).hasClass('current-menu-parent')){
				$('#menu .sub-menu').hide();
				$(this).find('.sub-menu').show();
			};
		};
	})
	.mouseleave(function(){
		if(!$(this).hasClass('current-menu-parent')){
			$(this).find('.sub-menu').hide();
			$('#menu li.current-menu-parent').find('.sub-menu').show();
		};
	});
};
function initPhotos () {
	$('.menu div a').click(function(){
		$(this).parent().find('.active').removeClass('active');
		$(this).addClass('active');
		$(this).parents('.production').find('.tab1 .photo img').attr('src',$(this).attr('href'));
		return false;
	});
}
function popupbg () {
	$('.lightbox-holder').css('height','auto');
	var _height = $(document).height();
	if (_height < $(window).height()) {_height = $(window).height()};
	return _height;
}
$(window).resize(function(){
	$('.lightbox-holder').css('height',popupbg());
});
jQuery.fn.makeVertGallery = function(o) {
	o = $.extend( {
		interval : 2000, /* Р С‘Р Р…РЎвЂљР ВµРЎР‚Р Р†Р В°Р В» Р Р†РЎР‚Р В°РЎвЂ°Р ВµР Р…Р С‘РЎРЏ 1000 = 1РЎРѓР ВµР С”РЎС“Р Р…Р Т‘Р В° */
		speed : 1000, /* РЎРѓР С”Р С•РЎР‚Р С•РЎРѓРЎвЂљРЎРЉ Р С—Р ВµРЎР‚Р ВµР СР ВµРЎвЂ°Р ВµР Р…Р С‘РЎРЏ 1000 = 1РЎРѓР ВµР С”РЎС“Р Р…Р Т‘Р В° */
		gallery_frame : '.image-holder',
		gallery_holder : 'ul',
		gallery_item : 'li'
	}, o || {});
	var steps = 1;
	return this.each(function(){
		var _phase = true;
		main_holder = $(this);
		var item_class = main_holder.find(o.gallery_item).attr('class');
		var step = ($(this).find(o.gallery_item).outerHeight()) * steps;
		main_holder.find('.up').click(function(){
			if (_phase) {
				_phase = false;
				oneStepMinus();
			}
			return false;
		});
		main_holder.find('.down').click(function(){
			if (_phase) {
				_phase = false;
				oneStepPlus();
			}
			return false;
		});
		function oneStepPlus () {
			main_holder.find(o.gallery_holder).animate({marginTop:step*(-1)}, o.speed, function(){
				$(this).append($(this).find(o.gallery_item+':first'));
				$(this).css('margin-top','0');
				_phase = true;
			});
		};
		function oneStepMinus () {
			main_holder.find(o.gallery_holder).css('margin-top',-step).prepend(main_holder.find(o.gallery_holder).find(o.gallery_item+':last'));
			main_holder.find(o.gallery_holder).animate({marginTop:0}, o.speed, function(){
				$(this).css('margin-top','0');
				_phase = true;
			});
		};
	});
};
jQuery.fn.fadeGallery = function(_options){
	var _options = jQuery.extend({
		slideElements:'div.slideset > div',
		pagerLinks:'div.image-list ul a',
		btnNext:'a.next',
		btnPrev:'a.prev',
		btnPlayPause:'a.play-pause',
		pausedClass:'paused',
		playClass:'playing',
		activeClass:'active',
		pauseOnHover:true,
		autoRotation:false,
		autoHeight:false,
		switchTime:3000,
		duration:650,
		event:'click',
		number : '.number'

	},_options);




	return this.each(function(){
		var _this = jQuery(this);
		var _slides = jQuery(_options.slideElements, _this);
		var _pagerLinks = jQuery(_options.pagerLinks, _this);
		var _btnPrev = jQuery(_options.btnPrev, _this);
		var _btnNext = jQuery(_options.btnNext, _this);
		var _btnPlayPause = jQuery(_options.btnPlayPause, _this);
		var _pauseOnHover = _options.pauseOnHover;
		var _autoRotation = _options.autoRotation;
		var _activeClass = _options.activeClass;
		var _pausedClass = _options.pausedClass;
		var _playClass = _options.playClass;
		var _autoHeight = _options.autoHeight;
		var _duration = _options.duration;
		var _switchTime = _options.switchTime;
		var _controlEvent = _options.event;
		var _number = jQuery(_options.number, _this);


		var _phase = true;
		var _hover = false;
		var _prevIndex = 0;
		var _currentIndex = 0;
		var _slideCount = _slides.length;
		var _timer;
		if(!_slideCount) return;
		_slides.hide().eq(_currentIndex).show();
		if(_autoRotation) _this.removeClass(_pausedClass).addClass(_playClass);
		else _this.removeClass(_playClass).addClass(_pausedClass);

		if(_btnPrev.length) {
			_btnPrev.bind(_controlEvent,function(){
				if (_phase) {
					prevSlide();
				}
				return false;
			});
		}
		if(_btnNext.length) {
			_btnNext.bind(_controlEvent,function(){
				if (_phase) {
					nextSlide();
				}
				return false;
			});
		}
		if(_pagerLinks.length) {
			_pagerLinks.each(function(_ind){
				jQuery(this).bind(_controlEvent,function(){
					if(_currentIndex != _ind) {
						_prevIndex = _currentIndex;
						_currentIndex = _ind;
						_phase = true;
						switchSlide();
					}
					return false;
				});
			});
		}

		if(_btnPlayPause.length) {
			_btnPlayPause.bind(_controlEvent,function(){
				if(_this.hasClass(_pausedClass)) {
					_this.removeClass(_pausedClass).addClass(_playClass);
					_autoRotation = true;
					autoSlide();
				} else {
					if(_timer) clearTimeout(_timer);
					_this.removeClass(_playClass).addClass(_pausedClass);
				}
				return false;
			});
		}

		function prevSlide() {
			_prevIndex = _currentIndex;
			if(_currentIndex > 0) _currentIndex--;
			else _currentIndex = _slideCount-1;
			switchSlide();
		}
		function nextSlide() {
			_prevIndex = _currentIndex;
			if(_currentIndex < _slideCount-1) _currentIndex++;
			else _currentIndex = 0;
			switchSlide();
		}
		function refreshStatus() {
			if(_pagerLinks.length) _pagerLinks.removeClass(_activeClass).eq(_currentIndex).addClass(_activeClass);
			_slides.eq(_prevIndex).removeClass(_activeClass);
			_slides.eq(_currentIndex).addClass(_activeClass);
			_number.text('Р¤РѕС‚РѕРіСЂР°С„РёСЏ '+(_currentIndex+1)+' РёР· '+_slideCount);


		}
		function switchSlide() {
			if (_phase) {
				_phase = false;
				_slides.eq(_prevIndex).fadeOut(_duration);
				_slides.eq(_currentIndex).fadeIn(_duration, function(){
					_phase = true;
				});
				refreshStatus();
			}
			autoSlide();
		}

		function autoSlide() {
			if(!_autoRotation || _hover) return;
			if(_timer) clearTimeout(_timer);
			_timer = setTimeout(nextSlide,_switchTime+_duration);
		}
		if(_pauseOnHover) {
			_this.hover(function(){
				_hover = true;
				if(_timer) clearTimeout(_timer);
			},function(){
				_hover = false;
				autoSlide();
			});
		}
		refreshStatus();
		autoSlide();
	});
}
jQuery.fn.galleryScroll = function(_options){
	// defaults options	
	var _options = jQuery.extend({
		btPrev: 'a.prev',
		btNext: 'a.next',
		holderList: 'div.scroll-holder, div.scroll-holder1',
		scrollElParent: 'ul',
		scrollEl: 'li',
		slideNum: false,
		duration : 1000,
		step: false,
		circleSlide: false,
		disableClass: 'disable',
		funcOnclick: null,
		autoSlide:false,
		innerMargin:0,
		stepWidth:false
	},_options);

	return this.each(function(){
		var _this = jQuery(this);

		var _holderBlock = jQuery(_options.holderList,_this);
		var _liPading = _holderBlock.find('ul li').outerWidth()-_holderBlock.find('ul li').width();
		var _gWidth = _holderBlock.width();
		var _animatedBlock = jQuery(_options.scrollElParent,_holderBlock);
		var _liWidth = jQuery(_options.scrollEl,_animatedBlock).outerWidth(true);
		var _liSum = jQuery(_options.scrollEl,_animatedBlock).length * _liWidth - _liPading;
		var _margin = -_options.innerMargin;
		var f = 0;
		var _step = 0;
		var _autoSlide = _options.autoSlide;
		var _timerSlide = null;
		if (!_options.step) _step = _gWidth; else _step = _options.step*_liWidth;
		if (_options.stepWidth) _step = _options.stepWidth;
		
		if (!_options.circleSlide) {
			if (_options.innerMargin == _margin)
				jQuery(_options.btPrev,_this).addClass('prev-'+_options.disableClass);
		}
		if (_options.slideNum && !_options.step) {
			var _lastSection = 0;
			var _sectionWidth = 0;
			while(_sectionWidth < _liSum)
			{
				_sectionWidth = _sectionWidth + _gWidth;
				if(_sectionWidth > _liSum) {
				       _lastSection = _sectionWidth - _liSum;
				}
			}
		}
		if (_autoSlide) {
				_timerSlide = setTimeout(function(){
					autoSlide(_autoSlide);
				}, _autoSlide);
			_animatedBlock.hover(function(){
				clearTimeout(_timerSlide);
			}, function(){
				_timerSlide = setTimeout(function(){
					autoSlide(_autoSlide)
				}, _autoSlide);
			});
		}
	
		// click button 'Next'
		jQuery(_options.btNext,_this).bind('click',function(){
			jQuery(_options.btPrev,_this).removeClass('prev-'+_options.disableClass);
			if (!_options.circleSlide) {
				if (_margin + _step  > _liSum - _gWidth - _options.innerMargin) {
					if (_margin != _liSum - _gWidth - _options.innerMargin) {
						_margin = _liSum - _gWidth  + _options.innerMargin;
						jQuery(_options.btNext,_this).addClass('next-'+_options.disableClass);
						_f2 = 0;
					} 
				} else {
					_margin = _margin + _step;
					if (_margin == _liSum - _gWidth - _options.innerMargin) {
						jQuery(_options.btNext,_this).addClass('next-'+_options.disableClass);_f2 = 0;
					} 					
				}
			} else {
				if (_margin + _step  > _liSum - _gWidth + _options.innerMargin) {
					if (_margin != _liSum - _gWidth + _options.innerMargin) {
						_margin = _liSum - _gWidth  + _options.innerMargin;
					} else {
						_f2 = 1;
						_margin = -_options.innerMargin;
					}
				} else {
					_margin = _margin + _step;
					_f2 = 0;
				}
			} 
			
			_animatedBlock.animate({marginLeft: -_margin+"px"}, {queue:false,duration: _options.duration });
			
			if (_timerSlide) {
				clearTimeout(_timerSlide);
				_timerSlide = setTimeout(function(){
					autoSlide(_options.autoSlide)
				}, _options.autoSlide);
			}
			
			if (_options.slideNum && !_options.step) jQuery.fn.galleryScroll.numListActive(_margin,jQuery(_options.slideNum, _this),_gWidth,_lastSection);		
			if (jQuery.isFunction(_options.funcOnclick)) {
				_options.funcOnclick.apply(_this);
			}
			return false;
		});
		// click button 'Prev'
		var _f2 = 1;
		jQuery(_options.btPrev, _this).bind('click',function(){
			jQuery(_options.btNext,_this).removeClass('next-'+_options.disableClass);
			if (_margin - _step >= -_step - _options.innerMargin && _margin - _step <= -_options.innerMargin) {
				if (_f2 != 1) {
					_margin = -_options.innerMargin;
					_f2 = 1;
				} else {
					if (_options.circleSlide) {
						_margin = _liSum - _gWidth  + _options.innerMargin;
						f=1;_f2=0;
					} else {
						_margin = -_options.innerMargin
					}
				}
			} else if (_margin - _step < -_step + _options.innerMargin) {
				_margin = _margin - _step;
				f=0;
			}
			else {_margin = _margin - _step;f=0;};
			
			if (!_options.circleSlide && _margin == _options.innerMargin) {
				jQuery(this).addClass('prev-'+_options.disableClass);
				_f2=0;
			}
			
			if (!_options.circleSlide && _margin == -_options.innerMargin) jQuery(this).addClass('prev-'+_options.disableClass);
			_animatedBlock.animate({marginLeft: -_margin + "px"}, {queue:false, duration: _options.duration});
			
			if (_options.slideNum && !_options.step) jQuery.fn.galleryScroll.numListActive(_margin,jQuery(_options.slideNum, _this),_gWidth,_lastSection);
			
			if (_timerSlide) {
				clearTimeout(_timerSlide);
				_timerSlide = setTimeout(function(){
					autoSlide(_options.autoSlide)
				}, _options.autoSlide);
			}
			
			if (jQuery.isFunction(_options.funcOnclick)) {
				_options.funcOnclick.apply(_this);
			}
			return false;
		});
		
		if (_liSum <= _gWidth) {
			jQuery(_options.btPrev,_this).addClass('prev-'+_options.disableClass).unbind('click');
			jQuery(_options.btNext,_this).addClass('next-'+_options.disableClass).unbind('click');
		}
		// auto slide
		function autoSlide(autoSlideDuration){
			//if (_options.circleSlide) {
				jQuery(_options.btNext,_this).trigger('click');
			//}
		};
		// Number list
		jQuery.fn.galleryScroll.numListCreate = function(_elNumList, _liSumWidth, _width, _section){
			var _numListElC = '';
			var _num = 1;
			var _difference = _liSumWidth + _section;
			while(_difference > 0)
			{
				_numListElC += '<li><a href="">'+_num+'</a></li>';
				_num++;
				_difference = _difference - _width;
			}
			jQuery(_elNumList).html('<ul>'+_numListElC+'</ul>');
		};
		jQuery.fn.galleryScroll.numListActive = function(_marginEl, _slideNum, _width, _section){
			if (_slideNum) {
				jQuery('a',_slideNum).removeClass('active');
				var _activeRange = _width - _section-1;
				var _n = 0;
				if (_marginEl != 0) {
					while (_marginEl > _activeRange) {
						_activeRange = (_n * _width) -_section-1 + _options.innerMargin;
						_n++;
					}
				}
				var _a  = (_activeRange+_section+1 + _options.innerMargin)/_width - 1;
				jQuery('a',_slideNum).eq(_a).addClass('active');
			}
		};
		if (_options.slideNum && !_options.step) {
			jQuery.fn.galleryScroll.numListCreate(jQuery(_options.slideNum, _this), _liSum, _gWidth,_lastSection);
			jQuery.fn.galleryScroll.numListActive(_margin, jQuery(_options.slideNum, _this),_gWidth,_lastSection);
			numClick();
		};
		function numClick() {
			jQuery(_options.slideNum, _this).find('a').click(function(){
				jQuery(_options.btPrev,_this).removeClass('prev-'+_options.disableClass);
				jQuery(_options.btNext,_this).removeClass('next-'+_options.disableClass);
				
				var _indexNum = jQuery(_options.slideNum, _this).find('a').index(jQuery(this));
				_margin = (_step*_indexNum) - _options.innerMargin;
				f=0; _f2=0;
				if (_indexNum == 0) _f2=1;
				if (_margin + _step > _liSum) {
					_margin = _margin - (_margin - _liSum) - _step + _options.innerMargin;
					if (!_options.circleSlide) jQuery(_options.btNext, _this).addClass('next-'+_options.disableClass);
				}
				_animatedBlock.animate({marginLeft: -_margin + "px"}, {queue:false, duration: _options.duration});
				
				if (!_options.circleSlide && _margin==0) jQuery(_options.btPrev,_this).addClass('prev-'+_options.disableClass);
				jQuery.fn.galleryScroll.numListActive(_margin, jQuery(_options.slideNum, _this),_gWidth,_lastSection);
				
				if (_timerSlide) {
					clearTimeout(_timerSlide);
					_timerSlide = setTimeout(function(){
						autoSlide(_options.autoSlide)
					}, _options.autoSlide);
				}
				return false;
			});
		};
		jQuery(window).resize(function(){
			_gWidth = _holderBlock.width();
			_liWidth = jQuery(_options.scrollEl,_animatedBlock).outerWidth(true);
			_liSum = jQuery(_options.scrollEl,_animatedBlock).length * _liWidth;
			if (!_options.step) _step = _gWidth; else _step = _options.step*_liWidth;
			if (_options.slideNum && !_options.step) {
				var _lastSection = 0;
				var _sectionWidth = 0;
				while(_sectionWidth < _liSum)
				{
					_sectionWidth = _sectionWidth + _gWidth;
					if(_sectionWidth > _liSum) {
					       _lastSection = _sectionWidth - _liSum;
					}
				};
				jQuery.fn.galleryScroll.numListCreate(jQuery(_options.slideNum, _this), _liSum, _gWidth,_lastSection);
				jQuery.fn.galleryScroll.numListActive(_margin, jQuery(_options.slideNum, _this),_gWidth,_lastSection);
				numClick();
			};
			//if (_margin == _options.innerMargin) jQuery(this).addClass(_options.disableClass);
			if (_liSum - _gWidth  < _margin - _options.innerMargin) {
				if (!_options.circleSlide) jQuery(_options.btNext, _this).addClass('next-'+_options.disableClass);
				_animatedBlock.animate({marginLeft: -(_liSum - _gWidth + _options.innerMargin)}, {queue:false, duration: _options.duration});
			};
		});
	});
}

function initTabs () {
	$('.production').makeTabset({
		tab : '.content',
		control : '.menu',
		parent : '.production'
	});
}
jQuery.fn.makeTabset = function(o) {
	o = $.extend( {
		speed : 300, /* РЎРѓР С”Р С•РЎР‚Р С•РЎРѓРЎвЂљРЎРЉ Р С—Р ВµРЎР‚Р ВµР СР ВµРЎвЂ°Р ВµР Р…Р С‘РЎРЏ 1000 = 1РЎРѓР ВµР С”РЎС“Р Р…Р Т‘Р В° */
		gallery_height : '.image-holder',
		gallery_frame : '.image-list',
		gallery_holder : 'ul',
		gallery_item : 'li'
	}, o || {});
	var steps = 1;
	return this.each(function(){
				phase = 0;
				main_holder = $(this);
				var Fheight = main_holder.find(o.gallery_item+':not(.more_score_info li)').size()*(main_holder.find(o.gallery_item+':first').height()+10);
				var step = ($(this).find(o.gallery_item+':first').height()+10) * steps;
				main_holder.find('.up').bind('click',function(){
					if (((parseInt($(this).parents(o.gallery_frame).find(o.gallery_holder).css('margin-top'))+step) <= 0) && (phase != 1) ) {
						$(this).parents(o.gallery_frame).find('.down').removeClass('down-disable');
						phase = 1;
						$(this).parents(o.gallery_frame).find(o.gallery_holder).animate({marginTop: (parseInt($(this).parents(o.gallery_frame).find(o.gallery_holder).css('margin-top'))+step)}, o.speed, function(){
							phase = 0;
						});
					}
					if (((parseInt($(this).parents(o.gallery_frame).find(o.gallery_holder).css('margin-top'))+step) == 0)) {
						$(this).addClass('up-disable');
					}
					return false;
				});
				main_holder.find('.down').bind('click',function(){
					if ((((-1) * (parseInt($(this).parents(o.gallery_frame).find(o.gallery_holder).css('margin-top')) - step) + parseInt($(this).parents(o.gallery_frame).find(o.gallery_height).height())) <= Fheight) && (phase != 1)) {
						$(this).parents(o.gallery_frame).find('.up').removeClass('up-disable');
						phase = 1;
						$(this).parents(o.gallery_frame).find(o.gallery_holder).animate({
							marginTop: (parseInt($(this).parents(o.gallery_frame).find(o.gallery_holder).css('margin-top')) - step)
						}, o.speed, function(){
							phase = 0;
							if ((((-1)*(parseInt($(this).parents(o.gallery_frame).find(o.gallery_holder).css('margin-top'))-step)+parseInt($(this).parents(o.gallery_frame).find(o.gallery_height).height())) >= Fheight)) {
								main_holder.find('.down').addClass('down-disable');
							}
						});
					}
					return false;
				});
			});
};
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