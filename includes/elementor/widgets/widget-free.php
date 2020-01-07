<?php 
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// Product
class makplus_Widget_free extends Widget_Base {
 
   public function get_name() {
      return 'freeproduct';
   }
 
   public function get_title() {
      return esc_html__( 'free products', 'makplus' );
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
            'default' => 3,
            'min' => 5,
            'max' => 100,
            'step' => 1
         ]
      );
     
      $this->end_controls_section();
   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display();

      $products = new \WP_Query( array( 
        'post_type' => 'product',
        'product_cat' => 'free',  
        'posts_per_page' => $settings['ppp'],
      ));
   
      global $product;?>
      
    <div class="row">
    <?php while ( $products->have_posts() ) : $products->the_post(); ?>

       <div class="col-lg-4 col-md-6">
          <div class="single-product t-single-product mb-30">
              <div class="product-img">
                  <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('makplus-403x260') ?></a>
              </div>
              <div class="t-product-content">
                  <div class="t-product-rating">
                      <?php woocommerce_template_loop_rating(); ?>
                  </div>
                  <h5><a href="<?php the_permalink() ?>"><?php the_title() ?></h5>
                  <div class="t-product-meta">
                      <ul>
                          <li><?php esc_html_e( 'By', 'makplus' ) ?> <a href="<?php echo dokan_get_store_url(get_the_author_meta('ID')) ?>"><?php echo get_the_author() ?> :</a></li>
                          <li class="product-cat"><?php echo $product->get_categories(); ?></li>
                      </ul>
                  </div>
                  <div class="t-product-bottom">
                      <h6><?php esc_html_e( 'Price', 'makplus' ) ?> : <span><?php echo get_woocommerce_currency_symbol().get_post_meta( get_the_ID(), '_regular_price', true ); ?></span></h6>
                      <a href="<?php echo do_shortcode('[add_to_cart_url id="'.get_the_ID().'"]'); ?>" class="product-cart"><i class="fas fa-shopping-basket"></i></a>
                  </div>
              </div>
          </div>
        </div>
      
        <?php endwhile; wp_reset_postdata(); ?>
      
    </div>
      <?php
   }
 
}
Plugin::instance()->widgets_manager->register_widget_type( new makplus_Widget_free );