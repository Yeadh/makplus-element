<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Banner
class uhu_Widget_Banner5 extends Widget_Base {

    public function get_name() {
        return 'banner5';
    }

    public function get_title() {
        return esc_html__( 'Banner With Search 2', 'makplus' );
    }

    public function get_icon() {
        return 'eicon-slider-video';
    }

    public function get_categories() {
        return [ 'makplus-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'banner_section',
            [
                'label' => esc_html__( 'Banner 5', 'makplus' ),
                'type' => Controls_Manager::SECTION,
            ]
        );


        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'makplus' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Create & Manage Team Matches','makplus')
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'makplus' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Find technology people for digital projects in public sector and Find individual specialist develop researcher.','uhu')
            ]
        );


        $this->add_control(
            'btn-text',
            [
                'label' => __( 'Button', 'makplus' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Browse Projects','makplus')
            ]
        );

        $this->add_control(
            'btn-url',
            [
                'label' => __( 'URL', 'makplus' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '#'
            ]
        );
        $this->add_control(
            'video-background',
            [
                'label' => __( 'Video Image', 'makplus' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'video-url',
            [
                'label' => __( 'Video URL', 'makplus' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '#'
            ]
        );


        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        // get our input from the widget settings.
        $settings = $this->get_settings_for_display(); ?>
        <!-- slider-area -->
        <section class="slider-area slider-bg">
            <div class="container">
                <div class="slider-wrap home_three">
                    <div class="row align-items-center">
                        <div class="col-lg-10 offset-1 text-center">
                            <div class="slider-content">
                                <h2 class="wow fadeInDown" data-wow-delay="0.2s"><?php echo  esc_html($settings['title']) ?></h2>
                                <p class="wow fadeInUp" data-wow-delay="0.2s"><?php echo esc_html( $settings['description'] ) ?></p>




                                <div class="gemas-search-box">
                                    <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
                                          <?php
                                          $makplus_cat_dropdown_args = array(
                                           'show_option_all' => __( 'Any Category' ),
                                           'taxonomy' => 'product_cat',
                                           'class' => 'custom-select',
                                          );
                                          wp_dropdown_categories( $makplus_cat_dropdown_args );
                                          ?>
                                          <input type="text" placeholder="Type and Hit Enter...">
                                          <button type="submit" ><i class="fas fa-search"></i></button>
                                          <input type="hidden" name="post_type" value="product" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- slider-area-end -->

        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new uhu_Widget_Banner5 );