(function ($) {
    /*$('.stars').raty({
        starType: 'i',
        score: function () {
            //return $(this).attr('data-score');
            return $('stars').raty('score');
        },
        click: function (score, evt) {
            
            //generate a cookieId and post the score via ajax

             $.ajax({
                url: ajaxurl, // or example_ajax_obj.ajaxurl if using on frontend
                data: {
                    'action': 'rate_shop_ajax',
                    'rating' : score
                },
                success:function(data) {
                    // This outputs the result of the ajax request
                    console.log(data);
                },
                error: function(errorThrown){
                    console.log(errorThrown);
                }
            });  

            console.log('ID: ' + this.id + "\nscore: " + score + "\nevent: " + evt);
            $('stars').raty('reload'); 
        }
    });*/


    $('#tabs').tabslet({
        container: '#tabs_container'
    });

    $('.filter-by-category .owl-carousel').owlCarousel({
        items: 4,
        loop: false,
        margin: 15,
        center: false,
        nav: true,
        dots: false,
        navContainer: '.filter-by-category .custom-nav',
        navText: ["<span class='icon-chevron-left-outline'/>", "<span class='icon-chevron-right-outline'/>"]
    });

    var $window = $(window),
        $head = $('head'),
        $body = $('body');

    // Breakpoints.
    breakpoints({
        xlarge: ['1281px', '1680px'],
        large: ['981px', '1280px'],
        medium: ['737px', '980px'],
        small: ['481px', '736px'],
        xsmall: ['361px', '480px'],
        xxsmall: [null, '360px'],
        'xlarge-to-max': '(min-width: 1681px)',
        'small-to-xlarge': '(min-width: 481px) and (max-width: 1680px)'
    });

    // Stops animations/transitions until the page has ...
    // ... loaded.
    if ($(body).hasClass('home') && $(body).hasClass('single single-product')){
        $window.on('load', function () {
            window.setTimeout(function () {
                $body.removeClass('is-preload');
            }, 100);
        });
    }


    // ... stopped resizing.
    var resizeTimeout;

    $window.on('resize', function () {

        // Mark as resizing.
        $body.addClass('is-resizing');

        // Unmark after delay.
        clearTimeout(resizeTimeout);

        resizeTimeout = setTimeout(function () {
            $body.removeClass('is-resizing');
        }, 100);

    });

    // Fixes.

    // Object fit images.
    // if (!browser.canUse('object-fit')
    //     ||	browser.name == 'safari')
    //     $('.image.object').each(function() {
    //
    //         var $this = $(this),
    //             $img = $this.children('img');
    //
    //         // Hide original image.
    //         $img.css('opacity', '0');
    //
    //         // Set background.
    //         $this
    //             .css('background-image', 'url("' + $img.attr('src') + '")')
    //             .css('background-size', $img.css('object-fit') ? $img.css('object-fit') : 'cover')
    //             .css('background-position', $img.css('object-position') ? $img.css('object-position') : 'center');
    //
    //     });

    // Sidebar.
    var $sidebar = $('#sidebar'),
        $sidebar_inner = $sidebar.children('.inner');

    // Inactive by default on <= large.
    breakpoints.on('<=large', function () {
        $sidebar.addClass('inactive');
    });

    breakpoints.on('>large', function () {
        // $sidebar.removeClass('inactive');
        $sidebar.addClass('inactive');
    });

    // Hack: Workaround for Chrome/Android scrollbar position bug.
    if (browser.os === 'android'
        && browser.name === 'chrome')
        $('<style>#sidebar .inner::-webkit-scrollbar { display: none; }</style>')
            .appendTo($head);

    // Toggle.
    // $('<a href="#sidebar" class="toggle">Toggle</a>')
    //     .appendTo($sidebar)
    //     .on('click', function(event) {
    //
    //         // Prevent default.
    //         event.preventDefault();
    //         event.stopPropagation();
    //
    //         // Toggle.
    //         $sidebar.toggleClass('inactive');
    //
    //     });

    $('.toggle').on('click', function (event) {

        // Prevent default.
        event.preventDefault();
        event.stopPropagation();

        // console.log('----', this);
        //
        // if($sidebar.hasClass('inactive')){
        //     $sidebar.removeClass('inactive');
        //
        // }else if(!$sidebar.hasClass('inactive')) {
        //     $('#sidebar').addClass('inactive');
        // }

        // Toggle.
        $sidebar.toggleClass('inactive');
    });

    // Events.

    // Link clicks.
    $sidebar.on('click', 'a', function (event) {

        // >large? Bail.
        if (breakpoints.active('>large'))
            return;

        // Vars.
        var $a = $(this),
            href = $a.attr('href'),
            target = $a.attr('target');

        // Prevent default.
        event.preventDefault();
        event.stopPropagation();

        // Check URL.
        if (!href || href == '#' || href == '')
            return;

        // Hide sidebar.
        $sidebar.addClass('inactive');

        // Redirect to href.
        setTimeout(function () {

            if (target == '_blank')
                window.open(href);
            else
                window.location.href = href;

        }, 500);

    });

    // Prevent certain events inside the panel from bubbling.
    $sidebar.on('click touchend touchstart touchmove', function (event) {

        // >large? Bail.
        if (breakpoints.active('>large'))
            return;

        // Prevent propagation.
        event.stopPropagation();

    });

    // Hide panel on body click/tap.
    $body.on('click touchend', function (event) {

        // >large? Bail.
        if (breakpoints.active('>large'))
            return;

        // Deactivate.
        $sidebar.addClass('inactive');

    });

    // Scroll lock.
    // Note: If you do anything to change the height of the sidebar's content, be sure to
    // trigger 'resize.sidebar-lock' on $window so stuff doesn't get out of sync.

    $window.on('load.sidebar-lock', function () {

        var sh, wh, st;

        // Reset scroll position to 0 if it's 1.
        if ($window.scrollTop() == 1)
            $window.scrollTop(0);

        $window
            .on('scroll.sidebar-lock', function () {

                var x, y;

                // <=large? Bail.
                if (breakpoints.active('<=large')) {

                    $sidebar_inner
                        .data('locked', 0)
                        .css('position', '')
                        .css('top', '');

                    return;

                }

                // Calculate positions.
                x = Math.max(sh - wh, 0);
                y = Math.max(0, $window.scrollTop() - x);

                // Lock/unlock.
                if ($sidebar_inner.data('locked') == 1) {

                    if (y <= 0)
                        $sidebar_inner
                            .data('locked', 0)
                            .css('position', '')
                            .css('top', '');
                    else
                        $sidebar_inner
                            .css('top', -1 * x);

                }
                else {

                    if (y > 0)
                        $sidebar_inner
                            .data('locked', 1)
                            .css('position', 'fixed')
                            .css('top', -1 * x);

                }

            })
            .on('resize.sidebar-lock', function () {

                // Calculate heights.
                wh = $window.height();
                sh = $sidebar_inner.outerHeight() + 30;

                // Trigger scroll.
                $window.trigger('scroll.sidebar-lock');

            })
            .trigger('resize.sidebar-lock');

    });

    // Menu.
    var $menu = $('#menu'),
        $menu_openers = $menu.children('ul').find('.opener');

    // Openers.
    $menu_openers.each(function () {

        var $this = $(this);

        $this.on('click', function (event) {

            // Prevent default.
            event.preventDefault();

            // Toggle.
            $menu_openers.not($this).removeClass('active');
            $this.toggleClass('active');

            // Trigger resize (sidebar lock).
            $window.triggerHandler('resize.sidebar-lock');

        });

    });

    $('.product-image').fotorama({
        width: '100%',
        maxwidth: '100%',
        allowfullscreen: true,
        nav: 'dots'
    });

    $('select').select2({
        minimumResultsForSearch: 10 // at least 10 results must be displayed
    });

    $(".scroll-to").on("click", function () {
        $("html, body").animate({
            scrollTop: $('.scroll-to').offset().top
        }, 1300);
    });

    // setTimeout() function will be fired after page is loaded
    // it will wait for 5 sec. and then will fire
    // $("#successMessage").hide() function
    setTimeout(function() {

        if ($('.woocommerce-notices-wrapper div').length > 0) {
            $('.woocommerce-notices-wrapper div').remove();
        }
    }, 5000);

    $('.qty-input i').click(function() {
        $this = $(this).parent().find('input');

        val = parseInt($this.val());

        if ($(this).hasClass('less')) {
            val = val - 1;
        } else if ($(this).hasClass('more')) {
            val = val + 1;
        }

        if (val < 1) {
            val = 1;
        }

        $this.val(val);
        document.getElementById("update_cart_btn").click();
    })

})(jQuery);