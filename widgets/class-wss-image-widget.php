<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class WSS_Image_Widget extends Widget_Base {

	public function get_name() {
		return 'wss_image';
	}

	public function get_title() {
		return __( 'WSS — Luxury Image & Media', 'website-section-supporter' );
	}

	public function get_icon() {
		return 'eicon-image-rollover';
	}

	public function get_categories() {
		return array( 'website-section-supporter' );
	}

	public function get_keywords() {
		return array( 'image', 'photo', 'reveal', 'curtain', 'video', 'media', 'luxury', 'wss' );
	}

	protected function register_controls() {

		/* ================= CONTENT: IMAGE ================= */
		$this->start_controls_section(
			'section_image',
			array( 'label' => __( 'Image & Media', 'website-section-supporter' ) )
		);
		$this->add_control(
			'image',
			array(
				'label'   => __( 'Choose Image', 'website-section-supporter' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=1200&q=85',
				),
				'dynamic' => array( 'active' => true ),
			)
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'image',
				'default'   => 'large',
				'separator' => 'none',
			)
		);
		$this->add_control(
			'aspect_ratio',
			array(
				'label'   => __( 'Aspect Ratio', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '4/3',
				'options' => array(
					'auto'   => __( 'Original Image Ratio (Auto)', 'website-section-supporter' ),
					'1/1'    => __( '1:1 (Square)', 'website-section-supporter' ),
					'4/3'    => __( '4:3 (Classic)', 'website-section-supporter' ),
					'3/4'    => __( '3:4 (Luxury Portrait)', 'website-section-supporter' ),
					'16/9'   => __( '16:9 (Widescreen)', 'website-section-supporter' ),
					'21/9'   => __( '21:9 (Cinematic Panorama)', 'website-section-supporter' ),
					'custom' => __( 'Custom Aspect Ratio', 'website-section-supporter' ),
				),
			)
		);
		$this->add_control(
			'custom_aspect_ratio',
			array(
				'label'       => __( 'Custom Ratio (e.g. 16/10 or 3/2)', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '16/10',
				'condition'   => array( 'aspect_ratio' => 'custom' ),
			)
		);
		$this->add_control(
			'image_link',
			array(
				'label'       => __( 'Link', 'website-section-supporter' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'website-section-supporter' ),
				'dynamic'     => array( 'active' => true ),
			)
		);
		$this->end_controls_section();

		/* ================= CONTENT: ANIMATION & REVEAL ================= */
		$this->start_controls_section(
			'section_animation',
			array( 'label' => __( 'Luxury Animation Effects', 'website-section-supporter' ) )
		);
		$this->add_control(
			'enable_curtain_reveal',
			array(
				'label'        => __( 'Curtain Wipe Reveal on Scroll', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'enable_hover_zoom',
			array(
				'label'        => __( 'Smooth Luxury Hover Zoom', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);
		$this->end_controls_section();

		/* ================= CONTENT: BADGE & CAPTION ================= */
		$this->start_controls_section(
			'section_badge_caption',
			array( 'label' => __( 'Floating Badge & Caption', 'website-section-supporter' ) )
		);
		$this->add_control(
			'show_badge',
			array(
				'label'        => __( 'Show Floating Badge', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'badge_text',
			array(
				'label'     => __( 'Badge Text', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'TROPHY ASSET', 'website-section-supporter' ),
				'condition' => array( 'show_badge' => 'yes' ),
				'dynamic'   => array( 'active' => true ),
			)
		);
		$this->add_control(
			'badge_position',
			array(
				'label'     => __( 'Badge Position', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'tl',
				'options'   => array(
					'tl' => __( 'Top Left', 'website-section-supporter' ),
					'tr' => __( 'Top Right', 'website-section-supporter' ),
					'bl' => __( 'Bottom Left', 'website-section-supporter' ),
					'br' => __( 'Bottom Right', 'website-section-supporter' ),
				),
				'condition' => array( 'show_badge' => 'yes' ),
			)
		);
		$this->add_control(
			'show_caption',
			array(
				'label'        => __( 'Show Floating Caption', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
				'separator'    => 'before',
			)
		);
		$this->add_control(
			'caption_text',
			array(
				'label'     => __( 'Caption Text', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'BEVERLY HILLS, CA', 'website-section-supporter' ),
				'condition' => array( 'show_caption' => 'yes' ),
				'dynamic'   => array( 'active' => true ),
			)
		);
		$this->end_controls_section();

		/* ================= CONTENT: VIDEO MODAL TRIGGER ================= */
		$this->start_controls_section(
			'section_video_modal',
			array( 'label' => __( 'Video Lightbox Overlay', 'website-section-supporter' ) )
		);
		$this->add_control(
			'enable_video',
			array(
				'label'        => __( 'Enable Video Lightbox', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'video_url',
			array(
				'label'       => __( 'Video URL (YouTube, Vimeo, MP4)', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'https://www.youtube.com/watch?v=...',
				'condition'   => array( 'enable_video' => 'yes' ),
				'dynamic'     => array( 'active' => true ),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: IMAGE & CONTAINER ================= */
		$this->start_controls_section(
			'style_image_box',
			array( 'label' => __( 'Image & Container', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_responsive_control(
			'image_align',
			array(
				'label'     => __( 'Alignment', 'website-section-supporter' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array( 'title' => __( 'Left', 'website-section-supporter' ), 'icon' => 'eicon-text-align-left' ),
					'center' => array( 'title' => __( 'Center', 'website-section-supporter' ), 'icon' => 'eicon-text-align-center' ),
					'right'  => array( 'title' => __( 'Right', 'website-section-supporter' ), 'icon' => 'eicon-text-align-right' ),
				),
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .wss-image-component' => 'margin-left: {{VALUE}} == "center" ? auto : ({{VALUE}} == "right" ? auto : 0); margin-right: {{VALUE}} == "center" ? auto : ({{VALUE}} == "left" ? auto : 0);',
				),
			)
		);
		$this->add_responsive_control(
			'image_max_width',
			array(
				'label'      => __( 'Max Width', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'vw' ),
				'range'      => array( 'px' => array( 'min' => 100, 'max' => 1600 ) ),
				'selectors'  => array( '{{WRAPPER}} .wss-image-component' => 'max-width: {{SIZE}}{{UNIT}};' ),
			)
		);
		$this->add_control(
			'image_border_radius',
			array(
				'label'     => __( 'Border Radius', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 80 ) ),
				'selectors' => array(
					'{{WRAPPER}} .wss-image-component, {{WRAPPER}} .wss-image-inner, {{WRAPPER}} .wss-image-inner img, {{WRAPPER}} .wss-img-reveal' => 'border-radius: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array( 'name' => 'image_border', 'selector' => '{{WRAPPER}} .wss-image-component' )
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array( 'name' => 'image_shadow', 'selector' => '{{WRAPPER}} .wss-image-component' )
		);
		$this->end_controls_section();

		/* ================= STYLE: OVERLAY TINT ================= */
		$this->start_controls_section(
			'style_overlay',
			array( 'label' => __( 'Overlay Gradient / Tint', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_control(
			'overlay_bg',
			array(
				'label'     => __( 'Overlay Color / Gradient', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-image-overlay' => 'background: {{VALUE}} !important;' ),
			)
		);
		$this->add_control(
			'overlay_hover_bg',
			array(
				'label'     => __( 'Hover Overlay Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-image-component:hover .wss-image-overlay' => 'background: {{VALUE}} !important;' ),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: BADGE ================= */
		$this->start_controls_section(
			'style_badge',
			array( 'label' => __( 'Floating Badge', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array( 'show_badge' => 'yes' ) )
		);
		$this->add_control(
			'badge_color',
			array(
				'label'     => __( 'Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-image-badge' => 'color: {{VALUE}} !important;' ),
			)
		);
		$this->add_control(
			'badge_bg',
			array(
				'label'     => __( 'Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-image-badge' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;' ),
			)
		);
		$this->add_control(
			'badge_border_color',
			array(
				'label'     => __( 'Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-image-badge' => 'border-color: {{VALUE}} !important;' ),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'badge_typography', 'selector' => '{{WRAPPER}} .wss-image-badge' )
		);
		$this->end_controls_section();

		/* ================= STYLE: CAPTION ================= */
		$this->start_controls_section(
			'style_caption',
			array( 'label' => __( 'Floating Caption', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array( 'show_caption' => 'yes' ) )
		);
		$this->add_control(
			'caption_color',
			array(
				'label'     => __( 'Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-image-caption' => 'color: {{VALUE}} !important;' ),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'caption_typography', 'selector' => '{{WRAPPER}} .wss-image-caption' )
		);
		$this->end_controls_section();

		/* ================= STYLE: VIDEO PLAY BUTTON ================= */
		$this->start_controls_section(
			'style_play_btn',
			array( 'label' => __( 'Video Play Button', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array( 'enable_video' => 'yes' ) )
		);
		$this->add_control(
			'play_btn_color',
			array(
				'label'     => __( 'Icon Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-image-play-btn' => 'color: {{VALUE}} !important;' ),
			)
		);
		$this->add_control(
			'play_btn_bg',
			array(
				'label'     => __( 'Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-image-play-btn' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;' ),
			)
		);
		$this->add_control(
			'play_btn_border_color',
			array(
				'label'     => __( 'Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-image-play-btn' => 'border-color: {{VALUE}} !important;' ),
			)
		);
		$this->add_control(
			'play_btn_hover_color',
			array(
				'label'     => __( 'Hover Icon Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-image-play-btn:hover' => 'color: {{VALUE}} !important;' ),
			)
		);
		$this->add_control(
			'play_btn_hover_bg',
			array(
				'label'     => __( 'Hover Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-image-play-btn:hover' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;' ),
			)
		);
		$this->add_control(
			'play_btn_size',
			array(
				'label'     => __( 'Button Size (px)', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 40, 'max' => 120 ) ),
				'default'   => array( 'size' => 64 ),
				'selectors' => array( '{{WRAPPER}} .wss-image-play-btn' => 'width: {{SIZE}}px !important; height: {{SIZE}}px !important;' ),
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();

		if ( empty( $s['image']['url'] ) ) {
			return;
		}

		$ratio = ! empty( $s['aspect_ratio'] ) ? $s['aspect_ratio'] : '4/3';
		if ( 'custom' === $ratio && ! empty( $s['custom_aspect_ratio'] ) ) {
			$ratio = $s['custom_aspect_ratio'];
		}

		$ratio_style = ( 'auto' !== $ratio ) ? 'aspect-ratio: ' . esc_attr( $ratio ) . ';' : '';
		$reveal_class = ( 'yes' === ( $s['enable_curtain_reveal'] ?? 'yes' ) ) ? 'wss-img-reveal' : '';

		$has_link = ! empty( $s['image_link']['url'] );
		$link_target = ! empty( $s['image_link']['is_external'] ) ? ' target="_blank"' : '';
		$link_nofollow = ! empty( $s['image_link']['nofollow'] ) ? ' rel="nofollow"' : '';

		$badge_pos_class = 'wss-badge-' . ( $s['badge_position'] ?? 'tl' );
		?>
		<div class="wss-scope">
			<div class="wss-image-component">
				<div class="wss-image-inner <?php echo esc_attr( $reveal_class ); ?>" style="<?php echo esc_attr( $ratio_style ); ?>">
					<?php if ( $has_link && 'yes' !== ( $s['enable_video'] ?? 'no' ) ) : ?>
						<a href="<?php echo esc_url( $s['image_link']['url'] ); ?>"<?php echo $link_target . $link_nofollow; ?>>
					<?php endif; ?>

					<?php echo Group_Control_Image_Size::get_attachment_image_html( $s, 'image' ); ?>

					<div class="wss-image-overlay"></div>

					<?php if ( 'yes' === ( $s['show_badge'] ?? 'no' ) && ! empty( $s['badge_text'] ) ) : ?>
						<div class="wss-image-badge <?php echo esc_attr( $badge_pos_class ); ?>">
							<?php echo esc_html( $s['badge_text'] ); ?>
						</div>
					<?php endif; ?>

					<?php if ( 'yes' === ( $s['show_caption'] ?? 'no' ) && ! empty( $s['caption_text'] ) ) : ?>
						<div class="wss-image-caption">
							<?php echo esc_html( $s['caption_text'] ); ?>
						</div>
					<?php endif; ?>

					<?php if ( 'yes' === ( $s['enable_video'] ?? 'no' ) && ! empty( $s['video_url'] ) ) : ?>
						<button type="button" class="wss-image-play-btn wss-video-trigger" data-video-url="<?php echo esc_url( $s['video_url'] ); ?>" aria-label="Play Video">
							<svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
						</button>
					<?php endif; ?>

					<?php if ( $has_link && 'yes' !== ( $s['enable_video'] ?? 'no' ) ) : ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
	}
}
