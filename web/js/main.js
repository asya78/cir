/*!
 * Start Bootstrap - Agency Bootstrap Theme (http://startbootstrap.com)
 * Code licensed under the Apache License v2.0.
 * For details, see http://www.apache.org/licenses/LICENSE-2.0.
 */
$(document).ready( function() {
    $('#backTop').backTop({
        'position' : 1600,
        'speed' : 500,
        'color' : 'blue',
    });

    // Closes the Responsive Menu on Menu Item Click
    $('.navbar-collapse ul li a').click(function() {
        $('.navbar-toggle:visible').click();
    });

    if (window.location.pathname !== "/") {
        $('.navbar-default').css({'background-color':'#4394b1', 'padding':'0px'});
        $('.navbar-default .navbar-brand').css('color','#feca65')
    }

    // Dropdown menu
    $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
        event.preventDefault();
        event.stopPropagation();
        $(this).parent().siblings().removeClass('open');
        $(this).parent().toggleClass('open');
    });

    $(".toggle-password").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });


    $('.js-datepicker').datepicker({
        format: 'yy-mm-d',
        startDate : new Date(),
        todayHighlight : true
    });

});

// jQuery for page scrolling feature - requires jQuery Easing plugin
    $(function() {
        $('a.page-scroll').bind('click', function(event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top
            }, 1500, 'easeInOutExpo');
            event.preventDefault();
        });
    });

// Highlight the top nav as scrolling occurs
    $('body').scrollspy({
        target: '.navbar-fixed-top'
    });


//Initialize FooTable
    $(function () {
        $('table').footable();
    });

