(function($) {
	jQuery(document).ready(function(){        

      
    // Setup testimonial slider
    jQuery('.section-testimonial .twp-testimonial-list').slick({
      slidesToShow: 1,
      autoplaySpeed: 6000,
      //autoplay: true,
      arrows: false,
      fade: false,      
      dots: true,
      adaptiveHeight: false,
      infinite: true,  
    });
    
    // Specific adjustments for T3
    jQuery('.section-testimonial3 .twp-testimonial-list').slick('slickSetOption', {
      slidesToShow: 3,
      slidesToScroll: 3,      
      dots: false,
      adaptiveHeight: true,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true
          }
        }      
      ]
    }, true);   
    

    // Testimonial arrow - prev
    jQuery(document).on('click touchstart', '.twp-testimonial-arrow.arrow-prev', function (event) {
      event.stopPropagation();
      event.preventDefault();
      
      if ( event.handled !== true ) {
        var main_wrap = jQuery( this ).parents( '.twp-testimonial-main-wrap' );
        var parent_slider = main_wrap.find( '.twp-testimonial-list' ).slick( 'slickPrev' );
  
        event.handled = true;
      } else {
        return false;
      }        
      
    });
    
    // Testimonial arrow - next
    jQuery(document).on('click touchstart', '.twp-testimonial-arrow.arrow-next', function (event) {
      event.stopPropagation();
      event.preventDefault();
      
      if ( event.handled !== true ) {
        var main_wrap = jQuery( this ).parents( '.twp-testimonial-main-wrap' );
        var parent_slider = main_wrap.find( '.twp-testimonial-list' ).slick( 'slickNext' );
  
        event.handled = true;
      } else {
        return false;
      }        
      
    });    
        
       
  
  });
})(jQuery);