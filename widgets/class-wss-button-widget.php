<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

class WSS_Button_Widget extends Widget_Base {

	public function get_name() {
		return 'wss_button';
	}

	public function get_title() {
		return __( 'WSS — Luxury Button', 'website-section-supporter' );
	}

	public function get_icon() {
		return 'eicon-button';
	}

	public function get_categories() {
		return array( 'website-section-supporter' );
	}

	public function get_keywords() {
		return array( 'button', 'cta', 'pill', 'link', 'sweep', 'luxury', 'wss' );
	}

	protected function register_controls() {

		/* ================= CONTENT: PRIMARY BUTTON ================= */
		$this->start_controls_section(
			'section_button',
			array( 'label' => __( 'Primary Button', 'website-section-supporter' ) )
		);
		$this->add_control(
			'btn_style',
			array(
				'label'   => __( 'Button Style Preset', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'pill',
				'options' => array(
					'pill'  => __( 'Luxury Pill (Curtain Sweep Effect)', 'website-section-supporter' ),
					'line'  => __( 'Underline Link (Curtain Slide Underline)', 'website-section-supporter' ),
					'solid' => __( 'Solid Architectural Block', 'website-section-supporter' ),
					'glass' => __( 'Frosted Glass Capsule', 'website-section-supporter' ),
				),
			)
		);
		$this->add_control(
			'btn_text',
			array(
				'label'       => __( 'Button Text', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'EXPLORE RESIDENCES', 'website-section-supporter' ),
				'dynamic'     => array( 'active' => true ),
			)
		);
		$this->add_control(
			'btn_link',
			array(
				'label'       => __( 'Link', 'website-section-supporter' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'website-section-supporter' ),
				'default'     => array( 'url' => '#' ),
				'dynamic'     => array( 'active' => true ),
			)
		);
		$this->add_control(
			'btn_icon',
			array(
				'label'   => __( 'Icon', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'arrow',
				'options' => array(
					'none'     => __( 'None', 'website-section-supporter' ),
					'arrow'    => __( 'Luxury Arrow Right', 'website-section-supporter' ),
					'external' => __( 'External Arrow', 'website-section-supporter' ),
					'plus'     => __( 'Plus (+)', 'website-section-supporter' ),
					'phone'    => __( 'Phone', 'website-section-supporter' ),
					'mail'     => __( 'Email / Envelope', 'website-section-supporter' ),
					'download' => __( 'Download Arrow', 'website-section-supporter' ),
				),
			)
		);
		$this->add_control(
			'btn_icon_position',
			array(
				'label'     => __( 'Icon Position', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'after',
				'options'   => array(
					'before' => __( 'Before Text', 'website-section-supporter' ),
					'after'  => __( 'After Text', 'website-section-supporter' ),
				),
				'condition' => array( 'btn_icon!' => 'none' ),
			)
		);
		$this->end_controls_section();

		/* ================= CONTENT: SECONDARY BUTTON (DUAL BUTTONS) ================= */
		$this->start_controls_section(
			'section_sec_button',
			array( 'label' => __( 'Secondary Button (Optional Dual Row)', 'website-section-supporter' ) )
		);
		$this->add_control(
			'enable_sec_btn',
			array(
				'label'        => __( 'Add Secondary Button', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'sec_btn_style',
			array(
				'label'     => __( 'Style Preset', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'line',
				'options'   => array(
					'pill'  => __( 'Luxury Pill (Curtain Sweep Effect)', 'website-section-supporter' ),
					'line'  => __( 'Underline Link (Curtain Slide Underline)', 'website-section-supporter' ),
					'solid' => __( 'Solid Architectural Block', 'website-section-supporter' ),
					'glass' => __( 'Frosted Glass Capsule', 'website-section-supporter' ),
				),
				'condition' => array( 'enable_sec_btn' => 'yes' ),
			)
		);
		$this->add_control(
			'sec_btn_text',
			array(
				'label'     => __( 'Button Text', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'VIEW PRIVATE ASSETS', 'website-section-supporter' ),
				'condition' => array( 'enable_sec_btn' => 'yes' ),
				'dynamic'   => array( 'active' => true ),
			)
		);
		$this->add_control(
			'sec_btn_link',
			array(
				'label'       => __( 'Link', 'website-section-supporter' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'website-section-supporter' ),
				'default'     => array( 'url' => '#' ),
				'condition'   => array( 'enable_sec_btn' => 'yes' ),
				'dynamic'     => array( 'active' => true ),
			)
		);
		$this->add_control(
			'sec_btn_icon',
			array(
				'label'     => __( 'Icon', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'arrow',
				'options'   => array(
					'none'     => __( 'None', 'website-section-supporter' ),
					'arrow'    => __( 'Luxury Arrow Right', 'website-section-supporter' ),
					'external' => __( 'External Arrow', 'website-section-supporter' ),
					'plus'     => __( 'Plus (+)', 'website-section-supporter' ),
					'phone'    => __( 'Phone', 'website-section-supporter' ),
					'mail'     => __( 'Email / Envelope', 'website-section-supporter' ),
					'download' => __( 'Download Arrow', 'website-section-supporter' ),
				),
				'condition' => array( 'enable_sec_btn' => 'yes' ),
			)
		);
		$this->add_control(
			'sec_btn_icon_position',
			array(
				'label'     => __( 'Icon Position', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'after',
				'options'   => array(
					'before' => __( 'Before Text', 'website-section-supporter' ),
					'after'  => __( 'After Text', 'website-section-supporter' ),
				),
				'condition' => array( 'enable_sec_btn' => 'yes', 'sec_btn_icon!' => 'none' ),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: LAYOUT & ALIGNMENT ================= */
		$this->start_controls_section(
			'style_layout',
			array( 'label' => __( 'Alignment & Layout', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_responsive_control(
			'btn_align',
			array(
				'label'     => __( 'Alignment', 'website-section-supporter' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'    => array( 'title' => __( 'Left', 'website-section-supporter' ), 'icon' => 'eicon-text-align-left' ),
					'center'  => array( 'title' => __( 'Center', 'website-section-supporter' ), 'icon' => 'eicon-text-align-center' ),
					'right'   => array( 'title' => __( 'Right', 'website-section-supporter' ), 'icon' => 'eicon-text-align-right' ),
					'justify' => array( 'title' => __( 'Justify / Full Width', 'website-section-supporter' ), 'icon' => 'eicon-text-align-justify' ),
				),
				'default'   => 'left',
				'selectors' => array(
					'{{WRAPPER}} .wss-btn-component-wrap' => 'justify-content: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'btn_gap',
			array(
				'label'     => __( 'Gap Between Buttons', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 80 ) ),
				'default'   => array( 'size' => 20 ),
				'selectors' => array( '{{WRAPPER}} .wss-btn-component-wrap' => 'gap: {{SIZE}}{{UNIT}} !important;' ),
				'condition' => array( 'enable_sec_btn' => 'yes' ),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: PRIMARY BUTTON ================= */
		$this->start_controls_section(
			'style_primary_btn',
			array( 'label' => __( 'Primary Button Style', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'pri_btn_typography', 'selector' => '{{WRAPPER}} .wss-btn-primary' )
		);
		$this->add_control(
			'pri_btn_radius',
			array(
				'label'     => __( 'Border Radius', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 60 ) ),
				'selectors' => array( '{{WRAPPER}} .wss-btn-primary' => 'border-radius: {{SIZE}}{{UNIT}} !important;' ),
			)
		);
		$this->add_responsive_control(
			'pri_btn_padding',
			array(
				'label'      => __( 'Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array( '{{WRAPPER}} .wss-btn-primary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;' ),
			)
		);

		/* Normal / Hover Tabs for Primary Button */
		$this->start_controls_tabs( 'tabs_pri_btn_style' );
		$this->start_controls_tab(
			'tab_pri_btn_normal',
			array( 'label' => __( 'Normal', 'website-section-supporter' ) )
		);
		$this->add_control(
			'pri_btn_color',
			array(
				'label'     => __( 'Text / Icon Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-btn-primary, {{WRAPPER}} .wss-btn-primary span' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-btn-primary svg' => 'stroke: {{VALUE}} !important; color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-btn-line.wss-btn-primary::after' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'pri_btn_bg',
			array(
				'label'     => __( 'Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-btn-primary' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;' ),
			)
		);
		$this->add_control(
			'pri_btn_border_color',
			array(
				'label'     => __( 'Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-btn-primary' => 'border-color: {{VALUE}} !important;' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array( 'name' => 'pri_btn_shadow', 'selector' => '{{WRAPPER}} .wss-btn-primary' )
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_pri_btn_hover',
			array( 'label' => __( 'Hover', 'website-section-supporter' ) )
		);
		$this->add_control(
			'pri_btn_hover_color',
			array(
				'label'     => __( 'Hover Text / Icon Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-btn-primary:hover, {{WRAPPER}} .wss-btn-primary:hover span' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-btn-primary:hover svg' => 'stroke: {{VALUE}} !important; color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'pri_btn_hover_bg',
			array(
				'label'     => __( 'Hover Background / Effect Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-btn-primary::before, {{WRAPPER}} .wss-btn-primary:hover::before' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-btn-line.wss-btn-primary::after, {{WRAPPER}} .wss-btn-line.wss-btn-primary:hover::after' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-btn-primary' => '--wss-btn-hover-bg: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'pri_btn_hover_border_color',
			array(
				'label'     => __( 'Hover Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-btn-primary:hover' => 'border-color: {{VALUE}} !important;' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array( 'name' => 'pri_btn_shadow_hover', 'selector' => '{{WRAPPER}} .wss-btn-primary:hover' )
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/* ================= STYLE: SECONDARY BUTTON ================= */
		$this->start_controls_section(
			'style_sec_btn',
			array( 'label' => __( 'Secondary Button Style', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array( 'enable_sec_btn' => 'yes' ) )
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'sec_btn_typography', 'selector' => '{{WRAPPER}} .wss-btn-secondary' )
		);
		$this->add_control(
			'sec_btn_radius',
			array(
				'label'     => __( 'Border Radius', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 60 ) ),
				'selectors' => array( '{{WRAPPER}} .wss-btn-secondary, {{WRAPPER}} .wss-btn-secondary::before' => 'border-radius: {{SIZE}}{{UNIT}} !important;' ),
			)
		);
		$this->add_responsive_control(
			'sec_btn_padding',
			array(
				'label'      => __( 'Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array( '{{WRAPPER}} .wss-btn-secondary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;' ),
			)
		);

		/* Normal / Hover Tabs for Secondary Button */
		$this->start_controls_tabs( 'tabs_sec_btn_style' );
		$this->start_controls_tab(
			'tab_sec_btn_normal',
			array( 'label' => __( 'Normal', 'website-section-supporter' ) )
		);
		$this->add_control(
			'sec_btn_color',
			array(
				'label'     => __( 'Text / Icon Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-btn-secondary, {{WRAPPER}} .wss-btn-secondary span' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-btn-secondary svg' => 'stroke: {{VALUE}} !important; color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-btn-line.wss-btn-secondary::after' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'sec_btn_bg',
			array(
				'label'     => __( 'Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-btn-secondary' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;' ),
			)
		);
		$this->add_control(
			'sec_btn_border_color',
			array(
				'label'     => __( 'Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-btn-secondary' => 'border-color: {{VALUE}} !important;' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array( 'name' => 'sec_btn_shadow', 'selector' => '{{WRAPPER}} .wss-btn-secondary' )
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_sec_btn_hover',
			array( 'label' => __( 'Hover', 'website-section-supporter' ) )
		);
		$this->add_control(
			'sec_btn_hover_color',
			array(
				'label'     => __( 'Hover Text / Icon Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-btn-secondary:hover, {{WRAPPER}} .wss-btn-secondary:hover span' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-btn-secondary:hover svg' => 'stroke: {{VALUE}} !important; color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'sec_btn_hover_bg',
			array(
				'label'     => __( 'Hover Background / Effect Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-btn-secondary::before, {{WRAPPER}} .wss-btn-secondary:hover::before' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-btn-line.wss-btn-secondary::after, {{WRAPPER}} .wss-btn-line.wss-btn-secondary:hover::after' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
					'{{WRAPPER}} .wss-btn-secondary' => '--wss-btn-hover-bg: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'sec_btn_hover_border_color',
			array(
				'label'     => __( 'Hover Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-btn-secondary:hover' => 'border-color: {{VALUE}} !important;' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array( 'name' => 'sec_btn_shadow_hover', 'selector' => '{{WRAPPER}} .wss-btn-secondary:hover' )
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	private function get_icon_svg( $icon_key, $pos = 'after' ) {
		$pos_class = 'wss-icon-' . $pos;
		switch ( $icon_key ) {
			case 'arrow':
				return '<svg class="' . esc_attr( $pos_class ) . '" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>';
			case 'external':
				return '<svg class="' . esc_attr( $pos_class ) . '" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6M15 3h6v6M10 14L21 3"/></svg>';
			case 'plus':
				return '<svg class="' . esc_attr( $pos_class ) . '" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>';
			case 'phone':
				return '<svg class="' . esc_attr( $pos_class ) . '" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>';
			case 'mail':
				return '<svg class="' . esc_attr( $pos_class ) . '" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>';
			case 'download':
				return '<svg class="' . esc_attr( $pos_class ) . '" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg>';
			default:
				return '';
		}
	}

	private function get_style_class( $preset ) {
		switch ( $preset ) {
			case 'line':
				return 'wss-btn-line';
			case 'solid':
				return 'wss-btn-solid';
			case 'glass':
				return 'wss-btn-glass';
			case 'pill':
			default:
				return 'wss-btn-pill';
		}
	}

	protected function render() {
		$s = $this->get_settings_for_display();

		$align_class = ! empty( $s['btn_align'] ) ? 'wss-btn-align-' . $s['btn_align'] : 'wss-btn-align-left';
		$pri_class   = $this->get_style_class( $s['btn_style'] ?? 'pill' );
		$sec_class   = $this->get_style_class( $s['sec_btn_style'] ?? 'line' );

		$pri_target = ! empty( $s['btn_link']['is_external'] ) ? ' target="_blank"' : '';
		$pri_nofollow = ! empty( $s['btn_link']['nofollow'] ) ? ' rel="nofollow"' : '';
		$pri_url = ! empty( $s['btn_link']['url'] ) ? esc_url( $s['btn_link']['url'] ) : '#';

		$pri_icon_code = ( ( $s['btn_icon'] ?? 'arrow' ) !== 'none' ) ? $this->get_icon_svg( $s['btn_icon'], $s['btn_icon_position'] ?? 'after' ) : '';
		?>
		<div class="wss-scope">
			<div class="wss-btn-component-wrap <?php echo esc_attr( $align_class ); ?>">
				<a class="wss-btn-item wss-btn-primary <?php echo esc_attr( $pri_class ); ?>" href="<?php echo $pri_url; ?>"<?php echo $pri_target . $pri_nofollow; ?>>
					<?php if ( 'before' === ( $s['btn_icon_position'] ?? 'after' ) && $pri_icon_code ) : ?>
						<?php echo $pri_icon_code; ?>
					<?php endif; ?>
					<span><?php echo esc_html( $s['btn_text'] ); ?></span>
					<?php if ( 'after' === ( $s['btn_icon_position'] ?? 'after' ) && $pri_icon_code ) : ?>
						<?php echo $pri_icon_code; ?>
					<?php endif; ?>
				</a>

				<?php if ( 'yes' === ( $s['enable_sec_btn'] ?? 'no' ) && ! empty( $s['sec_btn_text'] ) ) : ?>
					<?php
					$sec_target = ! empty( $s['sec_btn_link']['is_external'] ) ? ' target="_blank"' : '';
					$sec_nofollow = ! empty( $s['sec_btn_link']['nofollow'] ) ? ' rel="nofollow"' : '';
					$sec_url = ! empty( $s['sec_btn_link']['url'] ) ? esc_url( $s['sec_btn_link']['url'] ) : '#';
					$sec_icon_code = ( ( $s['sec_btn_icon'] ?? 'arrow' ) !== 'none' ) ? $this->get_icon_svg( $s['sec_btn_icon'], $s['sec_btn_icon_position'] ?? 'after' ) : '';
					?>
					<a class="wss-btn-item wss-btn-secondary <?php echo esc_attr( $sec_class ); ?>" href="<?php echo $sec_url; ?>"<?php echo $sec_target . $sec_nofollow; ?>>
						<?php if ( 'before' === ( $s['sec_btn_icon_position'] ?? 'after' ) && $sec_icon_code ) : ?>
							<?php echo $sec_icon_code; ?>
						<?php endif; ?>
						<span><?php echo esc_html( $s['sec_btn_text'] ); ?></span>
						<?php if ( 'after' === ( $s['sec_btn_icon_position'] ?? 'after' ) && $sec_icon_code ) : ?>
							<?php echo $sec_icon_code; ?>
						<?php endif; ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}
