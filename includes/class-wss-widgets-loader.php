<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers the "Website Section Supporter" Elementor category and
 * loads/registers every section widget shipped with the plugin.
 */
class WSS_Widgets_Loader {

	public function __construct() {
		add_action( 'elementor/elements/categories_registered', array( $this, 'add_category' ) );
		add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ) );
	}

	public function add_category( $elements_manager ) {
		$elements_manager->add_category(
			'website-section-supporter',
			array(
				'title' => __( 'Website Section Supporter', 'website-section-supporter' ),
				'icon'  => 'eicon-flex',
			)
		);
	}

	public function register_widgets( $widgets_manager ) {

		$widget_files = array(
			'class-wss-header-widget.php'         => 'WSS_Header_Widget',
			'class-wss-hero-widget.php'            => 'WSS_Hero_Widget',
			'class-wss-stats-widget.php'           => 'WSS_Stats_Widget',
			'class-wss-about-widget.php'           => 'WSS_About_Widget',
			'class-wss-triptych-widget.php'        => 'WSS_Triptych_Widget',
			'class-wss-notable-sales-widget.php'   => 'WSS_Notable_Sales_Widget',
			'class-wss-testimonial-widget.php'     => 'WSS_Testimonial_Widget',
			'class-wss-lifestyles-widget.php'      => 'WSS_Lifestyles_Widget',
			'class-wss-newsletter-widget.php'      => 'WSS_Newsletter_Widget',
			'class-wss-footer-widget.php'          => 'WSS_Footer_Widget',
			// Component Widgets (Building Blocks)
			'class-wss-title-widget.php'           => 'WSS_Title_Widget',
			'class-wss-button-widget.php'          => 'WSS_Button_Widget',
			'class-wss-image-widget.php'           => 'WSS_Image_Widget',
			'class-wss-text-widget.php'            => 'WSS_Text_Widget',
		);

		foreach ( $widget_files as $file => $class_name ) {
			$path = WSS_PATH . 'widgets/' . $file;
			if ( file_exists( $path ) ) {
				require_once $path;
				if ( class_exists( $class_name ) ) {
					$widgets_manager->register( new $class_name() );
				}
			}
		}
	}
}
