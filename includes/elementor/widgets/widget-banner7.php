<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Banner
class uhu_Widget_Banner7 extends Widget_Base {

    public function get_name() {
        return 'banner3';
    }

    public function get_title() {
        return esc_html__( 'Banner Stock Photo 2', 'uhu' );
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
                'label' => esc_html__( 'Banner Stock Photo 2', 'uhu' ),
                'type' => Controls_Manager::SECTION,
            ]
        );


        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'uhu' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Create & Manage Team Matches','uhu')
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'uhu' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Find technology people for digital projects in public sector and Find individual specialist develop researcher.','uhu')
            ]
        );


        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        // get our input from the widget settings.
        $settings = $this->get_settings_for_display(); ?>
        <!-- slider-area -->
        <section class="slider-area stock_photo2">
            <div class="container">
                <div class="slider-wrap home_three">
                    <div class="row align-items-center">
                        <div class="col-lg-10 offset-1 text-center">
                            <div class="slider-content">
                                <h2 class="wow fadeInDown" data-wow-delay="0.2s"><?php echo  esc_html($settings['title']) ?></h2>
                                <p class="wow fadeInUp" data-wow-delay="0.2s"><?php echo esc_html( $settings['description'] ) ?></p>
                                <div class="search-fields">
                                    <form action="<?php echo esc_url(home_url( '/' )); ?>">
                                        <input type="text" name="s"  placeholder="<?php echo esc_attr_x( 'Search here...', 'placeholder', 'uhu' ); ?>">
                                        <button><i class="fa fa-search"></i></button>
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

Plugin::instance()->widgets_manager->register_widget_type( new uhu_Widget_Banner7 );