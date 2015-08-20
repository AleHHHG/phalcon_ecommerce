jQuery(document).ready(function() {
    "use strict";
    /*  Menu */
    jQuery('#rev_slider_4').show().revolution({
        dottedOverlay: 'none',
        delay: 5000,
        startwidth: 1920,
        startheight: 680,

        hideThumbs: 200,
        thumbWidth: 200,
        thumbHeight: 50,
        thumbAmount: 2,

        navigationType: 'null',
        navigationArrows: 'solo',
        navigationStyle: 'round',

        touchenabled: 'on',
        onHoverStop: 'on',

        swipe_velocity: 0.7,
        swipe_min_touches: 1,
        swipe_max_touches: 1,
        drag_block_vertical: false,

        spinner: 'spinner0',
        keyboardNavigation: 'off',

        navigationHAlign: 'center',
        navigationVAlign: 'bottom',
        navigationHOffset: 0,
        navigationVOffset: 20,

        soloArrowLeftHalign: 'left',
        soloArrowLeftValign: 'center',
        soloArrowLeftHOffset: 20,
        soloArrowLeftVOffset: 0,

        soloArrowRightHalign: 'right',
        soloArrowRightValign: 'center',
        soloArrowRightHOffset: 20,
        soloArrowRightVOffset: 0,

        shadow: 0,
        fullWidth: 'on',
        fullScreen: 'off',

        stopLoop: 'off',
        stopAfterLoops: -1,
        stopAtSlide: -1,

        shuffle: 'off',

        autoHeight: 'off',
        forceFullWidth: 'on',
        fullScreenAlignForce: 'off',
        minFullScreenHeight: 0,
        hideNavDelayOnMobile: 1500,

        hideThumbsOnMobile: 'off',
        hideBulletsOnMobile: 'off',
        hideArrowsOnMobile: 'off',
        hideThumbsUnderResolution: 0,

        hideSliderAtLimit: 0,
        hideCaptionAtLimit: 0,
        hideAllCaptionAtLilmit: 0,
        startWithSlide: 0,
        fullScreenOffsetContainer: ''
    });
    slideEffectAjax()
    jQuery(".toggle").on("click", function() {
        return jQuery(".submenu").is(":hidden") ? jQuery(".submenu").slideDown("fast") : jQuery(".submenu").slideUp("fast"), !1
    }), jQuery(".topnav").accordion({
        accordion: !1,
        speed: 300,
        closedSign: "+",
        openedSign: "-"
    }), jQuery("#nav > li").hover(function() {
        var e = $(this).find(".level0-wrapper");
        e.hide(), e.css("left", "0"), e.stop(true, true).delay(150).fadeIn(300, "easeOutCubic")
    }, function() {
        $(this).find(".level0-wrapper").stop(true, true).delay(300).fadeOut(300, "easeInCubic")
    });
    jQuery("#nav li.level0.drop-menu").mouseover(function() {
            return jQuery(window).width() >= 740 && jQuery(this).children("ul.level1").fadeIn(100), !1
        }).mouseleave(function() {
            return jQuery(window).width() >= 740 && jQuery(this).children("ul.level1").fadeOut(100), !1
        }), jQuery("#nav li.level0.drop-menu li").mouseover(function() {
            if (jQuery(window).width() >= 740) {
                jQuery(this).children("ul").css({
                    top: 0,
                    left: "165px"
                });
                var e = jQuery(this).offset();
                e && jQuery(window).width() < e.left + 325 ? (jQuery(this).children("ul").removeClass("right-sub"), jQuery(this).children("ul").addClass("left-sub"), jQuery(this).children("ul").css({
                    top: 0,
                    left: "-167px"
                })) : (jQuery(this).children("ul").removeClass("left-sub"), jQuery(this).children("ul").addClass("right-sub")), jQuery(this).children("ul").fadeIn(100)
            }
        }).mouseleave(function() {
            jQuery(window).width() >= 740 && jQuery(this).children("ul").fadeOut(100)
        }),
        /*  Best Seller Slider */
        jQuery("#best-seller-slider .slider-items").owlCarousel({
            items: 4,
            itemsDesktop: [1024, 4],
            itemsDesktopSmall: [900, 3],
            itemsTablet: [600, 2],
            itemsMobile: [320, 1],
            navigation: !0,
            navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
            slideSpeed: 500,
            pagination: !1
        }),
        /*  Featured Product Slider */
        jQuery("#featured-product-slider .slider-items").owlCarousel({
            items: 4,
            itemsDesktop: [1024, 4],
            itemsDesktopSmall: [900, 3],
            itemsTablet: [600, 2],
            itemsMobile: [320, 1],
            navigation: !0,
            navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
            slideSpeed: 500,
            pagination: !1
        }),
        /*  Bag Seller Slider */
        jQuery("#bag-seller-slider .slider-items").owlCarousel({
            items: 6,
            itemsDesktop: [1024, 4],
            itemsDesktopSmall: [900, 3],
            itemsTablet: [600, 2],
            itemsMobile: [320, 1],
            navigation: !0,
            navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
            slideSpeed: 500,
            pagination: !1
        }),
        /*  Bag Seller Slider */
        jQuery("#bag-seller-slider1 .slider-items").owlCarousel({
            items: 6,
            itemsDesktop: [1024, 4],
            itemsDesktopSmall: [900, 3],
            itemsTablet: [600, 2],
            itemsMobile: [320, 1],
            navigation: !0,
            navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
            slideSpeed: 500,
            pagination: !1
        }),
        /*  Featured Product Slider */
        jQuery("#featured-slider .slider-items").owlCarousel({
            items: 4,
            itemsDesktop: [1024, 4],
            itemsDesktopSmall: [900, 3],
            itemsTablet: [600, 2],
            itemsMobile: [320, 1],
            navigation: !0,
            navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
            slideSpeed: 500,
            pagination: !1
        }),
        /*  Recommended Product Slider */
        jQuery("#recommend-slider .slider-items").owlCarousel({
            items: 6,
            itemsDesktop: [1024, 4],
            itemsDesktopSmall: [900, 3],
            itemsTablet: [600, 2],
            itemsMobile: [320, 1],
            navigation: !0,
            navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
            slideSpeed: 500,
            pagination: !1
        }),
        /*  Brand Logo Slider */
        jQuery("#brand-logo-slider .slider-items").owlCarousel({
            autoplay: !0,
            items: 6,
            itemsDesktop: [1024, 4],
            itemsDesktopSmall: [900, 3],
            itemsTablet: [600, 2],
            itemsMobile: [320, 1],
            navigation: !0,
            navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
            slideSpeed: 500,
            pagination: !1
        }),
        /*  Category Description Slider */
        jQuery("#category-desc-slider .slider-items").owlCarousel({
            autoplay: !0,
            items: 1,
            itemsDesktop: [1024, 1],
            itemsDesktopSmall: [900, 1],
            itemsTablet: [600, 1],
            itemsMobile: [320, 1],
            navigation: !0,
            navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
            slideSpeed: 500,
            pagination: !1
        }),
        /*  More Views Slider */
        jQuery("#more-views-slider .slider-items").owlCarousel({
            autoplay: !0,
            items: 4,
            itemsDesktop: [1024, 4],
            itemsDesktopSmall: [900, 3],
            itemsTablet: [600, 2],
            itemsMobile: [320, 1],
            navigation: !0,
            navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
            slideSpeed: 500,
            pagination: !1
        }),
        /*  Related Product Slider */
        jQuery("#related-products-slider .slider-items").owlCarousel({
            items: 1,
            itemsDesktop: [1024, 1],
            itemsDesktopSmall: [900, 1],
            itemsTablet: [600, 1],
            itemsMobile: [320, 1],
            navigation: !0,
            navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
            slideSpeed: 500,
            pagination: !1
        }),
        /*  Upsell Product Slider */
        jQuery("#upsell-products-slider .slider-items").owlCarousel({
            items: 4,
            itemsDesktop: [1024, 4],
            itemsDesktopSmall: [900, 3],
            itemsTablet: [600, 2],
            itemsMobile: [320, 1],
            navigation: !0,
            navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
            slideSpeed: 500,
            pagination: !1
        }),
 
        /*  More Views Slider */
        jQuery("#more-views-slider .slider-items").owlCarousel({
            autoplay: !0,
            items: 3,
            itemsDesktop: [1024, 4],
            itemsDesktopSmall: [900, 3],
            itemsTablet: [600, 2],
            itemsMobile: [320, 1],
            navigation: !0,
            navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
            slideSpeed: 500,
            pagination: !1
        }),
		/* Mobile Menu */	

        jQuery("#mobile-menu").mobileMenu({
            MenuWidth: 250,
            SlideSpeed: 300,
            WindowsMaxWidth: 767,
            PagePush: !0,
            FromLeft: !0,
            Overlay: !0,
            CollapseMenu: !0,
            ClassName: "mobile-menu"
        })

        /*  Sidebar Menu */
        jQuery("ul.accordion li.parent, ul.accordion li.parents, ul#magicat li.open").each(function() {
            jQuery(this).append('<em class="open-close">&nbsp;</em>')
        }), jQuery("ul.accordion, ul#magicat").accordionNew(), jQuery("ul.accordion li.active, ul#magicat li.active").each(function() {
            jQuery(this).children().next("div").css("display", "block")
        })

    /*  Cart  */
    function deleteCartInCheckoutPage() {
        return jQuery(".checkout-cart-index a.btn-remove2,.checkout-cart-index a.btn-remove").on("click", function(e) {
            return e.preventDefault(), confirm(confirm_content) ? void 0 : !1
        }), !1
    }
	 jQuery(".subDropdown")[0] && jQuery(".subDropdown").on("click", function() {
            jQuery(this).toggleClass("plus"), jQuery(this).toggleClass("minus"), jQuery(this).parent().find("ul").slideToggle()
        })
    /*  Top Cart */
    function slideEffectAjax() {
        jQuery(".top-cart-contain").mouseenter(function() {
            jQuery(this).find(".top-cart-content").stop(true, true).slideDown()
        }), jQuery(".top-cart-contain").mouseleave(function() {
            jQuery(this).find(".top-cart-content").stop(true, true).slideUp()
        })
    }

    function deleteCartInSidebar() {
        return is_checkout_page > 0 ? !1 : void jQuery("#cart-sidebar a.btn-remove, #mini_cart_block a.btn-remove").each(function() {})
    }

})


