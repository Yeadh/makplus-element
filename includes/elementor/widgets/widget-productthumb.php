<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// Product Thumbnails
class makplus_Widget_Product_Thumb extends Widget_Base {
 
   public function get_name() {
      return 'product_thumb';
   }
 
   public function get_title() {
      return esc_html__( 'Product Thumbnails', 'makplus' );
   }
 
   public function get_icon() { 
        return 'eicon-posts-carousel';
   }
 
   public function get_categories() {
      return [ 'makplus-elements' ];
   }
   protected function _register_controls() {

      $this->start_controls_section(
         'blog_section',
         [
            'label' => esc_html__( 'Blog', 'makplus' ),
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

      <div class="product-thumb-wrap">
        <div class="row text-center justify-content-center">
           <?php
           $blog = new \WP_Query( array( 
              'post_type' => 'product',
              'posts_per_page' => $settings['ppp'],
              'ignore_sticky_posts' => true,
              'order' => $settings['order'],
           ));
           /* Start the Loop */
           while ( $blog->have_posts() ) : $blog->the_post();
           global $product; ?>
            <div class="single-product-item-thumb">
                <a href="<?php the_permalink() ?>">
                  <img src="<?php echo esc_url( get_post_meta( get_the_ID(), 'makplus_thumb', 1 ), 'makplus-120x120' ); ?>">
                </a>

              <div class="tooltip-wrap">
                  <div class="tooltip-thumb">
                      <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('makplus-325x170') ?></a>
                  </div>
                  <div class="tooltip-content">
                      <div class="tooltip-product-info">
                          <h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
                          <a href="#" class="tooltip-cat">WP Theme</a>
                      </div>
                      <div class="tooltip-product-price">
                          <h5><?php echo get_woocommerce_currency_symbol().get_post_meta( get_the_ID(), '_regular_price', true ); ?></h5>
                          <span><?php echo $product->get_total_sales(); ?> Sales</span>
                      </div>
                      <div class="tooltip-rating">
                          <?php woocommerce_template_loop_rating(); ?>
                      </div>
                  </div>
              </div>
            </div>
          <?php endwhile; wp_reset_postdata(); ?>
         </div>
      </div>

      <?php
   }
 
}
Plugin::instance()->widgets_manager->register_widget_type( new makplus_Widget_Product_Thumb );