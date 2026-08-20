<?php
/**
 * Plugin Name:       Website Section Supporter
 * Plugin URI:         https://digitizegrowth.com/
 * Description:        Adds a set of ready-made, editable Elementor section & component widgets (Header, Hero, Stats, About, Triptych, Notable Sales, Testimonial, Lifestyles, Newsletter, Blog, Team, Footer, Title, Button, Image, Text, Scroll Indicator) so you can build a full luxury-style home page block by block. Built by Digitize Growth — Luxury Real Estate Website Design, from $1,499. https://digitizegrowth.com/
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

		// Contact Section AJAX handlers
		add_action( 'wp_ajax_wss_contact_submit', array( $this, 'handle_contact_submit' ) );
		add_action( 'wp_ajax_nopriv_wss_contact_submit', array( $this, 'handle_contact_submit' ) );

		// Buyer Guide & Lead Magnet AJAX handlers
		add_action( 'wp_ajax_wss_buyer_guide_submit', array( $this, 'handle_buyer_guide_submit' ) );
		add_action( 'wp_ajax_nopriv_wss_buyer_guide_submit', array( $this, 'handle_buyer_guide_submit' ) );

		// Home Evaluation Form AJAX handlers
		add_action( 'wp_ajax_wss_home_evaluation_submit', array( $this, 'handle_home_evaluation_submit' ) );
		add_action( 'wp_ajax_nopriv_wss_home_evaluation_submit', array( $this, 'handle_home_evaluation_submit' ) );
	}

	public function handle_buyer_guide_submit() {
		// Nonce verification
		if ( ! isset( $_POST['wss_guide_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['wss_guide_nonce'] ) ), 'wss_buyer_guide_nonce' ) ) {
			wp_send_json_error( array( 'message' => __( 'Security check failed. Please refresh and try again.', 'website-section-supporter' ) ) );
		}

		// Google reCAPTCHA Verification (v2 / v3)
		$recaptcha_response = isset( $_POST['g-recaptcha-response'] ) ? sanitize_text_field( wp_unslash( $_POST['g-recaptcha-response'] ) ) : '';
		$secret_key         = isset( $_POST['recaptcha_secret'] ) ? sanitize_text_field( wp_unslash( $_POST['recaptcha_secret'] ) ) : '';
		
		if ( ! empty( $secret_key ) && ! empty( $recaptcha_response ) ) {
			$verify_url = 'https://www.google.com/recaptcha/api/siteverify';
			$response   = wp_remote_post( $verify_url, array(
				'body' => array(
					'secret'   => $secret_key,
					'response' => $recaptcha_response,
					'remoteip' => $_SERVER['REMOTE_ADDR'] ?? '',
				),
			) );

			if ( ! is_wp_error( $response ) ) {
				$result = json_decode( wp_remote_retrieve_body( $response ), true );
				if ( empty( $result['success'] ) ) {
					wp_send_json_error( array( 'message' => __( 'reCAPTCHA verification failed. Please try again.', 'website-section-supporter' ) ) );
				}
			}
		}

		$name     = isset( $_POST['wss_name'] ) ? sanitize_text_field( wp_unslash( $_POST['wss_name'] ) ) : '';
		$email    = isset( $_POST['wss_email'] ) ? sanitize_email( wp_unslash( $_POST['wss_email'] ) ) : '';
		$phone    = isset( $_POST['wss_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['wss_phone'] ) ) : '';
		$timeline = isset( $_POST['wss_timeline'] ) ? sanitize_text_field( wp_unslash( $_POST['wss_timeline'] ) ) : '';

		if ( empty( $name ) || empty( $email ) ) {
			wp_send_json_error( array( 'message' => __( 'Please fill in all required fields.', 'website-section-supporter' ) ) );
		}

		// PDF File & Attachment Resolution
		$pdf_id  = isset( $_POST['pdf_attachment_id'] ) ? absint( $_POST['pdf_attachment_id'] ) : 0;
		$pdf_url = isset( $_POST['pdf_attachment_url'] ) ? esc_url_raw( wp_unslash( $_POST['pdf_attachment_url'] ) ) : '';

		$attachments = array();
		if ( $pdf_id > 0 ) {
			$file_path = get_attached_file( $pdf_id );
			if ( $file_path && file_exists( $file_path ) ) {
				$attachments[] = $file_path;
			}
		} elseif ( ! empty( $pdf_url ) ) {
			$upload_dir = wp_upload_dir();
			if ( strpos( $pdf_url, $upload_dir['baseurl'] ) !== false ) {
				$rel_path = str_replace( $upload_dir['baseurl'], $upload_dir['basedir'], $pdf_url );
				if ( file_exists( $rel_path ) ) {
					$attachments[] = $rel_path;
				}
			}
		}

		// 1. Admin Notification Email
		$admin_to      = isset( $_POST['admin_email_to'] ) && ! empty( $_POST['admin_email_to'] ) ? sanitize_email( wp_unslash( $_POST['admin_email_to'] ) ) : get_option( 'admin_email' );
		$admin_subject = isset( $_POST['admin_email_subject'] ) && ! empty( $_POST['admin_email_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['admin_email_subject'] ) ) : 'New Buyer Blueprint Download: {{name}}';

		$admin_subject = str_replace(
			array( '{{name}}', '{{email}}', '{{phone}}', '{{timeline}}' ),
			array( $name, $email, $phone, $timeline ),
			$admin_subject
		);

		$admin_headers = array(
			'Content-Type: text/html; charset=UTF-8',
			'Reply-To: ' . $name . ' <' . $email . '>',
		);

		$admin_body  = "<div style='font-family: Arial, sans-serif; max-width: 600px; color: #1a1812; line-height: 1.6; padding: 24px; border: 1px solid #e2dfda;'>";
		$admin_body .= "<h2 style='color: #0d0d0d; border-bottom: 2px solid #0d0d0d; padding-bottom: 8px; font-size: 18px; text-transform: uppercase;'>New Buyer Blueprint Download Request</h2>";
		$admin_body .= "<p><strong>Name:</strong> " . esc_html( $name ) . "</p>";
		$admin_body .= "<p><strong>Email:</strong> " . esc_html( $email ) . "</p>";
		if ( ! empty( $phone ) ) {
			$admin_body .= "<p><strong>Phone:</strong> " . esc_html( $phone ) . "</p>";
		}
		if ( ! empty( $timeline ) ) {
			$admin_body .= "<p><strong>Timeline:</strong> " . esc_html( $timeline ) . "</p>";
		}
		$admin_body .= "<hr style='border: none; border-top: 1px solid #e2dfda; margin: 20px 0;'>";
		$admin_body .= "<p style='font-size: 11px; color: #888888;'>Sent via VP Signature Group Website Section Supporter</p>";
		$admin_body .= "</div>";

		wp_mail( $admin_to, $admin_subject, $admin_body, $admin_headers );

		// 2. User Auto-Responder Email (with PDF attached)
		$enable_autoresponder = isset( $_POST['enable_autoresponder'] ) && 'yes' === $_POST['enable_autoresponder'];
		if ( $enable_autoresponder ) {
			$sender_name  = isset( $_POST['user_sender_name'] ) && ! empty( $_POST['user_sender_name'] ) ? sanitize_text_field( wp_unslash( $_POST['user_sender_name'] ) ) : get_bloginfo( 'name' );
			$sender_email = isset( $_POST['user_sender_email'] ) && ! empty( $_POST['user_sender_email'] ) ? sanitize_email( wp_unslash( $_POST['user_sender_email'] ) ) : get_option( 'admin_email' );
			$user_subject = isset( $_POST['user_email_subject'] ) && ! empty( $_POST['user_email_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['user_email_subject'] ) ) : "Your Central Florida Luxury Buyer's Blueprint (PDF Attached)";

			$user_subject = str_replace( array( '{{name}}', '{{email}}' ), array( $name, $email ), $user_subject );

			$user_headers = array(
				'Content-Type: text/html; charset=UTF-8',
				'From: ' . $sender_name . ' <' . $sender_email . '>',
				'Reply-To: ' . $sender_name . ' <' . $sender_email . '>',
			);

			$user_msg  = "<div style='font-family: Arial, sans-serif; max-width: 600px; color: #1a1812; line-height: 1.6; padding: 24px; border: 1px solid #e2dfda;'>";
			$user_msg .= "<h2 style='color: #0d0d0d; border-bottom: 2px solid #0d0d0d; padding-bottom: 8px; font-size: 18px; text-transform: uppercase;'>Your Complimentary Buyer's Blueprint</h2>";
			$user_msg .= "<p>Dear " . esc_html( $name ) . ",</p>";
			$user_msg .= "<p>Thank you for requesting <strong>The Central Florida Luxury Buyer's Blueprint</strong>. Please find your exclusive copy attached to this email.</p>";
			if ( ! empty( $pdf_url ) ) {
				$user_msg .= "<p style='margin: 20px 0;'><a href='" . esc_url( $pdf_url ) . "' style='background: #0d0d0d; color: #ffffff; padding: 12px 24px; text-decoration: none; border-radius: 4px; display: inline-block; font-weight: bold; font-size: 13px;'>Download Buyer Blueprint (PDF)</a></p>";
			}
			$user_msg .= "<p>Whether you are exploring private lakefront enclaves in Windermere, historic estates in Winter Park, or golf residences in Lake Nona, our team is here to guide your search with discretion and strategic insight.</p>";
			$user_msg .= "<p>Warm regards,<br><strong>Victoria Price | Broker - Owner</strong><br>VP Signature Group<br>+1 (407) 584-7494<br><a href='mailto:admin@vpsignature.com'>admin@vpsignature.com</a></p>";
			$user_msg .= "<hr style='border: none; border-top: 1px solid #e2dfda; margin: 20px 0;'>";
			$user_msg .= "<p style='font-size: 11px; color: #888888;'>VP Signature Group • 300 S Orange Ave, Orlando, FL 32801 • FL License: BK3403615</p>";
			$user_msg .= "</div>";

			$attach_pdf = isset( $_POST['attach_pdf'] ) && 'yes' === $_POST['attach_pdf'];
			$user_attachments = $attach_pdf ? $attachments : array();

			wp_mail( $email, $user_subject, $user_msg, $user_headers, $user_attachments );
		}

		wp_send_json_success( array(
			'message' => __( 'Thank you! Your complimentary Buyer Blueprint has been sent to your email and is ready for download.', 'website-section-supporter' ),
			'pdf_url' => $pdf_url,
		) );
	}

	public function handle_home_evaluation_submit() {
		// Nonce verification with caching fallback
		$nonce = isset( $_POST['wss_eval_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['wss_eval_nonce'] ) ) : '';
		if ( ! empty( $nonce ) && ! wp_verify_nonce( $nonce, 'wss_home_evaluation_nonce' ) ) {
			if ( ! check_ajax_referer( 'wss_home_evaluation_nonce', 'wss_eval_nonce', false ) && ! is_user_logged_in() ) {
				// Don't hard-fail if request has valid submitted fields to protect against static page caching
				if ( empty( $_POST['wss_fields'] ) && empty( $_POST['wss_name'] ) && empty( $_POST['wss_email'] ) ) {
					wp_send_json_error( array( 'message' => __( 'Security check failed. Please refresh and try again.', 'website-section-supporter' ) ) );
				}
			}
		}

		// Google reCAPTCHA Verification (v2 / v3)
		$recaptcha_response = isset( $_POST['g-recaptcha-response'] ) ? sanitize_text_field( wp_unslash( $_POST['g-recaptcha-response'] ) ) : '';
		$secret_key         = isset( $_POST['recaptcha_secret'] ) ? sanitize_text_field( wp_unslash( $_POST['recaptcha_secret'] ) ) : '';
		
		if ( ! empty( $secret_key ) && ! empty( $recaptcha_response ) ) {
			$verify_url = 'https://www.google.com/recaptcha/api/siteverify';
			$response   = wp_remote_post( $verify_url, array(
				'body' => array(
					'secret'   => $secret_key,
					'response' => $recaptcha_response,
					'remoteip' => $_SERVER['REMOTE_ADDR'] ?? '',
				),
				'timeout' => 8,
			) );

			if ( ! is_wp_error( $response ) ) {
				$result = json_decode( wp_remote_retrieve_body( $response ), true );
				if ( is_array( $result ) && empty( $result['success'] ) ) {
					wp_send_json_error( array( 'message' => __( 'reCAPTCHA verification failed. Please try again.', 'website-section-supporter' ) ) );
				}
			}
		}

		// Collect Form Builder Fields
		$submitted_fields = array();
		$client_name  = '';
		$client_email = '';
		$client_phone = '';
		$address_val  = '';

		if ( isset( $_POST['wss_fields'] ) && is_array( $_POST['wss_fields'] ) ) {
			foreach ( $_POST['wss_fields'] as $raw_label => $raw_value ) {
				$label = sanitize_text_field( wp_unslash( $raw_label ) );
				if ( is_array( $raw_value ) ) {
					$val_clean = implode( ', ', array_map( 'sanitize_text_field', wp_unslash( $raw_value ) ) );
				} else {
					$val_clean = sanitize_textarea_field( wp_unslash( $raw_value ) );
				}
				$submitted_fields[ $label ] = $val_clean;

				// Auto-detect key fields
				$lower_label = strtolower( $label );
				if ( strpos( $lower_label, 'email' ) !== false && empty( $client_email ) && is_email( $val_clean ) ) {
					$client_email = $val_clean;
				}
				if ( ( strpos( $lower_label, 'name' ) !== false || strpos( $lower_label, 'client' ) !== false ) && empty( $client_name ) ) {
					$client_name = $val_clean;
				}
				if ( ( strpos( $lower_label, 'phone' ) !== false || strpos( $lower_label, 'tel' ) !== false ) && empty( $client_phone ) ) {
					$client_phone = $val_clean;
				}
				if ( ( strpos( $lower_label, 'address' ) !== false || strpos( $lower_label, 'property' ) !== false ) && empty( $address_val ) ) {
					$address_val = $val_clean;
				}
			}
		}

		// Fallback detection from standard post keys
		if ( empty( $client_name ) && isset( $_POST['wss_name'] ) ) $client_name = sanitize_text_field( wp_unslash( $_POST['wss_name'] ) );
		if ( empty( $client_email ) && isset( $_POST['wss_email'] ) ) $client_email = sanitize_email( wp_unslash( $_POST['wss_email'] ) );
		if ( empty( $client_phone ) && isset( $_POST['wss_phone'] ) ) $client_phone = sanitize_text_field( wp_unslash( $_POST['wss_phone'] ) );
		if ( empty( $address_val ) && isset( $_POST['wss_address'] ) ) $address_val = sanitize_text_field( wp_unslash( $_POST['wss_address'] ) );

		if ( empty( $client_name ) ) $client_name = 'Prospective Client';
		if ( empty( $address_val ) ) $address_val = 'Property Valuation Inquiry';

		// 1. Admin Notification Email
		$admin_to      = isset( $_POST['admin_email_to'] ) && ! empty( $_POST['admin_email_to'] ) ? sanitize_email( wp_unslash( $_POST['admin_email_to'] ) ) : get_option( 'admin_email' );
		$admin_subject = isset( $_POST['admin_email_subject'] ) && ! empty( $_POST['admin_email_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['admin_email_subject'] ) ) : 'New Property Valuation Request from {{Full Name}}';

		// Replace tokens
		foreach ( $submitted_fields as $lbl => $val ) {
			$admin_subject = str_replace( '{{' . $lbl . '}}', $val, $admin_subject );
		}
		$admin_subject = str_replace(
			array( '{{name}}', '{{address}}', '{{email}}', '{{phone}}' ),
			array( $client_name, $address_val, $client_email, $client_phone ),
			$admin_subject
		);

		$admin_headers = array(
			'Content-Type: text/html; charset=UTF-8',
		);
		if ( ! empty( $client_email ) ) {
			$admin_headers[] = 'Reply-To: ' . $client_name . ' <' . $client_email . '>';
		}

		$admin_body  = "<div style='font-family: Arial, sans-serif; max-width: 640px; color: #1a1812; line-height: 1.6; padding: 28px; border: 1px solid #e2dfda; background-color: #fdfdfc;'>";
		$admin_body .= "<div style='border-bottom: 2px solid #0d0d0d; padding-bottom: 12px; margin-bottom: 20px;'>";
		$admin_body .= "<h2 style='color: #0d0d0d; margin: 0; font-size: 20px; text-transform: uppercase; letter-spacing: 0.05em;'>New Property Valuation Request</h2>";
		$admin_body .= "<p style='color: #777777; font-size: 12px; margin: 4px 0 0; text-transform: uppercase; letter-spacing: 0.1em;'>VP Signature Group Advisory Portal</p>";
		$admin_body .= "</div>";

		$admin_body .= "<table style='width: 100%; border-collapse: collapse; font-size: 14px;'>";
		foreach ( $submitted_fields as $f_label => $f_value ) {
			$admin_body .= "<tr style='border-bottom: 1px solid #eeeeee;'>";
			$admin_body .= "<td style='padding: 10px 0; width: 36%; color: #666666; vertical-align: top;'><strong>" . esc_html( $f_label ) . ":</strong></td>";
			$admin_body .= "<td style='padding: 10px 0; color: #0d0d0d; font-weight: 500;'>" . nl2br( esc_html( $f_value ) ) . "</td>";
			$admin_body .= "</tr>";
		}
		$admin_body .= "</table>";

		$admin_body .= "<div style='margin-top: 30px; padding-top: 14px; border-top: 1px solid #e2dfda; font-size: 11px; color: #888888; text-align: center;'>";
		$admin_body .= "Sent securely via Website Section Supporter (WSS) Form Builder Engine";
		$admin_body .= "</div></div>";

		wp_mail( $admin_to, $admin_subject, $admin_body, $admin_headers );

		// 2. Client Auto-Responder Confirmation Email
		$enable_autoresponder = isset( $_POST['enable_client_autoresponder'] ) && 'yes' === $_POST['enable_client_autoresponder'];
		if ( $enable_autoresponder && ! empty( $client_email ) ) {
			$sender_name  = isset( $_POST['client_sender_name'] ) && ! empty( $_POST['client_sender_name'] ) ? sanitize_text_field( wp_unslash( $_POST['client_sender_name'] ) ) : 'Victoria Price | VP Signature Group';
			$sender_email = isset( $_POST['client_sender_email'] ) && ! empty( $_POST['client_sender_email'] ) ? sanitize_email( wp_unslash( $_POST['client_sender_email'] ) ) : ( ! empty( $admin_to ) ? $admin_to : get_option( 'admin_email' ) );
			$user_subject = isset( $_POST['client_email_subject'] ) && ! empty( $_POST['client_email_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['client_email_subject'] ) ) : 'Property Valuation Request Confirmed | VP Signature Group';

			// Token replacements
			foreach ( $submitted_fields as $lbl => $val ) {
				$user_subject = str_replace( '{{' . $lbl . '}}', $val, $user_subject );
			}
			$user_subject = str_replace(
				array( '{{name}}', '{{address}}' ),
				array( $client_name, $address_val ),
				$user_subject
			);

			$user_headers = array(
				'Content-Type: text/html; charset=UTF-8',
				'From: ' . $sender_name . ' <' . $sender_email . '>',
				'Reply-To: ' . $sender_email,
			);

			$user_msg  = "<div style='font-family: Arial, sans-serif; max-width: 600px; color: #1a1812; line-height: 1.7; padding: 30px; border: 1px solid #e2dfda; background-color: #ffffff;'>";
			$user_msg .= "<h2 style='color: #0d0d0d; font-size: 18px; text-transform: uppercase; letter-spacing: 0.08em; border-bottom: 2px solid #0d0d0d; padding-bottom: 10px; margin-top: 0;'>Property Valuation Request Confirmed</h2>";
			$user_msg .= "<p>Dear " . esc_html( $client_name ) . ",</p>";
			$user_msg .= "<p>Thank you for trusting <strong>VP Signature Group</strong> with the valuation of your residence.</p>";
			$user_msg .= "<p>Unlike automated online estimates, Victoria Price and our analytics team are personally conducting a comprehensive sub-market comparative analysis, factoring in recent comparable sales, pending transactions, and current high-net-worth buyer demand across Central Florida.</p>";
			$user_msg .= "<p>Your customized property dossier will be delivered within 24 to 48 business hours.</p>";
			$user_msg .= "<p style='margin-top: 24px;'>Warm regards,</p>";
			$user_msg .= "<p><strong>Victoria Price</strong><br><span style='font-size: 12px; color: #777;'>Founder & Principal Advisor<br>VP Signature Group | Central Florida Luxury Real Estate<br>Direct: +1 (407) 584-7494<br>Email: admin@vpsignature.com</span></p>";
			$user_msg .= "</div>";

			wp_mail( $client_email, $user_subject, $user_msg, $user_headers );
		}

		wp_send_json_success( array(
			'message' => __( 'Thank you! Victoria Price and our analytics team have initiated your sub-market comparative study. Your confidential property dossier is being assembled.', 'website-section-supporter' ),
		) );
	}

	public function handle_contact_submit() {
		// Nonce verification
		if ( ! isset( $_POST['wss_contact_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['wss_contact_nonce'] ) ), 'wss_contact_nonce' ) ) {
			wp_send_json_error( array( 'message' => __( 'Security check failed. Please refresh and try again.', 'website-section-supporter' ) ) );
		}

		// Google reCAPTCHA Verification (v2 / v3)
		$recaptcha_response = isset( $_POST['g-recaptcha-response'] ) ? sanitize_text_field( wp_unslash( $_POST['g-recaptcha-response'] ) ) : '';
		$secret_key         = isset( $_POST['recaptcha_secret'] ) ? sanitize_text_field( wp_unslash( $_POST['recaptcha_secret'] ) ) : '';
		
		if ( ! empty( $secret_key ) && ! empty( $recaptcha_response ) ) {
			$verify_url = 'https://www.google.com/recaptcha/api/siteverify';
			$response   = wp_remote_post( $verify_url, array(
				'body' => array(
					'secret'   => $secret_key,
					'response' => $recaptcha_response,
					'remoteip' => $_SERVER['REMOTE_ADDR'] ?? '',
				),
			) );

			if ( ! is_wp_error( $response ) ) {
				$result = json_decode( wp_remote_retrieve_body( $response ), true );
				if ( empty( $result['success'] ) ) {
					wp_send_json_error( array( 'message' => __( 'reCAPTCHA verification failed. Please try again.', 'website-section-supporter' ) ) );
				}
			}
		}

		$name     = isset( $_POST['wss_name'] ) ? sanitize_text_field( wp_unslash( $_POST['wss_name'] ) ) : '';
		$email    = isset( $_POST['wss_email'] ) ? sanitize_email( wp_unslash( $_POST['wss_email'] ) ) : '';
		$phone    = isset( $_POST['wss_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['wss_phone'] ) ) : '';
		$interest = isset( $_POST['wss_interest'] ) ? sanitize_text_field( wp_unslash( $_POST['wss_interest'] ) ) : '';
		$message  = isset( $_POST['wss_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['wss_message'] ) ) : '';

		if ( empty( $name ) || empty( $email ) ) {
			wp_send_json_error( array( 'message' => __( 'Please fill in all required fields.', 'website-section-supporter' ) ) );
		}

		$to      = isset( $_POST['email_to'] ) && ! empty( $_POST['email_to'] ) ? sanitize_email( wp_unslash( $_POST['email_to'] ) ) : get_option( 'admin_email' );
		$cc      = isset( $_POST['email_cc'] ) ? sanitize_text_field( wp_unslash( $_POST['email_cc'] ) ) : '';
		$bcc     = isset( $_POST['email_bcc'] ) ? sanitize_text_field( wp_unslash( $_POST['email_bcc'] ) ) : '';
		$subject = isset( $_POST['email_subject'] ) && ! empty( $_POST['email_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['email_subject'] ) ) : 'New Luxury Inquiry from {{name}} - {{interest}}';
		$type    = isset( $_POST['email_content_type'] ) && $_POST['email_content_type'] === 'plain' ? 'text/plain' : 'text/html';

		// Replace dynamic placeholder tokens
		$subject = str_replace(
			array( '{{name}}', '{{email}}', '{{phone}}', '{{interest}}', '{{message}}' ),
			array( $name, $email, $phone, $interest, $message ),
			$subject
		);

		$body = "";
		if ( $type === 'text/html' ) {
			$body .= "<div style='font-family: Arial, sans-serif; max-width: 600px; color: #1a1812; line-height: 1.6; padding: 20px; border: 1px solid #e6e1d6;'>";
			$body .= "<h2 style='color: #1a1812; border-bottom: 2px solid #a8916f; padding-bottom: 8px; font-size: 18px; text-transform: uppercase;'>New Direct Contact Inquiry</h2>";
			$body .= "<p><strong>Name:</strong> " . esc_html( $name ) . "</p>";
			$body .= "<p><strong>Email:</strong> " . esc_html( $email ) . "</p>";
			$body .= "<p><strong>Phone:</strong> " . esc_html( $phone ) . "</p>";
			$body .= "<p><strong>Interest:</strong> " . esc_html( $interest ) . "</p>";
			$body .= "<p><strong>Message:</strong><br>" . nl2br( esc_html( $message ) ) . "</p>";
			$body .= "<hr style='border: none; border-top: 1px solid #e6e1d6; margin: 20px 0;'>";
			$body .= "<p style='font-size: 11px; color: #8c8577;'>Sent via Noir Estates Luxury Website Section Supporter</p>";
			$body .= "</div>";
		} else {
			$body .= "New Direct Contact Inquiry\n\n";
			$body .= "Name: " . $name . "\n";
			$body .= "Email: " . $email . "\n";
			$body .= "Phone: " . $phone . "\n";
			$body .= "Interest: " . $interest . "\n";
			$body .= "Message:\n" . $message . "\n";
		}

		$headers = array();
		$headers[] = 'Content-Type: ' . $type . '; charset=UTF-8';
		$headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
		if ( ! empty( $cc ) ) { $headers[] = 'Cc: ' . $cc; }
		if ( ! empty( $bcc ) ) { $headers[] = 'Bcc: ' . $bcc; }

		// Send Email
		$sent = wp_mail( $to, $subject, $body, $headers );

		// Record in Elementor Pro Submissions (if active)
		if ( class_exists( '\ElementorPro\Plugin' ) ) {
			$submission_data = array(
				'post_id' => isset( $_POST['post_id'] ) ? absint( $_POST['post_id'] ) : 0,
				'form_id' => isset( $_POST['widget_id'] ) ? sanitize_text_field( wp_unslash( $_POST['widget_id'] ) ) : 'wss_contact',
				'fields'  => array(
					'wss_name'     => $name,
					'wss_email'    => $email,
					'wss_phone'    => $phone,
					'wss_interest' => $interest,
					'wss_message'  => $message,
				),
				'meta'    => array(
					'remote_ip'  => $_SERVER['REMOTE_ADDR'] ?? '',
					'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
				),
			);
			do_action( 'elementor_pro/forms/new_record', $submission_data );
		}

		$success_msg = isset( $_POST['success_msg'] ) && ! empty( $_POST['success_msg'] ) ? sanitize_text_field( wp_unslash( $_POST['success_msg'] ) ) : __( 'Thank you for contacting us. We will get back to you shortly.', 'website-section-supporter' );

		if ( $sent ) {
			wp_send_json_success( array( 'message' => $success_msg ) );
		} else {
			wp_send_json_error( array( 'message' => __( 'Failed to send email. Please check server mail settings.', 'website-section-supporter' ) ) );
		}
	}

	public function handle_newsletter_submit() {
		// Nonce check
		if ( ! isset( $_POST['wss_newsletter_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['wss_newsletter_nonce'] ) ), 'wss_newsletter_nonce' ) ) {
			wp_send_json_error( array( 'message' => 'Security check failed.' ) );
		}

		// Google reCAPTCHA Verification (v2 / v3)
		$recaptcha_response = isset( $_POST['g-recaptcha-response'] ) ? sanitize_text_field( wp_unslash( $_POST['g-recaptcha-response'] ) ) : '';
		$secret_key         = isset( $_POST['recaptcha_secret'] ) ? sanitize_text_field( wp_unslash( $_POST['recaptcha_secret'] ) ) : '';
		
		if ( ! empty( $secret_key ) && ! empty( $recaptcha_response ) ) {
			$verify_url = 'https://www.google.com/recaptcha/api/siteverify';
			$response   = wp_remote_post( $verify_url, array(
				'body' => array(
					'secret'   => $secret_key,
					'response' => $recaptcha_response,
					'remoteip' => $_SERVER['REMOTE_ADDR'] ?? '',
				),
			) );

			if ( ! is_wp_error( $response ) ) {
				$result = json_decode( wp_remote_retrieve_body( $response ), true );
				if ( empty( $result['success'] ) ) {
					wp_send_json_error( array( 'message' => __( 'reCAPTCHA verification failed. Please try again.', 'website-section-supporter' ) ) );
				}
			}
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

		wp_localize_script(
			'wss-widgets',
			'wss_ajax_obj',
			array(
				'ajax_url'      => admin_url( 'admin-ajax.php' ),
				'eval_nonce'    => wp_create_nonce( 'wss_home_evaluation_nonce' ),
				'guide_nonce'   => wp_create_nonce( 'wss_buyer_guide_nonce' ),
				'contact_nonce' => wp_create_nonce( 'wss_contact_nonce' ),
			)
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
