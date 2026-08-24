<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class WSS_About_Widget extends Widget_Base {

	public function get_name() { return 'wss_about'; }
	public function get_title() { return __( 'WSS — About / Advisory', 'website-section-supporter' ); }
	public function get_icon() { return 'eicon-info-circle-o'; }
	public function get_categories() { return array( 'website-section-supporter' ); }
	public function get_keywords() { return array( 'about', 'advisory', 'text image' ); }

	protected function register_controls() {

		/* ================= CONTENT ================= */
		$this->start_controls_section( 'section_content', array( 'label' => __( 'Content', 'website-section-supporter' ) ) );
		$this->add_control(
			'eyebrow',
			array(
				'label'       => __( 'Eyebrow', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'The Advisory', 'website-section-supporter' ),
				'placeholder' => __( 'The Advisory', 'website-section-supporter' ),
				'dynamic'     => array( 'active' => true ),
			)
		);
		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Heading', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 2,
				'default'     => __( 'The Noir Standard', 'website-section-supporter' ),
				'placeholder' => __( 'Enter heading text...', 'website-section-supporter' ),
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
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				),
			)
		);
		$this->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'website-section-supporter' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => __( '<p>For more than two decades, this advisory has proven itself indispensable in the refined world of international luxury real estate. Trusted by celebrated clients, respected colleagues, and the communities served — every website we build carries that same standard of craft, courtesy of Digitize Growth.</p>', 'website-section-supporter' ),
			)
		);
		$this->add_control(
			'enable_reveal',
			array(
				'label'        => __( 'Enable Scroll Reveal Animation', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section( 'section_buttons', array( 'label' => __( 'Buttons', 'website-section-supporter' ) ) );
		$this->add_control( 'btn1_text', array( 'label' => __( 'Button 1 Text', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'Read More', 'website-section-supporter' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'btn1_link', array( 'label' => __( 'Button 1 Link', 'website-section-supporter' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => WSS_CREDIT_URL, 'is_external' => true ) ) );
		$this->add_control( 'btn2_text', array( 'label' => __( 'Button 2 Text', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'View Exclusive Homes', 'website-section-supporter' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'btn2_link', array( 'label' => __( 'Button 2 Link', 'website-section-supporter' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#sales' ) ) );
		$this->end_controls_section();

		$this->start_controls_section( 'section_media', array( 'label' => __( 'Media', 'website-section-supporter' ) ) );
		$this->add_control( 'main_image', array( 'label' => __( 'Main Image', 'website-section-supporter' ), 'type' => Controls_Manager::MEDIA, 'default' => array( 'url' => 'https://picsum.photos/seed/noiradvisor/900/1120' ) ) );
		$this->add_control( 'show_video_chip', array( 'label' => __( 'Show Small Video Thumbnail', 'website-section-supporter' ), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes' ) );
		$this->add_control( 'video_image', array( 'label' => __( 'Video Thumbnail Image', 'website-section-supporter' ), 'type' => Controls_Manager::MEDIA, 'default' => array( 'url' => 'https://picsum.photos/seed/noirclip/300/220' ), 'condition' => array( 'show_video_chip' => 'yes' ) ) );
		$this->add_control( 'video_link', array( 'label' => __( 'Video Link (YouTube or MP4)', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'condition' => array( 'show_video_chip' => 'yes' ) ) );
		$this->end_controls_section();

		/* ================= PARALLAX & MOTION ================= */
		$this->start_controls_section(
			'section_parallax',
			array( 'label' => __( 'Parallax & Motion Effects', 'website-section-supporter' ) )
		);

		$this->add_control(
			'enable_parallax',
			array(
				'label'        => __( 'Enable Parallax Effect', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'website-section-supporter' ),
				'label_off'    => __( 'No', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);

		$this->add_control(
			'parallax_mode',
			array(
				'label'     => __( 'Parallax Mode', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'scroll',
				'options'   => array(
					'scroll' => __( 'Scroll Parallax (Smooth translate on scroll)', 'website-section-supporter' ),
					'fixed'  => __( 'Fixed Attachment (Window reveal effect)', 'website-section-supporter' ),
					'zoom'   => __( 'Scroll Zoom (Scale up on scroll)', 'website-section-supporter' ),
					'tilt'   => __( '3D Mouse Tilt (Interactive on hover)', 'website-section-supporter' ),
				),
				'condition' => array( 'enable_parallax' => 'yes' ),
			)
		);

		$this->add_control(
			'parallax_direction',
			array(
				'label'     => __( 'Scroll Direction', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'up',
				'options'   => array(
					'up'    => __( 'Vertical Move Up', 'website-section-supporter' ),
					'down'  => __( 'Vertical Move Down', 'website-section-supporter' ),
					'left'  => __( 'Horizontal Move Left', 'website-section-supporter' ),
					'right' => __( 'Horizontal Move Right', 'website-section-supporter' ),
				),
				'condition' => array(
					'enable_parallax' => 'yes',
					'parallax_mode'   => 'scroll',
				),
			)
		);

		$this->add_control(
			'parallax_speed',
			array(
				'label'     => __( 'Parallax Speed / Strength', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 0.05,
						'max'  => 0.8,
						'step' => 0.01,
					),
				),
				'default'   => array( 'size' => 0.18 ),
				'condition' => array(
					'enable_parallax' => 'yes',
					'parallax_mode'   => array( 'scroll', 'zoom' ),
				),
			)
		);

		$this->add_control(
			'parallax_scale',
			array(
				'label'       => __( 'Image Bleed / Scale', 'website-section-supporter' ),
				'description' => __( 'Extra image scale inside container to prevent white borders during motion.', 'website-section-supporter' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => array(
					'px' => array(
						'min'  => 1.0,
						'max'  => 1.6,
						'step' => 0.01,
					),
				),
				'default'     => array( 'size' => 1.15 ),
				'condition'   => array(
					'enable_parallax' => 'yes',
					'parallax_mode!'  => 'fixed',
				),
			)
		);

		$this->add_control(
			'tilt_max',
			array(
				'label'     => __( '3D Tilt Max Angle (deg)', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 5,
						'max'  => 35,
						'step' => 1,
					),
				),
				'default'   => array( 'size' => 12 ),
				'condition' => array(
					'enable_parallax' => 'yes',
					'parallax_mode'   => 'tilt',
				),
			)
		);

		$this->add_control(
			'fixed_bg_pos',
			array(
				'label'     => __( 'Fixed Image Position', 'website-section-supporter' ),
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
					'{{WRAPPER}} .wss-parallax-fixed-img' => 'background-position: {{VALUE}} !important;',
				),
				'condition' => array(
					'enable_parallax' => 'yes',
					'parallax_mode'   => 'fixed',
				),
			)
		);

		$this->add_control(
			'fixed_bg_size',
			array(
				'label'     => __( 'Fixed Image Size', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'cover',
				'options'   => array(
					'cover'   => __( 'Cover', 'website-section-supporter' ),
					'contain' => __( 'Contain', 'website-section-supporter' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .wss-parallax-fixed-img' => 'background-size: {{VALUE}} !important;',
				),
				'condition' => array(
					'enable_parallax' => 'yes',
					'parallax_mode'   => 'fixed',
				),
			)
		);

		$this->add_control(
			'disable_parallax_mobile',
			array(
				'label'        => __( 'Disable Motion on Mobile', 'website-section-supporter' ),
				'description'  => __( 'Disables scroll/tilt movement on screens <= 768px for smoother touch performance.', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'website-section-supporter' ),
				'label_off'    => __( 'No', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array( 'enable_parallax' => 'yes' ),
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: SECTION ================= */
		$this->start_controls_section(
			'style_section',
			array( 'label' => __( 'Section', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_group_control( Group_Control_Background::get_type(), array( 'name' => 'section_bg', 'types' => array( 'classic', 'gradient' ), 'selector' => '{{WRAPPER}} .wss-pad' ) );
		$this->add_responsive_control(
			'section_padding',
			array(
				'label'      => __( 'Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'vw' ),
				'selectors'  => array( '{{WRAPPER}} .wss-pad' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ),
			)
		);
		$this->add_responsive_control(
			'columns_gap',
			array(
				'label'     => __( 'Gap Between Text & Media', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'size_units'=> array( 'px', 'vw' ),
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 200 ), 'vw' => array( 'min' => 0, 'max' => 15 ) ),
				'selectors' => array( '{{WRAPPER}} .wss-about' => 'gap: {{SIZE}}{{UNIT}};' ),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: TEXT ================= */
		$this->start_controls_section(
			'style_text',
			array( 'label' => __( 'Text & Typography', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_control( 'eyebrow_heading', array( 'label' => __( 'Eyebrow', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING ) );
		$this->add_control(
			'eyebrow_color',
			array(
				'label'     => __( 'Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-about .wss-eyebrow' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'eyebrow_typography',
				'selector' => '{{WRAPPER}} .wss-about .wss-eyebrow',
			)
		);
		$this->add_responsive_control(
			'eyebrow_spacing',
			array(
				'label'      => __( 'Bottom Spacing', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 60 ) ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-about .wss-eyebrow' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_control( 'heading_heading', array( 'label' => __( 'Heading', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_control(
			'heading_color',
			array(
				'label'     => __( 'Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-about-heading, {{WRAPPER}} .wss-about-heading .wss-mask, {{WRAPPER}} .wss-about-heading .wss-mask > span, {{WRAPPER}} .wss-about h1, {{WRAPPER}} .wss-about h2, {{WRAPPER}} .wss-about h3, {{WRAPPER}} .wss-about h4, {{WRAPPER}} .wss-about h5, {{WRAPPER}} .wss-about h6' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'heading_typography',
				'selector' => '{{WRAPPER}} .wss-about-heading, {{WRAPPER}} .wss-about-heading .wss-mask, {{WRAPPER}} .wss-about-heading .wss-mask > span, {{WRAPPER}} .wss-about h1, {{WRAPPER}} .wss-about h2, {{WRAPPER}} .wss-about h3, {{WRAPPER}} .wss-about h4, {{WRAPPER}} .wss-about h5, {{WRAPPER}} .wss-about h6',
			)
		);
		$this->add_responsive_control(
			'heading_spacing',
			array(
				'label'      => __( 'Bottom Spacing', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 80 ) ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-about-heading, {{WRAPPER}} .wss-about h2, {{WRAPPER}} .wss-about h1, {{WRAPPER}} .wss-about h3' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_control( 'desc_heading', array( 'label' => __( 'Description', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_control(
			'desc_color',
			array(
				'label'     => __( 'Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-about-desc, {{WRAPPER}} .wss-about-desc p, {{WRAPPER}} .wss-about p' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'desc_typography',
				'selector' => '{{WRAPPER}} .wss-about-desc, {{WRAPPER}} .wss-about-desc p, {{WRAPPER}} .wss-about p',
			)
		);
		$this->add_responsive_control(
			'desc_max_width',
			array(
				'label'      => __( 'Description Max Width', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em', 'vw' ),
				'range'      => array( 'px' => array( 'min' => 200, 'max' => 1200 ) ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-about-desc, {{WRAPPER}} .wss-about-desc p, {{WRAPPER}} .wss-about p' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: BUTTONS ================= */
		$this->start_controls_section(
			'style_buttons',
			array( 'label' => __( 'Buttons', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'btn_typography', 'selector' => '{{WRAPPER}} .wss-about-actions .wss-btn-pill' ) );
		$this->add_control(
			'btn_radius',
			array( 'label' => __( 'Border Radius', 'website-section-supporter' ), 'type' => Controls_Manager::SLIDER, 'range' => array( 'px' => array( 'min' => 0, 'max' => 60 ) ), 'selectors' => array( '{{WRAPPER}} .wss-about-actions .wss-btn-pill' => 'border-radius: {{SIZE}}{{UNIT}} !important;' ) )
		);
		$this->add_responsive_control(
			'btn_padding',
			array( 'label' => __( 'Padding', 'website-section-supporter' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array( 'px', 'em' ), 'selectors' => array( '{{WRAPPER}} .wss-about-actions .wss-btn-pill' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;' ) )
		);
		$this->add_responsive_control(
			'btn_gap',
			array( 'label' => __( 'Gap Between Buttons', 'website-section-supporter' ), 'type' => Controls_Manager::SLIDER, 'range' => array( 'px' => array( 'min' => 0, 'max' => 80 ) ), 'default' => array( 'size' => 24 ), 'selectors' => array( '{{WRAPPER}} .wss-about-actions' => 'gap: {{SIZE}}{{UNIT}};' ) )
		);

		/* Normal / Hover Tabs */
		$this->start_controls_tabs( 'tabs_about_btn_style' );
		$this->start_controls_tab(
			'tab_about_btn_normal',
			array( 'label' => __( 'Normal', 'website-section-supporter' ) )
		);
		$this->add_control( 'btn_color', array( 'label' => __( 'Text Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-about-actions .wss-btn-pill' => 'color: {{VALUE}} !important;' ) ) );
		$this->add_control( 'btn_bg', array( 'label' => __( 'Background Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-about-actions .wss-btn-pill' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;' ) ) );
		$this->add_control( 'btn_border_color', array( 'label' => __( 'Border Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-about-actions .wss-btn-pill' => 'border-color: {{VALUE}} !important;' ) ) );
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_about_btn_hover',
			array( 'label' => __( 'Hover', 'website-section-supporter' ) )
		);
		$this->add_control( 'btn_hover_color', array( 'label' => __( 'Hover Text Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-about-actions .wss-btn-pill:hover' => 'color: {{VALUE}} !important;' ) ) );
		$this->add_control( 'btn_hover_bg', array(
			'label'     => __( 'Hover Background / Effect Color', 'website-section-supporter' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => array(
				'{{WRAPPER}} .wss-about-actions .wss-btn-pill::before' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
			),
		) );
		$this->add_control( 'btn_hover_border_color', array( 'label' => __( 'Hover Border Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-about-actions .wss-btn-pill:hover' => 'border-color: {{VALUE}} !important;' ) ) );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/* ================= STYLE: MEDIA ================= */
		$this->start_controls_section(
			'style_media',
			array( 'label' => __( 'Media', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_control( 'img_heading', array( 'label' => __( 'Main Image', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING ) );

		$this->add_responsive_control(
			'img_aspect_ratio',
			array(
				'label'     => __( 'Aspect Ratio', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '4/5',
				'options'   => array(
					'4/5'   => '4:5 (Portrait Luxury)',
					'1/1'   => '1:1 (Square)',
					'3/4'   => '3:4 (Portrait Standard)',
					'2/3'   => '2:3 (Tall Portrait)',
					'16/11' => '16:11 (Landscape)',
					'16/9'  => '16:9 (Widescreen)',
					'auto'  => 'Auto / Custom Height',
				),
				'selectors' => array(
					'{{WRAPPER}} .wss-about-media .wss-img-cover, {{WRAPPER}} .wss-about-media .wss-img-reveal, {{WRAPPER}} .wss-about-media .wss-parallax-fixed-wrap' => 'aspect-ratio: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'img_custom_height',
			array(
				'label'      => __( 'Custom Min Height', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vh' ),
				'range'      => array(
					'px' => array( 'min' => 200, 'max' => 900 ),
					'vh' => array( 'min' => 20, 'max' => 100 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .wss-about-media .wss-img-cover, {{WRAPPER}} .wss-about-media .wss-img-reveal, {{WRAPPER}} .wss-about-media .wss-parallax-fixed-wrap' => 'min-height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control( Group_Control_Border::get_type(), array( 'name' => 'img_border', 'selector' => '{{WRAPPER}} .wss-about-media .wss-img-reveal' ) );
		$this->add_control(
			'img_radius',
			array( 'label' => __( 'Border Radius', 'website-section-supporter' ), 'type' => Controls_Manager::SLIDER, 'range' => array( 'px' => array( 'min' => 0, 'max' => 80 ) ), 'selectors' => array( '{{WRAPPER}} .wss-about-media .wss-img-reveal, {{WRAPPER}} .wss-about-media .wss-parallax-fixed-wrap, {{WRAPPER}} .wss-about-media .wss-parallax-fixed-img' => 'border-radius: {{SIZE}}{{UNIT}};' ) )
		);
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), array( 'name' => 'img_shadow', 'selector' => '{{WRAPPER}} .wss-about-media .wss-img-reveal' ) );

		$this->add_control( 'chip_heading', array( 'label' => __( 'Video Thumbnail', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before', 'condition' => array( 'show_video_chip' => 'yes' ) ) );
		$this->add_responsive_control(
			'chip_width',
			array( 'label' => __( 'Width', 'website-section-supporter' ), 'type' => Controls_Manager::SLIDER, 'range' => array( 'px' => array( 'min' => 60, 'max' => 320 ) ), 'default' => array( 'size' => 140 ), 'selectors' => array( '{{WRAPPER}} .wss-video-chip' => 'width: {{SIZE}}{{UNIT}};' ), 'condition' => array( 'show_video_chip' => 'yes' ) )
		);
		$this->add_control(
			'chip_border_color',
			array( 'label' => __( 'Border Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-video-chip' => 'border-color: {{VALUE}};' ), 'condition' => array( 'show_video_chip' => 'yes' ) )
		);
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();

		$tag             = ! empty( $s['heading_html_tag'] ) ? $s['heading_html_tag'] : 'h2';
		$enable_reveal   = ! empty( $s['enable_reveal'] ) && 'no' === $s['enable_reveal'] ? false : true;
		$enable_parallax = ! empty( $s['enable_parallax'] ) && 'yes' === $s['enable_parallax'];
		$parallax_mode   = ! empty( $s['parallax_mode'] ) ? $s['parallax_mode'] : 'scroll';
		$parallax_speed  = isset( $s['parallax_speed']['size'] ) ? floatval( $s['parallax_speed']['size'] ) : 0.18;
		$parallax_dir    = ! empty( $s['parallax_direction'] ) ? $s['parallax_direction'] : 'up';
		$disable_mobile  = ! empty( $s['disable_parallax_mobile'] ) && 'yes' === $s['disable_parallax_mobile'] ? 'yes' : 'no';
		$initial_scale   = isset( $s['parallax_scale']['size'] ) ? floatval( $s['parallax_scale']['size'] ) : 1.15;
		$tilt_max        = isset( $s['tilt_max']['size'] ) ? intval( $s['tilt_max']['size'] ) : 12;
		?>
		<div class="wss-scope">
			<section class="wss-pad">
				<div class="wss-container wss-about">
					<div class="<?php echo $enable_reveal ? 'wss-reveal' : ''; ?>">
						<?php if ( ! empty( $s['eyebrow'] ) ) : ?>
							<span class="wss-eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></span>
						<?php endif; ?>
						<?php if ( ! empty( $s['heading'] ) ) : ?>
							<<?php echo esc_attr( $tag ); ?> class="wss-about-heading"><span class="wss-mask"><span><?php echo nl2br( esc_html( $s['heading'] ) ); ?></span></span></<?php echo esc_attr( $tag ); ?>>
						<?php endif; ?>
						<?php if ( ! empty( $s['description'] ) ) : ?>
							<div class="wss-about-desc">
								<?php echo wp_kses_post( $s['description'] ); ?>
							</div>
						<?php endif; ?>
						<?php if ( ! empty( $s['btn1_text'] ) || ! empty( $s['btn2_text'] ) ) : ?>
							<div class="wss-about-actions">
								<?php if ( ! empty( $s['btn1_text'] ) ) : ?>
									<a href="<?php echo esc_url( $s['btn1_link']['url'] ?: '#' ); ?>"<?php echo ! empty( $s['btn1_link']['is_external'] ) ? ' target="_blank" rel="noopener"' : ''; ?> class="wss-btn-pill"><?php echo esc_html( $s['btn1_text'] ); ?> <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
								<?php endif; ?>
								<?php if ( ! empty( $s['btn2_text'] ) ) : ?>
									<a href="<?php echo esc_url( $s['btn2_link']['url'] ?: '#' ); ?>"<?php echo ! empty( $s['btn2_link']['is_external'] ) ? ' target="_blank" rel="noopener"' : ''; ?> class="wss-btn-pill"><?php echo esc_html( $s['btn2_text'] ); ?> <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
					<?php if ( ! empty( $s['main_image']['url'] ) ) : ?>
						<div class="wss-about-media wss-reveal wss-r2<?php echo $enable_parallax ? ' wss-has-parallax wss-parallax-' . esc_attr( $parallax_mode ) : ''; ?>"
							<?php if ( $enable_parallax ) : ?>
								data-parallax-mode="<?php echo esc_attr( $parallax_mode ); ?>"
								data-parallax-speed="<?php echo esc_attr( $parallax_speed ); ?>"
								data-parallax-direction="<?php echo esc_attr( $parallax_dir ); ?>"
								data-parallax-scale="<?php echo esc_attr( $initial_scale ); ?>"
								data-parallax-disable-mobile="<?php echo esc_attr( $disable_mobile ); ?>"
								data-tilt-max="<?php echo esc_attr( $tilt_max ); ?>"
							<?php endif; ?>
						>
							<?php if ( $enable_parallax && 'fixed' === $parallax_mode ) : ?>
								<div class="wss-img-reveal wss-parallax-fixed-wrap">
									<div class="wss-parallax-fixed-img" style="background-image: url('<?php echo esc_url( $s['main_image']['url'] ); ?>');"></div>
								</div>
							<?php else : ?>
								<div class="wss-img-reveal">
									<img class="wss-parallax-img" src="<?php echo esc_url( $s['main_image']['url'] ); ?>" alt="<?php echo esc_attr( $s['heading'] ); ?>" style="<?php echo $enable_parallax ? 'transform: scale(' . esc_attr( $initial_scale ) . ');' : ''; ?>">
								</div>
							<?php endif; ?>

							<?php if ( 'yes' === $s['show_video_chip'] && ! empty( $s['video_image']['url'] ) ) : ?>
								<div class="wss-video-chip wss-video-trigger" data-video-url="<?php echo esc_url( $s['video_link'] ); ?>">
									<img src="<?php echo esc_url( $s['video_image']['url'] ); ?>" alt="<?php echo esc_attr( $s['heading'] ); ?> preview">
									<div class="wss-play-overlay">
										<svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z" fill="currentColor"/></svg>
									</div>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			</section>
		</div>
		<?php
	}
}
