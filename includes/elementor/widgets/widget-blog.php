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
                    <div class="blog-content"> 
                        <h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
                        <div class="blog-meta">
                          <ul>
                              <li><i class="far fa-calendar-alt"></i> <?php echo get_the_date() ?></li>
                          </ul>
                        </div>
                        <p><?php echo wp_trim_words( get_the_content(), 16, '.' ); ?></p>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="blog-read-more">
                                <a href="<?php the_permalink(); ?>"><?php echo esc_html__( 'Read More', 'makplus' ); ?></a>
                            </div>
                          </div>
                          <div class="col-md-6 text-right">
                            <div class="inner-blog-share mt-10">
                                <a href="#"><i class="fas fa-share-alt"></i></a>
                                <?php echo makplus_social_sharing(); ?>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
              </div>

              <?php endwhile; wp_reset_postdata(); ?>
         </div>

      <?php
   }
 
}
Plugin::instance()->widgets_manager->register_widget_type( new makplus_Widget_Blog );