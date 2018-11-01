(function ($) {

    "use strict";
    $(".carousel-inner .item:first-child").addClass("active");
    /* Mobile menu click then remove
    ==========================*/
    $(".mainmenu-area #primary_menu li a").on("click", function () {
        $(".navbar-collapse").removeClass("in");
    });
    /* Scroll to top
    ===================*/
    $.scrollUp({
        scrollText: '<i class="lnr lnr-arrow-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });
    /* testimonials Slider Active
    =============================*/
    $('.gallery-slide').owlCarousel({
        loop: true,
        margin: 0,
        responsiveClass: true,
        nav: false,
        autoplay: true,
        autoplayTimeout: 4000,
        smartSpeed: 1000,
        // navText: ['<i class="lnr lnr-chevron-left"></i>', '<i class="lnr lnr-chevron-right"></i>'],
        responsive: {
            0: {
                items: 2,
            },
            600: {
                items: 4
            },
            1280: {
                items: 6
            },
            1500: {
                items: 8
            }
        }
    });
    /* testimonials Slider Active
    =============================*/
    $('.team-slide').owlCarousel({
        loop: false,
        margin: 0,
        responsiveClass: true,
        nav: true,
        autoWidth:true,
        autoplay: false,
        autoplayTimeout: 4000,
        smartSpeed: 1000,
        navText: ['<i class="lnr lnr-chevron-left"></i>', '<i class="lnr lnr-chevron-right"></i>'],
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });
    $(".toggole-boxs").accordion();
    /*---------------------------
    MICHIMP INTEGRATION
    -----------------------------*/
    $('#mc-form').ajaxChimp({
        url: 'https://quomodosoft.us14.list-manage.com/subscribe/post?u=b2a3f199e321346f8785d48fb&amp;id=d0323b0697', //Set Your Mailchamp URL
        callback: function (resp) {
            if (resp.result === 'success') {
                $('.subscrie-form, .join-button').fadeOut();
                $('body').css('overflow-y', 'scroll');
            }
        }
    });

    /*-- Smoth-Scroll --*/
    $('.mainmenu-area a[href*="#"]')
        // Remove links that don't actually link to anything
        .not('[href="#"]')
        .not('[href="#0"]')
        .click(function (event) {
            // On-page links
            if (
                location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
                location.hostname == this.hostname
            ) {
                // Figure out element to scroll to
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                // Does a scroll target exist?
                if (target.length) {
                    // Only prevent default if animation is actually gonna happen
                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000, function () {
                        // Callback after animation
                        // Must change focus!
                        var $target = $(target);
                        $target.focus();
                        if ($target.is(":focus")) { // Checking if the target was focused
                            return false;
                        } else {
                            $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                            $target.focus(); // Set focus again
                        };
                    });
                }
            }
        });
        
    $('#more').click(function (event) {
            // On-page links
            if (
                location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
                location.hostname == this.hostname
            ) {
                // Figure out element to scroll to
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                // Does a scroll target exist?
                if (target.length) {
                    // Only prevent default if animation is actually gonna happen
                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000, function () {
                        // Callback after animation
                        // Must change focus!
                        var $target = $(target);
                        $target.focus();
                        if ($target.is(":focus")) { // Checking if the target was focused
                            return false;
                        } else {
                            $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                            $target.focus(); // Set focus again
                        };
                    });
                }
            }
        });
    /*--------------------
       MAGNIFIC POPUP JS
       ----------------------*/
    var magnifPopup = function () {
        $('.popup').magnificPopup({
            type: 'iframe',
            removalDelay: 300,
            mainClass: 'mfp-with-zoom',
            gallery: {
                enabled: true
            },
            zoom: {
                enabled: true, // By default it's false, so don't forget to enable it

                duration: 300, // duration of the effect, in milliseconds
                easing: 'ease-in-out', // CSS transition easing function

                // The "opener" function should return the element from which popup will be zoomed in
                // and to which popup will be scaled down
                // By defailt it looks for an image tag:
                opener: function (openerElement) {
                    // openerElement is the element on which popup was initialized, in this case its <a> tag
                    // you don't need to add "opener" option if this code matches your needs, it's defailt one.
                    return openerElement.is('img') ? openerElement : openerElement.find('img');
                }
            }
        });
    };
    // Call the functions
    magnifPopup();
    /* Preloader Js
    ===================*/
    $(window).on("load", function () {
        $('.preloader').fadeOut(500);
        /*WoW js Active
        =================*/
        new WOW().init({
            mobile: false,
        });
    });

    $('#show-more-text').on("click", function(){
        if($('.more').hasClass( "hidden" )){
            $('.more').removeClass( "hidden" )
            $('#show-more-text').text("Show less");
        }
        else{
            $('.more').addClass( "hidden" )
            $('#show-more-text').text("Show more");
        }
    });

    $(':radio').change(function() {
        var token = $('#token').val(); // get selected value
        var movieId = $('#movieId').val(); // get selected value
        var rating = $("input[name='stars']:checked").val();
        var data = {rating:  rating, movieId: movieId, _token: token};
        $.ajax({
            type: "POST",
            dataType: 'json',
            data: data,
            url: '/ratingMovie',
            success: function (data) {
                $("#message").fadeTo(2000, 500).slideUp(500, function(){
                    $("#message").slideUp(500);
                });
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
             console.log(errorThrown);
          }
        });
    });

    // jQuery.ajaxSetup({
    //     beforeSend: function() {
    //        $('#loadingDiv').css('display','inline-grid');
    //     },
    //     success: function() {}
    // });

    $('#checkInMovie').on("click", function(){
        var token = $('#token').val(); // get selected value
        var movieId = $('#movieId').val(); // get selected value
        var data = {movieId: movieId, _token: token};
        $.ajax({
            type: "POST",
            dataType: 'json',
            data: data,
            url: '/checkInMovie',
            beforeSend: function() {
                $('#loadingDiv').css('display','inline-grid');
            },
            success: function (data) {
                // $('#message').css("display","block");
                // $('#message').text("Success checked in movie!!");
                // $("#message").fadeTo(2000, 500).slideUp(500, function(){
                //     $("#message").slideUp(500);
                // });
                $('#checkInMovie').html('<span class="lnr lnr-checkmark-circle"></span> Movie Checked In!!');
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
             console.log(errorThrown);
          }
        });
    });


})(jQuery);