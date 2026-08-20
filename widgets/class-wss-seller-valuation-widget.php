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
 * WSS Home Valuation & Advisory Showcase Widget
 * High-converting architectural asset valuation showcase with dual action buttons linking to /evaluation and /contact-us.
 */
class WSS_Seller_Valuation_Widget extends Widget_Base {

	public function get_name() {
		return 'wss_seller_valuation';
	}

	public function get_title() {
		return __( 'WSS — Home Valuation & Advisory Showcase', 'website-section-supporter' );
	}

	public function get_icon() {
		return 'eicon-analytics';
	}

	public function get_categories() {
		return array( 'website-section-supporter' );
	}

	public function get_keywords() {
		return array( 'seller', 'valuation', 'home worth', 'evaluation', 'cma', 'contact', 'luxury', 'real estate', 'vpsignature' );
	}

	protected function register_controls() {

		/* ================= CONTENT: SHOWCASE & MESSAGING ================= */
		$this->start_controls_section(
			'section_content_main',
			array(
				'label' => __( 'Valuation Showcase & Messaging', 'website-section-supporter' ),
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
				'default'     => __( '04 // COMPLIMENTARY MARKET ANALYSIS', 'website-section-supporter' ),
				'placeholder' => __( '04 // COMPLIMENTARY MARKET ANALYSIS', 'website-section-supporter' ),
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Main Heading', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => "DISCOVER THE TRUE MARKET\nVALUE OF YOUR PROPERTY.",
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
					'div'  => 'div',
					'span' => 'span',
				),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'       => __( 'Description / Valuation Advisory', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 4,
				'default'     => __( 'Accurate asset valuation requires deep submarket intelligence, micro-trend pricing velocity, and refined comparable analysis. Request a discreet, data-backed portfolio valuation prepared personally by Victoria Price.', 'website-section-supporter' ),
				'placeholder' => __( 'Enter valuation narrative...', 'website-section-supporter' ),
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

		/* ================= CONTENT: VALUE BULLETS ================= */
		$this->start_controls_section(
			'section_content_bullets',
			array(
				'label' => __( 'Strategic Valuation Highlights', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'bullet_bold',
			array(
				'label'       => __( 'Bold Title / Prefix', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Comprehensive CMA:', 'website-section-supporter' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'bullet_text',
			array(
				'label'       => __( 'Highlight Text', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 2,
				'default'     => __( 'Deep analysis of recent comparable sales, active inventory, and price-per-sq-ft trajectories.', 'website-section-supporter' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'bullets',
			array(
				'label'       => __( 'Highlights List', 'website-section-supporter' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ bullet_bold }}} {{{ bullet_text }}}',
				'default'     => array(
					array(
						'bullet_bold' => __( 'Comprehensive CMA:', 'website-section-supporter' ),
						'bullet_text' => __( 'Deep analysis of recent comparable sales, active inventory, and price-per-sq-ft trajectories.', 'website-section-supporter' ),
					),
					array(
						'bullet_bold' => __( 'Discreet & Confidential:', 'website-section-supporter' ),
						'bullet_text' => __( 'Complete privacy protection for off-market evaluations and estate portfolio assessments.', 'website-section-supporter' ),
					),
					array(
						'bullet_bold' => __( 'Strategic Positioning:', 'website-section-supporter' ),
						'bullet_text' => __( 'Zero-obligation professional guidance on optimal timing, staging, and capital returns.', 'website-section-supporter' ),
					),
				),
			)
		);

		$this->end_controls_section();

		/* ================= CONTENT: DUAL ACTION BUTTONS ================= */
		$this->start_controls_section(
			'section_content_actions',
			array(
				'label' => __( 'Action Buttons (Evaluation & Contact)', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'btn1_heading',
			array(
				'label'     => __( 'Primary Button (Home Evaluation)', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'show_btn1',
			array(
				'label'        => __( 'Show Primary Button', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'btn1_text',
			array(
				'label'       => __( 'Primary Button Text', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'GET HOME EVALUATION', 'website-section-supporter' ),
				'placeholder' => __( 'GET HOME EVALUATION', 'website-section-supporter' ),
				'condition'   => array( 'show_btn1' => 'yes' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'btn1_link',
			array(
				'label'       => __( 'Primary Button Link', 'website-section-supporter' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( '/evaluation', 'website-section-supporter' ),
				'default'     => array( 'url' => '/evaluation' ),
				'condition'   => array( 'show_btn1' => 'yes' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'btn1_style',
			array(
				'label'     => __( 'Primary Button Preset', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'pill',
				'options'   => array(
					'pill'  => __( 'Luxury Pill (Curtain Sweep)', 'website-section-supporter' ),
					'solid' => __( 'Solid Rectangle', 'website-section-supporter' ),
					'line'  => __( 'Underline Link', 'website-section-supporter' ),
				),
				'condition' => array( 'show_btn1' => 'yes' ),
			)
		);

		$this->add_control(
			'btn2_heading',
			array(
				'label'     => __( 'Secondary Button (Contact Page)', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'show_btn2',
			array(
				'label'        => __( 'Show Secondary Button', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'btn2_text',
			array(
				'label'       => __( 'Secondary Button Text', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'SPEAK WITH AN ADVISOR', 'website-section-supporter' ),
				'placeholder' => __( 'SPEAK WITH AN ADVISOR', 'website-section-supporter' ),
				'condition'   => array( 'show_btn2' => 'yes' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'btn2_link',
			array(
				'label'       => __( 'Secondary Button Link', 'website-section-supporter' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( '/contact-us', 'website-section-supporter' ),
				'default'     => array( 'url' => '/contact-us' ),
				'condition'   => array( 'show_btn2' => 'yes' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'btn2_style',
			array(
				'label'     => __( 'Secondary Button Preset', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'line',
				'options'   => array(
					'line'  => __( 'Underline Link', 'website-section-supporter' ),
					'pill'  => __( 'Luxury Pill (Curtain Sweep)', 'website-section-supporter' ),
					'solid' => __( 'Solid Rectangle', 'website-section-supporter' ),
				),
				'condition' => array( 'show_btn2' => 'yes' ),
			)
		);

		$this->end_controls_section();

		/* ================= CONTENT: ARCHITECTURAL MEDIA & BADGE ================= */
		$this->start_controls_section(
			'section_content_media',
			array(
				'label' => __( 'Architectural Card & Background', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'card_image',
			array(
				'label'   => __( 'Showcase Feature Image', 'website-section-supporter' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => 'https://images.unsplash.com/photo-1600585154526-990dced4db0d?auto=format&fit=crop&w=1200&q=85',
				),
			)
		);

		$this->add_control(
			'show_badge',
			array(
				'label'        => __( 'Display Floating Trust Badge', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'badge_tag',
			array(
				'label'     => __( 'Badge Eyebrow / Tag', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( '2026 MARKET INTELLIGENCE', 'website-section-supporter' ),
				'condition' => array( 'show_badge' => 'yes' ),
			)
		);

		$this->add_control(
			'badge_title',
			array(
				'label'     => __( 'Badge Title', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'CONFIDENTIAL ASSET ADVISORY', 'website-section-supporter' ),
				'condition' => array( 'show_badge' => 'yes' ),
			)
		);

		$this->add_control(
			'badge_sub',
			array(
				'label'     => __( 'Badge Subtitle', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Premier Central Florida Portfolio Assessment', 'website-section-supporter' ),
				'condition' => array( 'show_badge' => 'yes' ),
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: CONTAINER & BACKGROUND ================= */
		$this->start_controls_section(
			'style_container_section',
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
					'{{WRAPPER}} .wss-seller-valuation-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'section_bg',
				'label'    => __( 'Section Background', 'website-section-supporter' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .wss-seller-valuation-section',
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
			'eyebrow_color',
			array(
				'label'     => __( 'Eyebrow Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-seller-valuation-eyebrow' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'eyebrow_typography',
				'selector' => '{{WRAPPER}} .wss-seller-valuation-eyebrow',
			)
		);

		$this->add_control(
			'heading_color',
			array(
				'label'     => __( 'Heading Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-seller-valuation-heading, {{WRAPPER}} .wss-seller-valuation-heading .wss-mask > span' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'heading_typography',
				'selector' => '{{WRAPPER}} .wss-seller-valuation-heading, {{WRAPPER}} .wss-seller-valuation-heading .wss-mask > span',
			)
		);

		$this->add_control(
			'desc_color',
			array(
				'label'     => __( 'Description Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-seller-valuation-desc' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'desc_typography',
				'selector' => '{{WRAPPER}} .wss-seller-valuation-desc',
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: BUTTONS ================= */
		$this->start_controls_section(
			'style_buttons_section',
			array(
				'label' => __( 'Buttons Styling', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'btn1_color',
			array(
				'label'     => __( 'Primary Button Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-seller-valuation-btn-primary' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'btn1_border_color',
			array(
				'label'     => __( 'Primary Button Border', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-seller-valuation-btn-primary' => 'border-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'btn2_color',
			array(
				'label'     => __( 'Secondary Button Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-seller-valuation-btn-secondary' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_section();
	}

	private function render_arrow_svg() {
		return '<svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>';
	}

	protected function render() {
		$s = $this->get_settings_for_display();

		$tag = ! empty( $s['heading_html_tag'] ) ? $s['heading_html_tag'] : 'h2';
		$theme_preset = ! empty( $s['preset_theme'] ) ? $s['preset_theme'] : 'dark';
		$preset_class = 'wss-seller-valuation--' . $theme_preset;

		$enable_reveal = ( ! isset( $s['enable_reveal'] ) || 'yes' === $s['enable_reveal'] );
		$bullets = ! empty( $s['bullets'] ) && is_array( $s['bullets'] ) ? $s['bullets'] : array();

		$btn1_text = ! empty( $s['btn1_text'] ) ? $s['btn1_text'] : __( 'Get Home Evaluation', 'website-section-supporter' );
		$btn2_text = ! empty( $s['btn2_text'] ) ? $s['btn2_text'] : __( 'Speak with an Advisor', 'website-section-supporter' );

		$show_btn1 = ( ! isset( $s['show_btn1'] ) || 'yes' === $s['show_btn1'] ) && ! empty( $btn1_text );
		$show_btn2 = ( ! isset( $s['show_btn2'] ) || 'yes' === $s['show_btn2'] ) && ! empty( $btn2_text );

		$btn1_style = ! empty( $s['btn1_style'] ) ? 'wss-btn-' . $s['btn1_style'] : 'wss-btn-pill';
		$btn2_style = ! empty( $s['btn2_style'] ) ? 'wss-btn-' . $s['btn2_style'] : 'wss-btn-line';

		$btn1_url = ! empty( $s['btn1_link']['url'] ) ? esc_url( $s['btn1_link']['url'] ) : '/evaluation';
		$btn2_url = ! empty( $s['btn2_link']['url'] ) ? esc_url( $s['btn2_link']['url'] ) : '/contact-us';
		?>
		<div class="wss-scope">
			<section class="wss-seller-valuation-section wss-pad <?php echo esc_attr( $preset_class ); ?>" data-wss-widget="wss-seller-valuation">
				<div class="wss-container">
					
					<div class="wss-seller-valuation-wrapper">
						
						<!-- Left: Valuation Narrative & Action Controls -->
						<div class="wss-seller-valuation-left">
							<?php if ( ! empty( $s['eyebrow'] ) ) : ?>
								<span class="wss-seller-valuation-eyebrow <?php echo $enable_reveal ? 'wss-reveal' : ''; ?>"><?php echo esc_html( $s['eyebrow'] ); ?></span>
							<?php endif; ?>

							<?php if ( ! empty( $s['heading'] ) ) : ?>
								<<?php echo esc_attr( $tag ); ?> class="wss-seller-valuation-heading <?php echo $enable_reveal ? 'wss-reveal wss-r1' : ''; ?>">
									<span class="wss-mask"><span><?php echo nl2br( esc_html( $s['heading'] ) ); ?></span></span>
								</<?php echo esc_attr( $tag ); ?>>
							<?php endif; ?>

							<?php if ( ! empty( $s['description'] ) ) : ?>
								<p class="wss-seller-valuation-desc <?php echo $enable_reveal ? 'wss-reveal wss-r2' : ''; ?>">
									<?php echo nl2br( esc_html( $s['description'] ) ); ?>
								</p>
							<?php endif; ?>

							<!-- Strategic Value Bullets -->
							<?php if ( ! empty( $bullets ) ) : ?>
								<div class="wss-seller-valuation-bullets <?php echo $enable_reveal ? 'wss-reveal wss-r3' : ''; ?>">
									<?php foreach ( $bullets as $b_idx => $bullet ) : ?>
										<div class="wss-seller-valuation-bullet-item">
											<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
											<span>
												<?php if ( ! empty( $bullet['bullet_bold'] ) ) : ?>
													<strong><?php echo esc_html( $bullet['bullet_bold'] ); ?></strong> 
												<?php endif; ?>
												<?php echo esc_html( $bullet['bullet_text'] ); ?>
											</span>
										</div>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>

							<!-- Dual Action Buttons (Side by Side on Desktop, Stacked on Mobile) -->
							<?php if ( $show_btn1 || $show_btn2 ) : ?>
								<div class="wss-seller-valuation-actions <?php echo $enable_reveal ? 'wss-reveal wss-r4' : ''; ?>">
									<?php if ( $show_btn1 ) : ?>
										<a class="<?php echo esc_attr( $btn1_style ); ?> wss-seller-valuation-btn-primary" href="<?php echo $btn1_url; ?>"<?php echo ! empty( $s['btn1_link']['is_external'] ) ? ' target="_blank" rel="noopener"' : ''; ?>>
											<?php echo esc_html( $btn1_text ); ?>
											<?php echo $this->render_arrow_svg(); ?>
										</a>
									<?php endif; ?>

									<?php if ( $show_btn2 ) : ?>
										<a class="<?php echo esc_attr( $btn2_style ); ?> wss-seller-valuation-btn-secondary" href="<?php echo $btn2_url; ?>"<?php echo ! empty( $s['btn2_link']['is_external'] ) ? ' target="_blank" rel="noopener"' : ''; ?>>
											<?php echo esc_html( $btn2_text ); ?>
											<?php echo $this->render_arrow_svg(); ?>
										</a>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</div>

						<!-- Right: Architectural Media Frame & Floating Badge -->
						<div class="wss-seller-valuation-right <?php echo $enable_reveal ? 'wss-reveal wss-r2' : ''; ?>">
							<?php if ( ! empty( $s['card_image']['url'] ) ) : ?>
								<div class="wss-seller-valuation-media-wrap">
									<div class="wss-seller-valuation-frame">
										<img src="<?php echo esc_url( $s['card_image']['url'] ); ?>" alt="<?php echo esc_attr__( 'Luxury Property Valuation', 'website-section-supporter' ); ?>" class="wss-seller-valuation-img" loading="lazy" />
										<div class="wss-seller-valuation-overlay"></div>
									</div>

									<?php if ( ! empty( $s['show_badge'] ) && 'yes' === $s['show_badge'] ) : ?>
										<div class="wss-seller-valuation-badge">
											<?php if ( ! empty( $s['badge_tag'] ) ) : ?>
												<span class="wss-seller-valuation-badge-tag"><?php echo esc_html( $s['badge_tag'] ); ?></span>
											<?php endif; ?>
											<?php if ( ! empty( $s['badge_title'] ) ) : ?>
												<div class="wss-seller-valuation-badge-title"><?php echo esc_html( $s['badge_title'] ); ?></div>
											<?php endif; ?>
											<?php if ( ! empty( $s['badge_sub'] ) ) : ?>
												<div class="wss-seller-valuation-badge-sub"><?php echo esc_html( $s['badge_sub'] ); ?></div>
											<?php endif; ?>
										</div>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</div>

					</div>

				</div>
			</section>
		</div>
		<?php
	}
}
