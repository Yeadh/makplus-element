<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Title
class makplus_Widget_Testimonials extends Widget_Base {
 
   public function get_name() {
      return 'testimonials';
   }
 
   public function get_title() {
      return esc_html__( 'Testimonials', 'makplus' );
   }
 
   public function get_icon() { 
        return 'eicon-testimonial';
   }

   public function get_categories() {
      return [ 'makplus-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'testimonial_section',
         [
            'label' => esc_html__( 'Testimonials', 'makplus' ),
            'type' => Controls_Manager::SECTION,
         ]
      );


      $this->add_control(
         'style',
         [
            'label' => __( 'Style', 'makplus' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'style1',
            'options' => [
               'style1' => __( 'Style 1', 'makplus' ),
               'style2' => __( 'Style 2', 'makplus' ),
            ],
         ]
      );


      $repeater = new \Elementor\Repeater();

      $repeater->add_control(
         'image',
         [
            'label' => __( 'Choose Photo', 'makplus' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src()
            ]
         ]
      );
      
      $repeater->add_control(
         'name',
         [
            'label' => __( 'Name', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            
         ]
      );

      $repeater->add_control(
         'designation',
         [
            'label' => __( 'Designation', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXT
         ]
      );

      $repeater->add_control(
         'testimonial',
         [
            'label' => __( 'Testimonial', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA
         ]
      );

      $this->add_control(
         'testimonial_list',
         [
            'label' => __( 'Testimonial List', 'makplus' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{name}}',

         ]
      );
      
      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display(); ?>

      <?php if ( $settings['style'] == 'style1' ){ ?>

      <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
          <div class="testimonial-active">
            <?php foreach (  $settings['testimonial_list'] as $testimonial_single ): ?>
              <div class="single-testimonial text-center">
                  <div class="testimonial-icon mb-25">
                      <img src="<?php echo get_template_directory_uri() ?>/images/quote.png" alt="quote">
                  </div>
                  <div class="testimonial-content">
                      <h5><?php echo esc_html($testimonial_single['testimonial']); ?></h5>
                      <div class="testi-avatar">
                          <h6><?php echo esc_html($testimonial_single['name']); ?></h6>
                          <span><?php echo esc_html($testimonial_single['designation']); ?></span>
                      </div>
                  </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      
      <?php } elseif( $settings['style'] == 'style2' ){ ?>

        
      <?php } ?>

   <?php } 
 
}

Plugin::instance()->widgets_manager->register_widget_type( new makplus_Widget_Testimonials );