<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

class WSS_Home_Evaluation_Widget extends Widget_Base {

	public function get_name() {
		return 'wss_home_evaluation';
	}

	public function get_title() {
		return __( 'WSS — Home Evaluation & Property Valuation', 'website-section-supporter' );
	}

	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	public function get_categories() {
		return array( 'website-section-supporter' );
	}

	public function get_keywords() {
		return array( 'home evaluation', 'property valuation', 'cma', 'appraisal', 'real estate', 'form', 'luxury', 'recaptcha', 'vpsignature' );
	}

	protected function register_controls() {

		/* ================= CONTENT: SECTION HEADER ================= */
		$this->start_controls_section(
			'section_content_header',
			array(
				'label' => __( 'Section Header & Narrative', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'       => __( 'Eyebrow Text', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '01 // COMPLIMENTARY ASSET VALUATION', 'website-section-supporter' ),
				'placeholder' => __( '01 // COMPLIMENTARY ASSET VALUATION', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Main Heading', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Precision Valuation. Not An Algorithm.', 'website-section-supporter' ),
				'placeholder' => __( 'Enter section heading', 'website-section-supporter' ),
				'rows'        => 2,
			)
		);

		$this->add_control(
			'heading_html_tag',
			array(
				'label'   => __( 'Heading HTML Tag', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => array(
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'div'  => 'div',
					'span' => 'span',
				),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'       => __( 'Narrative Description', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Generic instant-estimate tools fail to calculate custom craftsmanship, lakefront riparian rights, private docks, and sub-market buyer velocity. Request a confidential, data-backed property dossier prepared personally by Victoria Price.', 'website-section-supporter' ),
				'rows'        => 4,
			)
		);

		$this->add_control(
			'enable_reveal',
			array(
				'label'        => __( 'Enable Scroll Reveal Animations', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->end_controls_section();

		/* ================= CONTENT: STEP 1 - LOCATION ================= */
		$this->start_controls_section(
			'section_content_step1',
			array(
				'label' => __( 'Step 1: Property Location & Type', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'step1_tab_label',
			array(
				'label'   => __( 'Step 1 Tab Label', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Property Location', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'address_label',
			array(
				'label'   => __( 'Address Field Label', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Property Street Address *', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'address_placeholder',
			array(
				'label'   => __( 'Address Field Placeholder', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'e.g. 4820 Isleworth Country Club Dr', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'city_placeholder',
			array(
				'label'   => __( 'City / Community Placeholder', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'e.g. Windermere, Winter Park, Orlando', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'default_state',
			array(
				'label'   => __( 'Default State Value', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Florida (FL)',
			)
		);

		$this->add_control(
			'zip_placeholder',
			array(
				'label'   => __( 'ZIP Code Placeholder', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'e.g. 34786', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'categories_list',
			array(
				'label'       => __( 'Property Categories (One per line)', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => "Single-Family Luxury Residence\nLakefront / Waterfront Estate\nPenthouse / High-Rise Condominium\nEquestrian & Acreage Estate\nGolf & Country Club Property\nCustom / New Construction Build",
				'description' => __( 'Enter each category option on a new line.', 'website-section-supporter' ),
				'rows'        => 6,
			)
		);

		$this->end_controls_section();

		/* ================= CONTENT: STEP 2 - SPECS & AMENITIES ================= */
		$this->start_controls_section(
			'section_content_step2',
			array(
				'label' => __( 'Step 2: Specs, Amenities & Timeline', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'step2_tab_label',
			array(
				'label'   => __( 'Step 2 Tab Label', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Specs & Amenities', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'amenities_list',
			array(
				'label'       => __( 'Luxury Amenities Checkboxes (One per line)', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => "Private Boat Dock\nResort Pool & Lanai\n24/7 Gated Security\nGuest House / Casita\nCustom Wine Cellar\nRecent Remodel / Upgrade\nSmart Home Automation\nEquestrian Stables",
				'description' => __( 'Enter each luxury amenity pill option on a new line.', 'website-section-supporter' ),
				'rows'        => 8,
			)
		);

		$this->add_control(
			'timeline_options',
			array(
				'label'       => __( 'Selling Timeline Options (One per line)', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => "Planning to Sell (Next 30–60 Days)\nExploring Options (1–3 Months)\nLong-Term Strategy (6–12 Months)\nJust Curious / Annual Equity Checkup\nEstate Planning / Refinance",
				'description' => __( 'Enter each timeline option on a new line.', 'website-section-supporter' ),
				'rows'        => 5,
			)
		);

		$this->end_controls_section();

		/* ================= CONTENT: STEP 3 - CONTACT & DELIVERY ================= */
		$this->start_controls_section(
			'section_content_step3',
			array(
				'label' => __( 'Step 3: Contact & Delivery Method', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'step3_tab_label',
			array(
				'label'   => __( 'Step 3 Tab Label', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Contact & Delivery', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'delivery_methods',
			array(
				'label'       => __( 'Delivery Methods (One per line)', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => "Digital PDF Market Dossier via Email\nConfidential Phone Review with Victoria Price\nPrivate In-Person Walkthrough",
				'description' => __( 'Enter each delivery preference option on a new line.', 'website-section-supporter' ),
				'rows'        => 3,
			)
		);

		$this->add_control(
			'submit_btn_text',
			array(
				'label'   => __( 'Submit Button Text', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Request Confidential Valuation', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'privacy_note',
			array(
				'label'   => __( 'Privacy & Security Note', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( '100% Confidential. Your data is protected and never sold or made public.', 'website-section-supporter' ),
			)
		);

		$this->end_controls_section();

		/* ================= CONTENT: RECAPTCHA SETTINGS ================= */
		$this->start_controls_section(
			'section_content_recaptcha',
			array(
				'label' => __( 'Google reCAPTCHA (Spam Protection)', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'enable_recaptcha',
			array(
				'label'        => __( 'Enable Google reCAPTCHA', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'recaptcha_version',
			array(
				'label'     => __( 'reCAPTCHA Version', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'v3',
				'options'   => array(
					'v3' => __( 'v3 (Invisible Badge)', 'website-section-supporter' ),
					'v2' => __( 'v2 ("I\'m not a robot" Checkbox)', 'website-section-supporter' ),
				),
				'condition' => array( 'enable_recaptcha' => 'yes' ),
			)
		);

		$this->add_control(
			'recaptcha_site_key',
			array(
				'label'       => __( 'reCAPTCHA Site Key', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Google reCAPTCHA Site Key', 'website-section-supporter' ),
				'condition'   => array( 'enable_recaptcha' => 'yes' ),
			)
		);

		$this->add_control(
			'recaptcha_secret_key',
			array(
				'label'       => __( 'reCAPTCHA Secret Key', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Google reCAPTCHA Secret Key', 'website-section-supporter' ),
				'condition'   => array( 'enable_recaptcha' => 'yes' ),
			)
		);

		$this->end_controls_section();

		/* ================= CONTENT: EMAIL & AUTO-RESPONDER ================= */
		$this->start_controls_section(
			'section_content_email',
			array(
				'label' => __( 'Email & Auto-Responder Settings', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		// Admin Notification
		$this->add_control(
			'heading_email_admin',
			array(
				'label' => __( '1. Admin Notification Email', 'website-section-supporter' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'admin_email_to',
			array(
				'label'       => __( 'Recipient Email(s)', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => get_option( 'admin_email' ),
				'description' => __( 'Leave blank to send to WordPress Admin Email. Multiple emails can be separated by commas.', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'admin_email_subject',
			array(
				'label'       => __( 'Email Subject', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'New Property Valuation Request: {{address}} ({{name}})', 'website-section-supporter' ),
				'description' => __( 'Available Tokens: {{name}}, {{address}}, {{city}}, {{zip}}, {{category}}, {{timeline}}, {{email}}, {{phone}}, {{delivery}}', 'website-section-supporter' ),
			)
		);

		// Client Auto-responder
		$this->add_control(
			'heading_email_client',
			array(
				'label'     => __( '2. Client Auto-Responder Email', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'enable_client_autoresponder',
			array(
				'label'        => __( 'Send Confirmation Email to Client', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'client_sender_name',
			array(
				'label'       => __( 'Sender Name', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Victoria Price | VP Signature Group',
				'condition'   => array( 'enable_client_autoresponder' => 'yes' ),
			)
		);

		$this->add_control(
			'client_sender_email',
			array(
				'label'       => __( 'Sender / Reply-To Email', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'admin@vpsignature.com',
				'placeholder' => 'admin@vpsignature.com',
				'condition'   => array( 'enable_client_autoresponder' => 'yes' ),
			)
		);

		$this->add_control(
			'client_email_subject',
			array(
				'label'       => __( 'Client Email Subject', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Property Valuation Request Confirmed: {{address}}', 'website-section-supporter' ),
				'condition'   => array( 'enable_client_autoresponder' => 'yes' ),
			)
		);

		// Success message
		$this->add_control(
			'heading_success_state',
			array(
				'label'     => __( '3. Success Message State', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'success_title',
			array(
				'label'   => __( 'Success Title', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Valuation Request Received', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'success_message',
			array(
				'label'   => __( 'Success Message Text', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'Thank you. Victoria Price and our analytics team have initiated your sub-market comparative study. Your confidential property dossier is being assembled and will be delivered shortly.', 'website-section-supporter' ),
				'rows'    => 3,
			)
		);

		$this->add_control(
			'reset_btn_text',
			array(
				'label'   => __( 'Reset / Submit Another Button Text', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Submit Another Property', 'website-section-supporter' ),
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: THEME PRESET & CONTAINER ================= */
		$this->start_controls_section(
			'section_style_theme',
			array(
				'label' => __( 'Theme Preset & Container', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'theme_preset',
			array(
				'label'   => __( 'Theme Preset', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'light',
				'options' => array(
					'light' => __( 'Minimalist Light (Ivory & White)', 'website-section-supporter' ),
					'dark'  => __( 'Dark Luxury (Architectural Ink)', 'website-section-supporter' ),
					'taupe' => __( 'Warm Taupe & Bronze', 'website-section-supporter' ),
				),
			)
		);

		$this->add_responsive_control(
			'container_padding',
			array(
				'label'      => __( 'Container Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'default'    => array(
					'top'      => '120',
					'right'    => '20',
					'bottom'   => '120',
					'left'     => '20',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .wss-home-eval-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'form_max_width',
			array(
				'label'      => __( 'Form Box Max Width', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array( 'min' => 600, 'max' => 1400, 'step' => 10 ),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 1040,
				),
				'selectors'  => array(
					'{{WRAPPER}} .wss-home-eval-box' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: TYPOGRAPHY ================= */
		$this->start_controls_section(
			'section_style_typography',
			array(
				'label' => __( 'Typography & Colors', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'eyebrow_color',
			array(
				'label'     => __( 'Eyebrow Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-home-eval-eyebrow' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'eyebrow_typography',
				'selector' => '{{WRAPPER}} .wss-home-eval-eyebrow',
			)
		);

		$this->add_control(
			'heading_color',
			array(
				'label'     => __( 'Heading Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-home-eval-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'heading_typography',
				'selector' => '{{WRAPPER}} .wss-home-eval-title',
			)
		);

		$this->add_control(
			'desc_color',
			array(
				'label'     => __( 'Description Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-home-eval-desc' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'desc_typography',
				'selector' => '{{WRAPPER}} .wss-home-eval-desc',
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: INPUTS & AMENITIES ================= */
		$this->start_controls_section(
			'section_style_inputs',
			array(
				'label' => __( 'Form Inputs & Amenity Pills', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'input_bg',
			array(
				'label'     => __( 'Input Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-home-eval-input, {{WRAPPER}} .wss-home-eval-amenity-box' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'input_text_color',
			array(
				'label'     => __( 'Input Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-home-eval-input, {{WRAPPER}} .wss-home-eval-amenity-label' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'input_border_color',
			array(
				'label'     => __( 'Input Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-home-eval-input, {{WRAPPER}} .wss-home-eval-amenity-box' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'input_focus_border_color',
			array(
				'label'     => __( 'Input Focus Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-home-eval-input:focus, {{WRAPPER}} .wss-home-eval-amenity-box:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: SUBMIT BUTTON ================= */
		$this->start_controls_section(
			'section_style_button',
			array(
				'label' => __( 'Submit Button', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'btn_bg',
			array(
				'label'     => __( 'Button Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-home-eval-submit-btn' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'btn_text_color',
			array(
				'label'     => __( 'Button Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-home-eval-submit-btn' => 'color: {{VALUE}};',
					'{{WRAPPER}} .wss-home-eval-submit-btn svg' => 'stroke: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'btn_hover_bg',
			array(
				'label'     => __( 'Button Hover Background', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-home-eval-submit-btn:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'btn_hover_text_color',
			array(
				'label'     => __( 'Button Hover Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-home-eval-submit-btn:hover' => 'color: {{VALUE}}; border-color: {{VALUE}};',
					'{{WRAPPER}} .wss-home-eval-submit-btn:hover svg' => 'stroke: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'btn_typography',
				'selector' => '{{WRAPPER}} .wss-home-eval-submit-btn',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();

		$tag           = ! empty( $s['heading_html_tag'] ) ? $s['heading_html_tag'] : 'h2';
		$enable_reveal = ! empty( $s['enable_reveal'] ) && 'yes' === $s['enable_reveal'];
		$preset        = ! empty( $s['theme_preset'] ) ? $s['theme_preset'] : 'light';
		$preset_class  = 'wss-home-eval--' . $preset;
		if ( 'dark' === $preset ) {
			$preset_class .= ' wss-on-dark';
		} elseif ( 'taupe' === $preset ) {
			$preset_class .= ' wss-home-eval--taupe';
		}

		// ReCAPTCHA Keys
		$enable_recaptcha = ! empty( $s['enable_recaptcha'] ) && 'yes' === $s['enable_recaptcha'];
		$recaptcha_v      = ! empty( $s['recaptcha_version'] ) ? $s['recaptcha_version'] : 'v3';
		$site_key         = ! empty( $s['recaptcha_site_key'] ) ? $s['recaptcha_site_key'] : '';
		$secret_key       = ! empty( $s['recaptcha_secret_key'] ) ? $s['recaptcha_secret_key'] : '';

		// Parse Line Options
		$categories = array_filter( array_map( 'trim', explode( "\n", $s['categories_list'] ?? '' ) ) );
		$amenities  = array_filter( array_map( 'trim', explode( "\n", $s['amenities_list'] ?? '' ) ) );
		$timelines  = array_filter( array_map( 'trim', explode( "\n", $s['timeline_options'] ?? '' ) ) );
		$deliveries = array_filter( array_map( 'trim', explode( "\n", $s['delivery_methods'] ?? '' ) ) );
		?>
		<div class="wss-scope">
			<section class="wss-home-eval-section <?php echo esc_attr( $preset_class ); ?>" data-wss-widget="wss-home-evaluation">
				<div class="wss-container">
					
					<!-- Section Header -->
					<div class="wss-home-eval-header wss-reveal">
						<?php if ( ! empty( $s['eyebrow'] ) ) : ?>
							<span class="wss-home-eval-eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></span>
						<?php endif; ?>

						<?php if ( ! empty( $s['heading'] ) ) : ?>
							<<?php echo esc_attr( $tag ); ?> class="wss-home-eval-title">
								<span class="wss-mask"><span><?php echo nl2br( esc_html( $s['heading'] ) ); ?></span></span>
							</<?php echo esc_attr( $tag ); ?>>
						<?php endif; ?>

						<?php if ( ! empty( $s['description'] ) ) : ?>
							<p class="wss-home-eval-desc">
								<?php echo nl2br( esc_html( $s['description'] ) ); ?>
							</p>
						<?php endif; ?>
					</div>

					<!-- Form Box Container -->
					<div class="wss-home-eval-box wss-reveal wss-r1">
						
						<!-- Step Tabs Progress Navigation -->
						<div class="wss-home-eval-steps-nav">
							<button class="wss-home-eval-step-tab active" data-step="1" type="button">
								<span class="wss-step-num">01</span>
								<span class="wss-step-details">
									<span class="wss-step-phase"><?php _e( 'PHASE 01', 'website-section-supporter' ); ?></span>
									<span class="wss-step-name"><?php echo esc_html( $s['step1_tab_label'] ?? __( 'Property Location', 'website-section-supporter' ) ); ?></span>
								</span>
							</button>

							<button class="wss-home-eval-step-tab" data-step="2" type="button">
								<span class="wss-step-num">02</span>
								<span class="wss-step-details">
									<span class="wss-step-phase"><?php _e( 'PHASE 02', 'website-section-supporter' ); ?></span>
									<span class="wss-step-name"><?php echo esc_html( $s['step2_tab_label'] ?? __( 'Specs & Amenities', 'website-section-supporter' ) ); ?></span>
								</span>
							</button>

							<button class="wss-home-eval-step-tab" data-step="3" type="button">
								<span class="wss-step-num">03</span>
								<span class="wss-step-details">
									<span class="wss-step-phase"><?php _e( 'PHASE 03', 'website-section-supporter' ); ?></span>
									<span class="wss-step-name"><?php echo esc_html( $s['step3_tab_label'] ?? __( 'Contact & Delivery', 'website-section-supporter' ) ); ?></span>
								</span>
							</button>
						</div>

						<!-- Master Form -->
						<form class="wss-home-eval-form" method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
							
							<input type="hidden" name="action" value="wss_home_evaluation_submit">
							<input type="hidden" name="wss_eval_nonce" value="<?php echo esc_attr( wp_create_nonce( 'wss_home_evaluation_nonce' ) ); ?>">
							
							<!-- Config Passing -->
							<input type="hidden" name="admin_email_to" value="<?php echo esc_attr( $s['admin_email_to'] ?? '' ); ?>">
							<input type="hidden" name="admin_email_subject" value="<?php echo esc_attr( $s['admin_email_subject'] ?? '' ); ?>">
							<input type="hidden" name="enable_client_autoresponder" value="<?php echo esc_attr( $s['enable_client_autoresponder'] ?? 'yes' ); ?>">
							<input type="hidden" name="client_sender_name" value="<?php echo esc_attr( $s['client_sender_name'] ?? '' ); ?>">
							<input type="hidden" name="client_sender_email" value="<?php echo esc_attr( $s['client_sender_email'] ?? '' ); ?>">
							<input type="hidden" name="client_email_subject" value="<?php echo esc_attr( $s['client_email_subject'] ?? '' ); ?>">
							<input type="hidden" name="recaptcha_secret" value="<?php echo esc_attr( $secret_key ); ?>">

							<!-- STEP 1: PROPERTY LOCATION & CATEGORY -->
							<div class="wss-home-eval-step-pane active" data-step-pane="1">
								
								<div class="wss-form-group">
									<label class="wss-field-label"><?php echo esc_html( $s['address_label'] ?? __( 'Property Street Address *', 'website-section-supporter' ) ); ?></label>
									<input type="text" name="wss_address" class="wss-home-eval-input" placeholder="<?php echo esc_attr( $s['address_placeholder'] ); ?>" required>
								</div>

								<div class="wss-form-row">
									<div>
										<label class="wss-field-label"><?php _e( 'Unit / Suite (Optional)', 'website-section-supporter' ); ?></label>
										<input type="text" name="wss_unit" class="wss-home-eval-input" placeholder="<?php esc_attr_e( 'e.g. Penthouse 4B', 'website-section-supporter' ); ?>">
									</div>
									<div>
										<label class="wss-field-label"><?php _e( 'City / Community *', 'website-section-supporter' ); ?></label>
										<input type="text" name="wss_city" class="wss-home-eval-input" placeholder="<?php echo esc_attr( $s['city_placeholder'] ); ?>" required>
									</div>
								</div>

								<div class="wss-form-row">
									<div>
										<label class="wss-field-label"><?php _e( 'State', 'website-section-supporter' ); ?></label>
										<input type="text" name="wss_state" class="wss-home-eval-input" value="<?php echo esc_attr( $s['default_state'] ); ?>" readonly>
									</div>
									<div>
										<label class="wss-field-label"><?php _e( 'ZIP / Postal Code *', 'website-section-supporter' ); ?></label>
										<input type="text" name="wss_zip" class="wss-home-eval-input" placeholder="<?php echo esc_attr( $s['zip_placeholder'] ); ?>" required>
									</div>
								</div>

								<div class="wss-form-group">
									<label class="wss-field-label"><?php _e( 'Property Category *', 'website-section-supporter' ); ?></label>
									<select name="wss_category" class="wss-home-eval-input wss-home-eval-select" required>
										<option value="" disabled selected><?php _e( 'Select Property Type...', 'website-section-supporter' ); ?></option>
										<?php foreach ( $categories as $cat ) : ?>
											<option value="<?php echo esc_attr( $cat ); ?>"><?php echo esc_html( $cat ); ?></option>
										<?php endforeach; ?>
									</select>
								</div>

								<div class="wss-btn-nav-row">
									<div></div>
									<button type="button" class="wss-btn-pill wss-home-eval-next-btn" data-next="2">
										<span><?php _e( 'Continue: Specs & Amenities', 'website-section-supporter' ); ?></span>
										<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
									</button>
								</div>

							</div>

							<!-- STEP 2: SPECS, AMENITIES & TIMELINE -->
							<div class="wss-home-eval-step-pane" data-step-pane="2" style="display: none;">
								
								<div class="wss-form-row-3">
									<div>
										<label class="wss-field-label"><?php _e( 'Bedrooms', 'website-section-supporter' ); ?></label>
										<select name="wss_beds" class="wss-home-eval-input wss-home-eval-select">
											<option value="3">3 Bedrooms</option>
											<option value="4" selected>4 Bedrooms</option>
											<option value="5">5 Bedrooms</option>
											<option value="6+">6+ Bedrooms</option>
										</select>
									</div>
									<div>
										<label class="wss-field-label"><?php _e( 'Bathrooms', 'website-section-supporter' ); ?></label>
										<select name="wss_baths" class="wss-home-eval-input wss-home-eval-select">
											<option value="3">3 Baths</option>
											<option value="4" selected>4 Baths</option>
											<option value="5">5 Baths</option>
											<option value="6+">6+ Baths</option>
										</select>
									</div>
									<div>
										<label class="wss-field-label"><?php _e( 'Approx. Sq. Footage', 'website-section-supporter' ); ?></label>
										<input type="text" name="wss_sqft" class="wss-home-eval-input" placeholder="<?php esc_attr_e( 'e.g. 5,400 sq ft', 'website-section-supporter' ); ?>">
									</div>
								</div>

								<div class="wss-form-group">
									<label class="wss-field-label"><?php _e( 'Key Luxury Amenities & Features (Select All That Apply)', 'website-section-supporter' ); ?></label>
									<div class="wss-amenity-grid">
										<?php foreach ( $amenities as $amenity ) : ?>
											<label class="wss-home-eval-amenity-box">
												<input type="checkbox" name="wss_amenities[]" value="<?php echo esc_attr( $amenity ); ?>">
												<span class="wss-home-eval-amenity-label"><?php echo esc_html( $amenity ); ?></span>
											</label>
										<?php endforeach; ?>
									</div>
								</div>

								<div class="wss-form-group">
									<label class="wss-field-label"><?php _e( 'Selling Horizon / Timeline *', 'website-section-supporter' ); ?></label>
									<select name="wss_timeline" class="wss-home-eval-input wss-home-eval-select" required>
										<?php foreach ( $timelines as $t_idx => $timeline ) : ?>
											<option value="<?php echo esc_attr( $timeline ); ?>" <?php echo ( 0 === $t_idx ) ? 'selected' : ''; ?>>
												<?php echo esc_html( $timeline ); ?>
											</option>
										<?php endforeach; ?>
									</select>
								</div>

								<div class="wss-btn-nav-row">
									<button type="button" class="wss-btn-back" data-prev="1">← <?php _e( 'Back to Location', 'website-section-supporter' ); ?></button>
									<button type="button" class="wss-btn-pill wss-home-eval-next-btn" data-next="3">
										<span><?php _e( 'Continue: Contact & Delivery', 'website-section-supporter' ); ?></span>
										<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
									</button>
								</div>

							</div>

							<!-- STEP 3: CONTACT & DELIVERY -->
							<div class="wss-home-eval-step-pane" data-step-pane="3" style="display: none;">
								
								<div class="wss-form-row">
									<div>
										<label class="wss-field-label"><?php _e( 'Full Name *', 'website-section-supporter' ); ?></label>
										<input type="text" name="wss_name" class="wss-home-eval-input" placeholder="<?php esc_attr_e( 'Victoria Sterling', 'website-section-supporter' ); ?>" required>
									</div>
									<div>
										<label class="wss-field-label"><?php _e( 'Email Address *', 'website-section-supporter' ); ?></label>
										<input type="email" name="wss_email" class="wss-home-eval-input" placeholder="<?php esc_attr_e( 'sterling@private.com', 'website-section-supporter' ); ?>" required>
									</div>
								</div>

								<div class="wss-form-row">
									<div>
										<label class="wss-field-label"><?php _e( 'Direct Phone Number *', 'website-section-supporter' ); ?></label>
										<input type="tel" name="wss_phone" class="wss-home-eval-input" placeholder="<?php esc_attr_e( '+1 (407) 000-0000', 'website-section-supporter' ); ?>" required>
									</div>
									<div>
										<label class="wss-field-label"><?php _e( 'Preferred Delivery Method *', 'website-section-supporter' ); ?></label>
										<select name="wss_delivery" class="wss-home-eval-input wss-home-eval-select" required>
											<?php foreach ( $deliveries as $del ) : ?>
												<option value="<?php echo esc_attr( $del ); ?>"><?php echo esc_html( $del ); ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>

								<div class="wss-form-group">
									<label class="wss-field-label"><?php _e( 'Special Architectural Notes / Recent Capital Improvements (Optional)', 'website-section-supporter' ); ?></label>
									<textarea name="wss_notes" class="wss-home-eval-input" rows="3" placeholder="<?php esc_attr_e( 'e.g. New tile roof in 2024, Sub-Zero appliances, Lutron smart lighting system...', 'website-section-supporter' ); ?>"></textarea>
								</div>

								<!-- Google reCAPTCHA v2 Checkbox UI -->
								<?php if ( $enable_recaptcha && 'v2' === $recaptcha_v ) : ?>
									<div class="wss-form-row wss-recaptcha-wrap" style="margin: 16px 0;">
										<div class="g-recaptcha" data-sitekey="<?php echo esc_attr( $site_key ); ?>"></div>
									</div>
									<script src="https://www.google.com/recaptcha/api.js" async defer></script>
								<?php elseif ( $enable_recaptcha && 'v3' === $recaptcha_v ) : ?>
									<input type="hidden" name="g-recaptcha-response" class="wss-home-eval-recaptcha-token" value="">
									<script src="https://www.google.com/recaptcha/api.js?render=<?php echo esc_attr( $site_key ); ?>"></script>
									<script>
										if (typeof grecaptcha !== 'undefined') {
											grecaptcha.ready(function() {
												grecaptcha.execute('<?php echo esc_js( $site_key ); ?>', {action: 'home_eval_submit'}).then(function(token) {
													var tokens = document.querySelectorAll('.wss-home-eval-recaptcha-token');
													tokens.forEach(function(el) { el.value = token; });
												});
											});
										}
									</script>
								<?php endif; ?>

								<div class="wss-btn-nav-row">
									<button type="button" class="wss-btn-back" data-prev="2">← <?php _e( 'Back to Amenities', 'website-section-supporter' ); ?></button>
									<button type="submit" class="wss-btn-pill wss-home-eval-submit-btn">
										<span><?php echo esc_html( $s['submit_btn_text'] ?? __( 'Request Confidential Valuation', 'website-section-supporter' ) ); ?></span>
										<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
									</button>
								</div>

								<?php if ( ! empty( $s['privacy_note'] ) ) : ?>
									<div class="wss-home-eval-privacy-badge">
										<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
										<span><?php echo esc_html( $s['privacy_note'] ); ?></span>
									</div>
								<?php endif; ?>

							</div>

						</form>

						<!-- Animated Luxury Success State -->
						<div class="wss-home-eval-success-state" style="display: none;">
							<div class="wss-success-icon-badge">
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
							</div>
							<h3 class="wss-success-title"><?php echo esc_html( $s['success_title'] ?? __( 'Valuation Request Received', 'website-section-supporter' ) ); ?></h3>
							<p class="wss-success-desc"><?php echo nl2br( esc_html( $s['success_message'] ?? __( 'Thank you. Victoria Price and our analytics team have initiated your sub-market comparative study. Your confidential property dossier is being assembled.', 'website-section-supporter' ) ) ); ?></p>
							<button type="button" class="wss-btn-pill wss-home-eval-reset-btn">
								<span><?php echo esc_html( $s['reset_btn_text'] ?? __( 'Submit Another Property', 'website-section-supporter' ) ); ?></span>
							</button>
						</div>

					</div>

				</div>
			</section>
		</div>
		<?php
	}
}
