/**
* Template Name: Selecao - v2.3.1
* Template URL: https://bootstrapmade.com/selecao-bootstrap-template/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/
!(function($) {
  "use strict";

  // Smooth scroll for the navigation menu and links with .scrollto classes
  var scrolltoOffset = $('#header').outerHeight() - 1;
  $(document).on('click', '.nav-menu a, .mobile-nav a, .scrollto', function(e) {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      if (target.length) {
        e.preventDefault();

        var scrollto = target.offset().top - scrolltoOffset;

        if ($(this).attr("href") == '#header') {
          scrollto = 0;
        }

        $('html, body').animate({
          scrollTop: scrollto
        }, 1500, 'easeInOutExpo');

        if ($(this).parents('.nav-menu, .mobile-nav').length) {
          $('.nav-menu .active, .mobile-nav .active').removeClass('active');
          $(this).closest('li').addClass('active');
        }

        if ($('body').hasClass('mobile-nav-active')) {
          $('body').removeClass('mobile-nav-active');
          $('.mobile-nav-toggle i').toggleClass('icofont-navigation-menu icofont-close');
          $('.mobile-nav-overly').fadeOut();
        }
        return false;
      }
    }
  });

  // Activate smooth scroll on page load with hash links in the url
  $(document).ready(function() {
    if (window.location.hash) {
      var initial_nav = window.location.hash;
      if ($(initial_nav).length) {
        var scrollto = $(initial_nav).offset().top - scrolltoOffset;
        $('html, body').animate({
          scrollTop: scrollto
        }, 1500, 'easeInOutExpo');
      }
    }
  });

  // Mobile Navigation
  if ($('.nav-menu').length) {
    var $mobile_nav = $('.nav-menu').clone().prop({
      class: 'mobile-nav d-lg-none'
    });
    $('body').append($mobile_nav);
    $('body').prepend('<button type="button" class="mobile-nav-toggle d-lg-none"><i class="icofont-navigation-menu"></i></button>');
    $('body').append('<div class="mobile-nav-overly"></div>');

    $(document).on('click', '.mobile-nav-toggle', function(e) {
      $('body').toggleClass('mobile-nav-active');
      $('.mobile-nav-toggle i').toggleClass('icofont-navigation-menu icofont-close');
      $('.mobile-nav-overly').toggle();
    });

    $(document).on('click', '.mobile-nav .drop-down > a', function(e) {
      e.preventDefault();
      $(this).next().slideToggle(300);
      $(this).parent().toggleClass('active');
    });

    $(document).click(function(e) {
      var container = $(".mobile-nav, .mobile-nav-toggle");
      if (!container.is(e.target) && container.has(e.target).length === 0) {
        if ($('body').hasClass('mobile-nav-active')) {
          $('body').removeClass('mobile-nav-active');
          $('.mobile-nav-toggle i').toggleClass('icofont-navigation-menu icofont-close');
          $('.mobile-nav-overly').fadeOut();
        }
      }
    });
  } else if ($(".mobile-nav, .mobile-nav-toggle").length) {
    $(".mobile-nav, .mobile-nav-toggle").hide();
  }

  // Navigation active state on scroll
  var nav_sections = $('section');
  var main_nav = $('.nav-menu, #mobile-nav');

  // $(window).on('scroll', function() {
  //   var cur_pos = $(this).scrollTop() + 200;

  //   nav_sections.each(function() {
  //     var top = $(this).offset().top,
  //       bottom = top + $(this).outerHeight();

  //     if (cur_pos >= top && cur_pos <= bottom) {
  //       if (cur_pos <= bottom) {
  //         main_nav.find('li').removeClass('active');
  //       }
  //       main_nav.find('a[href="#' + $(this).attr('id') + '"]').parent('li').addClass('active');
  //     }
  //     if (cur_pos < 300) {
  //       $(".nav-menu ul:first li:first").addClass('active');
  //     }
  //   });
  // });

  // Toggle .header-scrolled class to #header when page is scrolled
  $(window).scroll(function() {
    if ($(this).scrollTop() > 100) {
      $('#header').addClass('header-scrolled');
    } else {
      $('#header').removeClass('header-scrolled');
    }
  });

  if ($(window).scrollTop() > 100) {
    $('#header').addClass('header-scrolled');
  }

  // Intro carousel
  var heroCarousel = $("#heroCarousel");

  heroCarousel.on('slid.bs.carousel', function(e) {
    $(this).find('h2').addClass('animate__animated animate__fadeInDown');
    $(this).find('p, .btn-get-started').addClass('animate__animated animate__fadeInUp');
  });

  // Back to top button
  $(window).scroll(function() {
    if ($(this).scrollTop() > 100) {
      $('.back-to-top').fadeIn('slow');
    } else {
      $('.back-to-top').fadeOut('slow');
    }
  });

  $('.back-to-top').click(function() {
    $('html, body').animate({
      scrollTop: 0
    }, 1500, 'easeInOutExpo');
    return false;
  });

  // Porfolio isotope and filter
  $(window).on('load', function() {
    var portfolioIsotope = $('.portfolio-container').isotope({
      itemSelector: '.portfolio-item'
    });

    $('#portfolio-flters li').on('click', function() {
      $("#portfolio-flters li").removeClass('filter-active');
      $(this).addClass('filter-active');

      portfolioIsotope.isotope({
        filter: $(this).data('filter')
      });
      aos_init();
    });

    // Initiate venobox (lightbox feature used in portofilo)
    $(document).ready(function() {
      $('.venobox').venobox();
    });
  });

  // Testimonials carousel (uses the Owl Carousel library)
  $(".testimonials-carousel").owlCarousel({
    autoplay: true,
    dots: true,
    loop: true,
    responsive: {
      0: {
        items: 1
      },
      768: {
        items: 2
      },
      900: {
        items: 3
      }
    }
  });

  // Portfolio details carousel
  $(".portfolio-details-carousel").owlCarousel({
    autoplay: true,
    dots: true,
    loop: true,
    items: 1
  });

  // Init AOS
  function aos_init() {
    AOS.init({
      duration: 1000,
      easing: "ease-in-out",
      once: true,
      mirror: false
    });
  }
  $(window).on('load', function() {
    aos_init();
  });

})(jQuery);
$('.form').find('input, textarea').on('keyup blur focus', function (e) {
  var $this = $(this),
      label = $this.prev('label');
      if (e.type === 'keyup') {
          if ($this.val() === '') {
          label.removeClass('active highlight');
      } else {
          label.addClass('active highlight');
      }
  } else if (e.type === 'blur') {
      if( $this.val() === '' ) {
          label.removeClass('active highlight'); 
          } else {
          label.removeClass('highlight');   
          }   
  } else if (e.type === 'focus') {
      if( $this.val() === '' ) {
          label.removeClass('highlight'); 
          } 
      else if( $this.val() !== '' ) {
          label.addClass('highlight');
          }
  }
  });
  $('.tab a').on('click', function (e) {
  e.preventDefault();
  $(this).parent().addClass('active');
  $(this).parent().siblings().removeClass('active');
  target = $(this).attr('href');
  $('.tab-content > div').not(target).hide();
  $(target).fadeIn(600);
  });
  // Add Asterisk On Required Field
  $('input').each(function () {
      if ($(this).attr('required') === 'required') {
          $(this).before('<span class="asterisk">*</span>');
      }
  });
  // Convert Password Field To Text Field On Hover
  var passField = $('.showpass');
  var passField_2 = $('.showpass-2');
  $('.show-pass').hover(function () {
      passField.attr('type', 'text');
  }, function () {
      passField.attr('type', 'password');
  });
  $('.show-pass-2').hover(function () {
      passField_2.attr('type', 'text');
  }, function () {
      passField_2.attr('type', 'password');
  });
  //validator
  var focus, length ;
  function validte(focus, length) {
      if (focus.val().length < length ) {
          focus.css('border-bottom', '2px solid #f00').parent().find('.custom_alert').fadeIn(200);
      } else {
          focus.css('border-bottom', '2px solid #080').parent().find('.custom_alert').fadeOut(200);
      }
  }
  $('.username').blur(function () {
      validte($('.username'), 4); 
  });
  $('.email').blur(function () {
      validte($('.email'), 4); 
  });
  $('.password').blur(function () {
      validte($('.password'), 6); 
  });
  $('.password2').blur(function () {
      validte($('.password2'), 4); 
  });
  $('.phone').blur(function () {
      validte($('.phone'), 8); 
  });
  $('.username_login').blur(function () {
      validte($('.username_login'), 4); 
  });
  $('.password_login').blur(function () {
      validte($('.password_login'), 6); 
  });
  $('.comment').blur(function () {
      validte($('.comment'), 8); 
  });