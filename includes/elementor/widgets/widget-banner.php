<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Banner
class makplus_Widget_Banner extends Widget_Base {
 
   public function get_name() {
      return 'banner';
   }
 
   public function get_title() {
      return esc_html__( 'Banner 1', 'makplus' );
   }
 
   public function get_icon() { 
        return 'eicon-slider-video';
   }
 
   public function get_categories() {
      return [ 'makplus-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'banner_section',
         [
            'label' => esc_html__( 'Banner 1', 'makplus' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
      'banner_image',
        [
          'label' => __( 'Banner image', 'makplus' ),
          'type' => \Elementor\Controls_Manager::MEDIA,
          'default' => [
            'url' => get_template_directory_uri().'/images/slider_bg01.jpg',
          ],
        ]
      );

      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Digital Product Marketplace Create Your Business','makplus')
         ]
      );

      $this->add_control(
         'description',
         [
            'label' => __( 'Description', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __('Most powerful, & customizable template for Easy Digital Downloads Products','makplus')
         ]
      );
      

      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
    // get our input from the widget settings.       
    $settings = $this->get_settings_for_display(); ?>

    <section class="slider-area slider-bg" style="background-image: url(<?php echo esc_url($settings['banner_image']['url']) ?>)">
          <div class="container">
              <div class="row justify-content-center">
                  <div class="col-xl-7 col-lg-10">
                      <div class="slider-content text-center mb-45">
                          <h2><?php echo $settings['title'] ?></h2>
                          <p><?php echo esc_html( $settings['description'] ) ?></p>
                      </div>
                  </div>
              </div>
              <div class="row justify-content-center">
                  <div class="col-xl-8 col-lg-10">

                    <div class="slider-search-form">
                      <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
                          <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
                          <input type="search" class="search-field" placeholder="Search Your Products..." value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ); ?>" />
                        <?php
                          $makplus_cat_dropdown_args = array(
                              'show_option_all' => __( 'Any Category' ),
                              'taxonomy' => 'product_cat',
                              'class' => 'selected',
                            );
                          wp_dropdown_categories( $makplus_cat_dropdown_args );
                        ?>
                        <button type="submit" ><?php echo esc_html__( 'Search Now', 'makplus' ) ?></button>
                        <input type="hidden" name="post_type" value="product" />
                      </form>

                        <div class="text-center">
                          <p class="text-white"><?php echo  esc_html('23233').esc_html__( ' Total Products', 'makplus' ) ?> | <?php echo esc_html('23233').esc_html__( ' Happy Customars', 'makplus' ) ?></p>
                        </div>

                      </div>
                  </div>
              </div>

          </div>
      </section>
      <?php
   }
}

Plugin::instance()->widgets_manager->register_widget_type( new makplus_Widget_Banner );