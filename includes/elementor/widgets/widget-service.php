<?php 
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// service item
class makplus_Widget_Service extends Widget_Base {
 
   public function get_name() {
      return 'service item';
   }
 
   public function get_title() {
      return esc_html__( 'Service Item', 'makplus' );
   }
 
   public function get_icon() { 
        return 'eicon-facebook-comments';
   }
 
   public function get_categories() {
      return [ 'makplus-elements' ];
   }

   protected function _register_controls() {
    
      $this->start_controls_section(
         'service_section',
         [
            'label' => esc_html__( 'Service Item', 'makplus' ),
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
       $this->add_control(
         'image',
         [
            'label' => __( 'Choose icon', 'makplus' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src()
            ]
         ]
      );

       $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __( 'Genuine Products', 'makplus' ),
         ]
      );

       $this->add_control(
         'desc',
         [
            'label' => __( 'Description', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __( 'Annual Performance Statistics that Report provides detailed statistical information our performance stakeh.', 'makplus' ),
         ]
      );

      $this->end_controls_section();
   }
   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display(); ?>
       <?php if ( $settings['style'] == 'style1' ){ ?>
      <div class="services-box">
          <div class="services-box-head">
              <img src="<?php echo esc_html($settings['image']['url']); ?>" alt="<?php echo esc_attr($settings['title']); ?>">
              <h4><?php echo esc_html($settings['title']); ?></h4>
          </div>
          <div class="services-box-content">
              <p><?php echo esc_html($settings['desc']); ?></p>
          </div>
          <div class="services-overlay-icon"><img src="<?php echo esc_html($settings['image']['url']); ?>" alt="<?php echo esc_attr($settings['title']); ?>"></div>
      </div>
       <?php } elseif( $settings['style'] == 'style2' ){ ?>
           <div class="single__box single__box__layout__3">
               <div class="box__icon "><img src="<?php echo esc_html($settings['image']['url']); ?>" alt="<?php echo esc_attr($settings['title']); ?>"></div>
               <h3 class="box__title"><?php echo esc_html($settings['title']); ?></h3>
               <div class="box__description">
                   <p><?php echo esc_html($settings['desc']); ?></p>
               </div>
           </div>
       <?php } ?>
      <?php
   }
 
}
Plugin::instance()->widgets_manager->register_widget_type( new makplus_Widget_Service );