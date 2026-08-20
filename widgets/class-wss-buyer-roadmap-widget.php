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
use Elementor\Group_Control_Image_Size;

class WSS_Buyer_Roadmap_Widget extends Widget_Base {

	public function get_name() {
		return 'wss_buyer_roadmap';
	}

	public function get_title() {
		return __( 'WSS — Strategic Buyer Roadmap', 'website-section-supporter' );
	}

	public function get_icon() {
		return 'eicon-flow';
	}

	public function get_categories() {
		return array( 'website-section-supporter' );
	}

	public function get_keywords() {
		return array( 'buyer', 'roadmap', 'process', 'strategy', 'framework', 'phases', 'luxury', 'vpsignature' );
	}

	protected function register_controls() {

		/* ================= CONTENT: SECTION HEADER ================= */
		$this->start_controls_section(
			'section_content_header',
			array(
				'label' => __( 'Section Header', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'       => __( 'Eyebrow Text', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '02 // STRATEGIC BUYER ROADMAP', 'website-section-supporter' ),
				'placeholder' => __( '02 // STRATEGIC BUYER ROADMAP', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Section Heading', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'A Disciplined, Executive Acquisition Framework', 'website-section-supporter' ),
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
				'label'       => __( 'Lead Description', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Purchasing premier real estate involves nuanced variables—micro-market valuation, dock permits, lakefront riparian rights, HOA bylaws, and protective contract structuring. We manage every acquisition as a rigorous advisory project.', 'website-section-supporter' ),
				'placeholder' => __( 'Enter section description', 'website-section-supporter' ),
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

		/* ================= CONTENT: ROADMAP PHASES ================= */
		$this->start_controls_section(
			'section_content_phases',
			array(
				'label' => __( 'Roadmap Phases', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'phase_badge',
			array(
				'label'       => __( 'Phase Badge Text', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Phase 01', 'website-section-supporter' ),
			)
		);

		$repeater->add_control(
			'phase_badge_style',
			array(
				'label'   => __( 'Phase Badge Style', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'pill',
				'options' => array(
					'pill' => __( 'Rounded Pill Badge', 'website-section-supporter' ),
					'text' => __( 'Clean Spaced Text', 'website-section-supporter' ),
				),
			)
		);

		$repeater->add_control(
			'watermark_number',
			array(
				'label'       => __( 'Watermark Number', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '01',
			)
		);

		$repeater->add_control(
			'title',
			array(
				'label'       => __( 'Phase Title', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Consultation & Alignment', 'website-section-supporter' ),
			)
		);

		$repeater->add_control(
			'description',
			array(
				'label'       => __( 'Card Content (TinyMCE / Rich Text & Lists)', 'website-section-supporter' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => "<p>We clarify your lifestyle vision, tax considerations, architectural aesthetics, and timeline while establishing a tailored acquisition criteria profile.</p><hr><div class=\"wss-buyer-roadmap-milestone\"><div class=\"wss-buyer-roadmap-milestone-top\"><svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><polyline points=\"20 6 9 17 4 12\"></polyline></svg><span class=\"wss-buyer-roadmap-milestone-label\">DELIVERABLE</span></div><div class=\"wss-buyer-roadmap-milestone-val\">Acquisition Blueprint</div></div>",
				'rows'        => 6,
			)
		);

		$this->add_control(
			'phases_list',
			array(
				'label'       => __( 'Phases List', 'website-section-supporter' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ phase_badge }}} - {{{ title }}}',
				'default'     => array(
					array(
						'phase_badge'      => __( 'Phase 01', 'website-section-supporter' ),
						'watermark_number' => '01',
						'title'            => __( 'Consultation & Alignment', 'website-section-supporter' ),
						'description'      => "<p>We clarify your lifestyle vision, tax considerations, architectural aesthetics, and timeline while establishing a tailored acquisition criteria profile.</p><hr><div class=\"wss-buyer-roadmap-milestone\"><div class=\"wss-buyer-roadmap-milestone-top\"><svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><polyline points=\"20 6 9 17 4 12\"></polyline></svg><span class=\"wss-buyer-roadmap-milestone-label\">DELIVERABLE</span></div><div class=\"wss-buyer-roadmap-milestone-val\">Acquisition Blueprint</div></div>",
					),
					array(
						'phase_badge'      => __( 'Phase 02', 'website-section-supporter' ),
						'watermark_number' => '02',
						'title'            => __( 'Curated Discovery', 'website-section-supporter' ),
						'description'      => "<p>Beyond public MLS inventory, we unlock discreet off-market opportunities, provide micro-market valuation metrics, and conduct private previews.</p><hr><div class=\"wss-buyer-roadmap-milestone\"><div class=\"wss-buyer-roadmap-milestone-top\"><svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><polyline points=\"20 6 9 17 4 12\"></polyline></svg><span class=\"wss-buyer-roadmap-milestone-label\">DELIVERABLE</span></div><div class=\"wss-buyer-roadmap-milestone-val\">Private Dossier &amp; Tours</div></div>",
					),
					array(
						'phase_badge'      => __( 'Phase 03', 'website-section-supporter' ),
						'watermark_number' => '03',
						'title'            => __( 'Strategic Negotiation', 'website-section-supporter' ),
						'description'      => "<p>Leveraging deep commercial and residential acumen, we craft disciplined offers that protect capital, optimize inspection terms, and secure the asset.</p><hr><div class=\"wss-buyer-roadmap-milestone\"><div class=\"wss-buyer-roadmap-milestone-top\"><svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><polyline points=\"20 6 9 17 4 12\"></polyline></svg><span class=\"wss-buyer-roadmap-milestone-label\">DELIVERABLE</span></div><div class=\"wss-buyer-roadmap-milestone-val\">Protected Contract Structuring</div></div>",
					),
					array(
						'phase_badge'      => __( 'Phase 04', 'website-section-supporter' ),
						'watermark_number' => '04',
						'title'            => __( 'Closing & Handover', 'website-section-supporter' ),
						'description'      => "<p>Complete escrow oversight, title audit, contractor recommendations, and concierge onboarding to ensure a frictionless transition into your new home.</p><hr><div class=\"wss-buyer-roadmap-milestone\"><div class=\"wss-buyer-roadmap-milestone-top\"><svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><polyline points=\"20 6 9 17 4 12\"></polyline></svg><span class=\"wss-buyer-roadmap-milestone-label\">DELIVERABLE</span></div><div class=\"wss-buyer-roadmap-milestone-val\">White-Glove Key Exchange</div></div>",
					),
				),
			)
		);

		$this->end_controls_section();

		/* ================= CONTENT: THEME PRESET & BACKGROUND ================= */
		$this->start_controls_section(
			'section_content_theme_preset',
			array(
				'label' => __( 'Visual Theme & Background', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'theme_preset',
			array(
				'label'   => __( 'Visual Theme Preset', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'light',
				'options' => array(
					'light'  => __( 'Crisp Ivory / Minimal Light', 'website-section-supporter' ),
					'dark'   => __( 'Noir Charcoal / Pure Dark', 'website-section-supporter' ),
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
					'{{WRAPPER}} .wss-buyer-roadmap-bg-img' => 'background-position: {{VALUE}};',
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
					'{{WRAPPER}} .wss-buyer-roadmap-bg-img' => 'background-attachment: {{VALUE}};',
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
					'{{WRAPPER}} .wss-buyer-roadmap-bg-img' => 'filter: grayscale(100%) contrast(1.05);',
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
					'{{WRAPPER}} .wss-buyer-roadmap-bg-overlay' => 'background-color: {{VALUE}};',
				),
				'condition' => array( 'theme_preset' => 'image' ),
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: CONTAINER & LAYOUT ================= */
		$this->start_controls_section(
			'style_container_layout',
			array(
				'label' => __( 'Container & Grid Layout', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'section_custom_bg',
				'types'    => array( 'classic', 'gradient', 'image' ),
				'selector' => '{{WRAPPER}} .wss-buyer-roadmap-section',
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
					'{{WRAPPER}} .wss-buyer-roadmap-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'section_bg_color',
			array(
				'label'     => __( 'Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-section' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'grid_columns',
			array(
				'label'     => __( 'Grid Columns', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '4',
				'options'   => array(
					'1' => '1 Column',
					'2' => '2 Columns',
					'3' => '3 Columns',
					'4' => '4 Columns',
				),
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
				),
			)
		);

		$this->add_responsive_control(
			'grid_gap',
			array(
				'label'      => __( 'Grid Gap', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em' ),
				'default'    => array( 'unit' => 'px', 'size' => 24 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-buyer-roadmap-grid' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: SECTION HEADER ================= */
		$this->start_controls_section(
			'style_section_header',
			array(
				'label' => __( 'Section Header Typography', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		// Section Eyebrow
		$this->add_control(
			'heading_style_sec_eyebrow',
			array(
				'label' => __( 'Eyebrow', 'website-section-supporter' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'eyebrow_color',
			array(
				'label'     => __( 'Eyebrow Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#777777',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-eyebrow' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'eyebrow_typography',
				'selector' => '{{WRAPPER}} .wss-buyer-roadmap-eyebrow',
			)
		);

		$this->add_responsive_control(
			'eyebrow_spacing',
			array(
				'label'      => __( 'Eyebrow Bottom Spacing', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 50 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 18 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-buyer-roadmap-eyebrow' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// Section Main Heading
		$this->add_control(
			'heading_style_sec_heading',
			array(
				'label'     => __( 'Main Heading', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'heading_color',
			array(
				'label'     => __( 'Heading Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0d0d0d',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-heading' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'heading_typography',
				'selector' => '{{WRAPPER}} .wss-buyer-roadmap-heading, {{WRAPPER}} .wss-buyer-roadmap-heading .wss-mask > span',
			)
		);

		$this->add_responsive_control(
			'heading_spacing',
			array(
				'label'      => __( 'Heading Bottom Spacing', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 60 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 18 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-buyer-roadmap-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// Section Description
		$this->add_control(
			'heading_style_sec_desc',
			array(
				'label'     => __( 'Lead Description', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'desc_color',
			array(
				'label'     => __( 'Description Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#555555',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-desc' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'desc_typography',
				'selector' => '{{WRAPPER}} .wss-buyer-roadmap-desc',
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: CARD STYLING ================= */
		$this->start_controls_section(
			'style_card_settings',
			array(
				'label' => __( 'Phase Card Style & Typography', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'card_padding',
			array(
				'label'      => __( 'Card Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'default'    => array(
					'top'      => '46',
					'right'    => '32',
					'bottom'   => '36',
					'left'     => '32',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .wss-buyer-roadmap-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'card_bg_color',
			array(
				'label'     => __( 'Card Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-card' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'card_border_color',
			array(
				'label'     => __( 'Card Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#e2dfda',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-card' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'card_hover_border_color',
			array(
				'label'     => __( 'Hover Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0d0d0d',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-card:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'card_top_accent_color',
			array(
				'label'     => __( 'Top Hover Accent Line Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0d0d0d',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-card::before' => 'background-color: {{VALUE}};',
				),
			)
		);

		// Watermark Number
		$this->add_control(
			'heading_style_watermark',
			array(
				'label'     => __( 'Watermark Number', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'watermark_color',
			array(
				'label'     => __( 'Watermark Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(0, 0, 0, 0.04)',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-watermark' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'watermark_hover_color',
			array(
				'label'     => __( 'Hover Watermark Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(0, 0, 0, 0.08)',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-card:hover .wss-buyer-roadmap-watermark' => 'color: {{VALUE}};',
				),
			)
		);

		// Phase Badge Pill
		$this->add_control(
			'heading_style_phase_pill',
			array(
				'label'     => __( 'Phase Pill Badge', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'phase_pill_color',
			array(
				'label'     => __( 'Pill Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0d0d0d',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-phase-pill' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'phase_pill_bg',
			array(
				'label'     => __( 'Pill Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f8f8f7',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-phase-pill' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'phase_pill_border',
			array(
				'label'     => __( 'Pill Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#e2dfda',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-phase-pill' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'phase_pill_typography',
				'selector' => '{{WRAPPER}} .wss-buyer-roadmap-phase-pill',
			)
		);

		$this->add_responsive_control(
			'phase_pill_spacing',
			array(
				'label'      => __( 'Pill Bottom Spacing', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 40 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 20 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-buyer-roadmap-phase-pill' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// Phase Title & Desc
		$this->add_control(
			'heading_style_phase_text',
			array(
				'label'     => __( 'Phase Title & Description', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'phase_title_color',
			array(
				'label'     => __( 'Phase Title Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0d0d0d',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-card-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'phase_title_typography',
				'selector' => '{{WRAPPER}} .wss-buyer-roadmap-card-title',
			)
		);

		$this->add_responsive_control(
			'phase_title_spacing',
			array(
				'label'      => __( 'Title Bottom Spacing (Heading-to-Text)', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 50 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 18 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-buyer-roadmap-card-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'phase_desc_color',
			array(
				'label'     => __( 'Phase Description Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#555555',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-card-desc' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'phase_desc_typography',
				'selector' => '{{WRAPPER}} .wss-buyer-roadmap-card-desc',
			)
		);

		$this->add_responsive_control(
			'phase_desc_spacing',
			array(
				'label'      => __( 'Description Bottom Spacing', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 60 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 26 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-buyer-roadmap-card-desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// Milestone styling
		$this->add_control(
			'heading_style_milestone',
			array(
				'label'     => __( 'Milestone Deliverable Line', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'milestone_color',
			array(
				'label'     => __( 'Milestone Text & Icon Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0d0d0d',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-milestone' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'milestone_typography',
				'selector' => '{{WRAPPER}} .wss-buyer-roadmap-milestone',
			)
		);

		$this->add_control(
			'milestone_border_color',
			array(
				'label'     => __( 'Milestone Top Divider Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#e2dfda',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-milestone' => 'border-top-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();

		$tag           = ! empty( $s['heading_html_tag'] ) ? $s['heading_html_tag'] : 'h2';
		$phases        = ! empty( $s['phases_list'] ) ? $s['phases_list'] : array();
		$enable_reveal = ! empty( $s['enable_reveal'] ) && 'yes' === $s['enable_reveal'];
		$delays        = array( 'wss-r1', 'wss-r2', 'wss-r3', 'wss-r4' );

		$preset = ! empty( $s['theme_preset'] ) ? $s['theme_preset'] : 'light';
		$preset_class = 'wss-buyer-roadmap--' . $preset;
		if ( 'dark' === $preset || 'image' === $preset ) {
			$preset_class .= ' wss-on-dark';
		} elseif ( 'taupe' === $preset ) {
			$preset_class .= ' wss-buyer-roadmap--taupe';
		}

		$has_bg_image = ( 'image' === $preset && ! empty( $s['bg_image']['url'] ) );
		$is_fixed     = ( ! empty( $s['bg_image_attachment'] ) && 'fixed' === $s['bg_image_attachment'] );
		?>
		<div class="wss-scope">
			<section class="wss-buyer-roadmap-section wss-pad <?php echo esc_attr( $preset_class ); ?>" data-wss-widget="wss-buyer-roadmap">
				
				<?php if ( $has_bg_image ) : ?>
					<div class="wss-buyer-roadmap-bg-img <?php echo $is_fixed ? 'wss-bg-fixed' : ''; ?>" style="background-image: url('<?php echo esc_url( $s['bg_image']['url'] ); ?>');"></div>
					<div class="wss-buyer-roadmap-bg-overlay"></div>
				<?php endif; ?>

				<div class="wss-container" style="position: relative; z-index: 3;">
					
					<!-- Header -->
					<div class="wss-buyer-roadmap-head">
						<?php if ( ! empty( $s['eyebrow'] ) ) : ?>
							<span class="wss-buyer-roadmap-eyebrow <?php echo $enable_reveal ? 'wss-reveal' : ''; ?>"><?php echo esc_html( $s['eyebrow'] ); ?></span>
						<?php endif; ?>

						<?php if ( ! empty( $s['heading'] ) ) : ?>
							<<?php echo esc_attr( $tag ); ?> class="wss-buyer-roadmap-heading <?php echo $enable_reveal ? 'wss-reveal wss-r1' : ''; ?>">
								<span class="wss-mask"><span><?php echo nl2br( esc_html( $s['heading'] ) ); ?></span></span>
							</<?php echo esc_attr( $tag ); ?>>
						<?php endif; ?>

						<?php if ( ! empty( $s['description'] ) ) : ?>
							<p class="wss-buyer-roadmap-desc <?php echo $enable_reveal ? 'wss-reveal wss-r2' : ''; ?>">
								<?php echo nl2br( esc_html( $s['description'] ) ); ?>
							</p>
						<?php endif; ?>
					</div>

					<!-- Phases Grid -->
					<?php if ( ! empty( $phases ) ) : ?>
						<div class="wss-buyer-roadmap-grid">
							<?php foreach ( $phases as $idx => $item ) : 
								$stagger = $enable_reveal ? 'wss-reveal ' . $delays[ $idx % 4 ] : '';
							?>
								<div class="wss-buyer-roadmap-card <?php echo esc_attr( $stagger ); ?> elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
									
									<?php if ( ! empty( $item['watermark_number'] ) ) : ?>
										<span class="wss-buyer-roadmap-watermark"><?php echo esc_html( $item['watermark_number'] ); ?></span>
									<?php endif; ?>

									<div class="wss-buyer-roadmap-card-body">
										<?php if ( ! empty( $item['phase_badge'] ) ) : 
											$badge_style = ! empty( $item['phase_badge_style'] ) ? $item['phase_badge_style'] : 'pill';
											$badge_class = ( 'text' === $badge_style ) ? 'wss-buyer-roadmap-phase-text' : 'wss-buyer-roadmap-phase-pill';
										?>
											<div class="<?php echo esc_attr( $badge_class ); ?>"><?php echo esc_html( $item['phase_badge'] ); ?></div>
										<?php endif; ?>

										<?php if ( ! empty( $item['title'] ) ) : ?>
											<h3 class="wss-buyer-roadmap-card-title"><?php echo esc_html( $item['title'] ); ?></h3>
										<?php endif; ?>

										<?php if ( ! empty( $item['description'] ) ) : ?>
											<div class="wss-buyer-roadmap-card-desc">
												<?php echo wp_kses_post( $item['description'] ); ?>
												<?php 
												// Backward compatibility: If previously saved Elementor page data had milestone_text and description didn't have it embedded
												if ( ! empty( $item['milestone_text'] ) && strpos( $item['description'], 'wss-buyer-roadmap-milestone' ) === false && strpos( $item['description'], '<ul' ) === false ) : 
													$m_lbl = ! empty( $item['milestone_label'] ) ? $item['milestone_label'] : __( 'DELIVERABLE', 'website-section-supporter' );
													$m_val = $item['milestone_text'];
												?>
													<hr>
													<div class="wss-buyer-roadmap-milestone">
														<div class="wss-buyer-roadmap-milestone-top">
															<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
															<span class="wss-buyer-roadmap-milestone-label"><?php echo esc_html( $m_lbl ); ?></span>
														</div>
														<div class="wss-buyer-roadmap-milestone-val"><?php echo esc_html( $m_val ); ?></div>
													</div>
												<?php endif; ?>
											</div>
										<?php endif; ?>
									</div>

								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

				</div>
			</section>
		</div>
		<?php
	}
}
