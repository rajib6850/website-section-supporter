<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;

/**
 * WSS Call to Action (CTA) Widget
 * 
 * Fully Elementor-controllable, ultra-luxury Call to Action section widget.
 * Designed for About pages, Sell pages, Community pages, or global conversion sections.
 */
class WSS_CTA_Widget extends Widget_Base {

	public function get_name() {
		return 'wss_cta';
	}

	public function get_title() {
		return __( 'WSS — Call to Action (CTA)', 'website-section-supporter' );
	}

	public function get_icon() {
		return 'eicon-call-to-action';
	}

	public function get_categories() {
		return array( 'website-section-supporter' );
	}

	public function get_keywords() {
		return array( 'cta', 'call to action', 'banner', 'contact', 'connect', 'inquiry', 'about', 'luxury', 'consultation' );
	}

	protected function register_controls() {

		/* ================= CONTENT: HEADINGS & TEXT ================= */
		$this->start_controls_section(
			'section_content',
			array( 'label' => __( 'Headings & Content', 'website-section-supporter' ) )
		);

		$this->add_control(
			'show_eyebrow',
			array(
				'label'        => __( 'Show Eyebrow', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'website-section-supporter' ),
				'label_off'    => __( 'No', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'       => __( 'Eyebrow / Sub-heading', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'BEGIN YOUR JOURNEY', 'website-section-supporter' ),
				'label_block' => true,
				'condition'   => array( 'show_eyebrow' => 'yes' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Heading', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( "What Are You\nPlanning Next?", 'website-section-supporter' ),
				'rows'        => 2,
				'dynamic'     => array( 'active' => true ),
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
					'h4'   => 'H4',
					'div'  => 'div',
					'span' => 'span',
				),
			)
		);

		$this->add_control(
			'show_desc',
			array(
				'label'        => __( 'Show Description', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'website-section-supporter' ),
				'label_off'    => __( 'No', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'description',
			array(
				'label'       => __( 'Description', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Whether buying, selling, or exploring market opportunities across Central Florida, VP Signature Group offers strategic guidance, absolute discretion, and personalized concierge representation.', 'website-section-supporter' ),
				'rows'        => 3,
				'condition'   => array( 'show_desc' => 'yes' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'layout_type',
			array(
				'label'   => __( 'Layout Mode', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'center',
				'options' => array(
					'center' => __( 'Centered Banner', 'website-section-supporter' ),
					'left'   => __( 'Left-Aligned', 'website-section-supporter' ),
					'split'  => __( 'Split 2-Column (Content Left, Actions Right)', 'website-section-supporter' ),
				),
			)
		);

		$this->add_responsive_control(
			'text_align',
			array(
				'label'     => __( 'Text Alignment', 'website-section-supporter' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array( 'title' => __( 'Left', 'website-section-supporter' ), 'icon' => 'eicon-text-align-left' ),
					'center' => array( 'title' => __( 'Center', 'website-section-supporter' ), 'icon' => 'eicon-text-align-center' ),
					'right'  => array( 'title' => __( 'Right', 'website-section-supporter' ), 'icon' => 'eicon-text-align-right' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .wss-cta-inner' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .wss-cta-text-col' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		/* ================= CONTENT: BUTTONS ================= */
		$this->start_controls_section(
			'section_buttons',
			array( 'label' => __( 'Action Buttons', 'website-section-supporter' ) )
		);

		// Primary Button
		$this->add_control(
			'heading_btn1',
			array(
				'label' => __( 'Primary Action Button', 'website-section-supporter' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'show_btn1',
			array(
				'label'        => __( 'Show Primary Button', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'website-section-supporter' ),
				'label_off'    => __( 'No', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'btn1_text',
			array(
				'label'       => __( 'Button Text', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'CONNECT WITH US', 'website-section-supporter' ),
				'condition'   => array( 'show_btn1' => 'yes' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'btn1_link',
			array(
				'label'       => __( 'Button Link', 'website-section-supporter' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com/contact', 'website-section-supporter' ),
				'default'     => array( 'url' => '#contact' ),
				'condition'   => array( 'show_btn1' => 'yes' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'btn1_style',
			array(
				'label'     => __( 'Button Style', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'pill',
				'options'   => array(
					'pill'  => __( 'Curtain Pill (Hover Sweep)', 'website-section-supporter' ),
					'solid' => __( 'Solid High Contrast', 'website-section-supporter' ),
					'glass' => __( 'Glass Capsule', 'website-section-supporter' ),
					'line'  => __( 'Underline Link', 'website-section-supporter' ),
				),
				'condition' => array( 'show_btn1' => 'yes' ),
			)
		);

		$this->add_control(
			'btn1_icon',
			array(
				'label'     => __( 'Button Icon', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'arrow',
				'options'   => array(
					'none'     => __( 'None', 'website-section-supporter' ),
					'arrow'    => __( 'Arrow Right', 'website-section-supporter' ),
					'phone'    => __( 'Phone Icon', 'website-section-supporter' ),
					'mail'     => __( 'Email Icon', 'website-section-supporter' ),
					'external' => __( 'External Link Arrow', 'website-section-supporter' ),
				),
				'condition' => array( 'show_btn1' => 'yes' ),
			)
		);

		$this->add_control(
			'btn1_icon_position',
			array(
				'label'     => __( 'Icon Position', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'after',
				'options'   => array(
					'before' => __( 'Before Text', 'website-section-supporter' ),
					'after'  => __( 'After Text', 'website-section-supporter' ),
				),
				'condition' => array(
					'show_btn1'  => 'yes',
					'btn1_icon!' => 'none',
				),
			)
		);

		// Secondary Button
		$this->add_control(
			'heading_btn2',
			array(
				'label'     => __( 'Secondary Action / Link', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'show_btn2',
			array(
				'label'        => __( 'Show Secondary Button', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'website-section-supporter' ),
				'label_off'    => __( 'No', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'btn2_text',
			array(
				'label'       => __( 'Button Text', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '+1 (407) 584-7494', 'website-section-supporter' ),
				'condition'   => array( 'show_btn2' => 'yes' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'btn2_link',
			array(
				'label'       => __( 'Button Link', 'website-section-supporter' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'tel:+14075847494', 'website-section-supporter' ),
				'default'     => array( 'url' => 'tel:+14075847494' ),
				'condition'   => array( 'show_btn2' => 'yes' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'btn2_style',
			array(
				'label'     => __( 'Button Style', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'line',
				'options'   => array(
					'line'  => __( 'Underline Link', 'website-section-supporter' ),
					'pill'  => __( 'Curtain Pill', 'website-section-supporter' ),
					'glass' => __( 'Glass Capsule', 'website-section-supporter' ),
					'solid' => __( 'Solid High Contrast', 'website-section-supporter' ),
				),
				'condition' => array( 'show_btn2' => 'yes' ),
			)
		);

		$this->add_control(
			'btn2_icon',
			array(
				'label'     => __( 'Button Icon', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'phone',
				'options'   => array(
					'none'     => __( 'None', 'website-section-supporter' ),
					'phone'    => __( 'Phone Icon', 'website-section-supporter' ),
					'arrow'    => __( 'Arrow Right', 'website-section-supporter' ),
					'mail'     => __( 'Email Icon', 'website-section-supporter' ),
					'external' => __( 'External Link Arrow', 'website-section-supporter' ),
				),
				'condition' => array( 'show_btn2' => 'yes' ),
			)
		);

		$this->add_control(
			'btn2_icon_position',
			array(
				'label'     => __( 'Icon Position', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'before',
				'options'   => array(
					'before' => __( 'Before Text', 'website-section-supporter' ),
					'after'  => __( 'After Text', 'website-section-supporter' ),
				),
				'condition' => array(
					'show_btn2'  => 'yes',
					'btn2_icon!' => 'none',
				),
			)
		);

		$this->end_controls_section();

		/* ================= CONTENT: DIRECT CONTACT BADGES ================= */
		$this->start_controls_section(
			'section_contact_badges',
			array( 'label' => __( 'Direct Contact Bar (Optional)', 'website-section-supporter' ) )
		);

		$this->add_control(
			'show_contact_bar',
			array(
				'label'        => __( 'Show Contact Info Bar', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'website-section-supporter' ),
				'label_off'    => __( 'Hide', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);

		$this->add_control(
			'badge_phone',
			array(
				'label'     => __( 'Phone Number', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '+1 (407) 584-7494',
				'condition' => array( 'show_contact_bar' => 'yes' ),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$this->add_control(
			'badge_email',
			array(
				'label'     => __( 'Email Address', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'admin@vpsignature.com',
				'condition' => array( 'show_contact_bar' => 'yes' ),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$this->add_control(
			'badge_location',
			array(
				'label'     => __( 'Office Location', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '300 S Orange Ave, Orlando, FL',
				'condition' => array( 'show_contact_bar' => 'yes' ),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		/* ================= CONTENT: BACKGROUND & PRESETS ================= */
		$this->start_controls_section(
			'section_bg_media',
			array( 'label' => __( 'Background & Theme Preset', 'website-section-supporter' ) )
		);

		$this->add_control(
			'theme_preset',
			array(
				'label'   => __( 'Visual Theme Preset', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'dark',
				'options' => array(
					'dark'   => __( 'Noir Charcoal / Pure Dark', 'website-section-supporter' ),
					'light'  => __( 'Crisp Ivory / Minimal Light', 'website-section-supporter' ),
					'taupe'  => __( 'Luxury Warm Taupe', 'website-section-supporter' ),
					'image'  => __( 'Architectural Background Image', 'website-section-supporter' ),
					'custom' => __( 'Custom Background (Style Tab)', 'website-section-supporter' ),
				),
			)
		);

		$this->add_control(
			'bg_image',
			array(
				'label'     => __( 'Background Image', 'website-section-supporter' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1800&q=80',
				),
				'condition' => array( 'theme_preset' => 'image' ),
			)
		);

		$this->add_control(
			'bg_image_position',
			array(
				'label'     => __( 'Image Position', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'center center',
				'options'   => array(
					'center center' => __( 'Center Center', 'website-section-supporter' ),
					'center top'    => __( 'Center Top', 'website-section-supporter' ),
					'center bottom' => __( 'Center Bottom', 'website-section-supporter' ),
					'left center'   => __( 'Left Center', 'website-section-supporter' ),
					'right center'  => __( 'Right Center', 'website-section-supporter' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .wss-cta-bg-img' => 'background-position: {{VALUE}};',
				),
				'condition' => array( 'theme_preset' => 'image' ),
			)
		);

		$this->add_control(
			'bg_image_attachment',
			array(
				'label'     => __( 'Image Attachment', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'scroll',
				'options'   => array(
					'scroll' => __( 'Scroll (Normal)', 'website-section-supporter' ),
					'fixed'  => __( 'Fixed (Parallax Effect)', 'website-section-supporter' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .wss-cta-bg-img' => 'background-attachment: {{VALUE}};',
				),
				'condition' => array( 'theme_preset' => 'image' ),
			)
		);

		$this->add_control(
			'bg_image_grayscale',
			array(
				'label'        => __( 'Black & White Filter', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'B&W', 'website-section-supporter' ),
				'label_off'    => __( 'Color', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'selectors'    => array(
					'{{WRAPPER}} .wss-cta-bg-img' => 'filter: grayscale(100%) contrast(1.05);',
				),
				'condition'    => array( 'theme_preset' => 'image' ),
			)
		);

		$this->add_control(
			'bg_overlay_color',
			array(
				'label'     => __( 'Overlay Color & Opacity', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(19, 18, 16, 0.72)',
				'selectors' => array(
					'{{WRAPPER}} .wss-cta-bg-overlay' => 'background-color: {{VALUE}};',
				),
				'condition' => array( 'theme_preset' => 'image' ),
			)
		);

		$this->add_control(
			'card_boxed',
			array(
				'label'        => __( 'Boxed Card Mode', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Boxed Card', 'website-section-supporter' ),
				'label_off'    => __( 'Full Section', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: SECTION & CONTAINER ================= */
		$this->start_controls_section(
			'style_section_container',
			array(
				'label' => __( 'Section & Box Container', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'section_custom_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .wss-cta-section',
			)
		);

		$this->add_responsive_control(
			'section_padding',
			array(
				'label'      => __( 'Section Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'vw', 'em' ),
				'default'    => array(
					'top'      => '120',
					'right'    => '0',
					'bottom'   => '120',
					'left'     => '0',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .wss-cta-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'max_content_width',
			array(
				'label'      => __( 'Content Max Width', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 400, 'max' => 1600, 'step' => 10 ) ),
				'default'    => array( 'size' => 960 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-cta-inner' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// Boxed Card specific styles
		$this->add_control(
			'heading_card_style',
			array(
				'label'     => __( 'Boxed Card Styling', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array( 'card_boxed' => 'yes' ),
			)
		);

		$this->add_control(
			'card_bg_color',
			array(
				'label'     => __( 'Card Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-cta-card' => 'background-color: {{VALUE}} !important;',
				),
				'condition' => array( 'card_boxed' => 'yes' ),
			)
		);

		$this->add_responsive_control(
			'card_padding',
			array(
				'label'      => __( 'Card Inner Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'top'      => '80',
					'right'    => '60',
					'bottom'   => '80',
					'left'     => '60',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .wss-cta-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array( 'card_boxed' => 'yes' ),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'card_border',
				'label'     => __( 'Card Border', 'website-section-supporter' ),
				'selector'  => '{{WRAPPER}} .wss-cta-card',
				'condition' => array( 'card_boxed' => 'yes' ),
			)
		);

		$this->add_control(
			'card_radius',
			array(
				'label'      => __( 'Card Border Radius', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 60 ) ),
				'default'    => array( 'size' => 4 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-cta-card, {{WRAPPER}} .wss-cta-wrap' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'card_shadow',
				'label'    => __( 'Box Shadow', 'website-section-supporter' ),
				'selector' => '{{WRAPPER}} .wss-cta-card, {{WRAPPER}} .wss-cta-wrap',
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: TYPOGRAPHY ================= */
		$this->start_controls_section(
			'style_typography',
			array(
				'label' => __( 'Eyebrow, Heading & Text', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		// Eyebrow
		$this->add_control(
			'heading_style_eyebrow',
			array(
				'label'     => __( 'Eyebrow', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array( 'show_eyebrow' => 'yes' ),
			)
		);

		$this->add_control(
			'eyebrow_color',
			array(
				'label'     => __( 'Eyebrow Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-cta-eyebrow' => 'color: {{VALUE}} !important;',
				),
				'condition' => array( 'show_eyebrow' => 'yes' ),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'eyebrow_typography',
				'selector'  => '{{WRAPPER}} .wss-cta-eyebrow',
				'condition' => array( 'show_eyebrow' => 'yes' ),
			)
		);

		$this->add_responsive_control(
			'eyebrow_spacing',
			array(
				'label'      => __( 'Eyebrow Bottom Spacing', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 40 ) ),
				'default'    => array( 'size' => 16 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-cta-eyebrow' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array( 'show_eyebrow' => 'yes' ),
			)
		);

		// Heading
		$this->add_control(
			'heading_style_title',
			array(
				'label'     => __( 'Heading', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'heading_color',
			array(
				'label'     => __( 'Heading Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-cta-heading, {{WRAPPER}} .wss-cta-heading span' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'heading_typography',
				'selector' => '{{WRAPPER}} .wss-cta-heading',
			)
		);

		$this->add_responsive_control(
			'heading_spacing',
			array(
				'label'      => __( 'Heading Bottom Spacing', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 60 ) ),
				'default'    => array( 'size' => 20 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-cta-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// Description
		$this->add_control(
			'heading_style_desc',
			array(
				'label'     => __( 'Description', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array( 'show_desc' => 'yes' ),
			)
		);

		$this->add_control(
			'desc_color',
			array(
				'label'     => __( 'Description Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-cta-desc' => 'color: {{VALUE}} !important;',
				),
				'condition' => array( 'show_desc' => 'yes' ),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'desc_typography',
				'selector'  => '{{WRAPPER}} .wss-cta-desc',
				'condition' => array( 'show_desc' => 'yes' ),
			)
		);

		$this->add_responsive_control(
			'desc_spacing',
			array(
				'label'      => __( 'Description Bottom Spacing', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 80 ) ),
				'default'    => array( 'size' => 36 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-cta-desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array( 'show_desc' => 'yes' ),
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: BUTTONS ================= */
		$this->start_controls_section(
			'style_buttons',
			array(
				'label' => __( 'Action Buttons Styling', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'buttons_gap',
			array(
				'label'      => __( 'Gap Between Buttons', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 50 ) ),
				'default'    => array( 'size' => 18 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-cta-btns' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// Primary Button Styles
		$this->add_control(
			'heading_style_btn1',
			array(
				'label'     => __( 'Primary Button', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array( 'show_btn1' => 'yes' ),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'btn1_typography',
				'selector'  => '{{WRAPPER}} .wss-cta-btn-primary',
				'condition' => array( 'show_btn1' => 'yes' ),
			)
		);

		$this->add_responsive_control(
			'btn1_padding',
			array(
				'label'      => __( 'Button Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-cta-btn-primary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array( 'show_btn1' => 'yes' ),
			)
		);

		$this->add_control(
			'btn1_radius',
			array(
				'label'      => __( 'Border Radius', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 50 ) ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-cta-btn-primary' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array( 'show_btn1' => 'yes' ),
			)
		);

		$this->start_controls_tabs( 'tabs_btn1_style', array( 'condition' => array( 'show_btn1' => 'yes' ) ) );

		$this->start_controls_tab(
			'tab_btn1_normal',
			array( 'label' => __( 'Normal', 'website-section-supporter' ) )
		);

		$this->add_control(
			'btn1_color',
			array(
				'label'     => __( 'Text / Icon Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-cta-btn-primary' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-cta-btn-primary svg' => 'stroke: {{VALUE}} !important; color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'btn1_bg',
			array(
				'label'     => __( 'Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-cta-btn-primary' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'btn1_border_color',
			array(
				'label'     => __( 'Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-cta-btn-primary' => 'border-color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_btn1_hover',
			array( 'label' => __( 'Hover', 'website-section-supporter' ) )
		);

		$this->add_control(
			'btn1_hover_color',
			array(
				'label'     => __( 'Hover Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-cta-btn-primary:hover' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-cta-btn-primary:hover svg' => 'stroke: {{VALUE}} !important; color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'btn1_hover_bg',
			array(
				'label'     => __( 'Hover Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-cta-btn-primary::before, {{WRAPPER}} .wss-cta-btn-primary:hover::before' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-btn-line.wss-cta-btn-primary::after, {{WRAPPER}} .wss-btn-line.wss-cta-btn-primary:hover::after' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-cta-btn-primary' => '--wss-btn-hover-bg: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'btn1_hover_border_color',
			array(
				'label'     => __( 'Hover Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-cta-btn-primary:hover' => 'border-color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		// Secondary Button Styles
		$this->add_control(
			'heading_style_btn2',
			array(
				'label'     => __( 'Secondary Button / Link', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array( 'show_btn2' => 'yes' ),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'btn2_typography',
				'selector'  => '{{WRAPPER}} .wss-cta-btn-secondary',
				'condition' => array( 'show_btn2' => 'yes' ),
			)
		);

		$this->add_responsive_control(
			'btn2_padding',
			array(
				'label'      => __( 'Button Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-cta-btn-secondary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array( 'show_btn2' => 'yes' ),
			)
		);

		$this->add_control(
			'btn2_radius',
			array(
				'label'      => __( 'Border Radius', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 50 ) ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-cta-btn-secondary' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array( 'show_btn2' => 'yes' ),
			)
		);

		$this->start_controls_tabs( 'tabs_btn2_style', array( 'condition' => array( 'show_btn2' => 'yes' ) ) );

		$this->start_controls_tab(
			'tab_btn2_normal',
			array( 'label' => __( 'Normal', 'website-section-supporter' ) )
		);

		$this->add_control(
			'btn2_color',
			array(
				'label'     => __( 'Text / Icon Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-cta-btn-secondary' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-cta-btn-secondary svg' => 'stroke: {{VALUE}} !important; color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'btn2_bg',
			array(
				'label'     => __( 'Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-cta-btn-secondary' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'btn2_border_color',
			array(
				'label'     => __( 'Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-cta-btn-secondary' => 'border-color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_btn2_hover',
			array( 'label' => __( 'Hover', 'website-section-supporter' ) )
		);

		$this->add_control(
			'btn2_hover_color',
			array(
				'label'     => __( 'Hover Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-cta-btn-secondary:hover' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-cta-btn-secondary:hover svg' => 'stroke: {{VALUE}} !important; color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'btn2_hover_bg',
			array(
				'label'     => __( 'Hover Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-cta-btn-secondary:hover' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'btn2_hover_border_color',
			array(
				'label'     => __( 'Hover Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-cta-btn-secondary:hover' => 'border-color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		/* ================= STYLE: CONTACT BAR ================= */
		$this->start_controls_section(
			'style_contact_bar',
			array(
				'label'     => __( 'Contact Bar Styling', 'website-section-supporter' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array( 'show_contact_bar' => 'yes' ),
			)
		);

		$this->add_control(
			'contact_text_color',
			array(
				'label'     => __( 'Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-cta-badge-item' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'contact_icon_color',
			array(
				'label'     => __( 'Icon Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-cta-badge-item svg' => 'stroke: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'contact_typography',
				'selector' => '{{WRAPPER}} .wss-cta-badge-item',
			)
		);

		$this->add_control(
			'contact_border_color',
			array(
				'label'     => __( 'Top Divider Line Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-cta-contact-bar' => 'border-top-color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_section();
	}

	private function render_icon( $icon_key ) {
		switch ( $icon_key ) {
			case 'arrow':
				return '<svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>';
			case 'external':
				return '<svg viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>';
			case 'phone':
				return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>';
			case 'mail':
				return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>';
			default:
				return '';
		}
	}

	protected function render() {
		$s = $this->get_settings_for_display();

		$theme   = ! empty( $s['theme_preset'] ) ? $s['theme_preset'] : 'dark';
		$layout  = ! empty( $s['layout_type'] ) ? $s['layout_type'] : 'center';
		$is_box  = ! empty( $s['card_boxed'] ) && 'yes' === $s['card_boxed'];
		$tag     = ! empty( $s['heading_html_tag'] ) ? $s['heading_html_tag'] : 'h2';

		// Section Theme Class
		$theme_class = 'wss-cta--' . $theme;
		if ( 'dark' === $theme ) {
			$theme_class .= ' wss-on-dark';
		} elseif ( 'taupe' === $theme ) {
			$theme_class .= ' wss-on-taupe';
		}

		$layout_class = 'wss-cta-layout--' . $layout;
		$box_class    = $is_box ? 'wss-cta-boxed' : 'wss-cta-full';

		// Buttons
		$show_btn1 = ! empty( $s['show_btn1'] ) && 'yes' === $s['show_btn1'] && ! empty( $s['btn1_text'] );
		$show_btn2 = ! empty( $s['show_btn2'] ) && 'yes' === $s['show_btn2'] && ! empty( $s['btn2_text'] );

		$btn1_style = ! empty( $s['btn1_style'] ) ? 'wss-btn-' . $s['btn1_style'] : 'wss-btn-pill';
		$btn2_style = ! empty( $s['btn2_style'] ) ? 'wss-btn-' . $s['btn2_style'] : 'wss-btn-line';

		$btn1_icon_pos = ! empty( $s['btn1_icon_position'] ) ? $s['btn1_icon_position'] : 'after';
		$btn2_icon_pos = ! empty( $s['btn2_icon_position'] ) ? $s['btn2_icon_position'] : 'before';

		$btn1_icon_html = ! empty( $s['btn1_icon'] ) && 'none' !== $s['btn1_icon'] ? $this->render_icon( $s['btn1_icon'] ) : '';
		$btn2_icon_html = ! empty( $s['btn2_icon'] ) && 'none' !== $s['btn2_icon'] ? $this->render_icon( $s['btn2_icon'] ) : '';

		$has_image_bg = ( 'image' === $theme && ! empty( $s['bg_image']['url'] ) );
		$is_bg_fixed  = ( $has_image_bg && ! empty( $s['bg_image_attachment'] ) && 'fixed' === $s['bg_image_attachment'] );
		?>
		<div class="wss-scope">
			<section class="wss-pad wss-cta-section <?php echo esc_attr( $theme_class . ' ' . $layout_class . ' ' . $box_class ); ?>" data-wss-widget="wss-cta">
				
				<?php if ( $has_image_bg ) : ?>
					<div class="wss-cta-bg-img<?php echo $is_bg_fixed ? ' wss-cta-bg-fixed' : ''; ?>" style="background-image: url('<?php echo esc_url( $s['bg_image']['url'] ); ?>');"></div>
					<div class="wss-cta-bg-overlay"></div>
				<?php endif; ?>

				<div class="wss-container">
					<div class="wss-cta-wrap<?php echo $is_box ? ' wss-cta-card' : ''; ?>">
						<div class="wss-cta-inner wss-reveal">
							
							<div class="wss-cta-text-col">
								<?php if ( ! empty( $s['show_eyebrow'] ) && 'yes' === $s['show_eyebrow'] && ! empty( $s['eyebrow'] ) ) : ?>
									<span class="wss-eyebrow wss-cta-eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></span>
								<?php endif; ?>

								<?php if ( ! empty( $s['heading'] ) ) : ?>
									<<?php echo esc_attr( $tag ); ?> class="wss-cta-heading">
										<span class="wss-mask"><span><?php echo nl2br( esc_html( $s['heading'] ) ); ?></span></span>
									</<?php echo esc_attr( $tag ); ?>>
								<?php endif; ?>

								<?php if ( ! empty( $s['show_desc'] ) && 'yes' === $s['show_desc'] && ! empty( $s['description'] ) ) : ?>
									<p class="wss-cta-desc"><?php echo nl2br( esc_html( $s['description'] ) ); ?></p>
								<?php endif; ?>
							</div>

							<?php if ( $show_btn1 || $show_btn2 || ( ! empty( $s['show_contact_bar'] ) && 'yes' === $s['show_contact_bar'] ) ) : ?>
								<div class="wss-cta-actions-col">
									
									<?php if ( $show_btn1 || $show_btn2 ) : ?>
										<div class="wss-cta-btns">
											<?php if ( $show_btn1 ) : ?>
												<a class="<?php echo esc_attr( $btn1_style ); ?> wss-cta-btn-primary" 
													href="<?php echo esc_url( $s['btn1_link']['url'] ?: '#' ); ?>"
													<?php echo ! empty( $s['btn1_link']['is_external'] ) ? ' target="_blank" rel="noopener"' : ''; ?>>
													<?php if ( 'before' === $btn1_icon_pos && ! empty( $btn1_icon_html ) ) echo $btn1_icon_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
													<span><?php echo esc_html( $s['btn1_text'] ); ?></span>
													<?php if ( 'after' === $btn1_icon_pos && ! empty( $btn1_icon_html ) ) echo $btn1_icon_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
												</a>
											<?php endif; ?>

											<?php if ( $show_btn2 ) : ?>
												<a class="<?php echo esc_attr( $btn2_style ); ?> wss-cta-btn-secondary" 
													href="<?php echo esc_url( $s['btn2_link']['url'] ?: '#' ); ?>"
													<?php echo ! empty( $s['btn2_link']['is_external'] ) ? ' target="_blank" rel="noopener"' : ''; ?>>
													<?php if ( 'before' === $btn2_icon_pos && ! empty( $btn2_icon_html ) ) echo $btn2_icon_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
													<span><?php echo esc_html( $s['btn2_text'] ); ?></span>
													<?php if ( 'after' === $btn2_icon_pos && ! empty( $btn2_icon_html ) ) echo $btn2_icon_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
												</a>
											<?php endif; ?>
										</div>
									<?php endif; ?>

									<?php if ( ! empty( $s['show_contact_bar'] ) && 'yes' === $s['show_contact_bar'] ) : ?>
										<div class="wss-cta-contact-bar">
											<?php if ( ! empty( $s['badge_phone'] ) ) : ?>
												<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9\+]/', '', $s['badge_phone'] ) ); ?>" class="wss-cta-badge-item">
													<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
													<span><?php echo esc_html( $s['badge_phone'] ); ?></span>
												</a>
											<?php endif; ?>

											<?php if ( ! empty( $s['badge_email'] ) ) : ?>
												<a href="mailto:<?php echo esc_attr( $s['badge_email'] ); ?>" class="wss-cta-badge-item">
													<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
													<span><?php echo esc_html( $s['badge_email'] ); ?></span>
												</a>
											<?php endif; ?>

											<?php if ( ! empty( $s['badge_location'] ) ) : ?>
												<div class="wss-cta-badge-item">
													<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
													<span><?php echo esc_html( $s['badge_location'] ); ?></span>
												</div>
											<?php endif; ?>
										</div>
									<?php endif; ?>

								</div>
							<?php endif; ?>

						</div>
					</div>
				</div>

			</section>
		</div>
		<?php
	}
}
