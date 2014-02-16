var $ = jQuery.noConflict();

$(document).ready(function (e) {
    $("input[type=checkbox]").tzCheckbox({
        labels: ["Enabled", "Disabled"]
    });
    
    $(".Shelp").click(function () {
        $(this).next().stop('true','true').fadeToggle()
    });
    
    $('.field_help').append('<span class="triangle"></span>');
    $(".field_help").hide();
    $(".field_help").append('<i>X</i>');
    $('.help i').click(function(){
       $('.field_help').fadeOut();
    });        
    
       
    $("#sup_content_1, #sup_content_2, #sup_content_3, #sup_content_4, #sup_content_5, #sup_content_6, #sup_content_7").hide();    
    $("#tab_1").click(function () {
        ID = "#" + $(this).attr("id");
        $(".tab_content").stop(true, true).hide();
        $("#sup_content_1").stop(true, true).fadeIn('fast');        
        document.cookie = "tab_1"
    });
    $("#tab_2").click(function () {
        $(".tab_content").stop(true, true).hide();
        $("#sup_content_2").stop(true, true).fadeIn('fast');        
        document.cookie = "tab_2"
    });
    $("#tab_3").click(function () {
        $(".tab_content").stop(true, true).hide();
        $("#sup_content_3").stop(true, true).fadeIn('fast');        
        document.cookie = "tab_3"
    });
    $("#tab_4").click(function () {
        $(".tab_content").stop(true, true).hide();
        $("#sup_content_4").stop(true, true).fadeIn('fast');                        
        $('.sup-slider-message').delay('2000').slideDown('slow');
        $('.sup_slider_down').hide();
        $('.sup_slider_up').show();
        document.cookie = "tab_4"
    });
    $("#tab_5").click(function () {
        $(".tab_content").stop(true, true).hide();
        $("#sup_content_5").stop(true, true).fadeIn('fast');        
        document.cookie = "tab_5"
    });
    $("#tab_6").click(function () {
        $(".tab_content").stop(true, true).hide();
        $("#sup_content_6").stop(true, true).fadeIn('fast');        
        document.cookie = "tab_6"
    });
    $("#tab_7").click(function () {
        $(".tab_content").stop(true, true).hide();
        $("#sup_content_7").stop(true, true).fadeIn('fast');        
        document.cookie = "tab_7"
    });
    $("#tab_8").click(function () {
        $(".tab_content").stop(true, true).hide();
        $("#sup_content_8").stop(true, true).fadeIn('fast');        
        document.cookie = "tab_8"
    });
    var t = "";
    var t = document.cookie;
    t = t.split(";")[0];
    if (t == "tab_1") {
        $(".tab_content").hide();
        $("#sup_content_1").show();
        $("#tab_1").addClass("supernova_current")
    } else if (t == "tab_2") {
        $(".tab_content").hide();
        $("#sup_content_2").show();
        $("#tab_2").addClass("supernova_current")
    } else if (t == "tab_3") {
        $(".tab_content").hide();
        $("#sup_content_3").show();
        $("#tab_3").addClass("supernova_current")
    } else if (t == "tab_4") {
        $(".tab_content").hide();
        $("#sup_content_4").show();
        $('.image_size_notice').fadeIn();
        $("#tab_4").addClass("supernova_current")
    } else if (t == "tab_5") {
        $(".tab_content").hide();
        $("#sup_content_5").show();
        $("#tab_5").addClass("supernova_current")
    } else if (t == "tab_6") {
        $(".tab_content").hide();
        $("#sup_content_6").show();
        $("#tab_6").addClass("supernova_current")
    } else if (t == "tab_7") {
        $(".tab_content").hide();
        $("#sup_content_7").show();
        $("#tab_7").addClass("supernova_current")
    } else if (t == "tab_8") {
        $(".tab_content").hide();
        $("#sup_content_8").show();
        $("#tab_8").addClass("supernova_current")
    } else if (t == "tab_9") {
        $(".tab_content").hide();
        $("#sup_content_9").show();
        $("#tab_9").addClass("supernova_current")
    } else if (t = "") {
        $(".tab_content").hide();
        $("#sup_content_1").show()
    }else{
        $('#tab_8').addClass('supernova_current');
    }
    $(".supernova_tabs").click(function () {
        $("#message").fadeOut();
    });
        
    $(".supernova_tabs").on("click", "li", function () {
        $(".supernova_tabs .supernova_current").removeClass("supernova_current");
        $(this).addClass("supernova_current")
    });
    $("#more_images1").hide();
    $("#more_images2").hide();
    $(".loader").show();
    $(".new-button-primary, .submit").click(function () {
        $(".loader").show();
        $("saving_settings").show()
    });
    $(".supernova_saved").delay(400).fadeOut(500)
});
$(window).load(function () {
    $(".loader").hide();
    $("#supernova_options_page").css({
        display: "block"
    })
});

