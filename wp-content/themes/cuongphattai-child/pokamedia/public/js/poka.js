jQuery(document).ready(function(){
    if( jQuery('.product-slider .woocommerce.columns-4 .products.columns-4').length ){
        jQuery('.product-slider .woocommerce.columns-4 .products.columns-4').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            // infinite: true,
            autoplay: true,
            autoplaySpeed: 4000,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 780,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                // {
                //     breakpoint: 768,
                //     settings: {
                //         slidesToShow: 1,
                //         slidesToScroll: 1
                //     }
                // },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
            // arrows: false,
        });
    }

    if( jQuery('.layout-total-tintucsk').length ){
        jQuery('.layout-total-tintucsk').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            // infinite: true,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 780,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
            // arrows: false,
        });
    }

    if( jQuery('.slider-danhmuc-child').length ){
        jQuery('.slider-danhmuc-child').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            // infinite: true,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 780,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
            // arrows: false,
        });
    }


    // jQuery('.flex-control-thumbs').slick({
    //     slidesToShow: 1,
    //     slidesToScroll: 1,
    //     // infinite: true,
    //     autoplay: false,
    //     autoplaySpeed: 2000,
    //     responsive: [
    //         {
    //             breakpoint: 1024,
    //             settings: {
    //                 slidesToShow: 1,
    //                 slidesToScroll: 1,
    //                 infinite: true,
    //                 dots: true
    //             }
    //         },
    //         {
    //             breakpoint: 780,
    //             settings: {
    //                 slidesToShow: 1,
    //                 slidesToScroll: 1
    //             }
    //         },
    //         {
    //             breakpoint: 480,
    //             settings: {
    //                 slidesToShow: 1,
    //                 slidesToScroll: 1
    //             }
    //         }
    //         // You can unslick at a given breakpoint now by adding:
    //         // settings: "unslick"
    //         // instead of a settings object
    //     ]
    //     // arrows: false,
    // });
    //
    jQuery(".product-categories .cat-item.cat-parent").click(function(){
        jQuery(this).addClass("active");
        jQuery(".product-categories .cat-parent.active .children").toggle();
        jQuery(this).removeClass("active");
        });

    // jQuery(".container-total-mota").hide();

    // jQuery(".button-showmore-mota").click(function(){

        // jQuery(this).addClass("remove");
        // // jQuery(".container-total-mota").toggle();
        // jQuery(".container-total-mota").show();
        //
        // });

    jQuery(".term-description").appendTo(jQuery(".pk-banner-category"));
    jQuery("h1.page-title").appendTo(jQuery(".term-description"));

})