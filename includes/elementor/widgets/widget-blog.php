<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// blog
class makplus_Widget_Blog extends Widget_Base {
 
   public function get_name() {
      return 'blog';
   }
 
   public function get_title() {
      return esc_html__( 'Latest Blog', 'makplus' );
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
         'order',
         [
            'label' => __( 'Order', 'makplus' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'ASC',
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
      
         <div class="row justify-content-center">
               <?php
               $blog = new \WP_Query( array( 
                  'post_type' => 'post',
                  'posts_per_page' => 3,
                  'ignore_sticky_posts' => true,
                  'order' => $settings['order'],
               ));
               /* Start the Loop */
               while ( $blog->have_posts() ) : $blog->the_post();
               ?>

              <div class="col-lg-4 col-md-6">
                <div class="single-blog-post mb-30">
                    <div class="blog-thumb">
                        <a href="<?php the_permalink() ?>"><img src="<?php echo get_the_post_thumbnail_url( get_the_ID(),'makplus-404x297'); ?>" alt="<?php the_title() ?>"></a>
                    </div>
                    <div class="blog-meta">
                      <ul>
                          <li><span><?php echo esc_html__( 'By ','makplus' ) ?></span>- <?php the_author(); ?></li>
                          <li><?php echo get_the_date() ?></li>
                          <li><?php comments_number( 'No Comments', 'One Comment', '% Comments' ); ?></li>
                      </ul>
                    </div>
                    <div class="blog-content">

                        <h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>                        
                        <p><?php echo wp_trim_words( get_the_content(), 10, '.' ); ?></p>
                    </div>
                </div>
              </div>

              <?php endwhile; wp_reset_postdata(); ?>
         </div>

      <?php
   }
 
}
Plugin::instance()->widgets_manager->register_widget_type( new makplus_Widget_Blog );