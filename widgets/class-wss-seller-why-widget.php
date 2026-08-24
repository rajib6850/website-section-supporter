<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

/**
 * WSS Seller Advantages & Value (Why Us) Widget
 * Ultra-luxury showcase of seller advantages, bespoke marketing, and metrics.
 */
class WSS_Seller_Why_Widget extends Widget_Base {

	public function get_name() {
		return 'wss_seller_why';
	}

	public function get_title() {
		return __( 'WSS — Seller Advantages & Value (Why Us)', 'website-section-supporter' );
	}

	public function get_icon() {
		return 'eicon-star-o';
	}

	public function get_categories() {
		return array( 'website-section-supporter' );
	}

	public function get_keywords() {
		return array( 'seller', 'why us', 'advantages', 'value', 'marketing', 'luxury', 'real estate', 'vpsignature' );
	}

	protected function register_controls() {

		/* ================= CONTENT: PRESET & HEADER ================= */
		$this->start_controls_section(
			'section_content_header',
			array(
				'label' => __( 'Section Header & Theme', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'preset_theme',
			array(
				'label'   => __( 'Color Theme Preset', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'dark',
				'options' => array(
					'dark'  => __( 'Dark Luxury (Architectural Ink)', 'website-section-supporter' ),
					'light' => __( 'Minimalist Light (Ivory Canvas)', 'website-section-supporter' ),
					'taupe' => __( 'Warm Taupe & Bronze', 'website-section-supporter' ),
				),
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'       => __( 'Eyebrow Text', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '03 // STRATEGIC SELLER ADVANTAGE', 'website-section-supporter' ),
				'placeholder' => __( '03 // STRATEGIC SELLER ADVANTAGE', 'website-section-supporter' ),
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Section Heading', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => "WHY LIST WITH\nVP SIGNATURE GROUP.",
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
				'label'       => __( 'Description / Narrative', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 4,
				'default'     => __( 'Selling a distinguished property in Central Florida requires an approach far beyond traditional listing practices. VP Signature Group combines bespoke architectural storytelling, data-backed positioning, and an exclusive global reach to deliver maximum asset value and discreet execution.', 'website-section-supporter' ),
				'placeholder' => __( 'Enter section description...', 'website-section-supporter' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'enable_reveal',
			array(
				'label'        => __( 'Enable Scroll Reveal Animations', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->end_controls_section();

		/* ================= CONTENT: FEATURE PILLARS ================= */
		$this->start_controls_section(
			'section_content_pillars',
			array(
				'label' => __( 'Strategic Pillars & Image Cards', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'pillar_num',
			array(
				'label'       => __( 'Watermark Index', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '01',
				'placeholder' => '01',
			)
		);

		$repeater->add_control(
			'pillar_title',
			array(
				'label'       => __( 'Pillar Title', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Bespoke Architectural Media', 'website-section-supporter' ),
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'pillar_desc',
			array(
				'label'       => __( 'Pillar Description', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => __( 'Cinematic 4K production, twilight drone perspectives, and world-class luxury editorial styling that elevates your property\'s emotional and aesthetic appeal.', 'website-section-supporter' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'pillar_badge',
			array(
				'label'       => __( 'Metric / Stat Tag', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '3.8x More Qualified Inquiries', 'website-section-supporter' ),
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'pillar_image',
			array(
				'label'   => __( 'Card Image', 'website-section-supporter' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=85',
				),
			)
		);

		$repeater->add_control(
			'pillar_link',
			array(
				'label'       => __( 'Optional Link', 'website-section-supporter' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'pillars',
			array(
				'label'       => __( 'Pillars List', 'website-section-supporter' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ pillar_num }}} - {{{ pillar_title }}}',
				'default'     => array(
					array(
						'pillar_num'   => '01',
						'pillar_title' => __( 'Bespoke Architectural Media', 'website-section-supporter' ),
						'pillar_desc'  => __( 'Cinematic 4K production, twilight drone perspectives, and world-class luxury editorial styling that elevates your property\'s emotional and aesthetic appeal.', 'website-section-supporter' ),
						'pillar_badge' => __( '3.8x More Qualified Inquiries', 'website-section-supporter' ),
						'pillar_image' => array( 'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=85' ),
					),
					array(
						'pillar_num'   => '02',
						'pillar_title' => __( 'Discreet High-Net-Worth Network', 'website-section-supporter' ),
						'pillar_desc'  => __( 'Direct access to private wealth advisors, family offices, and verified international buyers seeking prime Central Florida estates before public release.', 'website-section-supporter' ),
						'pillar_badge' => __( 'Private Off-Market Discovery', 'website-section-supporter' ),
						'pillar_image' => array( 'url' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1200&q=85' ),
					),
					array(
						'pillar_num'   => '03',
						'pillar_title' => __( 'Micro-Market Pricing Intelligence', 'website-section-supporter' ),
						'pillar_desc'  => __( 'Deep econometric pricing models analyzing neighborhood absorption, micro-trend velocity, and capital flows to command record-setting price-per-sq-ft.', 'website-section-supporter' ),
						'pillar_badge' => __( '99.2% List-to-Sale Ratio', 'website-section-supporter' ),
						'pillar_image' => array( 'url' => 'https://images.unsplash.com/photo-1600566753376-12c8ab7fb75b?auto=format&fit=crop&w=1200&q=85' ),
					),
					array(
						'pillar_num'   => '04',
						'pillar_title' => __( 'Disciplined Contract Advocacy', 'website-section-supporter' ),
						'pillar_desc'  => __( 'Uncompromising negotiation rigor protecting your equity, inspection contingencies, and closing timelines with institutional precision.', 'website-section-supporter' ),
						'pillar_badge' => __( '14 Days Avg. on Market', 'website-section-supporter' ),
						'pillar_image' => array( 'url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=1200&q=85' ),
					),
				),
			)
		);

		$this->end_controls_section();

		/* ================= CONTENT: TRUST STRIP & METRICS ================= */
		$this->start_controls_section(
			'section_content_trust',
			array(
				'label' => __( 'Trust Strip & Key Performance Metrics', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_trust_strip',
			array(
				'label'        => __( 'Display Bottom Trust Strip', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'stat1_num',
			array(
				'label'     => __( 'Stat 1 Metric', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '$120M+',
				'condition' => array( 'show_trust_strip' => 'yes' ),
			)
		);

		$this->add_control(
			'stat1_label',
			array(
				'label'     => __( 'Stat 1 Label', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Career Luxury Transaction Volume', 'website-section-supporter' ),
				'condition' => array( 'show_trust_strip' => 'yes' ),
			)
		);

		$this->add_control(
			'stat2_num',
			array(
				'label'     => __( 'Stat 2 Metric', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '99.4%',
				'condition' => array( 'show_trust_strip' => 'yes' ),
			)
		);

		$this->add_control(
			'stat2_label',
			array(
				'label'     => __( 'Stat 2 Label', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Average List-to-Sale Valuation Accuracy', 'website-section-supporter' ),
				'condition' => array( 'show_trust_strip' => 'yes' ),
			)
		);

		$this->add_control(
			'stat3_num',
			array(
				'label'     => __( 'Stat 3 Metric', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '45+',
				'condition' => array( 'show_trust_strip' => 'yes' ),
			)
		);

		$this->add_control(
			'stat3_label',
			array(
				'label'     => __( 'Stat 3 Label', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Global Syndication Platforms & Portals', 'website-section-supporter' ),
				'condition' => array( 'show_trust_strip' => 'yes' ),
			)
		);

		$this->add_control(
			'trust_quote',
			array(
				'label'       => __( 'Editorial Quote', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => __( '“Every property has a distinct architectural narrative. Our mission is to position your home not just as real estate, but as an irreplaceable acquisition.”', 'website-section-supporter' ),
				'condition'   => array( 'show_trust_strip' => 'yes' ),
			)
		);

		$this->add_control(
			'trust_author',
			array(
				'label'     => __( 'Quote Author', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'VICTORIA PRICE — FOUNDER & MANAGING DIRECTOR', 'website-section-supporter' ),
				'condition' => array( 'show_trust_strip' => 'yes' ),
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: CONTAINER & SECTION ================= */
		$this->start_controls_section(
			'style_section_container',
			array(
				'label' => __( 'Section & Container Layout', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'section_padding',
			array(
				'label'      => __( 'Section Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-seller-why-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'section_custom_bg',
				'label'    => __( 'Custom Section Background', 'website-section-supporter' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .wss-seller-why-section',
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: TYPOGRAPHY ================= */
		$this->start_controls_section(
			'style_typography_section',
			array(
				'label' => __( 'Typography & Colors', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'eyebrow_heading_title',
			array(
				'label'     => __( 'Eyebrow', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'eyebrow_color',
			array(
				'label'     => __( 'Eyebrow Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-seller-why-eyebrow' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'eyebrow_typography',
				'selector' => '{{WRAPPER}} .wss-seller-why-eyebrow',
			)
		);

		$this->add_control(
			'heading_title_ctrl',
			array(
				'label'     => __( 'Heading', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'heading_color',
			array(
				'label'     => __( 'Heading Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-seller-why-heading, {{WRAPPER}} .wss-seller-why-heading .wss-mask > span, {{WRAPPER}} .wss-seller-why-head h1, {{WRAPPER}} .wss-seller-why-head h2, {{WRAPPER}} .wss-seller-why-head h3, {{WRAPPER}} .wss-seller-why-head h4, {{WRAPPER}} .wss-seller-why-head h5, {{WRAPPER}} .wss-seller-why-head h6' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'heading_typography',
				'selector' => '{{WRAPPER}} .wss-seller-why-heading, {{WRAPPER}} .wss-seller-why-heading .wss-mask > span, {{WRAPPER}} .wss-seller-why-head h1, {{WRAPPER}} .wss-seller-why-head h2, {{WRAPPER}} .wss-seller-why-head h3, {{WRAPPER}} .wss-seller-why-head h4, {{WRAPPER}} .wss-seller-why-head h5, {{WRAPPER}} .wss-seller-why-head h6',
			)
		);

		$this->add_control(
			'desc_title_ctrl',
			array(
				'label'     => __( 'Description', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'desc_color',
			array(
				'label'     => __( 'Description Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-seller-why-desc' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'desc_typography',
				'selector' => '{{WRAPPER}} .wss-seller-why-desc',
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: PILLAR CARDS ================= */
		$this->start_controls_section(
			'style_cards_section',
			array(
				'label' => __( 'Pillar Cards & Image Styling', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'card_bg_color',
			array(
				'label'     => __( 'Card Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-seller-why-card' => 'background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'card_border_color',
			array(
				'label'     => __( 'Card Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-seller-why-card' => 'border-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'card_padding',
			array(
				'label'      => __( 'Card Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-seller-why-card-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'card_box_shadow',
				'selector' => '{{WRAPPER}} .wss-seller-why-card',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();

		$tag = ! empty( $s['heading_html_tag'] ) ? $s['heading_html_tag'] : 'h2';
		$theme_preset = ! empty( $s['preset_theme'] ) ? $s['preset_theme'] : 'dark';
		$preset_class = 'wss-seller-why--' . $theme_preset;

		$enable_reveal = ( ! isset( $s['enable_reveal'] ) || 'yes' === $s['enable_reveal'] );
		$pillars = ! empty( $s['pillars'] ) && is_array( $s['pillars'] ) ? $s['pillars'] : array();

		$delays = array( 'wss-r1', 'wss-r2', 'wss-r3', 'wss-r4', 'wss-r5', 'wss-r6' );
		?>
		<div class="wss-scope">
			<section class="wss-seller-why-section wss-pad <?php echo esc_attr( $preset_class ); ?>" data-wss-widget="wss-seller-why">
				<div class="wss-container">
					
					<!-- Header: Eyebrow, Heading & Narrative -->
					<div class="wss-seller-why-head">
						<div class="wss-seller-why-head-left">
							<?php if ( ! empty( $s['eyebrow'] ) ) : ?>
								<span class="wss-seller-why-eyebrow <?php echo $enable_reveal ? 'wss-reveal' : ''; ?>"><?php echo esc_html( $s['eyebrow'] ); ?></span>
							<?php endif; ?>

							<?php if ( ! empty( $s['heading'] ) ) : ?>
								<<?php echo esc_attr( $tag ); ?> class="wss-seller-why-heading <?php echo $enable_reveal ? 'wss-reveal wss-r1' : ''; ?>">
									<span class="wss-mask"><span><?php echo nl2br( esc_html( $s['heading'] ) ); ?></span></span>
								</<?php echo esc_attr( $tag ); ?>>
							<?php endif; ?>
						</div>

						<?php if ( ! empty( $s['description'] ) ) : ?>
							<div class="wss-seller-why-head-right">
								<p class="wss-seller-why-desc <?php echo $enable_reveal ? 'wss-reveal wss-r2' : ''; ?>">
									<?php echo nl2br( esc_html( $s['description'] ) ); ?>
								</p>
							</div>
						<?php endif; ?>
					</div>

					<!-- Strategic Pillars Grid with Luxury Image Cards -->
					<?php if ( ! empty( $pillars ) ) : ?>
						<div class="wss-seller-why-grid">
							<?php foreach ( $pillars as $idx => $pillar ) : 
								$stagger = $enable_reveal ? 'wss-reveal ' . $delays[ $idx % 6 ] : '';
								$has_link = ! empty( $pillar['pillar_link']['url'] );
								$card_tag = $has_link ? 'a' : 'div';
								$link_attr = $has_link ? ' href="' . esc_url( $pillar['pillar_link']['url'] ) . '"' . ( ! empty( $pillar['pillar_link']['is_external'] ) ? ' target="_blank" rel="noopener"' : '' ) : '';
							?>
								<<?php echo esc_attr( $card_tag ); ?> class="wss-seller-why-card <?php echo esc_attr( $stagger ); ?>"<?php echo $link_attr; ?>>
									
									<!-- Card Media & Image -->
									<?php if ( ! empty( $pillar['pillar_image']['url'] ) ) : ?>
										<div class="wss-seller-why-card-media">
											<img src="<?php echo esc_url( $pillar['pillar_image']['url'] ); ?>" alt="<?php echo esc_attr( $pillar['pillar_title'] ); ?>" loading="lazy" />
											<div class="wss-seller-why-card-overlay"></div>
											<?php if ( ! empty( $pillar['pillar_num'] ) ) : ?>
												<span class="wss-seller-why-watermark"><?php echo esc_html( $pillar['pillar_num'] ); ?></span>
											<?php endif; ?>
										</div>
									<?php endif; ?>

									<!-- Card Body & Content -->
									<div class="wss-seller-why-card-body">
										<?php if ( ! empty( $pillar['pillar_badge'] ) ) : ?>
											<span class="wss-seller-why-card-badge"><?php echo esc_html( $pillar['pillar_badge'] ); ?></span>
										<?php endif; ?>

										<?php if ( ! empty( $pillar['pillar_title'] ) ) : ?>
											<h3 class="wss-seller-why-card-title"><?php echo esc_html( $pillar['pillar_title'] ); ?></h3>
										<?php endif; ?>

										<?php if ( ! empty( $pillar['pillar_desc'] ) ) : ?>
											<p class="wss-seller-why-card-desc"><?php echo nl2br( esc_html( $pillar['pillar_desc'] ) ); ?></p>
										<?php endif; ?>

										<?php if ( $has_link ) : ?>
											<span class="wss-seller-why-card-link">
												<?php echo esc_html__( 'Discover Protocol', 'website-section-supporter' ); ?>
												<svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
											</span>
										<?php endif; ?>
									</div>

								</<?php echo esc_attr( $card_tag ); ?>>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<!-- Bottom Trust Banner & Metrics Strip -->
					<?php if ( ! empty( $s['show_trust_strip'] ) && 'yes' === $s['show_trust_strip'] ) : ?>
						<div class="wss-seller-why-trust-strip <?php echo $enable_reveal ? 'wss-reveal wss-r3' : ''; ?>">
							
							<!-- Stats Row -->
							<div class="wss-seller-why-stats-row">
								<?php if ( ! empty( $s['stat1_num'] ) ) : ?>
									<div class="wss-seller-why-stat-item">
										<span class="wss-seller-why-stat-val"><?php echo esc_html( $s['stat1_num'] ); ?></span>
										<span class="wss-seller-why-stat-lbl"><?php echo esc_html( $s['stat1_label'] ); ?></span>
									</div>
								<?php endif; ?>

								<?php if ( ! empty( $s['stat2_num'] ) ) : ?>
									<div class="wss-seller-why-stat-item">
										<span class="wss-seller-why-stat-val"><?php echo esc_html( $s['stat2_num'] ); ?></span>
										<span class="wss-seller-why-stat-lbl"><?php echo esc_html( $s['stat2_label'] ); ?></span>
									</div>
								<?php endif; ?>

								<?php if ( ! empty( $s['stat3_num'] ) ) : ?>
									<div class="wss-seller-why-stat-item">
										<span class="wss-seller-why-stat-val"><?php echo esc_html( $s['stat3_num'] ); ?></span>
										<span class="wss-seller-why-stat-lbl"><?php echo esc_html( $s['stat3_label'] ); ?></span>
									</div>
								<?php endif; ?>
							</div>

							<!-- Editorial Quote -->
							<?php if ( ! empty( $s['trust_quote'] ) ) : ?>
								<div class="wss-seller-why-quote-box">
									<blockquote class="wss-seller-why-quote"><?php echo esc_html( $s['trust_quote'] ); ?></blockquote>
									<?php if ( ! empty( $s['trust_author'] ) ) : ?>
										<cite class="wss-seller-why-author"><?php echo esc_html( $s['trust_author'] ); ?></cite>
									<?php endif; ?>
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
