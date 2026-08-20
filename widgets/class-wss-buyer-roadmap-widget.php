<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class WSS_Buyer_Roadmap_Widget extends Widget_Base {

	public function get_name() {
		return 'wss_buyer_roadmap';
	}

	public function get_title() {
		return __( 'WSS — Strategic Buyer Roadmap', 'website-section-supporter' );
	}

	public function get_icon() {
		return 'eicon-flow';
	}

	public function get_categories() {
		return array( 'website-section-supporter' );
	}

	public function get_keywords() {
		return array( 'buyer', 'roadmap', 'process', 'strategy', 'framework', 'phases', 'luxury', 'vpsignature' );
	}

	protected function register_controls() {

		/* ================= CONTENT: SECTION HEADER ================= */
		$this->start_controls_section(
			'section_content_header',
			array(
				'label' => __( 'Section Header', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'       => __( 'Eyebrow Text', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '02 // STRATEGIC BUYER ROADMAP', 'website-section-supporter' ),
				'placeholder' => __( '02 // STRATEGIC BUYER ROADMAP', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Section Heading', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'A Disciplined, Executive Acquisition Framework', 'website-section-supporter' ),
				'placeholder' => __( 'Enter section heading', 'website-section-supporter' ),
				'rows'        => 2,
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
					'div'  => 'div',
					'span' => 'span',
				),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'       => __( 'Lead Description', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Purchasing premier real estate involves nuanced variables—micro-market valuation, dock permits, lakefront riparian rights, HOA bylaws, and protective contract structuring. We manage every acquisition as a rigorous advisory project.', 'website-section-supporter' ),
				'placeholder' => __( 'Enter section description', 'website-section-supporter' ),
				'rows'        => 4,
			)
		);

		$this->end_controls_section();

		/* ================= CONTENT: ROADMAP PHASES ================= */
		$this->start_controls_section(
			'section_content_phases',
			array(
				'label' => __( 'Roadmap Phases', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'phase_badge',
			array(
				'label'       => __( 'Phase Badge Text', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Phase 01', 'website-section-supporter' ),
			)
		);

		$repeater->add_control(
			'watermark_number',
			array(
				'label'       => __( 'Watermark Number', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '01',
			)
		);

		$repeater->add_control(
			'title',
			array(
				'label'       => __( 'Phase Title', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Consultation & Alignment', 'website-section-supporter' ),
			)
		);

		$repeater->add_control(
			'description',
			array(
				'label'       => __( 'Phase Description', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'We clarify your lifestyle vision, tax considerations, architectural aesthetics, and timeline while establishing a tailored acquisition criteria profile.', 'website-section-supporter' ),
				'rows'        => 4,
			)
		);

		$repeater->add_control(
			'milestone_text',
			array(
				'label'       => __( 'Deliverable / Milestone Text', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Deliverable: Acquisition Blueprint', 'website-section-supporter' ),
			)
		);

		$repeater->add_control(
			'milestone_icon',
			array(
				'label'   => __( 'Milestone Icon', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'check',
				'options' => array(
					'check' => __( 'Checkmark', 'website-section-supporter' ),
					'arrow' => __( 'Arrow Right', 'website-section-supporter' ),
					'star'  => __( 'Star', 'website-section-supporter' ),
					'none'  => __( 'None', 'website-section-supporter' ),
				),
			)
		);

		$this->add_control(
			'phases_list',
			array(
				'label'       => __( 'Phases List', 'website-section-supporter' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ phase_badge }}} - {{{ title }}}',
				'default'     => array(
					array(
						'phase_badge'      => __( 'Phase 01', 'website-section-supporter' ),
						'watermark_number' => '01',
						'title'            => __( 'Consultation & Alignment', 'website-section-supporter' ),
						'description'      => __( 'We clarify your lifestyle vision, tax considerations, architectural aesthetics, and timeline while establishing a tailored acquisition criteria profile.', 'website-section-supporter' ),
						'milestone_text'   => __( 'Deliverable: Acquisition Blueprint', 'website-section-supporter' ),
						'milestone_icon'   => 'check',
					),
					array(
						'phase_badge'      => __( 'Phase 02', 'website-section-supporter' ),
						'watermark_number' => '02',
						'title'            => __( 'Curated Discovery', 'website-section-supporter' ),
						'description'      => __( 'Beyond public MLS inventory, we unlock discreet off-market opportunities, provide micro-market valuation metrics, and conduct private previews.', 'website-section-supporter' ),
						'milestone_text'   => __( 'Deliverable: Private Dossier & Tours', 'website-section-supporter' ),
						'milestone_icon'   => 'check',
					),
					array(
						'phase_badge'      => __( 'Phase 03', 'website-section-supporter' ),
						'watermark_number' => '03',
						'title'            => __( 'Strategic Negotiation', 'website-section-supporter' ),
						'description'      => __( 'Leveraging deep commercial and residential acumen, we craft disciplined offers that protect capital, optimize inspection terms, and secure the asset.', 'website-section-supporter' ),
						'milestone_text'   => __( 'Deliverable: Protected Contract Structuring', 'website-section-supporter' ),
						'milestone_icon'   => 'check',
					),
					array(
						'phase_badge'      => __( 'Phase 04', 'website-section-supporter' ),
						'watermark_number' => '04',
						'title'            => __( 'Closing & Handover', 'website-section-supporter' ),
						'description'      => __( 'Complete escrow oversight, title audit, contractor recommendations, and concierge onboarding to ensure a frictionless transition into your new home.', 'website-section-supporter' ),
						'milestone_text'   => __( 'Deliverable: White-Glove Key Exchange', 'website-section-supporter' ),
						'milestone_icon'   => 'check',
					),
				),
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: CONTAINER & LAYOUT ================= */
		$this->start_controls_section(
			'style_container_layout',
			array(
				'label' => __( 'Container & Grid Layout', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'section_padding',
			array(
				'label'      => __( 'Section Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'vh' ),
				'default'    => array(
					'top'      => '110',
					'bottom'   => '110',
					'left'     => '0',
					'right'    => '0',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .wss-buyer-roadmap-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'section_bg_color',
			array(
				'label'     => __( 'Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f8f8f7',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-section' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'grid_columns',
			array(
				'label'     => __( 'Grid Columns', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '4',
				'options'   => array(
					'1' => '1 Column',
					'2' => '2 Columns',
					'3' => '3 Columns',
					'4' => '4 Columns',
				),
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
				),
			)
		);

		$this->add_responsive_control(
			'grid_gap',
			array(
				'label'      => __( 'Grid Gap', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em' ),
				'default'    => array( 'unit' => 'px', 'size' => 24 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-buyer-roadmap-grid' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: CARD STYLING ================= */
		$this->start_controls_section(
			'style_card_settings',
			array(
				'label' => __( 'Phase Card Style', 'website-section-supporter' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'card_padding',
			array(
				'label'      => __( 'Card Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'default'    => array(
					'top'      => '46',
					'right'    => '32',
					'bottom'   => '36',
					'left'     => '32',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .wss-buyer-roadmap-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'card_bg_color',
			array(
				'label'     => __( 'Card Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-card' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'card_border_color',
			array(
				'label'     => __( 'Card Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#e2dfda',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-card' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'card_hover_border_color',
			array(
				'label'     => __( 'Hover Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0d0d0d',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-card:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'card_top_accent_color',
			array(
				'label'     => __( 'Top Hover Accent Line Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0d0d0d',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-card::before' => 'background-color: {{VALUE}};',
				),
			)
		);

		// Watermark Number
		$this->add_control(
			'heading_style_watermark',
			array(
				'label'     => __( 'Watermark Number', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'watermark_color',
			array(
				'label'     => __( 'Watermark Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(0, 0, 0, 0.04)',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-watermark' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'watermark_hover_color',
			array(
				'label'     => __( 'Hover Watermark Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(0, 0, 0, 0.08)',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-card:hover .wss-buyer-roadmap-watermark' => 'color: {{VALUE}};',
				),
			)
		);

		// Phase Badge Pill
		$this->add_control(
			'heading_style_phase_pill',
			array(
				'label'     => __( 'Phase Pill Badge', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'phase_pill_color',
			array(
				'label'     => __( 'Pill Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0d0d0d',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-phase-pill' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'phase_pill_bg',
			array(
				'label'     => __( 'Pill Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f8f8f7',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-phase-pill' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'phase_pill_border',
			array(
				'label'     => __( 'Pill Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#e2dfda',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-phase-pill' => 'border-color: {{VALUE}};',
				),
			)
		);

		// Phase Title & Desc
		$this->add_control(
			'heading_style_phase_text',
			array(
				'label'     => __( 'Phase Title & Description', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'phase_title_color',
			array(
				'label'     => __( 'Phase Title Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0d0d0d',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-card-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'phase_title_typography',
				'selector' => '{{WRAPPER}} .wss-buyer-roadmap-card-title',
			)
		);

		$this->add_control(
			'phase_desc_color',
			array(
				'label'     => __( 'Phase Description Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#555555',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-card-desc' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'phase_desc_typography',
				'selector' => '{{WRAPPER}} .wss-buyer-roadmap-card-desc',
			)
		);

		// Milestone styling
		$this->add_control(
			'heading_style_milestone',
			array(
				'label'     => __( 'Milestone Deliverable Line', 'website-section-supporter' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'milestone_color',
			array(
				'label'     => __( 'Milestone Text & Icon Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0d0d0d',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-milestone' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'milestone_border_color',
			array(
				'label'     => __( 'Milestone Top Divider Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#e2dfda',
				'selectors' => array(
					'{{WRAPPER}} .wss-buyer-roadmap-milestone' => 'border-top-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	private function render_milestone_icon( $key ) {
		switch ( $key ) {
			case 'check':
				return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>';
			case 'arrow':
				return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>';
			case 'star':
				return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>';
			default:
				return '';
		}
	}

	protected function render() {
		$s = $this->get_settings_for_display();

		$tag = ! empty( $s['heading_html_tag'] ) ? $s['heading_html_tag'] : 'h2';
		$phases = ! empty( $s['phases_list'] ) ? $s['phases_list'] : array();
		?>
		<div class="wss-scope">
			<section class="wss-buyer-roadmap-section wss-pad" data-wss-widget="wss-buyer-roadmap">
				<div class="wss-container">
					
					<!-- Header -->
					<div class="wss-buyer-roadmap-head">
						<?php if ( ! empty( $s['eyebrow'] ) ) : ?>
							<span class="wss-buyer-roadmap-eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></span>
						<?php endif; ?>

						<?php if ( ! empty( $s['heading'] ) ) : ?>
							<<?php echo esc_attr( $tag ); ?> class="wss-buyer-roadmap-heading">
								<?php echo nl2br( esc_html( $s['heading'] ) ); ?>
							</<?php echo esc_attr( $tag ); ?>>
						<?php endif; ?>

						<?php if ( ! empty( $s['description'] ) ) : ?>
							<p class="wss-buyer-roadmap-desc">
								<?php echo nl2br( esc_html( $s['description'] ) ); ?>
							</p>
						<?php endif; ?>
					</div>

					<!-- Phases Grid -->
					<?php if ( ! empty( $phases ) ) : ?>
						<div class="wss-buyer-roadmap-grid">
							<?php foreach ( $phases as $item ) : 
								$icon_html = ! empty( $item['milestone_icon'] ) && 'none' !== $item['milestone_icon'] ? $this->render_milestone_icon( $item['milestone_icon'] ) : '';
							?>
								<div class="wss-buyer-roadmap-card elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
									
									<?php if ( ! empty( $item['watermark_number'] ) ) : ?>
										<span class="wss-buyer-roadmap-watermark"><?php echo esc_html( $item['watermark_number'] ); ?></span>
									<?php endif; ?>

									<div class="wss-buyer-roadmap-card-body">
										<?php if ( ! empty( $item['phase_badge'] ) ) : ?>
											<div class="wss-buyer-roadmap-phase-pill"><?php echo esc_html( $item['phase_badge'] ); ?></div>
										<?php endif; ?>

										<?php if ( ! empty( $item['title'] ) ) : ?>
											<h3 class="wss-buyer-roadmap-card-title"><?php echo esc_html( $item['title'] ); ?></h3>
										<?php endif; ?>

										<?php if ( ! empty( $item['description'] ) ) : ?>
											<p class="wss-buyer-roadmap-card-desc"><?php echo nl2br( esc_html( $item['description'] ) ); ?></p>
										<?php endif; ?>
									</div>

									<?php if ( ! empty( $item['milestone_text'] ) ) : ?>
										<div class="wss-buyer-roadmap-milestone">
											<?php if ( ! empty( $icon_html ) ) echo $icon_html; ?>
											<span><?php echo esc_html( $item['milestone_text'] ); ?></span>
										</div>
									<?php endif; ?>

								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

				</div>
			</section>
		</div>
		<?php
	}
}
