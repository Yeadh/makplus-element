<?php 
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// Images
class Makplus_Widget_New_Images extends Widget_Base {
 
   public function get_name() {
      return 'image-carousel';
   }
 
   public function get_title() {
      return esc_html__( 'Latest Image Carousel', 'makplus' );
   }
 
   public function get_icon() { 
        return 'eicon-gallery-masonry';
   }
 
   public function get_categories() {
      return [ 'makplus-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'portfolio_section',
         [
            'label' => esc_html__( 'Latest Image Carousel', 'makplus' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'ppp',
         [
            'label' => __( 'Number of Portfolio', 'makplus' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
               'no' => [
                  'min' => 0,
                  'max' => 100,
                  'step' => 1,
               ],
            ],
            'default' => [
               'size' => 5,
            ]
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
       
      $settings = $this->get_settings_for_display();
      
      //Inline Editing
      $this->add_inline_editing_attributes( 'ppp', 'basic' );
      ?>

      <div class="container-fluid">
         <div class="portfolio">
            <div class="row">
               <div class="col-xl-12 col-md-12">
                  <div class="portfolio-3">
                     <?php
                     $portfolio = new \WP_Query( array(
                     'post_type' => 'product',
                     'posts_per_page' => $settings['ppp']['size'],
					 'order' => $settings['order'],
                     ));

                     while ( $portfolio->have_posts() ) : $portfolio->the_post(); ?>

                     <div class="portfolio-item-3 latest-games-thumb">
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
               </div>
            </div>
         </div>
      </div>

      <?php
   }
 
}
Plugin::instance()->widgets_manager->register_widget_type( new Makplus_Widget_New_Images );