(function($) {
	jQuery(document).ready(function(){
  
    /* https://github.com/louisremi/jquery-smartresize */
    /* debulked onresize handler */
    function on_resize(c,t){onresize=function(){clearTimeout(t);t=setTimeout(c,100)};return c};
       
    // Insert close X
    jQuery( '.tuned-header-law5 .fl-module-menu .fl-menu .menu' ).prepend( '<li class="menu-close"><a href="#"><i class="fas fa-times"></i></a></li>' );    

    // On Resize
    on_resize(function() {

      // For Sliding main menu, remove Beaver click event
      jQuery( '.tuned-header-law5 .fl-menu' ).off( 'click' ).removeClass( 'fl-active' );
      
      //if ( jQuery( '.section-feature5' ).length > 0 && jQuery(document).scrollTop() == 0 ) {
      //  var the_height = jQuery( '.section-feature5' ).height();
      //} else {
        var the_height = jQuery(document).height();        
      //}
      jQuery( '.tuned-header-law5 .fl-module-menu .fl-menu .menu' ).css( 'height', the_height + 'px' );

      
    }); // on_resize


    // On scroll 
    jQuery(document).scroll(function() {
    
      // If active, hide menu on scroll
      var fl_menu = jQuery( '.tuned-header-law5 .fl-module-menu .fl-menu' );
      if ( fl_menu.hasClass( 'fl-active' ) ) {
        jQuery( '.tuned-header-law5 .fl-menu-mobile-toggle' ).trigger( 'click' );          
      }      

    });
    
    
    // Slide main menu 
    jQuery(document).on( 'click', '.tuned-header-law5 .fl-menu-mobile-toggle', function (event) {      
      
      var fl_menu = jQuery(this).parents( '.fl-menu' );
      var the_menu = fl_menu.find( '.menu' );
      
      if ( fl_menu.hasClass( 'fl-active' ) ) {
        var the_menu_width = the_menu.width();
      
        // active to inactive        
        the_menu.animate({
          right: '-' + the_menu_width + 'px'
          }, 300, function() {
            // Animation complete.
            the_menu.hide();
        });      
      } else {
        // inactive to active
        the_menu.show();
        the_menu.animate({
          right: '0'
        }, 400 );        
      }
      
      fl_menu.toggleClass( 'fl-active' );
      
    });    

    // Nav menu, close X
    jQuery(document).on( 'click touchstart', '.tuned-header-law5 .menu-close a', function (event) {
      event.stopPropagation();
      event.preventDefault();
      
      if ( event.handled !== true ) {
      
        jQuery(this).parents( '.fl-menu' ).find( '.fl-menu-mobile-toggle' ).trigger( 'click' );
  
        event.handled = true;
      } else {
        return false;
      }        
      
    });
    
    
    // Slide sub-menu 
    jQuery(document).on( 'click touchstart', '.tuned-header-law5 .fl-has-submenu .fl-menu-toggle', function (event) {      
      event.stopPropagation();
      event.preventDefault();
      
      if ( event.handled !== true ) {
      
        jQuery(this).parent( '.fl-has-submenu-container' ).parent( '.fl-has-submenu' ).children( '.sub-menu' ).slideToggle();
  
        event.handled = true;
      } else {
        return false;
      }
      
    });    
     

    // Trigger resize manually on first load
    jQuery(window).trigger('resize');
  
  });
})(jQuery);