var isTouchDevice = "ontouchstart" in window || navigator.msMaxTouchPoints > 0;
jQuery(window).on("load", function() {
        isTouchDevice && jQuery("#nav a.level-top").on("click", function() {
            if ($t = jQuery(this), $parent = $t.parent(), $parent.hasClass("parent")) {
                if (!$t.hasClass("menu-ready")) return jQuery("#nav a.level-top").removeClass("menu-ready"), $t.addClass("menu-ready"), !1;
                $t.removeClass("menu-ready")
            }
        }), jQuery().UItoTop()
    }), jQuery(window).scroll(function() {
        jQuery(this).scrollTop() > 1 ? $("nav").addClass("sticky") : jQuery("nav").removeClass("sticky")
    }),
    /*  ToTop */
    function(e) {
        jQuery.fn.UItoTop = function(t) {
            var a = {
                    text: "",
                    min: 200,
                    inDelay: 600,
                    outDelay: 400,
                    containerID: "toTop",
                    containerHoverID: "toTopHover",
                    scrollSpeed: 1200,
                    easingType: "linear"
                },
                i = e.extend(a, t),
                n = "#" + i.containerID,
                s = "#" + i.containerHoverID;
            jQuery("body").append('<a href="#" id="' + i.containerID + '">' + i.text + "</a>"), jQuery(n).hide().on("click", function() {
                return jQuery("html, body").animate({
                    scrollTop: 0
                }, i.scrollSpeed, i.easingType), jQuery("#" + i.containerHoverID, this).stop().animate({
                    opacity: 0
                }, i.inDelay, i.easingType), !1
            }).prepend('<span id="' + i.containerHoverID + '"></span>').hover(function() {
                jQuery(s, this).stop().animate({
                    opacity: 1
                }, 600, "linear")
            }, function() {
                jQuery(s, this).stop().animate({
                    opacity: 0
                }, 700, "linear")
            }), jQuery(window).scroll(function() {
                var t = e(window).scrollTop();
                "undefined" == typeof document.body.style.maxHeight && jQuery(n).css({
                    position: "absolute",
                    top: e(window).scrollTop() + e(window).height() - 50
                }), t > i.min ? jQuery(n).fadeIn(i.inDelay) : jQuery(n).fadeOut(i.Outdelay)
            })
        }
    }(jQuery),
    jQuery.extend(jQuery.easing, {
        easeInCubic: function(e, t, a, i, n) {
            return i * (t /= n) * t * t + a
        },
        easeOutCubic: function(e, t, a, i, n) {
            return i * ((t = t / n - 1) * t * t + 1) + a
        }
    }),
	/* Accordian */	
	jQuery.extend(jQuery.easing, {
        easeInCubic: function(e, t, n, i, s) {
            return i * (t /= s) * t * t + n
        },
        easeOutCubic: function(e, t, n, i, s) {
            return i * ((t = t / s - 1) * t * t + 1) + n
        }
    }),
    function(e) {
        e.fn.extend({
            accordion: function() {
                return this.each(function() {})
            }
        })
    }(jQuery), jQuery(function(e) {
        e(".accordion").accordion(), e(".accordion").each(function() {
            var t = e(this).find("li.active");
            t.each(function(n) {
                e(this).children("ul").css("display", "block"), n == t.length - 1 && e(this).addClass("current")
            })
        })
    }),
	
	
	/* Responsive Nav */	
    function(e) {
        e.fn.extend({
            accordion: function(t) {
                var n = {
                        accordion: "true",
                        speed: 300,
                        closedSign: "[+]",
                        openedSign: "[-]"
                    },
                    i = e.extend(n, t),
                    s = e(this);
                s.find("li").each(function() {
                    0 != e(this).find("ul").size() && (e(this).find("a:first").after("<em>" + i.closedSign + "</em>"), "#" == e(this).find("a:first").attr("href") && e(this).find("a:first").on("click", function() {
                        return !1
                    }))
                }), s.find("li em").on("click", function() {
                    0 != e(this).parent().find("ul").size() && (i.accordion && (e(this).parent().find("ul").is(":visible") || (parents = e(this).parent().parents("ul"), visible = s.find("ul:visible"), visible.each(function(t) {
                        var n = !0;
                        parents.each(function(e) {
                            return parents[e] == visible[t] ? (n = !1, !1) : void 0
                        }), n && e(this).parent().find("ul") != visible[t] && e(visible[t]).slideUp(i.speed, function() {
                            e(this).parent("li").find("em:first").html(i.closedSign)
                        })
                    }))), e(this).parent().find("ul:first").is(":visible") ? e(this).parent().find("ul:first").slideUp(i.speed, function() {
                        e(this).parent("li").find("em:first").delay(i.speed).html(i.closedSign)
                    }) : e(this).parent().find("ul:first").slideDown(i.speed, function() {
                        e(this).parent("li").find("em:first").delay(i.speed).html(i.openedSign)
                    }))
                })
            }
        })
    }(jQuery),
    function(e) {
        e.fn.extend({
                accordionNew: function() {
                    return this.each(function() {
                        function t(t, i) {
                            e(t).parent(l).siblings().removeClass(s).children(c).slideUp(r), e(t).siblings(c)[i || o]("show" == i ? r : !1, function() {
                                e(t).siblings(c).is(":visible") ? e(t).parents(l).not(n.parents()).addClass(s) : e(t).parent(l).removeClass(s), "show" == i && e(t).parents(l).not(n.parents()).addClass(s), e(t).parents().show()
                            })
                        }
                        var n = e(this),
                            i = "accordiated",
                            s = "active",
                            o = "slideToggle",
                            c = "ul, div",
                            r = "fast",
                            l = "li";
                        if (n.data(i)) return !1;
                        e.each(n.find("ul, li>div"), function() {
                            e(this).data(i, !0), e(this).hide()
                        }), e.each(n.find("em.open-close"), function() {
                            e(this).on("click", function() {
                                return void t(this, o)
                            }), e(this).bind("activate-node", function() {
                                n.find(c).not(e(this).parents()).not(e(this).siblings()).slideUp(r), t(this, "slideDown")
                            })
                        });
                        var a = location.hash ? n.find("a[href=" + location.hash + "]")[0] : n.find("li.current a")[0];
                        a && t(a, !1)
                    })
                }
            }), e(function() {
                function t() {
                    var t = e('.navbar-collapse form[role="search"].active');
                    t.find("input").val(""), t.removeClass("active")
                }
                e('header, .navbar-collapse form[role="search"] button[type="reset"]').on("click keyup", function(n) {
                    console.log(n.currentTarget), (27 == n.which && e('.navbar-collapse form[role="search"]').hasClass("active") || "reset" == e(n.currentTarget).attr("type")) && t()
                }), e(document).on("click", '.navbar-collapse form[role="search"]:not(.active) button[type="submit"]', function(t) {
                    t.preventDefault();
                    var n = e(this).closest("form"),
                        i = n.find("input");
                    n.addClass("active"), i.focus()
                }), e(document).on("click", '.navbar-collapse form[role="search"].active button[type="submit"]', function(n) {
                    n.preventDefault();
                    var i = e(this).closest("form"),
                        s = i.find("input");
                    e("#showSearchTerm").text(s.val()), t()
                })
            })
          
    }(jQuery);





    