$.fn.tzCheckbox = function (e) {
    e = $.extend({
        labels: ["ON", "OFF"]
    }, e);
    return this.each(function () {
        var t = $(this),
            n = [];
        if (t.data("on")) {
            n[0] = t.data("on");
            n[1] = t.data("off")
        } else n = e.labels;
        var r = $("<span>", {
            "class": "tzCheckBox " + (this.checked ? "checked" : ""),
            html: '<span class="tzCBContent">' + n[this.checked ? 0 : 1] + '</span><span class="tzCBPart"></span>'
        });
        r.insertAfter(t.hide());
        r.click(function () {
            r.toggleClass("checked");
            var e = r.hasClass("checked");
            t.attr("checked", e);
            r.find(".tzCBContent").html(n[e ? 0 : 1])
        });
        t.bind("change", function () {
            r.click()
        })
    })
};
$(document).ready(function (e) {
    
    //Handles remove buttons
    $('.remove-button').click(function(){
        var Ptd = $(this).parent().parent();
        Ptd.find('.supernova_links').val('');
        var imgDiv = Ptd.find('.imgpre_ref');
        if(imgDiv){
            imgDiv.find('img').remove();
        }
        var imgparent = $(this).parent().find('.aop_image_uploader_thumb');
        if(imgparent){
            imgparent.remove();
        }
        
    });
    
    //changes slider image when a different one selected


    //Handles Let me slected in for popular posts
    $(".letmeselect").hide();    
    $(".letmeselect_label").click(function(){$(".letmeselect").fadeIn()});$(".popular_post_selection span:first-child, .oncomments").click(function(){$(".letmeselect").fadeOut()});
    
    //Handles reset Button
    $(".reset_button").click(function () {
        if (confirm("Just making sure you didn't hit me by mistake, click ok to reset settings?")) {
            return true;
        } else {
            return false;
        }
    });
    $(".new-button-primary").on("click", function (e) {
        ContentWidth = $("#content-width").val();
        SidebarWidth = $("#sidebar-width").val();
        var t = +ContentWidth + +SidebarWidth;
        Diff = 100 - (+ContentWidth + +SidebarWidth);
        if (t !== 100) {
            $(".loader").hide();
            alert("The total of 'Content Width' and 'Sidbar Width' should be 100%, there still a difference of " + Diff + "%. Please adjust values");
            return false;
        } else {
            return true;
        }
    });
    $(".supernova_links").blur(function () {
        var e = $(this);
        var t = e.val();
        if (t && !t.match(/^http([s]?):\/\/.*/)) {
            e.val("http://" + t)
        }
    });
    var t;
    setInterval(function () {
        if (t == 0) {
            $("#menu_right sup").removeClass("blink");
            t = 1
        } else {
            if (t = 1) {
                $("#menu_right sup").addClass("blink");
                t = 0
            }
        }
    }, 500)
});

