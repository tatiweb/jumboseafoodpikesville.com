jQuery(document).ready(function($){

	/* ---------------------------------- */
	/* Maybe Show Image Options */
	if ($('#overlay-options').is(":hidden") && $('#_f3_overlay').val() != -1 )
		$('#overlay-options').slideDown();

	if ($('#background-options').is(":hidden") && $('#_f3_background').val() != -1 )
		$('#background-options').slideDown();

	/* ---------------------------------- */
	/* Set Image Background */
	$('.five3-images .media-item a').click(function(e){
		var context, parent_id,attachment_id;

		context       = $(this).attr('class');
		parent_id     = $(this).parent().attr('id').split('-');
		attachment_id = parent_id[2];

		$.post( five3.ajaxurl, {
					action		  : 'f3-set-background',
				 	_ajax_nonce	  : five3.nonce,
				 	post_id		  : five3.post_id,
					context		  : context,
					attachment_id : attachment_id
				}, function(response) {
					if($('.updated.fade').is('*') && response.message.length > 0){
						$('.updated.fade').fadeOut(400, function(){
							$(this).text(response.message).fadeIn();
						});
					} else {
						$('<div class="updated fade" style="padding: 5px;text-align:center;">'+response.message+'</div>').hide().prependTo('#library-form').slideDown();
					}

					if(response.success == true){
						// Show hidden link for same position
						$('a.'+context+':hidden').fadeIn();

						if( context == 'background' )
							$( 'a.overlay' ).css('margin', '5px 10px');

						// Hide clicked link
						$( '#media-item-'+attachment_id+' a.'+context ).fadeOut(400, function(){
							if( context == 'background' ){
								$( '#media-item-'+attachment_id+' a.overlay' ).css('marginRight','99px');
							}
						});

						var metabox = '#five3_'+context+' .inside';
						// Insert image sample into page
						if($(metabox+' img', window.parent.document).length > 0){
							$(metabox+' img', window.parent.document).fadeOut('400',function(){
								$(this).remove(); // remove old image
								$(metabox, window.parent.document).hide().prepend(response.img_src).fadeIn(); // insert new img preview
							});
						} else {
							$(metabox, window.parent.document).hide().prepend(response.img_src).fadeIn(); // insert new img preview
						}
						$(metabox+' a#remove-'+context, window.parent.document).fadeIn();
						$(metabox+' input', window.parent.document).val(attachment_id);

						// Display Image Options
						if ($('#'+context+'-options', window.parent.document).is(":hidden")) {
							$('#'+context+'-options', window.parent.document).slideDown();
						}
					}
		});

		return false;
	});


	/* ---------------------------------- */
	/* Remove Image */

	$('#remove-background').click(function(){
		removeImage('background');
		if ($('#background-options').is(":visible"))
			$('#background-options').slideUp();
		return false;
	});

	$('#remove-overlay').click(function(){
		removeImage('overlay');
		if ($('#overlay-options').is(":visible"))
			$('#overlay-options').slideUp();
		return false;
	});

	function removeImage(context){
		$('#five3_'+context+' .inside img').fadeOut('400',function(){
			$(this).remove();
		});
		$('#five3_'+context+' .inside a#remove-'+context).fadeOut('400');
		$.post( five3.ajaxurl, 
				{action			  : 'f3-set-background',
				 _ajax_nonce	  : five3.nonce,
				 post_id		  : five3.post_id,
				 context		  : context,
				 attachment_id : -1 }, 
				function(response) {
					$('input[name="_f3_'+context+'"]').val("-1");
				});
	}
});

