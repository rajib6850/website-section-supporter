<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

class WSS_Stats_Widget extends Widget_Base {

	public function get_name() { return 'wss_stats'; }
	public function get_title() { return __( 'WSS — Proven Results / Stats', 'website-section-supporter' ); }
	public function get_icon() { return 'eicon-counter'; }
	public function get_categories() { return array( 'website-section-supporter' ); }
	public function get_keywords() { return array( 'stats', 'counter', 'results' ); }

	protected function register_controls() {

		/* ================= CONTENT ================= */
		$this->start_controls_section( 'section_content', array( 'label' => __( 'Content', 'website-section-supporter' ) ) );
		$this->add_control( 'heading', array( 'label' => __( 'Heading', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'Proven Results', 'website-section-supporter' ) ) );
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
		$this->add_control( 'sub1', array( 'label' => __( 'Sub Line 1', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'WITH OVER TWO DECADES OF PRACTICE', 'website-section-supporter' ) ) );
		$this->add_control( 'sub2', array( 'label' => __( 'Sub Line 2', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( "TRUSTED BY THE WORLD'S MOST DISCERNING FAMILIES", 'website-section-supporter' ) ) );
		$this->add_control( 'description', array( 'label' => __( 'Description', 'website-section-supporter' ), 'type' => Controls_Manager::TEXTAREA, 'default' => __( 'We represent a small number of extraordinary properties each year, chosen for character rather than count. Our team has closed record sales across multiple countries — with the same premium standard as the industry\'s biggest names, at a price that makes sense. Built by Digitize Growth — luxury real estate websites from $1,499, live in 14 days.', 'website-section-supporter' ) ) );
		$this->end_controls_section();

		$this->start_controls_section( 'section_stats', array( 'label' => __( 'Stats', 'website-section-supporter' ) ) );
		$repeater = new Repeater();
		$repeater->add_control( 'number', array( 'label' => __( 'Number', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => '$2.1B' ) );
		$repeater->add_control( 'label', array( 'label' => __( 'Label', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'In Career Sales', 'website-section-supporter' ) ) );
		$this->add_control(
			'stats',
			array(
				'label'       => __( 'Stat Items', 'website-section-supporter' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array( 'number' => '$2.1B', 'label' => 'In Career Sales' ),
					array( 'number' => '#1', 'label' => 'Advisor, Coastal Markets' ),
					array( 'number' => '$327M', 'label' => 'Total Sales in 2025' ),
					array( 'number' => '#1', 'label' => 'Ranked Global Partner' ),
				),
				'title_field' => '{{{ number }}} — {{{ label }}}',
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: SECTION ================= */
		$this->start_controls_section(
			'style_section',
			array( 'label' => __( 'Section', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
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

		/* ================= STYLE: HEADING BLOCK ================= */
		$this->start_controls_section(
			'style_heading',
			array( 'label' => __( 'Heading Block', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_control( 'eyebrow_heading', array( 'label' => __( 'Eyebrow', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING ) );
		$this->add_control(
			'eyebrow_color',
			array( 'label' => __( 'Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-results-head > .wss-eyebrow' => 'color: {{VALUE}};' ) )
		);
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'eyebrow_typography', 'selector' => '{{WRAPPER}} .wss-results-head > .wss-eyebrow' ) );

		$this->add_control( 'heading_heading', array( 'label' => __( 'Heading', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_control(
			'heading_color',
			array( 'label' => __( 'Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-results-head h1, {{WRAPPER}} .wss-results-head h2, {{WRAPPER}} .wss-results-head h3, {{WRAPPER}} .wss-results-head h4, {{WRAPPER}} .wss-results-head h5, {{WRAPPER}} .wss-results-head h6, {{WRAPPER}} .wss-results-head .wss-mask > span' => 'color: {{VALUE}} !important;' ) )
		);
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'heading_typography', 'selector' => '{{WRAPPER}} .wss-results-head h1, {{WRAPPER}} .wss-results-head h2, {{WRAPPER}} .wss-results-head h3, {{WRAPPER}} .wss-results-head h4, {{WRAPPER}} .wss-results-head h5, {{WRAPPER}} .wss-results-head h6, {{WRAPPER}} .wss-results-head .wss-mask > span' ) );

		$this->add_control( 'sub_heading', array( 'label' => __( 'Sub Lines', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_control(
			'sub_color',
			array( 'label' => __( 'Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array(
				'{{WRAPPER}} .wss-sub1' => 'color: {{VALUE}};',
				'{{WRAPPER}} .wss-sub2' => 'color: {{VALUE}};',
			) )
		);
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'sub_typography', 'selector' => '{{WRAPPER}} .wss-sub1, {{WRAPPER}} .wss-sub2' ) );

		$this->add_control( 'desc_heading', array( 'label' => __( 'Description', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_control(
			'desc_color',
			array( 'label' => __( 'Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-results-head p' => 'color: {{VALUE}};' ) )
		);
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'desc_typography', 'selector' => '{{WRAPPER}} .wss-results-head p' ) );
		$this->end_controls_section();

		/* ================= STYLE: STAT ITEMS ================= */
		$this->start_controls_section(
			'style_stats',
			array( 'label' => __( 'Stat Items', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_responsive_control(
			'stats_gap',
			array(
				'label'     => __( 'Gap Between Items', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 200 ) ),
				'selectors' => array( '{{WRAPPER}} .wss-stats' => 'gap: {{SIZE}}{{UNIT}};' ),
			)
		);
		$this->add_control( 'num_heading', array( 'label' => __( 'Number', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_control(
			'num_color',
			array( 'label' => __( 'Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'default' => '#ffffff', 'selectors' => array( '{{WRAPPER}} .wss-stat .wss-num' => 'color: {{VALUE}};' ) )
		);
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'num_typography', 'selector' => '{{WRAPPER}} .wss-stat .wss-num' ) );

		$this->add_control( 'lbl_heading', array( 'label' => __( 'Label', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_control(
			'lbl_color',
			array( 'label' => __( 'Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-stat .wss-lbl' => 'color: {{VALUE}};' ) )
		);
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'lbl_typography', 'selector' => '{{WRAPPER}} .wss-stat .wss-lbl' ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		?>
		<div class="wss-scope">
			<section class="wss-pad wss-on-taupe">
				<div class="wss-container">
					<div class="wss-results-head wss-reveal">
						<span class="wss-eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></span>
						<?php $tag = ! empty( $s['heading_html_tag'] ) ? $s['heading_html_tag'] : 'h2'; ?>
						<<?php echo esc_attr( $tag ); ?>><span class="wss-mask"><span><?php echo esc_html( $s['heading'] ); ?></span></span></<?php echo esc_attr( $tag ); ?>>
						<?php if ( ! empty( $s['sub1'] ) ) : ?><div class="wss-sub1"><?php echo esc_html( $s['sub1'] ); ?></div><?php endif; ?>
						<?php if ( ! empty( $s['sub2'] ) ) : ?><div class="wss-sub2"><?php echo esc_html( $s['sub2'] ); ?></div><?php endif; ?>
						<?php if ( ! empty( $s['description'] ) ) : ?><p><?php echo esc_html( $s['description'] ); ?></p><?php endif; ?>
					</div>
					<div class="wss-stats">
						<?php $delay_classes = array( 'wss-r1', 'wss-r2', 'wss-r3', 'wss-r4' ); $i = 0; ?>
						<?php foreach ( $s['stats'] as $stat ) : ?>
							<div class="wss-stat wss-reveal <?php echo esc_attr( $delay_classes[ $i % 4 ] ); ?>"> <?php $i++; ?>
								<div class="wss-num"><?php echo esc_html( $stat['number'] ); ?></div>
								<div class="wss-lbl"><?php echo esc_html( $stat['label'] ); ?></div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
		</div>
		<?php
	}
}
