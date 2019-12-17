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
         'style',
         [
            'label' => __( 'Style', 'makplus' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'style1',
            'options' => [
               'style1' => __( 'Style 1', 'makplus' ),
               'style2' => __( 'Style 2', 'makplus' )
            ],
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
      
      <div class="container">
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

               <?php if ( $settings['style'] == 'style1' ){ ?>

               <div class="col-lg-4 col-md-6">
                  <div class="single-blog-post mb-30">
                      <div class="blog-thumb">
                          <a href="<?php the_permalink() ?>"><img src="<?php echo get_the_post_thumbnail_url( get_the_ID(),'makplus-404x279'); ?>" alt="<?php the_title() ?>"></a>
                      </div>
                      <div class="blog-content">
                          <div class="bc-top-wrap fix mb-25">
                              <div class="b-post-date">
                                  <h6>19</h6>
                                  <span>Aug, 2019</span>
                              </div>
                              <div class="b-top-content fix">
                                  <h5><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
                                  <div class="blog-meta">
                                      <ul>
                                          <li>
                                            <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><i class="far fa-user"></i><?php echo esc_html__( 'By','zaaple' ); ?> <?php the_author(); ?></a>
                                          </li>
                                          <li><i class="far fa-comments"></i>19</li>
                                          <li><i class="far fa-heart"></i>457</li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                          <p><?php echo wp_trim_words( get_the_content(), 15, '.' ); ?></p>
                          <a href="<?php the_permalink(); ?>"><?php echo esc_html__( 'Read More', 'makplus' ); ?> <span>+</span></a>
                      </div>
                  </div>
              </div>

              <?php } elseif( $settings['style'] == 'style2' ){ ?>

              <div class="col-lg-4 col-md-6">
                <div class="single-blog-post s-single-blog-post mb-50">
                    <div class="blog-thumb">
                        <a href="<?php the_permalink() ?>"><img src="<?php echo get_the_post_thumbnail_url( get_the_ID(),'makplus-404x279'); ?>" alt="<?php the_title() ?>"></a>
                        <span class="blog-post-date">aug 19, 2019</span>
                    </div>
                    <div class="blog-content s-blog-content">
                        <div class="blog-meta mb-10">
                          <ul>
                              <li>
                                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><i class="far fa-user"></i><?php echo esc_html__( 'By','zaaple' ); ?> <?php the_author(); ?></a>
                              </li>
                              <li><i class="far fa-comments"></i>19</li>
                              <li><i class="far fa-heart"></i>457</li>
                          </ul>
                        </div>
                        <h5><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
                        <p><?php echo wp_trim_words( get_the_content(), 13, '.' ); ?></p>
                        <a href="<?php the_permalink(); ?>"><?php echo esc_html__( 'Read More', 'makplus' ); ?><i class="fas fa-long-arrow-alt-right"></i></a>
                    </div>
                </div>
              </div>
              <?php } ?>
              <?php endwhile; wp_reset_postdata(); ?>
         </div>
      </div>

      <?php
   }
 
}
Plugin::instance()->widgets_manager->register_widget_type( new makplus_Widget_Blog );