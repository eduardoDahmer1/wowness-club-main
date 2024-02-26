(function ($) {

	"use strict";

	$(window).on('load', function(){
			'use strict';
			$('#carousel_slider').flexslider({
				animation: "slide",
				controlNav: false,
				animationLoop: false,
				slideshow: true,
				itemWidth: 280,
				itemMargin: 40,
				asNavFor: '#slider'
			});
			$('#slider').flexslider({
				animation: "fade",
				controlNav: false,
				animationLoop: false,
				slideshow: true,
				sync: "#carousel_slider",
				start: function(slider) {
					$('body').removeClass('loading');
				}
			});

			$('.slider-feature-categories').owlCarousel({
				margin:10,
				nav:true,
				dots:false,
				loop:true,
				responsive:{
					0:{
						items:1
					},
					768:{
						items:2
					},
					992:{
						items:3
					}
				}
			})

			$('.slider-feature-goals').owlCarousel({
				margin:10,
				dots: false,
				nav: true,
				loop: true,
				responsive:{
					0:{
						items:1
					},
					480:{
						items:2
					},
					768:{
						items:3
					},
					992:{
						items:4
					},
					1920:{
						items:5
					}
				}
			})

            $('.slider-contents').owlCarousel({
				margin:10,
				dots: false,
				nav:true,
				loop: false,
				responsive:{
					0:{
						items:1
					},
					576:{
						items:2
					},
					768:{
						items:3
					},
					992:{
						items:4
					},
					1920:{
						items:5
					}
				}
			})

			$('.slider-feature-blog').owlCarousel({
				loop:true,
				margin:10,
				dots:false,
				responsive:{
						0:{
								items:1
						},
						700:{
								items:2
						},
						992:{
								items:3
						}
				}
			})

            $('.owl-testimonials').owlCarousel({
                margin:10,
                nav:true,
                dots:false,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:2
                    },
                    1000:{
                        items:3
                    }
                }
            })

            $('.owl-practitioners').owlCarousel({
                margin:10,
                nav:true,
                dots:false,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:2
                    },
                    1000:{
                        items:4
                    }
                }
            })

	});

})(window.jQuery);
