<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Banner 3
class makplus_Widget_Banner3 extends Widget_Base {
 
   public function get_name() {
      return 'banner3';
   }
 
   public function get_title() {
      return esc_html__( 'Banner 3', 'makplus' );
   }
 
   public function get_icon() { 
        return 'eicon-slider-video';
   }
 
   public function get_categories() {
      return [ 'makplus-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'banner_3_section',
         [
            'label' => esc_html__( 'Banner 3', 'makplus' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
      'banner_image',
        [
          'label' => __( 'Banner 3 image', 'makplus' ),
          'type' => \Elementor\Controls_Manager::MEDIA,
          'default' => [
            'url' => get_template_directory_uri().'/images/slider_bg03.jpg',
          ],
        ]
      );
      $this->add_control(
      'image',
        [
          'label' => __( 'Banner 3 image', 'makplus' ),
          'type' => \Elementor\Controls_Manager::MEDIA,
          'default' => [
            'url' => get_template_directory_uri().'/images/slider_img.png',
          ],
        ]
      );

      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Digital Marketplace For Themes & Plugins','makplus')
         ]
      );

      $this->add_control(
         'description',
         [
            'label' => __( 'Description', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __('New Products on the Marketplace.Your dream site download!','makplus')
         ]
      );

      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
      $settings = $this->get_settings_for_display(); ?>

      <!-- slider-area -->
      <section class="slider-area t-slider-bg fix" style="background-image: url(<?php echo esc_url($settings['banner_image']['url']) ?>)">
          <div class="container">
              <div class="third-slider-wrap">
                  <div class="row align-items-center">
                      <div class="col-xl-6 col-lg-7">
                          <div class="slider-content s-slider-content t-slider-content">
                            <h2><?php echo $settings['title'] ?></h2>
                            <p><?php echo esc_html( $settings['description'] ) ?></p>
                              <div class="s-slider-search-form t-slider-search-form wow fadeInUp" data-wow-delay="0.6s">
                                <form action="<?php echo esc_url(home_url( '/' )); ?>">
                                  <input type="text" placeholder="<?php echo esc_attr_x( 'Search what your need...', 'placeholder', 'makplus' ); ?>">
                                  <button><i class="fas fa-search"></i></button>
                                </form>
                              </div>
                          </div>
                      </div>
                      <div class="col-xl-6 col-lg-5 d-none d-lg-block">
                          <div class="t-slider-img text-right wow fadeInRight" data-wow-delay="0.4s">
                              <img src="<?php echo esc_url($settings['image']['url']) ?>" alt="img">
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- slider-area-end -->
      <?php
   }
 
}

Plugin::instance()->widgets_manager->register_widget_type( new makplus_Widget_Banner3 );