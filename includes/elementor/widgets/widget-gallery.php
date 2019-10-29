<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// service item
class makplus_Widget_Gallery extends Widget_Base {
 
   public function get_name() {
      return 'gallery';
   }
 
   public function get_title() {
      return esc_html__( 'Gallery Item', 'makplus' );
   }
 
   public function get_icon() { 
      return 'eicon-facebook-comments';
   }
 
   public function get_categories() {
      return [ 'makplus-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'gallery_section',
         [
            'label' => esc_html__( 'Gallery Item', 'makplus' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'sub-title',
         [
            'label' => __( 'Sub Title', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Awesome Portfolio','makplus')
         ]
      );
      
      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Our Exclusive Gallery','makplus')
         ]
      );

      $gallery = new \Elementor\Repeater();

      $gallery->add_control(
         'image',
         [
            'label' => __( 'Image', 'makplus' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
         ]     
      );

      $gallery->add_control(
         'title',
         [
            'label' => __( 'Title', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __( 'Sequrity Management', 'makplus' )
         ]
      );

      $gallery->add_control(
         'text',
         [
            'label' => __( 'Subtitle', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __( 'Blending Image', 'makplus' )
         ]
      );

      $this->add_control(
         'gallery_list',
         [
            'label' => __( 'Gallery', 'makplus' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $gallery->get_controls(),
            'title_field' => '{{{ title }}}',
         ]
      );

      $this->add_control(
         'btn-text',
         [
            'label' => __( 'Button Text', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('More Project','makplus')
         ]
      );

      $this->add_control(
         'btn-url',
         [
            'label' => __( 'Button URL', 'makplus' ),
            'type' => \Elementor\Controls_Manager::TEXT
         ]
      );

      $this->end_controls_section();
   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
      $settings = $this->get_settings_for_display(); ?>

      <!-- project-area -->
      <section class="project-area primary-bg pt-115 pb-130">
          <div class="container">
              <div class="row justify-content-center">
                  <div class="col-xl-5">
                      <div class="section-title text-center mb-60">
                          <span><?php echo esc_html($settings['sub-title']) ?></span>
                          <h2><?php echo esc_html($settings['title']) ?></h2>
                      </div>
                  </div>
              </div>
          </div>
          <div class="container-fluid p-0 fix">
              <div class="row no-gutters">
                  <div class="col-12">
                      <div class="project-active">
                        <?php foreach ( $settings['gallery_list'] as $gallery_item ): ?>
                           <div class="single-project text-center">
                              <?php echo wp_get_attachment_image( $gallery_item['image']['id'],'full'); ?>
                              <div class="project-overlay">
                                 <h5><a href="#"><?php echo esc_html($gallery_item['title']); ?></a></h5>
                                 <span><?php echo esc_html($gallery_item['text']); ?></span>
                              </div>
                           </div>
                        <?php endforeach ?>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-12">
                      <div class="project-btn mt-30 text-center">
                          <a href="<?php echo esc_url($settings['btn-url']) ?>" class="btn"><?php echo esc_html($settings['btn-text']) ?></a>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- project-area-end -->
      <?php
   }
 
}
Plugin::instance()->widgets_manager->register_widget_type( new makplus_Widget_Gallery );