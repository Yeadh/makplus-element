<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// Product
class makplus_Widget_Product extends Widget_Base {
 
   public function get_name() {
      return 'product';
   }
 
   public function get_title() {
      return esc_html__( 'Products', 'makplus' );
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
            'label' => esc_html__( 'Products', 'makplus' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'ppp',
         [
            'label' => __( 'Post per page', 'makplus' ),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 14,
            'min' => 5,
            'max' => 100,
            'step' => 1
         ]
      );


      $this->add_control(
         'order',
         [
            'label' => __( 'Order', 'makplus' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'DESC',
            'options' => [
               'ASC'  => __( 'Ascending', 'makplus' ),
               'DESC' => __( 'Descending', 'makplus' )
            ],
         ]
      );
      
      $this->end_controls_section();
   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display(); ?>

      <div class="row">
        <div class="col-12 text-center">
          <div class="product-menu mb-60">
              <button class="active" data-filter="*">All Items</button>
              <button class="" data-filter=".cat-one">WordPress</button>
              <button class="" data-filter=".cat-two">HTML</button>
              <button class="" data-filter=".cat-three">Marketing</button>
              <button class="" data-filter=".cat-four">eCommerce</button>
              <button class="" data-filter=".cat-five">Plugins</button>
          </div>
        </div>
      </div>
      <div class="row product-active">
        <?php
        $products = new \WP_Query( array( 
          'post_type' => 'product',
          'posts_per_page' => $settings['ppp'],
          'ignore_sticky_posts' => true,
          'order' => $settings['order'],
        ));
         /* Start the Loop */
        global $product;
        while ( $products->have_posts() ) : $products->the_post(); ?>

        <div class="col-xl-3 col-lg-4 col-md-6 grid-item cat-three cat-five">
            <div class="single-product mb-30">
                <div class="product-img">
                    <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('makplus-297x229') ?></a>
                </div>
                <div class="product-overlay">
                    <h5><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
                    <span><?php echo get_woocommerce_currency_symbol().get_post_meta( get_the_ID(), '_regular_price', true ); ?></span>
                </div>
            </div>
        </div>

        <?php endwhile; wp_reset_postdata(); ?>
      </div>

      <?php
   }
 
}
Plugin::instance()->widgets_manager->register_widget_type( new makplus_Widget_Product );