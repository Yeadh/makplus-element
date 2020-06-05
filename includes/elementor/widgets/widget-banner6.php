<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Banner
class uhu_Widget_Banner6 extends Widget_Base {

    public function get_name() {
        return 'banner6';
    }

    public function get_title() {
        return esc_html__( 'Banner Stock Photo 1', 'makplus' );
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
                'label' => esc_html__( 'Banner Stock Photo 1', 'makplus' ),
                'type' => Controls_Manager::SECTION,
            ]
        );

		$this->add_control(
            'sub-title',
            [
                'label' => __( 'Sub Title', 'makplus' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('creative','makplus')
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'makplus' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Images you will want Royalty-free Authentic imagery winning','makplus')
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'makplus' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Founded in a belief that no one holds the rights to inspiration, we believe everyone should have the amazing stories collection','makplus')
            ]
        );


        $this->add_control(
            'btn-text',
            [
                'label' => __( 'Button', 'makplus' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Browse Images','makplus')
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
        

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        // get our input from the widget settings.
        $settings = $this->get_settings_for_display(); ?>
         <!-- slider-area -->
            <section class="slider-area slider-bg banner_stock">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-7 col-lg-9">
                            <div class="slider-content text-center">
                                <h2><?php echo esc_html($settings['sub-title']) ?></h2>
                                <h5><?php echo esc_html($settings['title']) ?></h5>
                                <p><?php echo esc_html($settings['description']) ?></p>
                                <a href="<?php echo esc_url($settings['btn-url']) ?>" class="btn"><?php echo esc_html($settings['btn-text']) ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- slider-area-end -->

        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new uhu_Widget_Banner6 );