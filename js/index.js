jQuery(document).ready(function($) {  

  //woo effect
  new WOW().init();
  
  //tooltip
  $('#back-to-top').tooltip();
  
  // Set Sticky Header
  /*var $sticky = $('.header-container');
  $(window).scroll(function(){
    var scroll = $(window).scrollTop();
    if (scroll >= 100) $sticky.addClass('fixed');
    else $sticky.removeClass('fixed');
  });*/

  //back to top
  var $backToTop = $('#back-to-top').fadeIn();

  $(window).scroll(function () {
      if ($(this).scrollTop() > 600) {
          $backToTop.fadeIn();
      } else {
          $backToTop.fadeOut();
      }

      $('.google-play').addClass('wow animated bounceInUp');
      $('.mc-sub-header').addClass('wow animated bounceInDown');
  });

  // scroll body to 0px on click
  $backToTop.click(function () {
      $backToTop.tooltip('hide');
      $('body,html').animate({
          scrollTop: 0
      }, 800);
      return false;
  })

  /*Scrolls to the selected menu item on the page*/
  $(function() {
      $('a[href*=#]:not([href=#])').click(function() {
          if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

              var target = $(this.hash);
              target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
              if (target.length) {
                  $('html,body').stop().animate({
                      scrollTop: target.offset().top - 75
                  }, 1000);
                  return false;
              }
          }
      });
  });

  /********rest of the task********/
  var w= window.innerWidth;
  if(w<767){
     $('.index-btn-list').removeClass('pull-right');
  }

  $("[data-toggle=popover]").popover({
    html: true, 
    content: function() {
      return $('#popover-content').html();
    }
  });

  /*****facebook btn enabling*****/
  var fbButton = $('#join');
  fbButton.attr('disabled','disabled');

  $('body').on('click','#index-checkbox', function(){
    var $this= $(this);
    if($this.prop("checked") == true){
        $this.parent().siblings().removeAttr('disabled','disabled');
    }

    else if($this.prop("checked") == false){
        $this.parent().siblings().attr('disabled','disabled');
    }
  });

}); //end document ready
