<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Banner
class makplus_Widget_Banner2 extends Widget_Base {
 
   public function get_name() {
      return 'banner 2';
   }
 
   public function get_title() {
      return esc_html__( 'Banner 2', 'makplus' );
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
            'label' => __( 'Button', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Browse Projects','makplus')
         ]
      );

      $this->add_control(
         'btn-url',
         [
            'label' => __( 'URL', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '#'
         ]
      );

		$this->add_control(
           'video-background',
           [
               'label' => __( 'Video Image', 'uhu' ),
               'type' => \Elementor\Controls_Manager::MEDIA,
               'default' => [
                   'url' => \Elementor\Utils::get_placeholder_image_src(),
               ],
           ]
       );
       $this->add_control(
           'video-url',
           [
               'label' => __( 'Video URL', 'uhu' ),
               'type' => \Elementor\Controls_Manager::TEXT,
               'default' => '#'
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
                              <h2 class="wow fadeInDown" data-wow-delay="0.2s"><?php echo  esc_html($settings['title']) ?></h2>
                              <p class="wow fadeInUp" data-wow-delay="0.2s"><?php echo esc_html( $settings['description'] ) ?></p>
                              <a href="<?php echo esc_url($settings['btn-url'])?>" class="btn wow fadeInUp" data-wow-delay="0.4s"><?php echo esc_html($settings['btn-text']) ?></a>
                          </div>
                      </div>
                      <div class="col-lg-6 d-none d-lg-block">
                          <div class="slider-img position-relative text-right">
                              <div class="video-thumb">
                                  <img src="<?php echo esc_url($settings['video-background']['url']); ?>" alt="<?php echo esc_attr($settings['title']); ?>">
                                  <a href="<?php echo esc_url($settings['video-url']); ?>" class="pulse popup-video"><i class="fas fa-play"></i></a>
                              </div>
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

Plugin::instance()->widgets_manager->register_widget_type( new makplus_Widget_Banner2 );