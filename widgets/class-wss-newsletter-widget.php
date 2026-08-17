<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;

class WSS_Newsletter_Widget extends Widget_Base {

	public function get_name() { return 'wss_newsletter'; }
	public function get_title() { return __( 'WSS — Newsletter CTA', 'website-section-supporter' ); }
	public function get_icon() { return 'eicon-form-horizontal'; }
	public function get_categories() { return array( 'website-section-supporter' ); }
	public function get_keywords() { return array( 'newsletter', 'form', 'cta', 'subscribe', 'parallax' ); }

	protected function register_controls() {

		/* ================= CONTENT ================= */
		$this->start_controls_section( 'section_content', array( 'label' => __( 'Content', 'website-section-supporter' ) ) );
		$this->add_control( 'bg_image', array( 'label' => __( 'Background Image', 'website-section-supporter' ), 'type' => Controls_Manager::MEDIA, 'default' => array( 'url' => 'https://picsum.photos/seed/noirocean/1800/900' ) ) );
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'bg_image_size',
				'default'   => 'full',
				'separator' => 'none',
			)
		);
		$this->add_control( 'eyebrow', array( 'label' => __( 'Eyebrow', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'Newsletter', 'website-section-supporter' ) ) );
		$this->add_control( 'heading', array( 'label' => __( 'Heading', 'website-section-supporter' ), 'type' => Controls_Manager::TEXTAREA, 'default' => __( 'Learn More About Our Luxury Listings & Services', 'website-section-supporter' ), 'rows' => 3 ) );
		$this->end_controls_section();

		/* ================= PARALLAX & MOTION CONTROLS ================= */
		$this->start_controls_section(
			'section_parallax',
			array( 'label' => __( 'Parallax & Motion Effects', 'website-section-supporter' ) )
		);

		$this->add_control(
			'enable_parallax',
			array(
				'label'        => __( 'Enable Parallax Effect', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'website-section-supporter' ),
				'label_off'    => __( 'No', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'parallax_mode',
			array(
				'label'     => __( 'Parallax Mode', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'scroll',
				'options'   => array(
					'scroll' => __( 'Scroll Parallax (Smooth translate on scroll)', 'website-section-supporter' ),
					'fixed'  => __( 'Fixed Attachment (Window reveal effect)', 'website-section-supporter' ),
					'zoom'   => __( 'Scroll Zoom (Scale up on scroll)', 'website-section-supporter' ),
					'tilt'   => __( '3D Mouse Tilt (Interactive on hover)', 'website-section-supporter' ),
				),
				'condition' => array( 'enable_parallax' => 'yes' ),
			)
		);

		$this->add_control(
			'parallax_direction',
			array(
				'label'     => __( 'Scroll Direction', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'up',
				'options'   => array(
					'up'    => __( 'Vertical Move Up', 'website-section-supporter' ),
					'down'  => __( 'Vertical Move Down', 'website-section-supporter' ),
					'left'  => __( 'Horizontal Move Left', 'website-section-supporter' ),
					'right' => __( 'Horizontal Move Right', 'website-section-supporter' ),
				),
				'condition' => array(
					'enable_parallax' => 'yes',
					'parallax_mode'   => 'scroll',
				),
			)
		);

		$this->add_control(
			'parallax_speed',
			array(
				'label'     => __( 'Parallax Speed / Strength', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 0.05,
						'max'  => 0.8,
						'step' => 0.01,
					),
				),
				'default'   => array( 'size' => 0.18 ),
				'condition' => array(
					'enable_parallax' => 'yes',
					'parallax_mode'   => array( 'scroll', 'zoom' ),
				),
			)
		);

		$this->add_control(
			'parallax_scale',
			array(
				'label'       => __( 'Image Bleed / Scale', 'website-section-supporter' ),
				'description' => __( 'Extra image scale inside container to prevent white borders during motion.', 'website-section-supporter' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => array(
					'px' => array(
						'min'  => 1.0,
						'max'  => 1.6,
						'step' => 0.01,
					),
				),
				'default'     => array( 'size' => 1.25 ),
				'condition'   => array(
					'enable_parallax' => 'yes',
					'parallax_mode'   => array( 'scroll', 'zoom', 'tilt' ),
				),
			)
		);

		$this->add_control(
			'tilt_max',
			array(
				'label'     => __( 'Max Tilt Angle (Deg)', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 3,
						'max' => 25,
					),
				),
				'default'   => array( 'size' => 10 ),
				'condition' => array(
					'enable_parallax' => 'yes',
					'parallax_mode'   => 'tilt',
				),
			)
		);

		$this->add_control(
			'parallax_disable_mobile',
			array(
				'label'        => __( 'Disable Motion on Mobile', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'website-section-supporter' ),
				'label_off'    => __( 'No', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array( 'enable_parallax' => 'yes' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section( 'section_form', array( 'label' => __( 'Form', 'website-section-supporter' ) ) );
		$this->add_control(
			'form_type',
			array(
				'label'   => __( 'Form Type', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'custom',
				'options' => array(
					'custom'    => __( 'Custom Design (HTML)', 'website-section-supporter' ),
					'shortcode' => __( 'Shortcode (Elementor Pro / WPForms)', 'website-section-supporter' ),
				),
			)
		);
		$this->add_control(
			'form_shortcode',
			array(
				'label'       => __( 'Form Shortcode', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => '[elementor-template id="123"] or [wpforms id="1"]',
				'condition'   => array( 'form_type' => 'shortcode' ),
			)
		);
		$this->add_control(
			'form_action',
			array(
				'label'       => __( 'Form Action URL (Webhook)', 'website-section-supporter' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://webhook.site/...',
				'condition'   => array( 'form_type' => 'custom' ),
			)
		);
		$this->add_control(
			'name_placeholder',
			array( 'label' => __( 'Name Placeholder', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => 'Name', 'condition' => array( 'form_type' => 'custom' ) )
		);
		$this->add_control(
			'email_placeholder',
			array( 'label' => __( 'Email Placeholder', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => 'Email Address', 'condition' => array( 'form_type' => 'custom' ) )
		);
		$this->add_control(
			'button_text',
			array( 'label' => __( 'Button Text', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => 'Submit', 'condition' => array( 'form_type' => 'custom' ) )
		);
		$this->end_controls_section();

		/* ================= EMAIL SETTINGS ================= */
		$this->start_controls_section(
			'section_email_settings',
			array(
				'label'     => __( 'Email Settings', 'website-section-supporter' ),
				'condition' => array( 'form_type' => 'custom' ),
			)
		);

		$this->add_control(
			'email_to',
			array(
				'label'       => __( 'To Email', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => get_option( 'admin_email' ),
				'placeholder' => 'admin@example.com',
				'description' => __( 'Default is site admin email.', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'email_cc',
			array(
				'label'       => __( 'CC Email', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'cc@example.com',
			)
		);

		$this->add_control(
			'email_bcc',
			array(
				'label'       => __( 'BCC Email', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'bcc@example.com',
			)
		);

		$this->add_control(
			'email_subject',
			array(
				'label'   => __( 'Email Subject', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'New Newsletter Lead: {{name}}', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'email_content_type',
			array(
				'label'   => __( 'Content Type', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'html',
				'options' => array(
					'html'  => 'HTML',
					'plain' => 'Plain Text',
				),
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: SECTION ================= */
		$this->start_controls_section(
			'style_section',
			array( 'label' => __( 'Section', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_responsive_control(
			'section_padding',
			array( 'label' => __( 'Padding', 'website-section-supporter' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array( 'px', '%', 'vw' ), 'selectors' => array( '{{WRAPPER}} .wss-newsletter .wss-pad' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ) )
		);
		$this->add_control(
			'overlay_gradient',
			array( 'label' => __( 'Overlay Gradient', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'default' => 'rgba(19,18,16,.75)', 'selectors' => array( '{{WRAPPER}} .wss-newsletter::after' => 'background: linear-gradient(90deg, {{VALUE}}, rgba(19,18,16,.35));' ) )
		);

		$this->add_responsive_control(
			'columns_gap',
			array( 'label' => __( 'Gap Between Text & Form', 'website-section-supporter' ), 'type' => Controls_Manager::SLIDER, 'size_units' => array( 'px', 'vw' ), 'range' => array( 'vw' => array( 'min' => 0, 'max' => 15 ) ), 'selectors' => array( '{{WRAPPER}} .wss-newsletter-inner' => 'gap: {{SIZE}}{{UNIT}};' ) )
		);

		$this->add_control( 'img_adjust_heading', array( 'label' => __( 'Background Image Adjustments', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_responsive_control(
			'bg_position',
			array(
				'label'     => __( 'Background Position', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'center center',
				'options'   => array(
					'center center' => __( 'Center Center (Default)', 'website-section-supporter' ),
					'center top'    => __( 'Center Top', 'website-section-supporter' ),
					'center bottom' => __( 'Center Bottom', 'website-section-supporter' ),
					'left center'   => __( 'Left Center', 'website-section-supporter' ),
					'right center'  => __( 'Right Center', 'website-section-supporter' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .wss-newsletter-bg' => 'background-position: {{VALUE}} !important;',
				),
			)
		);
		$this->add_responsive_control(
			'bg_brightness',
			array(
				'label'      => __( 'Brightness', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 2, 'step' => 0.05 ) ),
				'default'    => array( 'size' => 0.55 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-newsletter-bg' => 'filter: brightness({{SIZE}}) contrast(1.1);',
				),
			)
		);
		$this->add_responsive_control(
			'bg_contrast',
			array(
				'label'      => __( 'Contrast', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 3, 'step' => 0.05 ) ),
				'default'    => array( 'size' => 1.1 ),
				'selectors'  => array(
					'{{WRAPPER}} .wss-newsletter-bg' => 'filter: brightness(' . "'" . '{{bg_brightness.SIZE}}' . "'" . ') contrast({{SIZE}});',
				),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: HEADING ================= */
		$this->start_controls_section(
			'style_heading',
			array( 'label' => __( 'Eyebrow & Heading', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_control( 'eyebrow_color', array( 'label' => __( 'Eyebrow Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-newsletter-inner .wss-eyebrow' => 'color: {{VALUE}};' ) ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'eyebrow_typography', 'selector' => '{{WRAPPER}} .wss-newsletter-inner .wss-eyebrow' ) );
		$this->add_control( 'heading_color', array( 'label' => __( 'Heading Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'default' => '#ffffff', 'selectors' => array( '{{WRAPPER}} .wss-newsletter-inner h2' => 'color: {{VALUE}};' ) ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'heading_typography', 'selector' => '{{WRAPPER}} .wss-newsletter-inner h2' ) );
		$this->end_controls_section();

		/* ================= STYLE: FORM ================= */
		$this->start_controls_section(
			'style_form',
			array( 'label' => __( 'Form Fields', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_control( 'input_color', array( 'label' => __( 'Input Text Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-nl-row input' => 'color: {{VALUE}} !important;' ) ) );
		$this->add_control( 'placeholder_color', array( 'label' => __( 'Placeholder Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-nl-row input::placeholder' => 'color: {{VALUE}} !important;' ) ) );
		$this->add_control( 'input_border_color', array( 'label' => __( 'Bottom Border Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-nl-row input' => 'border-bottom-color: {{VALUE}} !important;' ) ) );
		$this->add_control( 'input_focus_border_color', array( 'label' => __( 'Focus Border Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-nl-row input:focus' => 'border-bottom-color: {{VALUE}} !important;' ) ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'input_typography', 'selector' => '{{WRAPPER}} .wss-nl-row input' ) );
		$this->add_responsive_control(
			'form_gap',
			array( 'label' => __( 'Gap Between Rows', 'website-section-supporter' ), 'type' => Controls_Manager::SLIDER, 'range' => array( 'px' => array( 'min' => 0, 'max' => 40 ) ), 'default' => array( 'size' => 16 ), 'selectors' => array( '{{WRAPPER}} .wss-nl-form' => 'gap: {{SIZE}}{{UNIT}};' ) )
		);
		$this->end_controls_section();

		/* ================= STYLE: SUBMIT BUTTON ================= */
		$this->start_controls_section(
			'style_button',
			array( 'label' => __( 'Submit Button', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'btn_typography', 'selector' => '{{WRAPPER}} .wss-nl-row button' ) );
		$this->add_control(
			'btn_radius',
			array( 'label' => __( 'Border Radius', 'website-section-supporter' ), 'type' => Controls_Manager::SLIDER, 'range' => array( 'px' => array( 'min' => 0, 'max' => 60 ) ), 'default' => array( 'size' => 40 ), 'selectors' => array( '{{WRAPPER}} .wss-nl-row button' => 'border-radius: {{SIZE}}{{UNIT}} !important;' ) )
		);
		$this->add_responsive_control(
			'btn_padding',
			array( 'label' => __( 'Padding', 'website-section-supporter' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array( 'px', 'em' ), 'selectors' => array( '{{WRAPPER}} .wss-nl-row button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;' ) )
		);

		/* Normal / Hover Tabs */
		$this->start_controls_tabs( 'tabs_nl_btn_style' );
		$this->start_controls_tab(
			'tab_nl_btn_normal',
			array( 'label' => __( 'Normal', 'website-section-supporter' ) )
		);
		$this->add_control( 'btn_color', array( 'label' => __( 'Text Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-nl-row button' => 'color: {{VALUE}} !important;' ) ) );
		$this->add_control( 'btn_bg', array( 'label' => __( 'Background Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-nl-row button' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;' ) ) );
		$this->add_control( 'btn_border_color', array( 'label' => __( 'Border Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-nl-row button' => 'border-color: {{VALUE}} !important;' ) ) );
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_nl_btn_hover',
			array( 'label' => __( 'Hover', 'website-section-supporter' ) )
		);
		$this->add_control( 'btn_hover_color', array( 'label' => __( 'Hover Text Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-nl-row button:hover' => 'color: {{VALUE}} !important;' ) ) );
		$this->add_control( 'btn_hover_bg', array(
			'label'     => __( 'Hover Background / Effect Color', 'website-section-supporter' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => array(
				'{{WRAPPER}} .wss-nl-row button::before' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				'{{WRAPPER}} .wss-nl-row button:hover'   => 'background: transparent !important; background-color: transparent !important;',
			),
		) );
		$this->add_control( 'btn_hover_border_color', array( 'label' => __( 'Hover Border Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-nl-row button:hover' => 'border-color: {{VALUE}} !important;' ) ) );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();

		$enable_parallax = ! empty( $s['enable_parallax'] ) && 'yes' === $s['enable_parallax'];
		$parallax_mode   = ! empty( $s['parallax_mode'] ) ? $s['parallax_mode'] : 'scroll';
		$parallax_speed  = ! empty( $s['parallax_speed']['size'] ) ? floatval( $s['parallax_speed']['size'] ) : 0.18;
		$parallax_scale  = ! empty( $s['parallax_scale']['size'] ) ? floatval( $s['parallax_scale']['size'] ) : 1.25;
		$parallax_dir    = ! empty( $s['parallax_direction'] ) ? $s['parallax_direction'] : 'up';
		$tilt_max        = ! empty( $s['tilt_max']['size'] ) ? floatval( $s['tilt_max']['size'] ) : 10;
		$disable_mobile  = ! empty( $s['parallax_disable_mobile'] ) ? $s['parallax_disable_mobile'] : 'yes';

		// Get highest quality uncompressed resolution for background image
		$bg_img = '';
		if ( ! empty( $s['bg_image']['id'] ) ) {
			$src = Group_Control_Image_Size::get_attachment_image_src( $s['bg_image']['id'], 'bg_image_size', $s );
			if ( ! empty( $src ) ) {
				$bg_img = $src;
			} else {
				$full_data = wp_get_attachment_image_src( $s['bg_image']['id'], 'full' );
				$bg_img = ! empty( $full_data[0] ) ? $full_data[0] : '';
			}
		}
		if ( empty( $bg_img ) && ! empty( $s['bg_image']['url'] ) ) {
			$bg_img = $s['bg_image']['url'];
		}
		if ( empty( $bg_img ) ) {
			$bg_img = 'https://picsum.photos/seed/noirocean/1800/900';
		}

		$section_class = 'wss-newsletter';
		if ( $enable_parallax ) {
			$section_class .= ' wss-has-parallax';
			if ( 'fixed' === $parallax_mode ) {
				$section_class .= ' wss-parallax-fixed-section';
			}
		} else {
			$section_class .= ' wss-no-parallax';
		}
		?>
		<div class="wss-scope">
			<section class="<?php echo esc_attr( $section_class ); ?>"
				<?php if ( $enable_parallax && 'fixed' !== $parallax_mode ) : ?>
					data-parallax-mode="<?php echo esc_attr( $parallax_mode ); ?>"
					data-parallax-speed="<?php echo esc_attr( $parallax_speed ); ?>"
					data-parallax-scale="<?php echo esc_attr( $parallax_scale ); ?>"
					data-parallax-direction="<?php echo esc_attr( $parallax_dir ); ?>"
					data-tilt-max="<?php echo esc_attr( $tilt_max ); ?>"
					data-parallax-disable-mobile="<?php echo esc_attr( $disable_mobile ); ?>"
				<?php endif; ?>>
				<div class="wss-newsletter-bg<?php echo ( $enable_parallax && 'fixed' === $parallax_mode ) ? ' wss-parallax-fixed-bg' : ( $enable_parallax ? ' wss-parallax-img' : '' ); ?>" style="background-image: url('<?php echo esc_url( $bg_img ); ?>');"></div>
				<div class="wss-container wss-pad">
					<div class="wss-newsletter-inner">
						<div class="wss-reveal">
							<span class="wss-eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></span>
							<h2><span class="wss-mask"><span><?php echo esc_html( $s['heading'] ); ?></span></span></h2>
						</div>
						<?php if ( 'shortcode' === $s['form_type'] && ! empty( $s['form_shortcode'] ) ) : ?>
							<div class="wss-nl-shortcode wss-reveal wss-r2">
								<?php echo do_shortcode( shortcode_unautop( $s['form_shortcode'] ) ); ?>
							</div>
						<?php else : ?>
							<?php $has_webhook = ! empty( $s['form_action']['url'] ); ?>
							<?php if ( $has_webhook ) : ?>
								<form class="wss-nl-form wss-reveal wss-r2" action="<?php echo esc_url( $s['form_action']['url'] ); ?>" method="post">
									<div class="wss-nl-row"><input type="text" placeholder="<?php echo esc_attr( $s['name_placeholder'] ); ?>" name="wss_name" required></div>
									<div class="wss-nl-row">
										<input type="email" placeholder="<?php echo esc_attr( $s['email_placeholder'] ); ?>" name="wss_email" required>
										<button type="submit"><?php echo esc_html( $s['button_text'] ); ?> <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></button>
									</div>
								</form>
							<?php else : ?>
								<form class="wss-nl-form wss-ajax-form wss-reveal wss-r2" action="<?php echo esc_url( admin_url('admin-ajax.php') ); ?>" method="post">
									<input type="hidden" name="action" value="wss_newsletter_submit">
									<input type="hidden" name="wss_newsletter_nonce" value="<?php echo wp_create_nonce('wss_newsletter_nonce'); ?>">
									<input type="hidden" name="email_to" value="<?php echo esc_attr( $s['email_to'] ?? '' ); ?>">
									<input type="hidden" name="email_cc" value="<?php echo esc_attr( $s['email_cc'] ?? '' ); ?>">
									<input type="hidden" name="email_bcc" value="<?php echo esc_attr( $s['email_bcc'] ?? '' ); ?>">
									<input type="hidden" name="email_subject" value="<?php echo esc_attr( $s['email_subject'] ?? '' ); ?>">
									<input type="hidden" name="email_content_type" value="<?php echo esc_attr( $s['email_content_type'] ?? 'html' ); ?>">
									<input type="hidden" name="post_id" value="<?php echo get_the_ID(); ?>">
									<input type="hidden" name="widget_id" value="<?php echo esc_attr($this->get_id()); ?>">
									
									<div class="wss-nl-row"><input type="text" placeholder="<?php echo esc_attr( $s['name_placeholder'] ); ?>" name="wss_name" required></div>
									<div class="wss-nl-row">
										<input type="email" placeholder="<?php echo esc_attr( $s['email_placeholder'] ); ?>" name="wss_email" required>
										<button type="submit"><?php echo esc_html( $s['button_text'] ); ?> <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></button>
									</div>
									<div class="wss-nl-msg" style="display:none; font-size:12px; margin-top:8px;"></div>
								</form>
							<?php endif; ?>
						<?php endif; ?>
					</div>
				</div>
			</section>
		</div>
		<?php
	}
}
