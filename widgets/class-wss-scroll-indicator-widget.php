<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;

class WSS_Scroll_Indicator_Widget extends Widget_Base {

	public function get_name() {
		return 'wss_scroll_indicator';
	}

	public function get_title() {
		return __( 'WSS — Luxury Scroll Indicator', 'website-section-supporter' );
	}

	public function get_icon() {
		return 'eicon-scroll';
	}

	public function get_categories() {
		return array( 'website-section-supporter' );
	}

	public function get_keywords() {
		return array( 'scroll', 'indicator', 'cue', 'mouse', 'progress', 'luxury', 'hero', 'arrow', 'next section', 'top', 'wss' );
	}

	protected function register_controls() {

		/* ================= CONTENT: PRESET & DESIGN ================= */
		$this->start_controls_section(
			'section_indicator',
			array( 'label' => __( 'Indicator Style & Preset', 'website-section-supporter' ) )
		);

		$this->add_control(
			'indicator_preset',
			array(
				'label'   => __( 'Design Preset', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'line_horizontal',
				'options' => array(
					'line_horizontal'   => __( '1. Architectural Horizontal Sweep Line', 'website-section-supporter' ),
					'line_vertical'     => __( '2. Editorial Vertical Fall Line', 'website-section-supporter' ),
					'mouse_capsule'     => __( '3. Minimalist Mouse / Trackpad Pill', 'website-section-supporter' ),
					'chevrons_cascade'  => __( '4. Minimalist Cascading Chevrons', 'website-section-supporter' ),
					'circle_spinner'    => __( '5. Cinematic Rotating Circle Stamp', 'website-section-supporter' ),
					'magnetic_button'   => __( '6. Luxury Glassmorphic Pill Capsule', 'website-section-supporter' ),
					'pulse_dot'         => __( '7. Sonar Radar Pulse / Glow Beacon', 'website-section-supporter' ),
					'scroll_progress'   => __( '8. Live Page Scroll Progress Ring', 'website-section-supporter' ),
				),
			)
		);

		$this->add_control(
			'label_text',
			array(
				'label'       => __( 'Label Text', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'SCROLL', 'website-section-supporter' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'indicator_preset!' => array( 'circle_spinner' ),
				),
			)
		);

		$this->add_control(
			'sub_text',
			array(
				'label'       => __( 'Sub-Label / Tag (Optional)', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'EXPLORE', 'website-section-supporter' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'indicator_preset' => array( 'line_horizontal', 'line_vertical', 'magnetic_button' ),
				),
			)
		);

		$this->add_control(
			'circular_text',
			array(
				'label'       => __( 'Circular Rotating Text', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '• SCROLL TO EXPLORE • ARCHITECTURAL ADVISORY •', 'website-section-supporter' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'indicator_preset' => 'circle_spinner',
				),
			)
		);

		$this->add_control(
			'progress_display_type',
			array(
				'label'     => __( 'Progress Display Type', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'radial',
				'options'   => array(
					'radial'     => __( 'Radial Progress Ring with Arrow', 'website-section-supporter' ),
					'percentage' => __( 'Radial Ring with Live Percentage %', 'website-section-supporter' ),
					'bar'        => __( 'Slender Linear Progress Bar', 'website-section-supporter' ),
				),
				'condition' => array(
					'indicator_preset' => 'scroll_progress',
				),
			)
		);

		$this->add_control(
			'show_icon',
			array(
				'label'        => __( 'Show Icon / Arrow', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
				'condition'    => array(
					'indicator_preset' => array( 'mouse_capsule', 'circle_spinner', 'magnetic_button', 'pulse_dot', 'scroll_progress' ),
				),
			)
		);

		$this->add_control(
			'icon_source',
			array(
				'label'     => __( 'Icon Style', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default_arrow',
				'options'   => array(
					'default_arrow' => __( 'Luxury Minimalist Down Arrow (SVG)', 'website-section-supporter' ),
					'chevron'       => __( 'Sleek Single Chevron (SVG)', 'website-section-supporter' ),
					'custom'        => __( 'Custom Elementor Icon Library', 'website-section-supporter' ),
				),
				'condition' => array(
					'show_icon' => 'yes',
					'indicator_preset' => array( 'mouse_capsule', 'circle_spinner', 'magnetic_button', 'pulse_dot', 'scroll_progress' ),
				),
			)
		);

		$this->add_control(
			'custom_icon',
			array(
				'label'       => __( 'Choose Icon', 'website-section-supporter' ),
				'type'        => Controls_Manager::ICONS,
				'default'     => array(
					'value'   => 'fas fa-arrow-down',
					'library' => 'fa-solid',
				),
				'condition'   => array(
					'show_icon'   => 'yes',
					'icon_source' => 'custom',
					'indicator_preset' => array( 'mouse_capsule', 'circle_spinner', 'magnetic_button', 'pulse_dot', 'scroll_progress' ),
				),
			)
		);

		$this->end_controls_section();

		/* ================= CONTENT: INTERACTIVE CLICK ACTION ================= */
		$this->start_controls_section(
			'section_action',
			array( 'label' => __( 'Click Action & Smooth Scroll', 'website-section-supporter' ) )
		);

		$this->add_control(
			'click_action',
			array(
				'label'   => __( 'Click Behavior', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'next_section',
				'options' => array(
					'next_section'   => __( 'Scroll to Next Page Section', 'website-section-supporter' ),
					'target_id'      => __( 'Scroll to Custom CSS ID Anchor', 'website-section-supporter' ),
					'scroll_100vh'   => __( 'Scroll Down by Full Screen (100vh)', 'website-section-supporter' ),
					'scroll_amount'  => __( 'Scroll Down by Custom Pixels', 'website-section-supporter' ),
					'back_to_top'    => __( 'Back to Top of Page', 'website-section-supporter' ),
					'link'           => __( 'Custom URL Link', 'website-section-supporter' ),
					'none'           => __( 'None (Visual Cue Only)', 'website-section-supporter' ),
				),
			)
		);

		$this->add_control(
			'target_id',
			array(
				'label'       => __( 'Target CSS ID / Selector', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => '#about or #listings',
				'default'     => '#about',
				'condition'   => array( 'click_action' => 'target_id' ),
			)
		);

		$this->add_control(
			'scroll_px',
			array(
				'label'     => __( 'Scroll Amount (Pixels)', 'website-section-supporter' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 750,
				'min'       => 100,
				'max'       => 4000,
				'step'      => 50,
				'condition' => array( 'click_action' => 'scroll_amount' ),
			)
		);

		$this->add_control(
			'custom_link',
			array(
				'label'       => __( 'Link URL', 'website-section-supporter' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://example.com/explore',
				'condition'   => array( 'click_action' => 'link' ),
			)
		);

		$this->add_control(
			'scroll_offset',
			array(
				'label'       => __( 'Sticky Header Offset (px)', 'website-section-supporter' ),
				'description' => __( 'Offset target scroll position to prevent header overlap.', 'website-section-supporter' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 0,
				'min'         => -300,
				'max'         => 300,
				'condition'   => array( 'click_action' => array( 'next_section', 'target_id' ) ),
			)
		);

		$this->end_controls_section();

		/* ================= CONTENT: POSITIONING & VISIBILITY ================= */
		$this->start_controls_section(
			'section_position',
			array( 'label' => __( 'Positioning & Auto-Visibility', 'website-section-supporter' ) )
		);

		$this->add_control(
			'position_mode',
			array(
				'label'   => __( 'Positioning Mode', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'inline',
				'options' => array(
					'inline'   => __( 'Inline (Standard in container flow)', 'website-section-supporter' ),
					'absolute' => __( 'Absolute (Pinned inside parent section)', 'website-section-supporter' ),
					'fixed'    => __( 'Fixed (Pinned floating to screen viewport)', 'website-section-supporter' ),
				),
			)
		);

		$this->add_responsive_control(
			'align_inline',
			array(
				'label'     => __( 'Alignment', 'website-section-supporter' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array( 'title' => __( 'Left', 'website-section-supporter' ), 'icon' => 'eicon-text-align-left' ),
					'center' => array( 'title' => __( 'Center', 'website-section-supporter' ), 'icon' => 'eicon-text-align-center' ),
					'right'  => array( 'title' => __( 'Right', 'website-section-supporter' ), 'icon' => 'eicon-text-align-right' ),
				),
				'default'   => 'center',
				'condition' => array( 'position_mode' => 'inline' ),
				'selectors' => array(
					'{{WRAPPER}} .wss-scroll-indicator-wrap' => 'text-align: {{VALUE}}; justify-content: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'pinned_corner',
			array(
				'label'     => __( 'Pinned Location', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'bottom_center',
				'options'   => array(
					'bottom_center' => __( 'Bottom Center', 'website-section-supporter' ),
					'bottom_left'   => __( 'Bottom Left (Luxury Standard)', 'website-section-supporter' ),
					'bottom_right'  => __( 'Bottom Right', 'website-section-supporter' ),
					'middle_right'  => __( 'Middle Right (Floating Rail)', 'website-section-supporter' ),
					'middle_left'   => __( 'Middle Left (Floating Rail)', 'website-section-supporter' ),
				),
				'condition' => array( 'position_mode' => array( 'absolute', 'fixed' ) ),
			)
		);

		$this->add_responsive_control(
			'offset_x',
			array(
				'label'      => __( 'Horizontal Offset (X)', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'vw' ),
				'range'      => array(
					'px' => array( 'min' => -300, 'max' => 300 ),
					'vw' => array( 'min' => 0, 'max' => 25 ),
				),
				'condition'  => array( 'position_mode' => array( 'absolute', 'fixed' ) ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-scroll-indicator-wrap' => '--wss-scroll-offset-x: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'offset_y',
			array(
				'label'      => __( 'Vertical Offset (Y)', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'vh' ),
				'range'      => array(
					'px' => array( 'min' => -300, 'max' => 300 ),
					'vh' => array( 'min' => 0, 'max' => 25 ),
				),
				'default'    => array( 'unit' => 'px', 'size' => 32 ),
				'condition'  => array( 'position_mode' => array( 'absolute', 'fixed' ) ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-scroll-indicator-wrap' => '--wss-scroll-offset-y: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'z_index',
			array(
				'label'     => __( 'Z-Index Layer', 'website-section-supporter' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 20,
				'min'       => 1,
				'max'       => 9999,
				'selectors' => array(
					'{{WRAPPER}} .wss-scroll-indicator-wrap' => 'z-index: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'enable_autohide',
			array(
				'label'        => __( 'Auto-Hide on Page Scroll', 'website-section-supporter' ),
				'description'  => __( 'Fades out the indicator smoothly as the user scrolls down the page.', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'autohide_threshold',
			array(
				'label'     => __( 'Auto-Hide Threshold (px)', 'website-section-supporter' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 120,
				'min'       => 20,
				'max'       => 1000,
				'condition' => array( 'enable_autohide' => 'yes' ),
			)
		);

		$this->add_control(
			'enable_reveal_scroll',
			array(
				'label'        => __( 'Reveal Only After Scroll (Back to Top Mode)', 'website-section-supporter' ),
				'description'  => __( 'Hidden at top of page, then fades in when scrolled past threshold.', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'reveal_threshold',
			array(
				'label'     => __( 'Reveal Threshold (px)', 'website-section-supporter' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 400,
				'min'       => 100,
				'max'       => 2000,
				'condition' => array( 'enable_reveal_scroll' => 'yes' ),
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: LAYOUT & SIZING ================= */
		$this->start_controls_section(
			'style_layout_sizing',
			array( 'label' => __( 'Sizing & Dimensions', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);

		$this->add_responsive_control(
			'indicator_scale',
			array(
				'label'     => __( 'Overall Scale', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0.5, 'max' => 2.0, 'step' => 0.05 ) ),
				'default'   => array( 'size' => 1 ),
				'selectors' => array(
					'{{WRAPPER}} .wss-scroll-indicator' => 'transform: scale({{SIZE}}); transform-origin: center center;',
				),
			)
		);

		$this->add_responsive_control(
			'line_length',
			array(
				'label'      => __( 'Line Length / Height', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'vw' ),
				'range'      => array( 'px' => array( 'min' => 20, 'max' => 300 ) ),
				'default'    => array( 'size' => 54 ),
				'condition'  => array( 'indicator_preset' => array( 'line_horizontal', 'line_vertical' ) ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-scroll-line-h' => 'width: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .wss-scroll-line-v' => 'height: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_control(
			'line_thickness',
			array(
				'label'     => __( 'Line Thickness (px)', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 1, 'max' => 6 ) ),
				'default'   => array( 'size' => 1 ),
				'condition' => array( 'indicator_preset' => array( 'line_horizontal', 'line_vertical' ) ),
				'selectors' => array(
					'{{WRAPPER}} .wss-scroll-line-h' => 'height: {{SIZE}}px !important;',
					'{{WRAPPER}} .wss-scroll-line-v' => 'width: {{SIZE}}px !important;',
				),
			)
		);

		$this->add_responsive_control(
			'circle_diameter',
			array(
				'label'      => __( 'Circle Diameter', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em' ),
				'range'      => array( 'px' => array( 'min' => 50, 'max' => 220 ) ),
				'default'    => array( 'size' => 110 ),
				'condition'  => array( 'indicator_preset' => array( 'circle_spinner', 'scroll_progress' ) ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-scroll-circle-wrap' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'mouse_width',
			array(
				'label'      => __( 'Mouse Width', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array( 'px' => array( 'min' => 16, 'max' => 50 ) ),
				'default'    => array( 'size' => 24 ),
				'condition'  => array( 'indicator_preset' => 'mouse_capsule' ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-scroll-mouse' => 'width: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'mouse_height',
			array(
				'label'      => __( 'Mouse Height', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array( 'px' => array( 'min' => 26, 'max' => 80 ) ),
				'default'    => array( 'size' => 40 ),
				'condition'  => array( 'indicator_preset' => 'mouse_capsule' ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-scroll-mouse' => 'height: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'icon_size',
			array(
				'label'      => __( 'Icon / Arrow Size', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em' ),
				'range'      => array( 'px' => array( 'min' => 8, 'max' => 48 ) ),
				'default'    => array( 'size' => 14 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-scroll-icon, {{WRAPPER}} .wss-scroll-icon svg' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important; font-size: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'elements_gap',
			array(
				'label'      => __( 'Gap Between Text & Indicator', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em' ),
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 60 ) ),
				'default'    => array( 'size' => 14 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-scroll-indicator' => 'gap: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'widget_padding',
			array(
				'label'      => __( 'Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-scroll-indicator' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: TYPOGRAPHY ================= */
		$this->start_controls_section(
			'style_typography_section',
			array( 'label' => __( 'Typography', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'label_typography',
				'label'    => __( 'Label Typography', 'website-section-supporter' ),
				'selector' => '{{WRAPPER}} .wss-scroll-label, {{WRAPPER}} .wss-scroll-circle-text text',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'sublabel_typography',
				'label'     => __( 'Sub-Label Typography', 'website-section-supporter' ),
				'selector'  => '{{WRAPPER}} .wss-scroll-sublabel',
				'condition' => array(
					'indicator_preset' => array( 'line_horizontal', 'line_vertical', 'magnetic_button' ),
				),
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: COLORS & ACCENTS ================= */
		$this->start_controls_section(
			'style_colors_section',
			array( 'label' => __( 'Colors, Glow & Aesthetics', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);

		$this->start_controls_tabs( 'tabs_indicator_colors' );

		$this->start_controls_tab(
			'tab_color_normal',
			array( 'label' => __( 'Normal', 'website-section-supporter' ) )
		);

		$this->add_control(
			'text_color',
			array(
				'label'     => __( 'Text & Label Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(250, 248, 244, 0.7)',
				'selectors' => array(
					'{{WRAPPER}} .wss-scroll-label, {{WRAPPER}} .wss-scroll-sublabel, {{WRAPPER}} .wss-scroll-circle-text' => 'color: {{VALUE}} !important; fill: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'accent_color',
			array(
				'label'     => __( 'Base Line / Track / Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(250, 248, 244, 0.22)',
				'selectors' => array(
					'{{WRAPPER}} .wss-scroll-line-h, {{WRAPPER}} .wss-scroll-line-v'                               => 'background-color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-scroll-mouse, {{WRAPPER}} .wss-scroll-pill-btn, {{WRAPPER}} .wss-scroll-chevron' => 'border-color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-scroll-chevron'                                                               => 'border-right-color: {{VALUE}} !important; border-bottom-color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-scroll-progress-track'                                                        => 'stroke: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-scroll-pulse-dot-center'                                                      => 'background-color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-scroll-icon'                                                                 => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'glow_color',
			array(
				'label'     => __( 'Traveling Glow / Active Sweep / Pulse Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#faf8f4',
				'selectors' => array(
					'{{WRAPPER}} .wss-scroll-line-h::after, {{WRAPPER}} .wss-scroll-line-v::after' => 'background: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-scroll-mouse-wheel'                                          => 'background-color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-scroll-progress-bar'                                         => 'stroke: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-scroll-pulse-ring'                                           => 'border-color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-scroll-pulse-dot-center'                                     => 'background: {{VALUE}} !important; box-shadow: 0 0 16px {{VALUE}} !important;',
					'{{WRAPPER}} .wss-scroll-circle-center svg'                                    => 'color: {{VALUE}} !important; stroke: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'container_bg_color',
			array(
				'label'     => __( 'Capsule / Pill Background', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.04)',
				'condition' => array( 'indicator_preset' => array( 'magnetic_button', 'mouse_capsule', 'circle_spinner', 'scroll_progress' ) ),
				'selectors' => array(
					'{{WRAPPER}} .wss-scroll-pill-btn, {{WRAPPER}} .wss-scroll-mouse, {{WRAPPER}} .wss-scroll-circle-wrap' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'container_border_radius',
			array(
				'label'      => __( 'Border Radius', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 100 ) ),
				'condition'  => array( 'indicator_preset' => array( 'magnetic_button', 'mouse_capsule' ) ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-scroll-pill-btn, {{WRAPPER}} .wss-scroll-mouse' => 'border-radius: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'indicator_shadow',
				'selector' => '{{WRAPPER}} .wss-scroll-indicator, {{WRAPPER}} .wss-scroll-pill-btn, {{WRAPPER}} .wss-scroll-circle-wrap',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_color_hover',
			array( 'label' => __( 'Hover', 'website-section-supporter' ) )
		);

		$this->add_control(
			'text_color_hover',
			array(
				'label'     => __( 'Hover Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .wss-scroll-indicator:hover .wss-scroll-label, {{WRAPPER}} .wss-scroll-indicator:hover .wss-scroll-sublabel, {{WRAPPER}} .wss-scroll-indicator:hover .wss-scroll-circle-text' => 'color: {{VALUE}} !important; fill: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'accent_color_hover',
			array(
				'label'     => __( 'Hover Accent & Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(250, 248, 244, 0.8)',
				'selectors' => array(
					'{{WRAPPER}} .wss-scroll-indicator:hover .wss-scroll-line-h, {{WRAPPER}} .wss-scroll-indicator:hover .wss-scroll-line-v'                               => 'background-color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-scroll-indicator:hover .wss-scroll-mouse, {{WRAPPER}} .wss-scroll-indicator:hover .wss-scroll-pill-btn'                            => 'border-color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-scroll-indicator:hover .wss-scroll-chevron'                                                                                          => 'border-right-color: {{VALUE}} !important; border-bottom-color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-scroll-indicator:hover .wss-scroll-icon'                                                                                             => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'bg_color_hover',
			array(
				'label'     => __( 'Hover Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-scroll-indicator:hover .wss-scroll-pill-btn, {{WRAPPER}} .wss-scroll-indicator:hover .wss-scroll-circle-wrap' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'indicator_shadow_hover',
				'selector' => '{{WRAPPER}} .wss-scroll-indicator:hover, {{WRAPPER}} .wss-scroll-indicator:hover .wss-scroll-pill-btn, {{WRAPPER}} .wss-scroll-indicator:hover .wss-scroll-circle-wrap',
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		/* ================= STYLE: ANIMATION & MOTION ================= */
		$this->start_controls_section(
			'style_animation_section',
			array( 'label' => __( 'Animation & Motion', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);

		$this->add_control(
			'enable_anim',
			array(
				'label'        => __( 'Enable Continuous Animation', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'anim_duration',
			array(
				'label'      => __( 'Animation Cycle Duration (s)', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 0.5, 'max' => 10, 'step' => 0.1 ) ),
				'default'    => array( 'size' => 2.2 ),
				'condition'  => array( 'enable_anim' => 'yes' ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-scroll-line-h::after, {{WRAPPER}} .wss-scroll-line-v::after' => 'animation-duration: {{SIZE}}s !important;',
					'{{WRAPPER}} .wss-scroll-mouse-wheel'                                          => 'animation-duration: {{SIZE}}s !important;',
					'{{WRAPPER}} .wss-scroll-chevron'                                              => 'animation-duration: {{SIZE}}s !important;',
					'{{WRAPPER}} .wss-scroll-circle-rotating'                                      => 'animation-duration: {{SIZE}}s !important;',
					'{{WRAPPER}} .wss-scroll-pulse-ring'                                           => 'animation-duration: {{SIZE}}s !important;',
				),
			)
		);

		$this->add_control(
			'enable_hover_lift',
			array(
				'label'        => __( 'Subtle Hover Translation / Lift', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();

		$preset       = ! empty( $s['indicator_preset'] ) ? $s['indicator_preset'] : 'line_horizontal';
		$label        = ! empty( $s['label_text'] ) ? $s['label_text'] : '';
		$sub_label    = ! empty( $s['sub_text'] ) ? $s['sub_text'] : '';
		$circle_text  = ! empty( $s['circular_text'] ) ? $s['circular_text'] : '• SCROLL TO EXPLORE • ARCHITECTURAL ADVISORY •';
		$click_action = ! empty( $s['click_action'] ) ? $s['click_action'] : 'next_section';
		$pos_mode     = ! empty( $s['position_mode'] ) ? $s['position_mode'] : 'inline';
		$pinned_loc   = ! empty( $s['pinned_corner'] ) ? $s['pinned_corner'] : 'bottom_center';
		$enable_anim  = ( 'yes' === ( $s['enable_anim'] ?? 'yes' ) ) ? 'wss-has-anim' : 'wss-no-anim';
		$hover_lift   = ( 'yes' === ( $s['enable_hover_lift'] ?? 'yes' ) ) ? 'wss-hover-lift' : '';
		$auto_hide    = ( 'yes' === ( $s['enable_autohide'] ?? 'no' ) ) ? 'yes' : 'no';
		$hide_thresh  = ! empty( $s['autohide_threshold'] ) ? intval( $s['autohide_threshold'] ) : 120;
		$reveal_mode  = ( 'yes' === ( $s['enable_reveal_scroll'] ?? 'no' ) ) ? 'yes' : 'no';
		$rev_thresh   = ! empty( $s['reveal_threshold'] ) ? intval( $s['reveal_threshold'] ) : 400;
		$offset_y_val = ! empty( $s['scroll_offset'] ) ? intval( $s['scroll_offset'] ) : 0;
		$target_id    = ! empty( $s['target_id'] ) ? $s['target_id'] : '#about';
		$scroll_px    = ! empty( $s['scroll_px'] ) ? intval( $s['scroll_px'] ) : 750;
		$show_icon    = ( 'yes' === ( $s['show_icon'] ?? 'yes' ) );
		$progress_type = $s['progress_display_type'] ?? 'radial';

		$wrap_classes = array(
			'wss-scroll-indicator-wrap',
			'wss-pos-' . esc_attr( $pos_mode ),
			( 'inline' !== $pos_mode ? 'wss-pin-' . esc_attr( $pinned_loc ) : '' ),
			( 'yes' === $auto_hide ? 'wss-autohide-active' : '' ),
			( 'yes' === $reveal_mode ? 'wss-reveal-scroll-active wss-is-hidden' : '' ),
		);
		$wrap_classes = array_filter( $wrap_classes );

		$btn_tag  = 'div';
		$tag_attr = '';
		if ( 'link' === $click_action && ! empty( $s['custom_link']['url'] ) ) {
			$btn_tag  = 'a';
			$tag_attr = ' href="' . esc_url( $s['custom_link']['url'] ) . '"' . ( ! empty( $s['custom_link']['is_external'] ) ? ' target="_blank" rel="noopener"' : '' );
		} else {
			$btn_tag  = 'button';
			$tag_attr = ' type="button"';
		}

		$unique_id = 'wss_si_' . $this->get_id();
		?>
		<div class="wss-scope">
			<div class="<?php echo esc_attr( implode( ' ', $wrap_classes ) ); ?>"
				data-wss-scroll-indicator="<?php echo esc_attr( $unique_id ); ?>"
				data-action="<?php echo esc_attr( $click_action ); ?>"
				data-target-id="<?php echo esc_attr( $target_id ); ?>"
				data-scroll-px="<?php echo esc_attr( $scroll_px ); ?>"
				data-offset-y="<?php echo esc_attr( $offset_y_val ); ?>"
				data-autohide="<?php echo esc_attr( $auto_hide ); ?>"
				data-autohide-thresh="<?php echo esc_attr( $hide_thresh ); ?>"
				data-reveal="<?php echo esc_attr( $reveal_mode ); ?>"
				data-reveal-thresh="<?php echo esc_attr( $rev_thresh ); ?>"
			>
				<<?php echo $btn_tag . $tag_attr; ?> class="wss-scroll-indicator wss-preset-<?php echo esc_attr( $preset ); ?> <?php echo esc_attr( $enable_anim . ' ' . $hover_lift ); ?>">
					
					<?php if ( 'line_horizontal' === $preset ) : ?>
						<!-- 1. Architectural Horizontal Line -->
						<div class="wss-scroll-line-h"><i class="wss-line-glow"></i></div>
						<div class="wss-scroll-text-group">
							<?php if ( ! empty( $label ) ) : ?>
								<span class="wss-scroll-label wss-eyebrow"><?php echo esc_html( $label ); ?></span>
							<?php endif; ?>
							<?php if ( ! empty( $sub_label ) ) : ?>
								<span class="wss-scroll-sublabel"><?php echo esc_html( $sub_label ); ?></span>
							<?php endif; ?>
						</div>

					<?php elseif ( 'line_vertical' === $preset ) : ?>
						<!-- 2. Editorial Vertical Line -->
						<div class="wss-scroll-text-group wss-vertical-text">
							<?php if ( ! empty( $label ) ) : ?>
								<span class="wss-scroll-label wss-eyebrow"><?php echo esc_html( $label ); ?></span>
							<?php endif; ?>
							<?php if ( ! empty( $sub_label ) ) : ?>
								<span class="wss-scroll-sublabel"><?php echo esc_html( $sub_label ); ?></span>
							<?php endif; ?>
						</div>
						<div class="wss-scroll-line-v"><i class="wss-line-glow"></i></div>

					<?php elseif ( 'mouse_capsule' === $preset ) : ?>
						<!-- 3. Minimalist Mouse Capsule -->
						<div class="wss-scroll-mouse">
							<span class="wss-scroll-mouse-wheel"></span>
						</div>
						<?php if ( ! empty( $label ) ) : ?>
							<span class="wss-scroll-label wss-eyebrow"><?php echo esc_html( $label ); ?></span>
						<?php endif; ?>
						<?php if ( $show_icon ) : ?>
							<div class="wss-scroll-icon">
								<?php $this->render_chosen_icon( $s ); ?>
							</div>
						<?php endif; ?>

					<?php elseif ( 'chevrons_cascade' === $preset ) : ?>
						<!-- 4. Minimalist Cascading Chevrons -->
						<?php if ( ! empty( $label ) ) : ?>
							<span class="wss-scroll-label wss-eyebrow"><?php echo esc_html( $label ); ?></span>
						<?php endif; ?>
						<div class="wss-scroll-chevrons">
							<span class="wss-scroll-chevron wss-ch-1"></span>
							<span class="wss-scroll-chevron wss-ch-2"></span>
							<span class="wss-scroll-chevron wss-ch-3"></span>
						</div>

					<?php elseif ( 'circle_spinner' === $preset ) : ?>
						<!-- 5. Rotating Circle Stamp -->
						<div class="wss-scroll-circle-wrap">
							<svg class="wss-scroll-circle-rotating" viewBox="0 0 120 120">
								<path id="wss_circle_path_<?php echo esc_attr( $unique_id ); ?>" d="M 60, 60 m -46, 0 a 46,46 0 1,1 92,0 a 46,46 0 1,1 -92,0" fill="none"></path>
								<text class="wss-scroll-circle-text">
									<textPath href="#wss_circle_path_<?php echo esc_attr( $unique_id ); ?>"><?php echo esc_html( $circle_text ); ?></textPath>
								</text>
							</svg>
							<div class="wss-scroll-circle-center">
								<?php if ( $show_icon ) : ?>
									<?php $this->render_chosen_icon( $s ); ?>
								<?php else : ?>
									<span class="wss-center-dot"></span>
								<?php endif; ?>
							</div>
						</div>

					<?php elseif ( 'magnetic_button' === $preset ) : ?>
						<!-- 6. Luxury Glassmorphic Pill Capsule -->
						<div class="wss-scroll-pill-btn">
							<?php if ( ! empty( $label ) ) : ?>
								<span class="wss-scroll-label wss-eyebrow"><?php echo esc_html( $label ); ?></span>
							<?php endif; ?>
							<?php if ( ! empty( $sub_label ) ) : ?>
								<span class="wss-scroll-sublabel"><?php echo esc_html( $sub_label ); ?></span>
							<?php endif; ?>
							<?php if ( $show_icon ) : ?>
								<div class="wss-scroll-icon">
									<?php $this->render_chosen_icon( $s ); ?>
								</div>
							<?php endif; ?>
						</div>

					<?php elseif ( 'pulse_dot' === $preset ) : ?>
						<!-- 7. Sonar Radar Pulse Beacon -->
						<div class="wss-scroll-pulse-wrap">
							<span class="wss-scroll-pulse-ring wss-pr-1"></span>
							<span class="wss-scroll-pulse-ring wss-pr-2"></span>
							<span class="wss-scroll-pulse-dot-center"></span>
						</div>
						<?php if ( ! empty( $label ) ) : ?>
							<span class="wss-scroll-label wss-eyebrow"><?php echo esc_html( $label ); ?></span>
						<?php endif; ?>

					<?php elseif ( 'scroll_progress' === $preset ) : ?>
						<!-- 8. Live Page Scroll Progress Ring / Bar -->
						<?php if ( 'bar' === $progress_type ) : ?>
							<div class="wss-scroll-progress-linear">
								<span class="wss-scroll-progress-linear-fill"></span>
							</div>
							<?php if ( ! empty( $label ) ) : ?>
								<span class="wss-scroll-label wss-eyebrow"><?php echo esc_html( $label ); ?></span>
							<?php endif; ?>
						<?php else : ?>
							<div class="wss-scroll-circle-wrap wss-scroll-progress-radial">
								<svg class="wss-scroll-progress-svg" viewBox="0 0 100 100">
									<circle class="wss-scroll-progress-track" cx="50" cy="50" r="44"></circle>
									<circle class="wss-scroll-progress-bar" cx="50" cy="50" r="44"></circle>
								</svg>
								<div class="wss-scroll-circle-center">
									<?php if ( 'percentage' === $progress_type ) : ?>
										<span class="wss-scroll-progress-val">0%</span>
									<?php elseif ( $show_icon ) : ?>
										<?php $this->render_chosen_icon( $s ); ?>
									<?php else : ?>
										<span class="wss-center-dot"></span>
									<?php endif; ?>
								</div>
							</div>
							<?php if ( ! empty( $label ) ) : ?>
								<span class="wss-scroll-label wss-eyebrow"><?php echo esc_html( $label ); ?></span>
							<?php endif; ?>
						<?php endif; ?>

					<?php endif; ?>

				</<?php echo $btn_tag; ?>>
			</div>
		</div>
		<?php
	}

	private function render_chosen_icon( $settings ) {
		$source = $settings['icon_source'] ?? 'default_arrow';
		if ( 'chevron' === $source ) {
			?>
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
				<polyline points="6 9 12 15 18 9"></polyline>
			</svg>
			<?php
		} elseif ( 'custom' === $source && ! empty( $settings['custom_icon']['value'] ) ) {
			\Elementor\Icons_Manager::render_icon( $settings['custom_icon'], array( 'aria-hidden' => 'true' ) );
		} else {
			// default luxury sleek arrow
			?>
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
				<path d="M12 5v14M5 12l7 7 7-7"/>
			</svg>
			<?php
		}
	}
}
