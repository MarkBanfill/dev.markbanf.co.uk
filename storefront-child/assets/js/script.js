jQuery(document).ready(function($) {

  //Initialise Animate On Scroll (http://michalsnik.github.io/aos/)
  AOS.init();

  $('button.menu-toggle').click(function(){
    if ($('nav.main-navigation').hasClass('toggled')) {
      var scrollPosition = $(window).scrollTop();
      if (scrollPosition < 50) {
        setTimeout(function(){
          $('body.home .site-header').css('background-color', 'inherit');
        }, 800);
      }
    }
    else {
      $('body.home .site-header').css('background-color', '#eee');
    }
  })

  $(window).scroll(function(){
    var scrollHeight = $(window).height();
  	var scrollPosition = $(window).scrollTop();
  	if (scrollPosition > 1) {
      $("body.home .site-header").addClass("shrunk");
  	}
    else {
      $("body.home .site-header").removeClass("shrunk");
    }
    //$("body.home .site-header").css("background", "rgba(238,238,238," + $(window).scrollTop() / $('.sa-slider').height()*5 + ")");
    $(".slider-text").css("transform", "translate(-50%, 0) scale(" + (1 - $(window).scrollTop() / $('.ptwa').height()/5) + ")");
    $(".ptwa").css("opacity", 1 - $(window).scrollTop() / $('.ptwa').height());
  });

  // Force window scroll (needs timeout to work properly)
	$(window).scrollTop(1);
  setTimeout(function() {
		$(window).scrollTop(0);
  }, 200);

  $('li.product-category').mouseover(function(){
    $('.category-description p').text($(this).find('div.product-category-description').text());
  })
  $('li.product-category').mouseout(function(){
    $('.category-description p').text('Most of my work involves flowers, animals and beautiful scenery');
  })

  // Smooth scrolling down arrow
  var scrollLink = $('.downbounce');
  scrollLink.click(function(e) {
    e.preventDefault();
    $('body,html').animate({
      scrollTop: $(this.hash).offset().top
    }, 1000 );
  });

  if ( $('body').is('.home') ) {

    // Slideshow
    $('.ptwa .gallery > .gallery-item:gt(0)').hide();

  	function showNextSlide() {
  		$('.ptwa .gallery > .gallery-item:first')
  			.fadeOut(2000)
  			.next()
  			.fadeIn(2000)
  			.end()
  			.appendTo('.ptwa .gallery');
  	};

  	var interval;
  	interval = setInterval(showNextSlide, 10000);

  }

});
