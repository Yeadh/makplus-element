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
         'sub-title',
         [
            'label' => __( 'Sub Title', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('latest news & blog','makplus')
         ]
      );


      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Recent News.','makplus')
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


      <!-- blog-area -->
      <section class="blog-area gray-bg pt-120 pb-90">
          <div class="container">
              <div class="row">
                  <div class="col-lg-6">
                      <div class="section-title mb-50">
                          <span><?php echo esc_html($settings['sub-title']); ?></span>
                          <h2><?php echo esc_html($settings['title']); ?></h2>
                      </div>
                  </div>
              </div>
              <div class="row">

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
                      <div class="blog-post mb-30">
                          <?php if (has_post_thumbnail()): ?>
                          <div class="blog-thumb">
                              <a href="<?php the_permalink() ?>"><img src="<?php echo get_the_post_thumbnail_url( get_the_ID(),'makplus-404x297'); ?>" alt="<?php the_title_attribute() ?>"></a>
                          </div>
                          <?php endif ?>
                          
                          <div class="blog-content">
                              <div class="blog-meta">
                                  <ul>
                                      <li><i class="far fa-clock"></i><?php the_date() ?> <?php echo esc_html__( 'in','digimarket' ) ?> <?php echo get_the_category()[0]->name; ?></li>
                                      <li><i class="fas fa-comment"></i><?php comments_number( '0', '1', '%' ); ?></li>
                                  </ul>
                              </div>
                              <h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
                              <p><?php echo wp_trim_words( get_the_content(), 16, '.' ); ?></p>
                              <div class="blog-post-avatar">
                                  <div class="blog-avatar-img">
                                      <?php echo get_avatar( get_the_author_meta( 'ID' ), '36'); ?>
                                  </div>
                                  <div class="blog-avatar-info">
                                      <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">- <?php the_author() ?></a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

                <?php endwhile; wp_reset_postdata(); ?>

              </div>
          </div>
      </section>
      <!-- blog-area-end -->
      <?php
   }
 
}
Plugin::instance()->widgets_manager->register_widget_type( new makplus_Widget_Blog );