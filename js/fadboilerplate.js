/*******************************************
 *  fadboilerplate.js
 *******************************************/

/*******************************************
 *  Helper Functions
 *******************************************/
function is_desktop() {
	var $indicator = $("#media-query-detector").height();
	if( $indicator == 3) {
		return true;
	} else {
		return false;
	}
}

function is_mobile() {
	var $indicator = $("#media-query-detector").height();
	if( $indicator < 3) {
		return true;
	} else {
		return false;
	}
}

function is_tablet() {
	var $indicator = $("#media-query-detector").height();
	if( $indicator == 2) {
		return true;
	} else {
		return false;
	}
}

function is_phone() {
	var $indicator = $("#media-query-detector").height();
	if( $indicator == 1) {
		return true;
	} else {
		return false;
	}
}

// Handles flash of unstyled content.
function fouc() {
  $('html').removeClass('no-js').addClass('js');
}

/*******************************************
 *  Custom Functions for the theme
 *******************************************/

function menu_scroll_background() {

  $(window).scroll(function() {
    var scrollTop = $(window).scrollTop();
    var $site_header = $(".site-header");

    if (scrollTop > 0) {
      $site_header.removeClass("top");
    } else {
      $site_header.addClass("top");
    }
  });
}

function match_heights_init() {
  /**
  * Match Height Calls
  * use attr data-mh="group-name" to group
  */
  var matchHeightTitle  = $(".match-height-title");
  var matchHeightContent = $(".match-height-content");

  if( $(".match-height-row").length ) {
    $(".match-height-row").matchHeight({
        byRow: true
    });
  }

  if( $(".match-height").length ) {
    $(".match-height").matchHeight({
        byRow: false
    });
  }

  if( $(".match-height-rows").length ) {
    $(".match-height-rows").matchHeight({
        byRow: true
    });
  }

  if( matchHeightTitle.length ) {
    matchHeightTitle.matchHeight({
        byRow: true
    });
  }

  if( matchHeightContent.length ) {
    matchHeightContent.matchHeight({
        byRow: true
    });
  }
}

function anchor_smooth_scrolling() {
  var spacing = 86;
  $('a[href*=\\#]:not([href=\\#])').click(function() {
      if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') || location.hostname == this.hostname) {

          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
             if (target.length) {
               $('html,body').animate({
                   scrollTop: target.offset().top - spacing
              }, 1000);
              return false;
          }
      }
  });

  if(window.location.hash) {
    $('html,body').animate({
      scrollTop: $(window.location.hash).offset().top - spacing
    }, 1000);
  }
}

function backtotop() {
  if ($('.back-to-top').length) {
    var scrollTrigger = 0, // px
        backToTop = function () {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                $('.back-to-top').addClass('show');
            } else {
                $('.back-to-top').removeClass('show');
            }
        };

    backToTop();
    $(window).on('scroll', function () {
        backToTop();
    });

    var lastScrollTop = 0;
    $(window).scroll(function(event){
      var st = $(this).scrollTop();
      if (st > lastScrollTop){
         // downscroll code
         $('.back-to-top').removeClass('bottom scroll-prev');
         $('.back-to-top').addClass('scroll-next');
      } else {
        // upscroll code
        // $('#back-to-top').addClass('bottom');
      }
      lastScrollTop = st;


      var $win = $(window);
      var $doc = $(document);
      if ( $win.scrollTop() == $doc.height() - $win.height() ) {
        $('.back-to-top').addClass('bottom scroll-prev');
        $('.back-to-top').removeClass('scroll-next');
      }
    });

    // Click to scroll down
    $('body').on('click', ".scroll-next", function (e) {
        var vheight = $(window).height();
        $('html, body').animate({
          scrollTop: (Math.floor($(window).scrollTop() / vheight)+1) * vheight
        }, 500);
        e.preventDefault();
        e.stopPropagation();
    });

    // Click to scroll up
    $('body').on('click', ".scroll-prev", function (e) {
        $('html,body').animate({
            scrollTop: 0
        }, 700);
        e.preventDefault();
        e.stopPropagation();
    });

  }
}

function slick_slider() {
  if ($('.gallery-slider').length) {
    $('.gallery-slider').slick({
      autoplay: true,
      autoplaySpeed: 4000,
      arrows: true,
      dots: true,
      fade: true,
      pauseOnHover: false
    });
  }
}

// ScrollMagic And GreenSock Animation
function scrollMagicGsap() {

  var n = new ScrollMagic.Controller;
  $('.fademein').each(function() {

    var tween = TweenMax.from (
      this, 0.75, {autoAlpha:0, y:100, delay:0.1, ease: Power1.easeInOut}
    );

    new ScrollMagic.Scene({
      triggerElement: this,
      reverse: false,
      triggerHook: 1.3
    })
    .setTween(tween)
    .addTo(n);

  });

}

/**
 * On Loads
 */
$(document).ready(function() {
  fouc();
  menu_scroll_background();
  match_heights_init();
  anchor_smooth_scrolling();
  backtotop();
  // slick_slider();
  scrollMagicGsap();
});

