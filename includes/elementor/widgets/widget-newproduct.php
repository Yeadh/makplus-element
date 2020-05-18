<?php 
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// Product
class Makplus_Widget_New_Product extends Widget_Base {
 
   public function get_name() {
      return 'latest_product';
   }
 
   public function get_title() {
      return esc_html__( 'Latest Products', 'makplus' );
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
            'label' => esc_html__( 'Latest Products', 'makplus' ),
            'type' => Controls_Manager::SECTION,
         ]
      );
      

      $this->add_control(
         'sub-title',
         [
            'label' => __( 'Sub Title', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __('Let\'s Check Out','makplus')
         ]
      );

      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('New Release Items','makplus')
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

       <!-- latest-games-area -->
       <section class="latest-games-area">
           <div class="container">
               <div class="row">
                   <div class="col-lg-6 col-md-8">
                       <div class="section-title mb-50">
                           <span><?php echo esc_html($settings['sub-title']); ?></span>
                           <h2><?php echo esc_html($settings['title']); ?></h2>
                       </div>
                   </div>
               </div>
               <div class="row">
                   <div class="col-12">
                       <div class="latest-games-active owl-carousel">

                           <?php
                           $products = new \WP_Query( array(
                               'post_type' => 'product',
                               'posts_per_page' => $settings['ppp'],
                               'ignore_sticky_posts' => true,
                               'order' => $settings['order'],
                           ));
                           /* Start the Loop */
                           while ( $products->have_posts() ) : $products->the_post();
                               

                               $live = get_post_meta( get_the_ID(), 'makplus_live_preview', 1 );
                               global $product; ?>

                           <div class="latest-games-items mb-30">
                               <div class="latest-games-thumb">
                                   <a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'makplus-503x320' ) ?></a>

                                   <div class="new_release_hover">
                                       <div class="new_release_hover_preview">
                                           <?php if ($live): ?>
                                               <a href="<?php echo esc_url( $live ); ?>" target="_blank" tabindex="0"><?php echo esc_html__( 'Live Preview', 'makplus' ); ?></a>
                                           <?php endif ?>

                                       </div>
                                       <div class="new_release_hover_addtocart">
                                           <a href="<?php echo esc_url(home_url( '/' )); ?>/cart/?add-to-cart=<?php echo esc_attr(get_the_ID()); ?>" ><?php echo esc_html( $price ).esc_html__( ' Add To Cart', 'makplus' ) ?></a>
                                       </div>
                                   </div>
                               </div>
                               <div class="latest-games-content">
                                   <div class="lg-tag">
                                       <a href="#"><?php echo esc_html( $portfolio_term->name ); ?></a>
                                   </div>
                                   <h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
                                   <p><?php echo get_woocommerce_currency_symbol().get_post_meta( get_the_ID(), '_regular_price', true ); ?></p>
                               </div>
                           </div>
                           <?php endwhile; wp_reset_postdata(); ?>
                       </div>
                   </div>
               </div>
           </div>
       </section>
       <!-- latest-games-area-end -->

      <?php
   }
 
}
Plugin::instance()->widgets_manager->register_widget_type( new Makplus_Widget_New_Product );