<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

class WSS_Header_Widget extends Widget_Base {

	public function get_name() { return 'wss_header'; }
	public function get_title() { return __( 'WSS — Site Header', 'website-section-supporter' ); }
	public function get_icon() { return 'eicon-header'; }
	public function get_categories() { return array( 'website-section-supporter' ); }
	public function get_keywords() { return array( 'header', 'nav', 'menu', 'logo' ); }

	private function get_available_menus() {
		$menus = wp_get_nav_menus();
		$options = array( '' => __( '— Select a Menu —', 'website-section-supporter' ) );
		if ( ! empty( $menus ) && ! is_wp_error( $menus ) ) {
			foreach ( $menus as $menu ) {
				$options[ $menu->slug ] = $menu->name;
			}
		}
		return $options;
	}

	protected function register_controls() {

		/* ================= LOGO ================= */
		$this->start_controls_section(
			'section_logo',
			array( 'label' => __( 'Logo', 'website-section-supporter' ) )
		);
		$this->add_control(
			'logo_type',
			array(
				'label'   => __( 'Logo Type', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'text',
				'options' => array(
					'text'  => __( 'Text', 'website-section-supporter' ),
					'image' => __( 'Image', 'website-section-supporter' ),
				),
			)
		);
		$this->add_control(
			'logo_image',
			array(
				'label'     => __( 'Logo Image', 'website-section-supporter' ),
				'type'      => Controls_Manager::MEDIA,
				'condition' => array( 'logo_type' => 'image' ),
			)
		);
		$this->add_control(
			'logo_bold',
			array(
				'label'     => __( 'Logo — Bold Part', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'NOIR', 'website-section-supporter' ),
				'condition' => array( 'logo_type' => 'text' ),
			)
		);
		$this->add_control(
			'logo_light',
			array(
				'label'     => __( 'Logo — Light Part', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'ESTATES', 'website-section-supporter' ),
				'condition' => array( 'logo_type' => 'text' ),
			)
		);
		$this->add_control(
			'logo_link',
			array(
				'label'   => __( 'Logo Link', 'website-section-supporter' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#' ),
			)
		);
		$this->add_control(
			'header_style',
			array(
				'label'   => __( 'Header Theme', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'light',
				'options' => array(
					'light'       => __( 'Solid Light', 'website-section-supporter' ),
					'dark'        => __( 'Solid Dark', 'website-section-supporter' ),
					'transparent' => __( 'Transparent (Overlaps Hero)', 'website-section-supporter' ),
				),
			)
		);
		$this->add_control(
			'transparent_condition',
			array(
				'label'     => __( 'Transparent Condition', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'all',
				'options'   => array(
					'all'     => __( 'Apply Everywhere', 'website-section-supporter' ),
					'include' => __( 'Only on Specific Page IDs', 'website-section-supporter' ),
					'exclude' => __( 'All Pages EXCEPT Specific IDs', 'website-section-supporter' ),
				),
				'condition' => array( 'header_style' => 'transparent' ),
			)
		);
		$this->add_control(
			'transparent_pages',
			array(
				'label'       => __( 'Page/Post IDs (comma separated)', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'description' => __( 'E.g. 12, 45, 89', 'website-section-supporter' ),
				'condition'   => array(
					'header_style' => 'transparent',
					'transparent_condition' => array( 'include', 'exclude' ),
				),
			)
		);
		$this->add_control(
			'enable_sticky',
			array(
				'label'   => __( 'Enable Luxury Sticky Effect', 'website-section-supporter' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);
		$this->end_controls_section();

		/* ================= INLINE MENU ================= */
		$this->start_controls_section(
			'section_inline_menu',
			array( 'label' => __( 'Inline Menu', 'website-section-supporter' ) )
		);
		$this->add_control(
			'show_inline_menu',
			array(
				'label'   => __( 'Show Inline Menu (Desktop)', 'website-section-supporter' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);
		$this->add_control(
			'inline_wp_menu',
			array(
				'label'     => __( 'Select WordPress Menu', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->get_available_menus(),
				'default'   => '',
				'condition' => array( 'show_inline_menu' => 'yes' ),
			)
		);
		$this->add_responsive_control(
			'inline_alignment',
			array(
				'label'     => __( 'Alignment', 'website-section-supporter' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array( 'title' => __( 'Left', 'website-section-supporter' ), 'icon' => 'eicon-text-align-left' ),
					'center'     => array( 'title' => __( 'Center', 'website-section-supporter' ), 'icon' => 'eicon-text-align-center' ),
					'flex-end'   => array( 'title' => __( 'Right', 'website-section-supporter' ), 'icon' => 'eicon-text-align-right' ),
				),
				'default'   => 'center',
				'selectors' => array( '{{WRAPPER}} .wss-inline-nav' => 'justify-content: {{VALUE}};' ),
				'condition' => array( 'show_inline_menu' => 'yes' ),
			)
		);
		$this->add_control(
			'dropdown_position',
			array(
				'label'     => __( 'Dropdown Position', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'left'  => __( 'Left', 'website-section-supporter' ),
					'right' => __( 'Right', 'website-section-supporter' ),
				),
				'default'   => 'left',
				'condition' => array( 'show_inline_menu' => 'yes' ),
			)
		);
		$this->end_controls_section();

		/* ================= POPUP MENU ================= */
		$this->start_controls_section(
			'section_popup_menu',
			array( 'label' => __( 'Popup Menu (Hamburger)', 'website-section-supporter' ) )
		);
		$this->add_control(
			'show_popup_menu',
			array(
				'label'   => __( 'Show Popup Menu', 'website-section-supporter' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);
		$this->add_control(
			'popup_wp_menu',
			array(
				'label'     => __( 'Select WordPress Menu', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->get_available_menus(),
				'default'   => '',
				'condition' => array( 'show_popup_menu' => 'yes' ),
			)
		);
		$this->add_control(
			'menu_bg_image',
			array(
				'label'     => __( 'Background Image (Left Panel)', 'website-section-supporter' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array( 'url' => 'https://picsum.photos/seed/noirmenu/900/1300' ),
				'condition' => array( 'show_popup_menu' => 'yes' ),
			)
		);
		$this->add_control(
			'menu_contact_text',
			array(
				'label'     => __( 'Bottom Info (HTML allowed)', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXTAREA,
				'default'   => "<p>+880 1XXX XXXXXX<br>advisory@noirestates.com</p>\n<p>Level 42, One Meridian Tower<br>Private Viewings by Appointment</p>",
				'condition' => array( 'show_popup_menu' => 'yes' ),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_cta',
			array( 'label' => __( 'Button (optional)', 'website-section-supporter' ) )
		);
		$this->add_control( 'show_cta', array( 'label' => __( 'Show Button', 'website-section-supporter' ), 'type' => Controls_Manager::SWITCHER, 'default' => '' ) );
		$this->add_control( 'cta_text', array( 'label' => __( 'Button Text', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'Book a Call', 'website-section-supporter' ), 'condition' => array( 'show_cta' => 'yes' ) ) );
		$this->add_control( 'cta_link', array( 'label' => __( 'Button Link', 'website-section-supporter' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => WSS_CREDIT_URL, 'is_external' => true ), 'condition' => array( 'show_cta' => 'yes' ) ) );
		$this->end_controls_section();

		/* ================= STYLE: BAR ================= */
		$this->start_controls_section(
			'style_bar',
			array( 'label' => __( 'Header Bar & Container', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_control(
			'container_width_type',
			array(
				'label'   => __( 'Container Width', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'boxed',
				'options' => array(
					'boxed'      => __( 'Boxed (Match Website Sections - 1400px)', 'website-section-supporter' ),
					'full_width' => __( 'Full Width', 'website-section-supporter' ),
				),
			)
		);
		$this->add_responsive_control(
			'container_max_width',
			array(
				'label'      => __( 'Container Max Width', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'vw' ),
				'range'      => array(
					'px' => array( 'min' => 500, 'max' => 2400, 'step' => 10 ),
					'%'  => array( 'min' => 50, 'max' => 100 ),
					'vw' => array( 'min' => 50, 'max' => 100 ),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 1400,
				),
				'condition'  => array(
					'container_width_type' => 'boxed',
				),
				'selectors'  => array(
					'{{WRAPPER}} .wss-header-inner.wss-container' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'bar_bg',
			array( 'label' => __( 'Background Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-header' => 'background: {{VALUE}};' ) )
		);
		$this->add_control(
			'bar_border_color',
			array( 'label' => __( 'Bottom Border Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-header' => 'border-bottom-color: {{VALUE}};' ) )
		);
		$this->add_responsive_control(
			'bar_padding',
			array(
				'label'      => __( 'Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'vw' ),
				'selectors'  => array( '{{WRAPPER}} .wss-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: LOGO ================= */
		$this->start_controls_section(
			'style_logo',
			array( 'label' => __( 'Logo', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_control(
			'logo_color',
			array( 'label' => __( 'Bold Part Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-logo' => 'color: {{VALUE}};' ) )
		);
		$this->add_control(
			'logo_light_color',
			array( 'label' => __( 'Light Part Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-logo span' => 'color: {{VALUE}};' ) )
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'logo_typography', 'selector' => '{{WRAPPER}} .wss-logo' )
		);
		$this->end_controls_section();

		/* ================= STYLE: INLINE MENU ITEMS ================= */
		$this->start_controls_section(
			'style_nav',
			array( 'label' => __( 'Inline Menu Items', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array( 'show_inline_menu' => 'yes' ) )
		);
		$this->add_control(
			'nav_color',
			array(
				'label'     => __( 'Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-inline-menu-links > li > a' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-inline-menu-links a'        => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'nav_hover_color',
			array(
				'label'     => __( 'Hover Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-inline-menu-links > li > a:hover' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-inline-menu-links a:hover'        => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-inline-menu-links > li:hover > a' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'nav_chevron_color',
			array(
				'label'     => __( 'Submenu Arrow Indicator Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-inline-menu-links .menu-item-has-children > a::after' => 'border-right-color: {{VALUE}} !important; border-bottom-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'nav_typography', 'selector' => '{{WRAPPER}} .wss-inline-menu-links > li > a' )
		);
		$this->add_responsive_control(
			'nav_gap',
			array(
				'label'     => __( 'Gap Between Items', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 100 ) ),
				'default'   => array( 'size' => 36 ),
				'selectors' => array( '{{WRAPPER}} .wss-inline-menu-links' => 'gap: {{SIZE}}{{UNIT}};' ),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: DROPDOWN SUB-MENU ================= */
		$this->start_controls_section(
			'style_dropdown',
			array( 'label' => __( 'Dropdown Sub-Menu', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array( 'show_inline_menu' => 'yes' ) )
		);
		$this->add_control(
			'dropdown_bg',
			array(
				'label'     => __( 'Dropdown Background', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-inline-menu-links .sub-menu' => 'background: {{VALUE}} !important;' ),
			)
		);
		$this->add_control(
			'dropdown_border_color',
			array(
				'label'     => __( 'Border & Top Accent Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-inline-menu-links .sub-menu' => 'border-color: {{VALUE}} !important; border-top-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'dropdown_item_color',
			array(
				'label'     => __( 'Item Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-inline-menu-links .sub-menu a' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'dropdown_item_hover_color',
			array(
				'label'     => __( 'Item Hover Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-inline-menu-links .sub-menu a:hover' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'dropdown_item_hover_bg',
			array(
				'label'     => __( 'Item Hover Background', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-inline-menu-links .sub-menu a:hover' => 'background: {{VALUE}} !important;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'dropdown_typography', 'selector' => '{{WRAPPER}} .wss-inline-menu-links .sub-menu a' )
		);
		$this->end_controls_section();

		/* ================= STYLE: HAMBURGER BUTTON ================= */
		$this->start_controls_section(
			'style_burger',
			array( 'label' => __( 'Hamburger Button', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array( 'show_popup_menu' => 'yes' ) )
		);
		$this->add_control(
			'burger_color',
			array(
				'label'     => __( 'Text & Lines Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-burger'           => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-burger .wss-bar'  => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'burger_hover_color',
			array(
				'label'     => __( 'Hover Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-burger:hover'          => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-burger:hover .wss-bar' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'burger_typography', 'selector' => '{{WRAPPER}} .wss-burger' )
		);
		$this->end_controls_section();

		/* ================= STYLE: POPUP FULLSCREEN MENU ================= */
		$this->start_controls_section(
			'style_popup_menu',
			array( 'label' => __( 'Popup Fullscreen Menu', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array( 'show_popup_menu' => 'yes' ) )
		);
		$this->add_control(
			'popup_bg_color',
			array(
				'label'     => __( 'Menu Right Panel Background', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'body #wss-menu, body #wss-menu .wss-menu-right' => 'background: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'popup_link_color',
			array(
				'label'     => __( 'Menu Links Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'body #wss-menu .wss-menu-links a, body #wss-menu .wss-menu-links > li > a' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'popup_link_hover_color',
			array(
				'label'     => __( 'Menu Links Hover Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'body #wss-menu .wss-menu-links a:hover, body #wss-menu .wss-menu-links > li > a:hover' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'popup_typography', 'selector' => 'body #wss-menu .wss-menu-links a' )
		);
		$this->add_control(
			'popup_close_color',
			array(
				'label'     => __( 'Close Button Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'body #wss-menu .wss-menu-close' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'popup_bottom_color',
			array(
				'label'     => __( 'Bottom Contact Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'body #wss-menu .wss-menu-bottom, body #wss-menu .wss-menu-bottom p' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: CTA BUTTON ================= */
		$this->start_controls_section(
			'style_cta',
			array( 'label' => __( 'Button', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array( 'show_cta' => 'yes' ) )
		);
		$this->add_control(
			'cta_color',
			array( 'label' => __( 'Text Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-header-cta' => 'color: {{VALUE}};' ) )
		);
		$this->add_control(
			'cta_bg',
			array( 'label' => __( 'Background Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-header-cta' => 'background: {{VALUE}};' ) )
		);
		$this->add_control(
			'cta_border_color',
			array( 'label' => __( 'Border Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-header-cta' => 'border-color: {{VALUE}};' ) )
		);
		$this->add_control(
			'cta_hover_color',
			array( 'label' => __( 'Hover Text Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-header-cta:hover' => 'color: {{VALUE}};' ) )
		);
		$this->add_control(
			'cta_hover_bg',
			array( 'label' => __( 'Hover Background', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-header-cta:hover' => 'background: {{VALUE}};' ) )
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'cta_typography', 'selector' => '{{WRAPPER}} .wss-header-cta' )
		);
		$this->add_control(
			'cta_radius',
			array(
				'label'      => __( 'Border Radius', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 60 ) ),
				'default'    => array( 'size' => 40 ),
				'selectors'  => array( '{{WRAPPER}} .wss-header-cta' => 'border-radius: {{SIZE}}{{UNIT}};' ),
			)
		);
		$this->add_responsive_control(
			'cta_padding',
			array(
				'label'      => __( 'Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array( '{{WRAPPER}} .wss-header-cta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ),
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		
		$style = ! empty( $s['header_style'] ) ? $s['header_style'] : 'light';
		if ( 'transparent' === $style ) {
			$cond = ! empty( $s['transparent_condition'] ) ? $s['transparent_condition'] : 'all';
			if ( 'all' !== $cond ) {
				$pages = ! empty( $s['transparent_pages'] ) ? array_map( 'trim', explode( ',', $s['transparent_pages'] ) ) : array();
				$current_id = (string) get_the_ID();
				
				if ( 'include' === $cond && ! in_array( $current_id, $pages, true ) ) {
					$style = 'light';
				} elseif ( 'exclude' === $cond && in_array( $current_id, $pages, true ) ) {
					$style = 'light';
				}
			}
		}

		$header_class = 'wss-header';
		if ( 'yes' === $s['enable_sticky'] ) {
			$header_class .= ' wss-header--sticky';
		}

		if ( 'transparent' === $style ) {
			$header_class .= ' wss-header--on-hero';
		} elseif ( 'dark' === $style ) {
			$header_class .= ' wss-header--dark-static';
		} else {
			$header_class .= ' wss-header--light-static';
		}
		$is_full_width = ! empty( $s['container_width_type'] ) && 'full_width' === $s['container_width_type'];
		$container_class = $is_full_width ? 'wss-header-inner wss-header-full' : 'wss-container wss-header-inner';
		?>
		<div class="wss-scope">
			<header id="siteHeader" class="<?php echo esc_attr( $header_class ); ?>">
				<div class="<?php echo esc_attr( $container_class ); ?>">
					<a class="wss-logo" href="<?php echo esc_url( $s['logo_link']['url'] ?: '#' ); ?>">
						<?php if ( 'image' === $s['logo_type'] && ! empty( $s['logo_image']['url'] ) ) : ?>
							<img src="<?php echo esc_url( $s['logo_image']['url'] ); ?>" alt="Logo">
						<?php else : ?>
							<?php echo esc_html( $s['logo_bold'] ); ?> <span><?php echo esc_html( $s['logo_light'] ); ?></span>
						<?php endif; ?>
					</a>
					<?php if ( 'yes' === $s['show_inline_menu'] ) : 
						$dropdown_align_class = ! empty( $s['dropdown_position'] ) && 'right' === $s['dropdown_position'] ? ' wss-dropdown-right' : ' wss-dropdown-left';
					?>
						<nav class="wss-inline-nav<?php echo esc_attr( $dropdown_align_class ); ?>">
							<?php
							if ( ! empty( $s['inline_wp_menu'] ) ) {
								wp_nav_menu( array(
									'menu'        => $s['inline_wp_menu'],
									'container'   => false,
									'menu_class'  => 'wss-inline-menu-links',
									'fallback_cb' => false,
								) );
							} else {
								echo '<ul class="wss-inline-menu-links"><li><a href="#">Select Inline Menu</a></li></ul>';
							}
							?>
						</nav>
					<?php endif; ?>

					<div class="wss-header-actions">
						<?php if ( 'yes' === ( $s['show_cta'] ?? '' ) && ! empty( $s['cta_text'] ) ) : ?>
							<a href="<?php echo esc_url( $s['cta_link']['url'] ?: '#' ); ?>"<?php echo ! empty( $s['cta_link']['is_external'] ) ? ' target="_blank" rel="noopener"' : ''; ?> class="wss-header-cta wss-btn-pill"><?php echo esc_html( $s['cta_text'] ); ?></a>
						<?php endif; ?>

						<?php if ( 'yes' === $s['show_popup_menu'] ) : ?>
							<button class="wss-burger" id="wss-menuBtn" aria-label="Open menu" type="button">
								<span class="wss-lines"><span class="wss-bar"></span><span class="wss-bar"></span></span>
								<span class="wss-burger-text">Menu</span>
							</button>
						<?php endif; ?>
					</div>
				</div>
			</header>

			<?php if ( 'yes' === $s['show_popup_menu'] ) : ?>
				<nav id="wss-menu">
					<div class="wss-menu-img wss-img-reveal">
						<?php if ( ! empty( $s['menu_bg_image']['url'] ) ) : ?>
							<img src="<?php echo esc_url( $s['menu_bg_image']['url'] ); ?>" alt="Menu Background">
						<?php endif; ?>
					</div>
					<div class="wss-menu-right">
						<div class="wss-menu-header">
							<a class="wss-menu-logo" href="<?php echo esc_url( $s['logo_link']['url'] ?: '#' ); ?>">
								<?php if ( 'image' === $s['logo_type'] && ! empty( $s['logo_image']['url'] ) ) : ?>
									<img src="<?php echo esc_url( $s['logo_image']['url'] ); ?>" alt="Logo">
								<?php else : ?>
									<?php echo esc_html( $s['logo_bold'] ); ?> <span><?php echo esc_html( $s['logo_light'] ); ?></span>
								<?php endif; ?>
							</a>
							<button class="wss-menu-close" id="wss-closeBtn" type="button" aria-label="Close menu">
								<span>Close Menu</span><span class="wss-menu-x"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></span>
							</button>
						</div>
						
						<?php
						if ( ! empty( $s['popup_wp_menu'] ) ) {
							wp_nav_menu( array(
								'menu'        => $s['popup_wp_menu'],
								'container'   => false,
								'menu_class'  => 'wss-menu-links',
								'fallback_cb' => false,
							) );
						} else {
							echo '<ul class="wss-menu-links"><li><a href="#">Select Popup Menu</a></li></ul>';
						}
						?>

						<?php if ( ! empty( $s['menu_contact_text'] ) ) : ?>
							<div class="wss-menu-bottom">
								<?php echo wp_kses_post( $s['menu_contact_text'] ); ?>
							</div>
						<?php endif; ?>
					</div>
				</nav>
			<?php endif; ?>
		</div>
		<?php
	}
}
