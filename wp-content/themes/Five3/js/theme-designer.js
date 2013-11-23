/* ----------------------------------
 *
 * five3.me Theme Designer
 *
 * ---------------------------------- */

jQuery(function($) {
	// Get the jQuery UI Scripts
	$.getScript(five3.templateUri+'js/jquery-ui.js', function() {
		// And now the Farbtastic Script
		$.getScript(five3.adminUri+'js/farbtastic.js', function() {

			// Init the accordion
			$('.accordion-toggle').click(function(){
				$(this).toggleClass('open-accordion');
			    $(this).next().slideToggle();
			}).next().hide();

			// Get all Google Fonts
			if(document.createStyleSheet) {
			    document.createStyleSheet(five3.googleFontsUri);
			} else {
				$('<link />', {
					href: five3.googleFontsUri,
					rel: 'stylesheet',
					type: 'text/css',
					'class': 'dynamic_css'
				}).appendTo('head');
			}

			// Get the Farbtastic stylesheet
			if(document.createStyleSheet) {
			    document.createStyleSheet(five3.adminUri+'css/farbtastic.css');
			} else {
				$('<link />', {
					href: five3.adminUri+'css/farbtastic.css',
					type: 'text/css',
					rel: 'stylesheet',
					'class': 'dynamic_css'
				}).appendTo('head');
			}

			// Make theme designer draggable & resizable
			$('#theme-designer').draggable({handle:'h2'});
			$('#theme-designer').resizable({
									alsoResize:'#five3-settings-form, .selectBox, .accordion-pane', 
									minWidth:210, 
									minHeight:300
								});

			// Create a CSS stylable Select Box
			$('#five3-fonts').selectBox();
			$('.selectBox-options li a').each(function(){
				$(this).css('font-family','"'+$(this).attr('rel')+'"'); // Need to quote the font family as jQuery's .css function borks on fonts with > 2 words in name
			});

			// Init Farbtastic for multiple color pickers
			$('.five3-color-picker').each(function(){$(this).hide()});
			$('.five3-color-picker').each(function(){
				var picker_id = $(this).attr('id');
				var input_id = '#f3_color_' + picker_id.substring(0,picker_id.indexOf("-"));
				$(this).farbtastic(input_id)
			});
			$('.five3-color-input').each(function(){
				$(this).css('color',getContrast($(this).val()))
			});
			$('.five3-color-pick').click(function(){
			    $(this).parent().next().slideToggle();
				$(this).toggleClass('up down');
				return false;
			});
			$('.five3-color-picker').hover(function(){
				$('.five3-color-input',$(this).prev()).setCursorPosition(7);
			});

			// Process Theme Designer Changes
			$('#five3-settings-form').change(five3Update);
			$('#five3-settings-form input :text').change(five3Update);
			$('.five3-color-picker').bind('mouseup', five3Update);

			$.fn.setCursorPosition = function(pos) {
				this.each(function(index, elem) {
					if (elem.setSelectionRange) {
						elem.setSelectionRange(pos, pos);
					} else if (elem.createTextRange) {
						var range = elem.createTextRange();
						range.collapse(true);
						range.moveEnd('character', pos);
						range.moveStart('character', pos);
						range.select();
					}
				});
				return this;
			};
		});
	});

	function five3Update(){
		saveSettings();
		updateStyles();
	}

	function saveSettings(){
		$('#theme-designer h2 span').fadeOut('fast',function(){
			$(this).html('Saving').css('background-color', '#089400').fadeIn('fast',function(){
				$.post(
					five3.adminAjaxUri, 
					$('#five3-settings-form').serialize()+'&f3_headline_typeface='+$('.selectBox-selected a').attr('rel'),
					function(response) {
						$('#theme-designer h2 span').fadeOut('fast',function(){
							if(response.success == true)
								$('#theme-designer h2 span').html('x');
							else
								$('#saving').html('Error');
							$(this).css('backgroundColor', '#CC0000').fadeIn('fast');
						});
					}
				);
			});
		});
		return false;
	}

	function updateStyles(){
		var headingColor = $('#five3-settings-form [id=f3_color_heading]').val(),
			anchorColor = $('#five3-settings-form [id=f3_color_link]').val(),
			menuColor = $('#five3-settings-form [id=f3_color_menu]').val(),
			five3Font  = $('.selectBox-selected a').attr('rel');

		// Update Headline colors & typefaces
		$('a').not('#wpadminbar a, #five3-font-selector a, .five3-color-pick, #footer a, nav#page a, h1 a, h2 a, h3 a, h4 a, h5 a').fadeOut('fast',function(){
			$(this).css('color', anchorColor).fadeIn('fast');
		});
		$('h1, h2, h3, h4, h5, h6').not('#theme-designer h2, #theme-designer h3, #theme-designer h4').fadeOut('fast', function(){
			$(this).css({ 
				'color': headingColor,
				'font-family': '"'+five3Font+'"'
			}).fadeIn('fast');
		});
		$('#branding h1 a, .entry-title a, .entry-title, .five3-font, #reply-title, .widgettitle').fadeOut('fast', function(){
			$(this).css({ 
				'color': headingColor,
				'font-family': '"'+five3Font+'"' // Need to quote the font family as jQuery's .css function borks on fonts with > 2 words in name
			}).fadeIn('fast');
		});
		$('nav#page > a:hover, nav#page li:hover > a, nav#page h6').css('background-color', menuColor);
		$('nav#page h6:before').css('border-color', 'transparent ' + menuColor );
		$('.five3-color-input').each(function(){$(this).css('color',getContrast($(this).val()))});

		// Shadows
		if($('#f3_show_shadows').is(':checked')) {
			$('#branding').addClass('shadow-container','normal');
			$('.overlay').addClass('shadow-container','normal');
			$('.content:not(:has(.overlay))').addClass('shadow-container','normal');
		} else {
			$('#branding').removeClass('shadow-container','normal');
			$('.overlay').removeClass('shadow-container','normal');
			$('.content:not(:has(.overlay))').removeClass('shadow-container','normal');
		}

		// Fixed Postion Header
		if($('#f3_fix_header').is(':checked')) {
			$('body').addClass('fixed','normal');
		} else {
			$('body').removeClass('fixed','normal');
		}

		// Show/hide Page Nav
		if($('#f3_vertical_nav').is(':checked')) {
			$('nav#page').fadeIn();
		} else {
			$('nav#page').fadeOut();
		}

		// Copyright & Generator
		if($.trim($('#site-copyright').html()) != $('#f3_site_copyright').val()) {
			$('#site-copyright').html($('#f3_site_copyright').val());
		}
		if($.trim($('#site-generator').html()) != $('#f3_site_generator').val()) {
			$('#site-generator').html($('#f3_site_generator').val());
		}

		return false;
	}

	function getContrast(hexcolor){
		var r = parseInt(hexcolor.substr(1,2),16);
		var g = parseInt(hexcolor.substr(3,2),16);
		var b = parseInt(hexcolor.substr(5,2),16);
		var yiq = ((r*299)+(g*587)+(b*114))/1000;
		return (yiq >= 128) ? '#000000' : '#FFFFFF';
	}

});

/* ---------------------------------- */
