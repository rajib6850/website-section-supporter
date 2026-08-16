<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;

class WSS_Testimonial_Widget extends Widget_Base {

	public function get_name() { return 'wss_testimonial'; }
	public function get_title() { return __( 'WSS — Testimonial', 'website-section-supporter' ); }
	public function get_icon() { return 'eicon-testimonial'; }
	public function get_categories() { return array( 'website-section-supporter' ); }
	public function get_keywords() { return array( 'testimonial', 'quote', 'review' ); }

	protected function register_controls() {

		/* ================= CONTENT ================= */
		$this->start_controls_section( 'section_content', array( 'label' => __( 'Content', 'website-section-supporter' ) ) );
		$this->add_control( 'eyebrow', array( 'label' => __( 'Eyebrow', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'The Client Experience', 'website-section-supporter' ) ) );
		$this->add_control( 'heading', array( 'label' => __( 'Heading', 'website-section-supporter' ), 'type' => Controls_Manager::TEXTAREA, 'default' => __( "What My Clients\nAre Saying", 'website-section-supporter' ), 'rows' => 2 ) );

		$repeater = new Repeater();
		$repeater->add_control( 'quote', array( 'label' => __( 'Quote', 'website-section-supporter' ), 'type' => Controls_Manager::TEXTAREA, 'default' => __( 'Working with this team was a genuine pleasure. They took the time to explain things clearly and guided us through every step with patience and care.', 'website-section-supporter' ), 'rows' => 5 ) );
		$repeater->add_control( 'name', array( 'label' => __( 'Client Name', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => 'Alexandra M.' ) );
		$repeater->add_control( 'role', array( 'label' => __( 'Role / Context', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => 'Seller, Private Client' ) );
		$repeater->add_control( 'image', array( 'label' => __( 'Person Image', 'website-section-supporter' ), 'type' => Controls_Manager::MEDIA, 'default' => array( 'url' => 'https://picsum.photos/seed/noirtesti1/600/800' ) ) );

		$this->add_control( 'testimonials', array(
			'label'       => __( 'Testimonials', 'website-section-supporter' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => array(
				array(
					'quote' => 'Working with this team was a genuine pleasure. They took the time to explain things clearly and guided us through every step with patience and care.',
					'name'  => 'Alexandra M.',
					'role'  => 'Seller, Private Client',
					'image' => array( 'url' => 'https://picsum.photos/seed/noirtesti1/600/800' ),
				),
				array(
					'quote' => 'An extraordinary experience from start to finish. Their market insight and dedication made the entire process seamless. We found our dream home in record time.',
					'name'  => 'James & Sarah K.',
					'role'  => 'Buyers, Luxury Residence',
					'image' => array( 'url' => 'https://picsum.photos/seed/noirtesti2/600/800' ),
				),
				array(
					'quote' => 'Exceptional professionalism and a deep understanding of the luxury market. I would not trust anyone else with such a significant transaction.',
					'name'  => 'Richard V.',
					'role'  => 'Investor, Portfolio Client',
					'image' => array( 'url' => 'https://picsum.photos/seed/noirtesti3/600/800' ),
				),
			),
			'title_field' => '{{{ name }}}',
		) );
		$this->end_controls_section();

		/* ================= STYLE: SECTION ================= */
		$this->start_controls_section( 'style_section', array( 'label' => __( 'Section', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_group_control( Group_Control_Background::get_type(), array( 'name' => 'section_bg', 'types' => array( 'classic', 'gradient' ), 'selector' => '{{WRAPPER}} .wss-pad' ) );
		$this->add_responsive_control( 'section_padding', array( 'label' => __( 'Padding', 'website-section-supporter' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array( 'px', '%', 'vw' ), 'selectors' => array( '{{WRAPPER}} .wss-pad' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ) ) );
		$this->end_controls_section();

		/* ================= STYLE: HEADING ================= */
		$this->start_controls_section( 'style_heading', array( 'label' => __( 'Eyebrow & Heading', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_control( 'eyebrow_color', array( 'label' => __( 'Eyebrow Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-testi-top .wss-eyebrow' => 'color: {{VALUE}};' ) ) );
		$this->add_control( 'heading_color', array( 'label' => __( 'Heading Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-testi-top h2' => 'color: {{VALUE}};' ) ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'heading_typography', 'selector' => '{{WRAPPER}} .wss-testi-top h2' ) );
		$this->end_controls_section();

		/* ================= STYLE: QUOTE ================= */
		$this->start_controls_section( 'style_quote', array( 'label' => __( 'Quote', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_control( 'mark_color', array( 'label' => __( 'Quote Mark Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-quote-mark' => 'color: {{VALUE}};' ) ) );
		$this->add_control( 'quote_color', array( 'label' => __( 'Quote Text Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-quote' => 'color: {{VALUE}};' ) ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'quote_typography', 'selector' => '{{WRAPPER}} .wss-quote' ) );
		$this->end_controls_section();

		/* ================= STYLE: MEDIA ================= */
		$this->start_controls_section( 'style_media', array( 'label' => __( 'Portrait Image', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_control( 'img_radius', array( 'label' => __( 'Border Radius', 'website-section-supporter' ), 'type' => Controls_Manager::SLIDER, 'range' => array( 'px' => array( 'min' => 0, 'max' => 80 ) ), 'default' => array( 'size' => 12 ), 'selectors' => array( '{{WRAPPER}} .wss-testi-media-wrap .wss-img-reveal' => 'border-radius: {{SIZE}}{{UNIT}};' ) ) );
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), array( 'name' => 'img_shadow', 'selector' => '{{WRAPPER}} .wss-testi-media-wrap' ) );
		$this->end_controls_section();

		/* ================= STYLE: NAV ARROWS & DOTS ================= */
		$this->start_controls_section(
			'style_nav',
			array( 'label' => __( 'Nav Arrows & Dots', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_control( 'nav_color', array(
			'label'     => __( 'Arrow Icon Color', 'website-section-supporter' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => array( '{{WRAPPER}} .wss-testi-nav-btns button' => 'color: {{VALUE}};' ),
		) );
		$this->add_control( 'nav_border_color', array(
			'label'     => __( 'Arrow Border Color', 'website-section-supporter' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => array( '{{WRAPPER}} .wss-testi-nav-btns button' => 'border-color: {{VALUE}};' ),
		) );
		$this->add_control( 'nav_hover_bg', array(
			'label'     => __( 'Hover Background', 'website-section-supporter' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => array( '{{WRAPPER}} .wss-testi-nav-btns button:hover' => 'background: {{VALUE}};' ),
		) );
		$this->add_control( 'nav_hover_color', array(
			'label'     => __( 'Hover Icon Color', 'website-section-supporter' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => array( '{{WRAPPER}} .wss-testi-nav-btns button:hover' => 'color: {{VALUE}};' ),
		) );
		$this->add_responsive_control(
			'nav_size',
			array(
				'label'     => __( 'Button Size', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 30, 'max' => 80 ) ),
				'selectors' => array( '{{WRAPPER}} .wss-testi-nav-btns button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};' ),
			)
		);
		$this->add_control( 'dot_color', array(
			'label'     => __( 'Dot Inactive Color', 'website-section-supporter' ),
			'type'      => Controls_Manager::COLOR,
			'separator' => 'before',
			'selectors' => array( '{{WRAPPER}} .wss-testi-dot' => 'background: {{VALUE}};' ),
		) );
		$this->add_control( 'dot_active_color', array(
			'label'     => __( 'Dot Active Color', 'website-section-supporter' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => array( '{{WRAPPER}} .wss-testi-dot.wss-testi-dot-active' => 'background: {{VALUE}};' ),
		) );
		$this->end_controls_section();
	}

	protected function render() {
		$s     = $this->get_settings_for_display();
		$items = ! empty( $s['testimonials'] ) ? $s['testimonials'] : array();
		if ( empty( $items ) ) { return; }
		$uid = 'wss-testi-' . $this->get_id();
		?>
		<div class="wss-scope">
			<section class="wss-pad">
				<div class="wss-container">
					<div class="wss-testi">

						<!-- LEFT: Heading + Slider -->
						<div class="wss-testi-left wss-reveal">
							<div class="wss-testi-top">
								<span class="wss-eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></span>
								<h2><span class="wss-mask"><span><?php echo nl2br( esc_html( $s['heading'] ) ); ?></span></span></h2>
							</div>

							<div class="wss-testi-slider" id="<?php echo esc_attr( $uid ); ?>-slider">
								<?php foreach ( $items as $i => $item ) : ?>
									<div class="wss-testi-slide<?php echo 0 === $i ? ' wss-testi-active' : ''; ?>">
										<div class="wss-quote-mark">&#8220;</div>
										<p class="wss-quote"><?php echo esc_html( $item['quote'] ); ?></p>
										<div class="wss-attrib">
											<i></i>
											<div>
												<div class="wss-attrib-name"><?php echo esc_html( $item['name'] ); ?></div>
												<div class="wss-attrib-role"><?php echo esc_html( $item['role'] ); ?></div>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>

							<!-- Dots + Arrow nav -->
							<div class="wss-testi-dots" id="<?php echo esc_attr( $uid ); ?>-dots">
								<?php foreach ( $items as $i => $item ) : ?>
									<button class="wss-testi-dot<?php echo 0 === $i ? ' wss-testi-dot-active' : ''; ?>" data-index="<?php echo esc_attr( $i ); ?>" aria-label="Testimonial <?php echo esc_attr( $i + 1 ); ?>"></button>
								<?php endforeach; ?>
								<div class="wss-testi-nav-btns">
									<button class="wss-testi-prev" aria-label="Previous">
										<svg viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
									</button>
									<button class="wss-testi-next" aria-label="Next">
										<svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
									</button>
								</div>
							</div>
						</div>

						<!-- RIGHT: Person portrait stack -->
						<div class="wss-testi-media wss-reveal wss-r2">
							<div class="wss-testi-media-wrap" id="<?php echo esc_attr( $uid ); ?>-media">
								<?php foreach ( $items as $i => $item ) : ?>
									<?php if ( ! empty( $item['image']['url'] ) ) : ?>
										<div class="wss-img-reveal<?php echo 0 === $i ? ' wss-testi-active' : ''; ?>">
											<img src="<?php echo esc_url( $item['image']['url'] ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>">
										</div>
									<?php endif; ?>
								<?php endforeach; ?>
							</div>
						</div>

					</div><!-- .wss-testi -->
				</div>
			</section>
		</div>
		<script>
		(function(){
			var uid    = <?php echo json_encode( $uid ); ?>;
			var slider = document.getElementById( uid + '-slider' );
			var media  = document.getElementById( uid + '-media' );
			var dotsW  = document.getElementById( uid + '-dots' );
			if ( ! slider || ! media || ! dotsW ) { return; }
			var slides = slider.querySelectorAll( '.wss-testi-slide' );
			var imgs   = media.querySelectorAll( '.wss-img-reveal' );
			var dots   = dotsW.querySelectorAll( '.wss-testi-dot' );
			var cur    = 0;
			function go( n ) {
				slides[cur].classList.remove( 'wss-testi-active' );
				if ( imgs[cur] )  { imgs[cur].classList.remove( 'wss-testi-active' ); }
				if ( dots[cur] )  { dots[cur].classList.remove( 'wss-testi-dot-active' ); }
				cur = ( n + slides.length ) % slides.length;
				slides[cur].classList.add( 'wss-testi-active' );
				if ( imgs[cur] )  { imgs[cur].classList.add( 'wss-testi-active' ); }
				if ( dots[cur] )  { dots[cur].classList.add( 'wss-testi-dot-active' ); }
			}
			dotsW.addEventListener( 'click', function( e ) {
				var dot  = e.target.closest( '.wss-testi-dot' );
				var prev = e.target.closest( '.wss-testi-prev' );
				var next = e.target.closest( '.wss-testi-next' );
				if ( dot )  { go( parseInt( dot.dataset.index, 10 ) ); }
				if ( prev ) { go( cur - 1 ); }
				if ( next ) { go( cur + 1 ); }
			} );
		})();
		</script>
		<?php
	}
}
