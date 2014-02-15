jQuery(function($) {

jQuery.noConflict();
jQuery(document).ready(function($){


  /********** jquery prettyphoto **********/
  $("a[class^='prettyPhoto']").prettyPhoto({
      animationSpeed:'slow',
      theme:'facebook', 
      hideflash: true,
      wmode: 'opaque', 
      slideshow:2000,
      social_tools:false,
  });


  /********** jquery dropdown menu **********/
	$('ul.sf-menu').superfish({
		autoArrows:  false
	});

	/********** jquery responsive dropdown menu **********/
    $("<select />").appendTo("nav");
      $("<option />", {
         "selected": "selected",
         "value"   : "",
         "text"    : "Select Page..."
      }).appendTo("nav select");
      var indent = '';
      $("nav a").each(function() {
       var el = $(this);
       if(el.closest('ul.sub-menu').length >0) { indent = ' - ' ;} else { indent = ''}
       $("<option />", {
           "value"   : el.attr("href"),
           "text"    : indent + el.text()
       }).appendTo("nav select");
      });
      $("nav select").change(function() {
        window.location = $(this).find("option:selected").val();
  });


 

  $('.map-toggle').click( function(event) {
    $(this).toggleClass('collapsed');
    $(this).find('span.show, span.hide').toggle();
    $('#map').slideToggle();
    event.preventDefault();

  });


  /********** adjust the header image height on homepage **********/
  resizeHeaderImage();

  $(window).bind("resize", resizeHeaderImage);
  function resizeHeaderImage( e ) {
    elem = $('.home .header-wrapper');
    if(elem.outerHeight() < $(window).height()) {
       elem.css({height:$(window).height()});
    } 
  }



  



});//document.ready



});