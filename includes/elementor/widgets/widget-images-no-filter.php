<?php 
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// Product
class Makplus_Widget_Images_Nofilter extends Widget_Base {
 
   public function get_name() {
      return 'imagesnofilter';
   }
 
   public function get_title() {
      return esc_html__( 'Images without Filter', 'makplus' );
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
            'label' => esc_html__( 'Images without Filter', 'makplus' ),
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

              <div class="image_gallery">
                     <?php
                $products = new \WP_Query( array( 
                  'post_type' => 'product',
                  'posts_per_page' => $settings['ppp'],
                  'ignore_sticky_posts' => true,
                  'order' => $settings['order'],
				  'Category' => $settings['cat'],
                ));
                 /* Start the Loop */
                while ( $products->have_posts() ) : $products->the_post();
                $product_terms = get_the_terms( get_the_ID() , 'product_cat' ); 
                $categories = get_the_category();
				
                global $product;?>

                     <div class="image_gallery_item latest-games-thumb">
                        <a href="<?php the_permalink(); ?>">
                           <?php the_post_thumbnail('makplus-360-500'); ?>
                        </a>
						<div class="new_release_hover">
						   <div class="new_release_hover_preview">
								   <a href="<?php the_permalink(); ?>" target="_blank" tabindex="0"><?php echo esc_html__( 'View Now', 'makplus' ); ?></a>
							   
						   </div>
						   <div class="new_release_hover_addtocart">
							   <a href="<?php echo esc_url(home_url( '/' )); ?>/cart/?add-to-cart=<?php echo esc_attr(get_the_ID()); ?>" ><?php echo esc_html( $price ).esc_html__( ' Add To Cart', 'makplus' ) ?></a>
						   </div>
					   </div>
                     </div>

                     <?php endwhile; wp_reset_postdata(); ?>
                     
                  </div>
      <!-- product-area-end -->

      <?php
   }
 
}
Plugin::instance()->widgets_manager->register_widget_type( new Makplus_Widget_Images_Nofilter );