<?php
/**
 * Plugin Name:       Website Section Supporter
 * Plugin URI:         https://digitizegrowth.com/
 * Description:        Adds a set of ready-made, editable Elementor section & component widgets (Header, Hero, Stats, About, Triptych, Notable Sales, Testimonial, Lifestyles, Newsletter, Blog, Footer, Title, Button, Image, Text) so you can build a full luxury-style home page block by block. Built by Digitize Growth — Luxury Real Estate Website Design, from $1,499. https://digitizegrowth.com/
 * Version:             1.3.0
 * Requires at least:   6.0
 * Requires PHP:        7.4
 * Elementor tested up to: 3.25
 * Elementor Pro tested up to: 3.25
 * Author:              Digitize Growth
 * Author URI:          https://digitizegrowth.com/
 * License:             GPL-2.0+
 * License URI:         https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:         website-section-supporter
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access.
}

define( 'WSS_VERSION', '1.3.0' );
define( 'WSS_PATH', plugin_dir_path( __FILE__ ) );
define( 'WSS_URL', plugin_dir_url( __FILE__ ) );
define( 'WSS_CREDIT_URL', 'https://digitizegrowth.com/' );
define( 'WSS_CREDIT_NAME', 'Digitize Growth' );

/**
 * Main plugin class. Everything is kicked off from here.
 */
final class Website_Section_Supporter {

	private static $instance = null;

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	public function init() {

		// Bail out (with an admin notice) if Elementor isn't active.
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_elementor' ) );
			return;
		}

		require_once WSS_PATH . 'includes/class-wss-widgets-loader.php';
		new WSS_Widgets_Loader();

		// Standard WordPress hook — always fires on the real front-end page,
		// regardless of which internal Elementor hook names exist in a given version.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// So the CSS/JS also loads inside the Elementor editor preview iframe.
		add_action( 'elementor/preview/enqueue_styles', array( $this, 'enqueue_styles' ) );
		add_action( 'elementor/preview/enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// And inside the editor panel itself, so controls/previews behave.
		add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'enqueue_styles' ) );
		add_action( 'elementor/editor/after_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// Newsletter AJAX handlers
		add_action( 'wp_ajax_wss_newsletter_submit', array( $this, 'handle_newsletter_submit' ) );
		add_action( 'wp_ajax_nopriv_wss_newsletter_submit', array( $this, 'handle_newsletter_submit' ) );
	}

	public function handle_newsletter_submit() {
		// Nonce check
		if ( ! isset( $_POST['wss_newsletter_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['wss_newsletter_nonce'] ) ), 'wss_newsletter_nonce' ) ) {
			wp_send_json_error( array( 'message' => 'Security check failed.' ) );
		}

		$name  = isset( $_POST['wss_name'] ) ? sanitize_text_field( wp_unslash( $_POST['wss_name'] ) ) : '';
		$email = isset( $_POST['wss_email'] ) ? sanitize_email( wp_unslash( $_POST['wss_email'] ) ) : '';

		if ( empty( $email ) ) {
			wp_send_json_error( array( 'message' => 'Invalid email address.' ) );
		}

		$to      = isset( $_POST['email_to'] ) && ! empty( $_POST['email_to'] ) ? sanitize_email( wp_unslash( $_POST['email_to'] ) ) : get_option( 'admin_email' );
		$cc      = isset( $_POST['email_cc'] ) ? sanitize_text_field( wp_unslash( $_POST['email_cc'] ) ) : '';
		$bcc     = isset( $_POST['email_bcc'] ) ? sanitize_text_field( wp_unslash( $_POST['email_bcc'] ) ) : '';
		$subject = isset( $_POST['email_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['email_subject'] ) ) : 'New Newsletter Lead: {{name}}';
		$type    = isset( $_POST['email_content_type'] ) && $_POST['email_content_type'] === 'plain' ? 'text/plain' : 'text/html';

		// Replace dynamic variables
		$subject = str_replace( array( '{{name}}', '{{email}}' ), array( $name, $email ), $subject );
		
		$body = "";
		if ( $type === 'text/html' ) {
			$body .= "<h2>New Newsletter Subscription</h2>";
			$body .= "<p><strong>Name:</strong> " . esc_html( $name ) . "</p>";
			$body .= "<p><strong>Email:</strong> " . esc_html( $email ) . "</p>";
		} else {
			$body .= "New Newsletter Subscription\n\n";
			$body .= "Name: " . $name . "\n";
			$body .= "Email: " . $email . "\n";
		}

		$headers = array();
		$headers[] = 'Content-Type: ' . $type . '; charset=UTF-8';
		$headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
		if ( ! empty( $cc ) ) { $headers[] = 'Cc: ' . $cc; }
		if ( ! empty( $bcc ) ) { $headers[] = 'Bcc: ' . $bcc; }

		// Send Email
		$sent = wp_mail( $to, $subject, $body, $headers );

		// Record in Elementor Pro Submissions (if available)
		if ( class_exists( '\ElementorPro\Plugin' ) ) {
			$submission_data = array(
				'post_id' => isset( $_POST['post_id'] ) ? absint( $_POST['post_id'] ) : 0,
				'form_id' => isset( $_POST['widget_id'] ) ? sanitize_text_field( wp_unslash( $_POST['widget_id'] ) ) : 'wss_newsletter',
				'fields'  => array(
					'wss_name'  => $name,
					'wss_email' => $email,
				),
				'meta'    => array(
					'remote_ip'  => $_SERVER['REMOTE_ADDR'] ?? '',
					'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
				),
			);
			do_action( 'elementor_pro/forms/new_record', $submission_data );
		}

		if ( $sent ) {
			wp_send_json_success( array( 'message' => 'Thank you for subscribing!' ) );
		} else {
			wp_send_json_error( array( 'message' => 'Failed to send email.' ) );
		}
	}

	public function enqueue_styles() {
		if ( wp_style_is( 'wss-widgets', 'enqueued' ) ) {
			return;
		}
		wp_enqueue_style(
			'wss-google-fonts',
			'https://fonts.googleapis.com/css2?family=Syncopate:wght@400;700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;1,300&display=swap',
			array(),
			WSS_VERSION
		);
		$css_file = WSS_PATH . 'assets/css/wss-widgets.css';
		wp_enqueue_style(
			'wss-widgets',
			WSS_URL . 'assets/css/wss-widgets.css',
			array(),
			file_exists( $css_file ) ? filemtime( $css_file ) : WSS_VERSION
		);
	}

	public function enqueue_scripts() {
		if ( wp_script_is( 'wss-widgets', 'enqueued' ) ) {
			return;
		}
		$js_file = WSS_PATH . 'assets/js/wss-widgets.js';
		wp_enqueue_script(
			'wss-widgets',
			WSS_URL . 'assets/js/wss-widgets.js',
			array( 'jquery' ),
			file_exists( $js_file ) ? filemtime( $js_file ) : WSS_VERSION,
			true
		);
	}

	public function admin_notice_missing_elementor() {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}
		echo '<div class="notice notice-warning is-dismissible"><p>';
		echo '<strong>Website Section Supporter</strong> requires <strong>Elementor</strong> to be installed and activated. ';
		echo 'Plugin built by <a href="' . esc_url( WSS_CREDIT_URL ) . '" target="_blank" rel="noopener">Digitize Growth</a>.';
		echo '</p></div>';
	}
}

Website_Section_Supporter::instance();
