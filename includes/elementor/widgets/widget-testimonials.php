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
            'default' => __( 'Emaley Mcculloch', 'makplus' ),
            
         ]
      );

      $repeater->add_control(
         'designation',
         [
            'label' => __( 'Designation', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __( 'Founder ceo', 'makplus' ),
         ]
      );

      $repeater->add_control(
         'testimonial',
         [
            'label' => __( 'Testimonial', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __( 'In promotion and of advertising testimonial show consiss of a person\'s written orsoken statement extollig the virtue', 'makplus' ),
         ]
      );

      $repeater->add_control(
        'rating',
        [
          'label' => __( 'Rating', 'makplus' ),
          'type' => \Elementor\Controls_Manager::SELECT,
          'default' => 1,
          'options' => [
            1 => __( 'Star 1', 'makplus' ),
            2 => __( 'Star 2', 'makplus' ),
            3 => __( 'Star 3', 'makplus' ),
            4 => __( 'Star 4', 'makplus' ),
            5 => __( 'Star 5', 'makplus' ),
            'none' => __( 'None', 'makplus' ),
          ]
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

      <!-- testimonial start -->
      <div class="testimonial-area pt-150 pb-150 wow fadeInUp" data-wow-delay=".2s">

        <div class="row">
            <div class="col-xl-10 offset-xl-1">
                <div class="testimonial-active">
                    <?php foreach (  $settings['testimonial_list'] as $testimonial_single ): ?>
                    <div class="testimonial-item">
                        <div class="inner-tesimonial text-center">
                            <p><?php echo esc_html($testimonial_single['testimonial']); ?></p>
                            <div class="testimonail-name">
                                <h6><?php echo esc_html($testimonial_single['name']); ?></h6>
                                <span><?php echo esc_html($testimonial_single['designation']); ?></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="testimonial-nav">
                  <?php foreach (  $settings['testimonial_list'] as $testimonial_single ): ?>
                    <div class="testimonial-thumb">
                        <img src="<?php echo esc_url($testimonial_single['image']['url']) ?>" alt="img">
                    </div>
                  <?php endforeach; ?>
                </div>
            </div>
        </div>
      <!-- testimonial end -->
      
    </div>
   <?php }
 
}

Plugin::instance()->widgets_manager->register_widget_type( new makplus_Widget_Testimonials );