<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

class WSS_Footer_Widget extends Widget_Base {

	public function get_name() { return 'wss_footer'; }
	public function get_title() { return __( 'WSS — Site Footer', 'website-section-supporter' ); }
	public function get_icon() { return 'eicon-footer'; }
	public function get_categories() { return array( 'website-section-supporter' ); }
	public function get_keywords() { return array( 'footer', 'contact', 'legal' ); }

	private function get_available_menus() {
		$menus = wp_get_nav_menus();
		$options = array();
		if ( ! empty( $menus ) && ! is_wp_error( $menus ) ) {
			foreach ( $menus as $menu ) {
				$options[ $menu->slug ] = $menu->name;
			}
		}
		return $options;
	}

	protected function register_controls() {

		/* ================= CONTENT ================= */
		$this->start_controls_section( 'section_brand', array( 'label' => __( 'Brand', 'website-section-supporter' ) ) );
		$this->add_control( 'show_brand', array( 'label' => __( 'Show Brand', 'website-section-supporter' ), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes' ) );
		$this->add_control( 'logo_type', array(
			'label'     => __( 'Logo Type', 'website-section-supporter' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => array(
				'text'  => array( 'title' => __( 'Text', 'website-section-supporter' ), 'icon' => 'eicon-t-letter' ),
				'image' => array( 'title' => __( 'Image', 'website-section-supporter' ), 'icon' => 'eicon-image' ),
			),
			'default'   => 'text',
			'condition' => array( 'show_brand' => 'yes' ),
		) );
		$this->add_control( 'logo_image', array(
			'label'     => __( 'Logo Image', 'website-section-supporter' ),
			'type'      => Controls_Manager::MEDIA,
			'condition' => array( 'show_brand' => 'yes', 'logo_type' => 'image' ),
		) );
		$this->add_responsive_control( 'logo_image_width', array(
			'label'     => __( 'Logo Width', 'website-section-supporter' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => array( 'px' => array( 'min' => 40, 'max' => 400 ) ),
			'default'   => array( 'size' => 160 ),
			'selectors' => array( '{{WRAPPER}} .wss-foot-logo-img' => 'width: {{SIZE}}{{UNIT}};' ),
			'condition' => array( 'show_brand' => 'yes', 'logo_type' => 'image' ),
		) );
		$this->add_control( 'logo_bold', array( 'label' => __( 'Logo — Bold Part', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'NOIR', 'website-section-supporter' ), 'condition' => array( 'show_brand' => 'yes', 'logo_type' => 'text' ) ) );
		$this->add_control( 'logo_light', array( 'label' => __( 'Logo — Light Part', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'ESTATES', 'website-section-supporter' ), 'condition' => array( 'show_brand' => 'yes', 'logo_type' => 'text' ) ) );
		$this->add_control( 'tagline', array( 'label' => __( 'Tagline', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'A Private Global Advisory', 'website-section-supporter' ), 'condition' => array( 'show_brand' => 'yes' ) ) );
		$this->end_controls_section();

		$this->start_controls_section( 'section_contact', array( 'label' => __( 'Contact', 'website-section-supporter' ) ) );
		$this->add_control( 'show_contact', array( 'label' => __( 'Show Contact', 'website-section-supporter' ), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes' ) );
		$this->add_control( 'phone', array( 'label' => __( 'Phone', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => '+880 1XXX XXXXXX', 'condition' => array( 'show_contact' => 'yes' ) ) );
		$this->add_control( 'email', array( 'label' => __( 'Email', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => 'advisory@example.com', 'condition' => array( 'show_contact' => 'yes' ) ) );
		$this->add_control( 'address', array( 'label' => __( 'Address', 'website-section-supporter' ), 'type' => Controls_Manager::TEXTAREA, 'default' => "Level 42, One Meridian Tower\nGulshan, Dhaka 1212", 'rows' => 2, 'condition' => array( 'show_contact' => 'yes' ) ) );
		$this->end_controls_section();

		$this->start_controls_section( 'section_nav', array( 'label' => __( 'Nav Links', 'website-section-supporter' ) ) );
		$this->add_control( 'show_nav', array( 'label' => __( 'Show Nav Links', 'website-section-supporter' ), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes' ) );
		$this->add_control(
			'nav_type',
			array(
				'label'   => __( 'Menu Source Type', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'custom',
				'options' => array(
					'custom'  => __( 'Custom Links (Repeater)', 'website-section-supporter' ),
					'wp_menu' => __( 'WordPress Menu', 'website-section-supporter' ),
				),
				'condition' => array( 'show_nav' => 'yes' ),
			)
		);
		$menus_list = $this->get_available_menus();
		$this->add_control(
			'wp_menu_select',
			array(
				'label'       => __( 'Select WordPress Menu', 'website-section-supporter' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => $menus_list,
				'default'     => ! empty( array_keys( $menus_list ) ) ? array_keys( $menus_list )[0] : '',
				'condition'   => array( 'show_nav' => 'yes', 'nav_type' => 'wp_menu' ),
				'description' => __( 'Select a menu created under Appearance > Menus.', 'website-section-supporter' ),
			)
		);
		$repeater = new Repeater();
		$repeater->add_control( 'label', array( 'label' => __( 'Label', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'Home', 'website-section-supporter' ) ) );
		$repeater->add_control( 'link', array( 'label' => __( 'Link', 'website-section-supporter' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );
		$this->add_control(
			'nav_links',
			array(
				'label'       => __( 'Links', 'website-section-supporter' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array( 'label' => 'Home', 'link' => array( 'url' => '#hero' ) ),
					array( 'label' => 'About', 'link' => array( 'url' => '#about' ) ),
					array( 'label' => 'Featured Properties', 'link' => array( 'url' => '#sales' ) ),
					array( 'label' => 'Neighborhoods', 'link' => array( 'url' => '#lifestyles' ) ),
					array( 'label' => "Let's Connect", 'link' => array( 'url' => '#newsletter' ) ),
				),
				'title_field' => '{{{ label }}}',
				'condition'   => array( 'show_nav' => 'yes', 'nav_type' => 'custom' ),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section( 'section_social', array( 'label' => __( 'Social Links', 'website-section-supporter' ) ) );
		$this->add_control( 'show_social', array( 'label' => __( 'Show Social Links', 'website-section-supporter' ), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes' ) );
		$social_repeater = new Repeater();
		$social_repeater->add_control(
			'platform',
			array(
				'label'   => __( 'Social Network', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'f',
				'options' => array(
					'f'      => __( 'Facebook (f / fb)', 'website-section-supporter' ),
					'in'     => __( 'LinkedIn (in)', 'website-section-supporter' ),
					'ig'     => __( 'Instagram (ig)', 'website-section-supporter' ),
					'google' => __( 'Google (Search / Business / Reviews)', 'website-section-supporter' ),
					'yt'     => __( 'YouTube (yt)', 'website-section-supporter' ),
					'x'      => __( 'X / Twitter (x / tw)', 'website-section-supporter' ),
					'wa'     => __( 'WhatsApp (wa)', 'website-section-supporter' ),
					'tt'     => __( 'TikTok (tt)', 'website-section-supporter' ),
					'pin'    => __( 'Pinterest (pin)', 'website-section-supporter' ),
					'custom' => __( 'Custom Label / Override', 'website-section-supporter' ),
				),
			)
		);
		$social_repeater->add_control(
			'label',
			array(
				'label'       => __( 'Custom Label / Text', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => __( 'Optional custom icon key (e.g. google, g, fb, in, ig, yt).', 'website-section-supporter' ),
				'condition'   => array( 'platform' => 'custom' ),
			)
		);
		$social_repeater->add_control(
			'link',
			array(
				'label'   => __( 'Link (Google Search URL / Profile)', 'website-section-supporter' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#', 'is_external' => true ),
			)
		);
		$this->add_control(
			'social_links',
			array(
				'label'       => __( 'Icons', 'website-section-supporter' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $social_repeater->get_controls(),
				'default'     => array(
					array( 'platform' => 'f' ),
					array( 'platform' => 'in' ),
					array( 'platform' => 'ig' ),
					array( 'platform' => 'google' ),
					array( 'platform' => 'yt' ),
				),
				'title_field' => '{{{ platform }}}',
				'condition'   => array( 'show_social' => 'yes' ),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section( 'section_legal', array( 'label' => __( 'Legal', 'website-section-supporter' ) ) );
		$this->add_control( 'show_legal', array( 'label' => __( 'Show Legal Links', 'website-section-supporter' ), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes' ) );
		$legal_repeater = new Repeater();
		$legal_repeater->add_control( 'label', array( 'label' => __( 'Label', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'Disclaimer', 'website-section-supporter' ) ) );
		$legal_repeater->add_control( 'link', array( 'label' => __( 'Link', 'website-section-supporter' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );
		$this->add_control(
			'legal_links',
			array(
				'label'       => __( 'Legal Links', 'website-section-supporter' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $legal_repeater->get_controls(),
				'default'     => array(
					array( 'label' => 'Consumer Protection Notice' ),
					array( 'label' => 'Information About Brokerage Services' ),
					array( 'label' => 'Disclaimer' ),
				),
				'title_field' => '{{{ label }}}',
				'condition'   => array( 'show_legal' => 'yes' )
			)
		);
		$this->add_control( 'broker_line', array( 'label' => __( 'Broker Line', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'Broker of Record: A. Rahman', 'website-section-supporter' ), 'condition' => array( 'show_legal' => 'yes' ) ) );
		$this->add_control( 'fine_print', array( 'label' => __( 'Fine Print', 'website-section-supporter' ), 'type' => Controls_Manager::TEXTAREA, 'default' => __( 'The marks used above are used under license by independently owned and operated member offices. Each office fully supports the principles of fair and equal housing opportunity.', 'website-section-supporter' ), 'rows' => 3, 'condition' => array( 'show_legal' => 'yes' ) ) );
		$this->end_controls_section();

		$this->start_controls_section( 'section_badges', array( 'label' => __( 'Badges & Affiliations', 'website-section-supporter' ) ) );
		$this->add_control( 'show_badges', array( 'label' => __( 'Show Badges', 'website-section-supporter' ), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes' ) );
		$badge_repeater = new Repeater();
		$badge_repeater->add_control( 'image', array(
			'label' => __( 'Badge Image', 'website-section-supporter' ),
			'type'  => Controls_Manager::MEDIA,
		) );
		$badge_repeater->add_control( 'title', array(
			'label'       => __( 'Badge Title (Optional)', 'website-section-supporter' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => '',
			'placeholder' => __( 'e.g. Exclusive Member / Affiliate', 'website-section-supporter' ),
			'description' => __( 'Leave empty if you do not want to display a title.', 'website-section-supporter' ),
		) );
		$badge_repeater->add_control( 'title_position', array(
			'label'     => __( 'Title Position', 'website-section-supporter' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => array(
				'top'    => array( 'title' => __( 'Top (Above Image)', 'website-section-supporter' ), 'icon' => 'eicon-v-align-top' ),
				'bottom' => array( 'title' => __( 'Bottom (Below Image)', 'website-section-supporter' ), 'icon' => 'eicon-v-align-bottom' ),
			),
			'default'   => 'bottom',
			'condition' => array( 'title!' => '' ),
		) );
		$badge_repeater->add_control( 'link', array(
			'label'       => __( 'Link URL (Optional)', 'website-section-supporter' ),
			'type'        => Controls_Manager::URL,
			'placeholder' => __( 'https://example.com', 'website-section-supporter' ),
			'default'     => array( 'url' => '', 'is_external' => true ),
		) );
		$badge_repeater->add_control( 'alt_text', array(
			'label'   => __( 'Alt Text', 'website-section-supporter' ),
			'type'    => Controls_Manager::TEXT,
			'default' => __( 'Badge', 'website-section-supporter' ),
		) );
		$this->add_control(
			'badges',
			array(
				'label'       => __( 'Badge Items', 'website-section-supporter' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $badge_repeater->get_controls(),
				'default'     => array(
					array( 'title' => '', 'alt_text' => 'Badge 1' ),
					array( 'title' => '', 'alt_text' => 'Badge 2' ),
				),
				'title_field' => '{{{ title ? title : ( alt_text ? alt_text : "Badge Item" ) }}}',
				'condition'   => array( 'show_badges' => 'yes' )
			)
		);
		$this->end_controls_section();

		$this->start_controls_section( 'section_bottom', array( 'label' => __( 'Bottom Bar', 'website-section-supporter' ) ) );
		$this->add_control( 'show_bottom', array( 'label' => __( 'Show Bottom Bar', 'website-section-supporter' ), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes' ) );
		$this->add_control( 'credit_prefix', array( 'label' => __( 'Credit Prefix', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'Site by', 'website-section-supporter' ), 'condition' => array( 'show_bottom' => 'yes' ) ) );
		$this->add_control( 'credit_name', array( 'label' => __( 'Credit Name', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => WSS_CREDIT_NAME, 'condition' => array( 'show_bottom' => 'yes' ) ) );
		$this->add_control( 'credit_link', array( 'label' => __( 'Credit Link', 'website-section-supporter' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => WSS_CREDIT_URL, 'is_external' => true ), 'condition' => array( 'show_bottom' => 'yes' ) ) );
		$this->add_control( 'copyright_text', array( 'label' => __( 'Copyright Text', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => 'Copyright © ' . gmdate( 'Y' ), 'condition' => array( 'show_bottom' => 'yes' ) ) );
		$this->add_control( 'privacy_text', array( 'label' => __( 'Privacy Link Text', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'Privacy Policy', 'website-section-supporter' ), 'condition' => array( 'show_bottom' => 'yes' ) ) );
		$this->add_control( 'privacy_link', array( 'label' => __( 'Privacy Link URL', 'website-section-supporter' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ), 'condition' => array( 'show_bottom' => 'yes' ) ) );
		$this->end_controls_section();

		/* ================= STYLE: SECTION ================= */
		$this->start_controls_section(
			'style_section',
			array( 'label' => __( 'Section', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_control( 'footer_bg', array( 'label' => __( 'Background Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-footer' => 'background: {{VALUE}};' ) ) );
		$this->add_control( 'divider_color', array( 'label' => __( 'Divider Line Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array(
			'{{WRAPPER}} .wss-hr2' => 'background: {{VALUE}};',
			'{{WRAPPER}} .wss-foot-bottom' => 'border-top-color: {{VALUE}};',
		) ) );
		$this->add_responsive_control(
			'section_padding_top',
			array( 'label' => __( 'Top Padding', 'website-section-supporter' ), 'type' => Controls_Manager::SLIDER, 'range' => array( 'px' => array( 'min' => 0, 'max' => 200 ) ), 'default' => array( 'size' => 80 ), 'selectors' => array( '{{WRAPPER}} .wss-footer' => 'padding-top: {{SIZE}}{{UNIT}};' ) )
		);
		$this->end_controls_section();

		/* ================= STYLE: BRAND ================= */
		$this->start_controls_section(
			'style_brand',
			array( 'label' => __( 'Brand', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_control( 'brand_logo_color', array( 'label' => __( 'Logo Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-foot-brand .wss-logo' => 'color: {{VALUE}};' ) ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'brand_logo_typography', 'selector' => '{{WRAPPER}} .wss-foot-brand .wss-logo' ) );
		$this->add_control( 'tagline_color', array( 'label' => __( 'Tagline Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-foot-brand p' => 'color: {{VALUE}};' ) ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'tagline_typography', 'selector' => '{{WRAPPER}} .wss-foot-brand p' ) );
		$this->end_controls_section();

		/* ================= STYLE: CONTACT ================= */
		$this->start_controls_section(
			'style_contact',
			array( 'label' => __( 'Contact', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_control( 'contact_label_color', array( 'label' => __( 'Label Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-foot-contact .wss-eyebrow' => 'color: {{VALUE}};' ) ) );
		$this->add_control( 'contact_text_color', array( 'label' => __( 'Text Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-foot-contact p' => 'color: {{VALUE}};' ) ) );
		$this->add_control( 'contact_link_color', array( 'label' => __( 'Link Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-foot-contact a' => 'color: {{VALUE}};' ) ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'contact_typography', 'selector' => '{{WRAPPER}} .wss-foot-contact p' ) );
		$this->end_controls_section();

		/* ================= STYLE: NAV & SOCIAL ================= */
		$this->start_controls_section(
			'style_nav',
			array( 'label' => __( 'Nav & Social', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'nav_link_typography',
				'selector' => '{{WRAPPER}} .wss-foot-nav ul a, {{WRAPPER}} .wss-foot-nav .wss-foot-menu-list a, {{WRAPPER}} .wss-foot-wp-menu a',
			)
		);
		$this->start_controls_tabs( 'tabs_footer_nav_style' );
		$this->start_controls_tab( 'tab_footer_nav_normal', array( 'label' => __( 'Normal', 'website-section-supporter' ) ) );
		$this->add_control(
			'nav_link_color',
			array(
				'label'     => __( 'Nav Link Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-foot-nav ul a, {{WRAPPER}} .wss-foot-nav .wss-foot-menu-list a, {{WRAPPER}} .wss-foot-wp-menu a' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab( 'tab_footer_nav_hover', array( 'label' => __( 'Hover', 'website-section-supporter' ) ) );
		$this->add_control(
			'nav_link_hover_color',
			array(
				'label'     => __( 'Nav Link Hover Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-foot-nav ul a:hover, {{WRAPPER}} .wss-foot-nav .wss-foot-menu-list a:hover, {{WRAPPER}} .wss-foot-wp-menu a:hover' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control( 'social_style_heading', array( 'label' => __( 'Social Icons', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_responsive_control(
			'social_size',
			array(
				'label'     => __( 'Social Icon Size', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 20, 'max' => 60 ) ),
				'default'   => array( 'size' => 38 ),
				'selectors' => array( '{{WRAPPER}} .wss-foot-social a' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;' ),
			)
		);
		$this->start_controls_tabs( 'tabs_footer_social_style' );
		$this->start_controls_tab( 'tab_footer_social_normal', array( 'label' => __( 'Normal', 'website-section-supporter' ) ) );
		$this->add_control(
			'social_color',
			array(
				'label'     => __( 'Icon Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-foot-social a' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'social_bg',
			array(
				'label'     => __( 'Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-foot-social a' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'social_border_color',
			array(
				'label'     => __( 'Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-foot-social a' => 'border-color: {{VALUE}} !important;',
				),
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab( 'tab_footer_social_hover', array( 'label' => __( 'Hover', 'website-section-supporter' ) ) );
		$this->add_control(
			'social_hover_color',
			array(
				'label'     => __( 'Hover Icon Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-foot-social a:hover' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'social_hover_bg',
			array(
				'label'     => __( 'Hover Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-foot-social a:hover' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'social_hover_border_color',
			array(
				'label'     => __( 'Hover Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-foot-social a:hover' => 'border-color: {{VALUE}} !important;',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/* ================= STYLE: LEGAL ================= */
		$this->start_controls_section(
			'style_legal',
			array( 'label' => __( 'Legal & Badges', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_control( 'legal_text_color', array( 'label' => __( 'Legal Text Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-foot-legal p' => 'color: {{VALUE}};' ) ) );
		$this->add_control( 'legal_link_color', array( 'label' => __( 'Legal Link Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-foot-legal a' => 'color: {{VALUE}};' ) ) );
		$this->add_control( 'fine_print_color', array( 'label' => __( 'Fine Print Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-fine' => 'color: {{VALUE}};' ) ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'legal_typography', 'selector' => '{{WRAPPER}} .wss-foot-legal p' ) );
		
		$this->add_control( 'badge_heading', array( 'label' => __( 'Badge Images & Titles', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_responsive_control(
			'badge_height',
			array(
				'label'      => __( 'Height', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'range'      => array( 'px' => array( 'min' => 10, 'max' => 150 ) ),
				'default'    => array( 'size' => 40, 'unit' => 'px' ),
				'selectors'  => array( '{{WRAPPER}} .wss-badge-img' => 'height: {{SIZE}}{{UNIT}};' ),
			)
		);
		$this->add_responsive_control(
			'badge_max_width',
			array(
				'label'      => __( 'Max Width', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'range'      => array( 'px' => array( 'min' => 20, 'max' => 300 ) ),
				'default'    => array( 'size' => 120, 'unit' => 'px' ),
				'selectors'  => array( '{{WRAPPER}} .wss-badge-img' => 'max-width: {{SIZE}}{{UNIT}};' ),
			)
		);
		$this->add_responsive_control(
			'badge_gap',
			array(
				'label'      => __( 'Gap Between Items', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 4, 'max' => 60 ) ),
				'default'    => array( 'size' => 16 ),
				'selectors'  => array( '{{WRAPPER}} .wss-badges' => 'gap: {{SIZE}}{{UNIT}};' ),
			)
		);
		$this->add_control(
			'badge_title_color',
			array(
				'label'     => __( 'Badge Title Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-badge-title' => 'color: {{VALUE}} !important;' ),
			)
		);
		$this->add_control(
			'badge_title_hover_color',
			array(
				'label'     => __( 'Badge Title Hover Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} a.wss-badge-item:hover .wss-badge-title, {{WRAPPER}} .wss-badge-item a:hover .wss-badge-title' => 'color: {{VALUE}} !important;' ),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'badge_title_typography',
				'selector' => '{{WRAPPER}} .wss-badge-title',
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: BOTTOM BAR ================= */
		$this->start_controls_section(
			'style_bottom',
			array( 'label' => __( 'Bottom Bar', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_control( 'bottom_text_color', array( 'label' => __( 'Text Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-foot-bottom' => 'color: {{VALUE}};' ) ) );
		$this->add_control( 'bottom_link_color', array( 'label' => __( 'Link Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-foot-bottom a' => 'color: {{VALUE}};' ) ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'bottom_typography', 'selector' => '{{WRAPPER}} .wss-foot-bottom' ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		?>
		<div class="wss-scope">
			<footer class="wss-footer">
				<div class="wss-container">
					<?php if ( 'yes' === $s['show_brand'] || 'yes' === $s['show_contact'] ) : ?>
					<div class="wss-foot-top">
						<?php if ( 'yes' === $s['show_brand'] ) : ?>
							<div class="wss-foot-brand">
								<?php if ( 'image' === $s['logo_type'] && ! empty( $s['logo_image']['url'] ) ) : ?>
									<img src="<?php echo esc_url( $s['logo_image']['url'] ); ?>" alt="Logo" class="wss-foot-logo-img">
								<?php else : ?>
									<div class="wss-logo"><?php echo esc_html( $s['logo_bold'] ); ?> <span><?php echo esc_html( $s['logo_light'] ); ?></span></div>
								<?php endif; ?>
								<?php if ( ! empty( $s['tagline'] ) ) : ?>
									<p><?php echo esc_html( $s['tagline'] ); ?></p>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						<?php if ( 'yes' === $s['show_contact'] ) : ?>
							<div class="wss-foot-contact">
								<div>
									<span class="wss-eyebrow"><?php echo esc_html( $s['logo_bold'] . ' ' . $s['logo_light'] ); ?></span>
									<p><?php echo esc_html( $s['phone'] ); ?><br><a href="mailto:<?php echo esc_attr( $s['email'] ); ?>"><?php echo esc_html( $s['email'] ); ?></a></p>
								</div>
								<div>
									<span class="wss-eyebrow"><?php esc_html_e( 'Address', 'website-section-supporter' ); ?></span>
									<p><?php echo nl2br( esc_html( $s['address'] ) ); ?></p>
								</div>
							</div>
						<?php endif; ?>
					</div>
					<?php endif; ?>
					<?php if ( 'yes' === $s['show_nav'] || 'yes' === $s['show_social'] ) : ?>
						<div class="wss-hr2"></div>
						<div class="wss-foot-nav">
							<?php if ( 'yes' === $s['show_nav'] ) : ?>
								<?php if ( 'wp_menu' === ( $s['nav_type'] ?? 'custom' ) && ! empty( $s['wp_menu_select'] ) ) : ?>
									<div class="wss-foot-wp-menu">
										<?php
										wp_nav_menu( array(
											'menu'        => $s['wp_menu_select'],
											'container'   => false,
											'menu_class'  => 'wss-foot-menu-list',
											'fallback_cb' => false,
											'depth'       => 1,
										) );
										?>
									</div>
								<?php elseif ( ! empty( $s['nav_links'] ) ) : ?>
									<ul>
										<?php foreach ( $s['nav_links'] as $item ) : ?>
											<li><a href="<?php echo esc_url( $item['link']['url'] ?: '#' ); ?>"><?php echo esc_html( $item['label'] ); ?></a></li>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>
							<?php endif; ?>
							<?php if ( 'yes' === $s['show_social'] && ! empty( $s['social_links'] ) ) : ?>
								<div class="wss-foot-social">
									<?php foreach ( $s['social_links'] as $social ) :
										$platform = ! empty( $social['platform'] ) ? $social['platform'] : '';
										$label    = ! empty( $social['label'] ) ? $social['label'] : ( ! empty( $platform ) ? $platform : 'f' );
										$icon_key = ( 'custom' !== $platform && ! empty( $platform ) ) ? $platform : $label;
										$url      = ! empty( $social['link']['url'] ) ? $social['link']['url'] : '#';
										?>
										<a href="<?php echo esc_url( $url ); ?>"<?php echo ! empty( $social['link']['is_external'] ) ? ' target="_blank" rel="noopener"' : ''; ?> aria-label="<?php echo esc_attr( $label ); ?>" class="wss-social-icon"><?php echo $this->get_social_svg( $icon_key ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>
					
					<?php if ( 'yes' === $s['show_legal'] || 'yes' === $s['show_badges'] ) : ?>
						<div class="wss-hr2"></div>
						<div class="wss-foot-legal">
							<?php if ( 'yes' === $s['show_legal'] ) : ?>
								<?php foreach ( $s['legal_links'] as $legal ) : ?>
									<p><a href="<?php echo esc_url( $legal['link']['url'] ?: '#' ); ?>"><?php echo esc_html( $legal['label'] ); ?></a></p>
								<?php endforeach; ?>
								<?php if ( ! empty( $s['broker_line'] ) ) : ?>
									<p style="margin-top:14px;"><?php echo esc_html( $s['logo_bold'] . ' ' . $s['logo_light'] . ' | ' . $s['broker_line'] ); ?></p>
								<?php endif; ?>
								<?php if ( ! empty( $s['fine_print'] ) ) : ?>
									<p class="wss-fine"><?php echo esc_html( $s['fine_print'] ); ?></p>
								<?php endif; ?>
							<?php endif; ?>
							<?php if ( 'yes' === $s['show_badges'] && ! empty( $s['badges'] ) ) : ?>
								<div class="wss-badges">
									<?php foreach ( $s['badges'] as $badge ) :
										$has_img   = ! empty( $badge['image']['url'] );
										$has_title = ! empty( $badge['title'] );
										if ( ! $has_img && ! $has_title ) { continue; }
										$has_link  = ! empty( $badge['link']['url'] );
										$pos       = ! empty( $badge['title_position'] ) ? $badge['title_position'] : 'bottom';
										$tag       = $has_link ? 'a' : 'div';
										$href      = $has_link ? ' href="' . esc_url( $badge['link']['url'] ) . '"' : '';
										$target    = ( $has_link && ! empty( $badge['link']['is_external'] ) ) ? ' target="_blank" rel="noopener"' : '';
										$alt       = ! empty( $badge['alt_text'] ) ? $badge['alt_text'] : ( $has_title ? $badge['title'] : 'Badge' );
									?>
										<<?php echo $tag; ?><?php echo $href . $target; ?> class="wss-badge-item">
											<?php if ( 'top' === $pos && $has_title ) : ?>
												<span class="wss-badge-title"><?php echo esc_html( $badge['title'] ); ?></span>
											<?php endif; ?>
											<?php if ( $has_img ) : ?>
												<div class="wss-badge-img">
													<img src="<?php echo esc_url( $badge['image']['url'] ); ?>" alt="<?php echo esc_attr( $alt ); ?>" loading="lazy">
												</div>
											<?php endif; ?>
											<?php if ( 'bottom' === $pos && $has_title ) : ?>
												<span class="wss-badge-title"><?php echo esc_html( $badge['title'] ); ?></span>
											<?php endif; ?>
										</<?php echo $tag; ?>>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					<?php if ( 'yes' === $s['show_bottom'] ) : ?>
						<div class="wss-foot-bottom">
							<span>
								<?php echo esc_html( $s['credit_prefix'] ); ?>
								<a href="<?php echo esc_url( $s['credit_link']['url'] ?: WSS_CREDIT_URL ); ?>"<?php echo ! empty( $s['credit_link']['is_external'] ) ? ' target="_blank" rel="noopener"' : ''; ?>><?php echo esc_html( $s['credit_name'] ); ?></a>
							</span>
							<span>
								<?php echo esc_html( $s['copyright_text'] ); ?> &middot;
								<a href="<?php echo esc_url( $s['privacy_link']['url'] ?: '#' ); ?>"><?php echo esc_html( $s['privacy_text'] ); ?></a>
							</span>
						</div>
					<?php endif; ?>
				</div>
			</footer>
		</div>
		<?php
	}

	private function get_social_svg( $label ) {
		$label = strtolower( trim( $label ) );
		$icons = array(
			'f'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>',
			'fb'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>',
			'in'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>',
			'ig'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>',
			'google' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/></svg>',
			'g'      => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/></svg>',
			'yt'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 0 0 1.46 6.42 29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58 2.78 2.78 0 0 0 1.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.96A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/></svg>',
			'tw'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg>',
			'x'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4l16 16M20 4L4 20"/></svg>',
			'tt'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/></svg>',
			'pin'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>',
			'wa'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>',
		);
		if ( isset( $icons[ $label ] ) ) {
			return $icons[ $label ];
		}
		// Fallback: show initials in a tiny circle
		return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="9"/><text x="12" y="16" text-anchor="middle" font-size="8" fill="currentColor" stroke="none">' . esc_html( strtoupper( substr( $label, 0, 2 ) ) ) . '</text></svg>';
	}
}
