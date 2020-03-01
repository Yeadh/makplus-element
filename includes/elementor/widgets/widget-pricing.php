<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Pricing
class makplus_Widget_Pricing extends Widget_Base {
 
   public function get_name() {
      return 'pricing';
   }
 
   public function get_title() {
      return esc_html__( 'Pricing', 'makplus' );
   }
 
   public function get_icon() { 
        return 'eicon-price-table';
   }
 
   public function get_categories() {
      return [ 'makplus-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'pricing_section',
         [
            'label' => esc_html__( 'Pricing', 'makplus' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'title',
         [
            'label' => __( 'title', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Standard Plan'
         ]
      );

      $this->add_control(
         'price',
         [
            'label' => __( 'Price', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '70'
         ]
      );
      
      $this->add_control(
         'package',
         [
            'label' => __( 'Package', 'makplus' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'Yealry',
            'options' => [
               'Daily'  => __( 'Daily', 'makplus' ),
               'Weekly'  => __( 'Weekly', 'makplus' ),
               'Monthly' => __( 'Monthly', 'makplus' ),
               'Yealry' => __( 'Yealry', 'makplus' ),
               'none' => __( 'None', 'makplus' )
            ],
         ]
      );

      $feature = new \Elementor\Repeater();

      $feature->add_control(
         'feature',
         [
            'label' => __( 'Feature', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __( '10 Free Domain Names', 'makplus' )
         ]
      );

      $feature->add_control(
         'cross',
         [
            'label' => __( 'Cross', 'makplus' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'On', 'makplus' ),
            'label_off' => __( 'Off', 'makplus' ),
            'return_value' => 'item-cross',
            'default' => 'off',
         ]
      );

      $this->add_control(
         'feature_list',
         [
            'label' => __( 'Feature List', 'makplus' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $feature->get_controls(),
            'default' => [
               [
                  'feature' => __( '5GB Storage Space', 'makplus' )
               ],
               [
                  'feature' => __( '20GB Monthly Bandwidth', 'makplus' )
               ],
               [
                  'feature' => __( 'My SQL Databases', 'makplus' )
               ],
               [
                  'feature' => __( '100 Email Account', 'makplus' )
               ],
               [
                  'feature' => __( '10 Free Domain Names', 'makplus' )
               ]
            ],
            'title_field' => '{{{ feature }}}',
         ]
      );

      $this->add_control(
         'btn_text',
         [
            'label' => __( 'button text', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Sng Up Now',
         ]
      );

      $this->add_control(
         'btn_url',
         [
            'label' => __( 'button URL', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '#',
         ]
      );


      $this->end_controls_section();
   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display(); ?>

      <div class="pricing-box mb-30">
           <div class="pricing-head mb-40">
               <h5><?php echo esc_html( $settings['title'] ); ?></h5>
               <h2><?php echo $settings['price']; ?><span>/month</span></h2>
           </div>
           <div class="pricing-type mb-40">
               <h6><?php echo esc_html( $settings['package'] ); ?></h6>
           </div>
           <div class="pricing-list mb-40">
               <ul>
                  <?php foreach( $settings['feature_list'] as $index => $feature ) { ?>
                  <li class="<?php echo esc_attr($feature['cross']) ?>"><i class="fas <?php if ($feature['cross'] == 'item-cross'){echo 'fa-times';}else{echo 'fa-check';} ?>"></i><?php echo $feature['feature'] ?></li>
                  <?php } ?>
               </ul>
           </div>
           <div class="pricing-btn">
               <a href="<?php echo esc_attr( $settings['btn_url'] ) ?>" class="btn"><?php echo esc_html( $settings['btn_text'] ) ?></a>
           </div>
       </div>

   <?php }
 
}

Plugin::instance()->widgets_manager->register_widget_type( new makplus_Widget_Pricing );