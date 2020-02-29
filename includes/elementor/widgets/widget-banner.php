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
         'title',
         [
            'label' => __( 'Title', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __('Create & Manage Team Matches','makplus')
         ]
      );

      $this->add_control(
         'description',
         [
            'label' => __( 'Description', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __('Find technology people for digital projects in public sector and Find individual specialist develop researcher.','makplus')
         ]
      );
      
      $this->add_control(
         'btn-text',
         [
            'label' => __( 'Description', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __('Find technology people for digital projects in public sector and Find individual specialist develop researcher.','makplus')
         ]
      );
      
      $this->add_control(
         'btn-url',
         [
            'label' => __( 'Description', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __('Find technology people for digital projects in public sector and Find individual specialist develop researcher.','makplus')
         ]
      );



      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
    // get our input from the widget settings.       
    $settings = $this->get_settings_for_display(); ?>
     <!-- slider-area -->
      <section class="slider-area slider-bg">
          <div class="container">
              <div class="slider-wrap">
                  <div class="row align-items-center">
                      <div class="col-lg-6">
                          <div class="slider-content">
                              <h2 class="wow fadeInDown" data-wow-delay="0.2s"><?php echo $settings['title'] ?></h2>
                              <p class="wow fadeInUp" data-wow-delay="0.2s"><?php echo esc_html( $settings['description'] ) ?></p>
                              <a href="#" class="btn wow fadeInUp" data-wow-delay="0.4s">Browse Projects</a>
                          </div>
                      </div>
                      <div class="col-lg-6 d-none d-lg-block">
                          <div class="slider-img position-relative text-right">
                              <img src="<?php echo get_template_directory_uri() ?>/images/slider_img.png" class="slider-main-img" alt="">
                              <img src="<?php echo get_template_directory_uri() ?>/images/slider_icon01.png" alt="" class="slider-animation-icon wow rollIn" data-wow-delay="0.8s">
                              <img src="<?php echo get_template_directory_uri() ?>/images/slider_icon02.png" alt="" class="slider-animation-icon wow zoomIn" data-wow-delay="0.4s">
                              <img src="<?php echo get_template_directory_uri() ?>/images/slider_icon03.png" alt="" class="slider-animation-icon wow fadeInUp" data-wow-delay="0.8s">
                              <img src="<?php echo get_template_directory_uri() ?>/images/slider_icon04.png" alt="" class="slider-animation-icon wow fadeInUp" data-wow-delay="0.8s">
                              <img src="<?php echo get_template_directory_uri() ?>/images/slider_icon05.png" alt="" class="slider-animation-icon wow fadeInRight" data-wow-delay="0.8s">
                              <img src="<?php echo get_template_directory_uri() ?>/images/slider_icon06.png" alt="" class="slider-animation-icon wow fadeInDown" data-wow-delay="0.8s">
                              <img src="<?php echo get_template_directory_uri() ?>/images/slider_icon07.png" alt="" class="slider-animation-icon wow fadeInRight" data-wow-delay="0.8s">
                              <img src="<?php echo get_template_directory_uri() ?>/images/slider_icon08.png" alt="" class="slider-animation-icon wow fadeInRight" data-wow-delay="0.8s">
                              <img src="<?php echo get_template_directory_uri() ?>/images/slider_icon09.png" alt="" class="slider-animation-icon wow rollIn" data-wow-delay="0.8s">
                              <img src="<?php echo get_template_directory_uri() ?>/images/slider_icon10.png" alt="" class="slider-animation-icon wow fadeInDown" data-wow-delay="0.8s">
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="slider-img-ellipse"><img src="<?php echo get_template_directory_uri() ?>/images/slider_shape.png" class="rotateme" alt=""></div>
      </section>
      <!-- slider-area-end -->

      <?php
   }
}

Plugin::instance()->widgets_manager->register_widget_type( new makplus_Widget_Banner );