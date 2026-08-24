<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;

class WSS_Notable_Sales_Widget extends Widget_Base {

	public function get_name() { return 'wss_notable_sales'; }
	public function get_title() { return __( 'WSS — Notable Sales / Properties', 'website-section-supporter' ); }
	public function get_icon() { return 'eicon-posts-carousel'; }
	public function get_categories() { return array( 'website-section-supporter' ); }
	public function get_keywords() { return array( 'sales', 'properties', 'carousel', 'listings', 'idx', 'mls', 'shortcode' ); }

	protected function register_controls() {

		/* ================= CONTENT: SOURCE ================= */
		$this->start_controls_section(
			'section_source',
			array( 'label' => __( 'Content Source', 'website-section-supporter' ) )
		);
		$this->add_control(
			'source_type',
			array(
				'label'   => __( 'Properties Source', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'custom',
				'options' => array(
					'custom'    => __( 'Custom Property Cards (Repeater)', 'website-section-supporter' ),
					'shortcode' => __( 'Shortcode / IDX Feed (MLS, Showcase IDX, iHomefinder, etc.)', 'website-section-supporter' ),
				),
			)
		);
		$this->end_controls_section();

		/* ================= CONTENT: HEADING ================= */
		$this->start_controls_section( 'section_head', array( 'label' => __( 'Heading & Header', 'website-section-supporter' ) ) );
		$this->add_control(
			'show_heading',
			array(
				'label'        => __( 'Show Heading', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'website-section-supporter' ),
				'label_off'    => __( 'No', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);
		$this->add_control( 'eyebrow', array( 'label' => __( 'Eyebrow', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'Our', 'website-section-supporter' ), 'condition' => array( 'show_heading' => 'yes' ) ) );
		$this->add_control( 'heading', array( 'label' => __( 'Heading', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'Notable Sales', 'website-section-supporter' ), 'condition' => array( 'show_heading' => 'yes' ) ) );
		$this->add_control(
			'heading_html_tag',
			array(
				'label'     => __( 'Heading HTML Tag', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'h2',
				'options'   => array(
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
				'condition' => array( 'show_heading' => 'yes' ),
			)
		);
		
		$this->add_control(
			'show_nav_arrows',
			array(
				'label'        => __( 'Show Navigation Arrows', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'website-section-supporter' ),
				'label_off'    => __( 'No', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'source_type'  => 'custom',
					'show_heading' => 'yes',
				),
			)
		);

		$this->add_control(
			'show_cta_btn',
			array(
				'label'        => __( 'Show Bottom Button', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'website-section-supporter' ),
				'label_off'    => __( 'No', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			)
		);
		$this->add_control( 'cta_text', array( 'label' => __( 'Bottom Button Text', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'View All Sales', 'website-section-supporter' ), 'condition' => array( 'show_cta_btn' => 'yes' ) ) );
		$this->add_control( 'cta_link', array( 'label' => __( 'Bottom Button Link', 'website-section-supporter' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ), 'condition' => array( 'show_cta_btn' => 'yes' ) ) );
		$this->end_controls_section();

		/* ================= CONTENT: SHORTCODE / IDX ================= */
		$this->start_controls_section(
			'section_shortcode',
			array(
				'label'     => __( 'Shortcode / IDX Settings', 'website-section-supporter' ),
				'condition' => array(
					'source_type' => 'shortcode',
				),
			)
		);
		$this->add_control(
			'idx_shortcode',
			array(
				'label'       => __( 'IDX / MLS Shortcode', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 5,
				'default'     => '',
				'placeholder' => '[showcaseidx ...], [idx_listing_summary ...], [ihomefinder ...]',
				'description' => __( 'Enter any IDX, MLS, or custom plugin shortcode here. It will render in the properties section.', 'website-section-supporter' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);
		$this->add_responsive_control(
			'shortcode_min_height',
			array(
				'label'      => __( 'Min Height', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vh' ),
				'range'      => array(
					'px' => array( 'min' => 0, 'max' => 1200 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .wss-sales-shortcode-wrap' => 'min-height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		/* ================= CONTENT: CUSTOM PROPERTY CARDS ================= */
		$this->start_controls_section(
			'section_cards',
			array(
				'label'     => __( 'Property Cards', 'website-section-supporter' ),
				'condition' => array(
					'source_type' => 'custom',
				),
			)
		);
		$repeater = new Repeater();
		$repeater->add_control( 'image', array( 'label' => __( 'Image', 'website-section-supporter' ), 'type' => Controls_Manager::MEDIA, 'default' => array( 'url' => 'https://picsum.photos/seed/noirsale1/700/580' ) ) );
		$repeater->add_control( 'title', array( 'label' => __( 'Property Name', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'Villa Meridian', 'website-section-supporter' ) ) );
		$repeater->add_control( 'location', array( 'label' => __( 'Location', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'Cap Ferrat, France', 'website-section-supporter' ) ) );
		$repeater->add_control( 'price', array( 'label' => __( 'Price', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => '$58,000,000' ) );
		$repeater->add_control( 'link', array( 'label' => __( 'Link', 'website-section-supporter' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '' ) ) );

		$this->add_control(
			'cards',
			array(
				'label'       => __( 'Cards', 'website-section-supporter' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array( 'image' => array( 'url' => 'https://picsum.photos/seed/noirsale1/700/580' ), 'title' => 'Villa Meridian', 'location' => 'Cap Ferrat, France', 'price' => '$58,000,000' ),
					array( 'image' => array( 'url' => 'https://picsum.photos/seed/noirsale2/700/580' ), 'title' => 'The Hawthorne Estate', 'location' => 'Beverly Hills, USA', 'price' => '$49,500,000' ),
					array( 'image' => array( 'url' => 'https://picsum.photos/seed/noirsale3/700/580' ), 'title' => 'Undisclosed Address', 'location' => 'Beverly Hills, USA', 'price' => '$41,300,000' ),
				),
				'title_field' => '{{{ title }}}',
			)
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'card_image_size',
				'default'   => 'full',
				'separator' => 'before',
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
			array( 'label' => __( 'Padding', 'website-section-supporter' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array( 'px', '%', 'vw' ), 'selectors' => array( '{{WRAPPER}} .wss-pad' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ) )
		);
		$this->end_controls_section();

		/* ================= STYLE: HEADING ================= */
		$this->start_controls_section(
			'style_heading',
			array( 'label' => __( 'Heading', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_control( 'eyebrow_color', array( 'label' => __( 'Eyebrow Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-sales-head .wss-eyebrow' => 'color: {{VALUE}} !important;' ) ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'eyebrow_typography', 'selector' => '{{WRAPPER}} .wss-sales-head .wss-eyebrow' ) );
		$this->add_control( 'heading_color', array( 'label' => __( 'Heading Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-sales-head h1, {{WRAPPER}} .wss-sales-head h2, {{WRAPPER}} .wss-sales-head h3, {{WRAPPER}} .wss-sales-head h4, {{WRAPPER}} .wss-sales-head h5, {{WRAPPER}} .wss-sales-head h6, {{WRAPPER}} .wss-sales-head .wss-mask > span' => 'color: {{VALUE}} !important;' ) ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'heading_typography', 'selector' => '{{WRAPPER}} .wss-sales-head h1, {{WRAPPER}} .wss-sales-head h2, {{WRAPPER}} .wss-sales-head h3, {{WRAPPER}} .wss-sales-head h4, {{WRAPPER}} .wss-sales-head h5, {{WRAPPER}} .wss-sales-head h6, {{WRAPPER}} .wss-sales-head .wss-mask > span' ) );
		$this->end_controls_section();

		/* ================= STYLE: SHORTCODE CONTAINER ================= */
		$this->start_controls_section(
			'style_shortcode',
			array(
				'label'     => __( 'Shortcode Container', 'website-section-supporter' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'source_type' => 'shortcode',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'shortcode_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .wss-sales-shortcode-wrap',
			)
		);
		$this->add_responsive_control(
			'shortcode_padding',
			array(
				'label'      => __( 'Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-sales-shortcode-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'shortcode_border_radius',
			array(
				'label'      => __( 'Border Radius', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em' ),
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 50 ) ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-sales-shortcode-wrap' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: CARDS ================= */
		$this->start_controls_section(
			'style_cards',
			array(
				'label'     => __( 'Property Cards', 'website-section-supporter' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'source_type' => 'custom',
				),
			)
		);
		$this->add_responsive_control(
			'card_width',
			array(
				'label'      => __( 'Card Width', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'vw' ),
				'range'      => array(
					'px' => array( 'min' => 200, 'max' => 600 ),
					'%'  => array( 'min' => 20, 'max' => 100 ),
					'vw' => array( 'min' => 20, 'max' => 95 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .wss-sale-card' => 'flex: 0 0 {{SIZE}}{{UNIT}} !important; width: {{SIZE}}{{UNIT}} !important; min-width: {{SIZE}}{{UNIT}} !important; max-width: none !important;',
				),
			)
		);
		$this->add_responsive_control(
			'card_gap',
			array(
				'label'      => __( 'Gap Between Cards', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vw' ),
				'range'      => array(
					'px' => array( 'min' => 0, 'max' => 80 ),
					'vw' => array( 'min' => 0, 'max' => 10 ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .wss-sales-track' => 'gap: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);
		$this->add_responsive_control(
			'img_ratio',
			array(
				'label'     => __( 'Image Aspect Ratio (W / H)', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '4/3.4',
				'selectors' => array(
					'{{WRAPPER}} .wss-sale-card .wss-img-cover, {{WRAPPER}} .wss-sale-card .wss-img-reveal' => 'aspect-ratio: {{VALUE}} !important;',
				),
			)
		);
		$this->add_responsive_control(
			'img_radius',
			array(
				'label'      => __( 'Image Border Radius', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em' ),
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 60 ) ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-sale-card .wss-img-cover, {{WRAPPER}} .wss-sale-card .wss-img-reveal' => 'border-radius: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);
		$this->add_control( 'title_heading', array( 'label' => __( 'Title', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'title_typography', 'selector' => '{{WRAPPER}} .wss-sale-card h3' ) );
		$this->start_controls_tabs( 'tabs_sale_title_style' );
		$this->start_controls_tab( 'tab_sale_title_normal', array( 'label' => __( 'Normal', 'website-section-supporter' ) ) );
		$this->add_control( 'title_color', array( 'label' => __( 'Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'default' => '#ffffff', 'selectors' => array( '{{WRAPPER}} .wss-sale-card h3' => 'color: {{VALUE}};' ) ) );
		$this->end_controls_tab();
		$this->start_controls_tab( 'tab_sale_title_hover', array( 'label' => __( 'Hover', 'website-section-supporter' ) ) );
		$this->add_control( 'title_hover_color', array( 'label' => __( 'Hover Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-sale-card:hover h3' => 'color: {{VALUE}} !important;' ) ) );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control( 'loc_heading', array( 'label' => __( 'Location', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_control( 'loc_color', array( 'label' => __( 'Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-sale-card .wss-loc' => 'color: {{VALUE}};' ) ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'loc_typography', 'selector' => '{{WRAPPER}} .wss-sale-card .wss-loc' ) );
		$this->add_control( 'price_heading', array( 'label' => __( 'Price', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_control( 'price_color', array( 'label' => __( 'Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'default' => '#ffffff', 'selectors' => array( '{{WRAPPER}} .wss-sale-card .wss-price' => 'color: {{VALUE}};' ) ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'price_typography', 'selector' => '{{WRAPPER}} .wss-sale-card .wss-price' ) );
		$this->end_controls_section();

		/* ================= STYLE: NAV ARROWS ================= */
		$this->start_controls_section(
			'style_nav',
			array(
				'label'     => __( 'Nav Arrows', 'website-section-supporter' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'source_type' => 'custom',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_sales_nav_style' );
		$this->start_controls_tab( 'tab_sales_nav_normal', array( 'label' => __( 'Normal', 'website-section-supporter' ) ) );
		$this->add_control(
			'nav_color',
			array(
				'label'     => __( 'Icon & Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-sales-nav button, {{WRAPPER}} .wss-sales-nav button[type="button"]' => 'color: {{VALUE}} !important; border-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'nav_bg',
			array(
				'label'     => __( 'Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-sales-nav button, {{WRAPPER}} .wss-sales-nav button[type="button"]' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab( 'tab_sales_nav_hover', array( 'label' => __( 'Hover', 'website-section-supporter' ) ) );
		$this->add_control(
			'nav_hover_color',
			array(
				'label'     => __( 'Hover Icon Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-sales-nav button:hover, {{WRAPPER}} .wss-sales-nav button[type="button"]:hover, {{WRAPPER}} .wss-sales-nav button:focus' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'nav_hover_bg',
			array(
				'label'     => __( 'Hover Background', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-sales-nav button:hover, {{WRAPPER}} .wss-sales-nav button[type="button"]:hover, {{WRAPPER}} .wss-sales-nav button:focus' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important; border-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'nav_hover_border_color',
			array(
				'label'     => __( 'Hover Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-sales-nav button:hover, {{WRAPPER}} .wss-sales-nav button[type="button"]:hover, {{WRAPPER}} .wss-sales-nav button:focus' => 'border-color: {{VALUE}} !important;',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'nav_size',
			array(
				'label'     => __( 'Button Size', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 30, 'max' => 80 ) ),
				'default'   => array( 'size' => 46 ),
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .wss-sales-nav button, {{WRAPPER}} .wss-sales-nav button[type="button"]' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: CTA BUTTON ================= */
		$this->start_controls_section(
			'style_cta',
			array( 'label' => __( 'Bottom Button', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'cta_typography', 'selector' => '{{WRAPPER}} .wss-sales-cta .wss-btn-pill' ) );
		$this->add_control(
			'cta_radius',
			array( 'label' => __( 'Border Radius', 'website-section-supporter' ), 'type' => Controls_Manager::SLIDER, 'range' => array( 'px' => array( 'min' => 0, 'max' => 60 ) ), 'selectors' => array( '{{WRAPPER}} .wss-sales-cta .wss-btn-pill' => 'border-radius: {{SIZE}}{{UNIT}} !important;' ) )
		);
		$this->add_responsive_control(
			'cta_padding',
			array( 'label' => __( 'Padding', 'website-section-supporter' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array( 'px', 'em' ), 'selectors' => array( '{{WRAPPER}} .wss-sales-cta .wss-btn-pill' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;' ) )
		);

		/* Normal / Hover Tabs */
		$this->start_controls_tabs( 'tabs_sales_cta_style' );
		$this->start_controls_tab(
			'tab_sales_cta_normal',
			array( 'label' => __( 'Normal', 'website-section-supporter' ) )
		);
		$this->add_control( 'cta_color', array( 'label' => __( 'Text Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-sales-cta .wss-btn-pill' => 'color: {{VALUE}} !important;' ) ) );
		$this->add_control( 'cta_bg', array( 'label' => __( 'Background Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-sales-cta .wss-btn-pill' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;' ) ) );
		$this->add_control( 'cta_border_color', array( 'label' => __( 'Border Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-sales-cta .wss-btn-pill' => 'border-color: {{VALUE}} !important;' ) ) );
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_sales_cta_hover',
			array( 'label' => __( 'Hover', 'website-section-supporter' ) )
		);
		$this->add_control( 'cta_hover_color', array( 'label' => __( 'Hover Text Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-sales-cta .wss-btn-pill:hover' => 'color: {{VALUE}} !important;' ) ) );
		$this->add_control( 'cta_hover_bg', array(
			'label'     => __( 'Hover Background / Effect Color', 'website-section-supporter' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => array(
				'{{WRAPPER}} .wss-sales-cta .wss-btn-pill::before' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
			),
		) );
		$this->add_control( 'cta_hover_border_color', array( 'label' => __( 'Hover Border Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-sales-cta .wss-btn-pill:hover' => 'border-color: {{VALUE}} !important;' ) ) );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();

		$source_type  = ! empty( $s['source_type'] ) ? $s['source_type'] : 'custom';
		$show_heading = ! empty( $s['show_heading'] ) && 'yes' === $s['show_heading'];
		$show_nav     = ! empty( $s['show_nav_arrows'] ) && 'yes' === $s['show_nav_arrows'];
		$show_cta     = ! empty( $s['show_cta_btn'] ) && 'yes' === $s['show_cta_btn'];
		?>
		<div class="wss-scope">
			<section class="wss-pad wss-on-dark">
				<div class="wss-container wss-sales-wrap">

					<?php if ( $show_heading && ( ! empty( $s['heading'] ) || ! empty( $s['eyebrow'] ) ) ) : ?>
						<div class="wss-sales-head wss-reveal">
							<div>
								<?php if ( ! empty( $s['eyebrow'] ) ) : ?>
									<span class="wss-eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></span>
								<?php endif; ?>
								<?php if ( ! empty( $s['heading'] ) ) : ?>
									<?php $tag = ! empty( $s['heading_html_tag'] ) ? $s['heading_html_tag'] : 'h2'; ?>
									<<?php echo esc_attr( $tag ); ?>><span class="wss-mask"><span><?php echo esc_html( $s['heading'] ); ?></span></span></<?php echo esc_attr( $tag ); ?>>
								<?php endif; ?>
							</div>
							<?php if ( 'custom' === $source_type && $show_nav ) : ?>
								<div class="wss-sales-nav">
									<button type="button" class="wss-sales-prev" aria-label="Previous">
										<svg viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
									</button>
									<button type="button" class="wss-sales-next" aria-label="Next">
										<svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
									</button>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					<?php if ( 'shortcode' === $source_type ) : ?>
						<div class="wss-sales-shortcode-wrap wss-reveal">
							<?php
							$shortcode = ! empty( $s['idx_shortcode'] ) ? trim( $s['idx_shortcode'] ) : '';
							if ( ! empty( $shortcode ) ) {
								echo do_shortcode( $shortcode );
							} else {
								if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
									?>
									<div class="wss-shortcode-empty-notice">
										<p style="margin:0 0 8px; font-weight:600; font-size:16px; color:#fff;"><?php esc_html_e( 'IDX / MLS Shortcode Area', 'website-section-supporter' ); ?></p>
										<p style="margin:0;"><?php esc_html_e( 'Please enter your IDX, MLS, or custom shortcode in the widget settings panel (e.g. [showcaseidx ...], [idx_listing_summary ...], or [ihomefinder ...]).', 'website-section-supporter' ); ?></p>
									</div>
									<?php
								}
							}
							?>
						</div>
					<?php else : ?>
						<div class="wss-sales-track">
							<?php
							$cards = ! empty( $s['cards'] ) && is_array( $s['cards'] ) ? $s['cards'] : array();
							foreach ( $cards as $card ) :
								$has_link  = ! empty( $card['link']['url'] );
								$card_img  = '';
								if ( ! empty( $card['image']['id'] ) ) {
									$src = Group_Control_Image_Size::get_attachment_image_src( $card['image']['id'], 'card_image_size', $s );
									if ( ! empty( $src ) ) {
										$card_img = $src;
									} else {
										$full_data = wp_get_attachment_image_src( $card['image']['id'], 'full' );
										$card_img = ! empty( $full_data[0] ) ? $full_data[0] : '';
									}
								}
								if ( empty( $card_img ) && ! empty( $card['image']['url'] ) ) {
									$card_img = $card['image']['url'];
								}
								?>
								<div class="wss-sale-card wss-reveal">
									<div class="wss-img-reveal"><img src="<?php echo esc_url( $card_img ); ?>" alt="<?php echo esc_attr( ! empty( $card['title'] ) ? $card['title'] : '' ); ?>" loading="lazy" decoding="async"></div>
									<?php if ( $has_link ) : ?>
										<a href="<?php echo esc_url( $card['link']['url'] ); ?>"<?php echo ! empty( $card['link']['is_external'] ) ? ' target="_blank" rel="noopener"' : ''; ?>>
											<h3><?php echo esc_html( ! empty( $card['title'] ) ? $card['title'] : '' ); ?></h3>
										</a>
									<?php else : ?>
										<h3><?php echo esc_html( ! empty( $card['title'] ) ? $card['title'] : '' ); ?></h3>
									<?php endif; ?>
									<div class="wss-loc"><?php echo esc_html( ! empty( $card['location'] ) ? $card['location'] : '' ); ?></div>
									<div class="wss-price"><?php echo esc_html( ! empty( $card['price'] ) ? $card['price'] : '' ); ?></div>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<?php if ( $show_cta && ! empty( $s['cta_text'] ) ) : ?>
						<div class="wss-sales-cta">
							<a class="wss-btn-pill" href="<?php echo esc_url( ! empty( $s['cta_link']['url'] ) ? $s['cta_link']['url'] : '#' ); ?>"<?php echo ! empty( $s['cta_link']['is_external'] ) ? ' target="_blank" rel="noopener"' : ''; ?>><?php echo esc_html( $s['cta_text'] ); ?> <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
						</div>
					<?php endif; ?>

				</div>
			</section>
		</div>
		<?php
	}
}

