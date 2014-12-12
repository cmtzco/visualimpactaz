//  ========== 
//  = Custom JS and jQuery = 
//  ========== 

jQuery(document).ready(function($) {
    "use strict";
    
    var myWidth = (window.innerWidth > 0) ? window.innerWidth : screen.width;
    
    //  ========== 
    //  = Smooth scroll to the top of the page = 
    //  ========== 
    $("#to-the-top").click(function(e) {
        e.preventDefault();
        $("html, body").animate({ 'scrollTop' : 0 }, 2000);
    });
    
    
    //  ========== 
    //  = Carousel = 
    //  ==========
    
    $(window).load(function() {
        $(".carousel").each(function() {
            var $this = $(this);
            $this.carouFredSel({
                auto : {
                    play : false
                },
                prev : {
                    button : $this.parent().find(".nav-left")
                },
                next : {
                    button : $this.parent().find(".nav-right")
                },
                width : '100%',
                responsive : true
            });
        });
    });
    
    //  ========== 
    //  = Revolution Slider = 
    //  ========== 
    if ( myWidth > 767 ) {
        if (jQuery().revolution) {
            var $mainSlider = $(".fullwidthbanner-container-custom > .fullwidthabanner").revolution({
                delay: HairpressJS.theme_slider_delay,                                             
                startheight:530,                            
                startwidth:1500,
                
                navigationType:"none",                  
                navigationArrows:"none",        
                touchenabled:"on",                      
                onHoverStop:"off",                        
                
                navOffsetHorizontal:0,
                navOffsetVertical:20,
                
                hideCaptionAtLimit:0,
                hideAllCaptionAtLilmit:0,
                hideSliderAtLimit:0,
                
                stopAtSlide:-1,
                stopAfterLoops:-1,
                
                shadow:1,
                fullWidth:"on"    
            });
            
            $("#slider-nav-left").click(function(ev) {
                ev.preventDefault();
                $mainSlider.revprev();
            });
            $("#slider-nav-right").click(function(ev) {
                ev.preventDefault();
                $mainSlider.revnext();
            });
            
            $mainSlider.bind("revolution.slide.onchange", function(e, data) {
                var slideIndex = data.slideIndex;
                var customCaption = $(".fullwidthabanner ul li:nth-child(" + slideIndex + ") .custom-cap").text();
                $("#custom-caption-container").html(customCaption);
                
            });
        }
    } else {
        $(".fullwidthbanner-container").css({
            "backgroundImage" : 'url(' + $(".fullwidthbanner-container").find("li:first-child img").attr("src") + ')'
        });
        $(".fullwidthbanner-container .fullwidthabanner").hide();
    }
        
    
    //  ========== 
    //  = Collapse / accordion = 
    //  ========== 
    
    $(".accordion-heading a").click(function(e) {
        e.preventDefault();
        $(this).parent().toggleClass("open").parent().find('.accordion-body').slideToggle();
    });
    
    
    //  ========== 
    //  = jQuery UI datepicker = 
    //  ==========
    /**
     * For time format see: http://trentrichardson.com/examples/timepicker/
     */ 
    $(".add-datepicker").datetimepicker({
        stepMinute: 5,
        hourMin: 6,
        hourMax: 21,
        dateFormat: HairpressJS.datetimepicker_date_format,
        //timeFormat: '',
    });
    
    $(".add-datepicker-icon").click(function(ev) {
        ev.preventDefault();
        $(".add-datepicker").focus();
    });

});
