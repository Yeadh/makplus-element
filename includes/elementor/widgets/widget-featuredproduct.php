<?php 
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// Product
class Makplus_Widget_Featured_Product extends Widget_Base {
 
   public function get_name() {
      return 'featuredproduct';
   }
 
   public function get_title() {
      return esc_html__( 'Featured Products', 'makplus' );
   }
 
   public function get_icon() { 
        return 'eicon-posts-carousel';
   }
 
   public function get_categories() {
      return [ 'makplus-elements' ];
   }
   protected function _register_controls() {

      $this->start_controls_section(
         'product_section',
         [
            'label' => esc_html__( 'Featured Products', 'makplus' ),
            'type' => Controls_Manager::SECTION,
         ]
      );
      

      $this->add_control(
         'sub-title',
         [
            'label' => __( 'Sub Title', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __('Plugin','makplus')
         ]
      );

      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Products Name','makplus')
         ]
      );

       $this->add_control(
           'desc',
           [
               'label' => __( 'Discription', 'makplus' ),
               'type' => \Elementor\Controls_Manager::TEXTAREA,
               'default' => __('Meet our bestselling theme. With Makplus, we’ve simplified the process of building a professional-looking website, without difficult coding. Check out our growing library of templates to fit your project, with more advanced features to really make it yours.','makplus')
           ]
       );
       $this->add_control(
           'button_text', [
               'label' => __( 'Button Text', 'makplus' ),
               'type' => \Elementor\Controls_Manager::TEXT,
               'default' => __('Free Download','makplus')
           ]
       );

       $this->add_control(
           'button_url', [
               'label' => __( 'Button URL', 'makplus' ),
               'type' => \Elementor\Controls_Manager::TEXT,
               'default' => '#'
           ]
       );
       $this->add_control(
           'button_text2', [
               'label' => __( 'Button Text', 'makplus' ),
               'type' => \Elementor\Controls_Manager::TEXT,
               'default' => __('Buy For $25','makplus')
           ]
       );

       $this->add_control(
           'button_url2', [
               'label' => __( 'Button URL', 'makplus' ),
               'type' => \Elementor\Controls_Manager::TEXT,
               'default' => '#'
           ]
       );

       $this->add_control(
           'image',
           [
               'label' => __( 'Product Image', 'makplus' ),
               'type' => \Elementor\Controls_Manager::MEDIA,
               'default' => [
                   'url' => \Elementor\Utils::get_placeholder_image_src()
               ]
           ]
       );

      
      $this->end_controls_section();
   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display(); ?>

       <!-- latest-games-area -->
       <section class="latest-games-area pt-120">
           <div class="container">
               <div class="row">
                   <div class="col-lg-6 col-md-6 col-sm-12">
                       <div class="featured_products_details mb-50 mt-50">
                           <span><?php echo esc_html($settings['sub-title']); ?></span>
                           <h2><?php echo esc_html($settings['title']); ?></h2>
                           <p><?php echo esc_html($settings['desc']); ?></p>
                           <a class="btn" target="_blank" href="<?php echo esc_url( $settings['button_url'] ); ?>">
                               <?php echo esc_html( $settings['button_text'] ); ?></a>
                           <a class="btn" target="_blank" href="<?php echo esc_url( $settings['button_url2'] ); ?>">
                               <?php echo esc_html( $settings['button_text2'] ); ?></a>
                       </div>
                   </div>
                   <div class="col-lg-6 col-md-6 col-sm-12">
                       <div class="featured_products_image mb-50">
                           <span class="cs-theme-item-bar"> <span></span><span></span><span></span> </span>
                           <img src="<?php echo esc_html($settings['image']['url']); ?>" alt="<?php echo esc_attr($settings['title']); ?>">
                       </div>
                   </div>
               </div>
           </div>
       </section>
       <!-- latest-games-area-end -->

      <?php
   }
 
}
Plugin::instance()->widgets_manager->register_widget_type( new Makplus_Widget_Featured_Product );