<?php
/**
 * Genesis Sample.
 *
 * This file adds functions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://www.studiopress.com/
 */

// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );

// Setup Theme.
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

// Set Localization (do not remove).
add_action( 'after_setup_theme', 'genesis_sample_localization_setup' );
function genesis_sample_localization_setup(){
	load_child_theme_textdomain( 'genesis-sample', get_stylesheet_directory() . '/languages' );
}

// Add the helper functions.
include_once( get_stylesheet_directory() . '/lib/helper-functions.php' );

// Add Image upload and Color select to WordPress Theme Customizer.
require_once( get_stylesheet_directory() . '/lib/customize.php' );

// Include Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/output.php' );

// Add WooCommerce support.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php' );

// Add the required WooCommerce styles and Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php' );

// Add the Genesis Connect WooCommerce notice.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php' );

// Child theme (do not remove).
define( 'CHILD_THEME_NAME', 'Tuned WP' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.3.0' );

// Enqueue Scripts and Styles.
add_action( 'wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles' );
function genesis_sample_enqueue_scripts_styles() {

	// CSS
  wp_enqueue_style( 'fontawesome5', get_stylesheet_directory_uri() . '/lib/fontawesome5/css/fontawesome-all.min.css', array(), CHILD_THEME_VERSION );
  wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,300i,400,700,900', array(), CHILD_THEME_VERSION );
  wp_enqueue_style( 'slickslider', get_stylesheet_directory_uri() . '/lib/slickslider/slick.css', array(), "1.8.0" );
  wp_enqueue_style( 'tuned', get_stylesheet_directory_uri() . '/tuned.css', array(), CHILD_THEME_VERSION );
  wp_enqueue_style( 'child', get_stylesheet_directory_uri() . '/child.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );
  
  // JS
  //wp_enqueue_script( 'jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js', array( 'jquery' ), "1.12.1" ); // sample
  wp_enqueue_script( 'slickslider', get_stylesheet_directory_uri() . '/lib/slickslider/slick.min.js', array( 'jquery' ), "1.8.0" );
  wp_enqueue_script( 'child-js', get_stylesheet_directory_uri() . '/js/child.js', array( 'jquery' ), CHILD_THEME_VERSION );
  wp_enqueue_script( 'child-footer-js', get_stylesheet_directory_uri() . '/js/child-footer.js', array( 'jquery' ), CHILD_THEME_VERSION, true );

	if( class_exists('FLBuilderModel') && ( FLBuilderModel::is_builder_active() ) ) {
		wp_dequeue_script( 'child-js' );
		wp_dequeue_script( 'child-footer-js' );
	}

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'genesis-sample-responsive-menu', get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_localize_script(
		'genesis-sample-responsive-menu',
		'genesis_responsive_menu',
		genesis_sample_responsive_menu_settings()
	);

}

// Define our responsive menu settings.
function genesis_sample_responsive_menu_settings() {

	$settings = array(
		'mainMenu'          => __( 'Menu', 'genesis-sample' ),
		'menuIconClass'     => 'dashicons-before dashicons-menu',
		'subMenu'           => __( 'Submenu', 'genesis-sample' ),
		'subMenuIconsClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'       => array(
			'combine' => array(
				'.nav-primary',
				'.nav-header',
			),
			'others'  => array(),
		),
	);

	return $settings;

}


/** CHANGE ADMIN CSS **/
/** http://www.code-slap.com/4-space-tabs-in-textarea-editors/ **/
if ( !function_exists('base_admin_css') ) {
	function base_admin_css()
	{
		wp_enqueue_style('base-admin-css', get_stylesheet_directory_uri() .'/admin.css', false, '1.0', 'all');
	}
	add_action( 'admin_print_styles', 'base_admin_css' );
}


// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Add Accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom header.
add_theme_support( 'custom-header', array(
	'width'           => 600,
	'height'          => 160,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

// Add support for custom background.
add_theme_support( 'custom-background' );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Add support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );

// Add Image Sizes.
function eve_theme_setup() {
  add_image_size( 'featured-image', 720, 400, TRUE );
  add_image_size( 'team-featured-image', 246, 328, TRUE );
  add_image_size( 'testimonial-featured-image', 202, 202, FALSE );
  add_image_size( 'blog-featured-image1', 371, 280, TRUE );
  add_image_size( 'service-image2', 260, 200, TRUE );
  add_image_size( 'service-image4', 360, 200, TRUE );
}
add_action( 'after_setup_theme', 'eve_theme_setup' );


// Add Image Sizes to dropdown
function eve_custom_sizes( $sizes ) {
  return array_merge( $sizes, array(
      'service-image2' => __('Service 2 - Image'),
  ) );
}
add_filter( 'image_size_names_choose', 'eve_custom_sizes' );


// Rename primary and secondary navigation menus.
add_theme_support( 'genesis-menus', array( 'primary' => __( 'After Header Menu', 'genesis-sample' ), 'secondary' => __( 'Footer Menu', 'genesis-sample' ) ) );

// Reposition the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

// Reduce the secondary navigation menu to one level depth.
add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );
function genesis_sample_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

// Modify size of the Gravatar in the author box.
add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
function genesis_sample_author_box_gravatar( $size ) {
	return 90;
}

// Modify size of the Gravatar in the entry comments.
add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
function genesis_sample_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}


//* Remove the entry header markup (requires HTML5 theme support)
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

//* Remove the entry title (requires HTML5 theme support)
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );


