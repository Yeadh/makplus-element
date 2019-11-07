<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Title
class makplus_Widget_Title extends Widget_Base {
 
   public function get_name() {
      return 'title';
   }
 
   public function get_title() {
      return esc_html__( 'Title', 'makplus' );
   }
 
   public function get_icon() { 
        return 'eicon-site-title';
   }
 
   public function get_categories() {
      return [ 'makplus-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'title_section',
         [
            'label' => esc_html__( 'Title', 'makplus' ),
            'type' => Controls_Manager::SECTION,
            'default' => __('Featured Tranding of the week','makplus')
         ]
      );

      $this->add_control(
         'sub-title',
         [
            'label' => __( 'Sub Title', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Market or marketplace is location where people regularly purchase and provisins.','makplus')
         ]
      );
      
      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Awesome Customer Service With Our Tools.','makplus')
         ]
      );

      $this->add_control(
         'align',
         [
            'label' => __( 'Alignment', 'makplus' ),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
               'text-left' => [
                  'title' => __( 'Left', 'makplus' ),
                  'icon' => 'fa fa-align-left',
               ],
               'text-center' => [
                  'title' => __( 'Center', 'makplus' ),
                  'icon' => 'fa fa-align-center',
               ],
               'text-right' => [
                  'title' => __( 'Right', 'makplus' ),
                  'icon' => 'fa fa-align-right',
               ],
            ],
            'default' => 'text-center',
            'toggle' => true
         ]
      );

      $this->add_control(
         'white',
         [
            'label' => __( 'White title', 'makplus' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'On', 'makplus' ),
            'label_off' => __( 'Off', 'makplus' ),
            'return_value' => 'white',
            'default' => 'no',   
         ]
      );
      
      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display();
      
      //Inline Editing
      $this->add_inline_editing_attributes( 'title', 'basic' );
      $this->add_inline_editing_attributes( 'sub-title', 'basic' );
      
      ?>
      <div class="section-title text-center mb-55 <?php echo esc_attr($settings['align']).' '.esc_attr($settings['white']); ?>">
        <h2 <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo esc_html($settings['title']); ?></h2>
        <p <?php echo $this->get_render_attribute_string( 'sub-title' ); ?>><?php echo esc_html($settings['sub-title']); ?></p>
      </div>
      <?php
   }
 
}

Plugin::instance()->widgets_manager->register_widget_type( new makplus_Widget_Title );