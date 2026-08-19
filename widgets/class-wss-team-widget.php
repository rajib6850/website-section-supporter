<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

/**
 * WSS Team & Agents Widget
 * 
 * Luxury Real Estate Team Section with Grid & Slider modes,
 * pre-populated with VP Signature Group members from docx,
 * and an interactive luxury profile popup modal.
 */
class WSS_Team_Widget extends Widget_Base {

	public function get_name() {
		return 'wss_team';
	}

	public function get_title() {
		return __( 'WSS — Team / Advisors', 'website-section-supporter' );
	}

	public function get_icon() {
		return 'eicon-person';
	}

	public function get_categories() {
		return array( 'website-section-supporter' );
	}

	public function get_keywords() {
		return array( 'team', 'agents', 'advisors', 'members', 'broker', 'realtor', 'carousel', 'slider', 'grid', 'popup', 'modal', 'luxury' );
	}

	protected function register_controls() {

		/* ================= CONTENT: SECTION HEADER ================= */
		$this->start_controls_section(
			'section_header_content',
			array( 'label' => __( 'Section Header', 'website-section-supporter' ) )
		);

		$this->add_control(
			'show_section_header',
			array(
				'label'        => __( 'Show Header', 'website-section-supporter' ),
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
				'label'       => __( 'Eyebrow', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'EXPERTISE & INTEGRITY', 'website-section-supporter' ),
				'condition'   => array( 'show_section_header' => 'yes' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Heading', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( "Meet Our Advisors\n& Leadership", 'website-section-supporter' ),
				'condition'   => array( 'show_section_header' => 'yes' ),
				'rows'        => 2,
			)
		);

		$this->add_control(
			'subtitle',
			array(
				'label'       => __( 'Subtitle / Description', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'A dedicated team of luxury real estate professionals offering decades of collective market insight, strategic negotiation, and personalized concierge service.', 'website-section-supporter' ),
				'condition'   => array( 'show_section_header' => 'yes' ),
				'rows'        => 3,
			)
		);

		$this->add_responsive_control(
			'header_alignment',
			array(
				'label'     => __( 'Header Alignment', 'website-section-supporter' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array( 'title' => __( 'Left', 'website-section-supporter' ), 'icon' => 'eicon-text-align-left' ),
					'center' => array( 'title' => __( 'Center', 'website-section-supporter' ), 'icon' => 'eicon-text-align-center' ),
					'right'  => array( 'title' => __( 'Right', 'website-section-supporter' ), 'icon' => 'eicon-text-align-right' ),
				),
				'default'   => 'center',
				'condition' => array( 'show_section_header' => 'yes' ),
				'selectors' => array(
					'{{WRAPPER}} .wss-team-top' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .wss-team-subtitle' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		/* ================= CONTENT: LAYOUT SETTINGS ================= */
		$this->start_controls_section(
			'section_layout_settings',
			array( 'label' => __( 'Layout & Display', 'website-section-supporter' ) )
		);

		$this->add_control(
			'layout_type',
			array(
				'label'   => __( 'Layout Mode', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'grid',
				'options' => array(
					'grid'   => __( 'Responsive Grid', 'website-section-supporter' ),
					'slider' => __( 'Carousel / Slider', 'website-section-supporter' ),
				),
			)
		);

		$this->add_responsive_control(
			'grid_columns',
			array(
				'label'          => __( 'Grid Columns', 'website-section-supporter' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
				'options'        => array(
					'1' => '1 Column',
					'2' => '2 Columns',
					'3' => '3 Columns',
					'4' => '4 Columns',
					'5' => '5 Columns',
					'6' => '6 Columns',
				),
				'condition'      => array( 'layout_type' => 'grid' ),
				'selectors'      => array(
					'{{WRAPPER}} .wss-team-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
				),
			)
		);

		$this->add_responsive_control(
			'grid_gap',
			array(
				'label'      => __( 'Card Spacing (Gap)', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 60 ) ),
				'default'    => array( 'size' => 32 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-team-grid, {{WRAPPER}} .wss-team-track' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// Slider Options
		$this->add_control(
			'heading_slider_opt',
			array(
				'label'     => __( 'Slider Controls', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array( 'layout_type' => 'slider' ),
			)
		);

		$this->add_control(
			'slider_arrows',
			array(
				'label'        => __( 'Navigation Arrows', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'website-section-supporter' ),
				'label_off'    => __( 'Hide', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array( 'layout_type' => 'slider' ),
			)
		);

		$this->add_control(
			'slider_dots',
			array(
				'label'        => __( 'Pagination Dots', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'website-section-supporter' ),
				'label_off'    => __( 'Hide', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array( 'layout_type' => 'slider' ),
			)
		);

		$this->add_control(
			'slider_autoplay',
			array(
				'label'        => __( 'Autoplay', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'website-section-supporter' ),
				'label_off'    => __( 'No', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition'    => array( 'layout_type' => 'slider' ),
			)
		);

		$this->add_control(
			'slider_speed',
			array(
				'label'     => __( 'Autoplay Speed (ms)', 'website-section-supporter' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 4500,
				'min'       => 1500,
				'max'       => 12000,
				'step'      => 500,
				'condition' => array(
					'layout_type'     => 'slider',
					'slider_autoplay' => 'yes',
				),
			)
		);

		$this->add_control(
			'slider_loop',
			array(
				'label'        => __( 'Infinite Loop', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'website-section-supporter' ),
				'label_off'    => __( 'No', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array( 'layout_type' => 'slider' ),
			)
		);

		$this->end_controls_section();

		/* ================= CONTENT: TEAM MEMBERS ================= */
		$this->start_controls_section(
			'section_team_members',
			array( 'label' => __( 'Team Members', 'website-section-supporter' ) )
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'member_name',
			array(
				'label'       => __( 'Full Name', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Victoria Price', 'website-section-supporter' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'member_role',
			array(
				'label'       => __( 'Role / Designation', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Broker-Owner', 'website-section-supporter' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'member_license',
			array(
				'label'       => __( 'License ID / DRE#', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'BK3403615', 'website-section-supporter' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'member_image',
			array(
				'label'   => __( 'Profile Photo', 'website-section-supporter' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=800&auto=format&fit=crop',
				),
			)
		);

		$repeater->add_control(
			'member_excerpt',
			array(
				'label'       => __( 'Card Short Bio Excerpt', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Over 15 years of leadership across real estate, executive technology, and strategic high-stakes negotiation.', 'website-section-supporter' ),
				'rows'        => 2,
			)
		);

		$repeater->add_control(
			'member_bio',
			array(
				'label'       => __( 'Full Biography (Popup Profile Modal)', 'website-section-supporter' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => __( '<p>As Broker-Owner of VP Signature Group, Victoria Price leads with a clear vision rooted in excellence, strategy, and a client-first philosophy. Her leadership fosters a results-driven culture focused on integrity, service, and execution.</p><p>With over 15 years of experience across real estate, technology, and business leadership, Victoria offers clients a deep understanding of market dynamics and high-stakes negotiation. She has built and led growth-focused teams across industries, bringing a cross-functional perspective to every transaction.</p><p>Originally from New York and now based in Central Florida, Victoria holds both undergraduate and MBA degrees. She is known for her sharp communication, meticulous attention to detail, and commitment to keeping clients fully informed throughout the buying or selling process.</p><p>Victoria remains active in real estate organizations at both the local and national levels, continuously raising the bar for service and standards in the industry.</p>', 'website-section-supporter' ),
			)
		);

		$repeater->add_control(
			'member_phone',
			array(
				'label'   => __( 'Phone Number', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '+1 (407) 584-7494',
			)
		);

		$repeater->add_control(
			'member_email',
			array(
				'label'   => __( 'Email Address', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'admin@vpsignature.com',
			)
		);

		$repeater->add_control(
			'member_address',
			array(
				'label'   => __( 'Office Location', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '300 S Orange Ave, Orlando, FL 32801-3314, USA',
			)
		);

		$repeater->add_control(
			'member_specialties',
			array(
				'label'       => __( 'Specialties / Tags', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Luxury Estates, Strategic Negotiation, Investment Portfolios, Brokerage Leadership',
				'description' => __( 'Comma-separated specialty badges displayed in the popup.', 'website-section-supporter' ),
			)
		);

		$repeater->add_control(
			'member_linkedin',
			array(
				'label'   => __( 'LinkedIn URL', 'website-section-supporter' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#' ),
			)
		);

		$repeater->add_control(
			'member_instagram',
			array(
				'label'   => __( 'Instagram URL', 'website-section-supporter' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#' ),
			)
		);

		$repeater->add_control(
			'member_facebook',
			array(
				'label'   => __( 'Facebook URL', 'website-section-supporter' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#' ),
			)
		);

		$repeater->add_control(
			'member_website',
			array(
				'label'   => __( 'Personal Website URL', 'website-section-supporter' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#' ),
			)
		);

		$this->add_control(
			'team_members',
			array(
				'label'       => __( 'Members List', 'website-section-supporter' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ member_name }}} — {{{ member_role }}}',
				'default'     => array(
					array(
						'member_name'        => 'Victoria Price',
						'member_role'        => 'Broker-Owner',
						'member_license'     => 'BK3403615',
						'member_image'       => array( 'url' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=800&auto=format&fit=crop' ),
						'member_excerpt'     => 'Over 15 years of leadership across real estate, executive technology, and strategic high-stakes negotiation.',
						'member_bio'         => '<p>As Broker-Owner of VP Signature Group, Victoria Price leads with a clear vision rooted in excellence, strategy, and a client-first philosophy. Her leadership fosters a results-driven culture focused on integrity, service, and execution.</p><p>With over 15 years of experience across real estate, technology, and business leadership, Victoria offers clients a deep understanding of market dynamics and high-stakes negotiation. She has built and led growth-focused teams across industries, bringing a cross-functional perspective to every transaction.</p><p>Originally from New York and now based in Central Florida, Victoria holds both undergraduate and MBA degrees. She is known for her sharp communication, meticulous attention to detail, and commitment to keeping clients fully informed throughout the buying or selling process.</p><p>Victoria remains active in real estate organizations at both the local and national levels, continuously raising the bar for service and standards in the industry.</p>',
						'member_phone'       => '+1 (407) 584-7494',
						'member_email'       => 'admin@vpsignature.com',
						'member_address'     => '300 S Orange Ave, Orlando, FL 32801-3314, USA',
						'member_specialties' => 'Luxury Estates, Strategic Negotiation, Investment Portfolios, Brokerage Leadership',
					),
					array(
						'member_name'        => 'Alexis Flynn',
						'member_role'        => 'Realtor / Agent',
						'member_license'     => 'Realtor®',
						'member_image'       => array( 'url' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=800&auto=format&fit=crop' ),
						'member_excerpt'     => 'Over 30 years of dedicated service to military families and individuals, creating a secure, personalized real estate experience.',
						'member_bio'         => '<p>As a Realtor with VP Signature Group, Alexis Flynn brings over 30 years of experience serving military families and individuals with dedication and care. Her expertise is rooted in creating a secure, confident, and personalized real estate experience for every client.</p><p>Alexis is known for her exceptional communication, high integrity, and professionalism, guiding clients with clarity and purpose at every stage of the process. Her ability to connect and build trust comes from a lifelong commitment to service and continuous learning.</p><p>With a background deeply connected to the military community, Alexis understands the unique challenges and opportunities her clients face. She takes pride in providing tailored solutions that reflect her clients’ goals while fostering long-term relationships built on trust and respect.</p>',
						'member_phone'       => '+1 (407) 584-7494',
						'member_email'       => 'admin@vpsignature.com',
						'member_address'     => '300 S Orange Ave, Orlando, FL 32801-3314, USA',
						'member_specialties' => 'Military Relocation, Residential Sales, First-Time Buyers, Client Advocacy',
					),
					array(
						'member_name'        => 'Georgeta "Irina" Dolipschi',
						'member_role'        => 'Agent',
						'member_license'     => 'Realtor®',
						'member_image'       => array( 'url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=800&auto=format&fit=crop' ),
						'member_excerpt'     => 'International property management background with European studies and cross-border investor consulting expertise.',
						'member_bio'         => '<p>Georgeta "Irina" Dolipschi brings a global perspective and entrepreneurial drive to her role at VP Signature Group. With eight years of property management experience, including four years in Portugal’s Algarve region, Irina offers clients an international lens and a wealth of practical expertise.</p><p>Her professional background spans International Relations and European Studies, as well as launching and managing three businesses, including ventures in agriculture and transportation. This diverse experience allows Irina to approach real estate with creativity, resourcefulness, and an unshakable commitment to her clients’ success.</p><p>Known for her honesty and direct communication, Irina fosters trust and confidence with everyone she serves. She values simplicity, authenticity, and building meaningful relationships—qualities that resonate throughout her work in real estate.</p>',
						'member_phone'       => '+1 (407) 584-7494',
						'member_email'       => 'admin@vpsignature.com',
						'member_address'     => '300 S Orange Ave, Orlando, FL 32801-3314, USA',
						'member_specialties' => 'International Buyers, Property Management, Multi-lingual Consultations, Relocations',
					),
				),
			)
		);

		$this->end_controls_section();

		/* ================= CONTENT: MODAL / POPUP SETTINGS ================= */
		$this->start_controls_section(
			'section_modal_settings',
			array( 'label' => __( 'Profile Popup Modal Settings', 'website-section-supporter' ) )
		);

		$this->add_control(
			'modal_cta_text',
			array(
				'label'   => __( 'Modal Contact Button Label', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Inquire With Advisor', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'modal_cta_link',
			array(
				'label'   => __( 'Modal Contact Button Link', 'website-section-supporter' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#contact' ),
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: SECTION ================= */
		$this->start_controls_section(
			'style_section',
			array( 'label' => __( 'Section Container', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array( 'name' => 'section_bg', 'types' => array( 'classic', 'gradient' ), 'selector' => '{{WRAPPER}} .wss-pad' )
		);
		$this->add_responsive_control(
			'section_padding',
			array(
				'label'      => __( 'Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'vw' ),
				'selectors'  => array( '{{WRAPPER}} .wss-pad' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: SECTION HEADER ================= */
		$this->start_controls_section(
			'style_header_section',
			array(
				'label'     => __( 'Eyebrow & Heading', 'website-section-supporter' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array( 'show_section_header' => 'yes' ),
			)
		);

		$this->add_control(
			'eyebrow_color',
			array(
				'label'     => __( 'Eyebrow Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-team-top .wss-eyebrow' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'eyebrow_typography',
				'label'    => __( 'Eyebrow Typography', 'website-section-supporter' ),
				'selector' => '{{WRAPPER}} .wss-team-top .wss-eyebrow',
			)
		);

		$this->add_control(
			'heading_color',
			array(
				'label'     => __( 'Heading Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-team-top h2' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'heading_typography',
				'label'    => __( 'Heading Typography', 'website-section-supporter' ),
				'selector' => '{{WRAPPER}} .wss-team-top h2',
			)
		);

		$this->add_control(
			'subtitle_color',
			array(
				'label'     => __( 'Subtitle Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-team-subtitle' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'subtitle_typography',
				'label'    => __( 'Subtitle Typography', 'website-section-supporter' ),
				'selector' => '{{WRAPPER}} .wss-team-subtitle',
			)
		);

		$this->add_responsive_control(
			'header_bottom_spacing',
			array(
				'label'      => __( 'Header Bottom Spacing', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 10, 'max' => 100 ) ),
				'default'    => array( 'size' => 48 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-team-top' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: CARD ================= */
		$this->start_controls_section(
			'style_card_section',
			array(
				'label' => __( 'Team Cards', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'card_bg',
			array(
				'label'     => __( 'Card Background', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .wss-team-card' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'card_hover_bg',
			array(
				'label'     => __( 'Card Hover Background', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-team-card:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'card_border',
				'label'    => __( 'Border', 'website-section-supporter' ),
				'selector' => '{{WRAPPER}} .wss-team-card',
			)
		);

		$this->add_control(
			'card_radius',
			array(
				'label'      => __( 'Border Radius', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 40 ) ),
				'default'    => array( 'size' => 0 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-team-card' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'card_padding',
			array(
				'label'      => __( 'Card Inner Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'default'    => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '24',
					'left'     => '0',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .wss-team-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'card_shadow',
				'label'    => __( 'Card Shadow', 'website-section-supporter' ),
				'selector' => '{{WRAPPER}} .wss-team-card',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'card_hover_shadow',
				'label'    => __( 'Card Hover Shadow', 'website-section-supporter' ),
				'selector' => '{{WRAPPER}} .wss-team-card:hover',
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: MEMBER PHOTO ================= */
		$this->start_controls_section(
			'style_photo_section',
			array(
				'label' => __( 'Member Photo', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'photo_height',
			array(
				'label'      => __( 'Photo Height', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 200, 'max' => 600 ) ),
				'default'    => array( 'size' => 380 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-team-photo-wrap' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'photo_radius',
			array(
				'label'      => __( 'Photo Border Radius', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 40 ) ),
				'default'    => array( 'size' => 0 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-team-photo-wrap' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: TYPOGRAPHY & BADGES ================= */
		$this->start_controls_section(
			'style_typography_section',
			array(
				'label' => __( 'Name, Role & Excerpt', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'name_color',
			array(
				'label'     => __( 'Member Name Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1a1812',
				'selectors' => array(
					'{{WRAPPER}} .wss-team-name' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'name_typography',
				'label'    => __( 'Name Typography', 'website-section-supporter' ),
				'selector' => '{{WRAPPER}} .wss-team-name',
			)
		);

		$this->add_control(
			'role_color',
			array(
				'label'     => __( 'Role Badge Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1a1812',
				'selectors' => array(
					'{{WRAPPER}} .wss-team-role' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'role_typography',
				'label'    => __( 'Role Typography', 'website-section-supporter' ),
				'selector' => '{{WRAPPER}} .wss-team-role',
			)
		);

		$this->add_control(
			'license_color',
			array(
				'label'     => __( 'License ID Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8c827a',
				'selectors' => array(
					'{{WRAPPER}} .wss-team-license' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'excerpt_color',
			array(
				'label'     => __( 'Excerpt Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#5c554e',
				'selectors' => array(
					'{{WRAPPER}} .wss-team-excerpt' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'excerpt_typography',
				'label'    => __( 'Excerpt Typography', 'website-section-supporter' ),
				'selector' => '{{WRAPPER}} .wss-team-excerpt',
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: SLIDER NAV ARROWS & DOTS ================= */
		$this->start_controls_section(
			'style_nav',
			array(
				'label'     => __( 'Nav Arrows & Dots', 'website-section-supporter' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array( 'layout_type' => 'slider' ),
			)
		);

		$this->add_control(
			'nav_arrows_heading',
			array(
				'label' => __( 'Navigation Arrows', 'website-section-supporter' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_responsive_control(
			'nav_size',
			array(
				'label'     => __( 'Button Size', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 30, 'max' => 90 ) ),
				'selectors' => array(
					'{{WRAPPER}} .wss-team-nav-btns button, {{WRAPPER}} .wss-team-prev, {{WRAPPER}} .wss-team-next' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_team_nav_style' );

		$this->start_controls_tab(
			'tab_team_nav_normal',
			array( 'label' => __( 'Normal', 'website-section-supporter' ) )
		);
		$this->add_control(
			'nav_color',
			array(
				'label'     => __( 'Arrow Icon Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-team-nav-btns button, {{WRAPPER}} .wss-team-prev, {{WRAPPER}} .wss-team-next' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-team-nav-btns button svg, {{WRAPPER}} .wss-team-prev svg, {{WRAPPER}} .wss-team-next svg' => 'stroke: {{VALUE}} !important; color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'nav_bg',
			array(
				'label'     => __( 'Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-team-nav-btns button, {{WRAPPER}} .wss-team-prev, {{WRAPPER}} .wss-team-next' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'nav_border_color',
			array(
				'label'     => __( 'Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-team-nav-btns button, {{WRAPPER}} .wss-team-prev, {{WRAPPER}} .wss-team-next' => 'border-color: {{VALUE}} !important;',
				),
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_team_nav_hover',
			array( 'label' => __( 'Hover', 'website-section-supporter' ) )
		);
		$this->add_control(
			'nav_hover_color',
			array(
				'label'     => __( 'Hover Icon Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-team-nav-btns button:hover, {{WRAPPER}} .wss-team-prev:hover, {{WRAPPER}} .wss-team-next:hover' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-team-nav-btns button:hover svg, {{WRAPPER}} .wss-team-prev:hover svg, {{WRAPPER}} .wss-team-next:hover svg' => 'stroke: {{VALUE}} !important; color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'nav_hover_bg',
			array(
				'label'     => __( 'Hover Background', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-team-nav-btns button:hover, {{WRAPPER}} .wss-team-prev:hover, {{WRAPPER}} .wss-team-next:hover' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'nav_hover_border_color',
			array(
				'label'     => __( 'Hover Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-team-nav-btns button:hover, {{WRAPPER}} .wss-team-prev:hover, {{WRAPPER}} .wss-team-next:hover' => 'border-color: {{VALUE}} !important;',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		/* ----- DOTS ----- */
		$this->add_control(
			'dots_heading',
			array(
				'label'     => __( 'Pagination Dots', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'dot_color',
			array(
				'label'     => __( 'Dot Inactive Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-team-dot' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;' ),
			)
		);
		$this->add_control(
			'dot_active_color',
			array(
				'label'     => __( 'Dot Active Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-team-dot.wss-team-dot-active' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;' ),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: MODAL POPUP ================= */
		$this->start_controls_section(
			'style_modal_section',
			array(
				'label' => __( 'Profile Popup Modal', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'modal_bg',
			array(
				'label'     => __( 'Modal Dialog Background', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#faf8f4',
				'selectors' => array(
					'{{WRAPPER}} .wss-team-modal-content' => 'background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'modal_left_bg',
			array(
				'label'     => __( 'Modal Left Sidebar Background', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f2eee8',
				'selectors' => array(
					'{{WRAPPER}} .wss-team-modal-left' => 'background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'modal_bio_color',
			array(
				'label'     => __( 'Modal Bio Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#33312b',
				'selectors' => array(
					'{{WRAPPER}} .wss-team-modal-bio, {{WRAPPER}} .wss-team-modal-bio p' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();

		$members = ! empty( $s['team_members'] ) ? $s['team_members'] : array();
		if ( empty( $members ) ) {
			return;
		}

		$uid         = 'wss-team-' . $this->get_id();
		$layout_type = ! empty( $s['layout_type'] ) ? $s['layout_type'] : 'grid';
		$is_slider   = ( 'slider' === $layout_type );

		$autoplay = ! empty( $s['slider_autoplay'] ) && 'yes' === $s['slider_autoplay'];
		$speed    = ! empty( $s['slider_speed'] ) ? intval( $s['slider_speed'] ) : 4500;
		$loop     = ! empty( $s['slider_loop'] ) && 'yes' === $s['slider_loop'];

		$modal_cta  = ! empty( $s['modal_cta_text'] ) ? $s['modal_cta_text'] : __( 'Inquire With Advisor', 'website-section-supporter' );
		$modal_link = ! empty( $s['modal_cta_link']['url'] ) ? $s['modal_cta_link']['url'] : '#contact';
		?>
		<div class="wss-scope">
			<section class="wss-pad wss-team-section" data-wss-widget="wss-team">
				<div class="wss-container">

					<?php if ( 'yes' === ( $s['show_section_header'] ?? 'yes' ) && ( ! empty( $s['heading'] ) || ! empty( $s['eyebrow'] ) ) ) : ?>
						<div class="wss-team-top wss-reveal">
							<?php if ( ! empty( $s['eyebrow'] ) ) : ?>
								<span class="wss-eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></span>
							<?php endif; ?>
							<?php if ( ! empty( $s['heading'] ) ) : ?>
								<h2><span class="wss-mask"><span><?php echo nl2br( esc_html( $s['heading'] ) ); ?></span></span></h2>
							<?php endif; ?>
							<?php if ( ! empty( $s['subtitle'] ) ) : ?>
								<p class="wss-team-subtitle"><?php echo nl2br( esc_html( $s['subtitle'] ) ); ?></p>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					<?php if ( $is_slider ) : ?>
						<div class="wss-team-slider-wrap" id="<?php echo esc_attr( $uid ); ?>-slider-wrap"
							data-autoplay="<?php echo $autoplay ? 'true' : 'false'; ?>" 
							data-speed="<?php echo esc_attr( $speed ); ?>"
							data-loop="<?php echo $loop ? 'true' : 'false'; ?>">
							
							<div class="wss-team-track-container">
								<div class="wss-team-track">
					<?php else : ?>
						<div class="wss-team-grid">
					<?php endif; ?>

						<?php foreach ( $members as $idx => $m ) :
							$m_name    = ! empty( $m['member_name'] ) ? $m['member_name'] : __( 'Team Member', 'website-section-supporter' );
							$m_role    = ! empty( $m['member_role'] ) ? $m['member_role'] : '';
							$m_lic     = ! empty( $m['member_license'] ) ? $m['member_license'] : '';
							$m_img_url = ! empty( $m['member_image']['url'] ) ? $m['member_image']['url'] : '';
							$m_excerpt = ! empty( $m['member_excerpt'] ) ? $m['member_excerpt'] : '';
							$m_bio     = ! empty( $m['member_bio'] ) ? $m['member_bio'] : '';
							$m_phone   = ! empty( $m['member_phone'] ) ? $m['member_phone'] : '';
							$m_email   = ! empty( $m['member_email'] ) ? $m['member_email'] : '';
							$m_addr    = ! empty( $m['member_address'] ) ? $m['member_address'] : '';
							$m_tags    = ! empty( $m['member_specialties'] ) ? array_map( 'trim', explode( ',', $m['member_specialties'] ) ) : array();

							$socials = array(
								'linkedin'  => ! empty( $m['member_linkedin']['url'] ) ? $m['member_linkedin']['url'] : '',
								'instagram' => ! empty( $m['member_instagram']['url'] ) ? $m['member_instagram']['url'] : '',
								'facebook'  => ! empty( $m['member_facebook']['url'] ) ? $m['member_facebook']['url'] : '',
								'website'   => ! empty( $m['member_website']['url'] ) ? $m['member_website']['url'] : '',
							);

							$stagger_delays = array( 'wss-r1', 'wss-r2', 'wss-r3', 'wss-r4' );
							$stagger_class  = $stagger_delays[ $idx % 4 ];
							$modal_id       = 'wss-team-modal-' . $this->get_id() . '-' . $idx;
						?>
							<article class="wss-team-card wss-reveal <?php echo esc_attr( $stagger_class ); ?>" 
								data-modal-target="#<?php echo esc_attr( $modal_id ); ?>"
								tabindex="0"
								role="button"
								aria-label="<?php echo esc_attr( sprintf( __( 'View biography of %s', 'website-section-supporter' ), $m_name ) ); ?>">
								
								<div class="wss-team-photo-wrap">
									<?php if ( ! empty( $m_img_url ) ) : ?>
										<img class="wss-team-photo" src="<?php echo esc_url( $m_img_url ); ?>" alt="<?php echo esc_attr( $m_name ); ?>" loading="lazy">
									<?php else : ?>
										<div class="wss-team-photo-placeholder"><svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></div>
									<?php endif; ?>
								</div>

								<div class="wss-team-info">
									<div class="wss-team-meta-row">
										<?php if ( ! empty( $m_role ) ) : ?>
											<span class="wss-team-role"><?php echo esc_html( $m_role ); ?></span>
										<?php endif; ?>
										<?php if ( ! empty( $m_lic ) ) : ?>
											<span class="wss-team-license"><?php echo esc_html( $m_lic ); ?></span>
										<?php endif; ?>
									</div>

									<h3 class="wss-team-name"><?php echo esc_html( $m_name ); ?></h3>

									<?php if ( ! empty( $m_excerpt ) ) : ?>
										<p class="wss-team-excerpt"><?php echo esc_html( $m_excerpt ); ?></p>
									<?php endif; ?>

									<div class="wss-team-card-footer">
										<div class="wss-team-card-explore">
											<span><?php esc_html_e( 'View Profile', 'website-section-supporter' ); ?></span>
											<svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
										</div>

										<?php if ( ! empty( $m_phone ) || ! empty( $m_email ) ) : ?>
											<div class="wss-team-card-quick-icons">
												<?php if ( ! empty( $m_phone ) ) : ?>
													<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9\+]/', '', $m_phone ) ); ?>" class="wss-team-icon-link" title="<?php echo esc_attr( $m_phone ); ?>" aria-label="Call" onclick="event.stopPropagation();">
														<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
													</a>
												<?php endif; ?>
												<?php if ( ! empty( $m_email ) ) : ?>
													<a href="mailto:<?php echo esc_attr( $m_email ); ?>" class="wss-team-icon-link" title="<?php echo esc_attr( $m_email ); ?>" aria-label="Email" onclick="event.stopPropagation();">
														<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
													</a>
												<?php endif; ?>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</article>

							<!-- Single Member Interactive Profile Modal -->
							<div id="<?php echo esc_attr( $modal_id ); ?>" class="wss-team-modal" aria-hidden="true" role="dialog" aria-modal="true">
								<div class="wss-team-modal-overlay" tabindex="-1"></div>
								
								<!-- Top Right Floating Screen Close Button -->
								<button class="wss-modal-close wss-team-modal-close" aria-label="<?php esc_attr_e( 'Close profile modal', 'website-section-supporter' ); ?>" type="button">
									<svg viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12"/></svg>
								</button>
								
								<div class="wss-team-modal-dialog">
									<!-- In-Dialog Close Button -->
									<button class="wss-team-modal-inner-close wss-modal-close" aria-label="<?php esc_attr_e( 'Close profile modal', 'website-section-supporter' ); ?>" type="button">
										<svg viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12"/></svg>
									</button>

									<div class="wss-team-modal-content">
										<!-- Left Column: Portrait & Quick Contact Info -->
										<div class="wss-team-modal-left">
											<div class="wss-team-modal-photo-wrap">
												<?php if ( ! empty( $m_img_url ) ) : ?>
													<img class="wss-team-modal-photo" src="<?php echo esc_url( $m_img_url ); ?>" alt="<?php echo esc_attr( $m_name ); ?>">
												<?php endif; ?>
											</div>

											<div class="wss-team-modal-direct">
												<?php if ( ! empty( $m_phone ) ) : ?>
													<div class="wss-team-modal-contact-row">
														<span class="wss-modal-label"><?php esc_html_e( 'Direct Phone', 'website-section-supporter' ); ?></span>
														<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9\+]/', '', $m_phone ) ); ?>" class="wss-modal-value wss-modal-link"><?php echo esc_html( $m_phone ); ?></a>
													</div>
												<?php endif; ?>

												<?php if ( ! empty( $m_email ) ) : ?>
													<div class="wss-team-modal-contact-row">
														<span class="wss-modal-label"><?php esc_html_e( 'Email Address', 'website-section-supporter' ); ?></span>
														<a href="mailto:<?php echo esc_attr( $m_email ); ?>" class="wss-modal-value wss-modal-link"><?php echo esc_html( $m_email ); ?></a>
													</div>
												<?php endif; ?>

												<?php if ( ! empty( $m_addr ) ) : ?>
													<div class="wss-team-modal-contact-row">
														<span class="wss-modal-label"><?php esc_html_e( 'Office Location', 'website-section-supporter' ); ?></span>
														<span class="wss-modal-value"><?php echo esc_html( $m_addr ); ?></span>
													</div>
												<?php endif; ?>
											</div>

											<!-- Social Links Bar -->
											<?php if ( array_filter( $socials ) ) : ?>
												<div class="wss-team-modal-socials">
													<?php if ( ! empty( $socials['linkedin'] ) ) : ?>
														<a href="<?php echo esc_url( $socials['linkedin'] ); ?>" target="_blank" rel="noopener noreferrer" class="wss-social-pill" aria-label="LinkedIn">
															<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
														</a>
													<?php endif; ?>
													<?php if ( ! empty( $socials['instagram'] ) ) : ?>
														<a href="<?php echo esc_url( $socials['instagram'] ); ?>" target="_blank" rel="noopener noreferrer" class="wss-social-pill" aria-label="Instagram">
															<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
														</a>
													<?php endif; ?>
													<?php if ( ! empty( $socials['facebook'] ) ) : ?>
														<a href="<?php echo esc_url( $socials['facebook'] ); ?>" target="_blank" rel="noopener noreferrer" class="wss-social-pill" aria-label="Facebook">
															<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
														</a>
													<?php endif; ?>
													<?php if ( ! empty( $socials['website'] ) ) : ?>
														<a href="<?php echo esc_url( $socials['website'] ); ?>" target="_blank" rel="noopener noreferrer" class="wss-social-pill" aria-label="Website">
															<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
														</a>
													<?php endif; ?>
												</div>
											<?php endif; ?>
										</div>

										<!-- Right Column: Name, Role, License, Full Bio & Specialties -->
										<div class="wss-team-modal-right">
											<div class="wss-team-modal-header-meta">
												<div class="wss-team-modal-role-row">
													<?php if ( ! empty( $m_role ) ) : ?>
														<span class="wss-modal-role-badge"><?php echo esc_html( $m_role ); ?></span>
													<?php endif; ?>
													<?php if ( ! empty( $m_lic ) ) : ?>
														<span class="wss-modal-lic-badge"><?php echo esc_html( $m_lic ); ?></span>
													<?php endif; ?>
												</div>

												<h2 class="wss-team-modal-name"><?php echo esc_html( $m_name ); ?></h2>
											</div>

											<!-- Specialties Tags -->
											<?php if ( ! empty( $m_tags ) ) : ?>
												<div class="wss-team-modal-tags">
													<?php foreach ( $m_tags as $tag ) : ?>
														<span class="wss-team-modal-tag"><?php echo esc_html( $tag ); ?></span>
													<?php endforeach; ?>
												</div>
											<?php endif; ?>

											<!-- Full Rich Biography with smooth scrollbar -->
											<div class="wss-team-modal-bio">
												<?php echo wp_kses_post( $m_bio ); ?>
											</div>

											<!-- Modal Footer CTA -->
											<?php if ( ! empty( $modal_cta ) ) : ?>
												<div class="wss-team-modal-footer">
													<a href="<?php echo esc_url( $modal_link ); ?>" class="wss-btn-pill wss-team-modal-cta-btn">
														<?php echo esc_html( $modal_cta ); ?>
														<svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
													</a>
												</div>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>

					<?php if ( $is_slider ) : ?>
								</div>
							</div>

							<!-- Dots + Arrow nav matching Testimonial widget -->
							<div class="wss-team-slider-nav-bar" id="<?php echo esc_attr( $uid ); ?>-dots-bar">
								<?php if ( 'yes' === ( $s['slider_dots'] ?? 'yes' ) ) : ?>
									<div class="wss-team-dots" role="tablist">
										<?php foreach ( $members as $i => $m ) : ?>
											<button class="wss-team-dot<?php echo 0 === $i ? ' wss-team-dot-active' : ''; ?>" data-index="<?php echo esc_attr( $i ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Advisor slide %d', 'website-section-supporter' ), $i + 1 ) ); ?>"></button>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>

								<?php if ( 'yes' === ( $s['slider_arrows'] ?? 'yes' ) ) : ?>
									<div class="wss-team-nav-btns">
										<button type="button" class="wss-team-prev" aria-label="<?php esc_attr_e( 'Previous', 'website-section-supporter' ); ?>">
											<svg viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
										</button>
										<button type="button" class="wss-team-next" aria-label="<?php esc_attr_e( 'Next', 'website-section-supporter' ); ?>">
											<svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
										</button>
									</div>
								<?php endif; ?>
							</div>
						</div>
					<?php else : ?>
						</div>
					<?php endif; ?>

				</div>
			</section>
		</div>
		<?php
	}
}
