<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class WSS_Text_Widget extends Widget_Base {

	public function get_name() {
		return 'wss_text';
	}

	public function get_title() {
		return __( 'WSS — Luxury Text & Editorial', 'website-section-supporter' );
	}

	public function get_icon() {
		return 'eicon-text-area';
	}

	public function get_categories() {
		return array( 'website-section-supporter' );
	}

	public function get_keywords() {
		return array( 'text', 'paragraph', 'editorial', 'quote', 'dropcap', 'typography', 'luxury', 'wss', 'content' );
	}

	protected function register_controls() {

		/* ================= CONTENT: TEXT EDITOR ================= */
		$this->start_controls_section(
			'section_text_content',
			array( 'label' => __( 'Text Content', 'website-section-supporter' ) )
		);
		$this->add_control(
			'content',
			array(
				'label'       => __( 'Content', 'website-section-supporter' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => __( '<p>Perched above the city with commanding panoramic horizons, every square inch of this architectural sanctuary has been curated with bespoke craftsmanship, rare imported materials, and timeless sophistication.</p><p>Designed for the world’s most discerning collectors, the estate seamlessly bridges indoor grandeur with outdoor resort living.</p>', 'website-section-supporter' ),
				'dynamic'     => array( 'active' => true ),
			)
		);
		$this->end_controls_section();

		/* ================= CONTENT: EDITORIAL ENHANCEMENTS ================= */
		$this->start_controls_section(
			'section_editorial',
			array( 'label' => __( 'Editorial Enhancements', 'website-section-supporter' ) )
		);
		$this->add_control(
			'enable_dropcap',
			array(
				'label'        => __( 'Editorial Drop Cap (Large Initial Letter)', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'enable_accent_bar',
			array(
				'label'        => __( 'Left Accent Line / Border', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'enable_quote_mark',
			array(
				'label'        => __( 'Luxury Quote Mark Header', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
				'separator'    => 'before',
			)
		);
		$this->add_control(
			'attribution_text',
			array(
				'label'       => __( 'Attribution / Signature Line (Optional)', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( '— ARCHITECTURAL ADVISORY, 2026', 'website-section-supporter' ),
				'dynamic'     => array( 'active' => true ),
			)
		);
		$this->add_responsive_control(
			'column_count',
			array(
				'label'     => __( 'Multi-Column Editorial Layout', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '1',
				'options'   => array(
					'1' => __( '1 Column (Standard)', 'website-section-supporter' ),
					'2' => __( '2 Columns (Magazine Layout)', 'website-section-supporter' ),
					'3' => __( '3 Columns (Newspaper Layout)', 'website-section-supporter' ),
				),
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'column_gap',
			array(
				'label'     => __( 'Column Gap', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 10, 'max' => 80 ) ),
				'default'   => array( 'size' => 36 ),
				'condition' => array( 'column_count!' => '1' ),
				'selectors' => array( '{{WRAPPER}} .wss-text-content' => 'column-gap: {{SIZE}}{{UNIT}} !important;' ),
			)
		);
		$this->end_controls_section();

		/* ================= CONTENT: ANIMATION ================= */
		$this->start_controls_section(
			'section_animation',
			array( 'label' => __( 'Luxury Scroll Animation', 'website-section-supporter' ) )
		);
		$this->add_control(
			'enable_reveal',
			array(
				'label'        => __( 'Smooth Scroll Rise Reveal', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'animation_delay',
			array(
				'label'     => __( 'Animation Stagger Step', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => array(
					'none' => __( 'Normal (Immediate)', 'website-section-supporter' ),
					'r2'   => __( 'Stagger Delay (Step 2)', 'website-section-supporter' ),
					'r3'   => __( 'Stagger Delay (Step 3)', 'website-section-supporter' ),
					'r4'   => __( 'Stagger Delay (Step 4)', 'website-section-supporter' ),
				),
				'condition' => array( 'enable_reveal' => 'yes' ),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: LAYOUT & ALIGNMENT ================= */
		$this->start_controls_section(
			'style_layout',
			array( 'label' => __( 'Alignment & Layout', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_responsive_control(
			'text_align',
			array(
				'label'     => __( 'Alignment', 'website-section-supporter' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'    => array( 'title' => __( 'Left', 'website-section-supporter' ), 'icon' => 'eicon-text-align-left' ),
					'center'  => array( 'title' => __( 'Center', 'website-section-supporter' ), 'icon' => 'eicon-text-align-center' ),
					'right'   => array( 'title' => __( 'Right', 'website-section-supporter' ), 'icon' => 'eicon-text-align-right' ),
					'justify' => array( 'title' => __( 'Justify', 'website-section-supporter' ), 'icon' => 'eicon-text-align-justify' ),
				),
				'default'   => 'left',
				'selectors' => array(
					'{{WRAPPER}} .wss-text-component, {{WRAPPER}} .wss-text-content' => 'text-align: {{VALUE}} !important;',
				),
			)
		);
		$this->add_responsive_control(
			'text_max_width',
			array(
				'label'      => __( 'Max Width', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em', 'vw' ),
				'range'      => array( 'px' => array( 'min' => 200, 'max' => 1400 ) ),
				'selectors'  => array( '{{WRAPPER}} .wss-text-component' => 'max-width: {{SIZE}}{{UNIT}};' ),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: TYPOGRAPHY & COLORS ================= */
		$this->start_controls_section(
			'style_typography',
			array( 'label' => __( 'Typography & Colors', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_control(
			'text_color',
			array(
				'label'     => __( 'Body Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-text-content, {{WRAPPER}} .wss-text-content p' => 'color: {{VALUE}} !important;' ),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'body_typography', 'selector' => '{{WRAPPER}} .wss-text-content, {{WRAPPER}} .wss-text-content p' )
		);
		$this->add_control(
			'bold_color',
			array(
				'label'     => __( 'Bold / Strong Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-text-content strong, {{WRAPPER}} .wss-text-content b' => 'color: {{VALUE}} !important;' ),
			)
		);
		$this->add_control(
			'link_color',
			array(
				'label'     => __( 'Link Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-text-content a' => 'color: {{VALUE}} !important;' ),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: DROP CAP ================= */
		$this->start_controls_section(
			'style_dropcap',
			array( 'label' => __( 'Drop Cap Style', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array( 'enable_dropcap' => 'yes' ) )
		);
		$this->add_control(
			'dropcap_color',
			array(
				'label'     => __( 'Drop Cap Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-text-has-dropcap .wss-text-content > p:first-of-type::first-letter' => 'color: {{VALUE}} !important;' ),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'dropcap_typography', 'selector' => '{{WRAPPER}} .wss-text-has-dropcap .wss-text-content > p:first-of-type::first-letter' )
		);
		$this->end_controls_section();

		/* ================= STYLE: ACCENT BAR ================= */
		$this->start_controls_section(
			'style_accent_bar',
			array( 'label' => __( 'Left Accent Bar', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array( 'enable_accent_bar' => 'yes' ) )
		);
		$this->add_control(
			'accent_bar_color',
			array(
				'label'     => __( 'Bar Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-text-has-accent-bar' => 'border-left-color: {{VALUE}} !important;' ),
			)
		);
		$this->add_responsive_control(
			'accent_bar_width',
			array(
				'label'     => __( 'Bar Width (px)', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 1, 'max' => 10 ) ),
				'default'   => array( 'size' => 2 ),
				'selectors' => array( '{{WRAPPER}} .wss-text-has-accent-bar' => 'border-left-width: {{SIZE}}px !important; border-left-style: solid !important;' ),
			)
		);
		$this->add_responsive_control(
			'accent_bar_padding',
			array(
				'label'     => __( 'Padding Left (px)', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 8, 'max' => 60 ) ),
				'default'   => array( 'size' => 24 ),
				'selectors' => array( '{{WRAPPER}} .wss-text-has-accent-bar' => 'padding-left: {{SIZE}}px !important;' ),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: QUOTE & ATTRIBUTION ================= */
		$this->start_controls_section(
			'style_quote_attrib',
			array( 'label' => __( 'Quote & Attribution', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_control(
			'quote_mark_color',
			array(
				'label'     => __( 'Quote Mark Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array( 'enable_quote_mark' => 'yes' ),
				'selectors' => array( '{{WRAPPER}} .wss-text-quote-mark' => 'color: {{VALUE}} !important;' ),
			)
		);
		$this->add_control(
			'attrib_color',
			array(
				'label'     => __( 'Attribution Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-text-attribution' => 'color: {{VALUE}} !important;' ),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'attrib_typography', 'selector' => '{{WRAPPER}} .wss-text-attribution' )
		);
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();

		if ( empty( $s['content'] ) ) {
			return;
		}

		$align_class = ! empty( $s['text_align'] ) ? 'wss-text-align-' . $s['text_align'] : 'wss-text-align-left';
		$dropcap_class = ( 'yes' === ( $s['enable_dropcap'] ?? 'no' ) ) ? 'wss-text-has-dropcap' : '';
		$accent_class  = ( 'yes' === ( $s['enable_accent_bar'] ?? 'no' ) ) ? 'wss-text-has-accent-bar' : '';
		
		$col_class = '';
		$cols = $s['column_count'] ?? '1';
		if ( '2' === $cols ) {
			$col_class = 'wss-text-columns-2';
		} elseif ( '3' === $cols ) {
			$col_class = 'wss-text-columns-3';
		}

		$delay_class = '';
		if ( 'yes' === ( $s['enable_reveal'] ?? 'yes' ) ) {
			$delay = $s['animation_delay'] ?? 'none';
			$delay_class = 'wss-reveal' . ( ( 'none' !== $delay ) ? ' wss-' . $delay : '' );
		}
		?>
		<div class="wss-scope">
			<div class="wss-text-component <?php echo esc_attr( $align_class . ' ' . $dropcap_class . ' ' . $accent_class . ' ' . $delay_class ); ?>">
				<?php if ( 'yes' === ( $s['enable_quote_mark'] ?? 'no' ) ) : ?>
					<div class="wss-text-quote-mark">“</div>
				<?php endif; ?>

				<div class="wss-text-content <?php echo esc_attr( $col_class ); ?>">
					<?php echo wp_kses_post( $s['content'] ); ?>
				</div>

				<?php if ( ! empty( $s['attribution_text'] ) ) : ?>
					<div class="wss-text-attribution">
						<span class="wss-attrib-line"></span>
						<span><?php echo esc_html( $s['attribution_text'] ); ?></span>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}