$(document).ready(function () {
    $('.scheme_one').each(function () {
        var checkInput = $(this).find('input');
        if (checkInput.is('[checked]')) {
            checkInput.parent().find('.checkedyes').show();
        }
    })

    $('.sidebar_left, .sidebar_right, .no-sidebar').click(function () {
        $(this).find('#sidebar-pos').attr('checked', 'checked');
    });
    
    $('.scheme_two').click(function () {
        $(this).find('input').attr('checked', 'checked');
    });
    
    $('.scheme_color').click(function () {
        $(this).next().attr('checked', 'checked');
        $(this).next().addClass('checkchecker');
        $('.scheme_one').each(function () {
            $('.scheme_one').find('.checkedyes').fadeOut();
        })

        if ($(this).next().hasClass('checkchecker')) {
            $(this).find('.checkedyes').fadeIn();
        } else {
            $(this).find('.checkedyes').fadeOut();
        }


    });
    
    $('tr label').click(function () {
        var CheckTarget = $(this).parent().parent().find('.tzCheckBox');
        var ContentTarget = $(this).parent().parent().find('.tzCBContent');
        var InputTarget = $(this).parent().parent().find('input');
        if (!CheckTarget)
            return false;
        if (CheckTarget.hasClass('checked')) {
            CheckTarget.removeClass('checked');
            ContentTarget.html('Disabled');
            InputTarget.removeAttr('checked', 'checked');
        } else {
            CheckTarget.addClass('checked');
            ContentTarget.html('Enabled');
            InputTarget.attr('checked', 'checked');
        }
    });
    
    $('.supernova_slider-from-page').click(function(){
        $('#supernova_admin_form').submit();
    })
    
    //SELECT 2
    $(".supernova_admin_select").select2({                                            
                                            allowClear: true
                                        });
    
    //Sub Navigation
    $('.sup_inner_tab_contents').each(function(){
        $(this).find('.sup_inner_tab').hide();
    });
    
    $('.sup_inner_tab_block').each(function(){
        var Parent = $(this).parent();
        var tab = $(this).find('.sup_inner_tab');
        
        tab.click(function(){
           var CurrentIndex = $(this).index();           
           var ParentDiv = Parent.find('.sup_inner_tab_contents');
           var TargetDiv = ParentDiv.find('.sup_inner_tab:eq('+CurrentIndex+')');
            ParentDiv.find('.sup_inner_tab').hide();
            TargetDiv.fadeIn();
            Parent.find('.supernova_table tr td').hide();
            $('.sup_inner_tab_page, .sup_inner_tab').removeClass('border-bottom');
            $(this).addClass('border-bottom');
        });
    }); 
    
     $('.sup_inner_tab_page').each(function(){
         var Parent  = $(this).parent();
            $(this).click(function(){
                $('.sup_inner_tab').removeClass('border-bottom');
                $(this).addClass('border-bottom');
                Parent.find('.supernova_table tr td').fadeIn();
                Parent.find('.sup_inner_tab_contents .sup_inner_tab').hide();
            });
     });
     
     //Slider message
     $('.sup-slider-message').hide();
     
     $('.sup_slider_up').click(function(){
         $('.sup-slider-message').slideUp();
         $('.sup_slider_down').show();
         $(this).hide();
     });
     $('.sup_slider_down').click(function(){
         $('.sup-slider-message').slideDown();
         $('.sup_slider_down').hide();
         $('.sup_slider_up').show();
     });
        
//Button Set        
$('#menu_right').buttonset();
        
    $("#e15").select2({tags:["Author", "Date", "Comment"]});
    $("#e15").on("change", function() { $("#e15_val").html($("#e15").val());});

    $("#e15").select2("container").find("ul.select2-choices").sortable({
        containment: 'parent',
        start: function() { $("#e15").select2("onSortStart"); },
        update: function() { $("#e15").select2("onSortEnd"); }
    });
    
    
var sidebarPos = $('.supernova_sidebar-pos');
var sidebarPosInput = sidebarPos.find('input');
var sidebarPosDiv   = sidebarPos.find('div');
sidebarPosInput.each(function(){    
    if($(this).attr('checked') == 'checked'){
        $(this).parent().addClass('selected-sidebarpos');
    }
});

sidebarPosDiv.each(function(){
    $(this).click(function(){
        sidebarPosDiv.removeClass('selected-sidebarpos');
        $(this).addClass('selected-sidebarpos');
    });
});

$('.supernova_icon-color').find('input').each(function(){
    if($(this).attr('checked') == 'checked'){
        $(this).parent().find('img').addClass('selected-sidebarpos');
    }    
});

$('.supernova_icon-color').find('div').each(function(){
    var Image = $('.supernova_icon-color').find('div').find('img');
   $(this).click(function(){
        Image.removeClass('selected-sidebarpos');
        $(this).find('img').addClass('selected-sidebarpos');
    });    
});

});

$(document).ready(function(){var e;$(".supernova-upload-button").click(function(){e=$(this).prev("input");tb_show("","media-upload.php?TB_iframe=true");return false});window.old_tb_remove=window.tb_remove;window.tb_remove=function(){window.old_tb_remove();e=null};window.original_send_to_editor=window.send_to_editor;window.send_to_editor=function(t){if(e){fileurl=$("img",t).attr("src");$(e).val(fileurl);tb_remove()}else{window.original_send_to_editor(t)}}})
