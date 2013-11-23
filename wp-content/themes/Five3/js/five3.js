/* ----------------------------------
 *
 * five3.me
 *
 * ---------------------------------- */

jQuery('html').toggleClass('hasjs');

(function($) {
	var lastScrollTop = 0,
		$contentContainers,
		isiPad = navigator.userAgent.match(/(iPad)|(iPhone)|(iPod)/i);

	$(document).ready(function($){
		$.updatePageNav();

		$contentContainers = $('#wrapper .content-container');

		$contentContainers.each(function(){
			$(this).loadElements();
		});

		// Parallax
		if(!isiPad) {
			$contentContainers.each(function(){
				$(this).parallax();
			});

			$(window).bind('scroll',function(e){
				$contentContainers.each(function(){
					if($(this).isInViewport()) {
						$(this).parallax();
					}
				});
			});

			$(window).bind('scroll',$.throttle(300,function(){
				$.updatePageNav();
			}));
		}

		// Smooth scroll for intrapage links
		$('nav#page a, a[href*=#]').smoothScroll({
			easing: 'swing',
			excludeWithin: ['.slidedeck-frame'],
			speed: 1600,
			afterScroll: function(){ // Set URL to current page
				if($(this.hash).length > 0) {
					var History = window.History,
						href = $(this).attr('href');
					if(History.enabled && !$.browser.msie) {
						History.pushState({href:1}, href, href);
					}
				} else {
					window.location.href = $(this).attr('href');
				}
			}
		});

		// Make Video in iframe etc responsive
		$('iframe, embed, object').not('.unresponsive').each(function(){
			$(this).removeAttr('width');
			$(this).removeAttr('height');
			$(this).wrap('<div class="responsive" />')
		});

		// Load Theme Designer
		$('#wp-admin-bar-five3-designer').one('click', function(){
			$.getScript(five3.templateUri+'js/theme-designer.js',function(){
				$('#wp-admin-bar-five3-designer').addClass('loaded');
				return $.toggleDesigner();
			});
			return false;
		});

		// Toggle Theme Designer after first load
		$('#wp-admin-bar-five3-designer.loaded, #theme-designer h2 span').live('click',function(){
			return $.toggleDesigner();
		});

		// iPad fallback
		if(isiPad) {
			$(window).bind('load orientationchange',function(e){
				var ipad_bg_pos_x = '50%',
					ipad_bg_pos_y = $('#branding').outerHeight(true);

				$contentContainers.each(function(index){
					var $contentContainer = $(this),
						$overlayContainer = $('.overlay',$contentContainer),
						article_height = $contentContainer.outerHeight(true) + $('#branding').outerHeight(true);

					// Account for border image not taken into account by jQuery.outerHeight()
					if($('#branding').hasClass('shadow-container'))
						ipad_bg_pos_y = ipad_bg_pos_y - 10;

					if($contentContainer.css('backgroundImage') != undefined && $contentContainer.css('backgroundImage') != 'none') {
						$contentContainer.css({
									'backgroundPosition': ipad_bg_pos_x + ' ' + ipad_bg_pos_y + 'px',
									'-webkit-background-size': 'auto ' + article_height + 'px'
									});
					}

					if($overlayContainer.css('backgroundImage') != undefined && $overlayContainer.css('backgroundImage') != 'none') {
						$('.overlay',this).css({'backgroundPosition': ipad_bg_pos_x + ' ' + ipad_bg_pos_y + 'px',
											'-webkit-background-size': 'auto ' + article_height + 'px',
											'opacity':1
											});
					}

					$contentContainer.css({'opacity':1});

					if(ipad_bg_pos_y == $('#branding').outerHeight(true))
						ipad_bg_pos_y = $contentContainer.outerHeight(true);
					else
						ipad_bg_pos_y += $contentContainer.outerHeight(true);
				});
			});
		}
	});

	$.fn.extend({
		loadElements: function(){
			var $element = $(this);

			if($element.css('opacity')==0){
				var newTop = $element.height() / 5 * 4; // Position the loader just below the top of the parent element;
				$element.next('.preloader').css({top: -newTop+'px'});
			}

			// If no image, load immediately
			if($element.css('backgroundImage') == undefined || $element.css('backgroundImage') == 'none') {
				$element.next('.preloader').addClass('loaded').fadeOut(400);
				$element.animate({opacity:1},400);
			} else { 
				// Otherwise, wait until background images are loaded
				var backgroundImage = new Image();

				$(backgroundImage).one('load',function() {
					$element.next('.preloader').addClass('loaded').fadeOut(400,function(){
						$element.animate({opacity:1},400);
					});
				});

				backgroundImage.src = $element.css('backgroundImage').replace(/(url\(|\)|'|")/gi,'');

				// Make sure if fires in case it was cached
				if(backgroundImage.complete) {
					$(backgroundImage).load();
				}

				backgroundImage = null;
			}
		},
		parallax: function(){ // Apply the parallax effect to a given element
			// Scroll the Background
			if($(this).css('backgroundImage') != undefined && $(this).css('backgroundImage') != 'none'){
				var bg_pos = '50% ' + (-($(window).scrollTop() - $(this).offset().top) * 0.15) + 'px';
				$(this).css({'backgroundPosition':bg_pos});
			}
			// Scroll the Overlay
			if($('.overlay',$(this)).css('backgroundImage') != undefined && $('.overlay',$(this)).css('backgroundImage') != 'none'){
				var overlay_pos = '50% ' + (($(window).height()/2-($(window).height() + $(window).scrollTop() - $(this).offset().top)/3) - 120) + 'px';
				$('.overlay',$(this)).css('backgroundPosition',overlay_pos);
			}
		},
		isInViewport: function(){
			if($(window).scrollTop() >= ($(this).offset().top + $(this).height())) // Above the Top of the Viewport?
				return false;
			else if($(window).height() + $(window).scrollTop() <= $(this).offset().top)	// Below the fold?
				return false;
			else
				return true;
		}
	});

	$.extend({
		updatePageNav: function(){ // Set the current page nav element to be highlighted
			$('nav#page li a').each(function(index,element){
				var $contentElement = $($(this).attr('href')),
					contentTop = $contentElement.offset().top,
					contentBottom = $contentElement.offset().top + $contentElement.height();

				if(lastScrollTop < $(window).scrollTop()) {// Scrolling down
					linkTop = $(this).offset().top + (2 * $(this).height());
				} else {
					linkTop = $(this).offset().top;
				}

				if(linkTop >= contentTop && linkTop < contentBottom){
					lastScrollTop = $(window).scrollTop();
					$('.in-viewport').removeClass('in-viewport');
					var linkName = $(this).attr('href').substring(1)+'-link';
					$('.'+linkName).addClass('in-viewport');
					return false;
				}

				// If we made it to hear, no nav menus are in the viewport
				$('.in-viewport').removeClass('in-viewport');
			});
		},
		toggleDesigner: function(){ // Displays the front end designer
			if($('#wp-admin-bar-five3-designer').hasClass('selected')){
				$('#wp-admin-bar-five3-designer').removeClass('selected');
				$('#theme-designer').fadeOut(200);
			} else {
				$('#wp-admin-bar-five3-designer').addClass('selected');
				$('#theme-designer').fadeIn(200);
			}
			return false;
		}
	});
})(jQuery);
