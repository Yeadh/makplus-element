<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Title
class makplus_Widget_Counter extends Widget_Base {
 
   public function get_name() {
      return 'counter';
   }
 
   public function get_title() {
      return esc_html__( 'Counter', 'makplus' );
   }
 
   public function get_icon() { 
        return 'eicon-counter';
   }
 
   public function get_categories() {
      return [ 'makplus-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'counter_section',
         [
            'label' => esc_html__( 'Counter', 'makplus' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $counter = new \Elementor\Repeater();

      $counter->add_control(
         'icon',
         [
            'label' => __( 'Icon', 'makplus' ),
            'type' => \Elementor\Controls_Manager::MEDIA
         ]
      );

      $counter->add_control(
         'count',
         [
            'label' => __( 'Count', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXT
         ]
      );

      $counter->add_control(
         'title',
         [
            'label' => __( 'Title', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXT
         ]
      );

      $this->add_control(
         'counter',
         [
            'label' => __( 'Counter', 'makplus' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $counter->get_controls(),
            'title_field' => '{{title}}',

         ]
      );

      
      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display(); ?>

      <section class="counter-area inner-counter-bg counter-bg pt-110 pb-60">
         <div class="container">
           <div class="row">
            <?php foreach (  $settings['counter'] as $counter_single ): ?>
               <div class="col-lg-3 col-sm-6">
                   <div class="single-counter text-center mb-50">
                       <div class="counter-icon">
                           <img src="<?php echo $counter_single['icon']['url'] ?>" alt="img">
                       </div>
                       <div class="counter-content">
                           <h2 class="count"><?php echo $counter_single['count'] ?></h2>
                           <span><?php echo $counter_single['title'] ?></span>
                       </div>
                   </div>
               </div>
            <?php endforeach; ?>
           </div>
         </div>
      </section>

      <?php
   }
 
}

Plugin::instance()->widgets_manager->register_widget_type( new makplus_Widget_Counter );