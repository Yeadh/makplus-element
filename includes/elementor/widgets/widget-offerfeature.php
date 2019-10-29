<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Offerfeature
class makplus_Widget_Offerfeature extends Widget_Base {
 
   public function get_name() {
      return 'offerfeature';
   }
 
   public function get_title() {
      return esc_html__( 'Offer Feature', 'makplus' );
   }
 
   public function get_icon() { 
        return 'eicon-price-table';
   }
 
   public function get_categories() {
      return [ 'makplus-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'section',
         [
            'label' => esc_html__( 'Offer Feature', 'makplus' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'subtitle',
         [
            'label' => __( 'Sub title', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'OFFERS FEATURE'
         ]
      );
      
      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'What We Offer Service'
         ]
      );

      $feature = new \Elementor\Repeater();

      $feature->add_control(
         'icon',
         [
            'label' => __( 'Icon', 'makplus' ),
            'type' => \Elementor\Controls_Manager::MEDIA
         ]
      );

      $feature->add_control(
         'title',
         [
            'label' => __( 'Title', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __( 'Control Incoming <br> Moneys', 'makplus' )
         ]
      );

      $this->add_control(
         'feature_list',
         [
            'label' => __( 'Feature List', 'makplus' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $feature->get_controls(),
            'title_field' => '{{{ title }}}',
         ]
      );

      $this->end_controls_section();
   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display(); ?>


      <!-- offer-features -->
      <section class="offer-features of-mt">
          <div class="container">
              <div class="row">
                  <div class="col-12">
                      <div class="offer-features-wrap pt-75 pb-30">
                          <div class="section-title text-center mb-60">
                              <span><?php echo esc_html( $settings['subtitle'] ); ?></span>
                              <h2><?php echo esc_html( $settings['title'] ); ?></h2>
                          </div>
                          <div class="row">
                           <?php foreach ( $settings['feature_list'] as $value ): ?>
                              <div class="col-lg-3 col-sm-6">
                                  <div class="single-offer-f text-center mb-50">
                                      <div class="offer-f-icon mb-20">
                                          <img src="<?php echo esc_html( $value['icon']['url'] ) ?>" alt="img">
                                      </div>
                                      <div class="offer-f-content">
                                          <h4><?php echo $value['title'] ?></h4>
                                      </div>
                                  </div>
                              </div>
                           <?php endforeach ?>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
   <?php }
 
}

Plugin::instance()->widgets_manager->register_widget_type( new makplus_Widget_Offerfeature );