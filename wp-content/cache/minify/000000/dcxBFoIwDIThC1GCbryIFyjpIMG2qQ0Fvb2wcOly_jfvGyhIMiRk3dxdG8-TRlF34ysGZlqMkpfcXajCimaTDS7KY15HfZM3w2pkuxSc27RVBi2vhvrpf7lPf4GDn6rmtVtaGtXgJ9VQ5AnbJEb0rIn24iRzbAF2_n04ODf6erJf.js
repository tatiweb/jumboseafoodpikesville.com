jQuery(document).ready(function($){var TouchfolioManager=(function(){var body=$('body'),jqWindow=$(window),isGalleryPage,nW,nH,browserWidth=jqWindow.width(),browserHeight,mobileMenu,isLowIE=($.browser.msie&&parseInt($.browser.version,10)<=8),maxW=850,_headerSideMenu=$('.main-header'),socialMenu=_headerSideMenu.find('.social-menu'),_menusContainer=_headerSideMenu.find('.menus-container'),_sidebar=$("#secondary"),isCollapsed=false,isMenuAnimating=false;init=function(){if(body.hasClass('ds-gallery-page')){isGalleryPage=true;$('.footer-copy').css('display','none');$('.slider-data').css('display','none');}
if(browserWidth>=maxW){_sidebar.appendTo(_headerSideMenu);}
if(!isLowIE){onResize();}
if(isGalleryPage){$("#main-slider").eq(0).twoDimSlider({appendGalleriesToMenu:true});}
if(!isLowIE){jqWindow.bind('resize',function(e){onResize(e);});}
if(browserWidth<maxW){displayMobileMenu();}
if(body.hasClass('page-template-ds-gallery-masonry-template-php')){$('.albums-thumbnails').masonry({itemSelector:'.project-thumb',gutterWidth:8,isResizable:true,isFitWidth:true,isAnimated:false});}},displayMobileMenu=function(){if(mobileMenu){mobileMenu.css('display','block').removeClass('menu-close-button');_menusContainer.hide().css({height:0});return;}
var headerHeight=_headerSideMenu.height();mobileMenu=$('<a class="menu-button"><i class="menu-button-icon"></i>menu</a>');$('.top-logo-group').after(mobileMenu);setTimeout(function(){var height=_menusContainer.height();_menusContainer.hide().css({height:0,top:_headerSideMenu.height()});mobileMenu.bind('click.mobilemenu',function(e){e.preventDefault();if(isMenuAnimating){return false;}
mobileMenu.toggleClass('menu-close-button');if(_menusContainer.is(':visible')){_menusContainer.animate({height:0},{duration:300,complete:function(){_menusContainer.hide();}});}else{_menusContainer.show().animate({height:height},{duration:300});}
isMenuAnimating=false;return false;});},0);},hideMobileMenu=function(){if(mobileMenu){mobileMenu.css('display','none');_menusContainer.css({'display':'block','height':'auto'});}},onResize=function(e){nW=jqWindow.width();nH=jqWindow.height();if(nW!=browserWidth||nH!=browserHeight){browserWidth=nW;browserHeight=nH;if(browserWidth>=maxW){if(isCollapsed){hideMobileMenu();if(!isGalleryPage){body.removeClass('collapsed-layout');_headerSideMenu.removeClass('collapsed-full-width-menu');_sidebar.appendTo(_headerSideMenu);}else{body.removeClass('collapsed-gallery-page');_headerSideMenu.removeClass('collapsed-gallery-page-menu');}
_headerSideMenu.removeClass('header-opened-menu');isCollapsed=false;}}else{if(!isCollapsed){if(e){displayMobileMenu();}
if(!isGalleryPage){body.addClass('collapsed-layout');_headerSideMenu.addClass('collapsed-full-width-menu');_sidebar.appendTo($('#main'));}else{body.addClass('collapsed-gallery-page');_headerSideMenu.addClass('collapsed-gallery-page-menu');}
isCollapsed=true;}}}};return{init:init};})();TouchfolioManager.init();});jQuery.extend(jQuery.easing,{easeInSine:function(x,t,b,c,d){return-c*Math.cos(t/d*(Math.PI/2))+c+b;},easeOutSine:function(x,t,b,c,d){return c*Math.sin(t/d*(Math.PI/2))+b;},easeInOutSine:function(x,t,b,c,d){return-c/2*(Math.cos(Math.PI*t/d)-1)+b;},easeInOutQuart:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t*t+b;return-c/2*((t-=2)*t*t*t-2)+b;},easeInOutCirc:function(x,t,b,c,d){if((t/=d/2)<1)return-c/2*(Math.sqrt(1-t*t)-1)+b;return c/2*(Math.sqrt(1-(t-=2)*t)+1)+b;}});
/* A fix for the iOS orientationchange zoom bug.
 Script by @scottjehl, rebound by @wilto.
 MIT License.
*/
(function(w){if(!(/iPhone|iPad|iPod/.test(navigator.platform)&&navigator.userAgent.indexOf("AppleWebKit")>-1)){return;}
var doc=w.document;if(!doc.querySelector){return;}
var meta=doc.querySelector("meta[name=viewport]"),initialContent=meta&&meta.getAttribute("content"),disabledZoom=initialContent+",maximum-scale=1",enabledZoom=initialContent+",maximum-scale=10",enabled=true,x,y,z,aig;if(!meta){return;}
function restoreZoom(){meta.setAttribute("content",enabledZoom);enabled=true;}
function disableZoom(){meta.setAttribute("content",disabledZoom);enabled=false;}
function checkTilt(e){aig=e.accelerationIncludingGravity;x=Math.abs(aig.x);y=Math.abs(aig.y);z=Math.abs(aig.z);if(!w.orientation&&(x>7||((z>6&&y<8||z<8&&y>6)&&x>5))){if(enabled){disableZoom();}}
else if(!enabled){restoreZoom();}}
w.addEventListener("orientationchange",restoreZoom,false);w.addEventListener("devicemotion",checkTilt,false);})(this);(function($,e,b){var c="hashchange",h=document,f,g=$.event.special,i=h.documentMode,d="on"+c in e&&(i===b||i>7);function a(j){j=j||location.href;return"#"+j.replace(/^[^#]*#?(.*)$/,"$1")}$.fn[c]=function(j){return j?this.bind(c,j):this.trigger(c)};$.fn[c].delay=50;g[c]=$.extend(g[c],{setup:function(){if(d){return false}$(f.start)},teardown:function(){if(d){return false}$(f.stop)}});f=(function(){var j={},p,m=a(),k=function(q){return q},l=k,o=k;j.start=function(){p||n()};j.stop=function(){p&&clearTimeout(p);p=b};function n(){var r=a(),q=o(m);if(r!==m){l(m=r,q);$(e).trigger(c)}else{if(q!==m){location.href=location.href.replace(/#.*/,"")+q}}p=setTimeout(n,$.fn[c].delay)}$.browser.msie&&!d&&(function(){var q,r;j.start=function(){if(!q){r=$.fn[c].src;r=r&&r+a();q=$('<iframe tabindex="-1" title="empty"/>').hide().one("load",function(){r||l(a());n()}).attr("src",r||"javascript:0").insertAfter("body")[0].contentWindow;h.onpropertychange=function(){try{if(event.propertyName==="title"){q.document.title=h.title}}catch(s){}}}};j.stop=k;o=function(){return a(q.location.href)};l=function(v,s){var u=q.document,t=$.fn[c].domain;if(v!==s){u.title=h.title;u.open();t&&u.write('<script>document.domain="'+t+'"<\/script>');u.close();q.location.hash=v}}})();return j})()})(jQuery,this);;;(function(e,t,n,r){n.swipebox=function(i,s){var o={useCSS:true,hideBarsDelay:3e3,videoMaxWidth:1140,vimeoColor:"CCCCCC",beforeOpen:null,afterClose:null},u=this,a=[],i=i,f=i.selector,l=n(f),c=t.createTouch!==r||"ontouchstart"in e||"onmsgesturechange"in e||navigator.msMaxTouchPoints,h=!!e.SVGSVGElement,p=e.innerWidth?e.innerWidth:n(e).width(),d=e.innerHeight?e.innerHeight:n(e).height(),v='<div id="swipebox-overlay">    <div id="swipebox-slider"></div>    <div id="swipebox-caption"></div>    <div id="swipebox-action">     <a id="swipebox-close"></a>     <a id="swipebox-prev"></a>     <a id="swipebox-next"></a>    </div>  </div>';u.settings={};u.init=function(){u.settings=n.extend({},o,s);if(n.isArray(i)){a=i;m.target=n(e);m.init(0)}else{l.click(function(e){a=[];var t,r,i;if(!i){r="rel";i=n(this).attr(r)}if(i&&i!==""&&i!=="nofollow"){$elem=l.filter("["+r+'="'+i+'"]')}else{$elem=n(f)}$elem.each(function(){var e=null,t=null;if(n(this).attr("title"))e=n(this).attr("title");if(n(this).attr("href"))t=n(this).attr("href");a.push({href:t,title:e})});t=$elem.index(n(this));e.preventDefault();e.stopPropagation();m.target=n(e.target);m.init(t)})}};u.refresh=function(){if(!n.isArray(i)){m.destroy();$elem=n(f);m.actions()}};var m={init:function(e){if(u.settings.beforeOpen)u.settings.beforeOpen();this.target.trigger("swipebox-start");n.swipebox.isOpen=true;this.build();this.openSlide(e);this.openMedia(e);this.preloadMedia(e+1);this.preloadMedia(e-1)},build:function(){var e=this;n("body").append(v);if(e.doCssTrans()){n("#swipebox-slider").css({"-webkit-transition":"left 0.4s ease","-moz-transition":"left 0.4s ease","-o-transition":"left 0.4s ease","-khtml-transition":"left 0.4s ease",transition:"left 0.4s ease"});n("#swipebox-overlay").css({"-webkit-transition":"opacity 1s ease","-moz-transition":"opacity 1s ease","-o-transition":"opacity 1s ease","-khtml-transition":"opacity 1s ease",transition:"opacity 1s ease"});n("#swipebox-action, #swipebox-caption").css({"-webkit-transition":"0.5s","-moz-transition":"0.5s","-o-transition":"0.5s","-khtml-transition":"0.5s",transition:"0.5s"})}if(h){var t=n("#swipebox-action #swipebox-close").css("background-image");t=t.replace("png","svg");n("#swipebox-action #swipebox-prev,#swipebox-action #swipebox-next,#swipebox-action #swipebox-close").css({"background-image":t})}n.each(a,function(){n("#swipebox-slider").append('<div class="slide"></div>')});e.setDim();e.actions();e.keyboard();e.gesture();e.animBars();e.resize()},setDim:function(){var t,r,i={};if("onorientationchange"in e){e.addEventListener("orientationchange",function(){if(e.orientation==0){t=p;r=d}else if(e.orientation==90||e.orientation==-90){t=d;r=p}},false)}else{t=e.innerWidth?e.innerWidth:n(e).width();r=e.innerHeight?e.innerHeight:n(e).height()}i={width:t,height:r};n("#swipebox-overlay").css(i)},resize:function(){var t=this;n(e).resize(function(){t.setDim()}).resize()},supportTransition:function(){var e="transition WebkitTransition MozTransition OTransition msTransition KhtmlTransition".split(" ");for(var n=0;n<e.length;n++){if(t.createElement("div").style[e[n]]!==r){return e[n]}}return false},doCssTrans:function(){if(u.settings.useCSS&&this.supportTransition()){return true}},gesture:function(){if(c){var e=this,t=null,r=10,i={},s={};var o=n("#swipebox-caption, #swipebox-action");o.addClass("visible-bars");e.setTimeout();n("body").bind("touchstart",function(e){n(this).addClass("touching");s=e.originalEvent.targetTouches[0];i.pageX=e.originalEvent.targetTouches[0].pageX;n(".touching").bind("touchmove",function(e){e.preventDefault();e.stopPropagation();s=e.originalEvent.targetTouches[0]});return false}).bind("touchend",function(u){u.preventDefault();u.stopPropagation();t=s.pageX-i.pageX;if(t>=r){e.getPrev()}else if(t<=-r){e.getNext()}else{if(!o.hasClass("visible-bars")){e.showBars();e.setTimeout()}else{e.clearTimeout();e.hideBars()}}n(".touching").off("touchmove").removeClass("touching")})}},setTimeout:function(){if(u.settings.hideBarsDelay>0){var t=this;t.clearTimeout();t.timeout=e.setTimeout(function(){t.hideBars()},u.settings.hideBarsDelay)}},clearTimeout:function(){e.clearTimeout(this.timeout);this.timeout=null},showBars:function(){var e=n("#swipebox-caption, #swipebox-action");if(this.doCssTrans()){e.addClass("visible-bars")}else{n("#swipebox-caption").animate({top:0},500);n("#swipebox-action").animate({bottom:0},500);setTimeout(function(){e.addClass("visible-bars")},1e3)}},hideBars:function(){var e=n("#swipebox-caption, #swipebox-action");if(this.doCssTrans()){e.removeClass("visible-bars")}else{n("#swipebox-caption").animate({top:"-50px"},500);n("#swipebox-action").animate({bottom:"-50px"},500);setTimeout(function(){e.removeClass("visible-bars")},1e3)}},animBars:function(){var e=this;var t=n("#swipebox-caption, #swipebox-action");t.addClass("visible-bars");e.setTimeout();n("#swipebox-slider").click(function(n){if(!t.hasClass("visible-bars")){e.showBars();e.setTimeout()}});n("#swipebox-action").hover(function(){e.showBars();t.addClass("force-visible-bars");e.clearTimeout()},function(){t.removeClass("force-visible-bars");e.setTimeout()})},keyboard:function(){var t=this;n(e).bind("keyup",function(e){e.preventDefault();e.stopPropagation();if(e.keyCode==37){t.getPrev()}else if(e.keyCode==39){t.getNext()}else if(e.keyCode==27){t.closeSlide()}})},actions:function(){var e=this;if(a.length<2){n("#swipebox-prev, #swipebox-next").hide()}else{n("#swipebox-prev").bind("click touchend",function(t){t.preventDefault();t.stopPropagation();e.getPrev();e.setTimeout()});n("#swipebox-next").bind("click touchend",function(t){t.preventDefault();t.stopPropagation();e.getNext();e.setTimeout()})}n("#swipebox-close").bind("click touchend",function(t){e.closeSlide()})},setSlide:function(e,t){t=t||false;var r=n("#swipebox-slider");if(this.doCssTrans()){r.css({left:-e*100+"%"})}else{r.animate({left:-e*100+"%"})}n("#swipebox-slider .slide").removeClass("current");n("#swipebox-slider .slide").eq(e).addClass("current");this.setTitle(e);if(t){r.fadeIn()}n("#swipebox-prev, #swipebox-next").removeClass("disabled");if(e==0){n("#swipebox-prev").addClass("disabled")}else if(e==a.length-1){n("#swipebox-next").addClass("disabled")}},openSlide:function(t){n("html").addClass("swipebox");n(e).trigger("resize");this.setSlide(t,true)},preloadMedia:function(e){var t=this,n=null;if(a[e]!==r)n=a[e].href;if(!t.isVideo(n)){setTimeout(function(){t.openMedia(e)},1e3)}else{t.openMedia(e)}},openMedia:function(e){var t=this,i=null;if(a[e]!==r)i=a[e].href;if(e<0||e>=a.length){return false}if(!t.isVideo(i)){t.loadMedia(i,function(){n("#swipebox-slider .slide").eq(e).html(this)})}else{n("#swipebox-slider .slide").eq(e).html(t.getVideo(i))}},setTitle:function(e,t){var i=null;n("#swipebox-caption").empty();if(a[e]!==r)i=a[e].title;if(i){n("#swipebox-caption").append(i)}},isVideo:function(e){if(e){if(e.match(/youtube\.com\/watch\?v=([a-zA-Z0-9\-_]+)/)||e.match(/vimeo\.com\/([0-9]*)/)){return true}}},getVideo:function(e){var t="";var n="";var r=e.match(/watch\?v=([a-zA-Z0-9\-_]+)/);var i=e.match(/vimeo\.com\/([0-9]*)/);if(r){t='<iframe width="560" height="315" src="//www.youtube.com/embed/'+r[1]+'" frameborder="0" allowfullscreen></iframe>'}else if(i){t='<iframe width="560" height="315"  src="http://player.vimeo.com/video/'+i[1]+"?byline=0&portrait=0&color="+u.settings.vimeoColor+'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'}return'<div class="swipebox-video-container" style="max-width:'+u.settings.videoMaxWidth+'px"><div class="swipebox-video">'+t+"</div></div>"},loadMedia:function(e,t){if(!this.isVideo(e)){var r=n("<img>").on("load",function(){t.call(r)});r.attr("src",e)}},getNext:function(){var e=this;index=n("#swipebox-slider .slide").index(n("#swipebox-slider .slide.current"));if(index+1<a.length){index++;e.setSlide(index);e.preloadMedia(index+1)}else{n("#swipebox-slider").addClass("rightSpring");setTimeout(function(){n("#swipebox-slider").removeClass("rightSpring")},500)}},getPrev:function(){index=n("#swipebox-slider .slide").index(n("#swipebox-slider .slide.current"));if(index>0){index--;this.setSlide(index);this.preloadMedia(index-1)}else{n("#swipebox-slider").addClass("leftSpring");setTimeout(function(){n("#swipebox-slider").removeClass("leftSpring")},500)}},closeSlide:function(){n("html").removeClass("swipebox");n(e).trigger("resize");this.destroy()},destroy:function(){n(e).unbind("keyup");n("body").unbind("touchstart");n("body").unbind("touchmove");n("body").unbind("touchend");n("#swipebox-slider").unbind();n("#swipebox-overlay").remove();if(!n.isArray(i))i.removeData("_swipebox");if(this.target)this.target.trigger("swipebox-destroy");n.swipebox.isOpen=false;if(u.settings.afterClose)u.settings.afterClose()}};u.init()};n.fn.swipebox=function(e){if(!n.data(this,"_swipebox")){var t=new n.swipebox(this,e);this.data("_swipebox",t)}return this.data("_swipebox")}})(window,document,jQuery);;jQuery(document).ready(function($){$(document).on('ready ajaxComplete',function(){if(rlArgs.script==='swipebox'){$('a[rel*="'+rlArgs.selector+'"]').swipebox({useCSS:(rlArgs.animation==='1'?true:false),hideBarsDelay:(rlArgs.hideBars==='1'?parseInt(rlArgs.hideBarsDelay):0),videoMaxWidth:parseInt(rlArgs.videoMaxWidth)});}else if(rlArgs.script==='prettyphoto'){$('a[rel*="'+rlArgs.selector+'"]').prettyPhoto({animation_speed:rlArgs.animationSpeed,slideshow:(rlArgs.slideshow==='1'?parseInt(rlArgs.slideshowDelay):false),autoplay_slideshow:(rlArgs.slideshowAutoplay==='1'?true:false),opacity:rlArgs.opacity,show_title:(rlArgs.showTitle==='1'?true:false),allow_resize:(rlArgs.allowResize==='1'?true:false),default_width:parseInt(rlArgs.width),default_height:parseInt(rlArgs.height),counter_separator_label:rlArgs.separator,theme:rlArgs.theme,horizontal_padding:parseInt(rlArgs.horizontalPadding),hideflash:(rlArgs.hideFlash==='1'?true:false),wmode:rlArgs.wmode,autoplay:(rlArgs.videoAutoplay==='1'?true:false),modal:(rlArgs.modal==='1'?true:false),deeplinking:(rlArgs.deeplinking==='1'?true:false),overlay_gallery:(rlArgs.overlayGallery==='1'?true:false),keyboard_shortcuts:(rlArgs.keyboardShortcuts==='1'?true:false),social_tools:(rlArgs.social==='1'?'<div class="pp_social"><div class="twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div><div class="facebook"><iframe src="http://www.facebook.com/plugins/like.php?locale=en_US&href='+location.href+'&amp;layout=button_count&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:500px; height:23px;" allowTransparency="true"></iframe></div></div>':''),changepicturecallback:function(){},callback:function(){},ie6_fallback:true});}else if(rlArgs.script==='fancybox'){$('a[rel*="'+rlArgs.selector+'"]').fancybox({modal:(rlArgs.modal==='1'?true:false),overlayShow:(rlArgs.showOverlay==='1'?true:false),showCloseButton:(rlArgs.showCloseButton==='1'?true:false),enableEscapeButton:(rlArgs.enableEscapeButton==='1'?true:false),hideOnOverlayClick:(rlArgs.hideOnOverlayClick==='1'?true:false),hideOnContentClick:(rlArgs.hideOnContentClick==='1'?true:false),cyclic:(rlArgs.cyclic==='1'?true:false),showNavArrows:(rlArgs.showNavArrows==='1'?true:false),autoScale:(rlArgs.autoScale==='1'?true:false),scrolling:rlArgs.scrolling,centerOnScroll:(rlArgs.centerOnScroll==='1'?true:false),opacity:(rlArgs.opacity==='1'?true:false),overlayOpacity:parseFloat(rlArgs.overlayOpacity/100),overlayColor:rlArgs.overlayColor,titleShow:(rlArgs.titleShow==='1'?true:false),titlePosition:rlArgs.titlePosition,transitionIn:rlArgs.transitions,transitionOut:rlArgs.transitions,easingIn:rlArgs.easings,easingOut:rlArgs.easings,speedIn:parseInt(rlArgs.speeds),speedOut:parseInt(rlArgs.speeds),changeSpeed:parseInt(rlArgs.changeSpeed),changeFade:parseInt(rlArgs.changeFade),padding:parseInt(rlArgs.padding),margin:parseInt(rlArgs.margin),width:parseInt(rlArgs.videoWidth),height:parseInt(rlArgs.videoHeight)});}else if(rlArgs.script==='nivo'){$.each($('a[rel*="'+rlArgs.selector+'"]'),function(){var match=$(this).attr('rel').match(new RegExp(rlArgs.selector+'\\[(gallery\\-(?:[\\da-z]{1,4}))\\]','ig'));if(match!==null){$(this).attr('data-lightbox-gallery',match[0]);}});$('a[rel*="'+rlArgs.selector+'"]').nivoLightbox({effect:rlArgs.effect,keyboardNav:(rlArgs.keyboardNav==='1'?true:false),errorMessage:rlArgs.errorMessage});}});});;"undefined"!=typeof jQuery?("undefined"==typeof jQuery.fn.hoverIntent&&!function(a){a.fn.hoverIntent=function(b,c,d){var e={interval:100,sensitivity:7,timeout:0};e="object"==typeof b?a.extend(e,b):a.isFunction(c)?a.extend(e,{over:b,out:c,selector:d}):a.extend(e,{over:b,out:b,selector:c});var f,g,h,i,j=function(a){f=a.pageX,g=a.pageY},k=function(b,c){return c.hoverIntent_t=clearTimeout(c.hoverIntent_t),Math.abs(h-f)+Math.abs(i-g)<e.sensitivity?(a(c).off("mousemove.hoverIntent",j),c.hoverIntent_s=1,e.over.apply(c,[b])):(h=f,i=g,c.hoverIntent_t=setTimeout(function(){k(b,c)},e.interval),void 0)},l=function(a,b){return b.hoverIntent_t=clearTimeout(b.hoverIntent_t),b.hoverIntent_s=0,e.out.apply(b,[a])},m=function(b){var c=jQuery.extend({},b),d=this;d.hoverIntent_t&&(d.hoverIntent_t=clearTimeout(d.hoverIntent_t)),"mouseenter"==b.type?(h=c.pageX,i=c.pageY,a(d).on("mousemove.hoverIntent",j),1!=d.hoverIntent_s&&(d.hoverIntent_t=setTimeout(function(){k(c,d)},e.interval))):(a(d).off("mousemove.hoverIntent",j),1==d.hoverIntent_s&&(d.hoverIntent_t=setTimeout(function(){l(c,d)},e.timeout)))};return this.on({"mouseenter.hoverIntent":m,"mouseleave.hoverIntent":m},e.selector)}}(jQuery),jQuery(document).ready(function(a){var b,c,d,e=a("#wpadminbar"),f=!1;b=function(b,c){var d=a(c),e=d.attr("tabindex");e&&d.attr("tabindex","0").attr("tabindex",e)},c=function(b){e.find("li.menupop").on("click.wp-mobile-hover",function(c){var d=a(this);d.parent().is("#wp-admin-bar-root-default")&&!d.hasClass("hover")?(c.preventDefault(),e.find("li.menupop.hover").removeClass("hover"),d.addClass("hover")):d.hasClass("hover")||(c.stopPropagation(),c.preventDefault(),d.addClass("hover")),b&&(a("li.menupop").off("click.wp-mobile-hover"),f=!1)})},d=function(){var b=/Mobile\/.+Safari/.test(navigator.userAgent)?"touchstart":"click";a(document.body).on(b+".wp-mobile-hover",function(b){a(b.target).closest("#wpadminbar").length||e.find("li.menupop.hover").removeClass("hover")})},e.removeClass("nojq").removeClass("nojs"),"ontouchstart"in window?(e.on("touchstart",function(){c(!0),f=!0}),d()):/IEMobile\/[1-9]/.test(navigator.userAgent)&&(c(),d()),e.find("li.menupop").hoverIntent({over:function(){f||a(this).addClass("hover")},out:function(){f||a(this).removeClass("hover")},timeout:180,sensitivity:7,interval:100}),window.location.hash&&window.scrollBy(0,-32),a("#wp-admin-bar-get-shortlink").click(function(b){b.preventDefault(),a(this).addClass("selected").children(".shortlink-input").blur(function(){a(this).parents("#wp-admin-bar-get-shortlink").removeClass("selected")}).focus().select()}),a("#wpadminbar li.menupop > .ab-item").bind("keydown.adminbar",function(c){if(13==c.which){var d=a(c.target),e=d.closest("ab-sub-wrapper");c.stopPropagation(),c.preventDefault(),e.length||(e=a("#wpadminbar .quicklinks")),e.find(".menupop").removeClass("hover"),d.parent().toggleClass("hover"),d.siblings(".ab-sub-wrapper").find(".ab-item").each(b)}}).each(b),a("#wpadminbar .ab-item").bind("keydown.adminbar",function(c){if(27==c.which){var d=a(c.target);c.stopPropagation(),c.preventDefault(),d.closest(".hover").removeClass("hover").children(".ab-item").focus(),d.siblings(".ab-sub-wrapper").find(".ab-item").each(b)}}),a("#wpadminbar").click(function(b){("wpadminbar"==b.target.id||"wp-admin-bar-top-secondary"==b.target.id)&&(b.preventDefault(),a("html, body").animate({scrollTop:0},"fast"))}),a(".screen-reader-shortcut").keydown(function(b){var c,d;13==b.which&&(c=a(this).attr("href"),d=navigator.userAgent.toLowerCase(),-1!=d.indexOf("applewebkit")&&c&&"#"==c.charAt(0)&&setTimeout(function(){a(c).focus()},100))}),"sessionStorage"in window&&a("#wp-admin-bar-logout a").click(function(){try{for(var a in sessionStorage)-1!=a.indexOf("wp-autosave-")&&sessionStorage.removeItem(a)}catch(b){}}),navigator.userAgent&&-1===document.body.className.indexOf("no-font-face")&&/Android (1.0|1.1|1.5|1.6|2.0|2.1)|Nokia|Opera Mini|w(eb)?OSBrowser|webOS|UCWEB|Windows Phone OS 7|XBLWP7|ZuneWP7|MSIE 7/.test(navigator.userAgent)&&(document.body.className+=" no-font-face")})):!function(a,b){var c,d=function(a,b,c){a.addEventListener?a.addEventListener(b,c,!1):a.attachEvent&&a.attachEvent("on"+b,function(){return c.call(a,window.event)})},e=new RegExp("\\bhover\\b","g"),f=[],g=new RegExp("\\bselected\\b","g"),h=function(a){for(var b=f.length;b--;)if(f[b]&&a==f[b][1])return f[b][0];return!1},i=function(b){for(var d,i,j,k,l,m,n=[],o=0;b&&b!=c&&b!=a;)"LI"==b.nodeName.toUpperCase()&&(n[n.length]=b,i=h(b),i&&clearTimeout(i),b.className=b.className?b.className.replace(e,"")+" hover":"hover",k=b),b=b.parentNode;if(k&&k.parentNode&&(l=k.parentNode,l&&"UL"==l.nodeName.toUpperCase()))for(d=l.childNodes.length;d--;)m=l.childNodes[d],m!=k&&(m.className=m.className?m.className.replace(g,""):"");for(d=f.length;d--;){for(j=!1,o=n.length;o--;)n[o]==f[d][1]&&(j=!0);j||(f[d][1].className=f[d][1].className?f[d][1].className.replace(e,""):"")}},j=function(b){for(;b&&b!=c&&b!=a;)"LI"==b.nodeName.toUpperCase()&&!function(a){var b=setTimeout(function(){a.className=a.className?a.className.replace(e,""):""},500);f[f.length]=[b,a]}(b),b=b.parentNode},k=function(b){for(var d,e,f,h=b.target||b.srcElement;;){if(!h||h==a||h==c)return;if(h.id&&"wp-admin-bar-get-shortlink"==h.id)break;h=h.parentNode}for(b.preventDefault&&b.preventDefault(),b.returnValue=!1,-1==h.className.indexOf("selected")&&(h.className+=" selected"),d=0,e=h.childNodes.length;e>d;d++)if(f=h.childNodes[d],f.className&&-1!=f.className.indexOf("shortlink-input")){f.focus(),f.select(),f.onblur=function(){h.className=h.className?h.className.replace(g,""):""};break}return!1},l=function(a){var b,c,d,e,f,g;if(!("wpadminbar"!=a.id&&"wp-admin-bar-top-secondary"!=a.id||(b=window.pageYOffset||document.documentElement.scrollTop||document.body.scrollTop||0,1>b)))for(g=b>800?130:100,c=Math.min(12,Math.round(b/g)),d=b>800?Math.round(b/30):Math.round(b/20),e=[],f=0;b;)b-=d,0>b&&(b=0),e.push(b),setTimeout(function(){window.scrollTo(0,e.shift())},f*c),f++};d(b,"load",function(){c=a.getElementById("wpadminbar"),a.body&&c&&(a.body.appendChild(c),c.className&&(c.className=c.className.replace(/nojs/,"")),d(c,"mouseover",function(a){i(a.target||a.srcElement)}),d(c,"mouseout",function(a){j(a.target||a.srcElement)}),d(c,"click",k),d(c,"click",function(a){l(a.target||a.srcElement)}),d(document.getElementById("wp-admin-bar-logout"),"click",function(){if("sessionStorage"in window)try{for(var a in sessionStorage)-1!=a.indexOf("wp-autosave-")&&sessionStorage.removeItem(a)}catch(b){}})),b.location.hash&&b.scrollBy(0,-32),navigator.userAgent&&-1===document.body.className.indexOf("no-font-face")&&/Android (1.0|1.1|1.5|1.6|2.0|2.1)|Nokia|Opera Mini|w(eb)?OSBrowser|webOS|UCWEB|Windows Phone OS 7|XBLWP7|ZuneWP7|MSIE 7/.test(navigator.userAgent)&&(document.body.className+=" no-font-face")})}(document,window);