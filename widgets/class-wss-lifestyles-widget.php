<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

class WSS_Lifestyles_Widget extends Widget_Base {

	public function get_name() { return 'wss_lifestyles'; }
	public function get_title() { return __( 'WSS — Lifestyles / Neighborhoods Grid', 'website-section-supporter' ); }
	public function get_icon() { return 'eicon-gallery-grid'; }
	public function get_categories() { return array( 'website-section-supporter' ); }
	public function get_keywords() { return array( 'neighborhoods', 'lifestyles', 'locations', 'grid' ); }

	protected function register_controls() {

		/* ================= CONTENT ================= */
		$this->start_controls_section( 'section_head', array( 'label' => __( 'Heading', 'website-section-supporter' ) ) );
		$this->add_control( 'eyebrow', array( 'label' => __( 'Eyebrow', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'Lifestyles In', 'website-section-supporter' ) ) );
		$this->add_control( 'heading', array( 'label' => __( 'Heading', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'Southern California', 'website-section-supporter' ) ) );
		$this->add_control( 'link_text', array( 'label' => __( 'Top-right Link Text', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'View More Communities', 'website-section-supporter' ) ) );
		$this->add_control( 'link_url', array( 'label' => __( 'Top-right Link URL', 'website-section-supporter' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#' ) ) );
		$this->end_controls_section();

		$this->start_controls_section( 'section_items', array( 'label' => __( 'Locations', 'website-section-supporter' ) ) );
		$repeater = new Repeater();
		$repeater->add_control( 'image', array( 'label' => __( 'Image', 'website-section-supporter' ), 'type' => Controls_Manager::MEDIA, 'default' => array( 'url' => 'https://picsum.photos/seed/noirloc1/500/560' ) ) );
		$repeater->add_control( 'name', array( 'label' => __( 'Name', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'Beverly Hills', 'website-section-supporter' ) ) );
		$repeater->add_control( 'link', array( 'label' => __( 'Link', 'website-section-supporter' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '' ) ) );

		$this->add_control(
			'items',
			array(
				'label'       => __( 'Items', 'website-section-supporter' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array( 'image' => array( 'url' => 'https://picsum.photos/seed/noirloc1/500/560' ), 'name' => 'Beverly Hills' ),
					array( 'image' => array( 'url' => 'https://picsum.photos/seed/noirloc2/500/560' ), 'name' => 'Bel Air' ),
					array( 'image' => array( 'url' => 'https://picsum.photos/seed/noirloc3/500/560' ), 'name' => 'Pacific Palisades' ),
					array( 'image' => array( 'url' => 'https://picsum.photos/seed/noirloc4/500/560' ), 'name' => 'Malibu' ),
				),
				'title_field' => '{{{ name }}}',
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: SECTION ================= */
		$this->start_controls_section(
			'style_section',
			array( 'label' => __( 'Section', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_group_control( Group_Control_Background::get_type(), array( 'name' => 'section_bg', 'types' => array( 'classic', 'gradient' ), 'selector' => '{{WRAPPER}} .wss-pad' ) );
		$this->add_responsive_control(
			'section_padding',
			array( 'label' => __( 'Padding', 'website-section-supporter' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array( 'px', '%', 'vw' ), 'selectors' => array( '{{WRAPPER}} .wss-pad' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ) )
		);
		$this->end_controls_section();

		/* ================= STYLE: HEADING ================= */
		$this->start_controls_section(
			'style_heading',
			array( 'label' => __( 'Heading', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_control( 'eyebrow_color', array( 'label' => __( 'Eyebrow Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-lg-head .wss-eyebrow' => 'color: {{VALUE}};' ) ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'eyebrow_typography', 'selector' => '{{WRAPPER}} .wss-lg-head .wss-eyebrow' ) );
		$this->add_control( 'heading_color', array( 'label' => __( 'Heading Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-lg-head h2' => 'color: {{VALUE}};' ) ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'heading_typography', 'selector' => '{{WRAPPER}} .wss-lg-head h2' ) );
		$this->add_control( 'link_color', array( 'label' => __( 'Top-right Link Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-lg-head .wss-btn-line' => 'color: {{VALUE}} !important;' ) ) );
		$this->add_control( 'link_hover_color', array( 'label' => __( 'Top-right Link Hover Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-lg-head .wss-btn-line:hover' => 'color: {{VALUE}} !important;' ) ) );
		$this->end_controls_section();

		/* ================= STYLE: GRID ================= */
		$this->start_controls_section(
			'style_grid',
			array( 'label' => __( 'Grid', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_responsive_control(
			'grid_columns',
			array(
				'label'   => __( 'Columns', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '4',
				'tablet_default' => '2',
				'mobile_default' => '1',
				'options' => array( '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6' ),
				'selectors' => array( '{{WRAPPER}} .wss-lg-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);' ),
			)
		);
		$this->add_responsive_control(
			'grid_gap',
			array( 'label' => __( 'Gap', 'website-section-supporter' ), 'type' => Controls_Manager::SLIDER, 'range' => array( 'px' => array( 'min' => 0, 'max' => 60 ) ), 'default' => array( 'size' => 20 ), 'selectors' => array( '{{WRAPPER}} .wss-lg-grid' => 'gap: {{SIZE}}{{UNIT}};' ) )
		);
		$this->add_control(
			'item_radius',
			array( 'label' => __( 'Item Border Radius', 'website-section-supporter' ), 'type' => Controls_Manager::SLIDER, 'range' => array( 'px' => array( 'min' => 0, 'max' => 60 ) ), 'default' => array( 'size' => 10 ), 'selectors' => array( '{{WRAPPER}} .wss-lg-item' => 'border-radius: {{SIZE}}{{UNIT}};' ) )
		);
		$this->add_control(
			'item_ratio',
			array( 'label' => __( 'Item Aspect Ratio (W / H)', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => '1/1.12', 'selectors' => array( '{{WRAPPER}} .wss-lg-item' => 'aspect-ratio: {{VALUE}};' ) )
		);

		$this->add_control( 'item_overlay', array( 'label' => __( 'Overlay Bottom Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'default' => 'rgba(19,18,16,.65)', 'selectors' => array( '{{WRAPPER}} .wss-lg-item::after' => 'background: linear-gradient(180deg, rgba(19,18,16,0) 55%, {{VALUE}} 100%);' ) ) );
		$this->end_controls_section();

		/* ================= STYLE: ITEM LABEL ================= */
		$this->start_controls_section(
			'style_label',
			array( 'label' => __( 'Item Label', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'label_typography', 'selector' => '{{WRAPPER}} .wss-lg-item span' ) );
		$this->start_controls_tabs( 'tabs_label_style' );
		$this->start_controls_tab( 'tab_label_normal', array( 'label' => __( 'Normal', 'website-section-supporter' ) ) );
		$this->add_control( 'label_color', array( 'label' => __( 'Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'default' => '#ffffff', 'selectors' => array( '{{WRAPPER}} .wss-lg-item span' => 'color: {{VALUE}};' ) ) );
		$this->end_controls_tab();

		$this->start_controls_tab( 'tab_label_hover', array( 'label' => __( 'Hover', 'website-section-supporter' ) ) );
		$this->add_control( 'label_hover_color', array( 'label' => __( 'Hover Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-lg-item:hover span' => 'color: {{VALUE}} !important;' ) ) );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		?>
		<div class="wss-scope">
			<section class="wss-pad">
				<div class="wss-container">
					<div class="wss-lg-head wss-reveal">
						<div>
							<span class="wss-eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></span>
							<h2><span class="wss-mask"><span><?php echo esc_html( $s['heading'] ); ?></span></span></h2>
						</div>
						<?php if ( ! empty( $s['link_text'] ) ) : ?>
							<a class="wss-btn-line" href="<?php echo esc_url( $s['link_url']['url'] ?: '#' ); ?>"<?php echo ! empty( $s['link_url']['is_external'] ) ? ' target="_blank" rel="noopener"' : ''; ?>><?php echo esc_html( $s['link_text'] ); ?> <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
						<?php endif; ?>
					</div>
					<div class="wss-lg-grid">
						<?php foreach ( $s['items'] as $item ) :
							$has_link = ! empty( $item['link']['url'] );
							$tag = $has_link ? 'a' : 'div';
							?>
							<<?php echo $tag; ?> class="wss-lg-item"<?php if ( $has_link ) : ?> href="<?php echo esc_url( $item['link']['url'] ); ?>"<?php echo ! empty( $item['link']['is_external'] ) ? ' target="_blank" rel="noopener"' : ''; ?><?php endif; ?>>
								<img src="<?php echo esc_url( $item['image']['url'] ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>">
								<span><?php echo esc_html( $item['name'] ); ?></span>
							</<?php echo $tag; ?>>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
		</div>
		<?php
	}
}
