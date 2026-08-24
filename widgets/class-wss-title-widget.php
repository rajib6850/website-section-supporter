<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class WSS_Title_Widget extends Widget_Base {

	public function get_name() {
		return 'wss_title';
	}

	public function get_title() {
		return __( 'WSS — Luxury Title & Heading', 'website-section-supporter' );
	}

	public function get_icon() {
		return 'eicon-heading';
	}

	public function get_categories() {
		return array( 'website-section-supporter' );
	}

	public function get_keywords() {
		return array( 'heading', 'title', 'eyebrow', 'luxury', 'mask', 'reveal', 'wss' );
	}

	protected function register_controls() {

		/* ================= CONTENT: EYEBROW ================= */
		$this->start_controls_section(
			'section_eyebrow',
			array( 'label' => __( 'Eyebrow / Tagline', 'website-section-supporter' ) )
		);
		$this->add_control(
			'show_eyebrow',
			array(
				'label'        => __( 'Show Eyebrow', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'eyebrow_text',
			array(
				'label'       => __( 'Eyebrow Text', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'EXCLUSIVE PORTFOLIO', 'website-section-supporter' ),
				'condition'   => array( 'show_eyebrow' => 'yes' ),
				'dynamic'     => array( 'active' => true ),
			)
		);
		$this->add_control(
			'eyebrow_style',
			array(
				'label'     => __( 'Eyebrow Style', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'line',
				'options'   => array(
					'plain' => __( 'Plain Text', 'website-section-supporter' ),
					'line'  => __( 'Text with Accent Line', 'website-section-supporter' ),
					'dot'   => __( 'Text with Accent Dot', 'website-section-supporter' ),
					'badge' => __( 'Luxury Pill Badge', 'website-section-supporter' ),
				),
				'condition' => array( 'show_eyebrow' => 'yes' ),
			)
		);
		$this->end_controls_section();

		/* ================= CONTENT: HEADING ================= */
		$this->start_controls_section(
			'section_heading',
			array( 'label' => __( 'Main Heading', 'website-section-supporter' ) )
		);
		$this->add_control(
			'heading_line1',
			array(
				'label'       => __( 'Line 1 Text', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'UNRIVALED', 'website-section-supporter' ),
				'dynamic'     => array( 'active' => true ),
			)
		);
		$this->add_control(
			'heading_line2',
			array(
				'label'       => __( 'Line 2 Text (Optional)', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'SANCTUARY', 'website-section-supporter' ),
				'dynamic'     => array( 'active' => true ),
			)
		);
		$this->add_control(
			'heading_tag',
			array(
				'label'   => __( 'HTML Tag', 'website-section-supporter' ),
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
			'enable_reveal',
			array(
				'label'        => __( 'Luxury Mask Slide Reveal Animation', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);
		$this->end_controls_section();

		/* ================= CONTENT: DESCRIPTION ================= */
		$this->start_controls_section(
			'section_desc',
			array( 'label' => __( 'Description / Subtitle', 'website-section-supporter' ) )
		);
		$this->add_control(
			'show_desc',
			array(
				'label'        => __( 'Show Description', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'desc_text',
			array(
				'label'       => __( 'Description Text', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Crafted with uncompromising attention to detail, creating a sanctuary of refined elegance and timeless architecture.', 'website-section-supporter' ),
				'condition'   => array( 'show_desc' => 'yes' ),
				'dynamic'     => array( 'active' => true ),
			)
		);
		$this->end_controls_section();

		/* ================= CONTENT: DIVIDER ================= */
		$this->start_controls_section(
			'section_divider',
			array( 'label' => __( 'Decorative Divider Line', 'website-section-supporter' ) )
		);
		$this->add_control(
			'show_divider',
			array(
				'label'        => __( 'Show Decorative Line', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: GENERAL ALIGNMENT ================= */
		$this->start_controls_section(
			'style_general',
			array( 'label' => __( 'Alignment & Layout', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_responsive_control(
			'text_align',
			array(
				'label'     => __( 'Alignment', 'website-section-supporter' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array( 'title' => __( 'Left', 'website-section-supporter' ), 'icon' => 'eicon-text-align-left' ),
					'center' => array( 'title' => __( 'Center', 'website-section-supporter' ), 'icon' => 'eicon-text-align-center' ),
					'right'  => array( 'title' => __( 'Right', 'website-section-supporter' ), 'icon' => 'eicon-text-align-right' ),
				),
				'default'   => 'left',
				'selectors' => array(
					'{{WRAPPER}} .wss-title-component' => 'text-align: {{VALUE}} !important;',
				),
			)
		);
		$this->add_responsive_control(
			'component_max_width',
			array(
				'label'      => __( 'Max Width', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'vw' ),
				'range'      => array( 'px' => array( 'min' => 200, 'max' => 1400 ) ),
				'selectors'  => array( '{{WRAPPER}} .wss-title-component' => 'max-width: {{SIZE}}{{UNIT}};' ),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: EYEBROW ================= */
		$this->start_controls_section(
			'style_eyebrow',
			array( 'label' => __( 'Eyebrow / Tagline', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array( 'show_eyebrow' => 'yes' ) )
		);
		$this->add_control(
			'eyebrow_color',
			array(
				'label'     => __( 'Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-title-eyebrow' => 'color: {{VALUE}} !important;' ),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'eyebrow_typography', 'selector' => '{{WRAPPER}} .wss-title-eyebrow' )
		);
		$this->add_control(
			'eyebrow_badge_bg',
			array(
				'label'     => __( 'Badge Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-title-eyebrow.wss-eyebrow--badge' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;' ),
				'condition' => array( 'eyebrow_style' => 'badge' ),
			)
		);
		$this->add_control(
			'eyebrow_badge_border',
			array(
				'label'     => __( 'Badge Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-title-eyebrow.wss-eyebrow--badge' => 'border-color: {{VALUE}} !important;' ),
				'condition' => array( 'eyebrow_style' => 'badge' ),
			)
		);
		$this->add_responsive_control(
			'eyebrow_spacing',
			array(
				'label'     => __( 'Bottom Spacing', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 60 ) ),
				'default'   => array( 'size' => 12 ),
				'selectors' => array( '{{WRAPPER}} .wss-title-eyebrow' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;' ),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: HEADING ================= */
		$this->start_controls_section(
			'style_heading',
			array( 'label' => __( 'Heading', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_control( 'line1_heading_ctrl', array( 'label' => __( 'Line 1', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING ) );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'line1_typography', 'selector' => '{{WRAPPER}} .wss-title-heading, {{WRAPPER}} .wss-title-heading .wss-line1' )
		);
		$this->start_controls_tabs( 'tabs_line1_style' );
		$this->start_controls_tab( 'tab_line1_normal', array( 'label' => __( 'Normal', 'website-section-supporter' ) ) );
		$this->add_control(
			'line1_color',
			array(
				'label'     => __( 'Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-title-heading, {{WRAPPER}} .wss-title-heading .wss-line1' => 'color: {{VALUE}} !important;' ),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab( 'tab_line1_hover', array( 'label' => __( 'Hover', 'website-section-supporter' ) ) );
		$this->add_control(
			'line1_hover_color',
			array(
				'label'     => __( 'Hover Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-title-component:hover .wss-title-heading, {{WRAPPER}} .wss-title-component:hover .wss-line1, {{WRAPPER}} .wss-title-heading:hover .wss-line1' => 'color: {{VALUE}} !important;' ),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control( 'line2_heading_ctrl', array( 'label' => __( 'Line 2', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'line2_typography', 'selector' => '{{WRAPPER}} .wss-title-heading .wss-line2' )
		);
		$this->start_controls_tabs( 'tabs_line2_style' );
		$this->start_controls_tab( 'tab_line2_normal', array( 'label' => __( 'Normal', 'website-section-supporter' ) ) );
		$this->add_control(
			'line2_color',
			array(
				'label'     => __( 'Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-title-heading .wss-line2' => 'color: {{VALUE}} !important;' ),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab( 'tab_line2_hover', array( 'label' => __( 'Hover', 'website-section-supporter' ) ) );
		$this->add_control(
			'line2_hover_color',
			array(
				'label'     => __( 'Hover Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-title-component:hover .wss-line2, {{WRAPPER}} .wss-title-heading:hover .wss-line2' => 'color: {{VALUE}} !important;' ),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'heading_bottom_spacing',
			array(
				'label'     => __( 'Bottom Spacing', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 80 ) ),
				'default'   => array( 'size' => 16 ),
				'selectors' => array( '{{WRAPPER}} .wss-title-heading' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;' ),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: DESCRIPTION ================= */
		$this->start_controls_section(
			'style_desc',
			array( 'label' => __( 'Description', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array( 'show_desc' => 'yes' ) )
		);
		$this->add_control(
			'desc_color',
			array(
				'label'     => __( 'Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-title-desc, {{WRAPPER}} .wss-title-desc p' => 'color: {{VALUE}} !important;' ),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'desc_typography', 'selector' => '{{WRAPPER}} .wss-title-desc, {{WRAPPER}} .wss-title-desc p' )
		);
		$this->add_responsive_control(
			'desc_max_width',
			array(
				'label'      => __( 'Description Max Width', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em' ),
				'range'      => array( 'px' => array( 'min' => 200, 'max' => 1000 ) ),
				'selectors'  => array( '{{WRAPPER}} .wss-title-desc' => 'max-width: {{SIZE}}{{UNIT}};' ),
			)
		);
		$this->add_responsive_control(
			'desc_bottom_spacing',
			array(
				'label'     => __( 'Bottom Spacing', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 80 ) ),
				'default'   => array( 'size' => 16 ),
				'selectors' => array( '{{WRAPPER}} .wss-title-desc' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;' ),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: DIVIDER ================= */
		$this->start_controls_section(
			'style_divider',
			array( 'label' => __( 'Decorative Line', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array( 'show_divider' => 'yes' ) )
		);
		$this->add_control(
			'divider_color',
			array(
				'label'     => __( 'Line Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-title-divider' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;' ),
			)
		);
		$this->add_responsive_control(
			'divider_width',
			array(
				'label'     => __( 'Line Width (px)', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 10, 'max' => 300 ) ),
				'default'   => array( 'size' => 48 ),
				'selectors' => array( '{{WRAPPER}} .wss-title-divider' => 'width: {{SIZE}}px !important;' ),
			)
		);
		$this->add_responsive_control(
			'divider_height',
			array(
				'label'     => __( 'Line Height (px)', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 1, 'max' => 10 ) ),
				'default'   => array( 'size' => 1 ),
				'selectors' => array( '{{WRAPPER}} .wss-title-divider' => 'height: {{SIZE}}px !important;' ),
			)
		);
		$this->add_responsive_control(
			'divider_top_spacing',
			array(
				'label'     => __( 'Top Spacing', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 60 ) ),
				'default'   => array( 'size' => 20 ),
				'selectors' => array( '{{WRAPPER}} .wss-title-divider' => 'margin-top: {{SIZE}}{{UNIT}} !important;' ),
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();

		$tag = ! empty( $s['heading_tag'] ) ? $s['heading_tag'] : 'h2';
		$reveal_class = ( 'yes' === $s['enable_reveal'] ) ? 'wss-reveal' : '';
		$eyebrow_style = ! empty( $s['eyebrow_style'] ) ? $s['eyebrow_style'] : 'line';
		$badge_class = ( 'badge' === $eyebrow_style ) ? 'wss-eyebrow--badge' : '';
		$align_class = ! empty( $s['text_align'] ) ? 'wss-align-' . $s['text_align'] : 'wss-align-left';
		?>
		<div class="wss-scope">
			<div class="wss-title-component <?php echo esc_attr( $align_class ); ?>">
				<?php if ( 'yes' === $s['show_eyebrow'] && ! empty( $s['eyebrow_text'] ) ) : ?>
					<div class="wss-title-eyebrow <?php echo esc_attr( $badge_class . ' ' . $reveal_class ); ?>">
						<?php if ( 'line' === $eyebrow_style ) : ?>
							<span class="wss-eyebrow-line"></span>
						<?php elseif ( 'dot' === $eyebrow_style ) : ?>
							<span class="wss-eyebrow-dot"></span>
						<?php endif; ?>
						<span><?php echo esc_html( $s['eyebrow_text'] ); ?></span>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $s['heading_line1'] ) || ! empty( $s['heading_line2'] ) ) : ?>
					<<?php echo esc_attr( $tag ); ?> class="wss-title-heading <?php echo esc_attr( $reveal_class ); ?>">
						<?php if ( ! empty( $s['heading_line1'] ) ) : ?>
							<span class="wss-line1 <?php echo 'yes' === $s['enable_reveal'] ? 'wss-mask' : ''; ?>">
								<span><?php echo esc_html( $s['heading_line1'] ); ?></span>
							</span>
						<?php endif; ?>
						<?php if ( ! empty( $s['heading_line2'] ) ) : ?>
							<span class="wss-line2 <?php echo 'yes' === $s['enable_reveal'] ? 'wss-mask wss-r2' : ''; ?>">
								<span><?php echo esc_html( $s['heading_line2'] ); ?></span>
							</span>
						<?php endif; ?>
					</<?php echo esc_attr( $tag ); ?>>
				<?php endif; ?>

				<?php if ( 'yes' === $s['show_desc'] && ! empty( $s['desc_text'] ) ) : ?>
					<div class="wss-title-desc <?php echo esc_attr( $reveal_class . ' wss-r3' ); ?>">
						<?php echo wp_kses_post( wpautop( $s['desc_text'] ) ); ?>
					</div>
				<?php endif; ?>

				<?php if ( 'yes' === $s['show_divider'] ) : ?>
					<span class="wss-title-divider <?php echo esc_attr( $reveal_class . ' wss-r4' ); ?>"></span>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}
