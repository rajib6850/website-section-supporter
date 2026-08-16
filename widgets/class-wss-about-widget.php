<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class WSS_About_Widget extends Widget_Base {

	public function get_name() { return 'wss_about'; }
	public function get_title() { return __( 'WSS — About / Advisory', 'website-section-supporter' ); }
	public function get_icon() { return 'eicon-info-circle-o'; }
	public function get_categories() { return array( 'website-section-supporter' ); }
	public function get_keywords() { return array( 'about', 'advisory', 'text image' ); }

	protected function register_controls() {

		/* ================= CONTENT ================= */
		$this->start_controls_section( 'section_content', array( 'label' => __( 'Content', 'website-section-supporter' ) ) );
		$this->add_control( 'eyebrow', array( 'label' => __( 'Eyebrow', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'The Advisory', 'website-section-supporter' ) ) );
		$this->add_control( 'heading', array( 'label' => __( 'Heading', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'The Noir Standard', 'website-section-supporter' ) ) );
		$this->add_control( 'description', array( 'label' => __( 'Description', 'website-section-supporter' ), 'type' => Controls_Manager::TEXTAREA, 'default' => __( 'For more than two decades, this advisory has proven itself indispensable in the refined world of international luxury real estate. Trusted by celebrated clients, respected colleagues, and the communities served — every website we build carries that same standard of craft, courtesy of Digitize Growth.', 'website-section-supporter' ), 'rows' => 6 ) );
		$this->end_controls_section();

		$this->start_controls_section( 'section_buttons', array( 'label' => __( 'Buttons', 'website-section-supporter' ) ) );
		$this->add_control( 'btn1_text', array( 'label' => __( 'Button 1 Text', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'Read More', 'website-section-supporter' ) ) );
		$this->add_control( 'btn1_link', array( 'label' => __( 'Button 1 Link', 'website-section-supporter' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => WSS_CREDIT_URL, 'is_external' => true ) ) );
		$this->add_control( 'btn2_text', array( 'label' => __( 'Button 2 Text', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'View Exclusive Homes', 'website-section-supporter' ) ) );
		$this->add_control( 'btn2_link', array( 'label' => __( 'Button 2 Link', 'website-section-supporter' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '#sales' ) ) );
		$this->end_controls_section();

		$this->start_controls_section( 'section_media', array( 'label' => __( 'Media', 'website-section-supporter' ) ) );
		$this->add_control( 'main_image', array( 'label' => __( 'Main Image', 'website-section-supporter' ), 'type' => Controls_Manager::MEDIA, 'default' => array( 'url' => 'https://picsum.photos/seed/noiradvisor/900/1120' ) ) );
		$this->add_control( 'show_video_chip', array( 'label' => __( 'Show Small Video Thumbnail', 'website-section-supporter' ), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes' ) );
		$this->add_control( 'video_image', array( 'label' => __( 'Video Thumbnail Image', 'website-section-supporter' ), 'type' => Controls_Manager::MEDIA, 'default' => array( 'url' => 'https://picsum.photos/seed/noirclip/300/220' ), 'condition' => array( 'show_video_chip' => 'yes' ) ) );
		$this->add_control( 'video_link', array( 'label' => __( 'Video Link (YouTube or MP4)', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'condition' => array( 'show_video_chip' => 'yes' ) ) );
		$this->end_controls_section();

		/* ================= STYLE: SECTION ================= */
		$this->start_controls_section(
			'style_section',
			array( 'label' => __( 'Section', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_group_control( Group_Control_Background::get_type(), array( 'name' => 'section_bg', 'types' => array( 'classic', 'gradient' ), 'selector' => '{{WRAPPER}} .wss-pad' ) );
		$this->add_responsive_control(
			'section_padding',
			array(
				'label'      => __( 'Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'vw' ),
				'selectors'  => array( '{{WRAPPER}} .wss-pad' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ),
			)
		);
		$this->add_responsive_control(
			'columns_gap',
			array(
				'label'     => __( 'Gap Between Text & Media', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'size_units'=> array( 'px', 'vw' ),
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 200 ), 'vw' => array( 'min' => 0, 'max' => 15 ) ),
				'selectors' => array( '{{WRAPPER}} .wss-about' => 'gap: {{SIZE}}{{UNIT}};' ),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: TEXT ================= */
		$this->start_controls_section(
			'style_text',
			array( 'label' => __( 'Text', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_control( 'eyebrow_heading', array( 'label' => __( 'Eyebrow', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING ) );
		$this->add_control( 'eyebrow_color', array( 'label' => __( 'Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-about .wss-eyebrow' => 'color: {{VALUE}};' ) ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'eyebrow_typography', 'selector' => '{{WRAPPER}} .wss-about .wss-eyebrow' ) );

		$this->add_control( 'heading_heading', array( 'label' => __( 'Heading', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_control( 'heading_color', array( 'label' => __( 'Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-about h2' => 'color: {{VALUE}};' ) ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'heading_typography', 'selector' => '{{WRAPPER}} .wss-about h2' ) );

		$this->add_control( 'desc_heading', array( 'label' => __( 'Description', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_control( 'desc_color', array( 'label' => __( 'Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-about p' => 'color: {{VALUE}};' ) ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'desc_typography', 'selector' => '{{WRAPPER}} .wss-about p' ) );
		$this->end_controls_section();

		/* ================= STYLE: BUTTONS ================= */
		$this->start_controls_section(
			'style_buttons',
			array( 'label' => __( 'Buttons', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'btn_typography', 'selector' => '{{WRAPPER}} .wss-about-actions .wss-btn-pill' ) );
		$this->add_control(
			'btn_radius',
			array( 'label' => __( 'Border Radius', 'website-section-supporter' ), 'type' => Controls_Manager::SLIDER, 'range' => array( 'px' => array( 'min' => 0, 'max' => 60 ) ), 'selectors' => array( '{{WRAPPER}} .wss-about-actions .wss-btn-pill' => 'border-radius: {{SIZE}}{{UNIT}} !important;' ) )
		);
		$this->add_responsive_control(
			'btn_padding',
			array( 'label' => __( 'Padding', 'website-section-supporter' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array( 'px', 'em' ), 'selectors' => array( '{{WRAPPER}} .wss-about-actions .wss-btn-pill' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;' ) )
		);
		$this->add_responsive_control(
			'btn_gap',
			array( 'label' => __( 'Gap Between Buttons', 'website-section-supporter' ), 'type' => Controls_Manager::SLIDER, 'range' => array( 'px' => array( 'min' => 0, 'max' => 80 ) ), 'default' => array( 'size' => 24 ), 'selectors' => array( '{{WRAPPER}} .wss-about-actions' => 'gap: {{SIZE}}{{UNIT}};' ) )
		);

		/* Normal / Hover Tabs */
		$this->start_controls_tabs( 'tabs_about_btn_style' );
		$this->start_controls_tab(
			'tab_about_btn_normal',
			array( 'label' => __( 'Normal', 'website-section-supporter' ) )
		);
		$this->add_control( 'btn_color', array( 'label' => __( 'Text Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-about-actions .wss-btn-pill' => 'color: {{VALUE}} !important;' ) ) );
		$this->add_control( 'btn_bg', array( 'label' => __( 'Background Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-about-actions .wss-btn-pill' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;' ) ) );
		$this->add_control( 'btn_border_color', array( 'label' => __( 'Border Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-about-actions .wss-btn-pill' => 'border-color: {{VALUE}} !important;' ) ) );
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_about_btn_hover',
			array( 'label' => __( 'Hover', 'website-section-supporter' ) )
		);
		$this->add_control( 'btn_hover_color', array( 'label' => __( 'Hover Text Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-about-actions .wss-btn-pill:hover' => 'color: {{VALUE}} !important;' ) ) );
		$this->add_control( 'btn_hover_bg', array(
			'label'     => __( 'Hover Background / Effect Color', 'website-section-supporter' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => array(
				'{{WRAPPER}} .wss-about-actions .wss-btn-pill::before' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
			),
		) );
		$this->add_control( 'btn_hover_border_color', array( 'label' => __( 'Hover Border Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-about-actions .wss-btn-pill:hover' => 'border-color: {{VALUE}} !important;' ) ) );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/* ================= STYLE: MEDIA ================= */
		$this->start_controls_section(
			'style_media',
			array( 'label' => __( 'Media', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_control( 'img_heading', array( 'label' => __( 'Main Image', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING ) );

		$this->add_group_control( Group_Control_Border::get_type(), array( 'name' => 'img_border', 'selector' => '{{WRAPPER}} .wss-about-media .wss-img-reveal' ) );
		$this->add_control(
			'img_radius',
			array( 'label' => __( 'Border Radius', 'website-section-supporter' ), 'type' => Controls_Manager::SLIDER, 'range' => array( 'px' => array( 'min' => 0, 'max' => 80 ) ), 'selectors' => array( '{{WRAPPER}} .wss-about-media .wss-img-reveal' => 'border-radius: {{SIZE}}{{UNIT}};' ) )
		);
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), array( 'name' => 'img_shadow', 'selector' => '{{WRAPPER}} .wss-about-media .wss-img-reveal' ) );

		$this->add_control( 'chip_heading', array( 'label' => __( 'Video Thumbnail', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before', 'condition' => array( 'show_video_chip' => 'yes' ) ) );
		$this->add_responsive_control(
			'chip_width',
			array( 'label' => __( 'Width', 'website-section-supporter' ), 'type' => Controls_Manager::SLIDER, 'range' => array( 'px' => array( 'min' => 60, 'max' => 320 ) ), 'default' => array( 'size' => 140 ), 'selectors' => array( '{{WRAPPER}} .wss-video-chip' => 'width: {{SIZE}}{{UNIT}};' ), 'condition' => array( 'show_video_chip' => 'yes' ) )
		);
		$this->add_control(
			'chip_border_color',
			array( 'label' => __( 'Border Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-video-chip' => 'border-color: {{VALUE}};' ), 'condition' => array( 'show_video_chip' => 'yes' ) )
		);
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		?>
		<div class="wss-scope">
			<section class="wss-pad">
				<div class="wss-container wss-about">
					<div class="wss-reveal">
						<span class="wss-eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></span>
						<h2><span class="wss-mask"><span><?php echo esc_html( $s['heading'] ); ?></span></span></h2>
						<p><?php echo esc_html( $s['description'] ); ?></p>
						<div class="wss-about-actions">
							<?php if ( ! empty( $s['btn1_text'] ) ) : ?>
								<a href="<?php echo esc_url( $s['btn1_link']['url'] ?: '#' ); ?>"<?php echo ! empty( $s['btn1_link']['is_external'] ) ? ' target="_blank" rel="noopener"' : ''; ?> class="wss-btn-pill"><?php echo esc_html( $s['btn1_text'] ); ?> <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
							<?php endif; ?>
							<?php if ( ! empty( $s['btn2_text'] ) ) : ?>
								<a href="<?php echo esc_url( $s['btn2_link']['url'] ?: '#' ); ?>"<?php echo ! empty( $s['btn2_link']['is_external'] ) ? ' target="_blank" rel="noopener"' : ''; ?> class="wss-btn-pill"><?php echo esc_html( $s['btn2_text'] ); ?> <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
							<?php endif; ?>
						</div>
					</div>
					<div class="wss-about-media wss-reveal wss-r2">
						<div class="wss-img-reveal"><img src="<?php echo esc_url( $s['main_image']['url'] ); ?>" alt="<?php echo esc_attr( $s['heading'] ); ?>"></div>
						<?php if ( 'yes' === $s['show_video_chip'] ) : ?>
							<div class="wss-video-chip wss-video-trigger" data-video-url="<?php echo esc_url( $s['video_link'] ); ?>">
								<img src="<?php echo esc_url( $s['video_image']['url'] ); ?>" alt="<?php echo esc_attr( $s['heading'] ); ?> preview">
								<div class="wss-play-overlay">
									<svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z" fill="currentColor"/></svg>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</section>
		</div>
		<?php
	}
}
