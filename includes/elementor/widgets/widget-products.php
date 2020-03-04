<?php 
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// Product
class Makplus_Widget_Product extends Widget_Base {
 
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
            'default' => __('Newest Release Items','makplus')
         ]
      );



      $this->add_control(
         'text',
         [
            'label' => __( 'Text', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __('Business plan template presented here will get you started. A standard business plan consists of a single document divided into several sections','makplus')
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

      <!-- product-area -->
      <section class="product-area gray-bg pt-120 pb-80">
          <div class="container">
              <div class="row justify-content-center">
                  <div class="col-xl-8 col-lg-9">
                      <div class="section-title text-center mb-65">
                          <span><?php echo esc_html($settings['sub-title']); ?></span>
                          <h2><?php echo esc_html($settings['title']); ?></h2>
                          <p><?php echo esc_html($settings['text']); ?></p>
                      </div>
                  </div>
              </div>
              <div class="row justify-content-center">
                  <div class="col-xl-9 text-center">
                      <div class="product-menu mb-60">
                          <button class="active" data-filter="*">All</button>
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
              <div class="row product-active">
                 <?php
                $products = new \WP_Query( array( 
                  'post_type' => 'product',
                  'posts_per_page' => $settings['ppp'],
                  'ignore_sticky_posts' => true,
                  'order' => $settings['order'],
                ));
                 /* Start the Loop */
                while ( $products->have_posts() ) : $products->the_post();
                $product_terms = get_the_terms( get_the_ID() , 'product_cat' ); 
                $categories = get_the_category();
                global $product;?>
                  <div class="col-lg-4 col-md-6 grid-item <?php foreach ($product_terms as $portfolio_term) { echo esc_attr( $portfolio_term->slug ); } ?>">
                      <div class="product-item mb-40">
                          <div class="product-thumb">
                              <a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'makplus-403,256' ) ?></a>
                          </div>
                          <div class="product-item-content">
                              <div class="product-cat mb-10">
                                  <ul>
                                      <li><a href="#"><?php echo esc_html( $portfolio_term->name ); ?></a></li>
                                      <li><?php echo get_woocommerce_currency_symbol().get_post_meta( get_the_ID(), '_regular_price', true ); ?></li>
                                  </ul>
                              </div>
                              <h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
                              <p><?php echo esc_html( get_post_meta( get_the_ID(), 'makplus_sub_title', 1 ) ) ?></p>
                          </div>
                          <div class="product-meta">
                              <ul>
                                  <li><?php echo get_avatar( get_the_author_meta( 'ID' ), '29'); ?><?php echo esc_html__( 'By ','makplus' ) ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></li>
                                  <li>
                                     <?php woocommerce_template_loop_rating() ?>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
                <?php endwhile; wp_reset_postdata(); ?>
              </div>
          </div>
      </section>
      <!-- product-area-end -->

      <?php
   }
 
}
Plugin::instance()->widgets_manager->register_widget_type( new Makplus_Widget_Product );