//* Remove the ellipsis on the excerpt
function twp_excerpt_more( $more ) {
    return ''; // remove that ellipsis
}
add_filter( 'excerpt_more', 'twp_excerpt_more' );


/** SHORTCODE - DISPLAY TEAM **/
function twp_team( $atts ) {

  $a = shortcode_atts( array(
    'featured'         => 'yes',
    'link'             => 'yes',
    'show_department'  => 'no',
    'position_first'   => 'no',
    'count'            => '3',
  ), $atts );
  
  $a = array_map( 'trim', $a );
  $a = array_map( 'sanitize_text_field', $a );  

	$args = array(
  	'post_type'         => 'team',
  	'posts_per_page'    => (int) $a['count'],
  	'orderby'           => 'date',
  	'order'             => 'DESC',
		'post_status'       => array('publish') 
    	);

	if ( 'yes' === $a['featured'] ) {
    $args['meta_key']   = 'featured';
    $args['meta_value'] = '1';
	}
  
  ob_start();      
      
	// The Query
	$the_query = new WP_Query( $args );

	// The Loop
	if ( $the_query->have_posts() ) {
    echo '<div class="twp-team-list">';
		while ( $the_query->have_posts() ) {
			$the_query->the_post();

      if ( has_post_thumbnail( $the_query->post->ID ) ) { // only show if there's an image
      
        //var_dump( get_metadata('post', $the_query->post->ID) );
      
        $link = get_permalink( $the_query->post->ID );
        $name = get_the_title( $the_query->post->ID );
        $position = get_post_meta( $the_query->post->ID, 'position', true );
        $department = get_post_meta( $the_query->post->ID, 'department', true );
      
        if ( 'yes' === $a['featured'] ) {
          $img_url = get_the_post_thumbnail_url( $the_query->post->ID, 'team-featured-image' );
        } else {
          $img_url = get_the_post_thumbnail_url( $the_query->post->ID, 'full' );
        }         
              
        echo '<div class="twp-team-data" team-id="'.$the_query->post->ID.'">';
          
          if ( 'yes' === $a['link'] ) echo '<a href="'.$link.'">';
        
          echo '<div class="image-wrap" style="background-image: url('.$img_url.');">';
            echo '<div class="name-wrap">';
            
              $name_html = "<p class='name'>$name</p>";              
              $department_html = '';
              
              if ( 'yes' === $a['featured'] ) {
                if ( $department && 'yes' === $a['show_department'] ) $department_html = "<span class='department'>, $department</span>";                              
              } else {
                if ( $department && 'yes' === $a['show_department'] ) $department_html = "<span class='department'>$department</span>";             
              }
              
              
              if ( 'no' === $a['position_first'] ) {
                if ( $name ) echo $name_html;              
              }
              
              echo '<p class="position-department">';
                if ( $position )   echo "<span class='position'>$position</span>";                
                echo $department_html;             
              echo '</p>';              

              if ( 'yes' === $a['position_first'] ) {
                if ( $name ) echo $name_html;              
              }                            

            echo '</div>';                        
          echo '</div>';
          
          if ( 'yes' === $a['link'] ) echo '</a>';          
        
        echo '</div>';      
      }

		} // while
    echo '</div>';
	}
	/* Restore original Post Data */
	wp_reset_postdata();

  $output_string = ob_get_contents();
  ob_end_clean();
  return $output_string;
}
add_shortcode( 'twp_team', 'twp_team' );


