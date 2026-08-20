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

class WSS_Buyer_Guide_Widget extends Widget_Base {

	public function get_name() {
		return 'wss_buyer_guide';
	}

	public function get_title() {
		return __( 'WSS — Buyer Guide & Lead Magnet', 'website-section-supporter' );
	}

	public function get_icon() {
		return 'eicon-document-file';
	}

	public function get_categories() {
		return array( 'website-section-supporter' );
	}

	public function get_keywords() {
		return array( 'buyer', 'guide', 'blueprint', 'pdf', 'lead', 'form', 'download', 'recaptcha', 'autoresponder', 'vpsignature' );
	}

	protected function register_controls() {

		/* ================= CONTENT: LEFT DETAILS ================= */
		$this->start_controls_section(
			'section_content_left',
			array(
				'label' => __( 'Left: Guide Overview & Checklist', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'       => __( 'Eyebrow Text', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '03 // EXCLUSIVE BUYER RESOURCE', 'website-section-supporter' ),
				'placeholder' => __( '03 // EXCLUSIVE BUYER RESOURCE', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Main Heading', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'The Central Florida Luxury Buyer\'s Blueprint', 'website-section-supporter' ),
				'placeholder' => __( 'Enter guide heading', 'website-section-supporter' ),
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
				'label'       => __( 'Lead Description', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'An authoritative, confidential guide curated by Victoria Price for discerning buyers seeking primary residences, lakefront enclaves, or vacation investments across Orlando and Central Florida.', 'website-section-supporter' ),
				'rows'        => 4,
			)
		);

		$checklist_repeater = new Repeater();

		$checklist_repeater->add_control(
			'bold_prefix',
			array(
				'label'       => __( 'Bold Prefix / Title', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Discreet Off-Market Sourcing:', 'website-section-supporter' ),
			)
		);

		$checklist_repeater->add_control(
			'item_text',
			array(
				'label'       => __( 'Checklist Text', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Proven protocols to access exclusive properties before they reach public channels.', 'website-section-supporter' ),
				'rows'        => 2,
			)
		);

		$this->add_control(
			'checklist_items',
			array(
				'label'       => __( 'Guide Checklist Items', 'website-section-supporter' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $checklist_repeater->get_controls(),
				'title_field' => '{{{ bold_prefix }}}',
				'default'     => array(
					array(
						'bold_prefix' => __( 'Discreet Off-Market Sourcing:', 'website-section-supporter' ),
						'item_text'   => __( 'Proven protocols to access exclusive properties before they reach public channels.', 'website-section-supporter' ),
					),
					array(
						'bold_prefix' => __( 'Submarket Breakdown:', 'website-section-supporter' ),
						'item_text'   => __( 'Price-per-sq-ft analysis, HOA governance, and lifestyle indices in Winter Park, Windermere & Lake Nona.', 'website-section-supporter' ),
					),
					array(
						'bold_prefix' => __( 'Due Diligence Checklist:', 'website-section-supporter' ),
						'item_text'   => __( 'Florida homestead exemption benefits, riparian rights, dock permits, and inspection safeguards.', 'website-section-supporter' ),
					),
				),
			)
		);

		$this->add_control(
			'enable_reveal',
			array(
				'label'        => __( 'Enable Scroll Reveal Animation', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
				'separator'    => 'before',
			)
		);

		$this->end_controls_section();

		/* ================= CONTENT: RIGHT FORM ================= */
		$this->start_controls_section(
			'section_content_form',
			array(
				'label' => __( 'Right: Lead Capture Form', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'form_badge',
			array(
				'label'       => __( 'Form Top Badge', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '2026 Edition', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'form_title',
			array(
				'label'       => __( 'Form Title', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Receive Your Blueprint', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'name_placeholder',
			array(
				'label'   => __( 'Name Field Placeholder', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Your Full Name *', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'email_placeholder',
			array(
				'label'   => __( 'Email Field Placeholder', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Your Email Address *', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'show_phone',
			array(
				'label'        => __( 'Show Phone Field', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'phone_placeholder',
			array(
				'label'     => __( 'Phone Field Placeholder', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Phone Number (Optional)', 'website-section-supporter' ),
				'condition' => array( 'show_phone' => 'yes' ),
			)
		);

		$this->add_control(
			'show_timeline',
			array(
				'label'        => __( 'Show Timeline Dropdown', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'timeline_label',
			array(
				'label'     => __( 'Timeline Default Option', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Buying Horizon / Timeline', 'website-section-supporter' ),
				'condition' => array( 'show_timeline' => 'yes' ),
			)
		);

		$this->add_control(
			'btn_text',
			array(
				'label'       => __( 'Submit Button Text', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Download Guide (PDF)', 'website-section-supporter' ),
				'separator'   => 'before',
			)
		);

		$this->add_control(
			'privacy_note',
			array(
				'label'       => __( 'Privacy / Disclaimer Note', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Strict confidentiality guaranteed. We respect your privacy.', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'success_message',
			array(
				'label'       => __( 'Success Message Text', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Thank you! Your complimentary Buyer Blueprint has been sent to your email and is downloading now.', 'website-section-supporter' ),
				'rows'        => 2,
			)
		);

		$this->end_controls_section();

		/* ================= CONTENT: PDF UPLOAD & LEAD MAGNET ================= */
		$this->start_controls_section(
			'section_content_pdf',
			array(
				'label' => __( 'PDF File Upload & Download', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'guide_pdf_file',
			array(
				'label'       => __( 'Select / Upload Buyer Guide PDF', 'website-section-supporter' ),
				'type'        => Controls_Manager::MEDIA,
				'description' => __( 'Select your PDF from the WordPress Media Library. This PDF will be attached to user confirmation emails and downloaded on submit.', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'guide_pdf_url_override',
			array(
				'label'       => __( 'External PDF URL (Optional)', 'website-section-supporter' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://example.com/buyer-guide.pdf',
				'description' => __( 'Optional external link if hosting PDF externally (e.g. Google Drive, Dropbox).', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'auto_trigger_download',
			array(
				'label'        => __( 'Trigger Browser Download on Submit', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
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
				'description' => __( 'Leave blank to send to WordPress Admin Email.', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'admin_email_subject',
			array(
				'label'       => __( 'Email Subject', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'New Buyer Blueprint Download: {{name}}', 'website-section-supporter' ),
				'description' => __( 'Tokens: {{name}}, {{email}}, {{phone}}, {{timeline}}', 'website-section-supporter' ),
			)
		);

		// User Auto-responder
		$this->add_control(
			'heading_email_user',
			array(
				'label'     => __( '2. User Auto-Responder Email (with PDF Attachment)', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'enable_user_autoresponder',
			array(
				'label'        => __( 'Send Confirmation Email to User', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'user_sender_name',
			array(
				'label'       => __( 'Sender Name', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Victoria Price | VP Signature Group',
				'condition'   => array( 'enable_user_autoresponder' => 'yes' ),
			)
		);

		$this->add_control(
			'user_sender_email',
			array(
				'label'       => __( 'Sender / Reply-To Email', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'admin@vpsignature.com',
				'placeholder' => 'admin@vpsignature.com',
				'condition'   => array( 'enable_user_autoresponder' => 'yes' ),
			)
		);

		$this->add_control(
			'user_email_subject',
			array(
				'label'       => __( 'User Email Subject', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Your Central Florida Luxury Buyer\'s Blueprint (PDF Attached)', 'website-section-supporter' ),
				'condition'   => array( 'enable_user_autoresponder' => 'yes' ),
			)
		);

		$this->add_control(
			'attach_pdf_to_email',
			array(
				'label'        => __( 'Attach PDF File Directly to Email', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
				'description'  => __( 'Automatically attaches the uploaded PDF file to the user\'s incoming email.', 'website-section-supporter' ),
				'condition'    => array( 'enable_user_autoresponder' => 'yes' ),
			)
		);

		$this->add_control(
			'user_email_body',
			array(
				'label'       => __( 'User Email Message Body', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( "Dear {{name}},\n\nThank you for requesting The Central Florida Luxury Buyer's Blueprint. Please find your exclusive copy attached to this email.\n\nWhether you are exploring private lakefront enclaves in Windermere, historic estates in Winter Park, or golf residences in Lake Nona, our team is here to guide your search with discretion and strategic insight.\n\nWarm regards,\nVictoria Price | Broker - Owner\nVP Signature Group\n+1 (407) 584-7494\nadmin@vpsignature.com", 'website-section-supporter' ),
				'rows'        => 8,
				'condition'   => array( 'enable_user_autoresponder' => 'yes' ),
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: SECTION & CARD ================= */
		$this->start_controls_section(
			'style_guide_container',
			array(
				'label' => __( 'Section & Box Container', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'section_padding',
			array(
				'label'      => __( 'Section Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'vh' ),
				'default'    => array(
					'top'      => '110',
					'bottom'   => '110',
					'left'     => '0',
					'right'    => '0',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .wss-buyer-guide-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'section_bg_color',
			array(
				'label'     => __( 'Section Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0d0d0d',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-guide-section' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'box_bg_color',
			array(
				'label'     => __( 'Box Container Background', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#141414',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-guide-wrapper' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'box_border_color',
			array(
				'label'     => __( 'Box Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.12)',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-guide-wrapper' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'box_padding',
			array(
				'label'      => __( 'Box Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'default'    => array(
					'top'      => '80',
					'right'    => '70',
					'bottom'   => '80',
					'left'     => '70',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .wss-buyer-guide-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: TYPOGRAPHY ================= */
		$this->start_controls_section(
			'style_typography',
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
				'default'   => '#999999',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-guide-eyebrow' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'eyebrow_typography',
				'selector' => '{{WRAPPER}} .wss-buyer-guide-eyebrow',
			)
		);

		$this->add_responsive_control(
			'eyebrow_spacing',
			array(
				'label'      => __( 'Eyebrow Bottom Spacing', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 50 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 20 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-buyer-guide-eyebrow' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'heading_color',
			array(
				'label'     => __( 'Heading Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-guide-heading' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'heading_typography',
				'selector' => '{{WRAPPER}} .wss-buyer-guide-heading',
			)
		);

		$this->add_responsive_control(
			'heading_spacing',
			array(
				'label'      => __( 'Heading Bottom Spacing', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 60 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 20 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-buyer-guide-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'desc_color',
			array(
				'label'     => __( 'Description Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.8)',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-guide-desc' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'desc_typography',
				'selector' => '{{WRAPPER}} .wss-buyer-guide-desc',
			)
		);

		$this->add_responsive_control(
			'desc_spacing',
			array(
				'label'      => __( 'Description Bottom Spacing', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 60 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 32 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-buyer-guide-desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// Checklist Typography
		$this->add_control(
			'heading_style_checklist',
			array(
				'label'     => __( 'Checklist Items', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'checklist_color',
			array(
				'label'     => __( 'Checklist Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.88)',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-guide-check-item' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'checklist_typography',
				'selector' => '{{WRAPPER}} .wss-buyer-guide-check-item',
			)
		);

		$this->add_responsive_control(
			'checklist_spacing',
			array(
				'label'      => __( 'Checklist Item Gap', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 4, 'max' => 40 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 16 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-buyer-guide-checklist' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: FORM & BUTTON ================= */
		$this->start_controls_section(
			'style_form_box',
			array(
				'label' => __( 'Form Box & Submit Button', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'form_box_bg',
			array(
				'label'     => __( 'Form Box Background', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1c1c1c',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-guide-form-box' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'input_bg',
			array(
				'label'     => __( 'Input Background', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#141414',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-guide-input' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'input_border_color',
			array(
				'label'     => __( 'Input Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.16)',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-guide-input' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'submit_btn_bg',
			array(
				'label'     => __( 'Button Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-guide-submit-btn' => 'background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'submit_btn_color',
			array(
				'label'     => __( 'Button Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0d0d0d',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-guide-submit-btn' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-buyer-guide-submit-btn svg' => 'stroke: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'submit_btn_hover_bg',
			array(
				'label'     => __( 'Button Hover Curtain Background', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-guide-submit-btn::before' => 'background-color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-buyer-guide-submit-btn' => '--wss-btn-hover-bg: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();

		$tag = ! empty( $s['heading_html_tag'] ) ? $s['heading_html_tag'] : 'h2';
		$checklist = ! empty( $s['checklist_items'] ) ? $s['checklist_items'] : array();

		// PDF File URL resolution
		$pdf_url = '';
		$pdf_id  = 0;
		if ( ! empty( $s['guide_pdf_file']['url'] ) ) {
			$pdf_url = $s['guide_pdf_file']['url'];
			$pdf_id  = ! empty( $s['guide_pdf_file']['id'] ) ? $s['guide_pdf_file']['id'] : 0;
		} elseif ( ! empty( $s['guide_pdf_url_override']['url'] ) ) {
			$pdf_url = $s['guide_pdf_url_override']['url'];
		}

		$enable_recaptcha = ( ! empty( $s['enable_recaptcha'] ) && 'yes' === $s['enable_recaptcha'] && ! empty( $s['recaptcha_site_key'] ) );
		$recaptcha_v      = ! empty( $s['recaptcha_version'] ) ? $s['recaptcha_version'] : 'v3';
		$site_key         = ! empty( $s['recaptcha_site_key'] ) ? $s['recaptcha_site_key'] : '';
		$secret_key       = ! empty( $s['recaptcha_secret_key'] ) ? $s['recaptcha_secret_key'] : '';
		$enable_reveal = ! empty( $s['enable_reveal'] ) && 'yes' === $s['enable_reveal'];
		$delays        = array( 'wss-r1', 'wss-r2', 'wss-r3', 'wss-r4' );
		?>
		<div class="wss-scope">
			<section class="wss-buyer-guide-section wss-pad wss-on-dark" data-wss-widget="wss-buyer-guide">
				<div class="wss-container">
					
					<div class="wss-buyer-guide-wrapper">
						
						<!-- Left: Guide Overview & Value Checklist -->
						<div class="wss-buyer-guide-left <?php echo $enable_reveal ? 'wss-reveal' : ''; ?>">
							<?php if ( ! empty( $s['eyebrow'] ) ) : ?>
								<span class="wss-buyer-guide-eyebrow <?php echo $enable_reveal ? 'wss-reveal' : ''; ?>"><?php echo esc_html( $s['eyebrow'] ); ?></span>
							<?php endif; ?>

							<?php if ( ! empty( $s['heading'] ) ) : ?>
								<<?php echo esc_attr( $tag ); ?> class="wss-buyer-guide-heading <?php echo $enable_reveal ? 'wss-reveal wss-r1' : ''; ?>">
									<span class="wss-mask"><span><?php echo nl2br( esc_html( $s['heading'] ) ); ?></span></span>
								</<?php echo esc_attr( $tag ); ?>>
							<?php endif; ?>

							<?php if ( ! empty( $s['description'] ) ) : ?>
								<p class="wss-buyer-guide-desc <?php echo $enable_reveal ? 'wss-reveal wss-r2' : ''; ?>">
									<?php echo nl2br( esc_html( $s['description'] ) ); ?>
								</p>
							<?php endif; ?>

							<?php if ( ! empty( $checklist ) ) : ?>
								<div class="wss-buyer-guide-checklist <?php echo $enable_reveal ? 'wss-reveal wss-r3' : ''; ?>">
									<?php foreach ( $checklist as $c_idx => $item ) : 
										$c_stagger = $enable_reveal ? 'wss-reveal ' . $delays[ $c_idx % 4 ] : '';
									?>
										<div class="wss-buyer-guide-check-item <?php echo esc_attr( $c_stagger ); ?>">
											<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
											<span>
												<?php if ( ! empty( $item['bold_prefix'] ) ) : ?>
													<strong><?php echo esc_html( $item['bold_prefix'] ); ?></strong> 
												<?php endif; ?>
												<?php echo esc_html( $item['item_text'] ); ?>
											</span>
										</div>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>

						<!-- Right: High-Converting Lead Capture Form -->
						<div class="wss-buyer-guide-right <?php echo $enable_reveal ? 'wss-reveal wss-r2' : ''; ?>">
							<div class="wss-buyer-guide-form-box">
								
								<?php if ( ! empty( $s['form_badge'] ) ) : ?>
									<span class="wss-buyer-guide-form-badge"><?php echo esc_html( $s['form_badge'] ); ?></span>
								<?php endif; ?>

								<?php if ( ! empty( $s['form_title'] ) ) : ?>
									<h3 class="wss-buyer-guide-form-title"><?php echo esc_html( $s['form_title'] ); ?></h3>
								<?php endif; ?>

								<form class="wss-buyer-guide-form" method="post" action="<?php echo esc_url( admin_url('admin-ajax.php') ); ?>" data-auto-download="<?php echo ! empty( $s['auto_trigger_download'] ) && 'yes' === $s['auto_trigger_download'] ? 'yes' : 'no'; ?>" data-pdf-url="<?php echo esc_url( $pdf_url ); ?>">
									
									<input type="hidden" name="action" value="wss_buyer_guide_submit">
									<input type="hidden" name="wss_guide_nonce" value="<?php echo esc_attr( wp_create_nonce( 'wss_buyer_guide_nonce' ) ); ?>">
									<input type="hidden" name="pdf_attachment_id" value="<?php echo esc_attr( $pdf_id ); ?>">
									<input type="hidden" name="pdf_attachment_url" value="<?php echo esc_url( $pdf_url ); ?>">
									
									<!-- Admin & Autoresponder Config (Passed securely) -->
									<input type="hidden" name="admin_email_to" value="<?php echo esc_attr( $s['admin_email_to'] ); ?>">
									<input type="hidden" name="admin_email_subject" value="<?php echo esc_attr( $s['admin_email_subject'] ); ?>">
									<input type="hidden" name="enable_autoresponder" value="<?php echo esc_attr( $s['enable_user_autoresponder'] ); ?>">
									<input type="hidden" name="user_sender_name" value="<?php echo esc_attr( $s['user_sender_name'] ); ?>">
									<input type="hidden" name="user_sender_email" value="<?php echo esc_attr( $s['user_sender_email'] ); ?>">
									<input type="hidden" name="user_email_subject" value="<?php echo esc_attr( $s['user_email_subject'] ); ?>">
									<input type="hidden" name="attach_pdf" value="<?php echo esc_attr( $s['attach_pdf_to_email'] ); ?>">
									<input type="hidden" name="recaptcha_secret" value="<?php echo esc_attr( $secret_key ); ?>">

									<!-- Name Field -->
									<div class="wss-form-row">
										<input type="text" name="wss_name" class="wss-buyer-guide-input" placeholder="<?php echo esc_attr( $s['name_placeholder'] ); ?>" required>
									</div>

									<!-- Email Field -->
									<div class="wss-form-row">
										<input type="email" name="wss_email" class="wss-buyer-guide-input" placeholder="<?php echo esc_attr( $s['email_placeholder'] ); ?>" required>
									</div>

									<!-- Phone Field -->
									<?php if ( ! empty( $s['show_phone'] ) && 'yes' === $s['show_phone'] ) : ?>
										<div class="wss-form-row">
											<input type="tel" name="wss_phone" class="wss-buyer-guide-input" placeholder="<?php echo esc_attr( $s['phone_placeholder'] ); ?>">
										</div>
									<?php endif; ?>

									<!-- Timeline Select -->
									<?php if ( ! empty( $s['show_timeline'] ) && 'yes' === $s['show_timeline'] ) : ?>
										<div class="wss-form-row">
											<select name="wss_timeline" class="wss-buyer-guide-input wss-buyer-guide-select">
												<option value="" disabled selected><?php echo esc_html( $s['timeline_label'] ); ?></option>
												<option value="Immediate (Next 30–60 Days)">Immediate (Next 30–60 Days)</option>
												<option value="3 to 6 Months">3 to 6 Months</option>
												<option value="6 to 12 Months">6 to 12 Months</option>
												<option value="Just Researching Market">Just Researching Market</option>
											</select>
										</div>
									<?php endif; ?>

									<!-- Google reCAPTCHA v2 Checkbox UI -->
									<?php if ( $enable_recaptcha && 'v2' === $recaptcha_v ) : ?>
										<div class="wss-form-row wss-recaptcha-wrap" style="margin: 14px 0;">
											<div class="g-recaptcha" data-sitekey="<?php echo esc_attr( $site_key ); ?>"></div>
										</div>
										<script src="https://www.google.com/recaptcha/api.js" async defer></script>
									<?php elseif ( $enable_recaptcha && 'v3' === $recaptcha_v ) : ?>
										<input type="hidden" name="g-recaptcha-response" class="wss-recaptcha-v3-token" value="">
										<script src="https://www.google.com/recaptcha/api.js?render=<?php echo esc_attr( $site_key ); ?>"></script>
										<script>
											if (typeof grecaptcha !== 'undefined') {
												grecaptcha.ready(function() {
													grecaptcha.execute('<?php echo esc_js( $site_key ); ?>', {action: 'buyer_guide_submit'}).then(function(token) {
														var tokens = document.querySelectorAll('.wss-recaptcha-v3-token');
														tokens.forEach(function(el) { el.value = token; });
													});
												});
											}
										</script>
									<?php endif; ?>

									<!-- Submit Button -->
									<button type="submit" class="wss-btn-pill wss-buyer-guide-submit-btn">
										<span><?php echo esc_html( $s['btn_text'] ); ?></span>
										<svg viewBox="0 0 24 24"><path d="M12 5v14M5 12l7 7 7-7"/></svg>
									</button>

								</form>

								<!-- Instant Success Message State -->
								<div class="wss-buyer-guide-success-state" style="display: none;">
									<svg viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
									<h4><?php _e( 'Guide Delivered', 'website-section-supporter' ); ?></h4>
									<p><?php echo nl2br( esc_html( $s['success_message'] ) ); ?></p>
									<?php if ( ! empty( $pdf_url ) ) : ?>
										<a href="<?php echo esc_url( $pdf_url ); ?>" class="wss-buyer-guide-instant-link" download target="_blank" rel="noopener">
											<?php _e( 'Click here if your download does not start automatically', 'website-section-supporter' ); ?> &rarr;
										</a>
									<?php endif; ?>
								</div>

								<?php if ( ! empty( $s['privacy_note'] ) ) : ?>
									<p class="wss-buyer-guide-privacy-note"><?php echo esc_html( $s['privacy_note'] ); ?></p>
								<?php endif; ?>

							</div>
						</div>

					</div>

				</div>
			</section>
		</div>
		<?php
	}
}
