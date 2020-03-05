<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// CTA
class Makplus_Widget_CTA extends Widget_Base {
 
   public function get_name() {
      return 'cta';
   }
 
   public function get_CTA() {
      return esc_html__( 'Call To Action', 'makplus' );
   }
 
   public function get_icon() { 
        return 'eicon-site-CTA';
   }
 
   public function get_categories() {
      return [ 'makplus-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'cta_section',
         [
            'label' => esc_html__( 'Call To Action', 'makplus' ),
            'type' => Controls_Manager::SECTION,
            'default' => __('Featured Tranding of the week','makplus')
         ]
      );


      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Get Our App From App Store','makplus')
         ]
      );

      $this->add_control(
         'desc',
         [
            'label' => __( 'Description', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __('Online marketplace every hour of every day across e-commerce where product service information provided multiple third parties.','makplus')
         ]
      );


      $button = new \Elementor\Repeater();

      $button->add_control(
         'title',
         [
            'label' => __( 'Choose Photo', 'makplus' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => __('App Store','makplus')
         ]
      );

      $button->add_control(
         'url',
         [
            'label' => __( 'Choose Photo', 'makplus' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => '#',
         ]
      );

      $this->add_control(
         'btn_list',
         [
            'label' => __( 'Buttons', 'makplus' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $button->get_controls()
         ]
      );

      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display(); ?>

      <!-- download-area -->
      <section class="download-area">
          <div class="container">
              <div class="row justify-content-center">
                  <div class="col-xl-8">
                      <div class="section-title text-center white-title mb-45">
                          <h2><?php echo esc_html($settings['title']); ?></h2>
                          <p><?php echo esc_html($settings['desc']); ?></p>
                      </div>
                      <div class="download-btn text-center">
                        <?php foreach( $settings['btn_list'] as $index => $btn ) { ?>
                          <a href="<?php echo esc_url($btn['url']); ?>" class="btn"><i class="fab fa-apple"></i><?php echo esc_html($btn['title']); ?></a>
                        <?php } ?>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- download-area-end -->
      <?php
   }
 
}

Plugin::instance()->widgets_manager->register_widget_type( new Makplus_Widget_CTA );