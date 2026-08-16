<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;

class WSS_Hero_Widget extends Widget_Base {

	public function get_name() { return 'wss_hero'; }
	public function get_title() { return __( 'WSS — Hero Banner', 'website-section-supporter' ); }
	public function get_icon() { return 'eicon-slider-full-screen'; }
	public function get_categories() { return array( 'website-section-supporter' ); }
	public function get_keywords() { return array( 'hero', 'banner', 'header', 'search', 'idx' ); }

	protected function register_controls() {

		/* ================= BACKGROUND ================= */
		$this->start_controls_section(
			'section_background',
			array( 'label' => __( 'Hero Background (Image / Gradient / Video)', 'website-section-supporter' ) )
		);

		$this->add_control(
			'bg_type',
			array(
				'label'   => __( 'Background Type', 'website-section-supporter' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'image'    => array(
						'title' => __( 'Image', 'website-section-supporter' ),
						'icon'  => 'eicon-image-bold',
					),
					'gradient' => array(
						'title' => __( 'Gradient', 'website-section-supporter' ),
						'icon'  => 'eicon-gradient',
					),
					'video'    => array(
						'title' => __( 'Video', 'website-section-supporter' ),
						'icon'  => 'eicon-video-camera',
					),
				),
				'default' => 'image',
			)
		);

		/* ----- IMAGE CONTROLS ----- */
		$this->add_control(
			'bg_image',
			array(
				'label'     => __( 'Background Image', 'website-section-supporter' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array( 'url' => 'https://picsum.photos/seed/noircoast/1800/1200' ),
				'condition' => array( 'bg_type' => 'image' ),
			)
		);

		/* ----- GRADIENT CONTROLS ----- */
		$this->add_control(
			'grad_color_1',
			array(
				'label'     => __( 'First Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#131210',
				'condition' => array( 'bg_type' => 'gradient' ),
			)
		);
		$this->add_control(
			'grad_location_1',
			array(
				'label'     => __( 'Location', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( '%' => array( 'min' => 0, 'max' => 100 ) ),
				'default'   => array( 'size' => 0, 'unit' => '%' ),
				'condition' => array( 'bg_type' => 'gradient' ),
			)
		);
		$this->add_control(
			'grad_color_2',
			array(
				'label'     => __( 'Second Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3a362e',
				'condition' => array( 'bg_type' => 'gradient' ),
			)
		);
		$this->add_control(
			'grad_location_2',
			array(
				'label'     => __( 'Location', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( '%' => array( 'min' => 0, 'max' => 100 ) ),
				'default'   => array( 'size' => 100, 'unit' => '%' ),
				'condition' => array( 'bg_type' => 'gradient' ),
			)
		);
		$this->add_control(
			'grad_angle',
			array(
				'label'     => __( 'Angle (Deg)', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'deg' => array( 'min' => 0, 'max' => 360 ) ),
				'default'   => array( 'size' => 180, 'unit' => 'deg' ),
				'condition' => array( 'bg_type' => 'gradient' ),
				'selectors' => array(
					'{{WRAPPER}} .wss-hero-bg' => 'background: linear-gradient({{SIZE}}deg, {{grad_color_1.VALUE}} {{grad_location_1.SIZE}}%, {{grad_color_2.VALUE}} {{grad_location_2.SIZE}}%);',
				),
			)
		);

		/* ----- VIDEO CONTROLS ----- */
		$this->add_control(
			'video_link_type',
			array(
				'label'     => __( 'Video Source', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'self_hosted' => __( 'Self Hosted / MP4 URL', 'website-section-supporter' ),
					'youtube'     => __( 'YouTube Video', 'website-section-supporter' ),
				),
				'default'   => 'self_hosted',
				'condition' => array( 'bg_type' => 'video' ),
			)
		);
		$this->add_control(
			'video_url',
			array(
				'label'       => __( 'Video File / YouTube Link', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'https://assets.mixkit.co/videos/preview/mixkit-aerial-view-of-a-coastal-city-40767-large.mp4',
				'placeholder' => __( 'Paste MP4 link or YouTube URL', 'website-section-supporter' ),
				'condition'   => array( 'bg_type' => 'video' ),
			)
		);
		$this->add_control(
			'video_fallback',
			array(
				'label'       => __( 'Poster / Fallback Image', 'website-section-supporter' ),
				'type'        => Controls_Manager::MEDIA,
				'default'     => array( 'url' => 'https://picsum.photos/seed/noircoast/1800/1200' ),
				'description' => __( 'Shown on mobile devices or while video loads', 'website-section-supporter' ),
				'condition'   => array( 'bg_type' => 'video' ),
			)
		);

		$this->end_controls_section();

		/* ================= CONTENT ================= */
		$this->start_controls_section(
			'section_content',
			array( 'label' => __( 'Content', 'website-section-supporter' ) )
		);
		$this->add_control( 'mark_text', array( 'label' => __( 'Small Top Mark', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'NOIR ESTATES', 'website-section-supporter' ) ) );
		$this->add_control( 'eyebrow', array( 'label' => __( 'Eyebrow', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'Over $2 Billion in Career Sales', 'website-section-supporter' ) ) );
		$this->add_control( 'heading_line1', array( 'label' => __( 'Heading — Line 1', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'Global Luxury', 'website-section-supporter' ) ) );
		$this->add_control( 'heading_line2', array( 'label' => __( 'Heading — Line 2 (smaller)', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'Real Estate', 'website-section-supporter' ) ) );
		$this->add_control( 'scroll_text', array( 'label' => __( 'Scroll Cue Text', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'Scroll', 'website-section-supporter' ) ) );
		$this->add_control( 'show_scroll_cue', array( 'label' => __( 'Show Scroll Cue', 'website-section-supporter' ), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes' ) );
		$this->end_controls_section();

		/* ================= PROPERTY SEARCH (OMNI / IDX) ================= */
		$this->start_controls_section(
			'section_search',
			array( 'label' => __( 'Property Search (Omni / IDX)', 'website-section-supporter' ) )
		);
		$this->add_control(
			'enable_search',
			array(
				'label'        => __( 'Enable Property Search', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'search_mode',
			array(
				'label'     => __( 'Search Integration Type', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'demo'      => __( 'Built-in Super Luxury Omni Search Bar', 'website-section-supporter' ),
					'shortcode' => __( 'Custom Shortcode (IDX / MLS / Plugin)', 'website-section-supporter' ),
				),
				'default'   => 'demo',
				'condition' => array( 'enable_search' => 'yes' ),
			)
		);
		$this->add_control(
			'idx_shortcode',
			array(
				'label'       => __( 'IDX / MLS Search Shortcode', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => '[idx_search_widget] or [optima_express_quick_search]',
				'description' => __( 'Paste your IDX or MLS plugin shortcode here.', 'website-section-supporter' ),
				'condition'   => array( 'enable_search' => 'yes', 'search_mode' => 'shortcode' ),
			)
		);

		/* ----- OMNI SEARCH SETTINGS ----- */
		$this->add_control(
			'show_status_tabs',
			array(
				'label'     => __( 'Show Status Tabs (Buy / Rent / Sold)', 'website-section-supporter' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => array( 'enable_search' => 'yes', 'search_mode' => 'demo' ),
			)
		);
		$this->add_control(
			'status_tab_1',
			array(
				'label'     => __( 'Tab 1 Text', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'BUY',
				'condition' => array( 'enable_search' => 'yes', 'search_mode' => 'demo', 'show_status_tabs' => 'yes' ),
			)
		);
		$this->add_control(
			'status_tab_2',
			array(
				'label'     => __( 'Tab 2 Text', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'RENT',
				'condition' => array( 'enable_search' => 'yes', 'search_mode' => 'demo', 'show_status_tabs' => 'yes' ),
			)
		);
		$this->add_control(
			'status_tab_3',
			array(
				'label'     => __( 'Tab 3 Text', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'SOLD',
				'condition' => array( 'enable_search' => 'yes', 'search_mode' => 'demo', 'show_status_tabs' => 'yes' ),
			)
		);
		$this->add_control(
			'search_placeholder',
			array(
				'label'     => __( 'Location Placeholder', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'City, Neighborhood, Address, MLS #',
				'condition' => array( 'enable_search' => 'yes', 'search_mode' => 'demo' ),
			)
		);
		$this->add_control(
			'show_type_field',
			array(
				'label'     => __( 'Show Property Type Filter', 'website-section-supporter' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => array( 'enable_search' => 'yes', 'search_mode' => 'demo' ),
			)
		);
		$this->add_control(
			'type_options',
			array(
				'label'       => __( 'Property Types (One per line)', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => "All Types\nSingle Family Residence\nLuxury Villa\nPenthouse & Skyline\nWaterfront Estate\nModern Architectural",
				'condition'   => array( 'enable_search' => 'yes', 'search_mode' => 'demo', 'show_type_field' => 'yes' ),
			)
		);
		$this->add_control(
			'show_price_field',
			array(
				'label'     => __( 'Show Price Range Filter', 'website-section-supporter' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => array( 'enable_search' => 'yes', 'search_mode' => 'demo' ),
			)
		);
		$this->add_control(
			'price_options',
			array(
				'label'       => __( 'Price Ranges (One per line)', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => "Any Price\n$1,000,000 - $3,000,000\n$3,000,000 - $5,000,000\n$5,000,000 - $10,000,000\n$10,000,000 - $25,000,000\n$25,000,000+",
				'condition'   => array( 'enable_search' => 'yes', 'search_mode' => 'demo', 'show_price_field' => 'yes' ),
			)
		);
		$this->add_control(
			'show_beds_field',
			array(
				'label'     => __( 'Show Bedrooms Filter', 'website-section-supporter' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => array( 'enable_search' => 'yes', 'search_mode' => 'demo' ),
			)
		);
		$this->add_control(
			'beds_options',
			array(
				'label'       => __( 'Beds Options (One per line)', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => "Any Beds\n1+ Beds\n2+ Beds\n3+ Beds\n4+ Beds\n5+ Beds",
				'condition'   => array( 'enable_search' => 'yes', 'search_mode' => 'demo', 'show_beds_field' => 'yes' ),
			)
		);
		$this->add_control(
			'btn_text',
			array(
				'label'     => __( 'Button Text', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'SEARCH PROPERTIES',
				'condition' => array( 'enable_search' => 'yes', 'search_mode' => 'demo' ),
			)
		);
		$this->add_control(
			'search_target_url',
			array(
				'label'     => __( 'Search Form Action URL / Page Link', 'website-section-supporter' ),
				'type'      => Controls_Manager::URL,
				'default'   => array( 'url' => '#sales' ),
				'condition' => array( 'enable_search' => 'yes', 'search_mode' => 'demo' ),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: SECTION & LAYOUT ================= */
		$this->start_controls_section(
			'style_section',
			array( 'label' => __( 'Section & Layout', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_responsive_control(
			'min_height',
			array(
				'label'      => __( 'Minimum Height', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vh' ),
				'range'      => array(
					'px' => array( 'min' => 300, 'max' => 1200 ),
					'vh' => array( 'min' => 30, 'max' => 100 ),
				),
				'default'    => array( 'unit' => 'vh', 'size' => 88 ),
				'selectors'  => array( '{{WRAPPER}} .wss-hero' => 'min-height: {{SIZE}}{{UNIT}};' ),
			)
		);
		$this->add_responsive_control(
			'content_align',
			array(
				'label'     => __( 'Content Alignment', 'website-section-supporter' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array( 'title' => __( 'Left', 'website-section-supporter' ), 'icon' => 'eicon-text-align-left' ),
					'center' => array( 'title' => __( 'Center', 'website-section-supporter' ), 'icon' => 'eicon-text-align-center' ),
					'right'  => array( 'title' => __( 'Right', 'website-section-supporter' ), 'icon' => 'eicon-text-align-right' ),
				),
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .wss-hero' => 'text-align: {{VALUE}}; align-items: {{VALUE}};',
					'{{WRAPPER}} .wss-hero-inner' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .wss-hero-heading-wrap' => 'text-align: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'overlay_color',
			array(
				'label'     => __( 'Overlay Color (bottom gradient)', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(19,18,16,.82)',
				'selectors' => array( '{{WRAPPER}} .wss-hero::after' => 'background: linear-gradient(180deg, rgba(19,18,16,.1) 0%, rgba(19,18,16,.15) 45%, {{VALUE}} 100%);' ),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: SEARCH CONSOLE & BACKDROP ================= */
		$this->start_controls_section(
			'style_search_console',
			array( 'label' => __( 'Search Console & Backdrop', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array( 'enable_search' => 'yes' ) )
		);
		$this->add_responsive_control(
			'search_max_width',
			array(
				'label'      => __( 'Console Max Width', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'vw' ),
				'range'      => array(
					'px' => array( 'min' => 300, 'max' => 2000, 'step' => 10 ),
					'%'  => array( 'min' => 10, 'max' => 100, 'step' => 1 ),
					'vw' => array( 'min' => 10, 'max' => 100, 'step' => 1 ),
				),
				'default'    => array( 'size' => 1080, 'unit' => 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-hero-search-wrap' => 'max-width: {{SIZE}}{{UNIT}}; width: 100%; margin-left: auto; margin-right: auto;',
				),
			)
		);
		$this->add_responsive_control(
			'search_margin_top',
			array(
				'label'     => __( 'Top Spacing', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 150 ) ),
				'default'   => array( 'size' => 36 ),
				'selectors' => array( '{{WRAPPER}} .wss-hero-search-wrap' => 'margin-top: {{SIZE}}{{UNIT}};' ),
			)
		);
		$this->add_responsive_control(
			'search_padding',
			array(
				'label'      => __( 'Console Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array( '{{WRAPPER}} .wss-omni-search, {{WRAPPER}} .wss-hero-idx-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ),
			)
		);
		$this->add_responsive_control(
			'search_grid_gap',
			array(
				'label'      => __( 'Columns Gap', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em' ),
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 40 ) ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-omni-grid' => 'gap: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);
		$this->add_control(
			'search_border_width',
			array(
				'label'     => __( 'Border Width', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 10 ) ),
				'selectors' => array( '{{WRAPPER}} .wss-omni-search, {{WRAPPER}} .wss-hero-idx-wrapper' => 'border-width: {{SIZE}}px; border-style: solid;' ),
			)
		);
		$this->add_control(
			'search_border_radius',
			array(
				'label'     => __( 'Border Radius', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 60 ) ),
				'selectors' => array( '{{WRAPPER}} .wss-omni-search, {{WRAPPER}} .wss-hero-idx-wrapper' => 'border-radius: {{SIZE}}{{UNIT}};' ),
			)
		);

		/* Normal / Hover Tabs for Console */
		$this->start_controls_tabs( 'tabs_search_console_style' );
		$this->start_controls_tab(
			'tab_search_console_normal',
			array( 'label' => __( 'Normal', 'website-section-supporter' ) )
		);
		$this->add_control(
			'search_bg_color',
			array(
				'label'     => __( 'Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(16, 15, 13, 0.88)',
				'selectors' => array(
					'{{WRAPPER}} .wss-omni-search, {{WRAPPER}} .wss-hero-idx-wrapper' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'search_border_color',
			array(
				'label'     => __( 'Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(250, 248, 244, 0.12)',
				'selectors' => array(
					'{{WRAPPER}} .wss-omni-search, {{WRAPPER}} .wss-hero-idx-wrapper' => 'border-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'search_box_shadow',
				'selector' => '{{WRAPPER}} .wss-omni-search, {{WRAPPER}} .wss-hero-idx-wrapper',
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_search_console_hover',
			array( 'label' => __( 'Hover / Focus', 'website-section-supporter' ) )
		);
		$this->add_control(
			'search_bg_color_hover',
			array(
				'label'     => __( 'Hover Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-omni-search:hover, {{WRAPPER}} .wss-omni-search:focus-within, {{WRAPPER}} .wss-hero-idx-wrapper:hover' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'search_border_color_hover',
			array(
				'label'     => __( 'Hover Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(250, 248, 244, 0.24)',
				'selectors' => array(
					'{{WRAPPER}} .wss-omni-search:hover, {{WRAPPER}} .wss-omni-search:focus-within, {{WRAPPER}} .wss-hero-idx-wrapper:hover' => 'border-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'search_box_shadow_hover',
				'selector' => '{{WRAPPER}} .wss-omni-search:hover, {{WRAPPER}} .wss-omni-search:focus-within, {{WRAPPER}} .wss-hero-idx-wrapper:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		/* ================= STYLE: SEARCH TABS ================= */
		$this->start_controls_section(
			'style_search_tabs',
			array( 'label' => __( 'Status Tabs (Buy / Rent / Sold)', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array( 'enable_search' => 'yes', 'show_status_tabs' => 'yes', 'search_mode' => 'demo' ) )
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'tabs_typography', 'selector' => '{{WRAPPER}} .wss-omni-tab' )
		);
		$this->add_responsive_control(
			'tabs_padding',
			array(
				'label'      => __( 'Tab Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array( '{{WRAPPER}} .wss-omni-tab' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ),
			)
		);
		$this->start_controls_tabs( 'tabs_status_style' );
		$this->start_controls_tab( 'tab_status_normal', array( 'label' => __( 'Inactive', 'website-section-supporter' ) ) );
		$this->add_control( 'tab_text_color', array( 'label' => __( 'Text Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'default' => 'rgba(250, 248, 244, 0.5)', 'selectors' => array( '{{WRAPPER}} .wss-omni-tab:not(.wss-active)' => 'color: {{VALUE}} !important;' ) ) );
		$this->add_control( 'tab_bg_color', array( 'label' => __( 'Background Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'default' => 'transparent', 'selectors' => array( '{{WRAPPER}} .wss-omni-tab:not(.wss-active)' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;' ) ) );
		$this->end_controls_tab();
		$this->start_controls_tab( 'tab_status_active', array( 'label' => __( 'Active', 'website-section-supporter' ) ) );
		$this->add_control( 'tab_active_text_color', array( 'label' => __( 'Text Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'default' => '#131210', 'selectors' => array( '{{WRAPPER}} .wss-omni-tab.wss-active' => 'color: {{VALUE}} !important;' ) ) );
		$this->add_control( 'tab_active_bg_color', array( 'label' => __( 'Background Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'default' => '#faf8f4', 'selectors' => array( '{{WRAPPER}} .wss-omni-tab.wss-active' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;' ) ) );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/* ================= STYLE: SEARCH FIELDS & LABELS ================= */
		$this->start_controls_section(
			'style_search_fields',
			array( 'label' => __( 'Search Fields, Labels & Borders', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array( 'enable_search' => 'yes', 'search_mode' => 'demo' ) )
		);
		$this->add_control( 'label_heading', array( 'label' => __( 'Field Labels', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING ) );
		$this->add_control(
			'label_color',
			array( 'label' => __( 'Label Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'default' => 'rgba(250, 248, 244, 0.55)', 'selectors' => array( '{{WRAPPER}} .wss-omni-label' => 'color: {{VALUE}} !important;' ) )
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'label_typography', 'selector' => '{{WRAPPER}} .wss-omni-label' )
		);
		$this->add_control( 'input_heading', array( 'label' => __( 'Inputs & Dropdowns', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_control(
			'input_text_color',
			array( 'label' => __( 'Text Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'default' => '#ffffff', 'selectors' => array( '{{WRAPPER}} .wss-omni-input, {{WRAPPER}} .wss-omni-select' => 'color: {{VALUE}} !important;' ) )
		);
		$this->add_control(
			'placeholder_color',
			array( 'label' => __( 'Placeholder Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'default' => 'rgba(250, 248, 244, 0.38)', 'selectors' => array( '{{WRAPPER}} .wss-omni-input::placeholder' => 'color: {{VALUE}} !important;' ) )
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'input_typography', 'selector' => '{{WRAPPER}} .wss-omni-input, {{WRAPPER}} .wss-omni-select' )
		);

		/* ----- FIELD CARDS / COLUMNS BORDER & BACKGROUND CONTROLS ----- */
		$this->add_control( 'fields_box_heading', array( 'label' => __( 'Field Box & Borders', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );

		$this->add_responsive_control(
			'field_padding',
			array(
				'label'      => __( 'Field Inner Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-omni-col-location, {{WRAPPER}} .wss-omni-col-type, {{WRAPPER}} .wss-omni-col-price, {{WRAPPER}} .wss-omni-col-beds' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'field_border',
				'label'    => __( 'Border', 'website-section-supporter' ),
				'selector' => '{{WRAPPER}} .wss-omni-col-location, {{WRAPPER}} .wss-omni-col-type, {{WRAPPER}} .wss-omni-col-price, {{WRAPPER}} .wss-omni-col-beds',
			)
		);

		$this->add_responsive_control(
			'field_border_radius',
			array(
				'label'      => __( 'Border Radius', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-omni-col-location, {{WRAPPER}} .wss-omni-col-type, {{WRAPPER}} .wss-omni-col-price, {{WRAPPER}} .wss-omni-col-beds' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_field_box_style' );
		$this->start_controls_tab(
			'tab_field_box_normal',
			array( 'label' => __( 'Normal', 'website-section-supporter' ) )
		);
		$this->add_control(
			'field_bg_color',
			array(
				'label'     => __( 'Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-omni-col-location, {{WRAPPER}} .wss-omni-col-type, {{WRAPPER}} .wss-omni-col-price, {{WRAPPER}} .wss-omni-col-beds' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'field_border_color',
			array(
				'label'     => __( 'Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-omni-col-location, {{WRAPPER}} .wss-omni-col-type, {{WRAPPER}} .wss-omni-col-price, {{WRAPPER}} .wss-omni-col-beds' => 'border-color: {{VALUE}} !important;',
				),
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_field_box_focus',
			array( 'label' => __( 'Focus / Hover', 'website-section-supporter' ) )
		);
		$this->add_control(
			'field_bg_color_focus',
			array(
				'label'     => __( 'Focus Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-omni-col:hover, {{WRAPPER}} .wss-omni-col:focus-within' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'field_border_color_focus',
			array(
				'label'     => __( 'Focus Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-omni-col:hover, {{WRAPPER}} .wss-omni-col:focus-within' => 'border-color: {{VALUE}} !important;',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		/* Desktop Divider Lines */
		$this->add_control( 'divider_heading', array( 'label' => __( 'Desktop Column Dividers', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_control(
			'divider_color',
			array(
				'label'     => __( 'Divider Line Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(250, 248, 244, 0.1)',
				'selectors' => array(
					'{{WRAPPER}} .wss-omni-divider' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_responsive_control(
			'divider_height',
			array(
				'label'     => __( 'Divider Height', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 10, 'max' => 80 ) ),
				'default'   => array( 'size' => 36 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-omni-divider' => 'height: {{SIZE}}px !important;',
				),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: SEARCH BUTTON ================= */
		$this->start_controls_section(
			'style_search_button',
			array( 'label' => __( 'Search Action Button', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array( 'enable_search' => 'yes', 'search_mode' => 'demo' ) )
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'btn_typography', 'selector' => '{{WRAPPER}} .wss-omni-submit-btn' )
		);
		$this->add_responsive_control(
			'btn_padding',
			array(
				'label'      => __( 'Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array( '{{WRAPPER}} .wss-omni-submit-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ),
			)
		);
		$this->add_control(
			'btn_border_radius',
			array(
				'label'     => __( 'Border Radius', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 60 ) ),
				'selectors' => array( '{{WRAPPER}} .wss-omni-submit-btn' => 'border-radius: {{SIZE}}{{UNIT}};' ),
			)
		);
		$this->add_responsive_control(
			'btn_full_width',
			array(
				'label'        => __( 'Full Width Button', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'return_value' => 'yes',
				'selectors'    => array(
					'{{WRAPPER}} .wss-omni-col-btn' => 'flex: 1 1 100%; width: 100%;',
					'{{WRAPPER}} .wss-omni-submit-btn' => 'width: 100%; justify-content: center;',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_search_btn_style' );
		$this->start_controls_tab(
			'tab_search_btn_normal',
			array( 'label' => __( 'Normal', 'website-section-supporter' ) )
		);
		$this->add_control(
			'search_btn_color',
			array(
				'label'     => __( 'Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#faf8f4',
				'selectors' => array(
					'{{WRAPPER}} .wss-omni-submit-btn'        => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} button.wss-omni-submit-btn' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-omni-submit-btn span'   => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'search_btn_bg',
			array(
				'label'     => __( 'Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.05)',
				'selectors' => array(
					'{{WRAPPER}} .wss-omni-submit-btn' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'search_btn_border_color',
			array(
				'label'     => __( 'Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(250, 248, 244, 0.45)',
				'selectors' => array(
					'{{WRAPPER}} .wss-omni-submit-btn' => 'border-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array( 'name' => 'search_btn_shadow', 'selector' => '{{WRAPPER}} .wss-omni-submit-btn' )
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_search_btn_hover',
			array( 'label' => __( 'Hover', 'website-section-supporter' ) )
		);
		$this->add_control(
			'search_btn_hover_color',
			array(
				'label'     => __( 'Hover Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-omni-submit-btn:hover'        => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} button.wss-omni-submit-btn:hover' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-omni-submit-btn:hover span'   => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'search_btn_hover_bg',
			array(
				'label'     => __( 'Hover Background / Effect Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-omni-submit-btn::before' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'search_btn_hover_border_color',
			array(
				'label'     => __( 'Hover Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-omni-submit-btn:hover'        => 'border-color: {{VALUE}} !important;',
					'{{WRAPPER}} button.wss-omni-submit-btn:hover' => 'border-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array( 'name' => 'search_btn_shadow_hover', 'selector' => '{{WRAPPER}} .wss-omni-submit-btn:hover' )
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		/* ================= STYLE: MARK & EYEBROW ================= */
		$this->start_controls_section(
			'style_mark',
			array( 'label' => __( 'Top Mark & Eyebrow', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_responsive_control(
			'mark_eyebrow_width',
			array(
				'label'      => __( 'Mark & Eyebrow Width', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%', 'px', 'vw' ),
				'range'      => array(
					'%'  => array( 'min' => 10, 'max' => 100, 'step' => 1 ),
					'px' => array( 'min' => 100, 'max' => 2400, 'step' => 10 ),
					'vw' => array( 'min' => 10, 'max' => 100, 'step' => 1 ),
				),
				'default'    => array( 'unit' => '%', 'size' => 100 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-hero-mark, {{WRAPPER}} .wss-hero-eyebrow' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}}; margin-left: auto; margin-right: auto;',
				),
			)
		);
		$this->add_responsive_control(
			'mark_eyebrow_max_width',
			array(
				'label'      => __( 'Mark & Eyebrow Max Width', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'vw' ),
				'range'      => array(
					'px' => array( 'min' => 100, 'max' => 2400, 'step' => 10 ),
					'%'  => array( 'min' => 10, 'max' => 100, 'step' => 1 ),
					'vw' => array( 'min' => 10, 'max' => 100, 'step' => 1 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .wss-hero-mark, {{WRAPPER}} .wss-hero-eyebrow' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control( 'mark_heading', array( 'label' => __( 'Top Mark', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_control(
			'mark_color',
			array( 'label' => __( 'Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'default' => '#ffffff', 'selectors' => array( '{{WRAPPER}} .wss-hero-mark' => 'color: {{VALUE}};' ) )
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'mark_typography', 'selector' => '{{WRAPPER}} .wss-hero-mark' )
		);
		$this->add_responsive_control(
			'mark_margin_top',
			array(
				'label'     => __( 'Top Spacing', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 200 ) ),
				'default'   => array( 'size' => 90 ),
				'selectors' => array( '{{WRAPPER}} .wss-hero-mark' => 'margin-top: {{SIZE}}{{UNIT}};' ),
			)
		);
		$this->add_control( 'eyebrow_heading', array( 'label' => __( 'Eyebrow', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_control(
			'eyebrow_color',
			array( 'label' => __( 'Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'default' => 'rgba(250,248,244,.75)', 'selectors' => array( '{{WRAPPER}} .wss-hero-eyebrow' => 'color: {{VALUE}};' ) )
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'eyebrow_typography', 'selector' => '{{WRAPPER}} .wss-hero-eyebrow' )
		);
		$this->end_controls_section();

		/* ================= STYLE: HEADING ================= */
		$this->start_controls_section(
			'style_heading',
			array( 'label' => __( 'Heading (Line 1 & Line 2)', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_responsive_control(
			'heading_width',
			array(
				'label'      => __( 'Heading (Line 1 & 2) Width', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%', 'px', 'vw' ),
				'range'      => array(
					'%'  => array( 'min' => 10, 'max' => 100, 'step' => 1 ),
					'px' => array( 'min' => 200, 'max' => 2400, 'step' => 10 ),
					'vw' => array( 'min' => 10, 'max' => 100, 'step' => 1 ),
				),
				'default'    => array( 'unit' => '%', 'size' => 100 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-hero-heading-wrap, {{WRAPPER}} .wss-hero h1' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}}; margin-left: auto; margin-right: auto;',
				),
			)
		);
		$this->add_responsive_control(
			'heading_max_width',
			array(
				'label'      => __( 'Heading (Line 1 & 2) Max Width', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'vw' ),
				'range'      => array(
					'px' => array( 'min' => 200, 'max' => 2400, 'step' => 10 ),
					'%'  => array( 'min' => 10, 'max' => 100, 'step' => 1 ),
					'vw' => array( 'min' => 10, 'max' => 100, 'step' => 1 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .wss-hero-heading-wrap, {{WRAPPER}} .wss-hero h1' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control( 'line1_heading', array( 'label' => __( 'Line 1', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_control(
			'line1_color',
			array( 'label' => __( 'Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'default' => '#ffffff', 'selectors' => array( '{{WRAPPER}} .wss-hero h1' => 'color: {{VALUE}};' ) )
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'line1_typography', 'selector' => '{{WRAPPER}} .wss-hero h1' )
		);
		$this->add_control( 'line2_heading', array( 'label' => __( 'Line 2', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_control(
			'line2_color',
			array( 'label' => __( 'Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-hero-line2' => 'color: {{VALUE}};' ) )
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'line2_typography', 'selector' => '{{WRAPPER}} .wss-hero-line2' )
		);
		$this->end_controls_section();

		/* ================= STYLE: SCROLL CUE ================= */
		$this->start_controls_section(
			'style_scroll',
			array( 'label' => __( 'Scroll Cue', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array( 'show_scroll_cue' => 'yes' ) )
		);
		$this->add_control(
			'scroll_color',
			array( 'label' => __( 'Text & Line Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'default' => 'rgba(250,248,244,.65)', 'selectors' => array(
				'{{WRAPPER}} .wss-scroll-cue' => 'color: {{VALUE}};',
				'{{WRAPPER}} .wss-scroll-cue i' => 'background: {{VALUE}};',
			) )
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'scroll_typography', 'selector' => '{{WRAPPER}} .wss-scroll-cue span' )
		);
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		$bg_type = ! empty( $s['bg_type'] ) ? $s['bg_type'] : 'image';
		$uid = 'wss-hero-' . $this->get_id();
		?>
		<div class="wss-scope">
			<section class="wss-hero" id="<?php echo esc_attr( $uid ); ?>">
				<div class="wss-hero-bg">
					<?php if ( 'image' === $bg_type ) : ?>
						<?php if ( ! empty( $s['bg_image']['url'] ) ) : ?>
							<img src="<?php echo esc_url( $s['bg_image']['url'] ); ?>" alt="<?php echo esc_attr( $s['heading_line1'] . ' ' . $s['heading_line2'] ); ?>">
						<?php endif; ?>
					<?php elseif ( 'gradient' === $bg_type ) : ?>
						<?php
						$c1 = ! empty( $s['grad_color_1'] ) ? $s['grad_color_1'] : '#131210';
						$c2 = ! empty( $s['grad_color_2'] ) ? $s['grad_color_2'] : '#3a362e';
						$l1 = isset( $s['grad_location_1']['size'] ) ? $s['grad_location_1']['size'] : 0;
						$l2 = isset( $s['grad_location_2']['size'] ) ? $s['grad_location_2']['size'] : 100;
						$angle = isset( $s['grad_angle']['size'] ) ? $s['grad_angle']['size'] : 180;
						$grad_style = "background: linear-gradient({$angle}deg, {$c1} {$l1}%, {$c2} {$l2}%);";
						?>
						<div class="wss-hero-grad-layer" style="<?php echo esc_attr( $grad_style ); ?> width:100%; height:100%;"></div>
					<?php elseif ( 'video' === $bg_type ) : ?>
						<?php
						$video_source = ! empty( $s['video_link_type'] ) ? $s['video_link_type'] : 'self_hosted';
						$video_url    = ! empty( $s['video_url'] ) ? $s['video_url'] : '';
						$fallback     = ! empty( $s['video_fallback']['url'] ) ? $s['video_fallback']['url'] : '';

						if ( 'youtube' === $video_source && ! empty( $video_url ) ) {
							preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video_url, $match );
							$yt_id = ! empty( $match[1] ) ? $match[1] : '';
							if ( $yt_id ) {
								$embed_url = "https://www.youtube.com/embed/{$yt_id}?autoplay=1&mute=1&loop=1&playlist={$yt_id}&controls=0&showinfo=0&rel=0&enablejsapi=1";
								echo '<iframe src="' . esc_url( $embed_url ) . '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
							}
						} elseif ( ! empty( $video_url ) ) {
							echo '<video autoplay loop muted playsinline poster="' . esc_url( $fallback ) . '">';
							echo '<source src="' . esc_url( $video_url ) . '" type="video/mp4">';
							echo '</video>';
						}
						?>
					<?php endif; ?>
				</div>
				<?php if ( ! empty( $s['mark_text'] ) ) : ?>
					<div class="wss-hero-mark wss-reveal"><?php echo esc_html( $s['mark_text'] ); ?></div>
				<?php endif; ?>
				<div class="wss-hero-inner">
					<?php if ( ! empty( $s['eyebrow'] ) ) : ?>
						<div class="wss-hero-eyebrow wss-reveal"><?php echo esc_html( $s['eyebrow'] ); ?></div>
					<?php endif; ?>
					<div class="wss-hero-heading-wrap">
						<h1 class="wss-reveal">
							<span class="wss-mask"><span><?php echo esc_html( $s['heading_line1'] ); ?></span></span>
							<span class="wss-hero-line2 wss-mask wss-r2"><span><?php echo esc_html( $s['heading_line2'] ); ?></span></span>
						</h1>
					</div>

					<?php if ( 'yes' === ( $s['enable_search'] ?? 'yes' ) ) : ?>
						<div class="wss-hero-search-wrap wss-reveal wss-r3">
							<?php if ( 'shortcode' === ( $s['search_mode'] ?? 'demo' ) ) : ?>
								<div class="wss-hero-idx-wrapper">
									<?php
									if ( ! empty( $s['idx_shortcode'] ) ) {
										echo do_shortcode( $s['idx_shortcode'] );
									} else {
										echo '<p class="wss-shortcode-notice">' . esc_html__( 'Please enter your IDX or MLS search shortcode in the Elementor settings panel.', 'website-section-supporter' ) . '</p>';
									}
									?>
								</div>
							<?php else : ?>
								<!-- Super Luxury Demo Omni Search Bar -->
								<form class="wss-omni-search" action="<?php echo esc_url( ! empty( $s['search_target_url']['url'] ) ? $s['search_target_url']['url'] : '#sales' ); ?>" method="get">
									<?php if ( 'yes' === ( $s['show_status_tabs'] ?? 'yes' ) ) : ?>
										<div class="wss-omni-tabs">
											<button type="button" class="wss-omni-tab wss-active" data-status="buy"><?php echo esc_html( ! empty( $s['status_tab_1'] ) ? $s['status_tab_1'] : 'BUY' ); ?></button>
											<button type="button" class="wss-omni-tab" data-status="rent"><?php echo esc_html( ! empty( $s['status_tab_2'] ) ? $s['status_tab_2'] : 'RENT' ); ?></button>
											<button type="button" class="wss-omni-tab" data-status="sold"><?php echo esc_html( ! empty( $s['status_tab_3'] ) ? $s['status_tab_3'] : 'SOLD' ); ?></button>
											<input type="hidden" name="status" class="wss-omni-status-input" value="buy">
										</div>
									<?php endif; ?>

									<div class="wss-omni-grid">
										<!-- Location / Keyword -->
										<div class="wss-omni-col wss-omni-col-location">
											<span class="wss-omni-label">
												<svg class="wss-omni-icon" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 110-5 2.5 2.5 0 010 5z"/></svg>
												<?php esc_html_e( 'Location / Keyword', 'website-section-supporter' ); ?>
											</span>
											<div class="wss-omni-field-wrap">
												<input type="text" name="location" class="wss-omni-input" placeholder="<?php echo esc_attr( ! empty( $s['search_placeholder'] ) ? $s['search_placeholder'] : 'City, Neighborhood, Address, MLS #' ); ?>" autocomplete="off">
											</div>
										</div>

										<?php if ( 'yes' === ( $s['show_type_field'] ?? 'yes' ) ) : ?>
											<div class="wss-omni-divider"></div>
											<div class="wss-omni-col wss-omni-col-type">
												<span class="wss-omni-label">
													<svg class="wss-omni-icon" viewBox="0 0 24 24"><path d="M19 9.3V4h-3v2.6L12 3 2 12h3v8h5v-6h4v6h5v-8h3l-3-2.7z"/></svg>
													<?php esc_html_e( 'Property Type', 'website-section-supporter' ); ?>
												</span>
												<div class="wss-omni-field-wrap">
													<select name="type" class="wss-omni-select">
														<?php
														$type_opts = ! empty( $s['type_options'] ) ? explode( "\n", str_replace( "\r", '', $s['type_options'] ) ) : array( 'All Types', 'Single Family', 'Luxury Villa', 'Penthouse', 'Waterfront Estate', 'Modern Architectural' );
														foreach ( $type_opts as $opt ) {
															$opt = trim( $opt );
															if ( ! empty( $opt ) ) {
																echo '<option value="' . esc_attr( $opt ) . '">' . esc_html( $opt ) . '</option>';
															}
														}
														?>
													</select>
												</div>
											</div>
										<?php endif; ?>

										<?php if ( 'yes' === ( $s['show_price_field'] ?? 'yes' ) ) : ?>
											<div class="wss-omni-divider"></div>
											<div class="wss-omni-col wss-omni-col-price">
												<span class="wss-omni-label">
													<svg class="wss-omni-icon" viewBox="0 0 24 24"><path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/></svg>
													<?php esc_html_e( 'Price Range', 'website-section-supporter' ); ?>
												</span>
												<div class="wss-omni-field-wrap">
													<select name="price" class="wss-omni-select">
														<?php
														$price_opts = ! empty( $s['price_options'] ) ? explode( "\n", str_replace( "\r", '', $s['price_options'] ) ) : array( 'Any Price', '$1M - $3M', '$3M - $5M', '$5M - $10M', '$10M - $25M', '$25M+' );
														foreach ( $price_opts as $opt ) {
															$opt = trim( $opt );
															if ( ! empty( $opt ) ) {
																echo '<option value="' . esc_attr( $opt ) . '">' . esc_html( $opt ) . '</option>';
															}
														}
														?>
													</select>
												</div>
											</div>
										<?php endif; ?>

										<?php if ( 'yes' === ( $s['show_beds_field'] ?? 'yes' ) ) : ?>
											<div class="wss-omni-divider"></div>
											<div class="wss-omni-col wss-omni-col-beds">
												<span class="wss-omni-label">
													<svg class="wss-omni-icon" viewBox="0 0 24 24"><path d="M19 7h-8v6H3V5H1v15h2v-3h18v3h2v-9a4 4 0 00-4-4zM7 11a2 2 0 100-4 2 2 0 000 4z"/></svg>
													<?php esc_html_e( 'Bedrooms', 'website-section-supporter' ); ?>
												</span>
												<div class="wss-omni-field-wrap">
													<select name="beds" class="wss-omni-select">
														<?php
														$beds_opts = ! empty( $s['beds_options'] ) ? explode( "\n", str_replace( "\r", '', $s['beds_options'] ) ) : array( 'Any Beds', '1+ Beds', '2+ Beds', '3+ Beds', '4+ Beds', '5+ Beds' );
														foreach ( $beds_opts as $opt ) {
															$opt = trim( $opt );
															if ( ! empty( $opt ) ) {
																echo '<option value="' . esc_attr( $opt ) . '">' . esc_html( $opt ) . '</option>';
															}
														}
														?>
													</select>
												</div>
											</div>
										<?php endif; ?>

										<!-- Submit Button -->
										<div class="wss-omni-col wss-omni-col-btn">
											<button type="submit" class="wss-omni-submit-btn wss-btn-pill">
												<span><?php echo esc_html( ! empty( $s['btn_text'] ) ? $s['btn_text'] : 'SEARCH PROPERTIES' ); ?></span>
												<svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
											</button>
										</div>
									</div>
								</form>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
				<?php if ( 'yes' === $s['show_scroll_cue'] ) : ?>
					<div class="wss-scroll-cue wss-reveal wss-r3"><i></i><span class="wss-eyebrow" style="color:inherit;"><?php echo esc_html( $s['scroll_text'] ); ?></span></div>
				<?php endif; ?>
			</section>
		</div>
		<script>
		(function(){
			var hero = document.getElementById(<?php echo json_encode( $uid ); ?>);
			if (!hero) return;
			var tabs = hero.querySelectorAll('.wss-omni-tab');
			var statusInput = hero.querySelector('.wss-omni-status-input');
			tabs.forEach(function(tab){
				tab.addEventListener('click', function(){
					tabs.forEach(function(t){ t.classList.remove('wss-active'); });
					tab.classList.add('wss-active');
					if (statusInput) {
						statusInput.value = tab.getAttribute('data-status') || 'buy';
					}
				});
			});
		})();
		</script>
		<?php
	}
}
