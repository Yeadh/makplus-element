<?php

if ( ! defined( 'ABSPATH' ) ) exit;

// get posts dropdown
function makplus_get_portfolio_dropdown_array($args = [], $key = 'ID', $value = 'post_title') {
  $options = [];
  $posts = get_posts($args);
  foreach ((array) $posts as $term) {
    $options[$term->{$key}] = $term->{$value};
  }
  return $options;
}

function makplus_add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'makplus-elements',
		[
			'title' => esc_html__( 'makplus Elements', 'makplus' ),
			'icon' => 'fa fa-plug',
		]
	);

}
add_action( 'elementor/elements/categories_registered', 'makplus_add_elementor_widget_categories' );

//Elementor init

class makplus_ElementorCustomElement {
 
   private static $instance = null;
 
   public static function get_instance() {
      if ( ! self::$instance )
         self::$instance = new self;
      return self::$instance;
   }
 
   public function init(){
      add_action( 'elementor/widgets/widgets_registered', array( $this, 'widgets_registered' ) );
   }


   public function widgets_registered() {
 
    // We check if the Elementor plugin has been installed / activated.
    if(defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base')){
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-banner.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-banner2.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-banner3.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-banner4.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-banner5.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-banner6.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-banner7.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-banner8.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-free.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-title.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-accordion.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-contact.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-counter.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-partner.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-map.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-products.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-productthumb.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-service.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-searchbox.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-testimonials.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-blog.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-cta.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-pricing.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-button.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-video.php');
        include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-newproduct.php');
        include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-featuredproduct.php');
        include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-newimages.php');
        include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-images.php');
        include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-images-no-filter.php');
        include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-video-no-filter.php');

      }
	}

}

makplus_ElementorCustomElement::get_instance()->init();