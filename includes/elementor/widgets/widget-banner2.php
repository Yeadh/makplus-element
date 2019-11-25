<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Banner Parallax
class makplus_Widget_Banner2 extends Widget_Base {
 
   public function get_name() {
      return 'banner2';
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
            'label' => esc_html__( 'Banner', 'makplus' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
      'banner_image',
        [
          'label' => __( 'Banner image', 'makplus' ),
          'type' => \Elementor\Controls_Manager::MEDIA,
          'default' => [
            'url' => get_template_directory_uri().'/images/slider_bg02.jpg',
          ],
        ]
      );

      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Let\'s Start. Marketplace for Digital Themes & Plugins','makplus')
         ]
      );

      $this->add_control(
         'description',
         [
            'label' => __( 'Description', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __('New Products on the Marketplace.Your dream site download!','makplus')
         ]
      );

      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
    // get our input from the widget settings.
    $settings = $this->get_settings_for_display(); ?>

      <section class="slider-area s-slider-bg" style="background-image: url(<?php echo esc_url($settings['banner_image']['url']) ?>)">
          <div class="container">
              <div class="row justify-content-center">
                  <div class="col-xl-8 col-lg-10">
                      <div class="slider-content s-slider-content text-center mb-45">
                          <h2><?php echo $settings['title'] ?></h2>
                          <p><?php echo esc_html( $settings['description'] ) ?></p>
                      </div>
                  </div>
              </div>
              <div class="row justify-content-center">
                  <div class="col-xl-8 col-lg-10">
                      <div class="s-slider-search-form">
                        <form action="<?php echo esc_url(home_url( '/' )); ?>">
                            <input type="text" placeholder="<?php echo esc_attr_x( 'Search what your need...', 'placeholder', 'makplus' ); ?>">
                            <button><i class="fas fa-search"></i></button>
                        </form>
                      </div>
                  </div>
              </div>
          </div>
      </section>
    <?php }
}

Plugin::instance()->widgets_manager->register_widget_type( new makplus_Widget_Banner2 );