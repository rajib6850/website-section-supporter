<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

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

	private function get_available_pages() {
		$options = array(
			'front_page' => __( '🏠 Front / Home Page', 'website-section-supporter' ),
			'blog_page'  => __( '📰 Blog / Posts Page', 'website-section-supporter' ),
		);
		$pages = get_pages( array(
			'sort_column' => 'post_title',
			'sort_order'  => 'ASC',
			'post_status' => 'publish',
			'number'      => 300,
		) );
		if ( ! empty( $pages ) && ! is_wp_error( $pages ) ) {
			foreach ( $pages as $page ) {
				$options[ (string) $page->ID ] = $page->post_title . ' (ID: ' . $page->ID . ')';
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
				'label'     => __( 'Transparent Display Rules', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'all',
				'options'   => array(
					'all'     => __( 'Apply Everywhere (All Pages)', 'website-section-supporter' ),
					'include' => __( 'Inclusion: Only on Selected Pages', 'website-section-supporter' ),
					'exclude' => __( 'Exclusion: All Pages EXCEPT Selected', 'website-section-supporter' ),
				),
				'condition' => array( 'header_style' => 'transparent' ),
			)
		);
		$this->add_control(
			'transparent_selected_pages',
			array(
				'label'       => __( 'Select Specific Pages', 'website-section-supporter' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'options'     => $this->get_available_pages(),
				'label_block' => true,
				'condition'   => array(
					'header_style'          => 'transparent',
					'transparent_condition' => array( 'include', 'exclude' ),
				),
			)
		);
		$this->add_control(
			'transparent_pages',
			array(
				'label'       => __( 'Additional Custom Page/Post IDs', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'description' => __( 'Optional comma-separated IDs (e.g. 12, 45, 89)', 'website-section-supporter' ),
				'condition'   => array(
					'header_style'          => 'transparent',
					'transparent_condition' => array( 'include', 'exclude' ),
				),
			)
		);
		$this->add_control(
			'transparent_fallback_style',
			array(
				'label'       => __( 'Fallback Style for Non-Transparent Pages', 'website-section-supporter' ),
				'description' => __( 'Style applied when transparent rule is not active on a page.', 'website-section-supporter' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'light',
				'options'     => array(
					'light' => __( 'Solid Light', 'website-section-supporter' ),
					'dark'  => __( 'Solid Dark', 'website-section-supporter' ),
				),
				'condition'   => array(
					'header_style'          => 'transparent',
					'transparent_condition' => array( 'include', 'exclude' ),
				),
			)
		);
		$this->add_control(
			'transparent_fallback_position',
			array(
				'label'     => __( 'Fallback Header Position', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'relative',
				'options'   => array(
					'relative' => __( 'Normal Flow (Pushes Page Content Down)', 'website-section-supporter' ),
					'absolute' => __( 'Overlaps Page Top (Absolute)', 'website-section-supporter' ),
				),
				'condition' => array(
					'header_style'          => 'transparent',
					'transparent_condition' => array( 'include', 'exclude' ),
				),
			)
		);
		$this->end_controls_section();

		/* ================= STICKY HEADER SETTINGS ================= */
		$this->start_controls_section(
			'section_sticky_settings',
			array( 'label' => __( 'Sticky Header Settings', 'website-section-supporter' ) )
		);
		$this->add_control(
			'enable_sticky',
			array(
				'label'        => __( 'Enable Sticky Header', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'sticky_scroll_type',
			array(
				'label'     => __( 'Sticky Trigger Point', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'custom',
				'options'   => array(
					'custom'     => __( 'Custom Scroll Distance (px)', 'website-section-supporter' ),
					'after_hero' => __( 'Auto (After Hero Section)', 'website-section-supporter' ),
					'instant'    => __( 'Instant on Scroll (10px)', 'website-section-supporter' ),
				),
				'condition' => array( 'enable_sticky' => 'yes' ),
			)
		);
		$this->add_control(
			'sticky_scroll_threshold',
			array(
				'label'     => __( 'Scroll Threshold (px)', 'website-section-supporter' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 100,
				'min'       => 0,
				'max'       => 1000,
				'step'      => 10,
				'condition' => array(
					'enable_sticky'      => 'yes',
					'sticky_scroll_type' => 'custom',
				),
			)
		);
		$this->add_control(
			'sticky_behavior',
			array(
				'label'     => __( 'Sticky Behavior', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'always_sticky',
				'options'   => array(
					'always_sticky'       => __( 'Always Visible on Scroll Down', 'website-section-supporter' ),
					'hide_on_scroll_down' => __( 'Smart Header (Hide on Scroll Down, Show on Scroll Up)', 'website-section-supporter' ),
				),
				'condition' => array( 'enable_sticky' => 'yes' ),
			)
		);
		$this->add_control(
			'sticky_logo_type',
			array(
				'label'     => __( 'Sticky Logo Option', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'same',
				'options'   => array(
					'same'         => __( 'Same Logo as Default', 'website-section-supporter' ),
					'custom_image' => __( 'Custom Image Logo (for Sticky)', 'website-section-supporter' ),
					'custom_text'  => __( 'Custom Text Logo (for Sticky)', 'website-section-supporter' ),
				),
				'condition' => array( 'enable_sticky' => 'yes' ),
			)
		);
		$this->add_control(
			'sticky_logo_image',
			array(
				'label'     => __( 'Sticky Logo Image', 'website-section-supporter' ),
				'type'      => Controls_Manager::MEDIA,
				'condition' => array(
					'enable_sticky'    => 'yes',
					'sticky_logo_type' => 'custom_image',
				),
			)
		);
		$this->add_control(
			'sticky_logo_bold',
			array(
				'label'     => __( 'Sticky Logo — Bold Part', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'NOIR', 'website-section-supporter' ),
				'condition' => array(
					'enable_sticky'    => 'yes',
					'sticky_logo_type' => 'custom_text',
				),
			)
		);
		$this->add_control(
			'sticky_logo_light',
			array(
				'label'     => __( 'Sticky Logo — Light Part', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'ESTATES', 'website-section-supporter' ),
				'condition' => array(
					'enable_sticky'    => 'yes',
					'sticky_logo_type' => 'custom_text',
				),
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
			array(
				'label'     => __( 'Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-header:not(.wss-header--on-hero)' => 'background: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'bar_border_color',
			array(
				'label'     => __( 'Bottom Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-header:not(.wss-header--on-hero)' => 'border-bottom-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_responsive_control(
			'bar_padding',
			array(
				'label'      => __( 'Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'vw' ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
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
			array(
				'label'     => __( 'Bold Part Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-header:not(.wss-header--solid):not(.wss-is-sticky) .wss-logo, {{WRAPPER}} .wss-header:not(.wss-header--solid):not(.wss-is-sticky) .wss-logo-bold' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'logo_light_color',
			array(
				'label'     => __( 'Light Part Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-header:not(.wss-header--solid):not(.wss-is-sticky) .wss-logo-light' => 'color: {{VALUE}} !important;',
				),
			)
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
					'{{WRAPPER}} .wss-header:not(.wss-header--solid):not(.wss-is-sticky) .wss-inline-menu-links > li > a, {{WRAPPER}} .wss-header:not(.wss-header--solid):not(.wss-is-sticky) .wss-inline-menu-links a' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'nav_hover_color',
			array(
				'label'     => __( 'Hover Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-header:not(.wss-header--solid):not(.wss-is-sticky) .wss-inline-menu-links > li > a:hover, {{WRAPPER}} .wss-header:not(.wss-header--solid):not(.wss-is-sticky) .wss-inline-menu-links a:hover, {{WRAPPER}} .wss-header:not(.wss-header--solid):not(.wss-is-sticky) .wss-inline-menu-links > li:hover > a' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'nav_chevron_color',
			array(
				'label'     => __( 'Submenu Arrow Indicator Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-header:not(.wss-header--solid):not(.wss-is-sticky) .wss-inline-menu-links .menu-item-has-children > a::after' => 'border-right-color: {{VALUE}} !important; border-bottom-color: {{VALUE}} !important;',
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
					'{{WRAPPER}} .wss-header:not(.wss-header--solid):not(.wss-is-sticky) .wss-burger'          => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-header:not(.wss-header--solid):not(.wss-is-sticky) .wss-burger .wss-bar' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'burger_hover_color',
			array(
				'label'     => __( 'Hover Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-header:not(.wss-header--solid):not(.wss-is-sticky) .wss-burger:hover'          => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-header:not(.wss-header--solid):not(.wss-is-sticky) .wss-burger:hover .wss-bar' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
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
			array(
				'label'     => __( 'Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-header:not(.wss-header--solid):not(.wss-is-sticky) .wss-header-cta' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'cta_bg',
			array(
				'label'     => __( 'Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-header:not(.wss-header--solid):not(.wss-is-sticky) .wss-header-cta' => 'background: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'cta_border_color',
			array(
				'label'     => __( 'Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-header:not(.wss-header--solid):not(.wss-is-sticky) .wss-header-cta' => 'border-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'cta_hover_color',
			array(
				'label'     => __( 'Hover Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-header:not(.wss-header--solid):not(.wss-is-sticky) .wss-header-cta:hover' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'cta_hover_bg',
			array(
				'label'     => __( 'Hover Background', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-header:not(.wss-header--solid):not(.wss-is-sticky) .wss-header-cta:hover' => 'background: {{VALUE}} !important;',
				),
			)
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

		/* ================= STYLE: FALLBACK HEADER (NON-TRANSPARENT PAGES) ================= */
		$this->start_controls_section(
			'style_fallback_header',
			array(
				'label'     => __( 'Fallback Header (Non-Transparent Pages)', 'website-section-supporter' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'header_style'          => 'transparent',
					'transparent_condition' => array( 'include', 'exclude' ),
				),
			)
		);
		$this->add_control(
			'fallback_bar_bg',
			array(
				'label'     => __( 'Custom Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-header.wss-header--light-static:not(.wss-header--solid):not(.wss-is-sticky), {{WRAPPER}} .wss-header.wss-header--dark-static:not(.wss-header--solid):not(.wss-is-sticky)' => 'background: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'fallback_border_color',
			array(
				'label'     => __( 'Bottom Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-header.wss-header--light-static:not(.wss-header--solid):not(.wss-is-sticky), {{WRAPPER}} .wss-header.wss-header--dark-static:not(.wss-header--solid):not(.wss-is-sticky)' => 'border-bottom-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'fallback_logo_color',
			array(
				'label'     => __( 'Logo Bold Part Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-header.wss-header--light-static:not(.wss-header--solid):not(.wss-is-sticky) .wss-logo, {{WRAPPER}} .wss-header.wss-header--light-static:not(.wss-header--solid):not(.wss-is-sticky) .wss-logo-bold, {{WRAPPER}} .wss-header.wss-header--dark-static:not(.wss-header--solid):not(.wss-is-sticky) .wss-logo, {{WRAPPER}} .wss-header.wss-header--dark-static:not(.wss-header--solid):not(.wss-is-sticky) .wss-logo-bold' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'fallback_logo_light_color',
			array(
				'label'     => __( 'Logo Light Part Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-header.wss-header--light-static:not(.wss-header--solid):not(.wss-is-sticky) .wss-logo-light, {{WRAPPER}} .wss-header.wss-header--dark-static:not(.wss-header--solid):not(.wss-is-sticky) .wss-logo-light' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'fallback_nav_color',
			array(
				'label'     => __( 'Menu Links Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array( 'show_inline_menu' => 'yes' ),
				'selectors' => array(
					'{{WRAPPER}} .wss-header.wss-header--light-static:not(.wss-header--solid):not(.wss-is-sticky) .wss-inline-menu-links > li > a, {{WRAPPER}} .wss-header.wss-header--light-static:not(.wss-header--solid):not(.wss-is-sticky) .wss-inline-menu-links a, {{WRAPPER}} .wss-header.wss-header--dark-static:not(.wss-header--solid):not(.wss-is-sticky) .wss-inline-menu-links > li > a, {{WRAPPER}} .wss-header.wss-header--dark-static:not(.wss-header--solid):not(.wss-is-sticky) .wss-inline-menu-links a' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'fallback_nav_hover_color',
			array(
				'label'     => __( 'Menu Links Hover Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array( 'show_inline_menu' => 'yes' ),
				'selectors' => array(
					'{{WRAPPER}} .wss-header.wss-header--light-static:not(.wss-header--solid):not(.wss-is-sticky) .wss-inline-menu-links > li > a:hover, {{WRAPPER}} .wss-header.wss-header--light-static:not(.wss-header--solid):not(.wss-is-sticky) .wss-inline-menu-links a:hover, {{WRAPPER}} .wss-header.wss-header--dark-static:not(.wss-header--solid):not(.wss-is-sticky) .wss-inline-menu-links > li > a:hover, {{WRAPPER}} .wss-header.wss-header--dark-static:not(.wss-header--solid):not(.wss-is-sticky) .wss-inline-menu-links a:hover' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'fallback_burger_color',
			array(
				'label'     => __( 'Hamburger Text & Lines Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array( 'show_popup_menu' => 'yes' ),
				'selectors' => array(
					'{{WRAPPER}} .wss-header.wss-header--light-static:not(.wss-header--solid):not(.wss-is-sticky) .wss-burger, {{WRAPPER}} .wss-header.wss-header--dark-static:not(.wss-header--solid):not(.wss-is-sticky) .wss-burger'                   => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-header.wss-header--light-static:not(.wss-header--solid):not(.wss-is-sticky) .wss-burger .wss-bar, {{WRAPPER}} .wss-header.wss-header--dark-static:not(.wss-header--solid):not(.wss-is-sticky) .wss-burger .wss-bar' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'fallback_cta_color',
			array(
				'label'     => __( 'CTA Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array( 'show_cta' => 'yes' ),
				'selectors' => array(
					'{{WRAPPER}} .wss-header.wss-header--light-static:not(.wss-header--solid):not(.wss-is-sticky) .wss-header-cta, {{WRAPPER}} .wss-header.wss-header--dark-static:not(.wss-header--solid):not(.wss-is-sticky) .wss-header-cta' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'fallback_cta_bg',
			array(
				'label'     => __( 'CTA Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array( 'show_cta' => 'yes' ),
				'selectors' => array(
					'{{WRAPPER}} .wss-header.wss-header--light-static:not(.wss-header--solid):not(.wss-is-sticky) .wss-header-cta, {{WRAPPER}} .wss-header.wss-header--dark-static:not(.wss-header--solid):not(.wss-is-sticky) .wss-header-cta' => 'background: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'fallback_cta_border_color',
			array(
				'label'     => __( 'CTA Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array( 'show_cta' => 'yes' ),
				'selectors' => array(
					'{{WRAPPER}} .wss-header.wss-header--light-static:not(.wss-header--solid):not(.wss-is-sticky) .wss-header-cta, {{WRAPPER}} .wss-header.wss-header--dark-static:not(.wss-header--solid):not(.wss-is-sticky) .wss-header-cta' => 'border-color: {{VALUE}} !important;',
				),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: STICKY HEADER (ON SCROLL) ================= */
		$this->start_controls_section(
			'style_sticky_header',
			array(
				'label'     => __( 'Sticky Header (On Scroll)', 'website-section-supporter' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array( 'enable_sticky' => 'yes' ),
			)
		);
		$this->add_control(
			'sticky_bar_bg',
			array(
				'label'     => __( 'Sticky Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-header.wss-header--solid, {{WRAPPER}} .wss-header.wss-is-sticky' => 'background: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'sticky_backdrop_blur',
			array(
				'label'      => __( 'Sticky Backdrop Blur (px)', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 30 ) ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-header.wss-header--solid, {{WRAPPER}} .wss-header.wss-is-sticky' => 'backdrop-filter: blur({{SIZE}}px) !important; -webkit-backdrop-filter: blur({{SIZE}}px) !important;',
				),
			)
		);
		$this->add_control(
			'sticky_border_color',
			array(
				'label'     => __( 'Sticky Bottom Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-header.wss-header--solid, {{WRAPPER}} .wss-header.wss-is-sticky' => 'border-bottom-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_responsive_control(
			'sticky_bar_padding',
			array(
				'label'      => __( 'Sticky Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'vw' ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-header.wss-header--solid, {{WRAPPER}} .wss-header.wss-is-sticky' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'sticky_box_shadow',
				'label'    => __( 'Sticky Box Shadow', 'website-section-supporter' ),
				'selector' => '{{WRAPPER}} .wss-header.wss-header--solid, {{WRAPPER}} .wss-header.wss-is-sticky',
			)
		);
		$this->add_control(
			'heading_sticky_logo',
			array(
				'label'     => __( 'Sticky Logo Colors', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'sticky_logo_color',
			array(
				'label'     => __( 'Logo Bold Part Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-header.wss-header--solid .wss-logo, {{WRAPPER}} .wss-header.wss-header--solid .wss-logo-bold, {{WRAPPER}} .wss-header.wss-is-sticky .wss-logo, {{WRAPPER}} .wss-header.wss-is-sticky .wss-logo-bold' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'sticky_logo_light_color',
			array(
				'label'     => __( 'Logo Light Part Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-header.wss-header--solid .wss-logo .wss-logo-light, {{WRAPPER}} .wss-header.wss-is-sticky .wss-logo .wss-logo-light' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'heading_sticky_menu',
			array(
				'label'     => __( 'Sticky Menu Items', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array( 'show_inline_menu' => 'yes' ),
			)
		);
		$this->add_control(
			'sticky_nav_color',
			array(
				'label'     => __( 'Menu Links Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array( 'show_inline_menu' => 'yes' ),
				'selectors' => array(
					'{{WRAPPER}} .wss-header.wss-header--solid .wss-inline-menu-links > li > a, {{WRAPPER}} .wss-header.wss-is-sticky .wss-inline-menu-links > li > a, {{WRAPPER}} .wss-header.wss-header--solid .wss-inline-menu-links a, {{WRAPPER}} .wss-header.wss-is-sticky .wss-inline-menu-links a' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'sticky_nav_hover_color',
			array(
				'label'     => __( 'Menu Links Hover Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array( 'show_inline_menu' => 'yes' ),
				'selectors' => array(
					'{{WRAPPER}} .wss-header.wss-header--solid .wss-inline-menu-links > li > a:hover, {{WRAPPER}} .wss-header.wss-is-sticky .wss-inline-menu-links > li > a:hover, {{WRAPPER}} .wss-header.wss-header--solid .wss-inline-menu-links a:hover, {{WRAPPER}} .wss-header.wss-is-sticky .wss-inline-menu-links a:hover, {{WRAPPER}} .wss-header.wss-header--solid .wss-inline-menu-links > li:hover > a, {{WRAPPER}} .wss-header.wss-is-sticky .wss-inline-menu-links > li:hover > a' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'sticky_nav_chevron_color',
			array(
				'label'     => __( 'Submenu Arrow Indicator Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array( 'show_inline_menu' => 'yes' ),
				'selectors' => array(
					'{{WRAPPER}} .wss-header.wss-header--solid .wss-inline-menu-links .menu-item-has-children > a::after, {{WRAPPER}} .wss-header.wss-is-sticky .wss-inline-menu-links .menu-item-has-children > a::after' => 'border-right-color: {{VALUE}} !important; border-bottom-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'heading_sticky_dropdown',
			array(
				'label'     => __( 'Sticky Sub-Menu Dropdown', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array( 'show_inline_menu' => 'yes' ),
			)
		);
		$this->add_control(
			'sticky_dropdown_bg',
			array(
				'label'     => __( 'Dropdown Background', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array( 'show_inline_menu' => 'yes' ),
				'selectors' => array(
					'{{WRAPPER}} .wss-header.wss-header--solid .wss-inline-menu-links .sub-menu, {{WRAPPER}} .wss-header.wss-is-sticky .wss-inline-menu-links .sub-menu' => 'background: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'sticky_dropdown_border_color',
			array(
				'label'     => __( 'Dropdown Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array( 'show_inline_menu' => 'yes' ),
				'selectors' => array(
					'{{WRAPPER}} .wss-header.wss-header--solid .wss-inline-menu-links .sub-menu, {{WRAPPER}} .wss-header.wss-is-sticky .wss-inline-menu-links .sub-menu' => 'border-color: {{VALUE}} !important; border-top-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'sticky_dropdown_item_color',
			array(
				'label'     => __( 'Item Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array( 'show_inline_menu' => 'yes' ),
				'selectors' => array(
					'{{WRAPPER}} .wss-header.wss-header--solid .wss-inline-menu-links .sub-menu a, {{WRAPPER}} .wss-header.wss-is-sticky .wss-inline-menu-links .sub-menu a' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'sticky_dropdown_item_hover_color',
			array(
				'label'     => __( 'Item Hover Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array( 'show_inline_menu' => 'yes' ),
				'selectors' => array(
					'{{WRAPPER}} .wss-header.wss-header--solid .wss-inline-menu-links .sub-menu a:hover, {{WRAPPER}} .wss-header.wss-is-sticky .wss-inline-menu-links .sub-menu a:hover' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'sticky_dropdown_item_hover_bg',
			array(
				'label'     => __( 'Item Hover Background', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array( 'show_inline_menu' => 'yes' ),
				'selectors' => array(
					'{{WRAPPER}} .wss-header.wss-header--solid .wss-inline-menu-links .sub-menu a:hover, {{WRAPPER}} .wss-header.wss-is-sticky .wss-inline-menu-links .sub-menu a:hover' => 'background: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'heading_sticky_burger',
			array(
				'label'     => __( 'Sticky Hamburger Button', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array( 'show_popup_menu' => 'yes' ),
			)
		);
		$this->add_control(
			'sticky_burger_color',
			array(
				'label'     => __( 'Hamburger Text & Lines Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array( 'show_popup_menu' => 'yes' ),
				'selectors' => array(
					'{{WRAPPER}} .wss-header.wss-header--solid .wss-burger, {{WRAPPER}} .wss-header.wss-is-sticky .wss-burger'                   => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-header.wss-header--solid .wss-burger .wss-bar, {{WRAPPER}} .wss-header.wss-is-sticky .wss-burger .wss-bar' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'sticky_burger_hover_color',
			array(
				'label'     => __( 'Hamburger Hover Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array( 'show_popup_menu' => 'yes' ),
				'selectors' => array(
					'{{WRAPPER}} .wss-header.wss-header--solid .wss-burger:hover, {{WRAPPER}} .wss-header.wss-is-sticky .wss-burger:hover'                   => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-header.wss-header--solid .wss-burger:hover .wss-bar, {{WRAPPER}} .wss-header.wss-is-sticky .wss-burger:hover .wss-bar' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'heading_sticky_cta',
			array(
				'label'     => __( 'Sticky CTA Button', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array( 'show_cta' => 'yes' ),
			)
		);
		$this->add_control(
			'sticky_cta_color',
			array(
				'label'     => __( 'CTA Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array( 'show_cta' => 'yes' ),
				'selectors' => array(
					'{{WRAPPER}} .wss-header.wss-header--solid .wss-header-cta, {{WRAPPER}} .wss-header.wss-is-sticky .wss-header-cta' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'sticky_cta_bg',
			array(
				'label'     => __( 'CTA Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array( 'show_cta' => 'yes' ),
				'selectors' => array(
					'{{WRAPPER}} .wss-header.wss-header--solid .wss-header-cta, {{WRAPPER}} .wss-header.wss-is-sticky .wss-header-cta' => 'background: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'sticky_cta_border_color',
			array(
				'label'     => __( 'CTA Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array( 'show_cta' => 'yes' ),
				'selectors' => array(
					'{{WRAPPER}} .wss-header.wss-header--solid .wss-header-cta, {{WRAPPER}} .wss-header.wss-is-sticky .wss-header-cta' => 'border-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'sticky_cta_hover_color',
			array(
				'label'     => __( 'CTA Hover Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array( 'show_cta' => 'yes' ),
				'selectors' => array(
					'{{WRAPPER}} .wss-header.wss-header--solid .wss-header-cta:hover, {{WRAPPER}} .wss-header.wss-is-sticky .wss-header-cta:hover' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'sticky_cta_hover_bg',
			array(
				'label'     => __( 'CTA Hover Background', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array( 'show_cta' => 'yes' ),
				'selectors' => array(
					'{{WRAPPER}} .wss-header.wss-header--solid .wss-header-cta:hover, {{WRAPPER}} .wss-header.wss-is-sticky .wss-header-cta:hover' => 'background: {{VALUE}} !important;',
				),
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		
		$style = ! empty( $s['header_style'] ) ? $s['header_style'] : 'light';

		$is_edit_mode = false;
		if ( class_exists( '\Elementor\Plugin' ) && isset( \Elementor\Plugin::$instance->editor ) ) {
			$is_edit_mode = \Elementor\Plugin::$instance->editor->is_edit_mode();
		}

		if ( 'transparent' === $style ) {
			$cond = ! empty( $s['transparent_condition'] ) ? $s['transparent_condition'] : 'all';
			if ( 'all' !== $cond ) {
				$selected_pages = ! empty( $s['transparent_selected_pages'] ) ? (array) $s['transparent_selected_pages'] : array();
				if ( ! empty( $s['transparent_pages'] ) ) {
					$legacy_ids     = array_map( 'trim', explode( ',', $s['transparent_pages'] ) );
					$selected_pages = array_merge( $selected_pages, $legacy_ids );
				}
				$selected_pages = array_filter( array_map( 'strval', $selected_pages ) );

				$is_match = false;

				// Determine current visited/queried post ID
				$queried_id = get_queried_object_id();
				$the_id     = function_exists( 'get_the_ID' ) ? get_the_ID() : 0;
				$current_id = $queried_id ? (string) $queried_id : (string) $the_id;

				// 1. Check front page / home page
				$is_front = is_front_page() || ( is_home() && ! is_paged() );
				$front_id = (string) get_option( 'page_on_front' );
				$blog_id  = (string) get_option( 'page_for_posts' );

				if ( $is_front && ( in_array( 'front_page', $selected_pages, true ) || ( $front_id && in_array( $front_id, $selected_pages, true ) ) ) ) {
					$is_match = true;
				}

				// 2. Check blog posts page
				if ( is_home() && ( in_array( 'blog_page', $selected_pages, true ) || ( $blog_id && in_array( $blog_id, $selected_pages, true ) ) ) ) {
					$is_match = true;
				}

				// 3. Check current queried object ID (covers Pages, Posts, CPTs, HFE headers)
				if ( ! empty( $current_id ) && in_array( $current_id, $selected_pages, true ) ) {
					$is_match = true;
				}

				// 4. Fallback check for standard get_the_ID()
				if ( ! empty( $the_id ) && in_array( (string) $the_id, $selected_pages, true ) ) {
					$is_match = true;
				}

				$fallback = ! empty( $s['transparent_fallback_style'] ) ? $s['transparent_fallback_style'] : 'light';

				if ( 'include' === $cond ) {
					$style = $is_match ? 'transparent' : $fallback;
				} elseif ( 'exclude' === $cond ) {
					$style = $is_match ? $fallback : 'transparent';
				}
			}
		}

		$is_sticky = ( 'yes' === ( $s['enable_sticky'] ?? 'yes' ) );
		$header_class = 'wss-header';
		if ( $is_sticky ) {
			$header_class .= ' wss-header--sticky';
		}

		if ( 'transparent' === $style ) {
			$header_class .= ' wss-header--on-hero';
		} elseif ( 'dark' === $style ) {
			$header_class .= ' wss-header--dark-static';
		} else {
			$header_class .= ' wss-header--light-static';
		}

		$fallback_pos = $s['transparent_fallback_position'] ?? 'relative';
		if ( 'transparent' !== $style && 'absolute' !== $fallback_pos ) {
			$header_class .= ' wss-header--relative';
		}

		$is_full_width = ! empty( $s['container_width_type'] ) && 'full_width' === $s['container_width_type'];
		$container_class = $is_full_width ? 'wss-header-inner wss-header-full' : 'wss-container wss-header-inner';

		$sticky_type     = $s['sticky_scroll_type'] ?? 'custom';
		$sticky_thresh   = ! empty( $s['sticky_scroll_threshold'] ) ? intval( $s['sticky_scroll_threshold'] ) : 100;
		$sticky_behavior = $s['sticky_behavior'] ?? 'always_sticky';
		$sticky_logo_type = $s['sticky_logo_type'] ?? 'same';
		$has_custom_sticky_logo = $is_sticky && ( 'same' !== $sticky_logo_type );
		?>
		<div class="wss-scope">
			<header id="siteHeader" class="<?php echo esc_attr( $header_class ); ?>"
				data-wss-sticky="<?php echo $is_sticky ? 'yes' : 'no'; ?>"
				data-sticky-type="<?php echo esc_attr( $sticky_type ); ?>"
				data-sticky-thresh="<?php echo esc_attr( $sticky_thresh ); ?>"
				data-sticky-behavior="<?php echo esc_attr( $sticky_behavior ); ?>"
			>
				<div class="<?php echo esc_attr( $container_class ); ?>">
					<a class="wss-logo<?php echo $has_custom_sticky_logo ? ' wss-has-sticky-logo' : ''; ?>" href="<?php echo esc_url( $s['logo_link']['url'] ?: '#' ); ?>">
						<span class="wss-logo-normal">
							<?php if ( 'image' === $s['logo_type'] && ! empty( $s['logo_image']['url'] ) ) : ?>
								<img src="<?php echo esc_url( $s['logo_image']['url'] ); ?>" alt="Logo">
							<?php else : ?>
								<span class="wss-logo-bold"><?php echo esc_html( $s['logo_bold'] ); ?></span> <span class="wss-logo-light"><?php echo esc_html( $s['logo_light'] ); ?></span>
							<?php endif; ?>
						</span>

						<?php if ( $has_custom_sticky_logo ) : ?>
							<span class="wss-logo-sticky">
								<?php if ( 'custom_image' === $sticky_logo_type && ! empty( $s['sticky_logo_image']['url'] ) ) : ?>
									<img src="<?php echo esc_url( $s['sticky_logo_image']['url'] ); ?>" alt="Sticky Logo">
								<?php else : ?>
									<span class="wss-logo-bold"><?php echo esc_html( $s['sticky_logo_bold'] ?? $s['logo_bold'] ); ?></span> <span class="wss-logo-light"><?php echo esc_html( $s['sticky_logo_light'] ?? $s['logo_light'] ); ?></span>
								<?php endif; ?>
							</span>
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
									<span class="wss-logo-bold"><?php echo esc_html( $s['logo_bold'] ); ?></span> <span class="wss-logo-light"><?php echo esc_html( $s['logo_light'] ); ?></span>
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