/** SHORTCODE - DISPLAY TESTIMONIAL **/
function twp_testimonial( $atts ) {

  $a = shortcode_atts( array(
    'category'          => '', // slug, accepts comma delimited category slugs
    'count'             => '5',        
  ), $atts );
  
  $a = array_map( 'trim', $a );
  $a = array_map( 'sanitize_text_field', $a );  

	$args = array(
  	'post_type'         => 'testimonial',
  	'posts_per_page'    => (int) $a['count'],
  	'orderby'           => 'date',
  	'order'             => 'DESC',
		'post_status'       => array('publish') 
    	);

	if ( '' !== $a['category'] ) {
    $cat_array = explode( ',', $a['category'] ); // convert comma delimited into an array
    $cat_array = array_filter( $cat_array, 'strlen' ); // remove empty array values
  
    if ( !empty($cat_array) ) {
  		$args['tax_query'] = array(
  			array(
  				'taxonomy' => 'testimonial_category',
  				'field'    => 'slug',
  				'terms'    => $cat_array,
  			),
  		);    
    }
	}
  
  ob_start();      
      
	// The Query
	$the_query = new WP_Query( $args );

	// The Loop
	if ( $the_query->have_posts() ) {
    echo '<div class="twp-testimonial-main-wrap">';
      echo '<div class="twp-testimonial-arrow-wrap"><span class="twp-testimonial-arrow arrow-prev"></span></div>';
      echo '<div class="twp-testimonial-list">';
  		while ( $the_query->have_posts() ) {
  			$the_query->the_post();
        
        $content = $the_query->post->post_content; 
  
        if ( $content ) { // only show if there's content
        
          //var_dump( get_metadata('post', $the_query->post->ID) );
  
          $content = apply_filters( 'the_content', $content );      
          $name = get_the_title( $the_query->post->ID );      
          $the_img = get_the_post_thumbnail( $the_query->post->ID, 'testimonial-featured-image' );
          $position = get_post_meta( $the_query->post->ID, 'position_business', true );                 
                
          echo '<div class="twp-testimonial-data" testimonial-id="'.$the_query->post->ID.'">';
            echo '<div class="wrap1">';        
              if ( !empty($the_img) )  echo '<div class="image-wrap">'.$the_img.'</div>';          
              echo '<div class="content-wrap">'.$content.'</div>';          
              if ( !empty($name) )     echo '<div class="name-wrap"><span class="dash">- </span>'.$name.'</div>';
              if ( !empty($position) ) echo '<div class="position-wrap">'.$position.'</div>';
            echo '</div>';        
          echo '</div>';      
        }
  
  		} // while
      echo '</div>';
      echo '<div class="twp-testimonial-arrow-wrap"><span class="twp-testimonial-arrow arrow-next"></span></div>';
    echo '</div>'; // twp-testimonial-main-wrap
	}
	/* Restore original Post Data */
	wp_reset_postdata();

  $output_string = ob_get_contents();
  ob_end_clean();
  return $output_string;
}
add_shortcode( 'twp_testimonial', 'twp_testimonial' );


/** SHORTCODE - DISPLAY BLOG **/
function twp_blog( $atts ) {

  $a = shortcode_atts( array(
    'category'         => '', // slug, accepts comma delimited category slugs
    'count'            => '3',
    'style'            => '1',    
  ), $atts );
  
  $a = array_map( 'trim', $a );
  $a = array_map( 'sanitize_text_field', $a );  

	$args = array(
  	'post_type'         => 'post',
  	'posts_per_page'    => (int) $a['count'],
  	'orderby'           => 'date',
  	'order'             => 'DESC',
		'post_status'       => array('publish') 
    	);

	if ( '' !== $a['category'] ) {
    $cat_array = explode( ',', $a['category'] ); // convert comma delimited into an array
    $cat_array = array_filter( $cat_array, 'strlen' ); // remove empty array values
  
    if ( !empty($cat_array) ) {
  		$args['tax_query'] = array(
  			array(
  				'taxonomy' => 'category',
  				'field'    => 'slug',
  				'terms'    => $cat_array,
  			),
  		);    
    }
	}
  
  ob_start();      
      
	// The Query
	$the_query = new WP_Query( $args );

	// The Loop
	if ( $the_query->have_posts() ) {
    echo '<div class="twp-blog-list">';
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
      
      $content = $the_query->post->post_content; 

      if ( has_post_thumbnail( $the_query->post->ID ) ) { // only show if there's an image
      
      
      }

		} // while
    echo '</div>';
	}
	/* Restore original Post Data */
	wp_reset_postdata();

  $output_string = ob_get_contents();
  ob_end_clean();
  return $output_string;
}
add_shortcode( 'twp_blog', 'twp_blog' );
