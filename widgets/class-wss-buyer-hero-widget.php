<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;

class WSS_Buyer_Hero_Widget extends Widget_Base {

	public function get_name() {
		return 'wss_buyer_hero';
	}

	public function get_title() {
		return __( 'WSS — Buyer Overview Hero', 'website-section-supporter' );
	}

	public function get_icon() {
		return 'eicon-banner';
	}

	public function get_categories() {
		return array( 'website-section-supporter' );
	}

	public function get_keywords() {
		return array( 'buyer', 'overview', 'hero', 'real estate', 'luxury', 'acquisition', 'vpsignature' );
	}

	protected function register_controls() {

		/* ================= CONTENT: TEXT & HEADINGS ================= */
		$this->start_controls_section(
			'section_content_text',
			array(
				'label' => __( 'Content & Headings', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'       => __( 'Eyebrow Text', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '01 // BUYING OVERVIEW', 'website-section-supporter' ),
				'placeholder' => __( '01 // BUYING OVERVIEW', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Main Heading', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Boutique Representation. Strategic Acquisition.', 'website-section-supporter' ),
				'placeholder' => __( 'Enter main heading', 'website-section-supporter' ),
				'rows'        => 2,
			)
		);

		$this->add_control(
			'heading_html_tag',
			array(
				'label'   => __( 'Heading HTML Tag', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h1',
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
				'default'     => __( 'Acquiring high-value real estate in Central Florida demands deeper market intelligence than public listing portals can offer. VP Signature Group delivers strategic advocacy, discreet off-market property discovery, and disciplined representation tailored to your lifestyle and wealth preservation goals.', 'website-section-supporter' ),
				'placeholder' => __( 'Enter lead description paragraph', 'website-section-supporter' ),
				'rows'        => 4,
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

		/* ================= CONTENT: ACTION BUTTONS ================= */
		$this->start_controls_section(
			'section_content_buttons',
			array(
				'label' => __( 'Action Buttons', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		// Primary Button
		$this->add_control(
			'show_btn1',
			array(
				'label'        => __( 'Show Primary Button', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'btn1_text',
			array(
				'label'       => __( 'Primary Button Text', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Search Properties', 'website-section-supporter' ),
				'condition'   => array( 'show_btn1' => 'yes' ),
			)
		);

		$this->add_control(
			'btn1_link',
			array(
				'label'       => __( 'Primary Button Link', 'website-section-supporter' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'website-section-supporter' ),
				'default'     => array( 'url' => '#properties' ),
				'condition'   => array( 'show_btn1' => 'yes' ),
			)
		);

		$this->add_control(
			'btn1_style',
			array(
				'label'     => __( 'Primary Button Preset', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'pill',
				'options'   => array(
					'pill'  => __( 'Luxury Pill (Curtain Sweep)', 'website-section-supporter' ),
					'solid' => __( 'Solid Rectangle', 'website-section-supporter' ),
					'line'  => __( 'Underline Link', 'website-section-supporter' ),
				),
				'condition' => array( 'show_btn1' => 'yes' ),
			)
		);

		$this->add_control(
			'btn1_icon',
			array(
				'label'     => __( 'Primary Button Icon', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'arrow',
				'options'   => array(
					'none'     => __( 'None', 'website-section-supporter' ),
					'arrow'    => __( 'Arrow Right', 'website-section-supporter' ),
					'external' => __( 'External Link', 'website-section-supporter' ),
				),
				'condition' => array( 'show_btn1' => 'yes' ),
			)
		);

		// Secondary Button
		$this->add_control(
			'show_btn2',
			array(
				'label'        => __( 'Show Secondary Button', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
				'separator'    => 'before',
			)
		);

		$this->add_control(
			'btn2_text',
			array(
				'label'       => __( 'Secondary Button Text', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Download Buyer\'s Guide', 'website-section-supporter' ),
				'condition'   => array( 'show_btn2' => 'yes' ),
			)
		);

		$this->add_control(
			'btn2_link',
			array(
				'label'       => __( 'Secondary Button Link', 'website-section-supporter' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'website-section-supporter' ),
				'default'     => array( 'url' => '#guide' ),
				'condition'   => array( 'show_btn2' => 'yes' ),
			)
		);

		$this->add_control(
			'btn2_style',
			array(
				'label'     => __( 'Secondary Button Preset', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'line',
				'options'   => array(
					'line'  => __( 'Underline Link', 'website-section-supporter' ),
					'pill'  => __( 'Luxury Pill (Curtain Sweep)', 'website-section-supporter' ),
					'solid' => __( 'Solid Rectangle', 'website-section-supporter' ),
				),
				'condition' => array( 'show_btn2' => 'yes' ),
			)
		);

		$this->add_control(
			'btn2_icon',
			array(
				'label'     => __( 'Secondary Button Icon', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'download',
				'options'   => array(
					'none'     => __( 'None', 'website-section-supporter' ),
					'arrow'    => __( 'Arrow Right', 'website-section-supporter' ),
					'download' => __( 'Download Arrow', 'website-section-supporter' ),
				),
				'condition' => array( 'show_btn2' => 'yes' ),
			)
		);

		$this->end_controls_section();

		/* ================= CONTENT: HERO IMAGE & BADGE ================= */
		$this->start_controls_section(
			'section_content_media',
			array(
				'label' => __( 'Architectural Media & Badge', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'hero_image',
			array(
				'label'   => __( 'Hero Image (Full Color)', 'website-section-supporter' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=1200&q=85',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'hero_image_size',
				'default'   => 'full',
				'separator' => 'none',
			)
		);

		$this->add_control(
			'show_badge',
			array(
				'label'        => __( 'Show Floating Location Badge', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
				'separator'    => 'before',
			)
		);

		$this->add_control(
			'badge_title',
			array(
				'label'       => __( 'Badge Title', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Central Florida Focus', 'website-section-supporter' ),
				'condition'   => array( 'show_badge' => 'yes' ),
			)
		);

		$this->add_control(
			'badge_subtitle',
			array(
				'label'       => __( 'Badge Subtitle', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Winter Park • Windermere • Lake Nona • Dr. Phillips', 'website-section-supporter' ),
				'condition'   => array( 'show_badge' => 'yes' ),
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: SECTION CONTAINER ================= */
		$this->start_controls_section(
			'style_section_container',
			array(
				'label' => __( 'Section Container', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'section_padding',
			array(
				'label'      => __( 'Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'vh' ),
				'default'    => array(
					'top'      => '90',
					'bottom'   => '90',
					'left'     => '0',
					'right'    => '0',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .wss-buyer-hero-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'section_bg_color',
			array(
				'label'     => __( 'Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-hero-section' => 'background-color: {{VALUE}};',
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

		// Eyebrow
		$this->add_control(
			'heading_style_eyebrow',
			array(
				'label' => __( 'Eyebrow', 'website-section-supporter' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'eyebrow_color',
			array(
				'label'     => __( 'Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#777777',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-hero-eyebrow' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'eyebrow_typography',
				'selector' => '{{WRAPPER}} .wss-buyer-hero-eyebrow',
			)
		);

		$this->add_responsive_control(
			'eyebrow_spacing',
			array(
				'label'      => __( 'Eyebrow Bottom Spacing', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 50 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 22 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-buyer-hero-eyebrow' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// Heading
		$this->add_control(
			'heading_style_heading',
			array(
				'label'     => __( 'Main Heading', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'heading_color',
			array(
				'label'     => __( 'Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0d0d0d',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-hero-heading' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'heading_typography',
				'selector' => '{{WRAPPER}} .wss-buyer-hero-heading',
			)
		);

		$this->add_responsive_control(
			'heading_spacing',
			array(
				'label'      => __( 'Heading Bottom Spacing', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 60 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 24 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-buyer-hero-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
			)
		);

		$this->add_control(
			'desc_color',
			array(
				'label'     => __( 'Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#555555',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-hero-desc' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'desc_typography',
				'selector' => '{{WRAPPER}} .wss-buyer-hero-desc',
			)
		);

		$this->add_responsive_control(
			'desc_spacing',
			array(
				'label'      => __( 'Description Bottom Spacing', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 60 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 36 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-buyer-hero-desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// Location Badge Typography
		$this->add_control(
			'heading_style_badge_typo',
			array(
				'label'     => __( 'Floating Location Badge', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'badge_title_color',
			array(
				'label'     => __( 'Badge Title Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-hero-badge-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'badge_title_typography',
				'selector' => '{{WRAPPER}} .wss-buyer-hero-badge-title',
			)
		);

		$this->add_control(
			'badge_sub_color',
			array(
				'label'     => __( 'Badge Subtitle Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.7)',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-hero-badge-sub' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'badge_sub_typography',
				'selector' => '{{WRAPPER}} .wss-buyer-hero-badge-sub',
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: BUTTONS ================= */
		$this->start_controls_section(
			'style_buttons',
			array(
				'label' => __( 'Button Styling', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		// Primary Button Styles
		$this->add_control(
			'heading_style_btn1',
			array(
				'label' => __( 'Primary Button', 'website-section-supporter' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->start_controls_tabs( 'tabs_btn1_style' );

		$this->start_controls_tab(
			'tab_btn1_normal',
			array( 'label' => __( 'Normal', 'website-section-supporter' ) )
		);

		$this->add_control(
			'btn1_text_color',
			array(
				'label'     => __( 'Text / Icon Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0d0d0d',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-hero-btn-primary' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-buyer-hero-btn-primary svg' => 'stroke: {{VALUE}} !important; color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'btn1_bg_color',
			array(
				'label'     => __( 'Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'transparent',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-hero-btn-primary' => 'background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'btn1_border_color',
			array(
				'label'     => __( 'Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0d0d0d',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-hero-btn-primary' => 'border-color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_btn1_hover',
			array( 'label' => __( 'Hover', 'website-section-supporter' ) )
		);

		$this->add_control(
			'btn1_hover_text_color',
			array(
				'label'     => __( 'Hover Text / Icon Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-hero-btn-primary:hover' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-buyer-hero-btn-primary:hover svg' => 'stroke: {{VALUE}} !important; color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'btn1_hover_bg_color',
			array(
				'label'     => __( 'Hover Background (Curtain Sweep)', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0d0d0d',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-hero-btn-primary::before, {{WRAPPER}} .wss-buyer-hero-btn-primary:hover::before' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-buyer-hero-btn-primary' => '--wss-btn-hover-bg: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'btn1_hover_border_color',
			array(
				'label'     => __( 'Hover Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0d0d0d',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-hero-btn-primary:hover' => 'border-color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		// Secondary Button Styles
		$this->add_control(
			'heading_style_btn2',
			array(
				'label'     => __( 'Secondary Button', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs( 'tabs_btn2_style' );

		$this->start_controls_tab(
			'tab_btn2_normal',
			array( 'label' => __( 'Normal', 'website-section-supporter' ) )
		);

		$this->add_control(
			'btn2_text_color',
			array(
				'label'     => __( 'Text / Icon Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0d0d0d',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-hero-btn-secondary' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-buyer-hero-btn-secondary svg' => 'stroke: {{VALUE}} !important; color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_btn2_hover',
			array( 'label' => __( 'Hover', 'website-section-supporter' ) )
		);

		$this->add_control(
			'btn2_hover_text_color',
			array(
				'label'     => __( 'Hover Text / Icon Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#777777',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-hero-btn-secondary:hover' => 'color: {{VALUE}} !important; opacity: 0.7;',
					'{{WRAPPER}} .wss-buyer-hero-btn-secondary:hover svg' => 'stroke: {{VALUE}} !important; color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		/* ================= STYLE: IMAGE & BADGE ================= */
		$this->start_controls_section(
			'style_image_badge',
			array(
				'label' => __( 'Media Frame & Badge Style', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'image_height',
			array(
				'label'      => __( 'Image Height', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vh' ),
				'range'      => array(
					'px' => array( 'min' => 300, 'max' => 800 ),
					'vh' => array( 'min' => 30, 'max' => 100 ),
				),
				'default'    => array( 'unit' => 'px', 'size' => 560 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-buyer-hero-img' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'badge_bg_color',
			array(
				'label'     => __( 'Badge Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0d0d0d',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-hero-badge' => 'background-color: {{VALUE}};',
				),
				'condition' => array( 'show_badge' => 'yes' ),
			)
		);

		$this->add_control(
			'badge_title_color',
			array(
				'label'     => __( 'Badge Title Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-hero-badge-title' => 'color: {{VALUE}};',
				),
				'condition' => array( 'show_badge' => 'yes' ),
			)
		);

		$this->add_control(
			'badge_sub_color',
			array(
				'label'     => __( 'Badge Subtitle Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#999999',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-hero-badge-sub' => 'color: {{VALUE}};',
				),
				'condition' => array( 'show_badge' => 'yes' ),
			)
		);

		$this->end_controls_section();
	}

	private function render_icon( $icon_key ) {
		switch ( $icon_key ) {
			case 'arrow':
				return '<svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>';
			case 'download':
				return '<svg viewBox="0 0 24 24"><path d="M12 5v14M5 12l7 7 7-7"/></svg>';
			case 'external':
				return '<svg viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>';
			default:
				return '';
		}
	}

	protected function render() {
		$s = $this->get_settings_for_display();

		$tag = ! empty( $s['heading_html_tag'] ) ? $s['heading_html_tag'] : 'h1';

		$show_btn1 = ! empty( $s['show_btn1'] ) && 'yes' === $s['show_btn1'] && ! empty( $s['btn1_text'] );
		$show_btn2 = ! empty( $s['show_btn2'] ) && 'yes' === $s['show_btn2'] && ! empty( $s['btn2_text'] );

		$btn1_style = ! empty( $s['btn1_style'] ) ? 'wss-btn-' . $s['btn1_style'] : 'wss-btn-pill';
		$btn2_style = ! empty( $s['btn2_style'] ) ? 'wss-btn-' . $s['btn2_style'] : 'wss-btn-line';

		$btn1_icon_html = ! empty( $s['btn1_icon'] ) && 'none' !== $s['btn1_icon'] ? $this->render_icon( $s['btn1_icon'] ) : '';
		$btn2_icon_html = ! empty( $s['btn2_icon'] ) && 'none' !== $s['btn2_icon'] ? $this->render_icon( $s['btn2_icon'] ) : '';

		$image_url = ! empty( $s['hero_image']['url'] ) ? $s['hero_image']['url'] : '';
		$enable_reveal = ! empty( $s['enable_reveal'] ) && 'yes' === $s['enable_reveal'];
		?>
		<div class="wss-scope">
			<section class="wss-buyer-hero-section wss-pad" data-wss-widget="wss-buyer-hero">
				<div class="wss-container">
					<div class="wss-buyer-hero-grid">
						
						<!-- Left: Text & Actions -->
						<div class="wss-buyer-hero-content <?php echo $enable_reveal ? 'wss-reveal' : ''; ?>">
							<?php if ( ! empty( $s['eyebrow'] ) ) : ?>
								<span class="wss-buyer-hero-eyebrow <?php echo $enable_reveal ? 'wss-reveal' : ''; ?>"><?php echo esc_html( $s['eyebrow'] ); ?></span>
							<?php endif; ?>

							<?php if ( ! empty( $s['heading'] ) ) : ?>
								<<?php echo esc_attr( $tag ); ?> class="wss-buyer-hero-heading <?php echo $enable_reveal ? 'wss-reveal wss-r1' : ''; ?>">
									<span class="wss-mask"><span><?php echo nl2br( esc_html( $s['heading'] ) ); ?></span></span>
								</<?php echo esc_attr( $tag ); ?>>
							<?php endif; ?>

							<?php if ( ! empty( $s['description'] ) ) : ?>
								<p class="wss-buyer-hero-desc <?php echo $enable_reveal ? 'wss-reveal wss-r2' : ''; ?>">
									<?php echo nl2br( esc_html( $s['description'] ) ); ?>
								</p>
							<?php endif; ?>

							<?php if ( $show_btn1 || $show_btn2 ) : ?>
								<div class="wss-buyer-hero-actions <?php echo $enable_reveal ? 'wss-reveal wss-r3' : ''; ?>">
									<?php if ( $show_btn1 ) : ?>
										<a class="<?php echo esc_attr( $btn1_style ); ?> wss-buyer-hero-btn-primary" 
											href="<?php echo esc_url( $s['btn1_link']['url'] ?: '#' ); ?>"
											<?php echo ! empty( $s['btn1_link']['is_external'] ) ? ' target="_blank" rel="noopener"' : ''; ?>>
											<span><?php echo esc_html( $s['btn1_text'] ); ?></span>
											<?php if ( ! empty( $btn1_icon_html ) ) echo $btn1_icon_html; ?>
										</a>
									<?php endif; ?>

									<?php if ( $show_btn2 ) : ?>
										<a class="<?php echo esc_attr( $btn2_style ); ?> wss-buyer-hero-btn-secondary" 
											href="<?php echo esc_url( $s['btn2_link']['url'] ?: '#' ); ?>"
											<?php echo ! empty( $s['btn2_link']['is_external'] ) ? ' target="_blank" rel="noopener"' : ''; ?>>
											<span><?php echo esc_html( $s['btn2_text'] ); ?></span>
											<?php if ( ! empty( $btn2_icon_html ) ) echo $btn2_icon_html; ?>
										</a>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</div>

						<!-- Right: Architectural Media Frame -->
						<?php if ( ! empty( $image_url ) ) : ?>
							<div class="wss-buyer-hero-media-wrap <?php echo $enable_reveal ? 'wss-reveal wss-r2' : ''; ?>">
								<div class="wss-buyer-hero-media-frame <?php echo $enable_reveal ? 'wss-img-reveal' : ''; ?>">
									<img src="<?php echo esc_url( $image_url ); ?>" 
										alt="<?php echo esc_attr( $s['heading'] ); ?>" 
										class="wss-buyer-hero-img">
								</div>

								<?php if ( ! empty( $s['show_badge'] ) && 'yes' === $s['show_badge'] ) : ?>
									<div class="wss-buyer-hero-badge <?php echo $enable_reveal ? 'wss-reveal wss-r3' : ''; ?>">
										<?php if ( ! empty( $s['badge_title'] ) ) : ?>
											<span class="wss-buyer-hero-badge-title"><?php echo esc_html( $s['badge_title'] ); ?></span>
										<?php endif; ?>
										<?php if ( ! empty( $s['badge_subtitle'] ) ) : ?>
											<p class="wss-buyer-hero-badge-sub"><?php echo esc_html( $s['badge_subtitle'] ); ?></p>
										<?php endif; ?>
									</div>
								<?php endif; ?>
							</div>
						<?php endif; ?>

					</div>
				</div>
			</section>
		</div>
		<?php
	}
}
