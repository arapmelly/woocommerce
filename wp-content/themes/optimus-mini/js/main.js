
(function ($) {
    $('.stars').raty({
        starType: 'i',
        score: function () {
            return $(this).attr('data-score');
        },
        click: function(score, evt) {
            console.log('ID: ' + this.id + "\nscore: " + score + "\nevent: " + evt);
        }
    });

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


    $(".products-slider > .owl-carousel").each(function () {
        $(this).owlCarousel({
            margin: 15,
            loop: false,
            center: false,
            nav: false,
            dots: false,
            autoWidth: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1024: {
                    items: 3
                },
                1280: {
                    items: 4,
                    margin: 20
                }
            }
        })
    });


    // $('.products-slider .owl-carousel').owlCarousel({
    //     items: 4,
    //     loop: false,
    //     margin: 5,
    //     center: false,
    //     nav: false,
    //     dots: false,
    //
    //     responsive: {
    //         0: {
    //             items: 2,
    //             autoWidth: true,
    //         },
    //         // 600: {
    //         //     items: 3
    //         // },
    //         // 1000: {
    //         //     items: 5
    //         // }
    //     }
    // });


})(jQuery);