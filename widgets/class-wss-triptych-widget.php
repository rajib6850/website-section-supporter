<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

class WSS_Triptych_Widget extends Widget_Base {

	public function get_name() { return 'wss_triptych'; }
	public function get_title() { return __( 'WSS — 3-Panel Feature (Triptych)', 'website-section-supporter' ); }
	public function get_icon() { return 'eicon-gallery-grid'; }
	public function get_categories() { return array( 'website-section-supporter' ); }
	public function get_keywords() { return array( 'triptych', 'panels', 'gallery' ); }

	protected function register_controls() {

		/* ================= CONTENT ================= */
		$this->start_controls_section( 'section_panels', array( 'label' => __( 'Panels', 'website-section-supporter' ) ) );
		$repeater = new Repeater();
		$repeater->add_control( 'image', array( 'label' => __( 'Image', 'website-section-supporter' ), 'type' => Controls_Manager::MEDIA, 'default' => array( 'url' => 'https://picsum.photos/seed/noirmark1/700/560' ) ) );
		$repeater->add_control( 'caption', array( 'label' => __( 'Caption', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'Bespoke Marketing', 'website-section-supporter' ) ) );
		$repeater->add_control(
			'description',
			array(
				'label'       => __( 'Description (Reveals on Hover)', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Tailored global campaigns designed to connect with ultra-high-net-worth buyers.', 'website-section-supporter' ),
				'description' => __( 'Smoothly fades and rises on hover in luxury style.', 'website-section-supporter' ),
				'dynamic'     => array( 'active' => true ),
			)
		);
		$repeater->add_control(
			'image_focus',
			array(
				'label'   => __( 'Background Position / Crop Point', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'center center',
				'options' => array(
					'center center' => __( 'Center (default)', 'website-section-supporter' ),
					'top center'    => __( 'Top Center', 'website-section-supporter' ),
					'bottom center' => __( 'Bottom Center', 'website-section-supporter' ),
					'center left'   => __( 'Center Left', 'website-section-supporter' ),
					'center right'  => __( 'Center Right', 'website-section-supporter' ),
					'top left'      => __( 'Top Left', 'website-section-supporter' ),
					'top right'     => __( 'Top Right', 'website-section-supporter' ),
					'bottom left'   => __( 'Bottom Left', 'website-section-supporter' ),
					'bottom right'  => __( 'Bottom Right', 'website-section-supporter' ),
				),
			)
		);
		$repeater->add_control(
			'bg_attachment',
			array(
				'label'   => __( 'Background Attachment', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'scroll',
				'options' => array(
					'scroll' => __( 'Scroll (Normal)', 'website-section-supporter' ),
					'fixed'  => __( 'Fixed (Seamless single image)', 'website-section-supporter' ),
				),
			)
		);
		$repeater->add_control( 'link', array( 'label' => __( 'Link', 'website-section-supporter' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '' ) ) );

		$this->add_control(
			'panels',
			array(
				'label'       => __( 'Panel Items', 'website-section-supporter' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'image'       => array( 'url' => 'https://picsum.photos/seed/noirmark1/700/560' ),
						'caption'     => 'Bespoke Marketing',
						'description' => 'Tailored global campaigns designed to connect with ultra-high-net-worth buyers.',
					),
					array(
						'image'       => array( 'url' => 'https://picsum.photos/seed/noirmark2/700/560' ),
						'caption'     => 'Property Valuation',
						'description' => 'Precision market intelligence and comprehensive portfolio analysis.',
					),
					array(
						'image'       => array( 'url' => 'https://picsum.photos/seed/noirmark3/700/560' ),
						'caption'     => 'Market Leaders',
						'description' => 'Unmatched track record across prestigious premier estate transactions.',
					),
				),
				'title_field' => '{{{ caption }}}',
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: GRID & LAYOUT ================= */
		$this->start_controls_section(
			'style_grid',
			array( 'label' => __( 'Grid & Layout', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_control(
			'container_width_type',
			array(
				'label'   => __( 'Container Width', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'full_width',
				'options' => array(
					'full_width' => __( 'Full Width (Default)', 'website-section-supporter' ),
					'boxed'      => __( 'Boxed (Standard Container)', 'website-section-supporter' ),
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
					'px' => array( 'min' => 500, 'max' => 1920, 'step' => 10 ),
					'%'  => array( 'min' => 50, 'max' => 100 ),
					'vw' => array( 'min' => 50, 'max' => 100 ),
				),
				'condition'  => array(
					'container_width_type' => 'boxed',
				),
				'selectors'  => array(
					'{{WRAPPER}} .wss-container' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'columns',
			array(
				'label'          => __( 'Grid Columns', 'website-section-supporter' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
				'options'        => array(
					'1' => __( '1 Column', 'website-section-supporter' ),
					'2' => __( '2 Columns', 'website-section-supporter' ),
					'3' => __( '3 Columns', 'website-section-supporter' ),
					'4' => __( '4 Columns', 'website-section-supporter' ),
					'5' => __( '5 Columns', 'website-section-supporter' ),
					'6' => __( '6 Columns', 'website-section-supporter' ),
				),
				'selectors'      => array(
					'{{WRAPPER}} .wss-triptych' => 'grid-template-columns: repeat({{VALUE}}, 1fr) !important;',
				),
			)
		);
		$this->add_responsive_control(
			'col_gap',
			array(
				'label'     => __( 'Column Gap (Horizontal)', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 80 ) ),
				'default'   => array( 'size' => 0 ),
				'selectors' => array( '{{WRAPPER}} .wss-triptych' => 'column-gap: {{SIZE}}{{UNIT}};' ),
			)
		);
		$this->add_responsive_control(
			'row_gap',
			array(
				'label'     => __( 'Row Gap (Vertical)', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 80 ) ),
				'default'   => array( 'size' => 0 ),
				'selectors' => array( '{{WRAPPER}} .wss-triptych' => 'row-gap: {{SIZE}}{{UNIT}};' ),
			)
		);
		$this->add_responsive_control(
			'panel_ratio',
			array(
				'label'      => __( 'Panel Aspect Ratio (W / H)', 'website-section-supporter' ),
				'type'       => Controls_Manager::TEXT,
				'default'    => '16/13',
				'selectors'  => array(
					'{{WRAPPER}} .wss-tri-panel' => 'aspect-ratio: {{VALUE}} !important;',
				),
			)
		);
		$this->add_responsive_control(
			'panel_min_height',
			array(
				'label'      => __( 'Min Height', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vh' ),
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 800 ) ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-tri-panel' => 'min-height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'panel_border_radius',
			array(
				'label'      => __( 'Border Radius', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-tri-panel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: IMAGE & OVERLAY ================= */
		$this->start_controls_section(
			'style_image',
			array( 'label' => __( 'Image & Overlay', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);

		$this->add_control(
			'overlay_color',
			array( 'label' => __( 'Overlay Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'default' => 'rgba(19,18,16,.28)', 'selectors' => array( '{{WRAPPER}} .wss-tri-panel::after' => 'background: {{VALUE}};' ) )
		);
		$this->add_control(
			'zoom_hover',
			array( 'label' => __( 'Zoom on Hover', 'website-section-supporter' ), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes' )
		);

		$this->add_control( 'img_controls_heading', array( 'label' => __( 'Image', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_control(
			'img_object_fit',
			array(
				'label'     => __( 'Background Size / Object Fit', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'cover',
				'options'   => array(
					'cover'   => __( 'Cover — fill panel (recommended)', 'website-section-supporter' ),
					'contain' => __( 'Contain — show full image', 'website-section-supporter' ),
					'fill'    => __( 'Fill — stretch to fit', 'website-section-supporter' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .wss-tri-img' => 'object-fit: {{VALUE}};',
					'{{WRAPPER}} .wss-tri-bg'  => 'background-size: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'img_brightness',
			array(
				'label'      => __( 'Brightness', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array(),
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 2, 'step' => 0.05 ) ),
				'default'    => array( 'size' => 0.70 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-tri-img, {{WRAPPER}} .wss-tri-bg' => 'filter: brightness({{SIZE}}) contrast(1.08);',
				),
			)
		);
		$this->add_responsive_control(
			'img_contrast',
			array(
				'label'      => __( 'Contrast', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array(),
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 3, 'step' => 0.05 ) ),
				'default'    => array( 'size' => 1.08 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-tri-img, {{WRAPPER}} .wss-tri-bg' => 'filter: brightness(' . "'" . '{{img_brightness.SIZE}}' . "'" . ') contrast({{SIZE}});',
				),
				'description' => __( 'Note: set Brightness first, then adjust Contrast.', 'website-section-supporter' ),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: CAPTION ================= */
		$this->start_controls_section(
			'style_caption',
			array( 'label' => __( 'Caption', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_control(
			'caption_color',
			array( 'label' => __( 'Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'default' => '#ffffff', 'selectors' => array( '{{WRAPPER}} .wss-tri-panel .wss-cap span' => 'color: {{VALUE}};' ) )
		);
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'caption_typography', 'selector' => '{{WRAPPER}} .wss-tri-panel .wss-cap span' ) );

		$this->add_control( 'caption_pos_heading', array( 'label' => __( 'Position', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_responsive_control(
			'caption_padding_h',
			array(
				'label'      => __( 'Horizontal Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'vw' ),
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 200 ), '%' => array( 'min' => 0, 'max' => 30 ) ),
				'default'    => array( 'size' => 7, 'unit' => '%' ),
				'selectors'  => array( '{{WRAPPER}} .wss-tri-panel .wss-cap' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}};' ),
			)
		);
		$this->add_responsive_control(
			'caption_padding_b',
			array(
				'label'      => __( 'Bottom Offset', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 300 ), '%' => array( 'min' => 0, 'max' => 40 ) ),
				'default'    => array( 'size' => 9, 'unit' => '%' ),
				'selectors'  => array( '{{WRAPPER}} .wss-tri-panel .wss-cap' => 'padding-bottom: {{SIZE}}{{UNIT}};' ),
			)
		);
		$this->add_control(
			'caption_align',
			array(
				'label'     => __( 'Alignment', 'website-section-supporter' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array( 'title' => __( 'Left', 'website-section-supporter' ), 'icon' => 'eicon-text-align-left' ),
					'center'     => array( 'title' => __( 'Center', 'website-section-supporter' ), 'icon' => 'eicon-text-align-center' ),
					'flex-end'   => array( 'title' => __( 'Right', 'website-section-supporter' ), 'icon' => 'eicon-text-align-right' ),
				),
				'default'   => 'flex-start',
				'selectors' => array( '{{WRAPPER}} .wss-tri-panel .wss-cap' => 'align-items: {{VALUE}};' ),
			)
		);

		$this->add_control( 'accent_line_heading', array( 'label' => __( 'Accent Line', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_control(
			'accent_line_color',
			array(
				'label'     => __( 'Accent Line Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(250,248,244,.55)',
				'selectors' => array( '{{WRAPPER}} .wss-tri-line' => 'background: {{VALUE}};' ),
			)
		);
		$this->add_responsive_control(
			'accent_line_width',
			array(
				'label'     => __( 'Accent Line Width', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 10, 'max' => 100 ) ),
				'default'   => array( 'size' => 26 ),
				'selectors' => array( '{{WRAPPER}} .wss-tri-line' => 'width: {{SIZE}}{{UNIT}};' ),
			)
		);
		$this->add_responsive_control(
			'accent_line_gap',
			array(
				'label'      => __( 'Gap to Caption Text', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em' ),
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 60 ) ),
				'default'    => array( 'size' => 12, 'unit' => 'px' ),
				'selectors'  => array( '{{WRAPPER}} .wss-tri-line' => 'margin-bottom: {{SIZE}}{{UNIT}};' ),
			)
		);
		$this->add_control( 'desc_style_heading', array( 'label' => __( 'Hover Description', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_control(
			'desc_color',
			array(
				'label'     => __( 'Description Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(250, 248, 244, 0.85)',
				'selectors' => array( '{{WRAPPER}} .wss-tri-panel .wss-tri-desc' => 'color: {{VALUE}} !important;' ),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'desc_typography', 'selector' => '{{WRAPPER}} .wss-tri-panel .wss-tri-desc' )
		);
		$this->add_responsive_control(
			'desc_max_width',
			array(
				'label'      => __( 'Description Max Width', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%', 'px' ),
				'range'      => array( '%' => array( 'min' => 40, 'max' => 100 ) ),
				'default'    => array( 'size' => 90, 'unit' => '%' ),
				'selectors'  => array( '{{WRAPPER}} .wss-tri-panel .wss-tri-desc' => 'max-width: {{SIZE}}{{UNIT}};' ),
			)
		);
		$this->add_responsive_control(
			'desc_top_gap',
			array(
				'label'      => __( 'Gap to Caption Text', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em' ),
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 40 ) ),
				'default'    => array( 'size' => 8, 'unit' => 'px' ),
				'selectors'  => array( '{{WRAPPER}} .wss-tri-panel:hover .wss-tri-desc' => 'margin-top: {{SIZE}}{{UNIT}} !important;' ),
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
			array(
				'name'     => 'section_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .wss-triptych-section',
			)
		);
		$this->add_responsive_control(
			'section_padding',
			array(
				'label'      => __( 'Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'vw' ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-triptych-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		$zoom_class = 'yes' === $s['zoom_hover'] ? '' : ' wss-no-zoom';
		$is_boxed   = ! empty( $s['container_width_type'] ) && 'boxed' === $s['container_width_type'];
		?>
		<div class="wss-scope" style="display:block; width:100%; clear:both; position:relative;">
			<section class="wss-triptych-section" style="display:block; width:100%; clear:both; position:relative;">
				<?php if ( $is_boxed ) : ?>
				<div class="wss-container">
				<?php endif; ?>

					<div class="wss-triptych<?php echo esc_attr( $zoom_class ); ?>">
						<?php foreach ( $s['panels'] as $panel ) :
							$has_link  = ! empty( $panel['link']['url'] );
							$tag       = $has_link ? 'a' : 'div';
							$img_focus = ! empty( $panel['image_focus'] ) ? $panel['image_focus'] : 'center center';
							$bg_attach = ! empty( $panel['bg_attachment'] ) ? $panel['bg_attachment'] : 'scroll';
							$img_url   = ! empty( $panel['image']['url'] ) ? $panel['image']['url'] : '';
							?>
							<<?php echo $tag; ?> class="wss-tri-panel"<?php if ( $has_link ) : ?> href="<?php echo esc_url( $panel['link']['url'] ); ?>"<?php echo ! empty( $panel['link']['is_external'] ) ? ' target="_blank" rel="noopener"' : ''; ?><?php endif; ?>>
								<?php if ( 'fixed' === $bg_attach ) : ?>
									<div class="wss-tri-bg" style="background-image: url('<?php echo esc_url( $img_url ); ?>'); background-position: <?php echo esc_attr( $img_focus ); ?>; background-attachment: fixed;"></div>
								<?php else : ?>
									<img class="wss-tri-img" src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $panel['caption'] ); ?>" style="object-position: <?php echo esc_attr( $img_focus ); ?>;">
								<?php endif; ?>
								<div class="wss-cap">
									<i class="wss-tri-line"></i>
									<span class="wss-tri-title"><?php echo esc_html( $panel['caption'] ); ?></span>
									<?php if ( ! empty( $panel['description'] ) ) : ?>
										<p class="wss-tri-desc"><?php echo esc_html( $panel['description'] ); ?></p>
									<?php endif; ?>
								</div>
							</<?php echo $tag; ?>>
						<?php endforeach; ?>
					</div>

				<?php if ( $is_boxed ) : ?>
				</div>
				<?php endif; ?>
			</section>
		</div>
		<?php
	}
}
