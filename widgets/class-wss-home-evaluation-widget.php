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
		return __( 'WSS — Home Evaluation & Property Valuation (Form Builder)', 'website-section-supporter' );
	}

	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	public function get_categories() {
		return array( 'website-section-supporter' );
	}

	public function get_keywords() {
		return array( 'home evaluation', 'property valuation', 'form builder', 'cma', 'appraisal', 'multi-step', 'recaptcha', 'vpsignature' );
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

		/* ================= CONTENT: FORM FIELDS (REPEATER BUILDER) ================= */
		$this->start_controls_section(
			'section_form_fields',
			array(
				'label' => __( 'Form Fields Builder (Elementor Pro Style)', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'field_type',
			array(
				'label'   => __( 'Type', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'text',
				'options' => array(
					'step'     => __( '--- Step / Page Break ---', 'website-section-supporter' ),
					'text'     => __( 'Text', 'website-section-supporter' ),
					'email'    => __( 'Email', 'website-section-supporter' ),
					'tel'      => __( 'Tel / Phone', 'website-section-supporter' ),
					'textarea' => __( 'Textarea (Multi-line)', 'website-section-supporter' ),
					'select'   => __( 'Select Dropdown', 'website-section-supporter' ),
					'checkbox' => __( 'Checkbox (Amenities Pills)', 'website-section-supporter' ),
					'radio'    => __( 'Radio Buttons', 'website-section-supporter' ),
					'number'   => __( 'Number', 'website-section-supporter' ),
					'html'     => __( 'Custom HTML / Divider', 'website-section-supporter' ),
				),
			)
		);

		$repeater->add_control(
			'step_phase',
			array(
				'label'       => __( 'Step Phase Tag', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'PHASE 01',
				'placeholder' => 'e.g. PHASE 01',
				'condition'   => array( 'field_type' => 'step' ),
			)
		);

		$repeater->add_control(
			'field_label',
			array(
				'label'       => __( 'Label / Step Title', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Property Street Address', 'website-section-supporter' ),
				'placeholder' => __( 'Field Label or Step Name', 'website-section-supporter' ),
			)
		);

		$repeater->add_control(
			'placeholder',
			array(
				'label'       => __( 'Placeholder', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => __( 'Enter placeholder text', 'website-section-supporter' ),
				'conditions'  => array(
					'terms' => array(
						array(
							'name'     => 'field_type',
							'operator' => '!in',
							'value'    => array( 'step', 'checkbox', 'radio', 'html' ),
						),
					),
				),
			)
		);

		$repeater->add_control(
			'required',
			array(
				'label'        => __( 'Required Field', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
				'conditions'   => array(
					'terms' => array(
						array(
							'name'     => 'field_type',
							'operator' => '!in',
							'value'    => array( 'step', 'html' ),
						),
					),
				),
			)
		);

		$repeater->add_control(
			'column_width',
			array(
				'label'      => __( 'Column Width', 'website-section-supporter' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => '100',
				'options'    => array(
					'100' => '100%',
					'75'  => '75%',
					'66'  => '66%',
					'50'  => '50% (2 per row)',
					'33'  => '33% (3 per row)',
					'25'  => '25% (4 per row)',
				),
				'conditions' => array(
					'terms' => array(
						array(
							'name'     => 'field_type',
							'operator' => '!in',
							'value'    => array( 'step' ),
						),
					),
				),
			)
		);

		$repeater->add_control(
			'field_options',
			array(
				'label'       => __( 'Options (One per line)', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => "Option 1\nOption 2\nOption 3",
				'description' => __( 'Enter each option on a new line.', 'website-section-supporter' ),
				'rows'        => 6,
				'conditions'  => array(
					'terms' => array(
						array(
							'name'     => 'field_type',
							'operator' => 'in',
							'value'    => array( 'select', 'checkbox', 'radio' ),
						),
					),
				),
			)
		);

		$repeater->add_control(
			'default_value',
			array(
				'label'       => __( 'Default Value', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'conditions'  => array(
					'terms' => array(
						array(
							'name'     => 'field_type',
							'operator' => '!in',
							'value'    => array( 'step', 'html' ),
						),
					),
				),
			)
		);

		$repeater->add_control(
			'raw_html',
			array(
				'label'       => __( 'HTML Content', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => '',
				'rows'        => 4,
				'condition'   => array( 'field_type' => 'html' ),
			)
		);

		$this->add_control(
			'form_fields',
			array(
				'label'       => __( 'Form Fields & Steps', 'website-section-supporter' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ field_type.toUpperCase() }}}: {{{ field_label }}} ({{{ column_width }}}%)',
				'default'     => array(
					// STEP 1
					array(
						'field_type'   => 'step',
						'step_phase'   => 'PHASE 01',
						'field_label'  => __( 'Property Location', 'website-section-supporter' ),
					),
					array(
						'field_type'   => 'text',
						'field_label'  => __( 'Property Street Address', 'website-section-supporter' ),
						'placeholder'  => 'e.g. 4820 Isleworth Country Club Dr',
						'required'     => 'yes',
						'column_width' => '100',
					),
					array(
						'field_type'   => 'text',
						'field_label'  => __( 'Unit / Suite', 'website-section-supporter' ),
						'placeholder'  => 'e.g. Penthouse 4B',
						'required'     => 'no',
						'column_width' => '50',
					),
					array(
						'field_type'   => 'text',
						'field_label'  => __( 'City / Community', 'website-section-supporter' ),
						'placeholder'  => 'e.g. Windermere, Winter Park, Orlando',
						'required'     => 'yes',
						'column_width' => '50',
					),
					array(
						'field_type'    => 'text',
						'field_label'   => __( 'State', 'website-section-supporter' ),
						'default_value' => 'Florida (FL)',
						'required'      => 'no',
						'column_width'  => '50',
					),
					array(
						'field_type'   => 'text',
						'field_label'  => __( 'ZIP / Postal Code', 'website-section-supporter' ),
						'placeholder'  => 'e.g. 34786',
						'required'     => 'yes',
						'column_width' => '50',
					),
					array(
						'field_type'    => 'select',
						'field_label'   => __( 'Property Category', 'website-section-supporter' ),
						'placeholder'   => __( 'Select Property Type...', 'website-section-supporter' ),
						'field_options' => "Single-Family Luxury Residence\nLakefront / Waterfront Estate\nPenthouse / High-Rise Condominium\nEquestrian & Acreage Estate\nGolf & Country Club Property\nCustom / New Construction Build",
						'required'      => 'yes',
						'column_width'  => '100',
					),

					// STEP 2
					array(
						'field_type'   => 'step',
						'step_phase'   => 'PHASE 02',
						'field_label'  => __( 'Specs & Amenities', 'website-section-supporter' ),
					),
					array(
						'field_type'    => 'select',
						'field_label'   => __( 'Bedrooms', 'website-section-supporter' ),
						'field_options' => "3 Bedrooms\n4 Bedrooms\n5 Bedrooms\n6+ Bedrooms",
						'default_value' => '4 Bedrooms',
						'required'      => 'no',
						'column_width'  => '33',
					),
					array(
						'field_type'    => 'select',
						'field_label'   => __( 'Bathrooms', 'website-section-supporter' ),
						'field_options' => "3 Baths\n4 Baths\n5 Baths\n6+ Baths",
						'default_value' => '4 Baths',
						'required'      => 'no',
						'column_width'  => '33',
					),
					array(
						'field_type'   => 'text',
						'field_label'  => __( 'Approx. Sq. Footage', 'website-section-supporter' ),
						'placeholder'  => 'e.g. 5,400 sq ft',
						'required'     => 'no',
						'column_width' => '33',
					),
					array(
						'field_type'    => 'checkbox',
						'field_label'   => __( 'Key Luxury Amenities & Features (Select All That Apply)', 'website-section-supporter' ),
						'field_options' => "Private Boat Dock\nResort Pool & Lanai\n24/7 Gated Security\nGuest House / Casita\nCustom Wine Cellar\nRecent Remodel / Upgrade\nSmart Home Automation\nEquestrian Stables",
						'required'      => 'no',
						'column_width'  => '100',
					),
					array(
						'field_type'    => 'select',
						'field_label'   => __( 'Selling Horizon / Timeline', 'website-section-supporter' ),
						'field_options' => "Planning to Sell (Next 30–60 Days)\nExploring Options (1–3 Months)\nLong-Term Strategy (6–12 Months)\nJust Curious / Annual Equity Checkup\nEstate Planning / Refinance",
						'default_value' => 'Planning to Sell (Next 30–60 Days)',
						'required'      => 'yes',
						'column_width'  => '100',
					),

					// STEP 3
					array(
						'field_type'   => 'step',
						'step_phase'   => 'PHASE 03',
						'field_label'  => __( 'Contact & Delivery', 'website-section-supporter' ),
					),
					array(
						'field_type'   => 'text',
						'field_label'  => __( 'Full Name', 'website-section-supporter' ),
						'placeholder'  => 'Victoria Sterling',
						'required'     => 'yes',
						'column_width' => '50',
					),
					array(
						'field_type'   => 'email',
						'field_label'  => __( 'Email Address', 'website-section-supporter' ),
						'placeholder'  => 'sterling@private.com',
						'required'     => 'yes',
						'column_width' => '50',
					),
					array(
						'field_type'   => 'tel',
						'field_label'  => __( 'Direct Phone Number', 'website-section-supporter' ),
						'placeholder'  => '+1 (407) 000-0000',
						'required'     => 'yes',
						'column_width' => '50',
					),
					array(
						'field_type'    => 'select',
						'field_label'   => __( 'Preferred Delivery Method', 'website-section-supporter' ),
						'field_options' => "Digital PDF Market Dossier via Email\nConfidential Phone Review with Victoria Price\nPrivate In-Person Walkthrough",
						'required'      => 'yes',
						'column_width'  => '50',
					),
					array(
						'field_type'   => 'textarea',
						'field_label'  => __( 'Special Architectural Notes / Recent Capital Improvements', 'website-section-supporter' ),
						'placeholder'  => 'e.g. New tile roof in 2024, Sub-Zero appliances, Lutron smart lighting system...',
						'required'     => 'no',
						'column_width' => '100',
					),
				),
			)
		);

		$this->end_controls_section();

		/* ================= CONTENT: BUTTONS & LABELS ================= */
		$this->start_controls_section(
			'section_form_buttons',
			array(
				'label' => __( 'Buttons & Navigation Labels', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'next_btn_text',
			array(
				'label'   => __( 'Next Step Button Text', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Continue', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'prev_btn_text',
			array(
				'label'   => __( 'Previous Step Button Text', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Back', 'website-section-supporter' ),
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
				'default'     => __( 'New Property Valuation Request from {{Full Name}}', 'website-section-supporter' ),
				'description' => __( 'Tokens: Any field label in double braces e.g. {{Full Name}}, {{Property Street Address}}, {{Email Address}}', 'website-section-supporter' ),
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
				'default'     => __( 'Property Valuation Request Confirmed | VP Signature Group', 'website-section-supporter' ),
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
					'{{WRAPPER}} .wss-home-eval-submit-btn, {{WRAPPER}} .wss-home-eval-next-btn' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'btn_text_color',
			array(
				'label'     => __( 'Button Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-home-eval-submit-btn, {{WRAPPER}} .wss-home-eval-next-btn' => 'color: {{VALUE}};',
					'{{WRAPPER}} .wss-home-eval-submit-btn svg, {{WRAPPER}} .wss-home-eval-next-btn svg' => 'stroke: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'btn_hover_bg',
			array(
				'label'     => __( 'Button Hover Background', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-home-eval-submit-btn:hover, {{WRAPPER}} .wss-home-eval-next-btn:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'btn_hover_text_color',
			array(
				'label'     => __( 'Button Hover Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-home-eval-submit-btn:hover, {{WRAPPER}} .wss-home-eval-next-btn:hover' => 'color: {{VALUE}}; border-color: {{VALUE}};',
					'{{WRAPPER}} .wss-home-eval-submit-btn:hover svg, {{WRAPPER}} .wss-home-eval-next-btn:hover svg' => 'stroke: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'btn_typography',
				'selector' => '{{WRAPPER}} .wss-home-eval-submit-btn, {{WRAPPER}} .wss-home-eval-next-btn',
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

		$fields = ! empty( $s['form_fields'] ) ? $s['form_fields'] : array();

		// Separate into steps if step fields exist
		$has_steps = false;
		$steps     = array();
		$current_step = 1;

		foreach ( $fields as $item ) {
			if ( 'step' === $item['field_type'] ) {
				$has_steps = true;
				$steps[] = array(
					'step_num'   => count( $steps ) + 1,
					'step_phase' => ! empty( $item['step_phase'] ) ? $item['step_phase'] : sprintf( 'PHASE %02d', count( $steps ) + 1 ),
					'step_name'  => ! empty( $item['field_label'] ) ? $item['field_label'] : sprintf( 'Step %d', count( $steps ) + 1 ),
				);
			}
		}

		$total_steps = count( $steps );
		if ( $total_steps === 0 ) {
			$total_steps = 1;
		}
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

						<div class="wss-home-eval-trust-pills">
							<span class="wss-trust-pill"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> <?php _e( '100% Confidential & Off-Market', 'website-section-supporter' ); ?></span>
							<span class="wss-trust-pill"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg> <?php _e( 'Human Econometric Analysis', 'website-section-supporter' ); ?></span>
							<span class="wss-trust-pill"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> <?php _e( 'Complimentary 24-48h Delivery', 'website-section-supporter' ); ?></span>
						</div>
					</div>

					<!-- Form Box Container -->
					<div class="wss-home-eval-box wss-reveal wss-r1">
						
						<!-- Step Tabs Progress Navigation (Rendered if multi-step) -->
						<?php if ( $has_steps && $total_steps > 1 ) : ?>
							<div class="wss-home-eval-steps-wrapper">
								<div class="wss-home-eval-steps-nav">
									<?php foreach ( $steps as $idx => $st ) : ?>
										<button class="wss-home-eval-step-tab <?php echo ( 0 === $idx ) ? 'active' : ''; ?>" data-step="<?php echo esc_attr( $st['step_num'] ); ?>" type="button">
											<span class="wss-step-num"><?php echo sprintf( '%02d', $st['step_num'] ); ?></span>
											<span class="wss-step-details">
												<span class="wss-step-phase"><?php echo esc_html( $st['step_phase'] ); ?></span>
												<span class="wss-step-name"><?php echo esc_html( $st['step_name'] ); ?></span>
											</span>
										</button>
									<?php endforeach; ?>
								</div>
								<div class="wss-home-eval-progress-track">
									<div class="wss-home-eval-progress-fill" style="width: <?php echo esc_attr( round( 100 / $total_steps, 2 ) ); ?>%;"></div>
								</div>
							</div>
						<?php endif; ?>

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

							<?php
							$step_index = 0;
							$in_step = false;

							foreach ( $fields as $f_idx => $field ) :
								$type     = ! empty( $field['field_type'] ) ? $field['field_type'] : 'text';
								$label    = ! empty( $field['field_label'] ) ? $field['field_label'] : '';
								$pl       = ! empty( $field['placeholder'] ) ? $field['placeholder'] : '';
								$req      = ! empty( $field['required'] ) && 'yes' === $field['required'];
								$col      = ! empty( $field['column_width'] ) ? $field['column_width'] : '100';
								$def      = ! empty( $field['default_value'] ) ? $field['default_value'] : '';
								$f_id     = ! empty( $field['_id'] ) ? $field['_id'] : 'f_' . $f_idx;
								$raw_opts = ! empty( $field['field_options'] ) ? array_filter( array_map( 'trim', explode( "\n", $field['field_options'] ) ) ) : array();

								if ( 'step' === $type ) :
									// Close previous step pane if open
									if ( $in_step ) :
										?>
											</div><!-- /.wss-form-grid-wrap -->
											<div class="wss-btn-nav-row">
												<?php if ( $step_index > 1 ) : ?>
													<button type="button" class="wss-btn-back" data-prev="<?php echo esc_attr( $step_index - 1 ); ?>">← <?php echo esc_html( $s['prev_btn_text'] ?? __( 'Back', 'website-section-supporter' ) ); ?></button>
												<?php else : ?>
													<div></div>
												<?php endif; ?>
												
												<button type="button" class="wss-btn-pill wss-home-eval-next-btn" data-next="<?php echo esc_attr( $step_index + 1 ); ?>">
													<span><?php echo esc_html( $s['next_btn_text'] ?? __( 'Continue', 'website-section-supporter' ) ); ?></span>
													<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
												</button>
											</div>
										</div><!-- /.wss-home-eval-step-pane -->
										<?php
									endif;

									$step_index++;
									$in_step = true;
									$is_active = ( 1 === $step_index );
									?>
									<div class="wss-home-eval-step-pane <?php echo $is_active ? 'active' : ''; ?>" data-step-pane="<?php echo esc_attr( $step_index ); ?>" style="<?php echo $is_active ? '' : 'display:none;'; ?>">
										<div class="wss-form-grid-wrap">
									<?php
									continue;
								endif;

								if ( ! $in_step ) {
									// In case no step field was added at the very beginning
									$step_index = 1;
									$in_step = true;
									?>
									<div class="wss-home-eval-step-pane active" data-step-pane="1">
										<div class="wss-form-grid-wrap">
									<?php
								}
								?>

								<div class="wss-form-col wss-col-<?php echo esc_attr( $col ); ?> elementor-repeater-item-<?php echo esc_attr( $f_id ); ?>">
									
									<?php if ( ! empty( $label ) && 'html' !== $type && 'checkbox' !== $type && 'radio' !== $type ) : ?>
										<label class="wss-field-label" for="wss_in_<?php echo esc_attr( $f_id ); ?>">
											<?php echo esc_html( $label ); ?> <?php if ( $req ) echo '<span class="wss-req">*</span>'; ?>
										</label>
									<?php endif; ?>

									<?php if ( 'text' === $type ) : ?>
										<input type="text" id="wss_in_<?php echo esc_attr( $f_id ); ?>" name="wss_fields[<?php echo esc_attr( $label ); ?>]" class="wss-home-eval-input" placeholder="<?php echo esc_attr( $pl ); ?>" value="<?php echo esc_attr( $def ); ?>" <?php echo $req ? 'required' : ''; ?>>

									<?php elseif ( 'email' === $type ) : ?>
										<input type="email" id="wss_in_<?php echo esc_attr( $f_id ); ?>" name="wss_fields[<?php echo esc_attr( $label ); ?>]" class="wss-home-eval-input" placeholder="<?php echo esc_attr( $pl ); ?>" value="<?php echo esc_attr( $def ); ?>" <?php echo $req ? 'required' : ''; ?>>

									<?php elseif ( 'tel' === $type ) : ?>
										<input type="tel" id="wss_in_<?php echo esc_attr( $f_id ); ?>" name="wss_fields[<?php echo esc_attr( $label ); ?>]" class="wss-home-eval-input" placeholder="<?php echo esc_attr( $pl ); ?>" value="<?php echo esc_attr( $def ); ?>" <?php echo $req ? 'required' : ''; ?>>

									<?php elseif ( 'number' === $type ) : ?>
										<input type="number" id="wss_in_<?php echo esc_attr( $f_id ); ?>" name="wss_fields[<?php echo esc_attr( $label ); ?>]" class="wss-home-eval-input" placeholder="<?php echo esc_attr( $pl ); ?>" value="<?php echo esc_attr( $def ); ?>" <?php echo $req ? 'required' : ''; ?>>

									<?php elseif ( 'textarea' === $type ) : ?>
										<textarea id="wss_in_<?php echo esc_attr( $f_id ); ?>" name="wss_fields[<?php echo esc_attr( $label ); ?>]" class="wss-home-eval-input" rows="3" placeholder="<?php echo esc_attr( $pl ); ?>" <?php echo $req ? 'required' : ''; ?>><?php echo esc_textarea( $def ); ?></textarea>

									<?php elseif ( 'select' === $type ) : ?>
										<select id="wss_in_<?php echo esc_attr( $f_id ); ?>" name="wss_fields[<?php echo esc_attr( $label ); ?>]" class="wss-home-eval-input wss-home-eval-select" <?php echo $req ? 'required' : ''; ?>>
											<?php if ( ! empty( $pl ) ) : ?>
												<option value="" disabled <?php echo empty( $def ) ? 'selected' : ''; ?>><?php echo esc_html( $pl ); ?></option>
											<?php endif; ?>
											<?php foreach ( $raw_opts as $opt ) : ?>
												<option value="<?php echo esc_attr( $opt ); ?>" <?php echo ( $opt === $def ) ? 'selected' : ''; ?>><?php echo esc_html( $opt ); ?></option>
											<?php endforeach; ?>
										</select>

									<?php elseif ( 'checkbox' === $type ) : ?>
										<?php if ( ! empty( $label ) ) : ?>
											<label class="wss-field-label">
												<?php echo esc_html( $label ); ?> <?php if ( $req ) echo '<span class="wss-req">*</span>'; ?>
											</label>
										<?php endif; ?>
										<div class="wss-amenity-grid">
											<?php foreach ( $raw_opts as $opt ) : ?>
												<label class="wss-home-eval-amenity-box">
													<input type="checkbox" name="wss_fields[<?php echo esc_attr( $label ); ?>][]" value="<?php echo esc_attr( $opt ); ?>">
													<span class="wss-custom-check">
														<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
													</span>
													<span class="wss-home-eval-amenity-label"><?php echo esc_html( $opt ); ?></span>
												</label>
											<?php endforeach; ?>
										</div>

									<?php elseif ( 'radio' === $type ) : ?>
										<?php if ( ! empty( $label ) ) : ?>
											<label class="wss-field-label">
												<?php echo esc_html( $label ); ?> <?php if ( $req ) echo '<span class="wss-req">*</span>'; ?>
											</label>
										<?php endif; ?>
										<div class="wss-amenity-grid">
											<?php foreach ( $raw_opts as $opt ) : ?>
												<label class="wss-home-eval-amenity-box">
													<input type="radio" name="wss_fields[<?php echo esc_attr( $label ); ?>]" value="<?php echo esc_attr( $opt ); ?>" <?php echo ( $opt === $def ) ? 'checked' : ''; ?>>
													<span class="wss-custom-check wss-custom-check--radio">
														<span class="wss-radio-dot"></span>
													</span>
													<span class="wss-home-eval-amenity-label"><?php echo esc_html( $opt ); ?></span>
												</label>
											<?php endforeach; ?>
										</div>

									<?php elseif ( 'html' === $type ) : ?>
										<div class="wss-custom-html-block">
											<?php echo wp_kses_post( $field['raw_html'] ?? '' ); ?>
										</div>

									<?php endif; ?>

								</div>

							<?php endforeach; ?>

							<?php if ( $in_step ) : ?>
								</div><!-- /.wss-form-grid-wrap -->

								<!-- Google reCAPTCHA v2 Checkbox UI on Final Step -->
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
									<?php if ( $step_index > 1 ) : ?>
										<button type="button" class="wss-btn-back" data-prev="<?php echo esc_attr( $step_index - 1 ); ?>">← <?php echo esc_html( $s['prev_btn_text'] ?? __( 'Back', 'website-section-supporter' ) ); ?></button>
									<?php else : ?>
										<div></div>
									<?php endif; ?>

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

								</div><!-- /.wss-home-eval-step-pane -->
							<?php endif; ?>

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
