<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;

class WSS_Contact_Widget extends Widget_Base {

	public function get_name() { return 'wss_contact'; }
	public function get_title() { return __( 'WSS — Contact Section', 'website-section-supporter' ); }
	public function get_icon() { return 'eicon-form-vertical'; }
	public function get_categories() { return array( 'website-section-supporter' ); }
	public function get_keywords() { return array( 'contact', 'form', 'inquiry', 'luxury', 'recaptcha', 'lead' ); }

	protected function register_controls() {

		/* ================= LEFT CONTENT: BRANDING & INFO ================= */
		$this->start_controls_section(
			'section_left_content',
			array( 'label' => __( 'Left: Contact Information', 'website-section-supporter' ) )
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Main Heading', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'GET IN TOUCH', 'website-section-supporter' ),
				'placeholder' => __( 'GET IN TOUCH', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'show_watermark',
			array(
				'label'        => __( 'Show Watermark Monogram', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'website-section-supporter' ),
				'label_off'    => __( 'No', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'watermark_text',
			array(
				'label'     => __( 'Watermark Text', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'NE',
				'condition' => array( 'show_watermark' => 'yes' ),
			)
		);

		$this->add_control( 'agent_heading', array( 'label' => __( 'Agent Details', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );

		$this->add_control(
			'agent_name',
			array(
				'label'   => __( 'Agent / Company Name', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Ginger Martin',
			)
		);

		$this->add_control(
			'agent_license',
			array(
				'label'   => __( 'License / DRE#', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'CA DRE# 00643485',
			)
		);

		$this->add_control(
			'agent_phone',
			array(
				'label'   => __( 'Phone Number', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '415.516.3939',
			)
		);

		$this->add_control(
			'agent_phone_link',
			array(
				'label'       => __( 'Phone Link URL', 'website-section-supporter' ),
				'type'        => Controls_Manager::URL,
				'default'     => array( 'url' => 'tel:4155163939' ),
				'placeholder' => 'tel:4155163939',
			)
		);

		$this->add_control(
			'agent_email',
			array(
				'label'   => __( 'Email Address', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'ginger@gingermartin.com',
			)
		);

		$this->add_control(
			'agent_email_link',
			array(
				'label'       => __( 'Email Link URL', 'website-section-supporter' ),
				'type'        => Controls_Manager::URL,
				'default'     => array( 'url' => 'mailto:ginger@gingermartin.com' ),
				'placeholder' => 'mailto:ginger@gingermartin.com',
			)
		);

		$this->add_control(
			'address_line_1',
			array(
				'label'   => __( 'Address Line 1', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '1229 Adams St.',
			)
		);

		$this->add_control(
			'address_line_2',
			array(
				'label'   => __( 'Address Line 2 (City, State, Zip)', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'St. Helena CA 94574',
			)
		);

		$this->add_control(
			'tagline',
			array(
				'label'   => __( 'Tagline Text', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'LEADING LUXURY REAL ESTATE AGENT FOR SONOMA AND NAPA VALLEY',
				'rows'    => 2,
			)
		);

		$this->add_control( 'cards_heading', array( 'label' => __( 'Vertical Quick Contact Cards', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );

		$this->add_control(
			'show_vertical_cards',
			array(
				'label'        => __( 'Show Vertical Contact Cards', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'website-section-supporter' ),
				'label_off'    => __( 'No', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'card_phone_label',
			array(
				'label'     => __( 'Card 1 (Phone) Label', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Direct Call',
				'condition' => array( 'show_vertical_cards' => 'yes' ),
			)
		);
		$this->add_control(
			'card_phone_value',
			array(
				'label'     => __( 'Card 1 (Phone) Value', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '415.516.3939',
				'condition' => array( 'show_vertical_cards' => 'yes' ),
			)
		);

		$this->add_control(
			'card_email_label',
			array(
				'label'     => __( 'Card 2 (Email) Label', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Confidential Email',
				'condition' => array( 'show_vertical_cards' => 'yes' ),
			)
		);
		$this->add_control(
			'card_email_value',
			array(
				'label'     => __( 'Card 2 (Email) Value', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'ginger@gingermartin.com',
				'condition' => array( 'show_vertical_cards' => 'yes' ),
			)
		);

		$this->add_control(
			'card_wa_label',
			array(
				'label'     => __( 'Card 3 (WhatsApp) Label', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'WhatsApp Direct',
				'condition' => array( 'show_vertical_cards' => 'yes' ),
			)
		);
		$this->add_control(
			'card_wa_value',
			array(
				'label'     => __( 'Card 3 (WhatsApp) Value', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Connect on WhatsApp',
				'condition' => array( 'show_vertical_cards' => 'yes' ),
			)
		);
		$this->add_control(
			'card_wa_link',
			array(
				'label'       => __( 'Card 3 (WhatsApp) URL', 'website-section-supporter' ),
				'type'        => Controls_Manager::URL,
				'default'     => array( 'url' => 'https://wa.me/14155163939' ),
				'placeholder' => 'https://wa.me/14155163939',
				'condition'   => array( 'show_vertical_cards' => 'yes' ),
			)
		);

		$this->add_control( 'social_heading', array( 'label' => __( 'Social Icons', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );

		$this->add_control(
			'show_social',
			array(
				'label'        => __( 'Show Social Icons', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'website-section-supporter' ),
				'label_off'    => __( 'No', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$repeater_social = new Repeater();
		$repeater_social->add_control(
			'platform',
			array(
				'label'   => __( 'Platform', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'fb',
				'options' => array(
					'fb' => 'Facebook',
					'ig' => 'Instagram',
					'in' => 'LinkedIn',
					'yt' => 'YouTube',
					'x'  => 'X (Twitter)',
					'wa' => 'WhatsApp',
				),
			)
		);
		$repeater_social->add_control(
			'link',
			array(
				'label'   => __( 'Link URL', 'website-section-supporter' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#' ),
			)
		);

		$this->add_control(
			'social_links',
			array(
				'label'       => __( 'Social Links', 'website-section-supporter' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater_social->get_controls(),
				'default'     => array(
					array( 'platform' => 'fb', 'link' => array( 'url' => '#' ) ),
					array( 'platform' => 'ig', 'link' => array( 'url' => '#' ) ),
					array( 'platform' => 'in', 'link' => array( 'url' => '#' ) ),
					array( 'platform' => 'yt', 'link' => array( 'url' => '#' ) ),
				),
				'title_field' => '{{{ platform }}}',
				'condition'   => array( 'show_social' => 'yes' ),
			)
		);

		$this->end_controls_section();

		/* ================= RIGHT CONTENT: FORM & BACKGROUND ================= */
		$this->start_controls_section(
			'section_right_content',
			array( 'label' => __( 'Right: Form & Background', 'website-section-supporter' ) )
		);

		$this->add_control(
			'bg_image',
			array(
				'label'   => __( 'Background Image (Right Side)', 'website-section-supporter' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array( 'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1600&q=80' ),
			)
		);

		$this->add_control(
			'card_title',
			array(
				'label'   => __( 'Card Title', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Direct Inquiry',
			)
		);

		$this->add_control(
			'form_type',
			array(
				'label'   => __( 'Form Type', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'custom',
				'options' => array(
					'custom'    => __( 'Custom Luxury Form (AJAX)', 'website-section-supporter' ),
					'shortcode' => __( 'Shortcode (Elementor Pro / Form Plugin)', 'website-section-supporter' ),
				),
			)
		);

		$this->add_control(
			'form_shortcode',
			array(
				'label'       => __( 'Form Shortcode', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => '[elementor-template id="123"] or [wpforms id="1"]',
				'condition'   => array( 'form_type' => 'shortcode' ),
			)
		);

		$this->add_control( 'form_labels_heading', array( 'label' => __( 'Field Labels & Placeholders', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'condition' => array( 'form_type' => 'custom' ) ) );

		$this->add_control(
			'name_label',
			array( 'label' => __( 'Name Label', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => 'Name', 'condition' => array( 'form_type' => 'custom' ) )
		);
		$this->add_control(
			'name_placeholder',
			array( 'label' => __( 'Name Placeholder', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => 'Enter your full name', 'condition' => array( 'form_type' => 'custom' ) )
		);

		$this->add_control(
			'phone_label',
			array( 'label' => __( 'Phone Label', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => 'Phone', 'condition' => array( 'form_type' => 'custom' ) )
		);
		$this->add_control(
			'phone_placeholder',
			array( 'label' => __( 'Phone Placeholder', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => 'Your phone', 'condition' => array( 'form_type' => 'custom' ) )
		);

		$this->add_control(
			'email_label',
			array( 'label' => __( 'Email Label', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => 'Email', 'condition' => array( 'form_type' => 'custom' ) )
		);
		$this->add_control(
			'email_placeholder',
			array( 'label' => __( 'Email Placeholder', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => '@', 'condition' => array( 'form_type' => 'custom' ) )
		);

		$this->add_control(
			'interest_label',
			array( 'label' => __( 'Interest Label', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => 'Interest', 'condition' => array( 'form_type' => 'custom' ) )
		);
		$this->add_control(
			'interest_placeholder',
			array( 'label' => __( 'Interest Default Option Text', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => 'Select nature of interest', 'condition' => array( 'form_type' => 'custom' ) )
		);
		$this->add_control(
			'interest_options',
			array(
				'label'       => __( 'Interest Dropdown Options (One per line)', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => "Buying / Acquisition\nSelling / Listing\nPrivate Estate Viewing\nGeneral Consultation",
				'condition'   => array( 'form_type' => 'custom' ),
			)
		);

		$this->add_control(
			'message_label',
			array( 'label' => __( 'Message Label', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => 'Your Message', 'condition' => array( 'form_type' => 'custom' ) )
		);
		$this->add_control(
			'message_placeholder',
			array( 'label' => __( 'Message Placeholder', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => 'Type your message', 'condition' => array( 'form_type' => 'custom' ) )
		);

		$this->add_control(
			'show_consent',
			array(
				'label'        => __( 'Show Consent Checkbox', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'website-section-supporter' ),
				'label_off'    => __( 'No', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array( 'form_type' => 'custom' ),
			)
		);

		$this->add_control(
			'consent_text',
			array(
				'label'       => __( 'Consent Text (HTML allowed)', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'I agree to be contacted via call, email, and text for real estate services. To opt out, you can reply \'stop\' at any time or reply \'help\' for assistance. <a href="#">Privacy Policy</a>.', 'website-section-supporter' ),
				'condition'   => array( 'form_type' => 'custom', 'show_consent' => 'yes' ),
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'     => __( 'Submit Button Text', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'SEND MESSAGE',
				'condition' => array( 'form_type' => 'custom' ),
			)
		);

		$this->add_control(
			'success_message',
			array(
				'label'     => __( 'Success Notification Message', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Thank you for contacting us. We will get back to you shortly.', 'website-section-supporter' ),
				'condition' => array( 'form_type' => 'custom' ),
			)
		);

		$this->end_controls_section();

		/* ================= RECAPTCHA SETTINGS ================= */
		$this->start_controls_section(
			'section_recaptcha',
			array(
				'label'     => __( 'reCAPTCHA & Security', 'website-section-supporter' ),
				'condition' => array( 'form_type' => 'custom' ),
			)
		);

		$this->add_control(
			'enable_recaptcha',
			array(
				'label'        => __( 'Enable Google reCAPTCHA', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'website-section-supporter' ),
				'label_off'    => __( 'No', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);

		$this->add_control(
			'recaptcha_version',
			array(
				'label'     => __( 'reCAPTCHA Type', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'v2_checkbox',
				'options'   => array(
					'v2_checkbox' => __( 'reCAPTCHA v2 (Checkbox)', 'website-section-supporter' ),
					'v3'          => __( 'reCAPTCHA v3 (Invisible Score)', 'website-section-supporter' ),
				),
				'condition' => array( 'enable_recaptcha' => 'yes' ),
			)
		);

		$this->add_control(
			'recaptcha_site_key',
			array(
				'label'       => __( 'reCAPTCHA Site Key', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => '6LeIxacZAAAAA...',
				'condition'   => array( 'enable_recaptcha' => 'yes' ),
			)
		);

		$this->add_control(
			'recaptcha_secret_key',
			array(
				'label'       => __( 'reCAPTCHA Secret Key', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => '6LeIxacZAAAAA...',
				'condition'   => array( 'enable_recaptcha' => 'yes' ),
			)
		);

		$this->end_controls_section();

		/* ================= EMAIL & NOTIFICATIONS ================= */
		$this->start_controls_section(
			'section_email_settings',
			array(
				'label'     => __( 'Email & Notification Settings', 'website-section-supporter' ),
				'condition' => array( 'form_type' => 'custom' ),
			)
		);

		$this->add_control(
			'form_action',
			array(
				'label'       => __( 'Webhook URL (Optional External Forwarding)', 'website-section-supporter' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://webhook.site/...',
			)
		);

		$this->add_control(
			'email_to',
			array(
				'label'       => __( 'To Email', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => get_option( 'admin_email' ),
				'placeholder' => 'admin@example.com',
				'description' => __( 'Default is WordPress site admin email.', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'email_cc',
			array(
				'label'       => __( 'CC Email', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'cc@example.com',
			)
		);

		$this->add_control(
			'email_bcc',
			array(
				'label'       => __( 'BCC Email', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'bcc@example.com',
			)
		);

		$this->add_control(
			'email_subject',
			array(
				'label'   => __( 'Email Subject', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'New Luxury Inquiry from {{name}} - {{interest}}', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'email_content_type',
			array(
				'label'   => __( 'Content Type', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'html',
				'options' => array(
					'html'  => 'HTML',
					'plain' => 'Plain Text',
				),
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: LAYOUT & BACKGROUNDS ================= */
		$this->start_controls_section(
			'style_layout',
			array( 'label' => __( 'Layout & Backgrounds', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);

		$this->add_control(
			'left_bg_color',
			array(
				'label'     => __( 'Left Side Background', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f5f3ee',
				'selectors' => array( '{{WRAPPER}} .wss-contact-left' => 'background-color: {{VALUE}};' ),
			)
		);

		$this->add_responsive_control(
			'left_padding',
			array(
				'label'      => __( 'Left Side Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'vw' ),
				'selectors'  => array( '{{WRAPPER}} .wss-contact-left' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ),
			)
		);

		$this->add_control(
			'watermark_color',
			array(
				'label'     => __( 'Watermark Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-watermark' => 'color: {{VALUE}};' ),
				'condition' => array( 'show_watermark' => 'yes' ),
			)
		);

		$this->add_control(
			'right_overlay_color',
			array(
				'label'     => __( 'Right Image Dark Overlay', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(19, 18, 16, 0.22)',
				'selectors' => array( '{{WRAPPER}} .wss-contact-right::before' => 'background: {{VALUE}};' ),
			)
		);

		$this->add_responsive_control(
			'right_padding',
			array(
				'label'      => __( 'Right Side Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'vw' ),
				'selectors'  => array( '{{WRAPPER}} .wss-contact-right' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ),
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: LEFT TYPOGRAPHY & CARDS ================= */
		$this->start_controls_section(
			'style_left_typo',
			array( 'label' => __( 'Left Content Typography & Cards', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);

		$this->add_control( 'heading_style_title', array( 'label' => __( 'Main Heading', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING ) );
		$this->add_control(
			'heading_color',
			array( 'label' => __( 'Heading Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-contact-left h1' => 'color: {{VALUE}};' ) )
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'heading_typography', 'selector' => '{{WRAPPER}} .wss-contact-left h1' )
		);

		$this->add_control( 'agent_style_title', array( 'label' => __( 'Agent Info & Details', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_control(
			'agent_text_color',
			array( 'label' => __( 'Text Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-contact-col p, {{WRAPPER}} .wss-contact-col a' => 'color: {{VALUE}};' ) )
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'agent_typography', 'selector' => '{{WRAPPER}} .wss-contact-col' )
		);

		$this->add_control( 'tagline_style_title', array( 'label' => __( 'Tagline', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_control(
			'tagline_color',
			array( 'label' => __( 'Tagline Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-tagline' => 'color: {{VALUE}};' ) )
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'tagline_typography', 'selector' => '{{WRAPPER}} .wss-tagline' )
		);

		$this->add_control( 'card_style_title', array( 'label' => __( 'Vertical Contact Cards', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_control(
			'vcard_bg',
			array( 'label' => __( 'Card Background', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-vertical-card' => 'background-color: {{VALUE}};' ) )
		);
		$this->add_control(
			'vcard_border',
			array( 'label' => __( 'Card Border Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-vertical-card' => 'border-color: {{VALUE}};' ) )
		);
		$this->add_control(
			'vcard_text_color',
			array( 'label' => __( 'Card Text Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-vertical-card-text strong' => 'color: {{VALUE}};' ) )
		);
		$this->add_control(
			'vcard_icon_color',
			array( 'label' => __( 'Icon Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-vertical-card-icon' => 'color: {{VALUE}};' ) )
		);

		$this->add_control( 'social_style_title', array( 'label' => __( 'Social Icons', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_control(
			'social_color',
			array( 'label' => __( 'Social Icon Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-social-row a' => 'color: {{VALUE}};' ) )
		);
		$this->add_control(
			'social_hover_color',
			array( 'label' => __( 'Social Icon Hover Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-social-row a:hover' => 'color: {{VALUE}};' ) )
		);

		$this->end_controls_section();

		/* ================= STYLE: FLOATING FORM CARD ================= */
		$this->start_controls_section(
			'style_form_card',
			array( 'label' => __( 'Floating Form Card', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);

		$this->add_control(
			'card_bg',
			array( 'label' => __( 'Card Background', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'default' => '#ffffff', 'selectors' => array( '{{WRAPPER}} .wss-floating-card' => 'background-color: {{VALUE}};' ) )
		);

		$this->add_responsive_control(
			'card_padding',
			array(
				'label'      => __( 'Card Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array( '{{WRAPPER}} .wss-floating-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ),
			)
		);

		$this->add_responsive_control(
			'card_border_radius',
			array(
				'label'      => __( 'Card Border Radius', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 40 ) ),
				'default'    => array( 'size' => 12, 'unit' => 'px' ),
				'selectors'  => array( '{{WRAPPER}} .wss-floating-card' => 'border-radius: {{SIZE}}{{UNIT}};' ),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array( 'name' => 'card_box_shadow', 'selector' => '{{WRAPPER}} .wss-floating-card' )
		);

		$this->add_control( 'card_title_heading', array( 'label' => __( 'Card Title Typography', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_control(
			'card_title_color',
			array( 'label' => __( 'Title Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-card-title' => 'color: {{VALUE}};' ) )
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'card_title_typography', 'selector' => '{{WRAPPER}} .wss-card-title' )
		);

		$this->end_controls_section();

		/* ================= STYLE: FORM FIELDS ================= */
		$this->start_controls_section(
			'style_form_fields',
			array( 'label' => __( 'Form Inputs & Fields', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);

		$this->add_control( 'field_labels_heading', array( 'label' => __( 'Field Labels', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING ) );
		$this->add_control(
			'field_label_color',
			array( 'label' => __( 'Label Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-field-label' => 'color: {{VALUE}};' ) )
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'field_label_typography', 'selector' => '{{WRAPPER}} .wss-field-label' )
		);

		$this->add_control( 'field_inputs_heading', array( 'label' => __( 'Input / Select / Textarea', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );

		$this->add_control(
			'input_bg',
			array( 'label' => __( 'Input Background Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'default' => '#eceae4', 'selectors' => array( '{{WRAPPER}} .wss-pill-input, {{WRAPPER}} .wss-pill-select, {{WRAPPER}} .wss-pill-textarea' => 'background-color: {{VALUE}};' ) )
		);
		$this->add_control(
			'input_text_color',
			array( 'label' => __( 'Input Text Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-pill-input, {{WRAPPER}} .wss-pill-select, {{WRAPPER}} .wss-pill-textarea' => 'color: {{VALUE}};' ) )
		);
		$this->add_control(
			'input_placeholder_color',
			array( 'label' => __( 'Placeholder Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-pill-input::placeholder, {{WRAPPER}} .wss-pill-textarea::placeholder' => 'color: {{VALUE}};' ) )
		);
		$this->add_control(
			'input_focus_border_color',
			array( 'label' => __( 'Focus Accent Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'default' => '#a8916f', 'selectors' => array( '{{WRAPPER}} .wss-pill-input:focus, {{WRAPPER}} .wss-pill-select:focus, {{WRAPPER}} .wss-pill-textarea:focus' => 'border-color: {{VALUE}} !important; box-shadow: 0 0 0 3px rgba(168,145,111,0.15) !important;' ) )
		);

		$this->add_responsive_control(
			'input_border_radius',
			array(
				'label'      => __( 'Input Border Radius', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 40 ) ),
				'default'    => array( 'size' => 26, 'unit' => 'px' ),
				'selectors'  => array( '{{WRAPPER}} .wss-pill-input, {{WRAPPER}} .wss-pill-select' => 'border-radius: {{SIZE}}{{UNIT}};' ),
			)
		);

		$this->add_responsive_control(
			'input_padding',
			array(
				'label'      => __( 'Input Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array( '{{WRAPPER}} .wss-pill-input, {{WRAPPER}} .wss-pill-select, {{WRAPPER}} .wss-pill-textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ),
			)
		);

		$this->add_control( 'consent_style_heading', array( 'label' => __( 'Consent Checkbox & Text', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_control(
			'consent_color',
			array( 'label' => __( 'Consent Text Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-simple-consent label' => 'color: {{VALUE}};' ) )
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'consent_typography', 'selector' => '{{WRAPPER}} .wss-simple-consent label' )
		);

		$this->end_controls_section();

		/* ================= STYLE: SUBMIT BUTTON ================= */
		$this->start_controls_section(
			'style_button',
			array( 'label' => __( 'Submit Button', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);

		$this->add_control(
			'button_color',
			array( 'label' => __( 'Text Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-send-btn' => 'color: {{VALUE}};' ) )
		);
		$this->add_control(
			'button_bg',
			array( 'label' => __( 'Background Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-send-btn' => 'background-color: {{VALUE}};' ) )
		);
		$this->add_control(
			'button_border_color',
			array( 'label' => __( 'Border Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-send-btn' => 'border-color: {{VALUE}};' ) )
		);

		$this->add_control(
			'button_hover_color',
			array( 'label' => __( 'Hover Text Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-send-btn:hover' => 'color: {{VALUE}};' ) )
		);
		$this->add_control(
			'button_hover_bg',
			array( 'label' => __( 'Hover Background Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-send-btn::before' => 'background-color: {{VALUE}};' ) )
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'button_typography', 'selector' => '{{WRAPPER}} .wss-send-btn' )
		);

		$this->add_responsive_control(
			'button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 50 ) ),
				'default'    => array( 'size' => 40, 'unit' => 'px' ),
				'selectors'  => array( '{{WRAPPER}} .wss-send-btn' => 'border-radius: {{SIZE}}{{UNIT}};' ),
			)
		);

		$this->add_responsive_control(
			'button_padding',
			array(
				'label'      => __( 'Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array( '{{WRAPPER}} .wss-send-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		$bg_img = ! empty( $s['bg_image']['url'] ) ? $s['bg_image']['url'] : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1600&q=80';
		$widget_uid = 'wss-contact-' . $this->get_id();
		$enable_recaptcha = ! empty( $s['enable_recaptcha'] ) && 'yes' === $s['enable_recaptcha'];
		$recaptcha_site_key = ! empty( $s['recaptcha_site_key'] ) ? $s['recaptcha_site_key'] : '';
		$recaptcha_version = ! empty( $s['recaptcha_version'] ) ? $s['recaptcha_version'] : 'v2_checkbox';

		// Parse interest options
		$interest_lines = ! empty( $s['interest_options'] ) ? explode( "\n", str_replace( "\r", "", $s['interest_options'] ) ) : array();
		?>
		<div class="wss-scope">
			<section class="wss-contact-wrapper" id="<?php echo esc_attr( $widget_uid ); ?>">
				
				<!-- LEFT SIDE: Contact Information & Branding -->
				<div class="wss-contact-left">
					<?php if ( 'yes' === ( $s['show_watermark'] ?? 'yes' ) && ! empty( $s['watermark_text'] ) ) : ?>
						<div class="wss-watermark"><?php echo esc_html( $s['watermark_text'] ); ?></div>
					<?php endif; ?>

					<?php if ( ! empty( $s['heading'] ) ) : ?>
						<h1><?php echo esc_html( $s['heading'] ); ?></h1>
					<?php endif; ?>

					<!-- Contact Details Grid -->
					<div class="wss-contact-details-grid">
						<div class="wss-contact-col">
							<?php if ( ! empty( $s['agent_name'] ) ) : ?>
								<p class="agent-name"><?php echo esc_html( $s['agent_name'] ); ?></p>
							<?php endif; ?>
							<?php if ( ! empty( $s['agent_license'] ) ) : ?>
								<p class="dre-number"><?php echo esc_html( $s['agent_license'] ); ?></p>
							<?php endif; ?>
							<?php if ( ! empty( $s['agent_phone'] ) ) : ?>
								<p><a href="<?php echo esc_url( $s['agent_phone_link']['url'] ?: 'tel:' . preg_replace('/[^0-9+]/', '', $s['agent_phone']) ); ?>"><?php echo esc_html( $s['agent_phone'] ); ?></a></p>
							<?php endif; ?>
							<?php if ( ! empty( $s['agent_email'] ) ) : ?>
								<p><a href="<?php echo esc_url( $s['agent_email_link']['url'] ?: 'mailto:' . $s['agent_email'] ); ?>"><?php echo esc_html( $s['agent_email'] ); ?></a></p>
							<?php endif; ?>
						</div>

						<div class="wss-contact-col">
							<?php if ( ! empty( $s['address_line_1'] ) ) : ?>
								<p><?php echo esc_html( $s['address_line_1'] ); ?></p>
							<?php endif; ?>
							<?php if ( ! empty( $s['address_line_2'] ) ) : ?>
								<p><?php echo esc_html( $s['address_line_2'] ); ?></p>
							<?php endif; ?>
						</div>
					</div>

					<!-- Vertical Quick Contact Cards -->
					<?php if ( 'yes' === ( $s['show_vertical_cards'] ?? 'yes' ) ) : ?>
						<div class="wss-left-cards">
							<?php if ( ! empty( $s['card_phone_value'] ) ) : ?>
								<a href="<?php echo esc_url( $s['agent_phone_link']['url'] ?: 'tel:' . preg_replace('/[^0-9+]/', '', $s['card_phone_value']) ); ?>" class="wss-vertical-card">
									<div class="wss-vertical-card-icon">
										<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
									</div>
									<div class="wss-vertical-card-text">
										<span><?php echo esc_html( $s['card_phone_label'] ); ?></span>
										<strong><?php echo esc_html( $s['card_phone_value'] ); ?></strong>
									</div>
								</a>
							<?php endif; ?>

							<?php if ( ! empty( $s['card_email_value'] ) ) : ?>
								<a href="<?php echo esc_url( $s['agent_email_link']['url'] ?: 'mailto:' . $s['card_email_value'] ); ?>" class="wss-vertical-card">
									<div class="wss-vertical-card-icon">
										<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
									</div>
									<div class="wss-vertical-card-text">
										<span><?php echo esc_html( $s['card_email_label'] ); ?></span>
										<strong><?php echo esc_html( $s['card_email_value'] ); ?></strong>
									</div>
								</a>
							<?php endif; ?>

							<?php if ( ! empty( $s['card_wa_value'] ) ) : ?>
								<a href="<?php echo esc_url( $s['card_wa_link']['url'] ?: '#' ); ?>" target="_blank" rel="noopener" class="wss-vertical-card">
									<div class="wss-vertical-card-icon">
										<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
									</div>
									<div class="wss-vertical-card-text">
										<span><?php echo esc_html( $s['card_wa_label'] ); ?></span>
										<strong><?php echo esc_html( $s['card_wa_value'] ); ?></strong>
									</div>
								</a>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $s['tagline'] ) ) : ?>
						<p class="wss-tagline"><?php echo esc_html( $s['tagline'] ); ?></p>
					<?php endif; ?>

					<!-- Social Icons Row -->
					<?php if ( 'yes' === ( $s['show_social'] ?? 'yes' ) && ! empty( $s['social_links'] ) ) : ?>
						<div class="wss-social-row">
							<?php foreach ( $s['social_links'] as $social ) :
								$platform = ! empty( $social['platform'] ) ? $social['platform'] : 'fb';
								$url      = ! empty( $social['link']['url'] ) ? $social['link']['url'] : '#';
								?>
								<a href="<?php echo esc_url( $url ); ?>"<?php echo ! empty( $social['link']['is_external'] ) ? ' target="_blank" rel="noopener"' : ''; ?> aria-label="<?php echo esc_attr( $platform ); ?>">
									<?php echo $this->get_social_svg( $platform ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
								</a>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>

				<!-- RIGHT SIDE: Estate Background with Floating Card -->
				<div class="wss-contact-right" style="background-image: url('<?php echo esc_url( $bg_img ); ?>');">
					<div class="wss-floating-card">
						<?php if ( ! empty( $s['card_title'] ) ) : ?>
							<div class="wss-card-header">
								<h3 class="wss-card-title"><?php echo esc_html( $s['card_title'] ); ?></h3>
							</div>
						<?php endif; ?>

						<?php if ( 'shortcode' === ( $s['form_type'] ?? 'custom' ) && ! empty( $s['form_shortcode'] ) ) : ?>
							<div class="wss-contact-shortcode-wrap">
								<?php echo do_shortcode( shortcode_unautop( $s['form_shortcode'] ) ); ?>
							</div>
						<?php else : ?>
							<?php $has_webhook = ! empty( $s['form_action']['url'] ); ?>
							<form class="wss-contact-form wss-contact-ajax-form" action="<?php echo esc_url( $has_webhook ? $s['form_action']['url'] : admin_url('admin-ajax.php') ); ?>" method="post">
								
								<input type="hidden" name="action" value="wss_contact_submit">
								<input type="hidden" name="wss_contact_nonce" value="<?php echo wp_create_nonce('wss_contact_nonce'); ?>">
								<input type="hidden" name="email_to" value="<?php echo esc_attr( $s['email_to'] ?? '' ); ?>">
								<input type="hidden" name="email_cc" value="<?php echo esc_attr( $s['email_cc'] ?? '' ); ?>">
								<input type="hidden" name="email_bcc" value="<?php echo esc_attr( $s['email_bcc'] ?? '' ); ?>">
								<input type="hidden" name="email_subject" value="<?php echo esc_attr( $s['email_subject'] ?? '' ); ?>">
								<input type="hidden" name="email_content_type" value="<?php echo esc_attr( $s['email_content_type'] ?? 'html' ); ?>">
								<input type="hidden" name="success_msg" value="<?php echo esc_attr( $s['success_message'] ?? '' ); ?>">
								<input type="hidden" name="post_id" value="<?php echo get_the_ID(); ?>">
								<input type="hidden" name="widget_id" value="<?php echo esc_attr($this->get_id()); ?>">
								<input type="hidden" name="recaptcha_secret" value="<?php echo esc_attr( $s['recaptcha_secret_key'] ?? '' ); ?>">

								<!-- Row 1: Name & Phone -->
								<div class="wss-form-grid-2">
									<div class="wss-field-group">
										<label class="wss-field-label" for="<?php echo esc_attr( $widget_uid ); ?>-name"><?php echo esc_html( $s['name_label'] ?? 'Name' ); ?></label>
										<input type="text" id="<?php echo esc_attr( $widget_uid ); ?>-name" name="wss_name" class="wss-pill-input" placeholder="<?php echo esc_attr( $s['name_placeholder'] ?? 'Enter your full name' ); ?>" required>
									</div>
									<div class="wss-field-group">
										<label class="wss-field-label" for="<?php echo esc_attr( $widget_uid ); ?>-phone"><?php echo esc_html( $s['phone_label'] ?? 'Phone' ); ?></label>
										<input type="tel" id="<?php echo esc_attr( $widget_uid ); ?>-phone" name="wss_phone" class="wss-pill-input" placeholder="<?php echo esc_attr( $s['phone_placeholder'] ?? 'Your phone' ); ?>" required>
									</div>
								</div>

								<!-- Row 2: Email -->
								<div class="wss-field-group">
									<label class="wss-field-label" for="<?php echo esc_attr( $widget_uid ); ?>-email"><?php echo esc_html( $s['email_label'] ?? 'Email' ); ?></label>
									<input type="email" id="<?php echo esc_attr( $widget_uid ); ?>-email" name="wss_email" class="wss-pill-input" placeholder="<?php echo esc_attr( $s['email_placeholder'] ?? '@' ); ?>" required>
								</div>

								<!-- Row 3: Interest -->
								<div class="wss-field-group">
									<label class="wss-field-label" for="<?php echo esc_attr( $widget_uid ); ?>-interest"><?php echo esc_html( $s['interest_label'] ?? 'Interest' ); ?></label>
									<select id="<?php echo esc_attr( $widget_uid ); ?>-interest" name="wss_interest" class="wss-pill-select" required>
										<option value="" disabled selected><?php echo esc_html( $s['interest_placeholder'] ?? 'Select nature of interest' ); ?></option>
										<?php foreach ( $interest_lines as $opt ) : 
											$opt_clean = trim( $opt );
											if ( empty( $opt_clean ) ) continue;
										?>
											<option value="<?php echo esc_attr( $opt_clean ); ?>"><?php echo esc_html( $opt_clean ); ?></option>
										<?php endforeach; ?>
									</select>
								</div>

								<!-- Row 4: Message -->
								<div class="wss-field-group">
									<label class="wss-field-label" for="<?php echo esc_attr( $widget_uid ); ?>-message"><?php echo esc_html( $s['message_label'] ?? 'Your Message' ); ?></label>
									<textarea id="<?php echo esc_attr( $widget_uid ); ?>-message" name="wss_message" class="wss-pill-textarea" placeholder="<?php echo esc_attr( $s['message_placeholder'] ?? 'Type your message' ); ?>" required></textarea>
								</div>

								<!-- Google reCAPTCHA v2 Checkbox if enabled -->
								<?php if ( $enable_recaptcha && ! empty( $recaptcha_site_key ) ) : ?>
									<div class="wss-recaptcha-wrap" style="margin-bottom: 16px;">
										<?php if ( 'v2_checkbox' === $recaptcha_version ) : ?>
											<script src="https://www.google.com/recaptcha/api.js" async defer></script>
											<div class="g-recaptcha" data-sitekey="<?php echo esc_attr( $recaptcha_site_key ); ?>"></div>
										<?php elseif ( 'v3' === $recaptcha_version ) : ?>
											<script src="https://www.google.com/recaptcha/api.js?render=<?php echo esc_attr( $recaptcha_site_key ); ?>"></script>
											<input type="hidden" name="g-recaptcha-response" id="<?php echo esc_attr( $widget_uid ); ?>-g-recaptcha-response">
											<script>
												grecaptcha.ready(function() {
													grecaptcha.execute('<?php echo esc_attr( $recaptcha_site_key ); ?>', {action: 'contact'}).then(function(token) {
														var input = document.getElementById('<?php echo esc_attr( $widget_uid ); ?>-g-recaptcha-response');
														if (input) input.value = token;
													});
												});
											</script>
										<?php endif; ?>
									</div>
								<?php endif; ?>

								<!-- Consent Checkbox -->
								<?php if ( 'yes' === ( $s['show_consent'] ?? 'yes' ) && ! empty( $s['consent_text'] ) ) : ?>
									<div class="wss-simple-consent">
										<input type="checkbox" id="<?php echo esc_attr( $widget_uid ); ?>-consent" required checked>
										<label for="<?php echo esc_attr( $widget_uid ); ?>-consent">
											<?php echo wp_kses_post( $s['consent_text'] ); ?>
										</label>
									</div>
								<?php endif; ?>

								<!-- Submit Button -->
								<button type="submit" class="wss-send-btn">
									<span><?php echo esc_html( $s['button_text'] ?? 'SEND MESSAGE' ); ?></span>
								</button>

								<!-- Form notification / message output -->
								<div class="wss-form-status-msg" style="display:none; font-size:13px; margin-top:14px; padding:10px 14px; border-radius:4px;"></div>
							</form>
						<?php endif; ?>
					</div>
				</div>

			</section>
		</div>
		<?php
	}

	private function get_social_svg( $label ) {
		$label = strtolower( trim( $label ) );
		$icons = array(
			'f'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>',
			'fb'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>',
			'in'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>',
			'ig'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>',
			'yt'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 0 0 1.46 6.42 29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58 2.78 2.78 0 0 0 1.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.96A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/></svg>',
			'x'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4l16 16M20 4L4 20"/></svg>',
			'wa'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>',
		);
		if ( isset( $icons[ $label ] ) ) {
			return $icons[ $label ];
		}
		return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="9"/><text x="12" y="16" text-anchor="middle" font-size="8" fill="currentColor" stroke="none">' . esc_html( strtoupper( substr( $label, 0, 2 ) ) ) . '</text></svg>';
	}
}
