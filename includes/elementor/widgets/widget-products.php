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
            'default' => 8,
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

      <div class="row justify-content-center">
        <div class="text-center">
          <div class="product-menu s-product-menu mb-60">
            <button class="active" data-filter="*">All Items</button>
            <?php  $product_menu_terms = get_terms( array(
               'taxonomy' => 'product_cat',
               'hide_empty' => false,  
            ) ); 

            foreach ( $product_menu_terms as $portfolio_menu_term ) { ?>
              <button class="" data-filter=".<?php echo esc_attr( $portfolio_menu_term->slug ) ?>"><?php echo esc_html( $portfolio_menu_term->name ) ?></button>
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="row product-active justify-content-center">
        <?php
        $products = new \WP_Query( array( 
          'post_type' => 'product',
          'posts_per_page' => $settings['ppp'],
          'ignore_sticky_posts' => true,
          'order' => $settings['order'],
        ));
         /* Start the Loop */
        global $product;
        while ( $products->have_posts() ) : $products->the_post();
        $product_terms = get_the_terms( get_the_ID() , 'product_cat' );
        
        global $product;?>

        <div class="col-lg-4 col-md-6 grid-item <?php foreach ($product_terms as $portfolio_term) { echo esc_attr( $portfolio_term->slug ); } ?>">
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
Plugin::instance()->widgets_manager->register_widget_type( new makplus_Widget_Product );